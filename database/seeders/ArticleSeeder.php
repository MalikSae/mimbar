<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $kajian   = Category::where('slug', 'kajian-islam')->first()->id;
        $akidah   = Category::where('slug', 'akidah')->first()->id;
        $fikih    = Category::where('slug', 'fikih')->first()->id;
        $sirah    = Category::where('slug', 'sirah')->first()->id;
        $keluarga = Category::where('slug', 'keluarga')->first()->id;
        $berita   = Category::where('slug', 'berita-yayasan')->first()->id;
        $laporan  = Category::where('slug', 'laporan-program')->first()->id;

        $articles = [
            [
                'category_id'  => $kajian,
                'title'        => 'Pentingnya Menuntut Ilmu Berdasarkan Al-Qur\'an dan As-Sunnah',
                'slug'         => 'pentingnya-menuntut-ilmu',
                'excerpt'      => 'Menuntut ilmu adalah kewajiban bagi setiap Muslim. Yayasan Mimbar Al-Tauhid melalui program kajiannya menghadirkan ilmu ke tengah masyarakat.',
                'content'      => '<p>Menuntut ilmu adalah kewajiban bagi setiap Muslim. Allah ta\'ala berfirman: <em>"Allah akan mengangkat derajat orang-orang yang beriman di antaramu dan orang-orang yang diberi ilmu beberapa derajat."</em> (Q.S. Al-Mujadilah: 11)</p><p>Yayasan Mimbar Al-Tauhid melalui program kajian pekanannya berupaya menghadirkan ilmu ke tengah masyarakat secara langsung, konsisten, dan berkesinambungan.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'category_id'  => $berita,
                'title'        => 'Mimbar Al-Tauhid Distribusikan 500 Mushaf ke Pesantren di Sukabumi',
                'slug'         => 'distribusi-500-mushaf-pesantren-sukabumi',
                'excerpt'      => 'Yayasan Mimbar Al-Tauhid kembali melaksanakan program distribusi Mushaf Al-Qur\'an kepada pesantren-pesantren di wilayah Sukabumi.',
                'content'      => '<p>Alhamdulillah, Yayasan Mimbar Al-Tauhid kembali berhasil mendistribusikan 500 Mushaf Al-Qur\'an kepada pesantren-pesantren di wilayah Kab. Sukabumi. Program ini merupakan bagian dari ikhtiar kami dalam menyebarkan syiar Islam ke seluruh pelosok negeri.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'category_id'  => $laporan,
                'title'        => 'Masjid ke-157 Telah Berdiri di Kalimantan Tengah',
                'slug'         => 'masjid-ke-157-kalimantan-tengah',
                'excerpt'      => 'Alhamdulillah, Yayasan Mimbar Al-Tauhid telah menyelesaikan pembangunan masjid ke-157 di Kalimantan Tengah.',
                'content'      => '<p>Dengan izin Allah ta\'ala, Departemen Wakaf & Pembangunan Yayasan Mimbar Al-Tauhid telah berhasil merampungkan pembangunan masjid ke-157 yang berlokasi di Kalimantan Tengah. Masjid ini dibangun di atas lahan wakaf seluas 300 m² dan mampu menampung lebih dari 150 jamaah.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'category_id'  => $akidah,
                'title'        => 'Mengenal Allah Ta\'ala Melalui Nama dan Sifat-Nya yang Mulia',
                'slug'         => 'mengenal-allah-melalui-nama-dan-sifat',
                'excerpt'      => 'Mengenal Allah adalah pondasi utama dalam kehidupan seorang Muslim. Inilah jalan menuju keimanan yang kokoh.',
                'content'      => '<p>Mengenal Allah ta\'ala melalui nama dan sifat-Nya adalah pondasi utama aqidah Islam. Para ulama Ahlussunnah wal Jamaah telah menetapkan bahwa kita wajib menetapkan apa yang Allah tetapkan untuk diri-Nya dan menafikan apa yang Allah nafikan.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'category_id'  => $laporan,
                'title'        => '1.140 Hewan Qurban Berhasil Ditebar ke Seluruh Pelosok Negeri',
                'slug'         => '1140-hewan-qurban-ditebar-seluruh-negeri',
                'excerpt'      => 'Program Tebar Qurban 1445H Yayasan Mimbar Al-Tauhid berhasil mendistribusikan 1.140 hewan qurban kepada masyarakat di pelosok negeri.',
                'content'      => '<p>Alhamdulillah, Program Tebar Qurban 1445H Yayasan Mimbar Al-Tauhid telah berhasil mendistribusikan 1.140 hewan qurban kepada masyarakat muslim yang membutuhkan di berbagai pelosok Indonesia.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(14),
            ],
            [
                'category_id'  => $fikih,
                'title'        => 'Hukum Zakat Fitrah dan Cara Pembayarannya yang Benar',
                'slug'         => 'hukum-zakat-fitrah-cara-pembayaran',
                'excerpt'      => 'Zakat fitrah adalah zakat yang wajib dikeluarkan oleh setiap Muslim pada bulan Ramadhan menjelang Idul Fitri.',
                'content'      => '<p>Zakat fitrah hukumnya wajib bagi setiap Muslim, baik laki-laki maupun perempuan, tua maupun muda, yang memiliki kelebihan makanan pada malam dan siang hari raya Idul Fitri.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(20),
            ],
            [
                'category_id'  => $sirah,
                'title'        => 'Keteladanan Rasulullah ﷺ dalam Berdakwah dengan Hikmah',
                'slug'         => 'keteladanan-rasulullah-dakwah-hikmah',
                'excerpt'      => 'Metode dakwah Rasulullah ﷺ adalah sebaik-baik metode yang pernah ada. Hikmah, kesabaran, dan kelembutan menjadi kunci keberhasilan dakwah beliau.',
                'content'      => '<p>Rasulullah ﷺ adalah teladan terbaik dalam segala aspek kehidupan, termasuk dalam berdakwah. Allah ta\'ala berfirman: "Serulah (manusia) kepada jalan Tuhanmu dengan hikmah dan pelajaran yang baik." (Q.S. An-Nahl: 125)</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(25),
            ],
            [
                'category_id'  => $berita,
                'title'        => 'Radio Cahaya FM 105.3 MHz: Menyiarkan Dakwah Tanpa Henti',
                'slug'         => 'radio-cahaya-fm-menyiarkan-dakwah',
                'excerpt'      => 'Radio Cahaya FM 105.3 MHz adalah radio dakwah Islamiyyah milik Yayasan Mimbar Al-Tauhid yang mengudara di Sukabumi.',
                'content'      => '<p>Yayasan Mimbar Al-Tauhid menghadirkan Radio Cahaya FM dengan segmentasi dakwah Islamiyyah yang mengudara pada frekuensi 105.3 FM. Dengan tagline "Inspirasi Surga", radio ini menyajikan program dan materi dakwah yang beragam.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(30),
            ],
            [
                'category_id'  => $keluarga,
                'title'        => 'Tips Mendidik Anak dengan Metode Islami Sejak Usia Dini',
                'slug'         => 'tips-mendidik-anak-metode-islami',
                'excerpt'      => 'Mendidik anak adalah amanah terbesar yang Allah berikan kepada kedua orang tua. Inilah panduan praktisnya.',
                'content'      => '<p>Mendidik anak dengan metode Islami adalah investasi terbaik yang bisa dilakukan orang tua. Rasulullah ﷺ bersabda: "Setiap anak dilahirkan dalam keadaan fitrah."</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(35),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
