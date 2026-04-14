@extends('layouts.admin')

@section('title', 'Integrasi')

@section('content')
<div style="max-width: 860px;">

    {{-- Header --}}
    <div style="margin-bottom:28px;">
        <h1 style="font-size:22px; font-weight:700; color:var(--color-gray-900); margin:0 0 4px;">Integrasi</h1>
        <p style="font-size:13.5px; color:var(--color-gray-500); margin:0;">Hubungkan platform dengan layanan pihak ketiga untuk otomasi pesan dan analitik.</p>
    </div>

    {{-- Flash --}}
    @if(session('success'))
    <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:12px 16px;
                color:#166534; font-size:13.5px; display:flex; align-items:center; gap:10px; margin-bottom:20px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Loop tiap grup integrasi --}}
    @php
        $groupIcons = [
            'wa_fonnte'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
            'meta_pixel' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
            'meta_capi'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        ];
        $groupColors = [
            'wa_fonnte'  => '#22c55e',
            'meta_pixel' => '#3b82f6',
            'meta_capi'  => '#8b5cf6',
        ];
    @endphp

    <div style="display:flex; flex-direction:column; gap:20px;">
    @foreach($schema as $groupKey => $groupDef)
    @php
        $isActive = optional($settings->get($groupKey.'_active'))->value === '1';
    @endphp
    <div style="background:white; border-radius:14px; border:1px solid var(--color-border); overflow:hidden;">
        {{-- Card Header --}}
        <div style="display:flex; align-items:center; gap:14px; padding:18px 24px; border-bottom:1px solid var(--color-border);
                    background:linear-gradient(135deg, {{ $groupColors[$groupKey] }}08, white);">
            <div style="width:42px; height:42px; border-radius:10px; background:{{ $groupColors[$groupKey] }}18;
                        display:flex; align-items:center; justify-content:center; color:{{ $groupColors[$groupKey] }}; flex-shrink:0;">
                {!! $groupIcons[$groupKey] !!}
            </div>
            <div style="flex:1;">
                <div style="font-size:15px; font-weight:700; color:var(--color-gray-900);">{{ $groupDef['label'] }}</div>
                <div style="font-size:12.5px; color:var(--color-gray-500); margin-top:2px;">
                    @if($groupKey === 'wa_fonnte') Kirim notifikasi WhatsApp otomatis ke donatur via Fonnte
                    @elseif($groupKey === 'meta_pixel') Lacak konversi dan event dari website ke Meta Ads
                    @elseif($groupKey === 'meta_capi') Kirim event server-side langsung ke Meta Conversions API
                    @endif
                </div>
            </div>
            {{-- Status badge --}}
            <div style="padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600;
                        background:{{ $isActive ? '#dcfce7' : '#f3f4f6' }};
                        color:{{ $isActive ? '#166534' : '#6b7280' }};">
                {{ $isActive ? '● Aktif' : '○ Nonaktif' }}
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.integrations.update', $groupKey) }}" style="padding:20px 24px;">
            @csrf @method('PUT')

            <div style="display:grid; gap:16px;">
                @foreach($groupDef['fields'] as $field)
                @php $currentVal = optional($settings->get($field['key']))->value; @endphp

                @if($field['type'] === 'toggle')
                    {{-- Toggle aktif/nonaktif --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; background:var(--color-muted); border-radius:8px; padding:12px 14px;">
                        <div>
                            <div style="font-size:13px; font-weight:600; color:var(--color-gray-800);">{{ $field['label'] }}</div>
                        </div>
                        @php $togId = 'toggle_'.$field['key']; $togChecked = $currentVal === '1'; @endphp
                        <label for="{{ $togId }}" style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
                            <input type="checkbox" id="{{ $togId }}" name="{{ $field['key'] }}" value="1"
                                   {{ $togChecked ? 'checked' : '' }}
                                   style="opacity:0; width:0; height:0;"
                                   onchange="this.nextElementSibling.style.background = this.checked ? '{{ $groupColors[$groupKey] }}' : '#d1d5db'">
                            <span style="position:absolute; inset:0; border-radius:12px; transition:background .2s;
                                         background:{{ $togChecked ? $groupColors[$groupKey] : '#d1d5db' }};">
                                <span style="position:absolute; left:{{ $togChecked ? '22' : '2' }}px; top:2px; width:20px; height:20px;
                                             background:white; border-radius:50%; transition:left .2s;"></span>
                            </span>
                        </label>
                    </div>

                @elseif($field['type'] === 'password')
                    <div>
                        <label for="field_{{ $field['key'] }}" style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">
                            {{ $field['label'] }}
                        </label>
                        <div style="position:relative;">
                            <input type="password" id="field_{{ $field['key'] }}" name="{{ $field['key'] }}"
                                   placeholder="{{ $currentVal ? '••••••••••••••• (sudah tersimpan)' : ($field['placeholder'] ?? '') }}"
                                   style="width:100%; padding:9px 40px 9px 12px; border:1px solid var(--color-border); border-radius:8px;
                                          font-size:13.5px; font-family:var(--font-body); color:var(--color-gray-800); box-sizing:border-box; outline:none;">
                            <button type="button"
                                    onclick="const i=this.previousElementSibling; i.type=i.type==='password'?'text':'password';"
                                    style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer; color:var(--color-gray-400); padding:2px;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @if($currentVal)
                        <p style="font-size:11.5px; color:var(--color-gray-400); margin:4px 0 0;">Kosongkan jika tidak ingin mengubah token.</p>
                        @endif
                    </div>

                @else
                    <div>
                        <label for="field_{{ $field['key'] }}" style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">
                            {{ $field['label'] }}
                        </label>
                        <input type="text" id="field_{{ $field['key'] }}" name="{{ $field['key'] }}"
                               value="{{ $currentVal }}" placeholder="{{ $field['placeholder'] ?? '' }}"
                               style="width:100%; padding:9px 12px; border:1px solid var(--color-border); border-radius:8px;
                                      font-size:13.5px; font-family:var(--font-body); color:var(--color-gray-800); box-sizing:border-box; outline:none;">
                    </div>
                @endif
                @endforeach
            </div>

            <div style="margin-top:20px; display:flex; justify-content:flex-end;">
                <button type="submit"
                        style="padding:9px 22px; background:{{ $groupColors[$groupKey] }}; color:white; border:none;
                               border-radius:8px; font-size:13.5px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan {{ $groupDef['label'] }}
                </button>
            </div>
        </form>
    </div>
    @endforeach
    </div>

</div>

<style>
input[type="checkbox"]:checked + span span { left: 22px !important; }
</style>
@endsection
