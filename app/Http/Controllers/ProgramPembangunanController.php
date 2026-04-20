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

        return view('program.pembangunan', compact('galleries', 'campaigns'));
    }
}
