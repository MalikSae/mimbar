<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SeoSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'seo_meta_title' => Setting::get('seo_meta_title', 'Yayasan Mimbar Al-Tauhid'),
            'seo_meta_description' => Setting::get('seo_meta_description', ''),
            'seo_meta_keywords' => Setting::get('seo_meta_keywords', ''),
            'seo_google_site_verification' => Setting::get('seo_google_site_verification', ''),
            'seo_og_image' => Setting::get('seo_og_image', ''),
        ];

        return view('admin.seo-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'seo_meta_title' => 'nullable|string|max:255',
            'seo_meta_description' => 'nullable|string',
            'seo_meta_keywords' => 'nullable|string',
            'seo_google_site_verification' => 'nullable|string|max:255',
            'seo_og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        Setting::set('seo_meta_title', $request->input('seo_meta_title'));
        Setting::set('seo_meta_description', $request->input('seo_meta_description'));
        Setting::set('seo_meta_keywords', $request->input('seo_meta_keywords'));
        Setting::set('seo_google_site_verification', $request->input('seo_google_site_verification'));

        if ($request->hasFile('seo_og_image')) {
            $file = $request->file('seo_og_image');
            $path = $file->store('settings/seo', 'public');
            Setting::set('seo_og_image', $path);
        } elseif ($request->input('remove_og_image') === '1') {
            Setting::set('seo_og_image', null);
        }

        return redirect()->route('admin.seo-settings.index')->with('success', 'Pengaturan SEO berhasil diperbarui.');
    }
}
