<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationProgram;

class DonationProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name'             => 'Wakaf Pembangunan Masjid',
                'slug'             => 'wakaf-pembangunan-masjid',
                'description'      => 'Jadikan masjid ini bagian dari amal jariyah Anda — pusat dakwah dan ilmu bagi masyarakat di wilayah yang belum terjangkau.',
                'target_amount'    => 500000000,
                'collected_amount' => 312500000,
                'status'           => 'active',
                'sort_order'       => 1,
            ],
            [
                'name'             => 'Tebar 10.000 Mushaf Al-Qur\'an ke Pelosok Negeri',
                'slug'             => 'tebar-mushaf-al-quran',
                'description'      => 'Setiap mushaf yang Anda wakafkan adalah jalan ilmu yang terus terbuka, mengalir pahalanya tanpa henti.',
                'target_amount'    => 200000000,
                'collected_amount' => 87500000,
                'status'           => 'active',
                'sort_order'       => 2,
            ],
            [
                'name'             => 'Kafalah Da\'i: Dukung Pejuang Syiar Islam',
                'slug'             => 'kafalah-dai',
                'description'      => 'Dukung para da\'i yang berjuang menyebarkan Islam di daerah minoritas dan pelosok negeri yang membutuhkan.',
                'target_amount'    => 150000000,
                'collected_amount' => 98000000,
                'status'           => 'active',
                'sort_order'       => 3,
            ],
            [
                'name'             => 'Pengadaan Sumur Bersih untuk Masyarakat',
                'slug'             => 'pengadaan-sumur-bersih',
                'description'      => 'Air bersih adalah kebutuhan dasar. Bantu kami menghadirkan sumur bersih di daerah yang selama ini kekurangan air.',
                'target_amount'    => 75000000,
                'collected_amount' => 45000000,
                'status'           => 'active',
                'sort_order'       => 4,
            ],
            [
                'name'             => 'Distribusi Paket Buka Puasa Ramadhan',
                'slug'             => 'distribusi-paket-buka-puasa',
                'description'      => 'Berbagi kebahagiaan bersama masyarakat di bulan Ramadhan dengan menyediakan paket buka puasa.',
                'target_amount'    => 100000000,
                'collected_amount' => 100000000,
                'status'           => 'closed',
                'sort_order'       => 5,
            ],
        ];

        foreach ($programs as $program) {
            DonationProgram::create($program);
        }
    }
}
