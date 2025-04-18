<?php

namespace App\Mail;

use App\Models\User;
use App\Models\ProjectInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectRegistration extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    public $user;

    /**
     * The project instance.
     *
     * @var object
     */
    public $project;

    /**
     * The user's password.
     *
     * @var string
     */
    public $password;

    /**
     * The login URL.
     *
     * @var string
     */
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param ProjectInfo $project
     * @param string $password
     * @return void
     */
    public function __construct(User $user, ProjectInfo $project, string $password)
    {
        $this->user = $user;
        $this->project = $project;
        $this->password = $password;
        $this->loginUrl = route('login');
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Project Registration Confirmation',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.project-registration',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
