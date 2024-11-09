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

    /**
     * Create a new notification instance.
     */
    public function __construct(ProjectEvent $event)
    {
        $this->event = $event;
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
        return User::whereIn('role', ['Staff', 'Admin'])->get()->map(function ($user) {
            return new PrivateChannel('admin-notifications.' . $user->id);
        })->toArray();
    }
}
