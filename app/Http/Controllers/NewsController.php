<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', 'news')
            ->whereHas('news', fn($q) => $q->where('status', 'published'))
            ->orderBy('name')->get();

        $query = News::with('category')
            ->where('status', 'published')
            ->orderByDesc('created_at');

        if (request('kategori') && request('kategori') !== 'semua') {
            $query->whereHas('category', fn($q) =>
                $q->where('slug', request('kategori'))
            );
        }

        if (request('q')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('q') . '%')
                  ->orWhere('content', 'like', '%' . request('q') . '%');
            });
        }

        $news = $query->paginate(9);

        return view('berita.index', compact('news', 'categories'));
    }

    public function show(string $slug)
    {
        $news = News::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $related = News::with('category')
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        $galleries = \Illuminate\Support\Facades\DB::table('news_galleries')
            ->where('news_id', $news->id)
            ->orderBy('order')
            ->get();

        $tags = [];
        if ($news->tags) {
            $tags = is_array($news->tags)
                ? $news->tags
                : json_decode($news->tags, true) ?? [];
        }

        return view('berita.show', compact('news', 'related', 'galleries', 'tags'));
    }
}
