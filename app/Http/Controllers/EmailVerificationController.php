<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\verifyEmail;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EmailVerificationController extends Controller
{
    public function emailVerificationView(Request $request)
    {
        try {
            // Check if the previous URL is from a verification-related route
            $previousUrl = url()->previous();
            $verificationRoutes = [
                route('signup'),
                route('login.submit'),
            ];

            // If the previous URL matches verification routes, send verification email
            if (collect($verificationRoutes)->contains(fn($route) => Str::startsWith($previousUrl, $route))) {
                $emailSentResponse = $this->sendVerificationEmail();

                return view('auth.verifyEmail')->with([
                    'status' => $emailSentResponse->getSession()->get('status')
                ]);
            }

            // If not redirected from verification routes, just return the view
            return view('auth.verifyEmail');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['Invalid verification request:' => $e->getMessage()]);
        }
    }
    public function sendVerificationEmail()
    {
        try {

            $user = Auth::user();
            $userId = $user->id;
            $userName = $user->user_name;
            $email = $user->email;

            // Check if session data matches the route parameters
            if (!$user || !$userId) throw new AuthenticationException('User not authenticated');
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
        } catch (Exception $e) {
            return back()->withErrors(['Invalid verification request:' => $e->getMessage()]);
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

            if ($storedOtp && hash_equals((string)$storedOtp, (string)$request->otp)) {
                // OTP is correct, mark email as verified
                $user = User::findOrFail($request->user_id);
                $user->email_verified_at = now();
                $user->save();

                Cache::forget($cacheKey);
                // Check if there's an intended URL in the session
                if (session()->has('url.intended')) {
                    // Redirect to the intended URL
                    return redirect()->intended(session('url.intended'));
                }

                // If no intended URL, redirect to a default route based on user role
                if (!in_array($user->role, ['Cooperator', 'Staff', 'Admin'])) {
                    Log::warning("Invalid user role: {$user->role}");
                    return redirect()->route('home');
                }
                return match ($user->role) {
                    'Cooperator' => redirect()->route('Cooperator.index'),
                    'Staff' => redirect()->route('Staff.index'),
                    'Admin' => redirect()->route('Admin.index'),
                };
            }
        } catch (Exception $e) {
            Log::alert(['Error in MailController:' => $e->getMessage()]);
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }
    }
}
