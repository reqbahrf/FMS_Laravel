<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Services\NumberFormatterService as NF;

class DuePayment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $dueDate,
        public string $projectId,
        public string $amount
    ) {
        $ParseDate = Carbon::parse($this->dueDate)->format('Y-m-d');
        $this->dueDate = $ParseDate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->markdown('mail.due-payment', [
            'email' => $notifiable->email,
            'projectId' => $this->projectId,
            'dueAmount' => NF::formatNumber($this->amount),
            'dueDate' => $this->dueDate
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Due Payment',
            'message' => 'You have a due payment of ₱' . NF::formatNumber($this->amount)  . ' on ' . $this->dueDate . ' for project ID ' . $this->projectId,
        ];
    }
}
