<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CountVisitor
{
    /**
     * Hitung jumlah visitor akumulatif dan harian.
     * Skip: request admin, bot/crawler, AJAX, dan aset statis.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip halaman admin
        if ($request->is('admin*')) {
            return $next($request);
        }

        // Skip AJAX / JSON request
        if ($request->ajax() || $request->wantsJson()) {
            return $next($request);
        }

        // Skip bot/crawler umum berdasarkan User-Agent
        $userAgent = strtolower($request->userAgent() ?? '');
        $bots = ['bot', 'crawler', 'spider', 'slurp', 'facebookexternalhit', 'curl', 'wget', 'python'];
        foreach ($bots as $bot) {
            if (str_contains($userAgent, $bot)) {
                return $next($request);
            }
        }

        $today = now()->format('Y-m-d');

        // Cek tanggal hari ini di settings
        $storedDate = DB::table('settings')->where('key', 'today_visitors_date')->value('value');

        if ($storedDate === $today) {
            // Masih hari yang sama: increment visitor hari ini
            DB::table('settings')
                ->where('key', 'today_visitors')
                ->update(['value' => DB::raw('value + 1')]);
        } else {
            // Hari baru: reset counter harian dan update tanggal
            DB::table('settings')
                ->where('key', 'today_visitors')
                ->update(['value' => '1']);
            DB::table('settings')
                ->where('key', 'today_visitors_date')
                ->update(['value' => $today]);
        }

        // Increment total visitor akumulatif (atomic)
        DB::table('settings')
            ->where('key', 'total_visitors')
            ->update(['value' => DB::raw('value + 1')]);

        return $next($request);
    }
}

