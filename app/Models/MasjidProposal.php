<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasjidProposal extends Model
{
    protected $fillable = [
        'nama_organisasi_pemohon',
        'alamat_pemohon',
        'no_telp_pemohon',
        'email_pemohon',
        'nama_penanggung_jawab_pemohon',
        'no_telp_pj_pemohon',
        'email_pj_pemohon',
        'mengenal_yayasan_melalui',
        'latar_belakang_proposal',
        'nama_organisasi_penerima',
        'nama_penanggung_jawab_penerima',
        'no_telp_penerima',
        'email_penerima',
        'pemakmur_masjid_masyarakat',
        'pemakmur_masjid_kk',
        'pemakmur_lembaga_pendidikan',
        'pemakmur_lembaga_pendidikan_siswa',
        'perkiraan_jumlah_pemakmur',
        'alamat_calon_lokasi',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'koordinat_gps',
        'status_tanah',
        'luas_tanah',
        'kondisi_pecel',
        'ukuran_masjid_existing',
        'jalan_masuk',
        'jaringan_listrik',
        'jarak_listrik',
        'lokasi_dengan_pemukiman',
        'ukuran_rencana_masjid',
        'ukuran_rencana_wudhu',
        'jarak_mushola_masjid_terdekat',
        'imam_nama',
        'imam_ttl',
        'imam_alamat',
        'imam_no_telp',
        'imam_email',
        'imam_status_perkawinan',
        'imam_pekerjaan',
        'imam_pendidikan_terakhir',
        'imam_kemampuan_komputer',
        'imam_pengalaman_dakwah',
        'imam_kegiatan_dakwah',
        'imam_hafalan_quran',
        'imam_hafalan_hadis',
        'imam_bahasa_arab_lisan',
        'imam_bahasa_arab_tulisan',
        'imam_bahasa_inggris_lisan',
        'imam_bahasa_inggris_tulisan',
        'imam_bahasa_daerah',
        'imam_pelatihan',
        'imam_pengalaman_kerja',
        'imam_rencana_kegiatan',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'imam_bahasa_arab_lisan'      => 'boolean',
        'imam_bahasa_arab_tulisan'    => 'boolean',
        'imam_bahasa_inggris_lisan'   => 'boolean',
        'imam_bahasa_inggris_tulisan' => 'boolean',
    ];

    public function files()
    {
        return $this->hasMany(MasjidProposalFile::class, 'proposal_id');
    }
}
