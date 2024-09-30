<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddlleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->ban_status)
        {
            $banned = Auth::user()->ban_status == "1";
            Auth::guard('web')->logout();

            if ($banned == 1)
            {
                $message = 'Your account has been Banned. Please contact administrator.';
            }
            return redirect('/login')
                ->with('status', $message)
                ;
        }

        return $next($request);
    }
}
