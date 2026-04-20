<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Jangan ubah apapun untuk rute admin dan penulis
        if ($request->is('admin') || $request->is('admin/*') || $request->is('penulis') || $request->is('penulis/*')) {
            return $next($request);
        }

        $locale = session('locale', 'id');

        if (!in_array($locale, config('app.available_locales', ['id', 'ar']))) {
            $locale = 'id';
        }

        App::setLocale($locale);
        \Carbon\Carbon::setLocale($locale === 'ar' ? 'ar' : 'id');

        return $next($request);
    }
}
