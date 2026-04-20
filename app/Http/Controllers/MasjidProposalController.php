<?php

namespace App\Http\Controllers;

use App\Models\MasjidProposal;
use App\Models\MasjidProposalFile;
use Illuminate\Http\Request;

class MasjidProposalController extends Controller
{
    public function index()
    {
        return view('pengajuan-masjid.index', ['hideHeaderAndFooter' => true]);
    }

    public function store(Request $request)
    {
        // Validasi minimal
        $request->validate([
            'nama_organisasi_pemohon'       => 'required|string|max:255',
            'no_telp_pemohon'               => 'required|string|max:20',
            'nama_penanggung_jawab_pemohon' => 'required|string|max:255',
            'alamat_calon_lokasi'           => 'required|string',
            'provinsi'                      => 'required|string|max:100',
            'kabupaten'                     => 'required|string|max:100',
            'latar_belakang_proposal'       => 'required|string|min:100',
            'foto_lokasi_1'                 => 'required|image|max:4096',
            'foto_lokasi_2'                 => 'required|image|max:4096',
            'persetujuan'                   => 'required|accepted',
        ]);

        // Simpan data utama
        $proposal = MasjidProposal::create([
            'nama_organisasi_pemohon'           => $request->nama_organisasi_pemohon,
            'alamat_pemohon'                    => $request->alamat_pemohon,
            'no_telp_pemohon'                   => $request->no_telp_pemohon,
            'email_pemohon'                     => $request->email_pemohon,
            'nama_penanggung_jawab_pemohon'     => $request->nama_penanggung_jawab_pemohon,
            'no_telp_pj_pemohon'                => $request->no_telp_pj_pemohon,
            'email_pj_pemohon'                  => $request->email_pj_pemohon,
            'mengenal_yayasan_melalui'          => $request->mengenal_yayasan_melalui,
            'latar_belakang_proposal'           => $request->latar_belakang_proposal,
            'nama_organisasi_penerima'          => $request->nama_organisasi_penerima,
            'nama_penanggung_jawab_penerima'    => $request->nama_penanggung_jawab_penerima,
            'no_telp_penerima'                  => $request->no_telp_penerima,
            'email_penerima'                    => $request->email_penerima,
            'pemakmur_masjid_masyarakat'        => $request->pemakmur_masjid_masyarakat,
            'pemakmur_masjid_kk'                => $request->pemakmur_masjid_kk,
            'pemakmur_lembaga_pendidikan'       => $request->pemakmur_lembaga_pendidikan,
            'pemakmur_lembaga_pendidikan_siswa' => $request->pemakmur_lembaga_pendidikan_siswa,
            'perkiraan_jumlah_pemakmur'         => $request->perkiraan_jumlah_pemakmur,
            'alamat_calon_lokasi'               => $request->alamat_calon_lokasi,
            'kecamatan'                         => $request->kecamatan,
            'kabupaten'                         => $request->kabupaten,
            'provinsi'                          => $request->provinsi,
            'koordinat_gps'                     => $request->koordinat_gps,
            'status_tanah'                      => $request->status_tanah,
            'luas_tanah'                        => $request->luas_tanah,
            'kondisi_pecel'                     => $request->kondisi_pecel,
            'ukuran_masjid_existing'            => $request->ukuran_masjid_existing,
            'jalan_masuk'                       => $request->jalan_masuk,
            'jaringan_listrik'                  => $request->jaringan_listrik,
            'jarak_listrik'                     => $request->jarak_listrik,
            'lokasi_dengan_pemukiman'           => $request->lokasi_dengan_pemukiman,
            'ukuran_rencana_masjid'             => $request->ukuran_rencana_masjid,
            'ukuran_rencana_wudhu'              => $request->ukuran_rencana_wudhu,
            'jarak_mushola_masjid_terdekat'     => $request->jarak_mushola_masjid_terdekat,
            'imam_nama'                         => $request->imam_nama,
            'imam_ttl'                          => $request->imam_ttl,
            'imam_alamat'                       => $request->imam_alamat,
            'imam_no_telp'                      => $request->imam_no_telp,
            'imam_email'                        => $request->imam_email,
            'imam_status_perkawinan'            => $request->imam_status_perkawinan,
            'imam_pekerjaan'                    => $request->imam_pekerjaan,
            'imam_pendidikan_terakhir'          => $request->imam_pendidikan_terakhir,
            'imam_kemampuan_komputer'           => is_array($request->imam_kemampuan_komputer) ? implode(', ', $request->imam_kemampuan_komputer) : $request->imam_kemampuan_komputer,
            'imam_pengalaman_dakwah'            => $request->imam_pengalaman_dakwah,
            'imam_kegiatan_dakwah'              => is_array($request->imam_kegiatan_dakwah) ? implode(', ', $request->imam_kegiatan_dakwah) : $request->imam_kegiatan_dakwah,
            'imam_hafalan_quran'                => $request->imam_hafalan_quran,
            'imam_hafalan_hadis'                => $request->imam_hafalan_hadis,
            'imam_bahasa_arab_lisan'            => $request->boolean('imam_bahasa_arab_lisan'),
            'imam_bahasa_arab_tulisan'          => $request->boolean('imam_bahasa_arab_tulisan'),
            'imam_bahasa_inggris_lisan'         => $request->boolean('imam_bahasa_inggris_lisan'),
            'imam_bahasa_inggris_tulisan'       => $request->boolean('imam_bahasa_inggris_tulisan'),
            'imam_bahasa_daerah'                => $request->imam_bahasa_daerah,
            'imam_pelatihan'                    => $request->imam_pelatihan,
            'imam_pengalaman_kerja'             => $request->imam_pengalaman_kerja,
            'imam_rencana_kegiatan'             => $request->imam_rencana_kegiatan,
            'status'                            => 'pending',
        ]);

        // Upload file-file
        $fileTypes = [
            'lampiran_ktp'   => 'ktp',
            'lampiran_tanah' => 'sertifikat_tanah',
            'foto_lokasi_1'  => 'foto_lokasi_1',
            'foto_lokasi_2'  => 'foto_lokasi_2',
            'foto_lokasi_3'  => 'foto_lokasi_3',
            'foto_lokasi_4'  => 'foto_lokasi_4',
            'foto_jalan'     => 'foto_jalan',
            'foto_lain'      => 'foto_lain',
        ];

        foreach ($fileTypes as $inputName => $fileType) {
            if ($request->hasFile($inputName)) {
                $path = $request->file($inputName)
                    ->store('proposals', 'public');
                MasjidProposalFile::create([
                    'proposal_id' => $proposal->id,
                    'file_type'   => $fileType,
                    'file_path'   => $path,
                ]);
            }
        }

        return redirect()->route('masjid.proposal.success')
            ->with('proposal_id', $proposal->id);
    }

    public function success()
    {
        return view('pengajuan-masjid.success', ['hideHeaderAndFooter' => true]);
    }
}
