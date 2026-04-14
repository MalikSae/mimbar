<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DonationProgram;
use App\Models\Ebook;
use App\Models\News;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'masjid_dibangun'  => DB::table('settings')->where('key', 'stat_masjid')->value('value') ?? 0,
            'sumur_dibangun'   => DB::table('settings')->where('key', 'stat_sumur')->value('value') ?? 0,
            'mushaf_dibagikan' => DB::table('settings')->where('key', 'stat_mushaf')->value('value') ?? 0,
            'paket_buka_puasa' => DB::table('settings')->where('key', 'stat_paket_buka')->value('value') ?? 0,
        ];

        $programs = DonationProgram::where('status', 'active')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $featuredProgram = $programs->first();

        $videos = Video::where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        $ebooks = Ebook::orderByDesc('created_at')
            ->take(4)
            ->get();

        $news = News::where('status', 'published')
            ->with('category')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $articles = Article::with('category')
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('home', compact(
            'stats',
            'programs',
            'featuredProgram',
            'videos',
            'ebooks',
            'news',
            'articles'
        ));
    }
}
