<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\Models\Article;

class BeritaArtikelController extends Controller
{
    public function index()
    {
        // Kategori untuk filter tab berita (type = 'news')
        $newsCategories = Category::where('type', 'news')
            ->orderBy('name')
            ->get();

        // Berita published dengan pagination
        // Filter by category jika ada request ?kategori=slug
        $newsQuery = News::with('category')
            ->where('status', 'published')
            ->orderByDesc('created_at');

        if (request('kategori') && request('kategori') !== 'semua') {
            $newsQuery->whereHas('category', fn($q) =>
                $q->where('slug', request('kategori'))
            );
        }

        $news = $newsQuery->paginate(6, ['*'], 'berita_page');

        // Kategori untuk filter tab artikel (type = 'article')
        $articleCategories = Category::where('type', 'article')
            ->orderBy('name')
            ->get();

        // Artikel published dengan pagination
        // Filter by category jika ada request ?kategori_artikel=slug
        $articleQuery = Article::with('category')
            ->where('status', 'published')
            ->orderByDesc('created_at');

        if (request('kategori_artikel') && request('kategori_artikel') !== 'semua') {
            $articleQuery->whereHas('category', fn($q) =>
                $q->where('slug', request('kategori_artikel'))
            );
        }

        $articles = $articleQuery->paginate(6, ['*'], 'artikel_page');

        // Newsletter subscription form akan dihandle terpisah
        // (POST /newsletter -> SubscriberController@store)

        return view('berita-artikel', compact('news', 'newsCategories', 'articles', 'articleCategories'));
    }
}
