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
        // Program donasi aktif — di-cache 15 menit (900 detik)
        $programs = Cache::remember('home_programs', 900, function () {
            return DonationProgram::with('category')
                ->where('status', 'active')
                ->orderByDesc('created_at')
                ->take(4)
                ->get();
        });

        $featuredProgram = $programs->first();

        // YouTube sudah menggunakan cache internal di YouTubeService (6 jam)
        $videos = collect(app(YouTubeService::class)->getLatestVideos(4, '@mimbarorid'));

        // Ebook terbaru — di-cache 1 jam (3600 detik)
        $ebooks = Cache::remember('home_ebooks', 3600, function () {
            return Ebook::orderByDesc('created_at')
                ->take(4)
                ->get();
        });

        // Berita terbaru — di-cache 15 menit (900 detik)
        $news = Cache::remember('home_news', 900, function () {
            return News::where('status', 'published')
                ->with('category')
                ->orderByDesc('created_at')
                ->take(3)
                ->get();
        });

        // Artikel terbaru — di-cache 15 menit (900 detik)
        $articles = Cache::remember('home_articles', 900, function () {
            return Article::with('category', 'author')
                ->where('status', 'published')
                ->orderByDesc('created_at')
                ->take(4)
                ->get();
        });

        // Slider gambar — di-cache 6 jam (21600 detik)
        $sliderImages = Cache::remember('home_slider_images', 21600, function () {
            return DB::table('program_galleries')
                ->where('program_type', 'slider_home')
                ->orderByDesc('created_at')
                ->get();
        });

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
