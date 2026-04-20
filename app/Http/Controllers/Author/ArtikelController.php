<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $articles = Article::where('author_id', auth()->guard('author')->id())
                           ->with('category')
                           ->latest()
                           ->paginate(15);

        return view('author.dashboard', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('type', 'article')->orderBy('name')->get();
        return view('author.artikel.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->title);
        $base = $slug;
        $i    = 2;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        Article::create([
            'author_id'   => auth()->guard('author')->id(),
            'admin_id'    => null,
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'content'     => $request->content,
            'excerpt'     => $request->excerpt,
            'status'      => 'draft',
        ]);

        return redirect()->route('author.dashboard')
            ->with('success', 'Artikel berhasil disimpan sebagai draft.');
    }

    public function edit(Article $article)
    {
        abort_if($article->author_id !== auth()->guard('author')->id(), 403);
        abort_if($article->status === 'published', 403, 'Artikel yang sudah dipublish tidak dapat diedit.');

        $categories = Category::where('type', 'article')->orderBy('name')->get();
        return view('author.artikel.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        abort_if($article->author_id !== auth()->guard('author')->id(), 403);
        abort_if($article->status === 'published', 403, 'Artikel yang sudah dipublish tidak dapat diedit.');

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'content'     => $request->content,
            'excerpt'     => $request->excerpt,
        ]);

        return redirect()->route('author.dashboard')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        abort_if($article->author_id !== auth()->guard('author')->id(), 403);
        abort_if($article->status === 'published', 403, 'Artikel yang sudah dipublish tidak dapat dihapus.');

        $article->delete();

        return redirect()->route('author.dashboard')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function submit(Article $article)
    {
        abort_if($article->author_id !== auth()->guard('author')->id(), 403);
        abort_if($article->status !== 'draft', 403, 'Hanya artikel berstatus draft yang dapat dikirim.');

        $article->update(['status' => 'pending_review']);

        return redirect()->route('author.dashboard')
            ->with('success', 'Artikel dikirim untuk review admin.');
    }
}
