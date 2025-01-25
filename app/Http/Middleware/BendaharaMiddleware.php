<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BendaharaMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session login_bendahara sudah ada
        if (!session('login_bendahara')) {
            // Redirect ke halaman login bendahara jika belum login
            return redirect()->route('login.bendahara')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Lanjutkan ke request berikutnya
        return $next($request);
    }
}