<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('login_admin')) {
            return redirect()->route('login.admin')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}