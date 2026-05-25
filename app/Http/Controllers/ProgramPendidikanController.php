<?php

namespace App\Http\Controllers;

use App\Models\ProgramGallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProgramPendidikanController extends Controller
{
    public function index()
    {
        // Pencapaian dari settings — 1 query batch, di-cache 1 jam (semula: 4 query terpisah)
        $pencapaian = Cache::remember('pencapaian_pendidikan', 3600, function () {
            $keys = [
                'stat_pendidikan_markaz',
                'stat_pendidikan_kaderisasi',
                'stat_pendidikan_kafalah',
                'stat_pendidikan_pelatihan',
            ];

            $settings = DB::table('settings')
                ->whereIn('key', $keys)
                ->pluck('value', 'key');

            return [
                'markaz'      => $settings->get('stat_pendidikan_markaz')      ?? '17',
                'kaderisasi'  => $settings->get('stat_pendidikan_kaderisasi')  ?? '134',
                'kafalah'     => $settings->get('stat_pendidikan_kafalah')     ?? '43',
                'pelatihan'   => $settings->get('stat_pendidikan_pelatihan')   ?? 'Lintas Sektoral',
            ];
        });

        // Galeri program pendidikan — di-cache 6 jam
        $galleries = Cache::remember('galleries_pendidikan', 21600, function () {
            return ProgramGallery::where('program_type', 'pendidikan')
                ->orderBy('order', 'asc')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        });

        return view('program.pendidikan', compact('pencapaian', 'galleries'));
    }
}
