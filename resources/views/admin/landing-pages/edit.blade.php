@extends('layouts.admin')
@section('title', 'Edit Landing Page')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="landingPageFormEdit()">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.landing-pages.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">&larr; Kembali</a>
        
        <div>
            @if($landingPage->status === 'published')
                <form action="{{ route('admin.landing-pages.unpublish', $landingPage) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-warning hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Jadikan Draft
                    </button>
                </form>
            @else
                <form action="{{ route('admin.landing-pages.publish', $landingPage) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-success hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Publish Sekarang
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-success-surface border border-success/20 text-success rounded-lg flex items-center">
            <iconify-icon icon="lucide:check-circle" class="text-xl mr-2"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold font-heading text-gray-900 mb-6">Edit Landing Page</h1>

    <div class="bg-white rounded-xl shadow-sm border border-border p-6">
        <form action="{{ route('admin.landing-pages.update', $landingPage) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Campaign ID -->
                <div>
                    <label for="campaign_id" class="block text-sm font-medium text-gray-700">Campaign <span class="text-danger">*</span></label>
                    <select name="campaign_id" id="campaign_id" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm">
                        <option value="">-- Pilih Campaign --</option>
                        @foreach($campaigns as $camp)
                            <option value="{{ $camp->id }}" {{ old('campaign_id', $landingPage->campaign_id) == $camp->id ? 'selected' : '' }}>{{ $camp->name }}</option>
                        @endforeach
                    </select>
                    @error('campaign_id') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Default (Title) <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" x-model="title" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('title', $landingPage->title) }}">
                    @error('title') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-danger">*</span></label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm bg-gray-50">/lp/</span>
                        <input type="text" name="slug" id="slug" x-model="slug" required class="block w-full min-w-0 flex-1 rounded-none rounded-r-lg border-border focus:border-primary focus:ring-primary sm:text-sm" value="{{ old('slug', $landingPage->slug) }}">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Hanya huruf kecil, angka, dan tanda hubung (-).</p>
                    @error('slug') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Canvas Mode -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Mode Canvas <span class="text-danger">*</span></span>
                    <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                        <div class="flex items-center">
                            <input id="canvas_mode_full_canvas" name="canvas_mode" type="radio" value="full_canvas" {{ old('canvas_mode', $landingPage->canvas_mode) == 'full_canvas' ? 'checked' : '' }} class="h-4 w-4 border-gray-300 text-primary focus:ring-primary">
                            <label for="canvas_mode_full_canvas" class="ml-3 block text-sm font-medium text-gray-700">
                                Full Canvas
                                <span class="block text-xs text-gray-500 font-normal">Tanpa header dan footer Mimbar.</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="canvas_mode_full_page" name="canvas_mode" type="radio" value="full_page" {{ old('canvas_mode', $landingPage->canvas_mode) == 'full_page' ? 'checked' : '' }} class="h-4 w-4 border-gray-300 text-primary focus:ring-primary">
                            <label for="canvas_mode_full_page" class="ml-3 block text-sm font-medium text-gray-700">
                                Full Page
                                <span class="block text-xs text-gray-500 font-normal">Dengan header dan footer standar.</span>
                            </label>
                        </div>
                    </div>
                    @error('canvas_mode') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <!-- We hide status here since there are dedicated publish/draft buttons on top, or we can leave it -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm">
                        <option value="draft" {{ old('status', $landingPage->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $landingPage->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <hr class="border-border border-dashed">
                <h3 class="text-lg font-medium text-gray-900">SEO Settings</h3>

                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('meta_title', $landingPage->meta_title) }}">
                    @error('meta_title') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Meta Description -->
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm">{{ old('meta_description', $landingPage->meta_description) }}</textarea>
                    @error('meta_description') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.landing-pages.index') }}" class="bg-white border border-border text-gray-700 px-4 py-2 rounded-lg text-sm font-medium mr-3 hover:bg-gray-50 flex items-center">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('landingPageFormEdit', () => ({
            title: @json(old('title', $landingPage->title)),
            slug: @json(old('slug', $landingPage->slug))
        }));
    });
</script>
@endpush
@endsection
