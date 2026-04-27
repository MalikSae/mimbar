<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YouTubeService;

class MimbarTvController extends Controller
{
    /**
     * Tampilkan halaman publik Mimbar TV dengan video terbaru dari YouTube.
     */
    public function index()
    {
        $videos = app(YouTubeService::class)->getLatestVideos(12, '@mimbartvid');

        return view('mimbartv.index', compact('videos'));
    }
}
