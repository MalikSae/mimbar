<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proposal Pengajuan Masjid #{{ $proposal->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #8b1a4a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #8b1a4a;
            font-size: 20px;
            margin: 0 0 5px 0;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .section-title {
            background-color: #fce4ec;
            color: #8b1a4a;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-left: 4px solid #8b1a4a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            table-layout: fixed;
        }
        th, td {
            padding: 6px 10px;
            border: 1px solid #ddd;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        th {
            width: 35%;
            text-align: left;
            background-color: #f9f9f9;
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #ddd;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .mb-2 { margin-bottom: 15px; }
        .text-center { text-align: center; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Detail Pengajuan Pembangunan Masjid #{{ $proposal->id }}</h1>
        <p>Yayasan Mimbar Al-Tauhid</p>
    </div>

    <table>
        <tr>
            <th>Status Pengajuan</th>
            <td><span class="badge">{{ $proposal->status }}</span></td>
        </tr>
        <tr>
            <th>Tanggal Masuk</th>
            <td>{{ $proposal->created_at->format('d F Y H:i') }}</td>
        </tr>
        @if($proposal->catatan_admin)
        <tr>
            <th>Catatan Admin</th>
            <td>{{ $proposal->catatan_admin }}</td>
        </tr>
        @endif
    </table>

    <div class="section-title">Biodata Pemohon</div>
    <table>
        <tr><th>Nama Organisasi</th><td>{{ $proposal->nama_organisasi_pemohon ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $proposal->alamat_pemohon ?? '-' }}</td></tr>
        <tr><th>No. Telp</th><td>{{ $proposal->no_telp_pemohon ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $proposal->email_pemohon ?? '-' }}</td></tr>
        <tr><th>Penanggung Jawab</th><td>{{ $proposal->nama_penanggung_jawab_pemohon ?? '-' }}</td></tr>
        <tr><th>No. Telp PJ</th><td>{{ $proposal->no_telp_pj_pemohon ?? '-' }}</td></tr>
        <tr><th>Email PJ</th><td>{{ $proposal->email_pj_pemohon ?? '-' }}</td></tr>
        <tr><th>Mengenal Yayasan Melalui</th><td>{{ $proposal->mengenal_yayasan_melalui ?? '-' }}</td></tr>
        <tr><th>Latar Belakang Proposal</th><td>{{ $proposal->latar_belakang_proposal ?? '-' }}</td></tr>
    </table>

    <div class="section-title">Biodata Calon Penerima</div>
    <table>
        <tr><th>Nama Organisasi</th><td>{{ $proposal->nama_organisasi_penerima ?? '-' }}</td></tr>
        <tr><th>Penanggung Jawab</th><td>{{ $proposal->nama_penanggung_jawab_penerima ?? '-' }}</td></tr>
        <tr><th>No. Telp</th><td>{{ $proposal->no_telp_penerima ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $proposal->email_penerima ?? '-' }}</td></tr>
        <tr><th>Pemakmur (KK)</th><td>{{ $proposal->pemakmur_masjid_kk ?? '-' }}</td></tr>
        <tr><th>Pemakmur (Masyarakat)</th><td>{{ $proposal->pemakmur_masjid_masyarakat ?? '-' }}</td></tr>
        <tr><th>Lembaga Pendidikan</th><td>{{ $proposal->pemakmur_lembaga_pendidikan ?? '-' }}</td></tr>
        <tr><th>Jumlah Siswa</th><td>{{ $proposal->pemakmur_lembaga_pendidikan_siswa ?? '-' }}</td></tr>
        <tr><th>Perkiraan Jumlah Pemakmur</th><td>{{ $proposal->perkiraan_jumlah_pemakmur ? $proposal->perkiraan_jumlah_pemakmur . ' Orang' : '-' }}</td></tr>
    </table>

    <div class="section-title">Data Lokasi</div>
    <table>
        <tr><th>Alamat Calon Lokasi</th><td>{{ $proposal->alamat_calon_lokasi ?? '-' }}</td></tr>
        <tr><th>Kecamatan</th><td>{{ $proposal->kecamatan ?? '-' }}</td></tr>
        <tr><th>Kabupaten / Kota</th><td>{{ $proposal->kabupaten ?? '-' }}</td></tr>
        <tr><th>Provinsi</th><td>{{ $proposal->provinsi ?? '-' }}</td></tr>
        <tr><th>Koordinat GPS</th><td>{{ $proposal->koordinat_gps ?? '-' }}</td></tr>
        <tr><th>Status Tanah</th><td>{{ $proposal->status_tanah ?? '-' }}</td></tr>
        <tr><th>Luas Tanah</th><td>{{ $proposal->luas_tanah ? $proposal->luas_tanah . ' M²' : '-' }}</td></tr>
    </table>

    <div class="section-title">Kondisi Lokasi</div>
    <table>
        <tr><th>Kondisi Pecel</th><td>{{ $proposal->kondisi_pecel ?? '-' }}{{ $proposal->ukuran_masjid_existing ? ' (' . $proposal->ukuran_masjid_existing . ' M²)' : '' }}</td></tr>
        <tr><th>Jalan Masuk</th><td>{{ $proposal->jalan_masuk ?? '-' }}</td></tr>
        <tr><th>Jaringan Listrik</th><td>{{ $proposal->jaringan_listrik ?? '-' }}{{ $proposal->jarak_listrik ? ' (Jarak: ' . $proposal->jarak_listrik . ' M)' : '' }}</td></tr>
        <tr><th>Lokasi dengan Pemukiman</th><td>{{ $proposal->lokasi_dengan_pemukiman ?? '-' }}</td></tr>
        <tr><th>Ukuran Rencana Masjid</th><td>{{ $proposal->ukuran_rencana_masjid ? $proposal->ukuran_rencana_masjid . ' M²' : '-' }}</td></tr>
        <tr><th>Ukuran Rencana Wudhu</th><td>{{ $proposal->ukuran_rencana_wudhu ? $proposal->ukuran_rencana_wudhu . ' M²' : '-' }}</td></tr>
        <tr><th>Jarak Masjid Terdekat</th><td>{{ $proposal->jarak_mushola_masjid_terdekat ? $proposal->jarak_mushola_masjid_terdekat . ' M' : '-' }}</td></tr>
    </table>

    <div class="section-title">Biodata Calon Imam</div>
    <table>
        <tr><th>Nama</th><td>{{ $proposal->imam_nama ?? '-' }}</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $proposal->imam_ttl ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $proposal->imam_alamat ?? '-' }}</td></tr>
        <tr><th>No. Telp</th><td>{{ $proposal->imam_no_telp ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $proposal->imam_email ?? '-' }}</td></tr>
        <tr><th>Status Perkawinan</th><td>{{ $proposal->imam_status_perkawinan ?? '-' }}</td></tr>
        <tr><th>Pekerjaan</th><td>{{ $proposal->imam_pekerjaan ?? '-' }}</td></tr>
        <tr><th>Pendidikan Terakhir</th><td>{{ $proposal->imam_pendidikan_terakhir ?? '-' }}</td></tr>
        <tr><th>Kemampuan Komputer</th><td>{{ $proposal->imam_kemampuan_komputer ?? '-' }}</td></tr>
        <tr><th>Pengalaman Dakwah</th><td>{{ $proposal->imam_pengalaman_dakwah ?? '-' }}</td></tr>
        <tr><th>Kegiatan Dakwah</th><td>{{ $proposal->imam_kegiatan_dakwah ?? '-' }}</td></tr>
        <tr><th>Hafalan Qur'an</th><td>{{ $proposal->imam_hafalan_quran ? $proposal->imam_hafalan_quran . ' Juz' : '-' }}</td></tr>
        <tr><th>Hafalan Hadis</th><td>{{ $proposal->imam_hafalan_hadis ?? '-' }}</td></tr>
        <tr><th>Bahasa Arab</th>
            <td>
                {{ $proposal->imam_bahasa_arab_lisan ? 'Lisan' : '' }}
                {{ $proposal->imam_bahasa_arab_lisan && $proposal->imam_bahasa_arab_tulisan ? ', ' : '' }}
                {{ $proposal->imam_bahasa_arab_tulisan ? 'Tulisan' : '' }}
                {{ !$proposal->imam_bahasa_arab_lisan && !$proposal->imam_bahasa_arab_tulisan ? '-' : '' }}
            </td>
        </tr>
        <tr><th>Bahasa Inggris</th>
            <td>
                {{ $proposal->imam_bahasa_inggris_lisan ? 'Lisan' : '' }}
                {{ $proposal->imam_bahasa_inggris_lisan && $proposal->imam_bahasa_inggris_tulisan ? ', ' : '' }}
                {{ $proposal->imam_bahasa_inggris_tulisan ? 'Tulisan' : '' }}
                {{ !$proposal->imam_bahasa_inggris_lisan && !$proposal->imam_bahasa_inggris_tulisan ? '-' : '' }}
            </td>
        </tr>
        <tr><th>Bahasa Daerah</th><td>{{ $proposal->imam_bahasa_daerah ?? '-' }}</td></tr>
        <tr><th>Pelatihan yang Pernah Diikuti</th><td>{{ $proposal->imam_pelatihan ?? '-' }}</td></tr>
        <tr><th>Pengalaman Kerja</th><td>{{ $proposal->imam_pengalaman_kerja ?? '-' }}</td></tr>
        <tr><th>Rencana Kegiatan Pemakmur</th><td>{{ $proposal->imam_rencana_kegiatan ?? '-' }}</td></tr>
    </table>

    <div class="footer">
        Dicetak pada {{ date('d F Y H:i') }} dari Sistem Yayasan Mimbar Al-Tauhid
    </div>

</body>
</html>
