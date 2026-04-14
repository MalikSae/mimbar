<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationProgram;
use App\Models\Article;
use App\Models\QurbanOrder;
use App\Models\Ebook;

class DashboardController extends Controller
{
    public function index()
    {
        // Stat cards
        $stats = [
            'donasi_bulan_ini' => Donation::where('status', 'verified')
                ->whereMonth('verified_at', now()->month)
                ->whereYear('verified_at', now()->year)
                ->sum('amount'),

            'donasi_pending' => Donation::where('status', 'pending')->count(),

            'total_donatur' => Donation::where('status', 'verified')
                ->distinct('donor_email')
                ->count('donor_email'),

            'artikel_published' => Article::where('status', 'published')->count(),

            'qurban_aktif' => QurbanOrder::whereIn('status', [
                'pending_payment', 'pending_verification', 'confirmed'
            ])->count(),

            'ebook_downloads' => Ebook::sum('download_count'),
        ];

        // Donasi terbaru (5 terakhir)
        $recentDonations = Donation::with('program')
            ->latest()
            ->take(5)
            ->get();

        // Program donasi aktif dengan progress
        $programs = DonationProgram::active()->take(4)->get();

        // Artikel terbaru
        $recentArticles = Article::with('category')
            ->published()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats', 'recentDonations', 'programs', 'recentArticles'
        ));
    }
}
