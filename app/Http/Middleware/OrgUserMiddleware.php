<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OrgUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::check())
        {
            return redirect()->route('login.Form');
        }
        if(Auth::user()->role == 'Admin')
        {
            return $next($request);
        }

        if(Auth::user()->role == 'Staff' && Auth::user()->orgUserInfo->access_to == 'Allowed')
        {
            return $next($request);
        }


            abort(Response::HTTP_UNAUTHORIZED);
    }
}
