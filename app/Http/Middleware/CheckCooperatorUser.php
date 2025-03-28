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

        if (Auth::user()->role != 'Cooperator') {
            return redirect()->route('home');
        }
        if (is_null(Auth::user()->coopUserInfo->businessInfo)) {
            return redirect()->to(URL::signedRoute('application.form', ['id' => Auth::user()->id]));
        }


        return $next($request);
    }
}
