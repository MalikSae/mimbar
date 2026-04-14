<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DonationProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DonationProgramController extends Controller
{
    public function index()
    {
        $programs = DonationProgram::orderByDesc('created_at')->paginate(20);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $categories = Category::where('type', 'donation')->orderBy('name')->get();
        return view('admin.programs.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'required|string',
            'target_amount'    => 'required|integer|min:1',
            'status'           => 'required|in:active,inactive,completed',
            'category_id'      => 'required|exists:categories,id',
            'featured_image'   => 'nullable|image|max:4096',
            'deadline_date'    => 'nullable|date',
            'department'       => 'nullable|string|max:100',
            'specs'            => 'nullable|string',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->name);
        $base = $slug;
        $count = 2;
        while (DonationProgram::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }

        $data = [
            'name'             => $request->name,
            'slug'             => $slug,
            'description'      => $request->description,
            'target_amount'    => $request->target_amount,
            'status'           => $request->status,
            'category_id'      => $request->category_id,
            'deadline_date'    => $request->boolean('no_deadline') ? null : $request->deadline_date,
            'department'       => $request->department,
            'collected_amount' => 0,
            'donor_count'      => 0,
        ];

        // Specs: validasi JSON dan simpan
        if ($request->filled('specs')) {
            $decoded = json_decode($request->specs, true);
            $data['specs'] = is_array($decoded) ? $decoded : null;
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('programs', 'public');
        }

        DonationProgram::create($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program donasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $program    = DonationProgram::findOrFail($id);
        $categories = Category::where('type', 'donation')->orderBy('name')->get();
        return view('admin.programs.form', compact('program', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $program = DonationProgram::findOrFail($id);

        $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'required|string',
            'target_amount'    => 'required|integer|min:1',
            'status'           => 'required|in:active,inactive,completed',
            'category_id'      => 'required|exists:categories,id',
            'featured_image'   => 'nullable|image|max:4096',
            'deadline_date'    => 'nullable|date',
            'department'       => 'nullable|string|max:100',
            'specs'            => 'nullable|string',
        ]);

        // Slug hanya diperbarui jika nama berubah
        if ($program->name !== $request->name) {
            $slug = Str::slug($request->name);
            $base = $slug;
            $count = 2;
            while (DonationProgram::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            $program->slug = $slug;
        }

        $data = [
            'name'             => $request->name,
            'description'      => $request->description,
            'target_amount'    => $request->target_amount,
            'status'           => $request->status,
            'category_id'      => $request->category_id,
            'deadline_date'    => $request->boolean('no_deadline') ? null : $request->deadline_date,
            'department'       => $request->department,
        ];

        if ($request->filled('specs')) {
            $decoded = json_decode($request->specs, true);
            $data['specs'] = is_array($decoded) ? $decoded : null;
        }

        if ($request->hasFile('featured_image')) {
            if ($program->featured_image) {
                Storage::disk('public')->delete($program->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('programs', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program donasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $program = DonationProgram::findOrFail($id);
        if ($program->featured_image) {
            Storage::disk('public')->delete($program->featured_image);
        }
        $program->delete();
        return back()->with('success', 'Program donasi berhasil dihapus.');
    }

    public function toggle($id)
    {
        $program = DonationProgram::findOrFail($id);
        $program->status = $program->status === 'active' ? 'inactive' : 'active';
        $program->save();
        return response()->json(['status' => $program->status]);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        // Check if exists to prevent duplicate name within donation type
        $exists = Category::where('name', $request->name)->where('type', 'donation')->first();
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori dengan nama ini sudah ada.',
            ]);
        }

        $category = Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'type'        => 'donation',
            'description' => null,
        ]);

        return response()->json([
            'success'  => true,
            'category' => ['id' => $category->id, 'name' => $category->name],
        ]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $path = $request->file('image')->store('programs/inline', 'public');

        return response()->json([
            'success' => true,
            'url'     => Storage::disk('public')->url($path),
        ]);
    }
}
