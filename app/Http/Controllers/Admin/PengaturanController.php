<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengurus = \App\Models\Pengurus::orderBy('urutan')->orderBy('id')->get();
        return view('admin.pengaturan.index', compact('pengurus'));
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
