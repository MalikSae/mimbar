@extends('layouts.admin')

@section('title', 'Detail Pengajuan #' . $proposal->id)

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    {{-- Back button --}}
    <a href="{{ route('admin.masjid.index') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: var(--color-primary); text-decoration: none; font-weight: 500;"
       onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Daftar
    </a>

    {{-- Download PDF Button --}}
    <a href="{{ route('admin.masjid.pdf', $proposal->id) }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: var(--color-white); background: var(--color-gray-900); padding: 8px 16px; border-radius: var(--radius-lg); text-decoration: none; font-weight: 600;"
       onmouseover="this.style.background='var(--color-black)'" onmouseout="this.style.background='var(--color-gray-900)'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        Download PDF
    </a>
</div>

{{-- Page Header --}}
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin: 0;">
            Detail Pengajuan #{{ $proposal->id }}
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-400); margin: 4px 0 0;">{{ $proposal->nama_organisasi_pemohon }}</p>
    </div>
    @php
        $statusStyles = [
            'pending'   => ['bg' => 'var(--color-warning-surface)', 'color' => 'var(--color-warning)'],
            'diproses'  => ['bg' => 'var(--color-info-surface)', 'color' => 'var(--color-info)'],
            'disetujui' => ['bg' => 'var(--color-success-surface)', 'color' => 'var(--color-success)'],
            'ditolak'   => ['bg' => 'var(--color-danger-surface)', 'color' => 'var(--color-danger)'],
        ];
        $s = $statusStyles[$proposal->status] ?? $statusStyles['pending'];
    @endphp
    <span style="padding: 6px 18px; border-radius: var(--radius-full); font-size: 13px; font-weight: 600; background: {{ $s['bg'] }}; color: {{ $s['color'] }}; text-transform: capitalize;">
        {{ $proposal->status }}
    </span>
</div>

{{-- Flash message --}}
@if (session('success'))
<div style="background: var(--color-success-surface); border: 1px solid var(--color-success); border-radius: var(--radius-lg); padding: 12px 16px; margin-bottom: 20px; font-size: 13px; color: var(--color-success); display: flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    {{ session('success') }}
</div>
@endif

@php
    $cardStyle = 'background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl); padding: 24px; margin-bottom: 20px;';
    $cardTitleStyle = 'font-family: var(--font-heading); font-size: 16px; font-weight: 700; color: var(--color-primary); margin: 0 0 16px; padding-bottom: 12px; border-bottom: 1px solid var(--color-border);';
    $rowStyle = 'display: grid; grid-template-columns: 180px 1fr; gap: 8px; padding: 8px 0; border-bottom: 1px solid var(--color-muted);';
    $labelStyle = 'font-size: 13px; font-weight: 600; color: var(--color-gray-600);';
    $valueStyle = 'font-size: 13px; color: var(--color-gray-900); word-break: break-word; white-space: pre-wrap;';
