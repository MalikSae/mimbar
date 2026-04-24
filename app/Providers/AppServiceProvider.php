<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // NOTE: localized() didefinisikan sebagai helper global di app/Helpers/localized.php
        // Gunakan: localized($model, 'title') di Blade

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
