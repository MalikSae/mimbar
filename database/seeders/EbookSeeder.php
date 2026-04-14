<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ebook;

class EbookSeeder extends Seeder
{
    public function run(): void
    {
        $ebooks = [
            [
                'title'          => 'Panduan Lengkap Shalat Sesuai Sunnah',
                'slug'           => 'panduan-lengkap-shalat-sesuai-sunnah',
                'author'         => 'Tim Dakwah Mimbar Al-Tauhid',
                'description'    => 'Panduan shalat lengkap dari thaharah hingga salam, dilengkapi dengan dalil-dalil dari Al-Qur\'an dan As-Sunnah.',
                'category'       => 'Fikih',
                'file_path'      => 'ebooks/panduan-shalat.pdf',
                'page_count'     => 120,
                'year'           => 2023,
                'download_count' => 342,
                'status'         => 'active',
            ],
            [
                'title'          => 'Mengenal Aqidah Ahlussunnah wal Jamaah',
                'slug'           => 'mengenal-aqidah-ahlussunnah-wal-jamaah',
                'author'         => 'Tim Dakwah Mimbar Al-Tauhid',
                'description'    => 'Buku pengantar aqidah Islam yang benar sesuai pemahaman generasi terbaik umat Islam.',
                'category'       => 'Akidah',
                'file_path'      => 'ebooks/aqidah-ahlussunnah.pdf',
                'page_count'     => 88,
                'year'           => 2023,
                'download_count' => 567,
                'status'         => 'active',
            ],
            [
                'title'          => 'Kunci-Kunci Kebahagiaan Rumah Tangga Muslim',
                'slug'           => 'kunci-kebahagiaan-rumah-tangga-muslim',
                'author'         => 'Tim Dakwah Mimbar Al-Tauhid',
                'description'    => 'Panduan praktis membangun keluarga sakinah, mawaddah, wa rahmah berdasarkan Al-Qur\'an dan As-Sunnah.',
                'category'       => 'Keluarga',
                'file_path'      => 'ebooks/kebahagiaan-rumah-tangga.pdf',
                'page_count'     => 96,
                'year'           => 2024,
                'download_count' => 289,
                'status'         => 'active',
            ],
            [
                'title'          => 'Sirah Nabawiyah: Pelajaran dari Kehidupan Rasulullah ﷺ',
                'slug'           => 'sirah-nabawiyah-pelajaran-kehidupan-rasulullah',
                'author'         => 'Tim Dakwah Mimbar Al-Tauhid',
                'description'    => 'Ringkasan sirah nabawiyah yang dilengkapi dengan pelajaran dan hikmah yang bisa diterapkan di kehidupan modern.',
                'category'       => 'Sirah',
                'file_path'      => 'ebooks/sirah-nabawiyah.pdf',
                'page_count'     => 156,
                'year'           => 2024,
                'download_count' => 412,
                'status'         => 'active',
            ],
            [
                'title'          => 'Panduan Belajar Bahasa Arab untuk Pemula',
                'slug'           => 'panduan-belajar-bahasa-arab-pemula',
                'author'         => 'Departemen Pendidikan Mimbar Al-Tauhid',
                'description'    => 'Modul belajar bahasa Arab dasar yang disusun untuk membantu kaum Muslim memahami Al-Qur\'an dan hadits.',
                'category'       => 'Bahasa Arab',
                'file_path'      => 'ebooks/belajar-bahasa-arab.pdf',
                'page_count'     => 200,
                'year'           => 2024,
                'download_count' => 634,
                'status'         => 'active',
            ],
            [
                'title'          => 'Amalan-Amalan Harian Seorang Muslim',
                'slug'           => 'amalan-harian-seorang-muslim',
                'author'         => 'Tim Dakwah Mimbar Al-Tauhid',
                'description'    => 'Kumpulan dzikir, doa, dan amalan harian yang dianjurkan dalam Islam, dilengkapi dengan teks Arab, latin, dan terjemahan.',
                'category'       => 'Kajian Islam',
                'file_path'      => 'ebooks/amalan-harian-muslim.pdf',
                'page_count'     => 72,
                'year'           => 2023,
                'download_count' => 891,
                'status'         => 'active',
            ],
        ];

        foreach ($ebooks as $ebook) {
            Ebook::create($ebook);
        }
    }
}
