<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStaffUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role != 'Staff' || Auth::user()->orgUserInfo->access_to != 'Allowed') {
            abort(Response::HTTP_UNAUTHORIZED, 'You do not have the necessary permissions to access this section. Please contact the administrator for assistance.');
        }
        return $next($request);
    }
}
