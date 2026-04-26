<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admin.admin-accounts.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin-accounts.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['super_admin', 'publisher'])],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('admin.admin-accounts.index')->with('success', 'Akun admin berhasil ditambahkan.');
    }

    public function edit(Admin $adminAccount)
    {
        $admin = $adminAccount;
        return view('admin.admin-accounts.form', compact('admin'));
    }

    public function update(Request $request, Admin $adminAccount)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($adminAccount->id)],
            'role' => ['required', Rule::in(['super_admin', 'publisher'])],
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $adminAccount->update($validated);

        return redirect()->route('admin.admin-accounts.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(Admin $adminAccount)
    {
        if (auth('admin')->id() === $adminAccount->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $adminAccount->delete();

        return redirect()->route('admin.admin-accounts.index')->with('success', 'Akun admin berhasil dihapus.');
    }
}
