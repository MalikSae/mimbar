<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\EbookDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    /**
     * Daftar semua ebook — dengan filter & pagination.
     */
    public function index(Request $request)
    {
        $query = Ebook::orderByDesc('created_at');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $ebooks     = $query->paginate(15)->withQueryString();
        $categories = Ebook::select('category')->distinct()->whereNotNull('category')->orderBy('category')->pluck('category');

        return view('admin.ebooks.index', compact('ebooks', 'categories'));
    }

    /**
     * Form tambah ebook baru.
     */
    public function create()
    {
        $categories = Ebook::select('category')->distinct()->whereNotNull('category')->orderBy('category')->pluck('category');
        return view('admin.ebooks.form', compact('categories'));
    }

    /**
     * Simpan ebook baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'author'            => 'nullable|string|max:150',
            'category'          => 'required|string|max:100',
            'synopsis'          => 'nullable|string',
            'quote'             => 'nullable|string',
            'table_of_contents' => 'nullable|string',
            'page_count'        => 'nullable|integer|min:1',
            'year'              => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'is_featured'       => 'nullable|boolean',
            'status'            => 'required|in:active,inactive',
            'cover_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'file_pdf'          => 'nullable|file|mimes:pdf|max:20480',
        ]);

        // Generate unique slug
        $slug  = Str::slug($request->title);
        $base  = $slug;
        $count = 2;
        while (Ebook::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }

        $data = [
            'title'             => $request->title,
            'slug'              => $slug,
            'author'            => $request->author,
            'category'          => $request->category,
            'synopsis'          => $request->synopsis,
            'quote'             => $request->quote,
            'table_of_contents' => $request->table_of_contents,
            'page_count'        => $request->page_count,
            'year'              => $request->year,
            'is_featured'       => $request->boolean('is_featured'),
            'status'            => $request->status,
            'download_count'    => 0,
        ];

        // Upload cover image
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('ebooks/covers', 'public');
        }

        // Upload file PDF
        if ($request->hasFile('file_pdf')) {
            $file            = $request->file('file_pdf');
            $pdfPath         = $file->store('ebooks/files', 'public');
            $data['file_path'] = $pdfPath;
            $data['file_url']  = $pdfPath;
            $data['file_size'] = $this->formatFileSize($file->getSize());
        }

        Ebook::create($data);

        return redirect()->route('admin.ebooks.index')
            ->with('success', 'E-Book "' . $request->title . '" berhasil ditambahkan.');
    }

    /**
     * Form edit ebook.
     */
    public function edit($id)
    {
        $ebook      = Ebook::findOrFail($id);
        $categories = Ebook::select('category')->distinct()->whereNotNull('category')->orderBy('category')->pluck('category');
        return view('admin.ebooks.form', compact('ebook', 'categories'));
    }

    /**
     * Update ebook.
     */
    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        $request->validate([
            'title'             => 'required|string|max:255',
            'author'            => 'nullable|string|max:150',
            'category'          => 'required|string|max:100',
            'synopsis'          => 'nullable|string',
            'quote'             => 'nullable|string',
            'table_of_contents' => 'nullable|string',
            'page_count'        => 'nullable|integer|min:1',
            'year'              => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'is_featured'       => 'nullable|boolean',
            'status'            => 'required|in:active,inactive',
            'cover_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'file_pdf'          => 'nullable|file|mimes:pdf|max:20480',
        ]);

        // Slug hanya diperbarui jika judul berubah
        if ($ebook->title !== $request->title) {
            $slug  = Str::slug($request->title);
            $base  = $slug;
            $count = 2;
            while (Ebook::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            $ebook->slug = $slug;
        }

        $data = [
            'title'             => $request->title,
            'author'            => $request->author,
            'category'          => $request->category,
            'synopsis'          => $request->synopsis,
            'quote'             => $request->quote,
            'table_of_contents' => $request->table_of_contents,
            'page_count'        => $request->page_count,
            'year'              => $request->year,
            'is_featured'       => $request->boolean('is_featured'),
            'status'            => $request->status,
        ];

        // Replace cover image
        if ($request->hasFile('cover_image')) {
            if ($ebook->cover_image) {
                Storage::disk('public')->delete($ebook->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('ebooks/covers', 'public');
        }

        // Replace file PDF
        if ($request->hasFile('file_pdf')) {
            if ($ebook->file_path) {
                Storage::disk('public')->delete($ebook->file_path);
            }
            $file              = $request->file('file_pdf');
            $pdfPath           = $file->store('ebooks/files', 'public');
            $data['file_path'] = $pdfPath;
            $data['file_url']  = $pdfPath;
            $data['file_size'] = $this->formatFileSize($file->getSize());
        }

        $ebook->update($data);

        return redirect()->route('admin.ebooks.index')
            ->with('success', 'E-Book "' . $request->title . '" berhasil diperbarui.');
    }

    /**
     * Hapus ebook beserta file di storage.
     */
    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);

        if ($ebook->cover_image) {
            Storage::disk('public')->delete($ebook->cover_image);
        }
        if ($ebook->file_path) {
            Storage::disk('public')->delete($ebook->file_path);
        }

        $ebook->delete();

        return back()->with('success', 'E-Book berhasil dihapus.');
    }

    /**
     * Toggle status active/inactive via AJAX.
     */
    public function toggle($id)
    {
        $ebook         = Ebook::findOrFail($id);
        $ebook->status = $ebook->status === 'active' ? 'inactive' : 'active';
        $ebook->save();

        return response()->json(['status' => $ebook->status]);
    }

    /**
     * Halaman log download untuk satu ebook.
     */
    public function downloads($id)
    {
        $ebook = Ebook::findOrFail($id);

        $downloads = EbookDownload::where('ebook_id', $id)
            ->orderByDesc('downloaded_at')
            ->paginate(20);

        $stats = [
            'total'         => EbookDownload::where('ebook_id', $id)->count(),
            'want_donate'   => EbookDownload::where('ebook_id', $id)->where('want_donate', true)->count(),
            'total_nominal' => EbookDownload::where('ebook_id', $id)->where('want_donate', true)->sum('donation_amount'),
        ];

        return view('admin.ebooks.downloads', compact('ebook', 'downloads', 'stats'));
    }

    /**
     * Export log download sebagai CSV.
     */
    public function exportDownloads($id)
    {
        $ebook     = Ebook::findOrFail($id);
        $downloads = EbookDownload::where('ebook_id', $id)->orderByDesc('downloaded_at')->get();

        $filename = 'log-download-' . $ebook->slug . '-' . now()->format('Ymd') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($downloads) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['No', 'Nama', 'WhatsApp', 'Mau Infaq', 'Nominal Infaq', 'Waktu Download']);
            foreach ($downloads as $i => $d) {
                fputcsv($handle, [
                    $i + 1,
                    $d->name,
                    $d->whatsapp,
                    $d->want_donate ? 'Ya' : 'Tidak',
                    $d->donation_amount ?? 0,
                    $d->downloaded_at?->format('d/m/Y H:i'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Upload gambar dari WYSIWYG editor (TipTap).
     */
    public function uploadImage(Request $request)
    {
        try {
            $request->validate(['image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096']);
            $path = $request->file('image')->store('ebooks/images', 'public');
            return response()->json([
                'success' => true,
                'url'     => Storage::url($path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Format ukuran file ke string human-readable.
     */
    private function formatFileSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        }
        return round($bytes / 1024, 2) . ' KB';
    }
}
