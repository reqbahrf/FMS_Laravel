<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Cache\RateLimiter;


class EmailVerificationRateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $hash = $request->route('hash');

        $user = User::find($id);
        $maxAttempts = 5;
        $decayMinutes = 30;


        if (!$user || hash('sha256', $user->email) !== $hash) {
            return redirect()->route('home')->with('error', 'Invalid verification link.');
        }

        // Define the throttle key based on user email and IP address
        $limiter = app(RateLimiter::class);
        $throttleKey = $this->throttleKey($user->email, $request->ip());

        // Check if the user has exceeded the rate limit
        if ($limiter->tooManyAttempts($throttleKey, $maxAttempts)) {
            $retryAfter = ceil($limiter->availableIn($throttleKey) / 60);
            return back()->with('error', "Too many email verification attempts. Please try again in {$retryAfter} minutes.");
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
