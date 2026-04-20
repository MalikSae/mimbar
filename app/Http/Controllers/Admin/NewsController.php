<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $news       = $query->paginate(20)->withQueryString();
        $categories = Category::where('type', 'news')->orderBy('name')->get();

        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'news')->orderBy('name')->get();
        return view('admin.news.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'content'        => 'required|string',
            'status'         => 'required|in:draft,published',
            'location'       => 'nullable|string|max:100',
            'hijri_date'     => 'nullable|string|max:100',
            'tags'           => 'nullable|string',
            'featured_image' => 'nullable|image|max:4096',
            'gallery.*'      => 'nullable|image|max:4096',
            'title_ar'       => 'nullable|string|max:255',
            'excerpt_ar'     => 'nullable|string',
            'content_ar'     => 'nullable|string',
        ]);

        // Generate unique slug
        $slug     = Str::slug($request->title);
        $baseSlug = $slug;
        $count    = 2;
        while (News::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $data = [
            'title'        => $request->title,
            'slug'         => $slug,
            'category_id'  => $request->category_id,
            'content'      => $request->content,
            'status'       => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'location'     => $request->location,
            'hijri_date'   => $request->hijri_date,
            'tags'         => $request->tags
                ? json_encode(array_values(array_filter(array_map('trim', explode(',', $request->tags)))))
                : null,
            'title_ar'     => $request->title_ar,
            'excerpt_ar'   => $request->excerpt_ar,
            'content_ar'   => $request->content_ar,
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $news = News::create($data);

        // Upload gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $path = $file->store('news/gallery', 'public');
                DB::table('news_galleries')->insert([
                    'news_id'    => $news->id,
                    'file_path'  => $path,
                    'caption'    => null,
                    'order'      => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $news       = News::findOrFail($id);
        $categories = Category::where('type', 'news')->orderBy('name')->get();
        $galleries  = DB::table('news_galleries')
                        ->where('news_id', $id)
                        ->orderBy('order')
                        ->get();

        return view('admin.news.form', compact('news', 'categories', 'galleries'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'content'        => 'required|string',
            'status'         => 'required|in:draft,published',
            'location'       => 'nullable|string|max:100',
            'hijri_date'     => 'nullable|string|max:100',
            'tags'           => 'nullable|string',
            'featured_image' => 'nullable|image|max:4096',
            'gallery.*'      => 'nullable|image|max:4096',
            'title_ar'       => 'nullable|string|max:255',
            'excerpt_ar'     => 'nullable|string',
            'content_ar'     => 'nullable|string',
        ]);

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'status'      => $request->status,
            'location'    => $request->location,
            'hijri_date'  => $request->hijri_date,
            'tags'        => $request->tags
                ? json_encode(array_values(array_filter(array_map('trim', explode(',', $request->tags)))))
                : null,
            'title_ar'    => $request->title_ar,
            'excerpt_ar'  => $request->excerpt_ar,
            'content_ar'  => $request->content_ar,
        ];

        if ($request->status === 'published' && !$news->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $news->update($data);

        // Upload gallery baru
        if ($request->hasFile('gallery')) {
            $lastOrder = DB::table('news_galleries')->where('news_id', $id)->max('order') ?? -1;
            foreach ($request->file('gallery') as $index => $file) {
                $path = $file->store('news/gallery', 'public');
                DB::table('news_galleries')->insert([
                    'news_id'    => $news->id,
                    'file_path'  => $path,
                    'caption'    => null,
                    'order'      => $lastOrder + $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Hapus featured image
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        // Hapus semua gallery
        $galleries = DB::table('news_galleries')->where('news_id', $id)->get();
        foreach ($galleries as $gallery) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        DB::table('news_galleries')->where('news_id', $id)->delete();

        $news->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // Method baru: dipakai route admin.news.toggle (dari view baru)
    public function toggle($id)
    {
        $news         = News::findOrFail($id);
        $news->status = $news->status === 'published' ? 'draft' : 'published';
        if ($news->status === 'published' && !$news->published_at) {
            $news->published_at = now();
        }
        $news->save();
        return response()->json(['status' => $news->status]);
    }

    // Method lama: backward-compat
    public function toggleStatus($id)
    {
        return $this->toggle($id);
    }

    public function destroyGallery($id)
    {
        $gallery = DB::table('news_galleries')->where('id', $id)->first();
        if (!$gallery) {
            return back()->with('error', 'Foto tidak ditemukan.');
        }

        Storage::disk('public')->delete($gallery->file_path);
        DB::table('news_galleries')->where('id', $id)->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        $category = Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'type'        => 'news',
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

        $path = $request->file('image')->store('news/inline', 'public');

        return response()->json([
            'success' => true,
            'url'     => Storage::disk('public')->url($path),
        ]);
    }
}
