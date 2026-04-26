<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\TranslationService::class);
        $this->app->singleton(\App\Services\YouTubeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // NOTE: localized() didefinisikan sebagai helper global di app/Helpers/localized.php
        // Gunakan: localized($model, 'title') di Blade

        // === Rate Limiters ===

        // Rate limiter untuk login admin
        RateLimiter::for('admin-login', function (Request $request) {
            return Limit::perMinute(5)
                        ->by($request->ip())
                        ->response(function () {
                            return back()->withErrors([
                                'email' => 'Terlalu banyak percobaan login. Coba lagi dalam 1 menit.'
                            ]);
                        });
        });

        // Rate limiter untuk login penulis
        RateLimiter::for('author-login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Rate limiter untuk form donasi
        RateLimiter::for('donasi', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        // Rate limiter untuk form qurban
        RateLimiter::for('qurban', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        // Rate limiter untuk pengajuan masjid
        RateLimiter::for('pengajuan', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Rate limiter untuk translate API (admin)
        RateLimiter::for('translate', function (Request $request) {
            return Limit::perMinute(20)->by($request->ip());
        });

        // Bagikan jumlah visitor ke semua view
        View::share('totalVisitors', function () {
            try {
                return (int) DB::table('settings')
                    ->where('key', 'total_visitors')
                    ->value('value') ?? 0;
            } catch (\Exception $e) {
                return 0;
            }
        });

        View::share('todayVisitors', function () {
            try {
                $today       = now()->format('Y-m-d');
                $storedDate  = DB::table('settings')->where('key', 'today_visitors_date')->value('value');
                if ($storedDate !== $today) {
                    return 0;
                }
                return (int) DB::table('settings')
                    ->where('key', 'today_visitors')
                    ->value('value') ?? 0;
            } catch (\Exception $e) {
                return 0;
            }
        });
    }
}
