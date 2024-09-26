<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginAttemptRateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $maxAttempts = 3;
        $decayMinutes = 60 * 15;

        $limiter = app(RateLimiter::class);


        if ($limiter->tooManyAttempts($this->throttleKey($request), $maxAttempts)) {
            $retryAfter = ceil($limiter->availableIn($this->throttleKey($request)) / 60);
            return response()->json(['error' => 'Too many login attempts. Please try again in ' . $retryAfter . ' minutes.'], 429);
        }

        $response = $next($request);


        if ($response->getStatusCode() === 401) {
            $limiter->hit($this->throttleKey($request), $decayMinutes);
            $remainingAttempts = $limiter->retriesLeft($this->throttleKey($request), $maxAttempts);
            $responseData = json_decode($response->getContent(), true);
            $responseData['remaining_attempts'] = $remainingAttempts;
            $response = response()->json($responseData, $response->getStatusCode(), $response->headers->all());
        }


        if ($response->getStatusCode() === 200) {
            $limiter->clear($this->throttleKey($request));
        }

        return $response;
    }
    private function throttleKey($request)
    {
        return mb_strtolower($request->input('login')) . '|' . $request->ip();
    }
}
