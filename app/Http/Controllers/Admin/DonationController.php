<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Donation;
use App\Models\DonationProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
        $summary = [
            'total_verified' => Donation::where('status', 'verified')->sum('amount'),
            'total_pending'  => Donation::where('status', 'pending')->count(),
            'total_rejected' => Donation::where('status', 'rejected')->count(),
            'total_all'      => Donation::count(),
        ];

        $query = Donation::with('program')->orderByDesc('created_at');
        if (request('status'))  $query->where('status', request('status'));
        if (request('program')) $query->where('program_id', request('program'));
        if (request('dari'))    $query->whereDate('created_at', '>=', request('dari'));
        if (request('sampai'))  $query->whereDate('created_at', '<=', request('sampai'));

        $donations = $query->paginate(25)->withQueryString();
        $programs  = DonationProgram::orderBy('name')->get();

        return view('admin.donations.index', compact('donations', 'summary', 'programs'));
    }

    public function show($id)
    {
        $donation     = Donation::with('program')->findOrFail($id);
        $bankAccounts = BankAccount::where('is_active', 1)->orderBy('sort_order')->get();
        return view('admin.donations.show', compact('donation', 'bankAccounts'));
    }

    public function create()
    {
        $programs = DonationProgram::where('status', 'active')->orderBy('name')->get();
        return view('admin.donations.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id'   => 'required|exists:donation_programs,id',
            'amount'       => 'required|numeric|min:1000',
            'donor_name'   => 'nullable|string|max:100',
            'whatsapp'     => 'nullable|string|max:20',
            'message'      => 'nullable|string|max:500',
            'is_anonymous' => 'nullable',
        ]);

        $isAnonymous = $request->boolean('is_anonymous');
        $program     = DonationProgram::findOrFail($request->program_id);

        $donation = Donation::create([
            'program_id'      => $request->program_id,
            'reference_code'  => Donation::generateReferenceCode(),
            'donor_name'      => $isAnonymous ? 'Hamba Allah' : ($request->donor_name ?: 'Hamba Allah'),
            'donor_email'     => 'admin-' . time() . '@mimbar.test',
            'donor_phone'     => $request->whatsapp,
            'whatsapp'        => $request->whatsapp,
            'amount'          => $request->amount,
            'unique_code'     => 0,   // cash, tidak perlu kode unik
            'is_anonymous'    => $isAnonymous,
            'message'         => $request->message,
            'status'          => 'verified',
            'verified_at'     => now(),
            'notes'           => 'Donasi tunai — dicatat oleh admin.',
            'bank_destination' => 'CASH',
        ]);

        // Langsung update program
        $program->increment('collected_amount', $request->amount);
        $program->increment('donor_count');

        return redirect()->route('admin.donations.show', $donation->id)
                         ->with('success', 'Donasi tunai berhasil dicatat dan langsung terverifikasi.');
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'bank_destination' => 'nullable|string|max:100',
        ]);

        $donation = Donation::findOrFail($id);
        $donation->update([
            'status'           => 'verified',
            'verified_at'      => now(),
            'notes'            => $request->notes,
            'bank_destination' => $request->bank_destination ?: null,
        ]);

        // Update collected_amount dan donor_count di program
        if ($donation->program) {
            $donation->program->increment('collected_amount', $donation->amount);
            $donation->program->increment('donor_count');
        }

        return back()->with('success', 'Donasi berhasil diverifikasi.');
    }

    public function reject(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        $donation->update([
            'status' => 'rejected',
            'notes'  => $request->notes,
        ]);
        return back()->with('success', 'Donasi ditolak.');
    }

    public function export()
    {
        $donations = Donation::with('program')->orderByDesc('created_at')->get();

        $filename = 'donasi-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Program', 'Nama Donatur', 'WA', 'Nominal', 'Kode Unik', 'Status', 'Tanggal']);
            foreach ($donations as $d) {
                fputcsv($file, [
                    $d->id,
                    $d->program->name ?? '-',
                    $d->donor_name,
                    $d->whatsapp,
                    $d->amount,
                    $d->unique_code,
                    $d->status,
                    $d->created_at->format('d/m/Y H:i'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
