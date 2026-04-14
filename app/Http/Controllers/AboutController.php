<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil konten statis dari tabel settings
        $about = [
            'profil'        => DB::table('settings')->where('key', 'about_profil')->value('value') ?? '',
            'visi'          => DB::table('settings')->where('key', 'about_visi')->value('value') ?? '',
            'misi'          => DB::table('settings')->where('key', 'about_misi')->value('value') ?? '',
            'ketua_nama'    => DB::table('settings')->where('key', 'about_ketua_nama')->value('value') ?? '',
            'ketua_jabatan' => DB::table('settings')->where('key', 'about_ketua_jabatan')->value('value') ?? '',
            'ketua_quote'   => DB::table('settings')->where('key', 'about_ketua_quote')->value('value') ?? '',
            'ketua_foto'    => DB::table('settings')->where('key', 'about_ketua_foto')->value('value') ?? '',
        ];

        // Statistik pencapaian yayasan
        $stats = [
            'masjid_dibangun'  => DB::table('settings')->where('key', 'stat_masjid')->value('value') ?? 0,
            'sumur_dibangun'   => DB::table('settings')->where('key', 'stat_sumur')->value('value') ?? 0,
            'mushaf_dibagikan' => DB::table('settings')->where('key', 'stat_mushaf')->value('value') ?? 0,
            'paket_buka_puasa' => DB::table('settings')->where('key', 'stat_paket_buka')->value('value') ?? 0,
        ];

        return view('tentang-kami', compact('about', 'stats'));
    }
}
