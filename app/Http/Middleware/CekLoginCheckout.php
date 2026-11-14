<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLoginCheckout
{
    /**
     * Middleware ini yang dipakai buat nyaring akses fitur checkout.
     * Kalau user belum login, dia bakal dibalikin ke halaman login
     * sambil bawa pesan alert. Kalau udah login, lanjut aja.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('alert', 'Anda harus login terlebih dahulu');
        }

        return $next($request);
    }
}
