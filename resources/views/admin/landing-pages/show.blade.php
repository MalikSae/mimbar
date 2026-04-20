@extends('layouts.admin')
@section('title', 'Detail Landing Page')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.landing-pages.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">&larr; Kembali</a>
        <div class="space-x-2">
            <a href="{{ route('admin.landing-pages.edit', $landingPage) }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Edit Landing Page
            </a>
            @if($landingPage->status === 'published')
                <a href="/lp/{{ $landingPage->slug }}" target="_blank" class="bg-white border border-border text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors inline-block">
                    Lihat Halaman &rarr;
                </a>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-border overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-border bg-gray-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Informasi Landing Page
            </h3>
        </div>
        <div class="px-6 py-5">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Judul (Title)</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $landingPage->title }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">/lp/{{ $landingPage->slug }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Campaign Terkait</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $landingPage->campaign->name }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Mode Canvas</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($landingPage->canvas_mode === 'full_canvas')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-surface text-warning">
                                Full Canvas (Tanpa Header/Footer)
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-info-surface text-info">
                                Full Page (Dengan Header/Footer)
                            </span>
                        @endif
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($landingPage->status === 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-surface text-success">
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Draft
                            </span>
                        @endif
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Publish</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $landingPage->published_at ? $landingPage->published_at->format('d M Y H:i') : 'Belum dipublish' }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Page Blocks Section -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold font-heading text-gray-900">Daftar Block</h2>
        <a href="{{ route('admin.landing-pages.editor', $landingPage) }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors border-0 cursor-pointer">
            <iconify-icon icon="lucide:layout-template" class="mr-1"></iconify-icon> Buka Block Editor
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-xl border border-border overflow-hidden mb-8">
        @if($landingPage->blocks->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($landingPage->blocks as $block)
                    <li class="px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center">
                            <span class="text-gray-400 mr-3">#{{ $block->order }}</span>
                            <span class="font-medium text-sm text-gray-900 uppercase tracking-wider">{{ str_replace('_', ' ', $block->type) }}</span>
                        </div>
                        <span class="text-xs text-gray-500">ID: {{ $block->id }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-6 py-8 text-center text-gray-500 text-sm">
                Belum ada block yang ditambahkan ke landing page ini.
            </div>
        @endif
    </div>

</div>
@endsection
