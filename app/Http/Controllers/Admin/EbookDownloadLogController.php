<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\EbookDownload;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EbookDownloadLogController extends Controller
{
    /**
     * Tampilkan semua log unduhan lintas E-book.
     */
    public function index(Request $request)
    {
        $ebooks = Ebook::orderBy('title')->get();
        $query = EbookDownload::with('ebook')->orderByDesc('created_at');

        // Filtering by E-book
        if ($request->filled('ebook_id')) {
            $query->where('ebook_id', $request->ebook_id);
        }

        // Filtering by Infaq option
        if ($request->filled('infaq')) {
            if ($request->infaq === 'yes') {
                $query->where('want_donate', true);
            } elseif ($request->infaq === 'no') {
                $query->where('want_donate', false);
            }
        }

        // Filtering by Payment Status
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('want_donate', true)
                      ->where(function($q) {
                          $q->where('payment_status', 'pending')
                            ->orWhereNull('payment_status');
                      });
            } else {
                $query->where('payment_status', $request->status);
            }
        }

        // Search Name/WA
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        // Calculate statistics
        $stats = [
            'total' => EbookDownload::count(),
            'want_donate' => EbookDownload::where('want_donate', true)->count(),
            'total_nominal' => EbookDownload::where('want_donate', true)
                ->sum(DB::raw('COALESCE(total_transfer, donation_amount)')),
            'total_verified' => EbookDownload::where('want_donate', true)->where('payment_status', 'verified')->count()
        ];

        $bankAccounts = BankAccount::where('is_active', 1)->orderBy('sort_order')->get();

        return view('admin.ebook-downloads-global.index', compact('logs', 'ebooks', 'stats', 'bankAccounts'));
    }

    /**
     * Verify Infaq
     */
    public function verify(Request $request, $id)
    {
        $request->validate([
            'bank_destination' => 'nullable|string|max:100',
        ]);

        $log = EbookDownload::findOrFail($id);
        
        if (!$log->want_donate) {
            return response()->json(['success' => false, 'message' => 'Bukan jenis unduhan infaq.'], 400);
        }

        $log->update([
            'payment_status'   => 'verified',
            'bank_destination' => $request->bank_destination ?: null,
        ]);

        return response()->json(['success' => true, 'message' => 'Infaq berhasil diverifikasi.']);
    }

    /**
     * Reject Infaq
     */
    public function reject($id)
    {
        $log = EbookDownload::findOrFail($id);
        
        if (!$log->want_donate) {
            return response()->json(['success' => false, 'message' => 'Bukan jenis unduhan infaq.'], 400);
        }

        $log->update(['payment_status' => 'rejected']);

        return response()->json(['success' => true, 'message' => 'Infaq ditolak.']);
    }

    /**
     * Export Log Download CSV
     */
    public function export(Request $request)
    {
        $query = EbookDownload::with('ebook')->orderByDesc('created_at');

        if ($request->filled('ebook_id')) {
            $query->where('ebook_id', $request->ebook_id);
        }
        if ($request->filled('infaq')) {
            if ($request->infaq === 'yes') {
                $query->where('want_donate', true);
            } elseif ($request->infaq === 'no') {
                $query->where('want_donate', false);
            }
        }
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('want_donate', true)
                      ->where(function($q) {
                          $q->where('payment_status', 'pending')
                            ->orWhereNull('payment_status');
                      });
            } else {
                $query->where('payment_status', $request->status);
            }
        }

        $logs = $query->get();

        $filename = 'Semua_Log_Unduhan_Ebook_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($logs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'ID', 'Tanggal Download', 'E-Book', 'Nama', 'WhatsApp', 
                'Infaq', 'Tagihan / Total Transfer', 'Status Pembayaran'
            ]);

            foreach ($logs as $log) {
                $infaqStatus = $log->want_donate ? 'Ya' : 'Tidak';
                $nominal = $log->want_donate ? ($log->total_transfer ?? $log->donation_amount ?? 0) : 0;
                $statusPay = $log->want_donate ? ($log->payment_status ?: 'pending') : 'Selesai';
                
                fputcsv($file, [
                    $log->id,
                    $log->downloaded_at?->format('Y-m-d H:i:s'),
                    $log->ebook->title ?? '-',
                    $log->name,
                    $log->whatsapp,
                    $infaqStatus,
                    $nominal,
                    $statusPay
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
