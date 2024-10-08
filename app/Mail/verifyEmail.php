<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;


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
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $timestamp = now()->timestamp;
        return $this->markdown('emailContent.confirmEmail')
            ->with([
                'userName' => $this->user->user_name,
                'verificationUrl' =>URL::signedRoute('verifyEmail', [
                    'id' => $this->user->id,
                    'hash' => hash('sha256', $this->user->email),
                    'timestamp' => $timestamp,
                ]),
            ]);
    }
}
