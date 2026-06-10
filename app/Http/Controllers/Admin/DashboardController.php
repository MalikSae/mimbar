<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationProgram;
use App\Models\Article;
use App\Models\QurbanOrder;
use App\Models\Ebook;
use App\Models\IntegrationSetting;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth('admin')->check() && auth('admin')->user()->isPembangun()) {
            return redirect()->route('admin.masjid.index');
        }

        $user = auth('admin')->user();
        $isSuperAdmin = $user->isSuperAdmin();
        $isPublisher = $user->isPublisher();

        $stats = [
            'artikel_published' => Article::where('status', 'published')->count(),
            'ebook_downloads' => Ebook::sum('download_count'),
        ];

        if ($isSuperAdmin) {
            $stats['donasi_bulan_ini'] = Donation::where('status', 'verified')
                ->whereMonth('verified_at', now()->month)
                ->whereYear('verified_at', now()->year)
                ->sum('amount');

            $stats['donasi_pending'] = Donation::where('status', 'pending')->count();

            $stats['total_donatur'] = Donation::where('status', 'verified')
                ->distinct('donor_email')
                ->count('donor_email');

            $stats['qurban_aktif'] = QurbanOrder::whereIn('status', [
                'pending_payment', 'pending_verification', 'confirmed'
            ])->count();
            
            $recentDonations = Donation::with('program')
                ->latest()
                ->take(5)
                ->get();
                
            $programs = DonationProgram::active()->take(4)->get();
        } else {
            $recentDonations = collect();
            $programs = collect();
        }

        $recentArticles = Article::with('category')
            ->published()
            ->take(5)
            ->get();

        // GA4 Analytics Data
        $gaActive = IntegrationSetting::getValue('ga4_active') === '1';
        $gaPropertyId = IntegrationSetting::getValue('ga4_property_id');
        $gaCredentials = IntegrationSetting::getValue('ga4_credentials_json');

        $analyticsData = null;
        $analyticsError = null;
        $gaConfigured = false;

        if ($gaActive && $gaPropertyId && $gaCredentials) {
            $gaConfigured = true;
            try {
                config(['analytics.property_id' => $gaPropertyId]);
                config(['analytics.service_account_credentials_json' => storage_path('app/' . $gaCredentials)]);
                
                $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
            } catch (\Exception $e) {
                $analyticsError = $e->getMessage();
            }
        }

        return view('admin.dashboard.index', compact(
            'stats', 'recentDonations', 'programs', 'recentArticles', 'isSuperAdmin', 'isPublisher', 'analyticsData', 'analyticsError', 'gaConfigured'
        ));
    }
}
