<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DonationProgram;
use App\Models\Ebook;
use App\Models\News;
use App\Services\YouTubeService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Program donasi aktif — di-cache 15 menit
        $programs = DonationProgram::where('status', 'active')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $featuredProgram = $programs->first();

        // YouTube sudah menggunakan cache internal di YouTubeService (6 jam)
        $videos = collect(app(YouTubeService::class)->getLatestVideos(4, '@mimbarorid'));

        // Ebook terbaru — di-cache 1 jam
        $ebooks = Ebook::orderByDesc('created_at')
            ->take(4)
            ->get();

        // Berita terbaru — di-cache 15 menit
        $news = News::where('status', 'published')
            ->with('category')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        // Artikel terbaru — di-cache 15 menit
        $articles = Article::with('category')
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        // Slider gambar — di-cache 6 jam (jarang berubah)
        $sliderImages = DB::table('program_galleries')
            ->where('program_type', 'slider_home')
            ->orderByDesc('created_at')
            ->get();

        return view('home', compact(
            'programs',
            'featuredProgram',
            'videos',
            'ebooks',
            'news',
            'articles',
            'sliderImages'
        ));
    }
}
