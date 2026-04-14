<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles   = $query->paginate(20)->withQueryString();
        $categories = Category::where('type', 'article')->orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'article')->orderBy('name')->get();
        return view('admin.articles.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'author_name'  => 'nullable|string|max:100',
            'author_photo' => 'nullable|image|max:2048',
            'author_bio'   => 'nullable|string|max:500',
            'reading_time' => 'nullable|integer|min:1',
            'tags'         => 'nullable|string',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->title);
        $baseSlug = $slug;
        $count = 2;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $data = [
            'title'        => $request->title,
            'slug'         => $slug,
            'category_id'  => $request->category_id,
            'content'      => $request->content,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'author_name'  => $request->author_name,
            'author_bio'   => $request->author_bio,
            'reading_time' => $request->reading_time,
            'tags'         => $request->tags
                ? json_encode(array_values(array_filter(array_map('trim', explode(',', $request->tags)))))
                : null,
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }
        if ($request->hasFile('author_photo')) {
            $data['author_photo'] = $request->file('author_photo')->store('authors', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article    = Article::findOrFail($id);
        $categories = Category::where('type', 'article')->orderBy('name')->get();
        return view('admin.articles.form', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'author_name'  => 'nullable|string|max:100',
            'author_photo' => 'nullable|image|max:2048',
            'author_bio'   => 'nullable|string|max:500',
            'reading_time' => 'nullable|integer|min:1',
            'tags'         => 'nullable|string',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        $data = [
            'title'        => $request->title,
            'category_id'  => $request->category_id,
            'content'      => $request->content,
            'status'       => $request->status,
            'author_name'  => $request->author_name,
            'author_bio'   => $request->author_bio,
            'reading_time' => $request->reading_time,
            'tags'         => $request->tags
                ? json_encode(array_values(array_filter(array_map('trim', explode(',', $request->tags)))))
                : null,
        ];

        if ($request->status === 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        if ($request->hasFile('author_photo')) {
            if ($article->author_photo) {
                Storage::disk('public')->delete($article->author_photo);
            }
            $data['author_photo'] = $request->file('author_photo')->store('authors', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }
        if ($article->author_photo) {
            Storage::disk('public')->delete($article->author_photo);
        }
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    // Method baru: dipakai oleh route admin.articles.toggle (dari view baru)
    public function toggle($id)
    {
        $article         = Article::findOrFail($id);
        $article->status = $article->status === 'published' ? 'draft' : 'published';
        if ($article->status === 'published' && !$article->published_at) {
            $article->published_at = now();
        }
        $article->save();
        return response()->json(['status' => $article->status]);
    }

    // Method lama: tetap untuk backward-compat dengan route toggle-status
    public function toggleStatus($id)
    {
        return $this->toggle($id);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        $category = Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'type'        => 'article',
            'description' => null,
        ]);

        return response()->json([
            'success'  => true,
            'category' => ['id' => $category->id, 'name' => $category->name],
        ]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $path = $request->file('image')->store('articles/inline', 'public');

        return response()->json([
            'success' => true,
            'url'     => Storage::disk('public')->url($path),
        ]);
    }
}
