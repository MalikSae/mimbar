@extends('layouts.app')

@section('title', 'Program Dakwah - Yayasan Mimbar Al-Tauhid')

@section('content')
<main class="min-h-[60vh] flex items-center justify-center bg-gray-50">
    <div class="text-center px-4">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-light text-primary mb-6">
            <iconify-icon icon="lucide:book-open" width="32"></iconify-icon>
        </div>
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">Program Dakwah</h1>
        <p class="text-gray-600 mb-8 text-lg">Halaman sedang dalam tahap pengembangan.</p>
        <a href="{{ route('program.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-heading font-semibold rounded-lg hover:bg-primary-dark transition-colors">
            <iconify-icon icon="lucide:arrow-left"></iconify-icon>
            Kembali ke Semua Program
        </a>
    </div>
</main>
@endsection
