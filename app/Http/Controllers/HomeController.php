<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DonationProgram;
use App\Models\Ebook;
use App\Models\News;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
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

        $sliderImages = \Illuminate\Support\Facades\DB::table('program_galleries')
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
