<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationProgram;
use App\Models\Article;
use App\Models\News;
use App\Models\Ebook;
use App\Models\Campaign;

class SitemapController extends Controller
{
    public function generate()
    {
        $urlsCount = self::generateXml();
        return redirect()->back()->with('success', 'Sitemap berhasil di-generate. (' . $urlsCount . ' URL ditemukan)');
    }

    public static function generateXml()
    {
        $urls = [
            url('/'),
            route('about.index'),
            route('program.index'),
            route('program.pembangunan'),
            route('program.dakwah'),
            route('program.pendidikan'),
            route('program.sosial'),
            route('berita-artikel.index'),
            route('mimbartv.index'),
            route('donations.index'),
            route('qurban.campaign.index'),
            route('ebooks.index'),
            route('masjid.proposal.index'),
        ];

        // Get Published Donation Programs
        $programs = DonationProgram::active()->get();
        foreach ($programs as $p) {
            $urls[] = route('donations.show', $p->slug);
        }

        // Get Published Articles
        $articles = Article::where('status', 'published')->get();
        foreach ($articles as $a) {
            $urls[] = route('artikel.show', $a->slug);
        }

        // Get Published News
        $news = News::where('status', 'published')->get();
        foreach ($news as $n) {
            $urls[] = route('berita.show', $n->slug);
        }

        // Get Published Ebooks
        $ebooks = Ebook::active()->get();
        foreach ($ebooks as $e) {
            $urls[] = route('ebooks.show', $e->slug);
        }

        // Pagebuilder Landing Pages
        $landingPages = \App\Models\LandingPage::where('status', 'published')->get();
        foreach ($landingPages as $lp) {
            $urls[] = url('/lp/' . $lp->slug);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        try {
            // Save to public path
            $path = public_path('sitemap.xml');
            file_put_contents($path, $xml);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal generate sitemap: ' . $e->getMessage());
        }

        return count($urls);
    }
}
