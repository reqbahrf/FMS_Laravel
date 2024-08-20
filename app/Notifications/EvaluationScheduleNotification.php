<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Carbon\Carbon;

class EvaluationScheduleNotification extends Notification
{
    use Queueable;

    protected $schedule;


    /**
     * Create a new notification instance.
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $evaluationDate = Carbon::parse($this->schedule->Evaluation_date)->format('Y-m-d h:i A');
        return (new MailMessage)
                    ->line('Your evaluation is scheduled on ')
                    ->line('**' . $evaluationDate . '**')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $evaluationDate = Carbon::parse($this->schedule->Evaluation_date)->format('Y-m-d h:i A');
        return [
            'message' => 'Your evaluation is scheduled on ' .  $evaluationDate,
            'schedule_id' => $this->schedule->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $evaluationDate = Carbon::parse($this->schedule->Evaluation_date)->format('Y-m-d h:i A');
        return new BroadcastMessage([
            'message' => 'Your evaluation is scheduled on ' .  $evaluationDate,
            'schedule_id' => $this->schedule->id,
        ]);
    }

    public function findExisting($notifiable)
    {
    return $notifiable->notifications()
                      ->where('type', self::class)
                      ->where('notifiable_id', $notifiable->id)
                      ->first();
    }
}
