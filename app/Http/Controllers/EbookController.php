<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\EbookDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EbookController extends Controller
{
    /**
     * Katalog e-book (index).
     */
    public function index()
    {
        $featured = Ebook::where('is_featured', true)->latest()->first();

        $categories = Ebook::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        $ebookQuery = Ebook::orderByDesc('created_at');

        if (request('kategori') && request('kategori') !== 'semua') {
            $ebookQuery->where('category', request('kategori'));
        }
        if (request('cari')) {
            $ebookQuery->where('title', 'like', '%' . request('cari') . '%');
        }

        $ebooks = $ebookQuery->paginate(8);

        return view('pustaka.index', compact('featured', 'categories', 'ebooks'));
    }

    /**
     * Halaman detail e-book.
     */
    public function show($slug)
    {
        $ebook = Ebook::where('slug', $slug)->firstOrFail();

        $related = Ebook::where('category', $ebook->category)
            ->where('id', '!=', $ebook->id)
            ->take(4)
            ->get();

        return view('pustaka.show', compact('ebook', 'related'));
    }

    /**
     * Proses permintaan download e-book.
     */
    public function download(Request $request, $slug)
    {
        $ebook = Ebook::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name'            => 'required|string|max:100',
            'whatsapp'        => 'required|string|max:20',
            'want_donate'     => 'nullable|boolean',
            'donation_amount' => 'nullable|integer|min:0',
        ]);

        // Generate kode unik 3 digit untuk verifikasi transfer
        $uniqueCode = rand(100, 999);
        $totalTransfer = ($request->donation_amount ?? 0) + $uniqueCode;

        // Simpan log download
        EbookDownload::create([
            'ebook_id'        => $ebook->id,
            'name'            => $request->name,
            'whatsapp'        => $request->whatsapp,
            'want_donate'     => $request->boolean('want_donate'),
            'donation_amount' => $request->boolean('want_donate') ? ($request->donation_amount ?? 0) : null,
            'unique_code'     => $request->boolean('want_donate') ? $uniqueCode : null,
            'total_transfer'  => $request->boolean('want_donate') ? $totalTransfer : null,
            'payment_status'  => $request->boolean('want_donate') ? 'pending' : null,
            'downloaded_at'   => now(),
        ]);

        // Jika TIDAK mau infaq → return sukses + URL download langsung
        if (!$request->boolean('want_donate')) {
            return response()->json([
                'status'       => 'success',
                'download_url' => asset('storage/' . $ebook->file_url),
                'message'      => 'Jazakumullah khairan! File siap diunduh.',
            ]);
        }

        // Jika mau infaq → return data instruksi pembayaran
        $bankAccounts = DB::table('bank_accounts')->where('is_active', true)->get();

        return response()->json([
            'status'          => 'infaq',
            'unique_code'     => $uniqueCode,
            'total_transfer'  => $totalTransfer,
            'donation_amount' => $request->donation_amount,
            'ebook_title'     => $ebook->title,
            'whatsapp'        => $request->whatsapp,
            'bank_accounts'   => $bankAccounts->map(fn($b) => [
                'bank_name'      => $b->bank_name,
                'bank_code'      => $b->bank_code ?? '',
                'account_number' => $b->account_number,
                'account_name'   => $b->account_name,
            ])->toArray(),
            'expired_at'      => now()->addHours(24)->toISOString(),
            'wa_admin'        => DB::table('settings')->where('key', 'admin_wa')->value('value') ?? '+62 823 1111 9499',
        ]);
    }
}
