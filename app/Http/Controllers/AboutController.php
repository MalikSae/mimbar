<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SiteSetting;
use App\Models\Pengurus;

class AboutController extends Controller
{
    public function index()
    {
        // Foto ketua tetap dari DB (bisa diupdate via admin)
        $about = [
            'ketua_foto' => DB::table('settings')->where('key', 'about_ketua_foto')->value('value') ?? '',
        ];

        // Pengurus dari database
        $pengurus = Pengurus::orderBy('urutan')->orderBy('id')->get();

        return view('tentang-kami', compact('about', 'pengurus'));
    }
}
