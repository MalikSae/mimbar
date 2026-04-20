<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenulisController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('articles')->latest()->get();
        return view('admin.penulis.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.penulis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:authors,email',
            'password' => 'required|min:8|confirmed',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio'      => 'nullable|string|max:1000',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars/authors', 'public');
        }

        Author::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'is_active' => true,
            'avatar'    => $avatarPath,
            'bio'       => $request->bio,
        ]);

        return redirect()->route('admin.penulis.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function edit(Author $author)
    {
        return view('admin.penulis.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:authors,email,' . $author->id,
            'avatar'                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio'                   => 'nullable|string|max:1000',
            'password'              => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'bio'   => $request->bio,
        ];

        // Upload avatar baru jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama
            if ($author->avatar) {
                Storage::disk('public')->delete($author->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars/authors', 'public');
        }

        // Ganti password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $author->update($data);

        return redirect()->route('admin.penulis.index')
            ->with('success', 'Data penulis berhasil diperbarui.');
    }

    public function toggle(Author $author)
    {
        $author->is_active = !$author->is_active;
        $author->save();

        $status = $author->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun penulis berhasil {$status}.");
    }

    public function destroy(Author $author)
    {
        if ($author->avatar) {
            Storage::disk('public')->delete($author->avatar);
        }
        $author->delete();

        return redirect()->route('admin.penulis.index')
            ->with('success', 'Penulis berhasil dihapus.');
    }
}
