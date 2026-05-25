<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\DonationProgram;

class ProgramPembangunanController extends Controller
{
    public function index()
    {
        // Pencapaian dari settings — 1 query batch, di-cache 1 jam (semula: 3 query terpisah)
        $pencapaian = Cache::remember('pencapaian_pembangunan', 3600, function () {
            $keys = [
                'stat_pembangunan_masjid',
                'stat_pembangunan_sumur',
                'stat_pembangunan_desain',
            ];

            $settings = DB::table('settings')
                ->whereIn('key', $keys)
                ->pluck('value', 'key');

            return [
                'masjid' => $settings->get('stat_pembangunan_masjid')  ?? '157',
                'sumur'  => $settings->get('stat_pembangunan_sumur')   ?? '152',
                'desain' => $settings->get('stat_pembangunan_desain')  ?? '4 Tipe',
            ];
        });

        // Galeri portofolio — di-cache 6 jam
        $galleries = Cache::remember('galleries_pembangunan', 21600, function () {
            return DB::table('program_galleries')
                ->where('program_type', 'pembangunan')
                ->orderBy('order')
                ->take(10)
                ->get();
        });

        // Campaign donasi aktif — di-cache 30 menit (shared key dengan controller lain)
        $campaigns = Cache::remember('campaigns_active_3', 1800, function () {
            return DonationProgram::where('status', 'active')
                ->take(3)
                ->get();
        });

        return view('program.pembangunan', compact('galleries', 'campaigns', 'pencapaian'));
    }
}
