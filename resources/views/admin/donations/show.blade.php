@extends('layouts.admin')
@section('title', 'Detail Donasi #' . $donation->id)

@section('content')

{{-- Breadcrumb --}}
<div style="display:flex;align-items:center;gap:6px;font-size:13px;color:var(--color-gray-400);margin-bottom:20px;">
    <a href="{{ route('admin.dashboard') }}" style="color:var(--color-gray-400);text-decoration:none;">Dashboard</a>
    <span>›</span>
    <a href="{{ route('admin.donations.index') }}" style="color:var(--color-gray-400);text-decoration:none;">Donasi</a>
    <span>›</span>
    <span style="color:var(--color-gray-900);font-weight:500;">Detail #{{ $donation->id }}</span>
</div>

{{-- Flash --}}
@if(session('success'))
<div style="background:var(--color-success-surface);border:1px solid var(--color-success);
            color:var(--color-success);border-radius:var(--radius-lg);padding:12px 16px;
            margin-bottom:20px;font-size:14px;">{{ session('success') }}</div>
@endif

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

    {{-- Card Info Donasi --}}
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);overflow:hidden;">
        <div style="padding:16px 20px;border-bottom:1px solid var(--color-border);background:var(--color-muted);
                    display:flex;align-items:center;justify-content:space-between;">
            <span style="font-size:14px;font-weight:700;font-family:var(--font-heading);color:var(--color-gray-900);">
                Informasi Donasi
            </span>
            <code style="font-size:12px;background:var(--color-primary-light);color:var(--color-primary);
                         padding:3px 10px;border-radius:var(--radius-full);font-weight:600;">
                {{ $donation->reference_code }}
            </code>
        </div>
        <div style="padding:20px;">
            @php
                $rows = [
                    ['label' => 'Program',        'value' => $donation->program->name ?? '—'],
                    ['label' => 'Nama Donatur',   'value' => $donation->is_anonymous ? 'Hamba Allah' : $donation->donor_name],
                    ['label' => 'No. WhatsApp',   'value' => $donation->whatsapp ?: '—'],
                    ['label' => 'Nominal Donasi', 'value' => 'Rp ' . number_format($donation->amount, 0, ',', '.')],
                    ['label' => 'Kode Unik',      'value' => $donation->unique_code],
                    ['label' => 'Total Transfer', 'value' => 'Rp ' . number_format($donation->amount + $donation->unique_code, 0, ',', '.')],
                    ['label' => 'Tanggal',        'value' => $donation->created_at->format('d M Y, H:i')],
                    ['label' => 'Expired At',     'value' => $donation->expired_at ? $donation->expired_at->format('d M Y, H:i') : '—'],
                ];
            @endphp
            @foreach($rows as $i => $row)
            <div style="display:flex;gap:16px;padding:10px 0;{{ $i < count($rows)-1 ? 'border-bottom:1px solid var(--color-border);' : '' }}">
                <div style="width:140px;font-size:13px;font-weight:500;color:var(--color-gray-600);flex-shrink:0;">
                    {{ $row['label'] }}
                </div>
                <div style="font-size:13px;color:var(--color-gray-900);font-weight:500;">
                    {{ $row['value'] }}
                </div>
            </div>
            @endforeach

            @if($donation->message)
            <div style="margin-top:16px;padding:14px;background:var(--color-muted);border-radius:var(--radius-lg);
                        border:1px solid var(--color-border);">
                <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                          color:var(--color-gray-600);margin:0 0 6px;">Pesan / Doa</p>
                <p style="font-size:13px;color:var(--color-gray-900);margin:0;font-style:italic;line-height:1.6;">
                    "{{ $donation->message }}"
                </p>
            </div>
            @endif
        </div>
    </div>

    {{-- Panel Kanan: Status + Aksi --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Status Card --}}
        <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                    box-shadow:var(--shadow-card);padding:20px;">
            <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                      color:var(--color-gray-600);margin:0 0 10px;">Status Donasi</p>

            @if($donation->status === 'verified')
            <div style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;
                        background:var(--color-success-surface);color:var(--color-success);
                        border-radius:var(--radius-full);font-weight:600;font-size:13px;margin-bottom:10px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                Terverifikasi
            </div>
            @if($donation->verified_at)
            <p style="font-size:12px;color:var(--color-gray-400);margin:0;">
                Pada {{ $donation->verified_at->format('d M Y, H:i') }}
            </p>
            @endif
            @if($donation->notes)
            <p style="font-size:12px;color:var(--color-gray-600);margin:10px 0 0;padding:10px;
                      background:var(--color-muted);border-radius:var(--radius-lg);">
                Catatan: {{ $donation->notes }}
            </p>
            @endif

            @elseif($donation->status === 'rejected')
            <div style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;
                        background:var(--color-danger-surface);color:var(--color-danger);
                        border-radius:var(--radius-full);font-weight:600;font-size:13px;margin-bottom:10px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Ditolak
            </div>
            @if($donation->notes)
            <p style="font-size:12px;color:var(--color-gray-600);margin:10px 0 0;padding:10px;
                      background:var(--color-muted);border-radius:var(--radius-lg);">
                Alasan: {{ $donation->notes }}
            </p>
            @endif

            @else
            {{-- PENDING: Form Verifikasi --}}
            <div style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;
                        background:var(--color-warning-surface);color:var(--color-warning);
                        border-radius:var(--radius-full);font-weight:600;font-size:13px;margin-bottom:16px;">
                Menunggu Verifikasi
            </div>

            <div x-data="{ confirmVerify: false, confirmReject: false, selectedBank: '' }">
                <div style="margin-bottom:12px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                        Catatan (Opsional)
                    </label>
                    <textarea id="notes-input" name="notes" rows="3"
                              placeholder="Tambahkan catatan verifikasi..."
                              style="width:100%;box-sizing:border-box;padding:9px 12px;border:1px solid var(--color-border);
                                     border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                                     outline:none;resize:none;"></textarea>
                </div>

                <div style="display:flex;flex-direction:column;gap:8px;">
                    <button @click="confirmVerify = true"
                            style="width:100%;padding:11px;background:var(--color-success);color:white;border:none;
                                   border-radius:var(--radius-lg);font-size:14px;font-weight:600;cursor:pointer;
                                   font-family:var(--font-heading);">
                        ✓ Verifikasi Donasi
                    </button>
                    <button @click="confirmReject = true"
                            style="width:100%;padding:11px;background:white;color:var(--color-danger);
                                   border:1px solid var(--color-danger);border-radius:var(--radius-lg);
                                   font-size:14px;font-weight:600;cursor:pointer;font-family:var(--font-heading);">
                        ✕ Tolak Donasi
                    </button>
                </div>

                {{-- Modal Konfirmasi Verifikasi --}}
                <div x-show="confirmVerify" x-cloak
                     style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);"
                     @keydown.escape.window="confirmVerify = false">
                    <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                    <div style="background:white;border-radius:var(--radius-2xl);padding:28px;
                                width:380px;max-width:90vw;box-shadow:var(--shadow-md);">
                        <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;
                                   color:var(--color-gray-900);margin:0 0 8px;">Konfirmasi Verifikasi?</h3>
                        <p style="font-size:13px;color:var(--color-gray-600);margin:0 0 20px;">
                            Donasi <strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong> dari
                            <strong>{{ $donation->is_anonymous ? 'Hamba Allah' : $donation->donor_name }}</strong> akan diverifikasi.
                            Dana akan otomatis ditambahkan ke total program.
                        </p>

                        {{-- Dropdown Rekening (Opsional) --}}
                        <div style="margin-bottom:20px;">
                            <label style="display:block;font-size:12px;font-weight:600;
                                         color:var(--color-gray-700);margin-bottom:6px;"
                            >Rekening Penerima <span style="font-weight:400;color:var(--color-gray-400);">(Opsional)</span></label>
                            <select x-model="selectedBank"
                                    style="width:100%;padding:9px 12px;border:1px solid var(--color-border);
                                           border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                                           outline:none;color:var(--color-gray-900);background:white;">
                                <option value="">— Pilih rekening —</option>
                                @foreach($bankAccounts as $bank)
                                <option value="{{ $bank->bank_name }} — {{ $bank->account_number }}">
                                    {{ $bank->bank_name }} — {{ $bank->account_number }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="display:flex;gap:10px;justify-content:flex-end;">
                            <button @click="confirmVerify = false"
                                    style="padding:8px 16px;font-size:13px;border:1px solid var(--color-border);
                                           color:var(--color-gray-600);background:white;border-radius:var(--radius-lg);
                                           cursor:pointer;font-family:var(--font-body);">Batal</button>
                            <form method="POST" action="{{ route('admin.donations.verify', $donation->id) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="notes" :value="document.getElementById('notes-input').value">
                                <input type="hidden" name="bank_destination" :value="selectedBank">
                                <button type="submit"
                                        style="padding:8px 16px;font-size:13px;font-weight:600;
                                               background:var(--color-success);color:white;border:none;
                                               border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">
                                    Ya, Verifikasi
                                </button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                {{-- Modal Konfirmasi Tolak --}}
                <div x-show="confirmReject" x-cloak
                     style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);"
                     @keydown.escape.window="confirmReject = false">
                    <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                    <div style="background:white;border-radius:var(--radius-2xl);padding:28px;
                                width:380px;max-width:90vw;box-shadow:var(--shadow-md);">
                        <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;
                                   color:var(--color-gray-900);margin:0 0 8px;">Tolak Donasi?</h3>
                        <p style="font-size:13px;color:var(--color-gray-600);margin:0 0 20px;">
                            Donasi ini akan ditandai sebagai ditolak. Pastikan sudah mengisi catatan alasan penolakan.
                        </p>
                        <div style="display:flex;gap:10px;justify-content:flex-end;">
                            <button @click="confirmReject = false"
                                    style="padding:8px 16px;font-size:13px;border:1px solid var(--color-border);
                                           color:var(--color-gray-600);background:white;border-radius:var(--radius-lg);
                                           cursor:pointer;font-family:var(--font-body);">Batal</button>
                            <form method="POST" action="{{ route('admin.donations.reject', $donation->id) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="notes" :value="document.getElementById('notes-input').value">
                                <button type="submit"
                                        style="padding:8px 16px;font-size:13px;font-weight:600;
                                               background:var(--color-danger);color:white;border:none;
                                               border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">
                                    Ya, Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endif

            @if($donation->bank_destination)
            <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--color-border);">
                <p style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px;">Rekening Penerima</p>
                <p style="font-size: 14px; color: var(--color-gray-900); font-weight: 500;">{{ $donation->bank_destination }}</p>
            </div>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.donations.index') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:10px 16px;
                  background:white;color:var(--color-gray-600);border:1px solid var(--color-border);
                  border-radius:var(--radius-lg);font-size:13px;font-weight:500;text-decoration:none;">
            ← Kembali ke Daftar Donasi
        </a>
    </div>
</div>

@endsection
