<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', 'article')
            ->whereHas('articles', fn($q) => $q->where('status', 'published'))
            ->orderBy('name')->get();

        $query = Article::with('category')
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

        $articles = $query->paginate(9);

        return view('artikel.index', compact('articles', 'categories'));
    }

    public function show(string $slug)
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $readingTime = $article->reading_time
            ?? max(1, (int) ceil(str_word_count(strip_tags($article->content)) / 200));

        $related = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        $tags = [];
        if ($article->tags) {
            $tags = is_array($article->tags)
                ? $article->tags
                : json_decode($article->tags, true) ?? [];
        }

        return view('artikel.show', compact('article', 'related', 'readingTime', 'tags'));
    }
}
