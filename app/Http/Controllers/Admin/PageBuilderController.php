<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\PageBlock;
use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function editor(LandingPage $landingPage)
    {
        $landingPage->load(['blocks' => fn($q) => $q->orderBy('order'), 'campaign']);
        $blockTypes = PageBlock::TYPES;

        return view('admin.landing-pages.editor', compact('landingPage', 'blockTypes'));
    }

    public function storeBlock(Request $request, LandingPage $landingPage)
    {
        $validated = $request->validate([
            'type' => 'required|in:' . implode(',', PageBlock::TYPES),
        ]);

        $order = $landingPage->blocks()->count() + 1;
        
        $content = match($validated['type']) {
            'hero' => [
                'heading' => 'Judul Utama', 
                'subheading' => 'Deskripsi singkat campaign ini.', 
                'button_label' => 'Donasi Sekarang', 
                'button_url' => '/donasi', 
                'image_url' => ''
            ],
            'rich_text' => ['body' => '<p>Tulis konten di sini.</p>'],
            'image' => ['image_url' => '', 'alt' => '', 'caption' => ''],
            'donation_form' => ['campaign_title' => '', 'target_amount' => 0, 'show_progress' => true],
            'cta_button' => ['label' => 'Klik di Sini', 'url' => '/donasi', 'style' => 'primary'],
            'progress_bar' => ['label' => 'Terkumpul', 'current_amount' => 0, 'target_amount' => 0],
            'testimonial' => ['quote' => 'Tuliskan testimoni di sini.', 'author' => 'Nama Donatur', 'location' => ''],
            default => []
        };

        $block = $landingPage->blocks()->create([
            'type' => $validated['type'],
            'order' => $order,
            'content' => $content,
            'desktop_settings' => ['visible' => true, 'text_align' => 'left', 'padding' => 'medium', 'font_size' => 'base'],
            'mobile_settings' => ['visible' => true, 'text_align' => 'center', 'padding' => 'small', 'font_size' => 'base'],
        ]);

        return response()->json(['success' => true, 'block' => $block]);
    }

    public function updateBlock(Request $request, LandingPage $landingPage, PageBlock $block)
    {
        $validated = $request->validate([
            'content' => 'nullable|array',
            'desktop_settings' => 'nullable|array',
            'mobile_settings' => 'nullable|array',
        ]);

        $block->update($validated);

        return response()->json(['success' => true, 'block' => $block->fresh()]);
    }

    public function destroyBlock(Request $request, LandingPage $landingPage, PageBlock $block)
    {
        $block->delete();

        // Re-number order
        $blocks = $landingPage->blocks()->orderBy('order')->get();
        foreach ($blocks as $index => $b) {
            $b->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request, LandingPage $landingPage)
    {
        $validated = $request->validate([
            'blocks' => 'required|array',
            'blocks.*.id' => 'required|string',
            'blocks.*.order' => 'required|integer',
        ]);

        foreach ($validated['blocks'] as $b) {
            $landingPage->blocks()->where('id', $b['id'])->update(['order' => $b['order']]);
        }

        return response()->json(['success' => true]);
    }
}
