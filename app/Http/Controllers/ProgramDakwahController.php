<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\DonationProgram;

class ProgramDakwahController extends Controller
{
    public function index()
    {
        // Pencapaian dari settings — 1 query batch, di-cache 1 jam (semula: 9 query terpisah)
        $pencapaian = Cache::remember('pencapaian_dakwah_v2', 3600, function () {
            $keys = [
                'stat_dakwah_kajian', 'stat_jamaah', 'stat_dakwah_kaderisasi',
                'stat_dakwah_pengislaman', 'stat_dakwah_markaz', 'stat_dakwah_kafalah',
                'stat_dakwah_kerjasama', 'stat_mushaf', 'stat_dakwah_buku',
            ];

            $settings = DB::table('settings')
                ->whereIn('key', $keys)
                ->pluck('value', 'key');

            return [
                'kajian_seminar'    => $settings->get('stat_dakwah_kajian')      ?? '1.245',
                'jamaah_terjangkau' => $settings->get('stat_jamaah')              ?? '100.000+',
                'kaderisasi_dai'    => $settings->get('stat_dakwah_kaderisasi')   ?? '134',
                'pengislaman'       => $settings->get('stat_dakwah_pengislaman')  ?? '788',
                'markaz'            => $settings->get('stat_dakwah_markaz')       ?? '17',
                'kafalah_dai'       => $settings->get('stat_dakwah_kafalah')      ?? '43',
                'kerja_sama_dai'    => $settings->get('stat_dakwah_kerjasama')    ?? '957',
                'mushaf_dibagikan'  => $settings->get('stat_mushaf')              ?? '21.969',
                'buku_islam'        => $settings->get('stat_dakwah_buku')         ?? '11.451',
            ];
        });

        // Galeri portofolio — di-cache 6 jam
        $galleries = Cache::remember('galleries_dakwah_v2', 21600, function () {
            return DB::table('program_galleries')
                ->where('program_type', 'dakwah')
                ->orderBy('order')
                ->take(10)
                ->get();
        });

        return view('program.dakwah', compact('pencapaian', 'galleries'));
    }
}
