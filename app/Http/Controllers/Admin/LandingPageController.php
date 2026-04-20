<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $landingPages = LandingPage::with('campaign')->latest()->paginate(15);
        return view('admin.landing-pages.index', compact('landingPages'));
    }

    public function create()
    {
        $campaigns = Campaign::orderBy('name')->get();
        return view('admin.landing-pages.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:landing_pages|max:255|regex:/^[a-z0-9-]+$/',
            'canvas_mode' => 'required|in:full_canvas,full_page',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        LandingPage::create($data);

        return redirect()->route('admin.landing-pages.index')
            ->with('success', 'Landing page berhasil dibuat.');
    }

    public function show(LandingPage $landingPage)
    {
        $landingPage->load(['campaign', 'blocks' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);
        
        return view('admin.landing-pages.show', compact('landingPage'));
    }

    public function edit(LandingPage $landingPage)
    {
        $campaigns = Campaign::orderBy('name')->get();
        return view('admin.landing-pages.edit', compact('landingPage', 'campaigns'));
    }

    public function update(Request $request, LandingPage $landingPage)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:landing_pages,slug,' . $landingPage->id . ',id|max:255|regex:/^[a-z0-9-]+$/',
            'canvas_mode' => 'required|in:full_canvas,full_page',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->all();
        if ($data['status'] === 'published' && !$landingPage->published_at) {
            $data['published_at'] = now();
        } elseif ($data['status'] === 'draft') {
            $data['published_at'] = null; // Opsional: bersihkan tgl jika dibatalkan
        }

        $landingPage->update($data);

        return redirect()->route('admin.landing-pages.index')
            ->with('success', 'Landing page berhasil diperbarui.');
    }

    public function destroy(LandingPage $landingPage)
    {
        $landingPage->delete();

        return redirect()->route('admin.landing-pages.index')
            ->with('success', 'Landing page berhasil dihapus.');
    }

    public function publish(LandingPage $landingPage)
    {
        $landingPage->status = 'published';
        if (!$landingPage->published_at) {
            $landingPage->published_at = now();
        }
        $landingPage->save();

        return back()->with('success', 'Landing page berhasil dipublish.');
    }

    public function unpublish(LandingPage $landingPage)
    {
        $landingPage->status = 'draft';
        $landingPage->save();

        return back()->with('success', 'Landing page dijadikan draft.');
    }
}
