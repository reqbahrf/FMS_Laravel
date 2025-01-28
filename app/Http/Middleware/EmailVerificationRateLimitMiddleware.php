<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class EmailVerificationRateLimitMiddleware
{

    private const MAX_ATTEMPTS = 5;
    private const DECAY_MINUTES = 30;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        $maxAttempts = self::MAX_ATTEMPTS;
        $decayMinutes = self::DECAY_MINUTES;

        // Define the throttle key based on user email and IP address
        $limiter = app(RateLimiter::class);
        $throttleKey = $this->throttleKey($user->email, $request->ip());

        // Check if the user has exceeded the rate limit
        if ($limiter->tooManyAttempts($throttleKey, $maxAttempts)) {
            $retryAfter = ceil($limiter->availableIn($throttleKey) / 60);
            return back()->withErrors(['otp-request-error' => "Too many email verification attempts. Please try again in {$retryAfter} minutes."]);
        }

        // Proceed to the next middleware/controller
        $response = $next($request);

        // If email verification was successful (redirect to success), record this attempt
        if ($response->getStatusCode() === 302) {
            $limiter->hit($throttleKey, $decayMinutes * 60);
        }

        return $response;
    }

    /**
     * Generate a unique key for rate limiting based on email and IP address
     */
    private function throttleKey(string $email, string $ip): string
    {
        return mb_strtolower($email) . '|' . $ip;
    }
}
