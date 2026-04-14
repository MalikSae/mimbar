<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kajian Islam',    'slug' => 'kajian-islam',    'type' => 'article', 'description' => 'Artikel seputar kajian dan ilmu Islam'],
            ['name' => 'Akidah',          'slug' => 'akidah',          'type' => 'article', 'description' => 'Pembahasan seputar akidah Ahlussunnah'],
            ['name' => 'Fikih',           'slug' => 'fikih',           'type' => 'article', 'description' => 'Hukum-hukum fikih dalam kehidupan sehari-hari'],
            ['name' => 'Sirah',           'slug' => 'sirah',           'type' => 'article', 'description' => 'Kisah dan perjalanan hidup Rasulullah ﷺ'],
            ['name' => 'Keluarga',        'slug' => 'keluarga',        'type' => 'article', 'description' => 'Panduan membangun keluarga Islami'],
            ['name' => 'Berita Yayasan',  'slug' => 'berita-yayasan',  'type' => 'news',    'description' => 'Berita dan informasi terkini dari Yayasan Mimbar Al-Tauhid'],
            ['name' => 'Laporan Program', 'slug' => 'laporan-program', 'type' => 'news',    'description' => 'Laporan pelaksanaan program dakwah dan sosial'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
