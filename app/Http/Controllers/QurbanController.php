<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QurbanItem;
use App\Models\QurbanOrder;
use Illuminate\Support\Facades\DB;

class QurbanController extends Controller
{
    public function index()
    {
        $items = QurbanItem::where('is_available', true)
            ->orderBy('price')
            ->get();

        $stats = [
            'hewan_tersalurkan' => DB::table('settings')
                ->where('key', 'qurban_hewan_tersalurkan')
                ->value('value') ?? '1.140+',
            'tahun_aktif' => DB::table('settings')
                ->where('key', 'qurban_tahun_aktif')
                ->value('value') ?? '2017-2024',
        ];

        $faqs = DB::table('faqs')
            ->where('category', 'qurban')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('qurban.index', compact('items', 'stats', 'faqs'));
    }

    public function form($itemId)
    {
        $item = QurbanItem::where('id', $itemId)
            ->where('is_available', true)
            ->firstOrFail();

        $sapiTypes = ['sapi', 'sapi_kolektif', 'sapi_saham', 'sapi_penuh'];
        $shohibulCount = in_array(strtolower($item->type), $sapiTypes) ? 7 : 1;

        return view('qurban.form', compact('item', 'shohibulCount'));
    }

    public function store(Request $request, $itemId)
    {
        $item = QurbanItem::where('id', $itemId)
            ->where('is_available', true)
            ->firstOrFail();

        $sapiTypes = ['sapi', 'sapi_kolektif', 'sapi_saham', 'sapi_penuh'];
        $shohibulCount = in_array(strtolower($item->type), $sapiTypes) ? 7 : 1;

        $rules = [
            'donor_name'   => 'required|string|max:100',
            'whatsapp'     => 'required|string|max:20',
            'email'        => 'nullable|email|max:100',
            'is_anonymous' => 'nullable|boolean',
            'prayer'       => 'nullable|string|max:500',
        ];

        for ($i = 0; $i < $shohibulCount; $i++) {
            $rules["shohibul_{$i}"] = 'required|string|max:150';
        }

        $request->validate($rules);

        $orderNumber = 'QEN-' . date('Y') . '-' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $uniqueCode = rand(100, 999);
        $totalTransfer = $item->price + $uniqueCode;

        $order = QurbanOrder::create([
            'item_id'        => $item->id,
            'order_number'   => $orderNumber,
            'reference_code' => QurbanOrder::generateReferenceCode(),
            'donor_name'     => $request->boolean('is_anonymous') ? 'Hamba Allah' : $request->donor_name,
            'shohibul_name'  => $request->input('shohibul_0') ?? $request->donor_name,
            'phone'          => $request->whatsapp,
            'whatsapp'       => $request->whatsapp,
            'email'          => $request->email ?? 'donatur-' . time() . '@mimbar.test',
            'is_anonymous'   => $request->boolean('is_anonymous'),
            'prayer'         => $request->prayer,
            'unique_code'    => $uniqueCode,
            'quantity'       => 1,
            'total_amount'   => $totalTransfer,
            'status'         => 'pending_payment',
            'expired_at'     => now()->addHours(24),
        ]);

        for ($i = 0; $i < $shohibulCount; $i++) {
            DB::table('qurban_shohibul')->insert([
                'qurban_order_id' => $order->id,
                'shohibul_name'   => $request->input("shohibul_{$i}"),
                'order_position'  => $i + 1,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }

        return redirect()->route('qurban.instruction', $order->id);
    }

    public function instruction($orderId)
    {
        $order = QurbanOrder::with('item')->findOrFail($orderId);

        if (!in_array($order->status, ['pending_payment', 'pending_verification'])) {
            return redirect()->route('qurban.index')
                ->with('info', 'Pesanan ini sudah tidak aktif.');
        }

        $totalTransfer = $order->item->price + $order->unique_code;

        $shohibulNames = DB::table('qurban_shohibul')
            ->where('qurban_order_id', $order->id)
            ->orderBy('order_position')
            ->pluck('shohibul_name');

        $bankAccount = DB::table('bank_accounts')
            ->where('is_active', true)
            ->first();

        return view('qurban.instruction', compact('order', 'totalTransfer', 'shohibulNames', 'bankAccount'));
    }
}
