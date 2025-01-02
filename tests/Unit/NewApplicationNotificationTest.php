<?php

namespace Tests\Unit;

use Mockery;
use stdClass;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use RuntimeException;
use App\Events\ProjectEvent;
use App\Actions\CalculateTimeAgo;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewApplicantNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewApplicationNotificationTest extends TestCase
{
    use RefreshDatabase;

    // Notification is created with ProjectEvent and optional orgUsers parameters
    public function test_notification_constructor_sets_event_and_org_users(): void
    {
        $event = new ProjectEvent(null, null, null, null, "NEW_APPLICANT");
        $orgUsers = collect([
            User::factory()->create(['role' => 'Staff']),
            User::factory()->create(['role' => 'Admin'])
        ]);

        $notification = new NewApplicantNotification($event, $orgUsers);

        $this->assertSame($event, $notification->getEvent());
        $this->assertSame($orgUsers, $notification->getOrgUsers());
    }

    // Notification is delivered through database and broadcast channels
    public function test_notification_via_returns_correct_channels(): void
    {
        $event = new ProjectEvent(null , null, null, null, "NEW_APPLICANT");
        $notification = new NewApplicantNotification($event);
        $notifiable = new User();

        $channels = $notification->via($notifiable);

        $this->assertEquals(['database', 'broadcast'], $channels);
    }

    // Handle null orgUsers parameter in broadcastOn by fetching Staff/Admin users
    public function test_broadcast_on_fetches_staff_admin_users_when_org_users_null(): void
    {
        User::factory()->create(['role' => 'Staff']);
        User::factory()->create(['role' => 'Admin']);
        $event = new ProjectEvent(null, null, null, null, "NEW_APPLICANT");
        $notification = new NewApplicantNotification($event);

        $channels = $notification->broadcastOn();

        $this->assertCount(2, $channels);
        $this->assertInstanceOf(PrivateChannel::class, $channels[0]);
        $this->assertStringContainsString('staff-notifications.', $channels[0]->name);
        $this->assertStringContainsString('admin-notifications.', $channels[1]->name);
    }

    // Handle missing notification when calculating time ago in toBroadcast
    public function test_to_broadcast_handles_missing_notification(): void
    {
        $event = new ProjectEvent(null, null, null, null, "NEW_APPLICANT");
        $notification = new NewApplicantNotification($event);
        $notifiable = Mockery::mock(User::class);
        $notificationQuery = Mockery::mock(stdClass::class);

        $notifiable->shouldReceive('notifications->where->latest->first')
            ->once()
            ->andReturn(null);

        $this->expectException(\RuntimeException::class);
        $notification->toBroadcast($notifiable);
    }
}
