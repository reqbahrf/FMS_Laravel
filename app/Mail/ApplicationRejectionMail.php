<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientEmail;
    public $reasons;
    public $additionalComments;

    /**
     * Create a new message instance.
     */
    public function __construct($recipientEmail, $reasons, $additionalComments)
    {
        $this->recipientEmail = $recipientEmail;
        $this->reasons = $reasons;
        $this->additionalComments = $additionalComments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Rejection Mail',
        );
    }

    public function build()
    {
        return $this->markdown('emailContent.application-rejection')
            ->subject('Application Status Update');
    }
}