@endphp

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">

    {{-- ═══ LEFT COLUMN — Detail ═══ --}}
    <div>

        {{-- Card: Biodata Pemohon --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Biodata Pemohon</h3>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Nama Organisasi</span><span style="{{ $valueStyle }}">{{ $proposal->nama_organisasi_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Alamat</span><span style="{{ $valueStyle }}">{{ $proposal->alamat_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">No. Telp</span><span style="{{ $valueStyle }}">{{ $proposal->no_telp_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Email</span><span style="{{ $valueStyle }}">{{ $proposal->email_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Penanggung Jawab</span><span style="{{ $valueStyle }}">{{ $proposal->nama_penanggung_jawab_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">No. Telp PJ</span><span style="{{ $valueStyle }}">{{ $proposal->no_telp_pj_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Email PJ</span><span style="{{ $valueStyle }}">{{ $proposal->email_pj_pemohon ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Mengenal Yayasan</span><span style="{{ $valueStyle }}">{{ $proposal->mengenal_yayasan_melalui ?? '-' }}</span></div>
            <div style="{{ $rowStyle }} border-bottom: none;"><span style="{{ $labelStyle }}">Latar Belakang</span><span style="{{ $valueStyle }}">{{ $proposal->latar_belakang_proposal ?? '-' }}</span></div>
        </div>

        {{-- Card: Biodata Calon Penerima --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Biodata Calon Penerima</h3>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Nama Organisasi</span><span style="{{ $valueStyle }}">{{ $proposal->nama_organisasi_penerima ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Penanggung Jawab</span><span style="{{ $valueStyle }}">{{ $proposal->nama_penanggung_jawab_penerima ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">No. Telp</span><span style="{{ $valueStyle }}">{{ $proposal->no_telp_penerima ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Email</span><span style="{{ $valueStyle }}">{{ $proposal->email_penerima ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Masyarakat (KK)</span><span style="{{ $valueStyle }}">{{ $proposal->pemakmur_masjid_kk ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Masyarakat</span><span style="{{ $valueStyle }}">{{ $proposal->pemakmur_masjid_masyarakat ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Lembaga Pendidikan</span><span style="{{ $valueStyle }}">{{ $proposal->pemakmur_lembaga_pendidikan ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Jumlah Siswa</span><span style="{{ $valueStyle }}">{{ $proposal->pemakmur_lembaga_pendidikan_siswa ?? '-' }}</span></div>
            <div style="{{ $rowStyle }} border-bottom: none;"><span style="{{ $labelStyle }}">Perkiraan Pemakmur</span><span style="{{ $valueStyle }}">{{ $proposal->perkiraan_jumlah_pemakmur ? $proposal->perkiraan_jumlah_pemakmur . ' Orang' : '-' }}</span></div>
        </div>

        {{-- Card: Data Lokasi --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Data Lokasi</h3>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Alamat Lokasi</span><span style="{{ $valueStyle }}">{{ $proposal->alamat_calon_lokasi ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Kecamatan</span><span style="{{ $valueStyle }}">{{ $proposal->kecamatan ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Kabupaten / Kota</span><span style="{{ $valueStyle }}">{{ $proposal->kabupaten ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Provinsi</span><span style="{{ $valueStyle }}">{{ $proposal->provinsi ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Koordinat GPS</span><span style="{{ $valueStyle }}">{{ $proposal->koordinat_gps ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Status Tanah</span><span style="{{ $valueStyle }}">{{ $proposal->status_tanah ?? '-' }}</span></div>
            <div style="{{ $rowStyle }} border-bottom: none;"><span style="{{ $labelStyle }}">Luas Tanah</span><span style="{{ $valueStyle }}">{{ $proposal->luas_tanah ? $proposal->luas_tanah . ' M²' : '-' }}</span></div>
        </div>

        {{-- Card: Kondisi Lokasi --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Kondisi Lokasi</h3>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Kondisi Pecel</span><span style="{{ $valueStyle }}">{{ $proposal->kondisi_pecel ?? '-' }}{{ $proposal->ukuran_masjid_existing ? ' (' . $proposal->ukuran_masjid_existing . ' M²)' : '' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Jalan Masuk</span><span style="{{ $valueStyle }}">{{ $proposal->jalan_masuk ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Jaringan Listrik</span><span style="{{ $valueStyle }}">{{ $proposal->jaringan_listrik ?? '-' }}{{ $proposal->jarak_listrik ? ' (Jarak: ' . $proposal->jarak_listrik . ' M)' : '' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Lokasi Pemukiman</span><span style="{{ $valueStyle }}">{{ $proposal->lokasi_dengan_pemukiman ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Rencana Masjid</span><span style="{{ $valueStyle }}">{{ $proposal->ukuran_rencana_masjid ? $proposal->ukuran_rencana_masjid . ' M²' : '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Rencana Wudhu</span><span style="{{ $valueStyle }}">{{ $proposal->ukuran_rencana_wudhu ? $proposal->ukuran_rencana_wudhu . ' M²' : '-' }}</span></div>
            <div style="{{ $rowStyle }} border-bottom: none;"><span style="{{ $labelStyle }}">Jarak Masjid Terdekat</span><span style="{{ $valueStyle }}">{{ $proposal->jarak_mushola_masjid_terdekat ? $proposal->jarak_mushola_masjid_terdekat . ' M' : '-' }}</span></div>
        </div>

        {{-- Card: Biodata Calon Imam --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Biodata Calon Imam</h3>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Nama</span><span style="{{ $valueStyle }}">{{ $proposal->imam_nama ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">TTL</span><span style="{{ $valueStyle }}">{{ $proposal->imam_ttl ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Alamat</span><span style="{{ $valueStyle }}">{{ $proposal->imam_alamat ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">No. Telp</span><span style="{{ $valueStyle }}">{{ $proposal->imam_no_telp ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Email</span><span style="{{ $valueStyle }}">{{ $proposal->imam_email ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Status Perkawinan</span><span style="{{ $valueStyle }}">{{ $proposal->imam_status_perkawinan ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Pekerjaan</span><span style="{{ $valueStyle }}">{{ $proposal->imam_pekerjaan ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Pendidikan</span><span style="{{ $valueStyle }}">{{ $proposal->imam_pendidikan_terakhir ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Komputer</span><span style="{{ $valueStyle }}">{{ $proposal->imam_kemampuan_komputer ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Pengalaman Dakwah</span><span style="{{ $valueStyle }}">{{ $proposal->imam_pengalaman_dakwah ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Kegiatan Dakwah</span><span style="{{ $valueStyle }}">{{ $proposal->imam_kegiatan_dakwah ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Hafalan Qur'an</span><span style="{{ $valueStyle }}">{{ $proposal->imam_hafalan_quran ? $proposal->imam_hafalan_quran . ' Juz' : '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Hafalan Hadis</span><span style="{{ $valueStyle }}">{{ $proposal->imam_hafalan_hadis ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Bahasa Arab</span><span style="{{ $valueStyle }}">{{ $proposal->imam_bahasa_arab_lisan ? 'Lisan' : '' }}{{ $proposal->imam_bahasa_arab_lisan && $proposal->imam_bahasa_arab_tulisan ? ', ' : '' }}{{ $proposal->imam_bahasa_arab_tulisan ? 'Tulisan' : '' }}{{ !$proposal->imam_bahasa_arab_lisan && !$proposal->imam_bahasa_arab_tulisan ? '-' : '' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Bahasa Inggris</span><span style="{{ $valueStyle }}">{{ $proposal->imam_bahasa_inggris_lisan ? 'Lisan' : '' }}{{ $proposal->imam_bahasa_inggris_lisan && $proposal->imam_bahasa_inggris_tulisan ? ', ' : '' }}{{ $proposal->imam_bahasa_inggris_tulisan ? 'Tulisan' : '' }}{{ !$proposal->imam_bahasa_inggris_lisan && !$proposal->imam_bahasa_inggris_tulisan ? '-' : '' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Bahasa Daerah</span><span style="{{ $valueStyle }}">{{ $proposal->imam_bahasa_daerah ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Pelatihan</span><span style="{{ $valueStyle }}">{{ $proposal->imam_pelatihan ?? '-' }}</span></div>
            <div style="{{ $rowStyle }}"><span style="{{ $labelStyle }}">Pengalaman Kerja</span><span style="{{ $valueStyle }}">{{ $proposal->imam_pengalaman_kerja ?? '-' }}</span></div>
            <div style="{{ $rowStyle }} border-bottom: none;"><span style="{{ $labelStyle }}">Rencana Kegiatan</span><span style="{{ $valueStyle }}">{{ $proposal->imam_rencana_kegiatan ?? '-' }}</span></div>
        </div>

        {{-- Card: Dokumen & Foto --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Dokumen & Foto</h3>
            @if ($proposal->files->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px;">
                @foreach ($proposal->files as $file)
                <div style="border: 1px solid var(--color-border); border-radius: var(--radius-lg); overflow: hidden;">
                    @php
                        $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        $typeLabels = [
                            'ktp' => 'KTP',
                            'sertifikat_tanah' => 'Sertifikat Tanah',
                            'foto_lokasi_1' => 'Foto Lokasi 1',
                            'foto_lokasi_2' => 'Foto Lokasi 2',
                            'foto_lokasi_3' => 'Foto Lokasi 3',
                            'foto_lokasi_4' => 'Foto Lokasi 4',
                            'foto_jalan' => 'Foto Jalan',
                            'foto_lain' => 'Foto Lain',
                        ];
                    @endphp
                    @if ($isImage)
                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->file_type }}"
                                 style="width: 100%; height: 140px; object-fit: cover; display: block;">
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                           style="display: flex; align-items: center; justify-content: center; height: 140px; background: var(--color-muted); text-decoration: none;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--color-gray-400)" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </a>
                    @endif
                    <div style="padding: 8px 12px; font-size: 11px; font-weight: 600; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.03em; border-top: 1px solid var(--color-border);">
                        {{ $typeLabels[$file->file_type] ?? $file->file_type }}
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p style="font-size: 13px; color: var(--color-gray-400); margin: 0;">Tidak ada dokumen yang dilampirkan.</p>
            @endif
        </div>
    </div>

    {{-- ═══ RIGHT COLUMN — Sidebar ═══ --}}
    <div>

        {{-- Card: Update Status --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Update Status</h3>
            <form method="POST" action="{{ route('admin.masjid.update', $proposal->id) }}">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600); margin-bottom: 6px;">Status</label>
                    <select name="status" style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body); color: var(--color-gray-900); background: var(--color-white);">
                        <option value="pending" {{ $proposal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $proposal->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="disetujui" {{ $proposal->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $proposal->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600); margin-bottom: 6px;">Catatan Admin</label>
                    <textarea name="catatan_admin" rows="4" style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body); color: var(--color-gray-900); resize: vertical;" placeholder="Catatan opsional...">{{ $proposal->catatan_admin }}</textarea>
                </div>

                <button type="submit" style="width: 100%; padding: 10px; background: var(--color-primary); color: var(--color-white); border: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font-body); transition: background 0.2s;"
                        onmouseover="this.style.background='var(--color-primary-dark)'" onmouseout="this.style.background='var(--color-primary)'">
                    Simpan Status
                </button>
            </form>
        </div>

        {{-- Card: Info Pengajuan --}}
        <div style="{{ $cardStyle }}">
            <h3 style="{{ $cardTitleStyle }}">Info Pengajuan</h3>
            <div style="margin-bottom: 12px;">
                <div style="font-size: 12px; color: var(--color-gray-400); margin-bottom: 2px;">Tanggal Masuk</div>
                <div style="font-size: 14px; font-weight: 600; color: var(--color-gray-900);">{{ $proposal->created_at->format('d M Y H:i') }}</div>
            </div>
            <div style="margin-bottom: 12px;">
                <div style="font-size: 12px; color: var(--color-gray-400); margin-bottom: 2px;">Status Saat Ini</div>
                <span style="display: inline-block; padding: 4px 12px; border-radius: var(--radius-full); font-size: 11px; font-weight: 600; background: {{ $s['bg'] }}; color: {{ $s['color'] }}; text-transform: capitalize;">
                    {{ $proposal->status }}
                </span>
            </div>
            @if ($proposal->catatan_admin)
            <div>
                <div style="font-size: 12px; color: var(--color-gray-400); margin-bottom: 2px;">Catatan Admin</div>
                <div style="font-size: 13px; color: var(--color-gray-600); background: var(--color-muted); padding: 10px; border-radius: var(--radius-lg);">{{ $proposal->catatan_admin }}</div>
            </div>
            @endif
        </div>

        {{-- Hapus Pengajuan --}}
        <div style="{{ $cardStyle }} border-color: var(--color-danger-surface);" x-data="{ confirmDelete: false }">
            <h3 style="font-family: var(--font-heading); font-size: 14px; font-weight: 700; color: var(--color-danger); margin: 0 0 12px;">Zona Berbahaya</h3>
            <p style="font-size: 12px; color: var(--color-gray-600); margin: 0 0 14px;">Menghapus pengajuan akan menghapus semua data dan file yang terkait secara permanen.</p>

            <button @click="confirmDelete = true" x-show="!confirmDelete"
                    style="width: 100%; padding: 10px; background: var(--color-white); color: var(--color-danger); border: 1px solid var(--color-danger); border-radius: var(--radius-lg); font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font-body);">
                Hapus Pengajuan
            </button>

            <div x-show="confirmDelete" x-cloak>
                <p style="font-size: 12px; color: var(--color-danger); font-weight: 600; margin: 0 0 10px;">Yakin ingin menghapus pengajuan ini?</p>
                <div style="display: flex; gap: 8px;">
                    <form method="POST" action="{{ route('admin.masjid.destroy', $proposal->id) }}" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="width: 100%; padding: 10px; background: var(--color-danger); color: var(--color-white); border: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font-body);">
                            Ya, Hapus
                        </button>
                    </form>
                    <button @click="confirmDelete = false"
                            style="flex: 1; padding: 10px; background: var(--color-muted); color: var(--color-gray-600); border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 13px; font-weight: 500; cursor: pointer; font-family: var(--font-body);">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
