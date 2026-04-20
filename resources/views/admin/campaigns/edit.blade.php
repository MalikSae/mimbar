@extends('layouts.admin')
@section('title', 'Edit Campaign')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="campaignFormEdit()">
    <div class="mb-6">
        <a href="{{ route('admin.campaigns.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">&larr; Kembali</a>
    </div>

    <h1 class="text-2xl font-bold font-heading text-gray-900 mb-6">Edit Campaign</h1>

    <div class="bg-white rounded-xl shadow-sm border border-border p-6">
        <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Campaign <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" x-model="name" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('name', $campaign->name) }}">
                    @error('name') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" x-model="slug" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('slug', $campaign->slug) }}">
                    <p class="mt-1 text-xs text-gray-500">Hanya huruf kecil, angka, dan tanda hubung (-).</p>
                    @error('slug') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" required class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm">
                        <option value="draft" {{ old('status', $campaign->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="ended" {{ old('status', $campaign->status) == 'ended' ? 'selected' : '' }}>Ended</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('start_date', $campaign->start_date?->format('Y-m-d')) }}">
                        @error('start_date') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('end_date', $campaign->end_date?->format('Y-m-d')) }}">
                        @error('end_date') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <hr class="border-border border-dashed">
                <h3 class="text-lg font-medium text-gray-900">UTM Parameters (Opsional)</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="utm_source" class="block text-sm font-medium text-gray-700">UTM Source</label>
                        <input type="text" name="utm_source" id="utm_source" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('utm_source', $campaign->utm_source) }}">
                    </div>
                    <div>
                        <label for="utm_medium" class="block text-sm font-medium text-gray-700">UTM Medium</label>
                        <input type="text" name="utm_medium" id="utm_medium" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('utm_medium', $campaign->utm_medium) }}">
                    </div>
                    <div>
                        <label for="utm_campaign" class="block text-sm font-medium text-gray-700">UTM Campaign</label>
                        <input type="text" name="utm_campaign" id="utm_campaign" class="mt-1 block w-full rounded-lg border-border focus:border-primary focus:ring-primary shadow-sm sm:text-sm" value="{{ old('utm_campaign', $campaign->utm_campaign) }}">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.campaigns.index') }}" class="bg-white border border-border text-gray-700 px-4 py-2 rounded-lg text-sm font-medium mr-3 hover:bg-gray-50 flex items-center">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('campaignFormEdit', () => ({
            name: @json(old('name', $campaign->name)),
            slug: @json(old('slug', $campaign->slug))
        }));
    });
</script>
@endpush
@endsection
