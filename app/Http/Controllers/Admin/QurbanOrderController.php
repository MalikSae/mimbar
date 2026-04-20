<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\QurbanOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QurbanOrderController extends Controller
{
    public function index()
    {
        $summary = [
            'total_pending'  => QurbanOrder::where('status', 'pending_payment')->count(),
            'total_verified' => QurbanOrder::where('status', 'confirmed')->count(),
            'total_rejected' => QurbanOrder::where('status', 'rejected')->count(),
            'total_all'      => QurbanOrder::count(),
        ];

        $query = QurbanOrder::with('item')->orderByDesc('created_at');
        if (request('status')) $query->where('status', request('status'));
        if (request('tipe'))   $query->whereHas('item', fn($q) => $q->where('type', request('tipe')));
        if (request('dari'))   $query->whereDate('created_at', '>=', request('dari'));
        if (request('sampai')) $query->whereDate('created_at', '<=', request('sampai'));

        $orders = $query->paginate(25)->withQueryString();

        return view('admin.qurban.orders.index', compact('orders', 'summary'));
    }

    public function show($id)
    {
        $order = QurbanOrder::with('item')->findOrFail($id);
        $shohibulNames = DB::table('qurban_shohibul')
            ->where('qurban_order_id', $id)
            ->orderBy('order_position')
            ->get();
        $bankAccounts = BankAccount::where('is_active', 1)->orderBy('sort_order')->get();
        return view('admin.qurban.orders.show', compact('order', 'shohibulNames', 'bankAccounts'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'bank_destination' => 'nullable|string|max:100',
        ]);

        $order = QurbanOrder::findOrFail($id);
        $order->update([
            'status'           => 'confirmed',
            'notes'            => $request->notes,
            'bank_destination' => $request->bank_destination ?: null,
        ]);
        return back()->with('success', 'Pesanan qurban berhasil dikonfirmasi.');
    }

    public function reject(Request $request, $id)
    {
        $order = QurbanOrder::findOrFail($id);
        $order->update([
            'status' => 'rejected',
            'notes'  => $request->notes,
        ]);
        return back()->with('success', 'Pesanan ditolak.');
    }

    public function export()
    {
        $orders = QurbanOrder::with('item')->orderByDesc('created_at')->get();

        $filename = 'pesanan-qurban-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No. Pesanan', 'Hewan', 'Donor', 'WA', 'Nama Shohibul', 'Nominal', 'Kode Unik', 'Status', 'Tanggal']);
            foreach ($orders as $o) {
                $shohibul = DB::table('qurban_shohibul')
                    ->where('qurban_order_id', $o->id)
                    ->orderBy('order_position')
                    ->pluck('shohibul_name')
                    ->join(', ');
                fputcsv($file, [
                    $o->order_number,
                    $o->item->name ?? '-',
                    $o->donor_name,
                    $o->whatsapp,
                    $shohibul,
                    $o->item->price ?? 0,
                    $o->unique_code,
                    $o->status,
                    $o->created_at->format('d/m/Y H:i'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
