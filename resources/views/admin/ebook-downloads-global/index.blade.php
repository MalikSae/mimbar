@extends('layouts.admin')
@section('title', 'Semua Log Unduhan E-Book')

@section('content')

{{-- Page Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div>
        <h1 style="font-family:var(--font-heading);font-size:24px;font-weight:700;color:var(--color-gray-900);margin:0 0 4px;">
            Daftar Unduhan E-Book
        </h1>
        <p style="font-size:14px;color:var(--color-gray-500);margin:0;">
            Menampilkan histori seluruh unduhan E-Book dan status infaq
        </p>
    </div>
    <a href="{{ route('admin.ebook-logs.export', request()->query()) }}"
       style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;
              background:white;color:var(--color-success);border:1px solid var(--color-success);
              border-radius:var(--radius-lg);font-size:13px;font-weight:600;
              text-decoration:none;white-space:nowrap;flex-shrink:0;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Export CSV
    </a>
</div>

{{-- Stats Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Total Unduhan Global</div>
        <div style="font-family:var(--font-heading);font-size:28px;font-weight:700;
                    color:var(--color-primary);margin-bottom:4px;">
            {{ number_format($stats['total'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Seluruh aktivitas unduh</div>
    </div>

    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Minat Infaq</div>
        <div style="font-family:var(--font-heading);font-size:28px;font-weight:700;
                    color:var(--color-gray-900);margin-bottom:4px;">
            {{ number_format($stats['want_donate'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Pengunduh berinfaq</div>
    </div>

    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Total Potensi Infaq</div>
        <div style="font-family:var(--font-heading);font-size:24px;font-weight:700;
                    color:var(--color-success);margin-bottom:4px;">
            Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Seluruh komitmen Infaq tercatat</div>
    </div>
    
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Terverifikasi</div>
        <div style="font-family:var(--font-heading);font-size:28px;font-weight:700;
                    color:var(--color-success);margin-bottom:4px;">
            {{ number_format($stats['total_verified'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Transaksi selesai diverifikasi</div>
    </div>
</div>

{{-- Filters --}}
<div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);padding:16px;margin-bottom:24px;box-shadow:var(--shadow-card);">
    <form method="GET" action="{{ route('admin.ebook-logs.index') }}" style="display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
        <div style="flex:1;min-width:200px;">
            <label style="display:block;font-size:11px;font-weight:600;color:var(--color-gray-600);margin-bottom:6px;">Cari Nama/WA</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." 
                   style="width:100%;padding:9px 12px;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:13px;outline:none;">
        </div>
        <div style="width:200px;">
            <label style="display:block;font-size:11px;font-weight:600;color:var(--color-gray-600);margin-bottom:6px;">E-Book</label>
            <select name="ebook_id" style="width:100%;padding:9px 12px;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:13px;outline:none;">
                <option value="">Semua E-Book</option>
                @foreach($ebooks as $eb)
                <option value="{{ $eb->id }}" {{ request('ebook_id') == $eb->id ? 'selected' : '' }}>{{ $eb->title }}</option>
                @endforeach
            </select>
        </div>
        <div style="width:140px;">
            <label style="display:block;font-size:11px;font-weight:600;color:var(--color-gray-600);margin-bottom:6px;">Tipe Unduhan</label>
            <select name="infaq" style="width:100%;padding:9px 12px;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:13px;outline:none;">
                <option value="">Semua</option>
                <option value="yes" {{ request('infaq') === 'yes' ? 'selected' : '' }}>Berinfaq</option>
                <option value="no" {{ request('infaq') === 'no' ? 'selected' : '' }}>Gratis</option>
            </select>
        </div>
        <div style="width:140px;">
            <label style="display:block;font-size:11px;font-weight:600;color:var(--color-gray-600);margin-bottom:6px;">Status Infaq</label>
            <select name="status" style="width:100%;padding:9px 12px;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:13px;outline:none;">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" style="padding:9px 16px;background:var(--color-gray-900);color:white;border:none;border-radius:var(--radius-lg);font-size:13px;font-weight:600;cursor:pointer;">
            Filter
        </button>
        @if(request()->anyFilled(['search','ebook_id','infaq','status']))
        <a href="{{ route('admin.ebook-logs.index') }}" style="padding:9px 16px;background:var(--color-muted);color:var(--color-gray-600);text-decoration:none;border-radius:var(--radius-lg);font-size:13px;font-weight:500;">Reset</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div style="background:white;border-radius:var(--radius-xl);border:1px solid var(--color-border);box-shadow:var(--shadow-card);overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;min-width:900px;">
        <thead>
            <tr style="background:var(--color-muted);">
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">E-Book</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:240px;">Pengunduh</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:120px;">Infaq</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:160px;">Tagihan Infaq</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:120px;">Status</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:160px;">Aksi</th>
            </tr>
        </thead>
        <tbody x-data="verificationHandler()">
            @forelse($logs as $log)
            <tr style="border-bottom:1px solid var(--color-border);" id="row-{{ $log->id }}">
                {{-- Ebook --}}
                <td style="padding:12px 16px;">
                    <div style="font-size:12px;font-weight:600;color:var(--color-gray-900);line-height:1.4;">{{ $log->ebook->title ?? '-' }}</div>
                    <div style="font-size:10px;color:var(--color-gray-400);margin-top:2px;">{{ $log->downloaded_at?->format('d M Y, H:i') }}</div>
                </td>
                {{-- Pengunduh --}}
                <td style="padding:12px 16px;">
                    <div style="font-size:13px;font-weight:600;color:var(--color-gray-900);">{{ $log->name }}</div>
                    <div style="display:flex;align-items:center;gap:6px;margin-top:2px;">
                        <span style="font-size:12px;font-family:monospace;color:var(--color-gray-600);">{{ $log->whatsapp }}</span>
                    </div>
                </td>
                {{-- Infaq --}}
                <td style="padding:12px 16px;text-align:center;">
                    @if($log->want_donate)
                    <span style="display:inline-block;font-size:11px;padding:2px 8px;border-radius:12px;background:var(--color-success-surface);color:var(--color-success);font-weight:600;">Ya</span>
                    @else
                    <span style="display:inline-block;font-size:11px;padding:2px 8px;border-radius:12px;background:var(--color-muted);color:var(--color-gray-500);font-weight:600;">Tidak</span>
                    @endif
                </td>
                {{-- Tagihan Infaq --}}
                <td style="padding:12px 16px;text-align:right;">
                    @if($log->want_donate)
                        <div style="font-size:13px;font-weight:700;color:var(--color-gray-900);">Rp {{ number_format($log->total_transfer ?? $log->donation_amount, 0, ',', '.') }}</div>
                    @else
                        <span style="font-size:13px;color:var(--color-gray-400);">-</span>
                    @endif
                </td>
                {{-- Status --}}
                <td style="padding:12px 16px;text-align:center;" class="status-cell">
                    @if($log->want_donate)
                        @if($log->payment_status === 'verified')
                            <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;padding:4px 10px;border-radius:12px;background:var(--color-success-surface);color:var(--color-success);font-weight:600;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Verified</span>
                        @elseif($log->payment_status === 'rejected')
                            <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;padding:4px 10px;border-radius:12px;background:var(--color-danger-surface);color:var(--color-danger);font-weight:600;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> Ditolak</span>
                        @else
                            <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;padding:4px 10px;border-radius:12px;background:#fef3c7;color:#d97706;font-weight:600;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> Pending</span>
                        @endif
                    @else
                        <span style="font-size:11px;color:var(--color-gray-400);">Selesei</span>
                    @endif
                </td>
                {{-- Aksi --}}
                <td style="padding:12px 16px;text-align:right;">
                    <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                        
                        {{-- Kirim WA Button --}}
                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', $log->whatsapp);
                            if(str_starts_with($waNumber, '0')) { $waNumber = '62' . substr($waNumber, 1); }
                            
                            $link = rtrim(config('app.url'), '/') . '/storage/' . optional($log->ebook)->file_path;
                            $text = "Jazakumullahu khairan Sdr/i *{$log->name}* atas infaqnya untuk Program Dakwah Yayasan Mimbar Al-Tauhid.\n\nBerikut adalah tautan untuk mengunduh e-book *".optional($log->ebook)->title."*:\n{$link}\n\nSemoga menjadi ilmu yang bermanfaat.";
                        @endphp
                        {{-- But on this step, the user specifically mentioned manual WA send. --}}
                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($text) }}" target="_blank" title="Kirim E-Book via WA" style="display:flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;background:#25D366;color:white;text-decoration:none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </a>

                        @if($log->want_donate && (is_null($log->payment_status) || $log->payment_status === 'pending'))
                        <div x-data="{ showVerify: false, showReject: false, selectedBank: '' }" style="display:inline-flex;gap:6px;">
                            <button type="button" @click="showVerify = true" title="Verifikasi Pembayaran" style="display:flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;background:var(--color-success-surface);color:var(--color-success);border:1px solid var(--color-success);cursor:pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </button>
                            <button type="button" @click="showReject = true" title="Tolak" style="display:flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;background:white;color:var(--color-danger);border:1px solid var(--color-border);cursor:pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>

                            {{-- Modal Verify --}}
                            <div x-show="showVerify" x-cloak style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);text-align:left;" @keydown.escape.window="showVerify = false">
                                <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                                    <div style="background:white;border-radius:var(--radius-2xl);padding:28px;width:380px;max-width:90vw;box-shadow:var(--shadow-md);">
                                        <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;color:var(--color-gray-900);margin:0 0 8px;">Konfirmasi Verifikasi Infaq?</h3>
                                        <p style="font-size:13px;color:var(--color-gray-600);margin:0 0 20px;white-space:normal;">
                                            Infaq sebesar <strong>Rp {{ number_format($log->total_transfer ?? $log->donation_amount, 0, ',', '.') }}</strong> dari <strong>{{ $log->name }}</strong> akan diverifikasi.
                                        </p>
                                        
                                        {{-- Dropdown Rekening (Opsional) --}}
                                        <div style="margin-bottom:20px;">
                                            <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">Rekening Penerima <span style="font-weight:400;color:var(--color-gray-400);">(Opsional)</span></label>
                                            <select x-model="selectedBank" style="width:100%;padding:9px 12px;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;color:var(--color-gray-900);background:white;">
                                                <option value="">— Pilih rekening —</option>
                                                @foreach($bankAccounts ?? [] as $bank)
                                                <option value="{{ $bank->bank_name }} — {{ $bank->account_number }}">{{ $bank->bank_name }} — {{ $bank->account_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="display:flex;gap:10px;justify-content:flex-end;">
                                            <button @click="showVerify = false" style="padding:8px 16px;font-size:13px;border:1px solid var(--color-border);color:var(--color-gray-600);background:white;border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">Batal</button>
                                            <button @click="confirmAction({{ $log->id }}, 'verify', selectedBank)" style="padding:8px 16px;font-size:13px;font-weight:600;background:var(--color-success);color:white;border:none;border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">Ya, Verifikasi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Reject --}}
                            <div x-show="showReject" x-cloak style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);text-align:left;" @keydown.escape.window="showReject = false">
                                <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                                    <div style="background:white;border-radius:var(--radius-2xl);padding:28px;width:380px;max-width:90vw;box-shadow:var(--shadow-md);">
                                        <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;color:var(--color-gray-900);margin:0 0 8px;">Tolak Infaq?</h3>
                                        <p style="font-size:13px;color:var(--color-gray-600);margin:0 0 20px;white-space:normal;">Infaq dari <strong>{{ $log->name }}</strong> akan ditolak.</p>
                                        <div style="display:flex;gap:10px;justify-content:flex-end;">
                                            <button @click="showReject = false" style="padding:8px 16px;font-size:13px;border:1px solid var(--color-border);color:var(--color-gray-600);background:white;border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">Batal</button>
                                            <button @click="confirmAction({{ $log->id }}, 'reject', '')" style="padding:8px 16px;font-size:13px;font-weight:600;background:var(--color-danger);color:white;border:none;border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">Ya, Tolak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:48px 20px;text-align:center;">
                    <div style="color:var(--color-gray-400);font-size:14px;">Belum ada data riwayat download</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($logs->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--color-border);">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('verificationHandler', () => ({
        confirmAction(id, action, bank_destination = '') {
            const payload = action === 'verify' ? { bank_destination } : {};

            fetch(`/admin/ebook-logs/${id}/${action}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Kesalahan jaringan');
            });
        }
    }));
});
</script>
@endpush
