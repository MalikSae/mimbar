<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            [
                'title'        => 'Laporan Keuangan Semester 1 Tahun 2024',
                'type'         => 'keuangan',
                'period'       => 'Semester 1',
                'year'         => 2024,
                'file_path'    => 'reports/laporan-keuangan-s1-2024.pdf',
                'is_visible'   => true,
                'published_at' => now()->subMonths(3),
            ],
            [
                'title'        => 'Laporan Keuangan Semester 2 Tahun 2023',
                'type'         => 'keuangan',
                'period'       => 'Semester 2',
                'year'         => 2023,
                'file_path'    => 'reports/laporan-keuangan-s2-2023.pdf',
                'is_visible'   => true,
                'published_at' => now()->subMonths(9),
            ],
            [
                'title'        => 'Laporan Program Dakwah Tahun 2024',
                'type'         => 'program',
                'period'       => 'Tahunan',
                'year'         => 2024,
                'file_path'    => 'reports/laporan-program-2024.pdf',
                'is_visible'   => true,
                'published_at' => now()->subMonths(2),
            ],
            [
                'title'        => 'Laporan Distribusi Qurban 1445H',
                'type'         => 'qurban',
                'period'       => '1445H',
                'year'         => 2024,
                'file_path'    => 'reports/laporan-qurban-1445h.pdf',
                'is_visible'   => true,
                'published_at' => now()->subMonths(5),
            ],
            [
                'title'        => 'Laporan Program Dakwah Tahun 2023',
                'type'         => 'program',
                'period'       => 'Tahunan',
                'year'         => 2023,
                'file_path'    => 'reports/laporan-program-2023.pdf',
                'is_visible'   => true,
                'published_at' => now()->subMonths(14),
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
