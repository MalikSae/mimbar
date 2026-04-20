@extends('layouts.admin')
@section('title', 'Kelola Landing Page')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold font-heading text-gray-900">Kelola Landing Page</h1>
        <a href="{{ route('admin.landing-pages.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Buat Landing Page
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title & Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Canvas Mode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published At</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($landingPages as $lp)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $lp->title }}</div>
                            <div class="text-xs text-info hover:underline">
                                <a href="/lp/{{ $lp->slug }}" target="_blank">/lp/{{ $lp->slug }}</a>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $lp->campaign->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if($lp->canvas_mode === 'full_canvas')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-warning-surface text-warning">Full Canvas</span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-info-surface text-info">Full Page</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($lp->status === 'published')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-success-surface text-success">Published</span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-gray-100 text-gray-800">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $lp->published_at ? $lp->published_at->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2 flex justify-end">
                            <a href="{{ route('admin.landing-pages.show', $lp) }}" class="text-gray-600 hover:text-gray-900">Lihat</a>
                            <a href="{{ route('admin.landing-pages.edit', $lp) }}" class="text-primary hover:text-primary-dark">Edit</a>
                            <form action="{{ route('admin.landing-pages.destroy', $lp) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus landing page ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger hover:text-red-900 bg-transparent border-0 cursor-pointer">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada landing page.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $landingPages->links() }}
    </div>
</div>
@endsection
