<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateKepala
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('login_kepala')) {
            return redirect()->route('login.kepala')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}