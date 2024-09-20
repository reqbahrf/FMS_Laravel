<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Use the Password facade to send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the status and return appropriate response
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset(Request $request)
    {
        // Validate the reset form inputs
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        // Use the Password facade to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, String $password) {
                // Update the user's password
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        // Check the status and return appropriate response
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.Form')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
