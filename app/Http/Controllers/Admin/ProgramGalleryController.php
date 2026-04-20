<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProgramGalleryController extends Controller
{
    public function index()
    {
        $galleries = DB::table('program_galleries')
            ->orderBy('program_type')
            ->orderBy('order')
            ->paginate(20);

        $programTypes = ['dakwah', 'pendidikan', 'sosial', 'pembangunan', 'qurban', 'slider_home'];

        return view('admin.program-gallery.index', compact('galleries', 'programTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_type' => 'required|in:dakwah,pendidikan,sosial,pembangunan,qurban,slider_home',
            'photos'       => 'required|array',
            'photos.*'     => 'required|image|max:4096',
        ]);

        foreach ($request->file('photos') as $index => $file) {
            $path = $file->store('programs/gallery', 'public');

            DB::table('program_galleries')->insert([
                'program_type' => $request->program_type,
                'file_path'    => $path,
                'order'        => $index,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        return back()->with('success', 'Foto berhasil diupload.');
    }

    public function destroy($id)
    {
        $photo = DB::table('program_galleries')->where('id', $id)->first();

        if ($photo) {
            Storage::disk('public')->delete($photo->file_path);
            DB::table('program_galleries')->where('id', $id)->delete();
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function sliderHome()
    {
        // Convert to Model or use DB -> we should just use DB or Model. The instructions said GaleriProgram::, but here it's DB facade.
        // Let's use DB table for consistency with this controller.
        $images = DB::table('program_galleries')
            ->where('program_type', 'slider_home')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'file_path as foto', 'created_at']);
        
        return response()->json($images);
    }
}
