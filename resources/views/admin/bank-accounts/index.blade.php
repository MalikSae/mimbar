@extends('layouts.admin')

@section('title', 'Data Rekening')

@section('content')
<div style="max-width: 900px;">

    {{-- Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:var(--color-gray-900); margin:0 0 4px;">Data Rekening</h1>
            <p style="font-size:13.5px; color:var(--color-gray-500); margin:0;">Kelola rekening bank yayasan untuk menerima donasi &amp; infaq.</p>
        </div>
        <button onclick="document.getElementById('modal-add').style.display='flex'"
                style="display:flex; align-items:center; gap:8px; background:var(--color-primary); color:white;
                       border:none; border-radius:8px; padding:9px 18px; font-size:13.5px; font-weight:600;
                       cursor:pointer;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Rekening
        </button>
    </div>

    {{-- Flash --}}
    @if(session('success'))
    <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:12px 16px;
                color:#166534; font-size:13.5px; display:flex; align-items:center; gap:10px; margin-bottom:20px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabel Rekening --}}
    <div style="background:white; border-radius:14px; border:1px solid var(--color-border); overflow:hidden;">
        @if($accounts->isEmpty())
        <div style="text-align:center; padding:64px 32px; color:var(--color-gray-400);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px; display:block; opacity:0.4;">
                <rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>
            </svg>
            <p style="font-size:14px; margin:0;">Belum ada rekening. Tambahkan rekening pertama.</p>
        </div>
        @else
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:var(--color-muted); border-bottom:1px solid var(--color-border);">
                    <th style="padding:11px 16px; text-align:left; font-size:11.5px; font-weight:700; color:var(--color-gray-500); text-transform:uppercase; letter-spacing:.05em;">Urutan</th>
                    <th style="padding:11px 16px; text-align:left; font-size:11.5px; font-weight:700; color:var(--color-gray-500); text-transform:uppercase; letter-spacing:.05em;">Bank</th>
                    <th style="padding:11px 16px; text-align:left; font-size:11.5px; font-weight:700; color:var(--color-gray-500); text-transform:uppercase; letter-spacing:.05em;">No. Rekening</th>
                    <th style="padding:11px 16px; text-align:left; font-size:11.5px; font-weight:700; color:var(--color-gray-500); text-transform:uppercase; letter-spacing:.05em;">Atas Nama</th>
                    <th style="padding:11px 16px; text-align:left; font-size:11.5px; font-weight:700; color:var(--color-gray-500); text-transform:uppercase; letter-spacing:.05em;">Status</th>
                    <th style="padding:11px 16px; text-align:right; font-size:11.5px; font-weight:700; color:var(--color-gray-500); text-transform:uppercase; letter-spacing:.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                <tr style="border-bottom:1px solid var(--color-border);" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='white'">
                    <td style="padding:14px 16px; font-size:13.5px; color:var(--color-gray-600); width:60px; text-align:center;">
                        {{ $account->sort_order }}
                    </td>
                    <td style="padding:14px 16px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            @if($account->logo)
                            <img src="{{ Storage::url($account->logo) }}" alt="{{ $account->bank_name }}"
                                 style="width:40px; height:26px; object-fit:contain; border-radius:4px; border:1px solid var(--color-border);">
                            @else
                            <div style="width:40px; height:26px; background:var(--color-muted); border-radius:4px; display:flex; align-items:center; justify-content:center;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-gray-400);">
                                    <rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>
                                </svg>
                            </div>
                            @endif
                            <div>
                                <div style="font-size:13.5px; font-weight:600; color:var(--color-gray-900);">{{ $account->bank_name }}</div>
                                @if($account->branch)
                                <div style="font-size:12px; color:var(--color-gray-500);">{{ $account->branch }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="padding:14px 16px; font-size:13.5px; color:var(--color-gray-800); font-family:monospace;">
                        {{ $account->account_number }}
                    </td>
                    <td style="padding:14px 16px; font-size:13.5px; color:var(--color-gray-800);">
                        {{ $account->account_holder }}
                    </td>
                    <td style="padding:14px 16px;">
                        <form method="POST" action="{{ route('admin.bank-accounts.toggle', $account->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    style="padding:4px 12px; border-radius:20px; border:none; cursor:pointer; font-size:12px; font-weight:600;
                                           background:{{ $account->is_active ? '#dcfce7' : '#fee2e2' }};
                                           color:{{ $account->is_active ? '#166534' : '#991b1b' }};">
                                {{ $account->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td style="padding:14px 16px; text-align:right;">
                        <div style="display:flex; align-items:center; gap:6px; justify-content:flex-end;">
                            {{-- Edit --}}
                            <button onclick="openEdit({{ $account->id }}, '{{ addslashes($account->bank_name) }}', '{{ addslashes($account->account_number) }}', '{{ addslashes($account->account_holder) }}', '{{ addslashes($account->branch ?? '') }}', {{ $account->is_active ? 'true' : 'false' }}, {{ $account->sort_order }})"
                                    style="padding:6px 12px; border-radius:7px; border:1px solid var(--color-border); background:white; cursor:pointer; font-size:12.5px; font-weight:500; color:var(--color-gray-700); display:flex; align-items:center; gap:5px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </button>
                            {{-- Hapus --}}
                            <form method="POST" action="{{ route('admin.bank-accounts.destroy', $account->id) }}"
                                  onsubmit="return confirm('Hapus rekening {{ $account->bank_name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="padding:6px 12px; border-radius:7px; border:1px solid #fecaca; background:#fff5f5; cursor:pointer; font-size:12.5px; font-weight:500; color:#dc2626; display:flex; align-items:center; gap:5px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</div>

{{-- ===== MODAL TAMBAH ===== --}}
<div id="modal-add" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9998;
     align-items:center; justify-content:center; padding:20px;">
    <div style="background:white; border-radius:16px; width:100%; max-width:520px; max-height:90vh; overflow-y:auto;">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:20px 24px 16px;
                    border-bottom:1px solid var(--color-border);">
            <h2 style="font-size:16px; font-weight:700; margin:0; color:var(--color-gray-900);">Tambah Rekening</h2>
            <button onclick="document.getElementById('modal-add').style.display='none'"
                    style="background:none; border:none; cursor:pointer; color:var(--color-gray-400); padding:4px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.bank-accounts.store') }}" enctype="multipart/form-data"
              style="padding:20px 24px;">
            @csrf
            @include('admin.bank-accounts._form')
            <div style="display:flex; gap:10px; margin-top:20px;">
                <button type="button" onclick="document.getElementById('modal-add').style.display='none'"
                        style="flex:1; padding:10px; border:1px solid var(--color-border); border-radius:8px; background:white; cursor:pointer; font-size:13.5px; color:var(--color-gray-700);">
                    Batal
                </button>
                <button type="submit"
                        style="flex:1; padding:10px; background:var(--color-primary); color:white; border:none; border-radius:8px; cursor:pointer; font-size:13.5px; font-weight:600;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL EDIT ===== --}}
<div id="modal-edit" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9998;
     align-items:center; justify-content:center; padding:20px;">
    <div style="background:white; border-radius:16px; width:100%; max-width:520px; max-height:90vh; overflow-y:auto;">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:20px 24px 16px;
                    border-bottom:1px solid var(--color-border);">
            <h2 style="font-size:16px; font-weight:700; margin:0; color:var(--color-gray-900);">Edit Rekening</h2>
            <button onclick="document.getElementById('modal-edit').style.display='none'"
                    style="background:none; border:none; cursor:pointer; color:var(--color-gray-400); padding:4px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="form-edit" method="POST" action="" enctype="multipart/form-data"
              style="padding:20px 24px;">
            @csrf @method('PUT')
            @include('admin.bank-accounts._form')
            <div style="display:flex; gap:10px; margin-top:20px;">
                <button type="button" onclick="document.getElementById('modal-edit').style.display='none'"
                        style="flex:1; padding:10px; border:1px solid var(--color-border); border-radius:8px; background:white; cursor:pointer; font-size:13.5px; color:var(--color-gray-700);">
                    Batal
                </button>
                <button type="submit"
                        style="flex:1; padding:10px; background:var(--color-primary); color:white; border:none; border-radius:8px; cursor:pointer; font-size:13.5px; font-weight:600;">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEdit(id, bank_name, account_number, account_holder, branch, is_active, sort_order) {
    const modal = document.getElementById('modal-edit');
    const form  = document.getElementById('form-edit');

    form.action = '/admin/rekening/' + id;

    form.querySelector('[name="bank_name"]').value      = bank_name;
    form.querySelector('[name="account_number"]').value = account_number;
    form.querySelector('[name="account_holder"]').value = account_holder;
    form.querySelector('[name="branch"]').value         = branch;
    form.querySelector('[name="sort_order"]').value     = sort_order;

    const toggle = form.querySelector('[name="is_active"]');
    if (toggle) {
        toggle.checked = is_active;
        // Update toggle visual
        const span = toggle.nextElementSibling;
        if (span) span.style.background = is_active ? 'var(--color-primary)' : '#d1d5db';
    }

    modal.style.display = 'flex';
}
</script>
@endpush
@endsection
