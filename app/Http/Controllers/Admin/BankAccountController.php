<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankAccountController extends Controller
{
    public function index()
    {
        $accounts = BankAccount::orderBy('sort_order')->orderBy('bank_name')->get();
        return view('admin.bank-accounts.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name'      => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name'   => 'required|string|max:150',
            'branch'         => 'nullable|string|max:150',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'is_active'      => 'boolean',
            'sort_order'     => 'integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('bank-logos', 'public');
        }

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        BankAccount::create($data);

        return back()->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $account = BankAccount::findOrFail($id);

        $data = $request->validate([
            'bank_name'      => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_name'   => 'required|string|max:150',
            'branch'         => 'nullable|string|max:150',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'is_active'      => 'boolean',
            'sort_order'     => 'integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            if ($account->logo) {
                Storage::disk('public')->delete($account->logo);
            }
            $data['logo'] = $request->file('logo')->store('bank-logos', 'public');
        }

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', $account->sort_order);

        $account->update($data);

        return back()->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $account = BankAccount::findOrFail($id);

        if ($account->logo) {
            Storage::disk('public')->delete($account->logo);
        }

        $account->delete();

        return back()->with('success', 'Rekening berhasil dihapus.');
    }

    public function toggle($id)
    {
        $account = BankAccount::findOrFail($id);
        $account->update(['is_active' => !$account->is_active]);
        return back()->with('success', 'Status rekening diperbarui.');
    }
}
