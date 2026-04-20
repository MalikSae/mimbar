<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('author')->check()) {
            return redirect()->route('author.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah akun aktif
        if (!auth('author')->user()->is_active) {
            auth('author')->logout();
            return redirect()->route('author.login')
                ->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
        }

        return $next($request);
    }
}
