@extends('layouts.admin')
@section('title', 'Kelola Campaign')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold font-heading text-gray-900">Kelola Campaign</h1>
        <a href="{{ route('admin.campaigns.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Buat Campaign
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-success-surface border border-success/20 text-success rounded-lg flex items-center">
            <iconify-icon icon="lucide:check-circle" class="text-xl mr-2"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-border shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Landing Pages</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($campaigns as $campaign)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $campaign->name }}</div>
                            <div class="text-xs text-gray-500">{{ $campaign->slug }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($campaign->status === 'active')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-success-surface text-success">Active</span>
                            @elseif($campaign->status === 'ended')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-danger-surface text-danger">Ended</span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-gray-100 text-gray-800">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                            {{ $campaign->landing_pages_count }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $campaign->start_date ? $campaign->start_date->format('d/m/Y') : '-' }} s/d 
                            {{ $campaign->end_date ? $campaign->end_date->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="text-primary hover:text-primary-dark mr-3">Edit</a>
                            <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus campaign ini? Semua landing page di dalamnya akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada campaign.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $campaigns->links() }}
    </div>
</div>
@endsection
