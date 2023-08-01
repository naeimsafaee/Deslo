<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('clients')->check()) {
            return redirect()->route('login');
        }
        if (!Auth::guard('clients')->user()->is_registered &&
            !request()->routeIs('profile.register') &&
            !request()->routeIs('logout')) {
            return redirect()->route('profile.register');
        }
        return $next($request);
    }
}
