<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DonationProgram;

class ProgramPembangunanController extends Controller
{
    public function index()
    {
        // Galeri portofolio program pembangunan
        $galleries = DB::table('program_galleries')
            ->where('program_type', 'pembangunan')
            ->orderBy('order')
            ->get();

        // Campaign donasi aktif (untuk header CTA atau future use)
        // Jika tidak digunakan di view saat ini, biarkan sebagai reserve.
        $campaigns = DonationProgram::where('status', 'active')
            ->take(3)
            ->get();

        // Pencapaian dari settings (dengan fallback nilai default)
        $pencapaian = [
            'masjid' => DB::table('settings')->where('key', 'stat_pembangunan_masjid')->value('value') ?? '157',
            'sumur'  => DB::table('settings')->where('key', 'stat_pembangunan_sumur')->value('value') ?? '152',
            'desain' => DB::table('settings')->where('key', 'stat_pembangunan_desain')->value('value') ?? '4 Tipe',
        ];

        return view('program.pembangunan', compact('galleries', 'campaigns', 'pencapaian'));
    }
}
