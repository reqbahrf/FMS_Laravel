<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail()
    {
        try{

            $user = Auth::user();
            $userId =  $user->id;
            $userName =   $user->user_name;
            $email =   $user->email;
    
            // Check if session data matches the route parameters
            if ($userId) {
                // Generate a 6-digit OTP
                $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    
                // Store OTP in cache with expiration (30 minutes)
                $cacheKey = "email_verification_otp_{$userId}";
                Cache::put($cacheKey, $otp, now()->addMinutes(30));
    
                // Create a user object
                $user = (object) ['id' => $userId, 'user_name' => $userName, 'email' => $email, 'otp' => $otp];
    
                // Send the email with OTP
                Mail::to($user->email)->send(new verifyEmail($user));
    
                return back()->with('status', 'An OTP has been sent to <strong>' . e($user->email) . '</strong>. <br> Please check your email. <br> <span class="fw-light text-muted">OTP will expire in 30 minutes.</span>');
            }
        }catch(Exception $e){
            return redirect('/')->withErrors(['Invalid verification request:' => $e->getMessage()]);

        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required|numeric|digits:6',
                'user_id' => 'required|exists:users,id'
            ]);
    
            $cacheKey = "email_verification_otp_{$request->user_id}";
            $storedOtp = Cache::get($cacheKey);
    
            if ($storedOtp && $storedOtp === $request->otp) {
                // OTP is correct, mark email as verified
                $user = User::findOrFail($request->user_id);
                $user->email_verified_at = now();
                $user->save();
                 
                Auth::logout();
                Cache::forget($cacheKey);
    
                return redirect()->route('/login')->with('success', 'Email verified successfully! You can now login.');
            }
            
        } catch (Exception $e) {
            Log::alert(['Error in MailController:' => $e->getMessage()]);
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
            
        }

    }
}
