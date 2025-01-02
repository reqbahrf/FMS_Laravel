<?php

namespace App\Notifications;

use App\Models\User;
use App\Events\ProjectEvent;
use Illuminate\Bus\Queueable;
use App\Actions\CalculateTimeAgo;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewApplicantNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    private $event;
    private $orgUsers;

    /**
     * Create a new notification instance.
     */
    public function __construct(ProjectEvent $event, $orgUsers = null)
    {
        $this->event = $event;
        $this->orgUsers = $orgUsers;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New applicant',
            'message' => 'New applicant has been submitted to the system. you may check it on the Applicants tab.',
        ];
    }

    public function toBroadcast($notifiable)
    {
        $notification = $notifiable->notifications()->where('type', self::class)->latest()->first();
        $timeAgo = CalculateTimeAgo::execute($notification->created_at);

        return new BroadcastMessage([
            'id' => $notification->id,
            'data' => $notification->data,
            'read_at' => $notification->read_at,
            'created_at' => $notification->created_at,
            'time_ago' => $timeAgo,
        ]);
    }

    public function broadcastOn()
    {
        $orgUsers = $this->orgUsers ?? User::whereIn('role', ['Staff', 'Admin'])->get();

        return $orgUsers
            ->map(function ($user) {
                $channelPrefix = $user->role === 'Admin'
                    ? 'admin-notifications.'
                    : 'staff-notifications.';
                return new PrivateChannel($channelPrefix . $user->id);
            })
            ->toArray();
    }
}
