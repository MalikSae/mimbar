@extends('layouts.app')

@push('head')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
/* ── Prose styling ────────────────────────────────────────── */
.article-prose, .prose-content { font-size: 18px; color: var(--color-gray-800); line-height: 1.8; }
.article-prose p, .prose-content p  { margin-bottom: 24px; }
.article-prose h2, .prose-content h2 { font-family: var(--font-heading); font-size: 26px; font-weight: 700;
                    color: var(--color-primary); margin-top: 48px; margin-bottom: 20px; }
.article-prose h3, .prose-content h3 { font-family: var(--font-heading); font-size: 21px; font-weight: 700;
                    color: var(--color-gray-900); margin-top: 36px; margin-bottom: 16px; }
.article-prose h4, .prose-content h4 { font-family: var(--font-heading); font-size: 18px; font-weight: 700;
                    color: var(--color-gray-900); margin-top: 28px; margin-bottom: 12px; }
.article-prose ul, .prose-content ul { list-style-type: disc; padding-left: 28px; margin-bottom: 20px; }
.article-prose ol, .prose-content ol { list-style-type: decimal; padding-left: 28px; margin-bottom: 20px; }
.article-prose li, .prose-content li { margin-bottom: 8px; display: list-item; }
.article-prose blockquote, .prose-content blockquote {
    border-left: 4px solid var(--color-primary);
    background-color: var(--color-muted);
    padding: 20px 24px;
    margin: 32px 0;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--color-gray-600);
}
.article-prose a, .prose-content a { color: var(--color-primary); text-decoration: underline; }
.article-prose img, .prose-content img { max-width: 100%; border-radius: var(--radius-md);
                     margin: 24px auto; display: block; }
.article-prose strong, .prose-content strong { font-weight: 700; }
.article-prose em, .prose-content em     { font-style: italic; }
.article-prose hr, .prose-content hr { border: none; border-top: 2px solid var(--color-border); margin: 40px 0; }
</style>
@endpush

