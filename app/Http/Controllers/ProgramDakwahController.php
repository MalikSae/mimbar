<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DonationProgram;

class ProgramDakwahController extends Controller
{
    public function index()
    {
        // Pencapaian dari settings (dengan fallback nilai default)
        $pencapaian = [
            'kajian_seminar'    => DB::table('settings')->where('key', 'stat_dakwah_kajian')->value('value') ?? '1.245',
            'jamaah_terjangkau' => DB::table('settings')->where('key', 'stat_jamaah')->value('value') ?? '100.000+',
            'kaderisasi_dai'    => DB::table('settings')->where('key', 'stat_dakwah_kaderisasi')->value('value') ?? '134',
            'pengislaman'       => DB::table('settings')->where('key', 'stat_dakwah_pengislaman')->value('value') ?? '788',
            'markaz'            => DB::table('settings')->where('key', 'stat_dakwah_markaz')->value('value') ?? '17',
            'kafalah_dai'       => DB::table('settings')->where('key', 'stat_dakwah_kafalah')->value('value') ?? '43',
            'kerja_sama_dai'    => DB::table('settings')->where('key', 'stat_dakwah_kerjasama')->value('value') ?? '957',
            'mushaf_dibagikan'  => DB::table('settings')->where('key', 'stat_mushaf')->value('value') ?? '21.969',
            'buku_islam'        => DB::table('settings')->where('key', 'stat_dakwah_buku')->value('value') ?? '11.451',
        ];

        // Galeri portofolio program dakwah
        $galleries = DB::table('program_galleries')
            ->where('program_type', 'dakwah')
            ->orderBy('order')
            ->get();

        // Campaign donasi aktif (untuk CTA)
        $campaigns = DonationProgram::where('status', 'active')
            ->take(3)
            ->get();

        return view('program.dakwah', compact('pencapaian', 'galleries', 'campaigns'));
    }
}
