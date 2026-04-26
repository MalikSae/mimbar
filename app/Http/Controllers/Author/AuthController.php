<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('author.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->guard('author')->attempt($credentials)) {
            $request->session()->regenerate();

            Log::info('Author login berhasil', [
                'author' => auth()->guard('author')->user()->email,
                'ip'     => $request->ip(),
                'time'   => now()->toDateTimeString(),
            ]);

            return redirect()->route('author.dashboard');
        }

        Log::warning('Author login gagal', [
            'email' => $request->email,
            'ip'    => $request->ip(),
            'time'  => now()->toDateTimeString(),
        ]);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        auth()->guard('author')->logout();
        return redirect()->route('author.login');
    }
}
