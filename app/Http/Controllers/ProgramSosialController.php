<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ProgramGallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProgramSosialController extends Controller
{
    public function index()
    {
        // Pencapaian dari settings — 1 query batch, di-cache 1 jam (semula: 4 query terpisah)
        $pencapaian = Cache::remember('pencapaian_sosial', 3600, function () {
            $keys = [
                'stat_sosial_paket_buka_puasa',
                'stat_sosial_pembagian_sembako',
                'stat_sosial_hewan_qurban',
                'stat_sosial_wilayah_distribusi',
            ];

            $settings = DB::table('settings')
                ->whereIn('key', $keys)
                ->pluck('value', 'key');

            return [
                'paket_buka_puasa'   => $settings->get('stat_sosial_paket_buka_puasa')      ?? '157.099',
                'pembagian_sembako'  => $settings->get('stat_sosial_pembagian_sembako')      ?? '3.135',
                'hewan_qurban'       => $settings->get('stat_sosial_hewan_qurban')            ?? '1.140',
                'wilayah_distribusi' => $settings->get('stat_sosial_wilayah_distribusi')      ?? 'Pelosok & Desa',
            ];
        });

        // Galeri program sosial — di-cache 6 jam
        $galleries = Cache::remember('galleries_sosial', 21600, function () {
            return ProgramGallery::where('program_type', 'sosial')
                ->orderBy('order', 'asc')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        });

        return view('program.sosial', compact('pencapaian', 'galleries'));
    }
}
