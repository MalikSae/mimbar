<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.settings.tentangKami');
    }

    // ==========================================
    // TENTANG KAMI
    // ==========================================
    public function tentangKami()
    {
        $settings = [
            'headline'      => SiteSetting::get('tentang_headline', 'Mengenal Yayasan Mimbar Al-Tauhid'),
            'sub_headline'  => SiteSetting::get('tentang_sub_headline', ''),
            'video_youtube' => SiteSetting::get('tentang_video_youtube', ''),
        ];
        
        $pengurus = \App\Models\Pengurus::orderBy('urutan')->orderBy('id')->get();
        
        return view('admin.pengaturan.tentang-kami', compact('settings', 'pengurus'));
    }

    public function simpanTentangKami(Request $request)
    {
        $request->validate([
            'headline' => 'string|nullable|max:255',
            'sub_headline' => 'string|nullable|max:500',
            'video_youtube' => 'string|nullable|url',
        ]);

        SiteSetting::set('tentang_headline', $request->input('headline'));
        SiteSetting::set('tentang_sub_headline', $request->input('sub_headline'));
        SiteSetting::set('tentang_video_youtube', $request->input('video_youtube'));

        return redirect()->route('admin.settings.tentangKami')
            ->with('success', 'Pengaturan section hero Tentang Kami berhasil disimpan.');
    }

    public function tambahPengurus(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:150',
            'nama' => 'required|string|max:150',
        ]);

        $urutan = \App\Models\Pengurus::max('urutan') + 1;
        
        $pengurus = \App\Models\Pengurus::create([
            'jabatan' => $request->input('jabatan'),
            'nama' => $request->input('nama'),
            'urutan' => $urutan
        ]);

        return response()->json([
            'success' => true, 
            'id' => $pengurus->id, 
            'jabatan' => $pengurus->jabatan, 
            'nama' => $pengurus->nama
        ]);
    }

    public function updatePengurus(Request $request, $id)
    {
        $request->validate([
            'jabatan' => 'required|string|max:150',
            'nama' => 'required|string|max:150',
        ]);

        $pengurus = \App\Models\Pengurus::findOrFail($id);
        $pengurus->update([
            'jabatan' => $request->input('jabatan'),
            'nama' => $request->input('nama'),
        ]);

        return response()->json(['success' => true]);
    }

    public function hapusPengurus($id)
    {
        $pengurus = \App\Models\Pengurus::findOrFail($id);
        $pengurus->delete();

        return response()->json(['success' => true]);
    }
}
