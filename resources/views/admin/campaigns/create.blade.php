@extends('layouts.admin')
@section('title', 'Buat Campaign')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="campaignForm()">
    <div class="mb-6">
        <a href="{{ route('admin.campaigns.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">&larr; Kembali</a>
    </div>

    <h1 class="text-2xl font-bold font-heading text-gray-900 mb-6">Buat Campaign Baru</h1>

    <div class="bg-white rounded-xl shadow-sm border border-border p-6">
        <form action="{{ route('admin.campaigns.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Campaign <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" x-model="name" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm auto-focus" value="{{ old('name') }}">
                    @error('name') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" x-model="slug" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('slug') }}">
                    <p class="mt-1 text-xs text-gray-500">Hanya huruf kecil, angka, dan tanda hubung (-).</p>
                    @error('slug') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="ended" {{ old('status') == 'ended' ? 'selected' : '' }}>Ended</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('start_date') }}">
                        @error('start_date') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('end_date') }}">
                        @error('end_date') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <hr class="border-border border-dashed">
                <h3 class="text-lg font-medium text-gray-900">UTM Parameters (Opsional)</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="utm_source" class="block text-sm font-medium text-gray-700">UTM Source</label>
                        <input type="text" name="utm_source" id="utm_source" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('utm_source') }}">
                    </div>
                    <div>
                        <label for="utm_medium" class="block text-sm font-medium text-gray-700">UTM Medium</label>
                        <input type="text" name="utm_medium" id="utm_medium" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('utm_medium') }}">
                    </div>
                    <div>
                        <label for="utm_campaign" class="block text-sm font-medium text-gray-700">UTM Campaign</label>
                        <input type="text" name="utm_campaign" id="utm_campaign" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('utm_campaign') }}">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.campaigns.index') }}" class="bg-white border border-border text-gray-700 px-4 py-2 rounded-lg text-sm font-medium mr-3 hover:bg-gray-50 flex items-center">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('campaignForm', () => ({
            name: '{{ old('name') }}',
            slug: '{{ old('slug') }}',
            isSlugEdited: false,
            init() {
                // Determine if there is already an explicit old slug that differs from auto-generated name
                if (this.slug && this.name) {
                    let expectedSlug = this.name.toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                    if (this.slug !== expectedSlug) {
                        this.isSlugEdited = true;
                    }
                }
                
                this.$watch('name', value => {
                    if (!this.isSlugEdited) {
                        this.slug = value.toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                    }
                });
                
                this.$watch('slug', value => {
                    // If the user manually changes the slug (not driven by name watch), mark as edited
                    let expectedSlug = this.name.toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                    if (value !== expectedSlug && value !== '') {
                        this.isSlugEdited = true;
                    } else if (value === '') {
                        this.isSlugEdited = false; // Reset to auto if cleared
                    }
                });
            }
        }));
    });
</script>
@endpush
@endsection
