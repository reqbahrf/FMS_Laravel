<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCooperatorUser
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

        $authUser = Auth::user();

        if ($authUser->role != 'Cooperator') {
            return redirect()->route('home');
        }

        // First check if coopUserInfo exists
        if (is_null($authUser->coopUserInfo)) {
            return redirect()->to(URL::signedRoute('application.form', ['id' => $authUser->id]));
        }

        // Then check if businessInfo exists
        if (is_null($authUser->coopUserInfo->businessInfo)) {
            return redirect()->to(URL::signedRoute('application.form', ['id' => $authUser->id]));
        }


        return $next($request);
    }
}
