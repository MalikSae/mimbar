<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ProgramGallery;
use App\Models\DonationCampaign;
use Illuminate\Http\Request;

class ProgramSosialController extends Controller
{
    public function index()
    {
        // 1. Ambil data statistik dari tabel settings
        // Jika belum ada, gunakan default value sesuai permintaan user
        $pencapaian = [
            'paket_buka_puasa'   => Setting::where('key', 'stat_sosial_paket_buka_puasa')->value('value') ?? '157.099',
            'pembagian_sembako'  => Setting::where('key', 'stat_sosial_pembagian_sembako')->value('value') ?? '3.135',
            'hewan_qurban'       => Setting::where('key', 'stat_sosial_hewan_qurban')->value('value') ?? '1.140',
            'wilayah_distribusi' => Setting::where('key', 'stat_sosial_wilayah_distribusi')->value('value') ?? 'Pelosok & Desa',
        ];

        // 2. Ambil galeri khusus program sosial diurutkan berdasarkan order
        $galleries = ProgramGallery::where('program_type', 'sosial')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('program.sosial', compact('pencapaian', 'galleries'));
    }
}
