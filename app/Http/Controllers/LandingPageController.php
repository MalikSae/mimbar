<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function show(string $slug, Request $request)
    {
        $page = LandingPage::where('slug', $slug)->firstOrFail();

        if ($request->query('preview') !== 'true') {
            if ($page->status !== 'published') {
                abort(404);
            }
        }

        $page->load(['blocks' => fn($q) => $q->orderBy('order')]);

        $layout = $page->canvas_mode === 'full_page' ? 'layouts.app' : 'layouts.canvas';

        return view('lp.show', compact('page'));
    }
}
