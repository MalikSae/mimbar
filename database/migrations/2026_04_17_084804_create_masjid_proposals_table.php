<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('masjid_proposals', function (Blueprint $table) {
            $table->id();

            // Biodata Pemohon
            $table->string('nama_organisasi_pemohon')->nullable();
            $table->text('alamat_pemohon')->nullable();
            $table->string('no_telp_pemohon')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('nama_penanggung_jawab_pemohon')->nullable();
            $table->string('no_telp_pj_pemohon')->nullable();
            $table->string('email_pj_pemohon')->nullable();
            $table->string('mengenal_yayasan_melalui')->nullable();
            $table->text('latar_belakang_proposal')->nullable();

            // Biodata Calon Penerima
            $table->string('nama_organisasi_penerima')->nullable();
            $table->string('nama_penanggung_jawab_penerima')->nullable();
            $table->string('no_telp_penerima')->nullable();
            $table->string('email_penerima')->nullable();
            $table->string('pemakmur_masjid_masyarakat')->nullable();
            $table->string('pemakmur_masjid_kk')->nullable();
            $table->string('pemakmur_lembaga_pendidikan')->nullable();
            $table->string('pemakmur_lembaga_pendidikan_siswa')->nullable();
            $table->string('perkiraan_jumlah_pemakmur')->nullable();

            // Data Lokasi
            $table->text('alamat_calon_lokasi')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('koordinat_gps')->nullable();
            $table->string('status_tanah')->nullable();
            $table->string('luas_tanah')->nullable();

            // Kondisi Lokasi
            $table->string('kondisi_pecel')->nullable();
            $table->string('ukuran_masjid_existing')->nullable();
            $table->string('jalan_masuk')->nullable();
            $table->string('jaringan_listrik')->nullable();
            $table->string('jarak_listrik')->nullable();
            $table->string('lokasi_dengan_pemukiman')->nullable();
            $table->string('ukuran_rencana_masjid')->nullable();
            $table->string('ukuran_rencana_wudhu')->nullable();
            $table->string('jarak_mushola_masjid_terdekat')->nullable();

            // Biodata Calon Imam
            $table->string('imam_nama')->nullable();
            $table->string('imam_ttl')->nullable();
            $table->text('imam_alamat')->nullable();
            $table->string('imam_no_telp')->nullable();
            $table->string('imam_email')->nullable();
            $table->string('imam_status_perkawinan')->nullable();
            $table->string('imam_pekerjaan')->nullable();
            $table->string('imam_pendidikan_terakhir')->nullable();
            $table->string('imam_kemampuan_komputer')->nullable();
            $table->text('imam_pengalaman_dakwah')->nullable();
            $table->text('imam_kegiatan_dakwah')->nullable();
            $table->string('imam_hafalan_quran')->nullable();
            $table->string('imam_hafalan_hadis')->nullable();
            $table->boolean('imam_bahasa_arab_lisan')->default(false);
            $table->boolean('imam_bahasa_arab_tulisan')->default(false);
            $table->boolean('imam_bahasa_inggris_lisan')->default(false);
            $table->boolean('imam_bahasa_inggris_tulisan')->default(false);
            $table->string('imam_bahasa_daerah')->nullable();
            $table->text('imam_pelatihan')->nullable();
            $table->text('imam_pengalaman_kerja')->nullable();
            $table->text('imam_rencana_kegiatan')->nullable();

            // Status
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masjid_proposals');
    }
};
