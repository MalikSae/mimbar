<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use App\Models\DonationProgram;

class ProgramController extends Controller
{
    public function index()
    {
        // Statistik per departemen dari settings
        $stats = [
            'jamaah_terjangkau' => DB::table('settings')->where('key', 'stat_jamaah')->value('value') ?? 0,
            'masjid_dibangun'   => DB::table('settings')->where('key', 'stat_masjid')->value('value') ?? 0,
            'subscribers_tv'    => DB::table('settings')->where('key', 'stat_subscribers_tv')->value('value') ?? 0,
            'santri_lulusan'    => DB::table('settings')->where('key', 'stat_santri')->value('value') ?? 0,
        ];

        // Video featured untuk section Humas & Media
        $videoFeatured = Video::where('is_featured', true)
            ->orderByDesc('published_at')
            ->first();

        // Program donasi aktif untuk CTA bawah
        $programsAktif = DonationProgram::where('status', 'active')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('program', compact('stats', 'videoFeatured', 'programsAktif'));
    }
}
