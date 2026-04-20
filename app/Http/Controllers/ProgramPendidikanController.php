<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ProgramGallery;
use Illuminate\Http\Request;

class ProgramPendidikanController extends Controller
{
    public function index()
    {
        $pencapaian = [
            'markaz'        => Setting::where('key', 'stat_pendidikan_markaz')->value('value') ?? '17',
            'kaderisasi'    => Setting::where('key', 'stat_pendidikan_kaderisasi')->value('value') ?? '134',
            'kafalah'       => Setting::where('key', 'stat_pendidikan_kafalah')->value('value') ?? '43',
            'pelatihan'     => Setting::where('key', 'stat_pendidikan_pelatihan')->value('value') ?? 'Lintas Sektoral',
        ];

        $galleries = ProgramGallery::where('program_type', 'pendidikan')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('program.pendidikan', compact('pencapaian', 'galleries'));
    }
}
