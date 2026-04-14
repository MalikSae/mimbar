<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationProgram;
use App\Models\Donation;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
        // Kategori filter tab
        $categories = Category::where('type', 'donation')->get();

        // Query program donasi aktif dengan filter
        $query = DonationProgram::with('category')->where('status', 'active')
            ->orderByDesc('created_at');

        if (request('kategori') && request('kategori') !== 'semua') {
            $selectedCategory = Category::where('slug', request('kategori'))->first();
            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        $programs = $query->paginate(9);

        // Rekening bank aktif untuk section metode pembayaran
        $bankAccounts = DB::table('bank_accounts')
            ->where('is_active', true)
            ->get();

        // Highlight program qurban untuk banner khusus
        $qurbanHighlight = DB::table('settings')
            ->where('key', 'qurban_hewan_tersalurkan')
            ->value('value') ?? '1.140+';

        return view('donasi.index', compact('programs', 'categories', 'bankAccounts', 'qurbanHighlight'));
    }

    public function show($slug)
    {
        $program = DonationProgram::with('category')->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Progress menggunakan accessor $program->progress_percentage
        // Days remaining dihitung dari deadline_date (casting ke date)
        $program->days_remaining = $program->deadline_date
            ? max(0, now()->diffInDays($program->deadline_date, false))
            : null;

        // Donor count
        $program->donor_count = Donation::where('program_id', $program->id)
            ->where('status', 'verified')
            ->count();

        // Program lain untuk section "Lanjutkan Estafet Kebaikan"
        $related = DonationProgram::with('category')->where('status', 'active')
            ->where('id', '!=', $program->id)
            ->take(3)
            ->get();

        return view('donasi.show', compact('program', 'related'));
    }

    public function form($slug)
    {
        $program = DonationProgram::where('slug', $slug)->firstOrFail();
        return view('donasi.form', compact('program'));
    }

    public function checkout(Request $request, $slug)
    {
        $program = DonationProgram::where('slug', $slug)->firstOrFail();

        $request->validate([
            'amount'       => 'required|integer|min:10000',
            'donor_name'   => 'required|string|max:100',
            'whatsapp'     => 'nullable|string|max:20',
            'message'      => 'nullable|string|max:500',
            'is_anonymous' => 'nullable|boolean',
        ]);

        // Generate kode unik 3 digit
        $uniqueCode = rand(100, 999);
        $totalTransfer = $request->amount + $uniqueCode;

        // Simpan donasi ke database
        $donation = Donation::create([
            'program_id'       => $program->id,
            'reference_code'   => Donation::generateReferenceCode(),
            'donor_name'       => $request->boolean('is_anonymous') ? 'Hamba Allah' : $request->donor_name,
            'donor_email'      => 'donatur-' . time() . '@mimbar.test', // Dummy fallback for old schema
            'donor_phone'      => $request->whatsapp,                   // Map whatsapp to old field too
            'amount'           => $request->amount,
            'whatsapp'         => $request->whatsapp,
            'message'          => $request->message,
            'bank_destination' => 'BSI (Otomatis)',                     // Dummy fallback for old schema
            'is_anonymous'     => $request->boolean('is_anonymous'),
            'unique_code'      => $uniqueCode,
            'status'           => 'pending',
            'expired_at'       => now()->addHours(24),
        ]);

        // Redirect ke halaman instruksi
        return redirect()->route('donations.instruction', $donation->id);
    }

    public function instruction($donationId)
    {
        $donation = Donation::with('program')->findOrFail($donationId);

        // Pastikan donasi masih pending (belum expired)
        if ($donation->status !== 'pending') {
            return redirect()->route('donations.index')
                ->with('info', 'Donasi ini sudah tidak aktif.');
        }

        $totalTransfer = $donation->amount + $donation->unique_code;

        // Rekening bank aktif
        $bankAccount = DB::table('bank_accounts')
            ->where('is_active', true)
            ->first();

        return view('donasi.instruction', compact('donation', 'totalTransfer', 'bankAccount'));
    }
}