@section('content')
<div class="font-body text-gray-900 leading-relaxed antialiased min-h-screen pb-20 pt-6" style="background: var(--color-muted);">

    <!-- BREADCRUMB -->
    <section class="pb-5 max-w-[1200px] mx-auto px-6">
        <div class="flex items-center gap-2 text-gray-500 text-sm mb-2 font-medium">
            <a href="/" class="hover:text-gray-900">Beranda</a>
            <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
            <a href="{{ route('donations.index') }}" class="hover:text-gray-900">Donasi</a>
            <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
            <span class="text-gray-900">{{ $program->name }}</span>
        </div>
    </section>

    <!-- MAIN CONTENT GRID -->
    <section class="max-w-[1200px] mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-[60%_40%] gap-10 relative">
            
            <!-- KOLOM KIRI: Card Konten (Gambar, Judul, Tabs) -->
            <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <!-- HERO CAMPAIGN (Main Image) -->
                <div class="w-full aspect-[16/9] relative">
                    <img src="{{ $program->featured_image ? asset('storage/' . $program->featured_image) : 'https://placehold.co/800x450/e5e7eb/9ca3af' }}" alt="{{ $program->name }}" class="w-full h-full object-cover" />
                </div>

                <div class="p-6 md:p-8 lg:p-10">
                    <!-- KATEGORI & JUDUL -->
                    @if($program->category)
                    <div class="inline-block bg-primary-light text-primary px-4 py-1.5 rounded-full text-xs font-bold font-headings uppercase tracking-wider mb-4">
                        {{ $program->category->name }}
                    </div>
                    @endif

                    <h1 class="font-headings text-3xl lg:text-4xl font-bold text-gray-900 leading-snug mb-8">
                        {{ $program->name }}
                    </h1>

                    <!-- KONTEN DETAIL (TABS) -->
                    <div x-data="{ tab: 'deskripsi' }">
                        <div class="flex border-b border-gray-200 mb-8 overflow-x-auto overflow-y-hidden [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        <button @click="tab = 'deskripsi'" :class="tab === 'deskripsi' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium text-gray-500 hover:text-gray-900'" class="px-6 py-4 font-headings relative top-[1px] whitespace-nowrap transition-colors">
                            Deskripsi
                        </button>
                        <button @click="tab = 'update'" :class="tab === 'update' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium text-gray-500 hover:text-gray-900'" class="px-6 py-4 font-headings relative top-[1px] whitespace-nowrap transition-colors">
                            Update Kabar
                        </button>
                        <button @click="tab = 'donatur'" :class="tab === 'donatur' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium text-gray-500 hover:text-gray-900'" class="px-6 py-4 font-headings relative top-[1px] whitespace-nowrap transition-colors">
                            Daftar Donatur
                        </button>
                    </div>

                    <div class="text-[18px] text-[#333333] leading-[1.8] space-y-6">
                        <div x-show="tab === 'deskripsi'" class="article-prose prose-content">
                            {!! $program->description !!}
                            
                            @if($program->specs)
                            @php $specs = is_string($program->specs) ? json_decode($program->specs, true) : $program->specs; @endphp
                            @if(is_array($specs))
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm my-8 not-prose">
                                <h4 class="font-headings font-bold text-gray-900 mb-3 text-lg flex items-center gap-2">
                                    <iconify-icon icon="lucide:info" class="text-primary" width="20"></iconify-icon>
                                    Spesifikasi Detail
                                </h4>
                                <ul class="space-y-2 text-[16px] text-gray-700">
                                    @foreach($specs as $key => $val)
                                    <li class="flex gap-2"><span class="font-bold min-w-[120px]">{{ $key }}:</span> {{ $val }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @endif
                        </div>
                        
                        <div x-show="tab === 'update'" style="display: none;">
                            <p class="text-gray-500 italic">Belum ada update kabar terbaru.</p>
                        </div>
                        
                        <div x-show="tab === 'donatur'" style="display: none;">
                            @php
                                $donors = \App\Models\Donation::where('program_id', $program->id)->where('status', 'verified')->orderBy('verified_at', 'desc')->get();
                            @endphp
                            @if($donors->count() > 0)
                                <ul class="space-y-4">
                                @foreach($donors as $donor)
                                    <li class="bg-white border border-gray-200 p-4 rounded-xl flex items-center justify-between shadow-sm">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-primary-light text-primary rounded-full flex items-center justify-center font-bold font-headings">
                                                {{ substr($donor->is_anonymous ? 'HA' : $donor->donor_name, 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $donor->is_anonymous ? 'Hamba Allah' : $donor->donor_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $donor->validated_at ? \Carbon\Carbon::parse($donor->validated_at)->format('d M Y') : $donor->created_at->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="font-headings font-bold text-gray-900">
                                            Rp {{ number_format($donor->amount, 0, ',', '.') }}
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500 italic">Belum ada donatur terverifikasi.</p>
                            @endif
                        </div>
                    </div>
                </div>
                </div> <!-- END p-6 md:p-8 lg:p-10 -->
            </div> <!-- END KOLOM KIRI -->

            <!-- KOLOM KANAN: Panel Donasi Utama -->
            <div class="relative w-full h-full">
                <div class="sticky top-28 bg-white rounded-xl shadow-md border border-gray-100 p-6 lg:p-8 flex flex-col gap-6">
                    <div>
                        <!-- Struktur Standar: Terkumpul & Persentase (Sejajar) -->
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm text-gray-600">
                                Terkumpul <span class="text-xl md:text-2xl font-bold text-gray-900 font-headings ml-1">Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                            </span>
                            <span class="bg-primary-light text-primary px-3 py-1.5 rounded-md text-xs font-bold font-headings">
                                {{ $program->progress_percentage }}%
                            </span>
                        </div>
                        
                        <!-- Struktur Standar: Progress Bar Tipis -->
                        <div class="bg-gray-200 rounded-full h-2 overflow-hidden w-full mb-2">
                            <div class="bg-primary h-full rounded-full transition-all duration-1000" style="width: {{ $program->progress_percentage }}%;"></div>
                        </div>

                        <!-- Struktur Standar: Target (Kanan Bawah) -->
                        <div class="text-right text-xs text-gray-500 font-medium mb-6">
                            Target: Rp {{ number_format($program->target_amount, 0, ',', '.') }}
                        </div>

                        @php
                            $sisaHari = $program->days_remaining !== null ? ceil($program->days_remaining) : null;
                        @endphp

                        <!-- Info Donatur & Waktu -->
                        <div class="flex justify-between items-center text-sm font-medium border-b border-gray-100 pb-6 mb-2">
                            <div class="flex items-center gap-2 text-gray-700">
                                <iconify-icon icon="lucide:users" width="16" class="text-[#D4AF37]"></iconify-icon>
                                <span><strong>{{ $program->donor_count ?? 0 }}</strong> Donatur</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <iconify-icon icon="lucide:clock" width="16" class="text-[#D4AF37]"></iconify-icon>
                                @if($sisaHari === null)
                                    <span><strong style="font-size:1.1em;">∞</strong> Tanpa Batas</span>
                                @else
                                    <span>Sisa <strong>{{ $sisaHari }} Hari</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('donations.form', $program->slug) }}" class="w-full inline-flex items-center justify-center py-4 text-lg shadow-sm bg-primary text-white font-bold font-headings rounded-lg hover:bg-primary-dark transition-colors">
                        Donasi Sekarang
                    </a>
                    
                    <div class="flex items-center justify-center gap-4 mt-2">
                        <span class="text-sm font-medium text-gray-500">Bagikan Program:</span>
                        <button class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-[#25D366] hover:text-white hover:border-[#25D366] transition-colors" title="Bagikan ke WhatsApp">
                            <iconify-icon icon="mdi:whatsapp" width="18"></iconify-icon>
                        </button>
                        <button class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2] transition-colors" title="Bagikan ke Facebook">
                            <iconify-icon icon="mdi:facebook" width="18"></iconify-icon>
                        </button>
                        <button class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors" title="Salin Tautan">
                            <iconify-icon icon="lucide:link" width="14"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- SECTION 5: PROGRAM SERUPA -->
    @php
        $related = \App\Models\DonationProgram::where('id', '!=', $program->id)->where('status', 'active')->take(3)->get();
    @endphp
    @if($related->count() > 0)
    <section class="py-20 bg-white border-t border-gray-200">
        <div class="max-w-[1200px] mx-auto px-6 lg:px-20">
            <h2 class="font-headings text-3xl font-bold text-gray-900 mb-10 text-center">
                Lanjutkan Estafet Kebaikan Lainnya
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $row)
                @php $rPercent = $row->target_amount > 0 ? min(100, round(($row->collected_amount / $row->target_amount) * 100)) : 0; @endphp
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col shadow-sm hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-[4/3]">
                        <img src="{{ $row->featured_image ? asset('storage/' . $row->featured_image) : 'https://placehold.co/600x400/e5e7eb/9ca3af' }}" alt="{{ $row->name }}" class="w-full h-full object-cover" />
                        @if($row->category)
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-xs font-bold font-headings uppercase tracking-wider shadow-sm">
                            {{ $row->category->name }}
                        </div>
                        @endif
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="font-headings text-lg font-bold text-gray-900 mb-2 leading-snug line-clamp-2">
                            <a href="{{ route('donations.show', $row->slug) }}" class="text-gray-900 hover:text-primary transition-colors">
                                {{ $row->name }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-6">
                            {{ Str::limit(strip_tags($row->description), 100) }}
                        </p>
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-gray-600">
                                    Terkumpul <span class="text-sm font-bold text-gray-900 font-headings">Rp {{ number_format($row->collected_amount, 0, ',', '.') }}</span>
                                </span>
                                <span class="bg-primary-light text-primary px-2 py-1 rounded text-[10px] font-bold font-headings">
                                    {{ $row->progress_percentage }}%
                                </span>
                            </div>
                            <div class="bg-border rounded-full h-1.5 overflow-hidden w-full mb-1 flex-shrink-0">
                                <div class="bg-primary h-full rounded-full" style="width: {{ $row->progress_percentage }}%;"></div>
                            </div>
                            <div class="text-right text-[11px] text-gray-500 mb-5">
                                Target: Rp {{ number_format($row->target_amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('donations.show', $row->slug) }}" class="w-full h-10 shadow-sm inline-flex items-center justify-center rounded-lg font-semibold text-sm font-headings whitespace-nowrap gap-2 bg-primary text-white hover:bg-primary-dark transition-colors border border-transparent">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif



</div>

<script src="{{ asset('js/prose-grid.js') }}"></script>
@endsection
