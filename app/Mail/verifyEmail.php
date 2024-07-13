<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
        Log::info('User object:', ['user' => $this->user]);
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emailContent.confirmEmail')
            ->with([
                'userName' => $this->user->user_name,
                'verificationUrl' => route('verifyEmail', ['id' => $this->user->id, 'hash' => sha1($this->user->email)]),
            ]);
    }
}
