@extends('layouts.app')

@section('title', 'Formulir Pengajuan Calon Lokasi Masjid — Yayasan Mimbar Al-Tauhid')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 40px 20px;">

    {{-- Logo Centered --}}
    <div style="display: flex; justify-content: center; margin-bottom: 32px; padding-top: 16px;">
        <a href="{{ url('/') }}" style="display: inline-block;">
            <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-LIGHT-MODE.webp') }}" alt="Yayasan Mimbar Al-Tauhid" style="height: 56px; width: auto; display: block;">
        </a>
    </div>

    {{-- Header --}}
    <div style="text-align: center; margin-bottom: 36px;">
        <h1 style="font-family: var(--font-heading); font-size: 26px; font-weight: 700; color: var(--color-primary); margin: 0 0 8px;">
            Formulir Pengajuan Calon Lokasi Masjid
        </h1>
        <p style="color: var(--color-gray-600); font-size: 14px; margin: 0;">
            Isi formulir di bawah ini dengan lengkap dan benar.
        </p>
    </div>

    {{-- Global Errors --}}
    @if ($errors->any())
    <div style="background: var(--color-danger-surface); border: 1px solid var(--color-danger); border-radius: var(--radius-lg); padding: 16px; margin-bottom: 24px;">
        <p style="font-weight: 600; color: var(--color-danger); margin: 0 0 8px; font-size: 14px;">Terdapat kesalahan pada formulir:</p>
        <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: var(--color-danger);">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('masjid.proposal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @php
            $fieldStyle = 'width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 14px; font-family: var(--font-body); color: var(--color-gray-900); background: var(--color-white); outline: none; transition: border-color 0.2s; box-sizing: border-box;';
            $labelStyle = 'display: block; font-size: 13px; font-weight: 600; color: var(--color-gray-900); margin-bottom: 6px;';
            $groupStyle = 'margin-bottom: 18px;';
            $errorStyle = 'font-size: 12px; color: var(--color-danger); margin-top: 4px;';
        @endphp

        {{-- ═══ SECTION 1: Biodata Pemohon ═══ --}}
        <div class="form-section">
            <div class="form-section-header">Biodata Pemohon</div>
            <div class="form-section-body">

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Nama Organisasi <span style="color: var(--color-danger);">*</span></label>
                <input type="text" name="nama_organisasi_pemohon" value="{{ old('nama_organisasi_pemohon') }}" style="{{ $fieldStyle }}" placeholder="Nama organisasi pemohon">
                @error('nama_organisasi_pemohon') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Alamat</label>
                <textarea name="alamat_pemohon" rows="3" style="{{ $fieldStyle }} resize: vertical;" placeholder="Alamat lengkap organisasi">{{ old('alamat_pemohon') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; {{ $groupStyle }}">
                <div>
                    <label style="{{ $labelStyle }}">No. Telp / HP <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="no_telp_pemohon" value="{{ old('no_telp_pemohon') }}" style="{{ $fieldStyle }}" placeholder="08xxxxxxxxxx">
                    @error('no_telp_pemohon') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Email</label>
                    <input type="email" name="email_pemohon" value="{{ old('email_pemohon') }}" style="{{ $fieldStyle }}" placeholder="email@contoh.com">
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Penanggung Jawab <span style="color: var(--color-danger);">*</span></label>
                <input type="text" name="nama_penanggung_jawab_pemohon" value="{{ old('nama_penanggung_jawab_pemohon') }}" style="{{ $fieldStyle }}" placeholder="Nama penanggung jawab">
                @error('nama_penanggung_jawab_pemohon') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; {{ $groupStyle }}">
                <div>
                    <label style="{{ $labelStyle }}">No. Telp PJ</label>
                    <input type="text" name="no_telp_pj_pemohon" value="{{ old('no_telp_pj_pemohon') }}" style="{{ $fieldStyle }}" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Email PJ</label>
                    <input type="email" name="email_pj_pemohon" value="{{ old('email_pj_pemohon') }}" style="{{ $fieldStyle }}" placeholder="email@contoh.com">
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Mengenal Yayasan Melalui <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                    @foreach (['Perseorangan', 'Lembaga', 'Lainnya'] as $opt)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                        <input type="radio" name="mengenal_yayasan_melalui" value="{{ $opt }}" {{ old('mengenal_yayasan_melalui') == $opt ? 'checked' : '' }}>
                        {{ $opt }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Latar Belakang Pengajuan Proposal <span style="color: var(--color-danger);">*</span></label>
                <textarea name="latar_belakang_proposal" rows="5" style="{{ $fieldStyle }} resize: vertical;" placeholder="Jelaskan latar belakang pengajuan proposal ini...">{{ old('latar_belakang_proposal') }}</textarea>
                <div style="font-size: 12px; color: var(--color-gray-400); margin-top: 4px;">Minimal 100 karakter</div>
                @error('latar_belakang_proposal') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 2: Biodata Calon Penerima ═══ --}}
        <div class="form-section">
            <div class="form-section-header">Biodata Calon Penerima</div>
            <div class="form-section-body">

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Nama Organisasi <span style="color: var(--color-danger);">*</span></label>
                <input type="text" name="nama_organisasi_penerima" value="{{ old('nama_organisasi_penerima') }}" style="{{ $fieldStyle }}" placeholder="Nama organisasi penerima">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Penanggung Jawab</label>
                <input type="text" name="nama_penanggung_jawab_penerima" value="{{ old('nama_penanggung_jawab_penerima') }}" style="{{ $fieldStyle }}" placeholder="Nama PJ penerima">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Lampiran Scan KTP <span style="color: var(--color-danger);">*</span></label>
                <input type="file" name="lampiran_ktp" accept=".jpg,.jpeg,.png,.pdf" style="{{ $fieldStyle }} padding: 8px;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; {{ $groupStyle }}">
                <div>
                    <label style="{{ $labelStyle }}">No. Telp</label>
                    <input type="text" name="no_telp_penerima" value="{{ old('no_telp_penerima') }}" style="{{ $fieldStyle }}" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Email</label>
                    <input type="email" name="email_penerima" value="{{ old('email_penerima') }}" style="{{ $fieldStyle }}" placeholder="email@contoh.com">
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pemakmur Masjid</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px; display: block;">Masyarakat (KK)</label>
                        <input type="text" name="pemakmur_masjid_kk" value="{{ old('pemakmur_masjid_kk') }}" style="{{ $fieldStyle }}" placeholder="Jumlah KK">
                    </div>
                    <div>
                        <label style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px; display: block;">Masyarakat</label>
                        <input type="text" name="pemakmur_masjid_masyarakat" value="{{ old('pemakmur_masjid_masyarakat') }}" style="{{ $fieldStyle }}" placeholder="Jumlah masyarakat">
                    </div>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px; display: block;">Lembaga Pendidikan</label>
                        <input type="text" name="pemakmur_lembaga_pendidikan" value="{{ old('pemakmur_lembaga_pendidikan') }}" style="{{ $fieldStyle }}" placeholder="Nama lembaga">
                    </div>
                    <div>
                        <label style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px; display: block;">Jumlah Siswa</label>
                        <input type="text" name="pemakmur_lembaga_pendidikan_siswa" value="{{ old('pemakmur_lembaga_pendidikan_siswa') }}" style="{{ $fieldStyle }}" placeholder="Jumlah siswa">
                    </div>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Perkiraan Jumlah Pemakmur Aktif <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="text" name="perkiraan_jumlah_pemakmur" value="{{ old('perkiraan_jumlah_pemakmur') }}" style="{{ $fieldStyle }} max-width: 200px;" placeholder="Jumlah">
                    <span style="font-size: 14px; color: var(--color-gray-600);">Orang</span>
                </div>
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 3: Data Lokasi ═══ --}}
        <div class="form-section">
            <div class="form-section-header">Data Lokasi</div>
            <div class="form-section-body">

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Alamat Calon Lokasi <span style="color: var(--color-danger);">*</span></label>
                <textarea name="alamat_calon_lokasi" rows="3" style="{{ $fieldStyle }} resize: vertical;" placeholder="Alamat lengkap calon lokasi">{{ old('alamat_calon_lokasi') }}</textarea>
                @error('alamat_calon_lokasi') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; {{ $groupStyle }}">
                <div>
                    <label style="{{ $labelStyle }}">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" style="{{ $fieldStyle }}" placeholder="Kecamatan">
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Kabupaten / Kota <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="kabupaten" value="{{ old('kabupaten') }}" style="{{ $fieldStyle }}" placeholder="Kabupaten/Kota">
                    @error('kabupaten') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Provinsi <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="provinsi" value="{{ old('provinsi') }}" style="{{ $fieldStyle }}" placeholder="Provinsi">
                    @error('provinsi') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Koordinat GPS</label>
                <input type="text" name="koordinat_gps" value="{{ old('koordinat_gps') }}" style="{{ $fieldStyle }}" placeholder="Koordinat GPS (contoh: -6.xxxxx, 106.xxxxx)">
                <div style="font-size: 12px; color: var(--color-info); margin-top: 4px;">
                    <a href="https://support.google.com/maps/answer/18539?hl=id" target="_blank" style="color: var(--color-info); text-decoration: underline;">Tutorial pengisian koordinat GPS →</a>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Status Tanah</label>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    @foreach (['Sertifikat Wakaf', 'Proses Wakaf', 'Milik Pribadi', 'Milik Lembaga'] as $opt)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                        <input type="radio" name="status_tanah" value="{{ $opt }}" {{ old('status_tanah') == $opt ? 'checked' : '' }}>
                        {{ $opt }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Lampiran Status Tanah</label>
                <input type="file" name="lampiran_tanah" accept=".jpg,.jpeg,.png,.pdf" style="{{ $fieldStyle }} padding: 8px;">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Luas Tanah</label>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="text" name="luas_tanah" value="{{ old('luas_tanah') }}" style="{{ $fieldStyle }} max-width: 200px;" placeholder="Luas">
                    <span style="font-size: 14px; color: var(--color-gray-600);">M²</span>
                </div>
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 4: Kondisi Lokasi ═══ --}}
        <div class="form-section" x-data="{ kondisiPecel: '{{ old('kondisi_pecel', '') }}', jaringanListrik: '{{ old('jaringan_listrik', '') }}' }">
            <div class="form-section-header">Kondisi Lokasi</div>
            <div class="form-section-body">

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Kondisi Pecel <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                        <input type="radio" name="kondisi_pecel" value="Tanah Kosong" x-model="kondisiPecel">
                        Tanah Kosong
                    </label>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                            <input type="radio" name="kondisi_pecel" value="Sudah Ada Masjid" x-model="kondisiPecel">
                            Sudah Ada Masjid, Ukuran:
                        </label>
                        <div style="display: flex; align-items: center; gap: 6px;" x-show="kondisiPecel === 'Sudah Ada Masjid'">
                            <input type="text" name="ukuran_masjid_existing" value="{{ old('ukuran_masjid_existing') }}" style="{{ $fieldStyle }} max-width: 120px;" placeholder="Ukuran">
                            <span style="font-size: 14px; color: var(--color-gray-600);">M²</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Jalan Masuk <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    @foreach (['Jalan Aspal', 'Jalan Beton', 'Jalan Batu', 'Jalan Tanah, Setapak'] as $opt)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                        <input type="radio" name="jalan_masuk" value="{{ $opt }}" {{ old('jalan_masuk') == $opt ? 'checked' : '' }}>
                        {{ $opt }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Jaringan Listrik <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                        <input type="radio" name="jaringan_listrik" value="Sudah Ada" x-model="jaringanListrik">
                        Sudah Ada
                    </label>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                            <input type="radio" name="jaringan_listrik" value="Belum Ada" x-model="jaringanListrik">
                            Belum Ada, Jarak Terdekat:
                        </label>
                        <div style="display: flex; align-items: center; gap: 6px;" x-show="jaringanListrik === 'Belum Ada'">
                            <input type="text" name="jarak_listrik" value="{{ old('jarak_listrik') }}" style="{{ $fieldStyle }} max-width: 120px;" placeholder="Jarak">
                            <span style="font-size: 14px; color: var(--color-gray-600);">M</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Lokasi dengan Pemukiman <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    @foreach (['Pinggir Jalan Raya', 'Perkampungan', 'Perumahan'] as $opt)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                        <input type="radio" name="lokasi_dengan_pemukiman" value="{{ $opt }}" {{ old('lokasi_dengan_pemukiman') == $opt ? 'checked' : '' }}>
                        {{ $opt }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Ukuran Rencana Bangunan <span style="color: var(--color-danger);">*</span></label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px; display: block;">Masjid</label>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <input type="text" name="ukuran_rencana_masjid" value="{{ old('ukuran_rencana_masjid') }}" style="{{ $fieldStyle }}" placeholder="Ukuran">
                            <span style="font-size: 14px; color: var(--color-gray-600); white-space: nowrap;">M²</span>
                        </div>
                    </div>
                    <div>
                        <label style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 4px; display: block;">Tempat Wudhu</label>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <input type="text" name="ukuran_rencana_wudhu" value="{{ old('ukuran_rencana_wudhu') }}" style="{{ $fieldStyle }}" placeholder="Ukuran">
                            <span style="font-size: 14px; color: var(--color-gray-600); white-space: nowrap;">M²</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Jarak Mushola / Masjid Terdekat <span style="color: var(--color-danger);">*</span></label>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="text" name="jarak_mushola_masjid_terdekat" value="{{ old('jarak_mushola_masjid_terdekat') }}" style="{{ $fieldStyle }} max-width: 200px;" placeholder="Jarak">
                    <span style="font-size: 14px; color: var(--color-gray-600);">M</span>
                </div>
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 5: Biodata Calon Imam ═══ --}}
        <div class="form-section" x-data="{ imamStatus: '{{ old('imam_status_perkawinan', '') }}' }">
            <div class="form-section-header">Biodata Calon Imam</div>
            <div class="form-section-body">

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Nama <span style="color: var(--color-danger);">*</span></label>
                <input type="text" name="imam_nama" value="{{ old('imam_nama') }}" style="{{ $fieldStyle }}" placeholder="Nama lengkap calon imam">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Tempat Tanggal Lahir <span style="color: var(--color-danger);">*</span></label>
                <input type="text" name="imam_ttl" value="{{ old('imam_ttl') }}" style="{{ $fieldStyle }}" placeholder="Contoh: Sukabumi, 1 Januari 1990">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Alamat <span style="color: var(--color-danger);">*</span></label>
                <textarea name="imam_alamat" rows="2" style="{{ $fieldStyle }} resize: vertical;" placeholder="Alamat lengkap calon imam">{{ old('imam_alamat') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; {{ $groupStyle }}">
                <div>
                    <label style="{{ $labelStyle }}">No. Telp / HP <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="imam_no_telp" value="{{ old('imam_no_telp') }}" style="{{ $fieldStyle }}" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Email <span style="color: var(--color-danger);">*</span></label>
                    <input type="email" name="imam_email" value="{{ old('imam_email') }}" style="{{ $fieldStyle }}" placeholder="email@contoh.com">
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Status Perkawinan</label>
                <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                        <input type="radio" name="imam_status_perkawinan" value="Menikah" x-model="imamStatus"> Menikah
                    </label>
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                        <input type="radio" name="imam_status_perkawinan" value="Lajang" x-model="imamStatus"> Lajang
                    </label>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pekerjaan</label>
                <input type="text" name="imam_pekerjaan" value="{{ old('imam_pekerjaan') }}" style="{{ $fieldStyle }}" placeholder="Pekerjaan saat ini">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pendidikan Terakhir</label>
                <input type="text" name="imam_pendidikan_terakhir" value="{{ old('imam_pendidikan_terakhir') }}" style="{{ $fieldStyle }}" placeholder="Jenjang & institusi">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Kemampuan Komputer</label>
                <div style="display: flex; gap: 24px;">
                    @foreach (['Microsoft Office', 'Internet'] as $opt)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                        <input type="checkbox" name="imam_kemampuan_komputer[]" value="{{ $opt }}"
                            {{ is_array(old('imam_kemampuan_komputer')) && in_array($opt, old('imam_kemampuan_komputer')) ? 'checked' : '' }}>
                        {{ $opt }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pengalaman Dakwah</label>
                <textarea name="imam_pengalaman_dakwah" rows="4" style="{{ $fieldStyle }} resize: vertical;" placeholder="Uraikan pengalaman dakwah (mengajar, dakwah, dll)">{{ old('imam_pengalaman_dakwah') }}</textarea>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Kegiatan Dakwah</label>
                <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                    @foreach (['Khutbah', 'Imam', 'Penceramah', 'Pengajar Tahfizh'] as $opt)
                    <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                        <input type="checkbox" name="imam_kegiatan_dakwah[]" value="{{ $opt }}"
                            {{ is_array(old('imam_kegiatan_dakwah')) && in_array($opt, old('imam_kegiatan_dakwah')) ? 'checked' : '' }}>
                        {{ $opt }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; {{ $groupStyle }}">
                <div>
                    <label style="{{ $labelStyle }}">Hafalan Al-Qur'an</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="text" name="imam_hafalan_quran" value="{{ old('imam_hafalan_quran') }}" style="{{ $fieldStyle }} max-width: 120px;" placeholder="Jumlah">
                        <span style="font-size: 14px; color: var(--color-gray-600);">Juz</span>
                    </div>
                </div>
                <div>
                    <label style="{{ $labelStyle }}">Hafalan Hadis</label>
                    <input type="text" name="imam_hafalan_hadis" value="{{ old('imam_hafalan_hadis') }}" style="{{ $fieldStyle }}" placeholder="Contoh: Al Arba'in An Nawawiyah, 42 Hadis">
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Bahasa yang Dikuasai</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; align-items: start;">
                    <div>
                        <div style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 8px;">Bahasa Arab</div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer; margin-bottom: 6px;">
                            <input type="checkbox" name="imam_bahasa_arab_lisan" value="1" {{ old('imam_bahasa_arab_lisan') ? 'checked' : '' }}> Lisan
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                            <input type="checkbox" name="imam_bahasa_arab_tulisan" value="1" {{ old('imam_bahasa_arab_tulisan') ? 'checked' : '' }}> Tulisan
                        </label>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 8px;">Bahasa Inggris</div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer; margin-bottom: 6px;">
                            <input type="checkbox" name="imam_bahasa_inggris_lisan" value="1" {{ old('imam_bahasa_inggris_lisan') ? 'checked' : '' }}> Lisan
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                            <input type="checkbox" name="imam_bahasa_inggris_tulisan" value="1" {{ old('imam_bahasa_inggris_tulisan') ? 'checked' : '' }}> Tulisan
                        </label>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--color-gray-600); margin-bottom: 8px;">Bahasa Daerah</div>
                        <input type="text" name="imam_bahasa_daerah" value="{{ old('imam_bahasa_daerah') }}" style="{{ $fieldStyle }}" placeholder="Bahasa daerah">
                    </div>
                </div>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pelatihan yang Pernah Diikuti</label>
                <textarea name="imam_pelatihan" rows="3" style="{{ $fieldStyle }} resize: vertical;" placeholder="Sebutkan pelatihan yang pernah diikuti">{{ old('imam_pelatihan') }}</textarea>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pengalaman Kerja</label>
                <textarea name="imam_pengalaman_kerja" rows="3" style="{{ $fieldStyle }} resize: vertical;" placeholder="Uraikan pengalaman kerja">{{ old('imam_pengalaman_kerja') }}</textarea>
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Rencana Kegiatan Pemakmur Masjid</label>
                <textarea name="imam_rencana_kegiatan" rows="4" style="{{ $fieldStyle }} resize: vertical;" placeholder="Uraikan rencana kegiatan">{{ old('imam_rencana_kegiatan') }}</textarea>
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 6: Foto Calon Lokasi ═══ --}}
        <div class="form-section">
            <div class="form-section-header">Foto Calon Lokasi</div>
            <div class="form-section-body">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div style="{{ $groupStyle }}">
                    <label style="{{ $labelStyle }}">Foto Lokasi dan Lingkungan Sekitar 1 <span style="color: var(--color-danger);">*</span></label>
                    <input type="file" name="foto_lokasi_1" accept="image/*" style="{{ $fieldStyle }} padding: 8px;">
                    @error('foto_lokasi_1') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
                </div>
                <div style="{{ $groupStyle }}">
                    <label style="{{ $labelStyle }}">Foto Jalan Masuk ke Lokasi</label>
                    <input type="file" name="foto_jalan" accept="image/*" style="{{ $fieldStyle }} padding: 8px;">
                </div>
                <div style="{{ $groupStyle }}">
                    <label style="{{ $labelStyle }}">Foto Lokasi dan Lingkungan Sekitar 2 <span style="color: var(--color-danger);">*</span></label>
                    <input type="file" name="foto_lokasi_2" accept="image/*" style="{{ $fieldStyle }} padding: 8px;">
                    @error('foto_lokasi_2') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
                </div>
                <div style="{{ $groupStyle }}">
                    <label style="{{ $labelStyle }}">Foto Lain</label>
                    <input type="file" name="foto_lain" accept="image/*" style="{{ $fieldStyle }} padding: 8px;">
                </div>
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 7: Keterangan ═══ --}}
        <div class="form-section">
            <div class="form-section-header">Keterangan</div>
            <div class="form-section-body">

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Pengajuan Proposal ini diajukan juga kepada lembaga:</label>
                <input type="text" name="diajukan_ke_lembaga" value="{{ old('diajukan_ke_lembaga') }}" style="{{ $fieldStyle }}" placeholder="Nama lembaga (jika ada)">
            </div>

            <div style="{{ $groupStyle }}">
                <label style="{{ $labelStyle }}">Masa berlaku proposal ini sampai dengan:</label>
                <input type="date" name="masa_berlaku" value="{{ old('masa_berlaku') }}" style="{{ $fieldStyle }} max-width: 300px;">
            </div>

            </div>
        </div>

        {{-- ═══ SECTION 8: Syarat dan Ketentuan ═══ --}}
        <div class="form-section">
            <div class="form-section-header">Syarat dan Ketentuan</div>
            <div class="form-section-body">

            <ol style="padding-left: 20px; font-size: 14px; color: var(--color-gray-600); line-height: 1.8; margin: 0 0 20px;">
                <li>Formulir diisi dengan lengkap.</li>
                <li>Formulir ini merupakan permohonan awal dan tidak diharuskannya pembangungan akan dilaksanakannya pembangunan.</li>
                <li>Setiap proposal yang masuk akan melalui proses seleksi.</li>
            </ol>

            <div style="{{ $groupStyle }}">
                <label style="display: flex; align-items: flex-start; gap: 8px; font-size: 14px; color: var(--color-gray-900); cursor: pointer;">
                    <input type="checkbox" name="persetujuan" value="1" {{ old('persetujuan') ? 'checked' : '' }} style="margin-top: 3px;">
                    <span>Saya setuju dengan syarat dan ketentuan di atas. <span style="color: var(--color-danger);">*</span></span>
                </label>
                @error('persetujuan') <div style="{{ $errorStyle }}">{{ $message }}</div> @enderror
            </div>

            </div>
        </div>

        {{-- ═══ TOMBOL SUBMIT ═══ --}}
        <button type="submit" style="width: 100%; padding: 16px; background: var(--color-primary); color: var(--color-white); border: none; border-radius: var(--radius-lg); font-size: 16px; font-weight: 700; font-family: var(--font-heading); cursor: pointer; transition: background 0.2s;"
                onmouseover="this.style.background='var(--color-primary-dark)'"
                onmouseout="this.style.background='var(--color-primary)'">
            Submit Pengajuan
        </button>
    </form>
</div>

<style>
    input:focus, textarea:focus, select:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 3px rgba(139, 26, 74, 0.1);
    }

    .form-section {
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-xl);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .form-section-header {
        font-family: var(--font-heading);
        font-size: 15px;
        font-weight: 700;
        color: var(--color-primary);
        background: var(--color-primary-light);
        border-left: 4px solid var(--color-primary);
        padding: 12px 20px;
        margin: 0;
    }

    .form-section-body {
        padding: 24px;
    }

    @media (max-width: 640px) {
        div[style*="grid-template-columns: 1fr 1fr 1fr"] { grid-template-columns: 1fr !important; }
        div[style*="grid-template-columns: 1fr 1fr"] { grid-template-columns: 1fr !important; }
    }
</style>
@endsection
