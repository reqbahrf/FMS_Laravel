<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyEmail;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public function sendEmailVerify($id, $hash)
    {
        $userId = session('user_id');
        $userName = session('user_name');
        $email = session('email');

        // Check if session data matches the route parameters
        if ($userId && $userId == $id && sha1($email) == $hash) {
            // Create a user object
            $user = (object) ['id' => $userId, 'user_name' => $userName, 'email' => $email];
            Log::alert("message", ['user' => $user]);

            // Send the email
            Mail::to($user->email)->send(new verifyEmail($user));
            return back()->with('status', 'Verification email sent!');
        } else {
            return redirect('/login')->withErrors(['Invalid verification link']);
        }
    }
}