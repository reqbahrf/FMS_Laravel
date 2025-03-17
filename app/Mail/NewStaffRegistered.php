<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewStaffRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $orgUserInfo;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $orgUserInfo)
    {
        $this->user = $user;
        $this->orgUserInfo = $orgUserInfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Staff Registered',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */

    public function build()
    {
        return $this->subject('Welcome, ' . $this->orgUserInfo->f_name . '')
            ->markdown('mail.new-staff-user');
    }
}
