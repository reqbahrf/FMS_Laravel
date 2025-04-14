<?php

namespace App\Mail;

use App\Models\User;
use App\Models\CoopUserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendApplicationFormLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User data and application form URL
     */
    public $user;
    public $applicationFormUrl;
    public $userName;
    public $initial_password;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $applicationFormUrl, CoopUserInfo $coopUserInfo)
    {
        $this->user = $user;
        $this->applicationFormUrl = $applicationFormUrl;
        $this->userName = $coopUserInfo->f_name ?? $user->name;
        $this->initial_password = $coopUserInfo->l_name . str_replace('-', '', $coopUserInfo->birth_date?->format('Y-m-d'));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome - Your Application Form Link',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.send-application-form-link',
            with: [
                'user' => $this->user,
                'applicationFormUrl' => $this->applicationFormUrl,
                'userName' => $this->userName,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
