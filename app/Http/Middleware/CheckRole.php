<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika peran user termasuk dalam role yang diizinkan, izinkan akses
        if (in_array($user->peran, $roles)) {
            return $next($request);
        }

        // Jika tidak sesuai role, abort atau arahkan kembali ke halaman utama
        abort(403, 'Unauthorized action. Kamu tidak memiliki hak akses ke halaman ini.');
    }
}
