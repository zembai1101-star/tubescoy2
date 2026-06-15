<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
   public function handle(Request $request, Closure $next)
{
    // Jika sudah login DAN kolom role-nya adalah 'admin', izinkan lewat!
    if (Auth::check() && Auth::user()->role === 'admin') {
        return $next($request);
    }

    // Jika bukan admin, tendang balik diam-diam ke halaman utama
    return redirect()->route('index.home');
}
}