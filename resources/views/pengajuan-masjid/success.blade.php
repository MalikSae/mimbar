@extends('layouts.app')

@section('title', 'Pengajuan Berhasil — Yayasan Mimbar Al-Tauhid')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 80px 20px; text-align: center;">

    {{-- Logo Centered --}}
    <div style="margin-bottom: 40px;">
        <a href="{{ url('/') }}">
            <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-LIGHT-MODE.webp') }}" alt="Yayasan Mimbar Al-Tauhid" style="height: 56px; width: auto; margin: 0 auto;">
        </a>
    </div>

    {{-- Icon centang hijau --}}
    <div style="width: 96px; height: 96px; border-radius: 50%; background: var(--color-success-surface); display: flex; align-items: center; justify-content: center; margin: 0 auto 28px;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
        </svg>
    </div>

    <h1 style="font-family: var(--font-heading); font-size: 28px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 16px;">
        Pengajuan Berhasil Dikirim!
    </h1>

    <p style="font-size: 15px; color: var(--color-gray-600); line-height: 1.7; margin: 0 0 36px;">
        <em>Jazakumullah khairan</em> atas pengajuan Anda.<br>
        Tim Yayasan Mimbar Al-Tauhid akan meninjau proposal Anda dan menghubungi Anda melalui nomor yang telah dicantumkan.
    </p>

    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="{{ url('/') }}" style="display: inline-block; padding: 14px 32px; background: var(--color-primary); color: var(--color-white); text-decoration: none; border-radius: var(--radius-lg); font-weight: 600; font-size: 14px; font-family: var(--font-heading); transition: background 0.2s;"
           onmouseover="this.style.background='var(--color-primary-dark)'"
           onmouseout="this.style.background='var(--color-primary)'">
            Kembali ke Beranda
        </a>
        <a href="{{ route('program.pembangunan') }}" style="display: inline-block; padding: 14px 32px; background: var(--color-white); color: var(--color-primary); text-decoration: none; border-radius: var(--radius-lg); font-weight: 600; font-size: 14px; font-family: var(--font-heading); border: 1px solid var(--color-primary); transition: background 0.2s;"
           onmouseover="this.style.background='var(--color-primary-light)'"
           onmouseout="this.style.background='var(--color-white)'">
            Lihat Program Pembangunan
        </a>
    </div>
</div>
@endsection
