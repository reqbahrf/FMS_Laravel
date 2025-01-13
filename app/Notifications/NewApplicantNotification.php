<?php

namespace App\Notifications;

use App\Models\User;
use RuntimeException;
use App\Events\ProjectEvent;
use Illuminate\Bus\Queueable;
use App\Actions\CalculateTimeAgo;
use Illuminate\Notifications\Notification;
use App\Actions\ParseBroadcastNotification;
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
     * Get the event instance.
     *
     * @return ProjectEvent
     */
    public function getEvent(): ProjectEvent
    {
        return $this->event;
    }

    /**
     * Get the organization users.
     *
     * @return mixed
     */
    public function getOrgUsers()
    {
        return $this->orgUsers;
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
        $parsedNotification = ParseBroadcastNotification::execute($notifiable, self::class);

        return new BroadcastMessage($parsedNotification);
    }

    public function broadcastOn()
    {
        // If orgUsers is not provided, get all Staff and Admin users
        if (!$this->orgUsers) {
            $this->orgUsers = User::whereIn('role', ['Staff', 'Admin'])->get();
        }
        // Ensure we're working with a collection
        elseif (!($this->orgUsers instanceof \Illuminate\Database\Eloquent\Collection)) {
            $this->orgUsers = collect([$this->orgUsers]);
        }

        // Ensure each user only receives one notification
        return $this->orgUsers
            ->unique('id')  // Remove duplicate users
            ->map(function ($user) {
                $channelPrefix = $user->role === 'Admin'
                    ? 'admin-notifications.'
                    : 'staff-notifications.';
                return new PrivateChannel($channelPrefix . $user->id);
            })
            ->toArray();
    }
}
