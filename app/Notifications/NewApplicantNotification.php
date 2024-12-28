<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use App\Events\ProjectEvent;

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
        return new BroadcastMessage([
            'title' => 'New applicant',
            'message' => 'New applicant has been submitted to the system. you may check it on the Applicants tab.',
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
