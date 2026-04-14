<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\News;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ImportWordpress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wordpress {--dry-run : Tampilkan preview tanpa insert ke database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import konten dari file XML export WordPress ke database (news & articles)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // STEP 1 — BACA FILE XML
        $xmlPath = storage_path('app/imports/wordpress.xml');
        if (!file_exists($xmlPath)) {
            $this->error('File tidak ditemukan: ' . $xmlPath);
            return;
        }

        $xml = simplexml_load_file($xmlPath);
        if (!$xml) {
            $this->error('Gagal membaca file XML atau format tidak valid.');
            return;
        }

        $xml->registerXPathNamespace('content', 'http://purl.org/rss/1.0/modules/content/');
        $xml->registerXPathNamespace('wp', 'http://wordpress.org/export/1.2/');
        $xml->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');

        // STEP 2 — MAPPING KATEGORI
        $categoryMapping = [
            'Activity'          => 'news',
            'Kegiatan Mimbar'   => 'news',
            'Kunjungan'         => 'news',
            'Peresmian Masjid'  => 'news',
            'Article'           => 'articles',
            'Mutiara Hikmah'    => 'articles',
            'Sejarah Islam'     => 'articles',
            'Q&A Fiqih'         => 'articles',
        ];

        $categoryNameMapping = [
            'Activity'          => ['name' => 'Aktivitas',          'type' => 'news'],
            'Kegiatan Mimbar'   => ['name' => 'Kegiatan Mimbar',    'type' => 'news'],
            'Kunjungan'         => ['name' => 'Kunjungan',          'type' => 'news'],
            'Peresmian Masjid'  => ['name' => 'Peresmian Masjid',   'type' => 'news'],
            'Article'           => ['name' => 'Umum',               'type' => 'article'],
            'Mutiara Hikmah'    => ['name' => 'Mutiara Hikmah',     'type' => 'article'],
            'Sejarah Islam'     => ['name' => 'Sejarah Islam',      'type' => 'article'],
            'Q&A Fiqih'         => ['name' => 'Fikih & Ibadah',     'type' => 'article'],
        ];

        $isDryRun = $this->option('dry-run');

        $total = 0;
        $countNews = 0;
        $countArticles = 0;
        $countSkipped = 0;
        $countImageFailed = 0;

        $previewData = [];

        // Prepare attachments map for thumbnail search
        $attachments = [];
        if (isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                $wp = $item->children('wp', true);
                if ((string)$wp->post_type === 'attachment') {
                    $postId = (string)$wp->post_id;
                    $url = (string)$wp->attachment_url;
                    $attachments[$postId] = $url;
                }
            }
        }

        // STEP 3 — LOOP SEMUA POST
        if (isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                $wp = $item->children('wp', true);

                // a) Ambil data
                $status = (string)$wp->status;
                if ($status !== 'publish') {
                    continue;
                }

                $post_type = (string)$wp->post_type;
                if ($post_type !== 'post') {
                    continue;
                }

                $total++;

                $title = (string)$item->title;
                
                $contentNode = $item->children('content', true);
                $content = (string)$contentNode->encoded;
                
                $post_date = (string)$wp->post_date;
                
                $dc = $item->children('dc', true);
                $author = (string)$dc->creator;

                // Categories
                $categories = [];
                if (isset($item->category)) {
                    foreach ($item->category as $cat) {
                        if ((string)$cat['domain'] === 'category') {
                            $categories[] = (string)$cat;
                        }
                    }
                }

                // Featured Image URL
                $featured_image_url = null;
                $thumbnailId = null;
                if (isset($wp->postmeta)) {
                    foreach ($wp->postmeta as $meta) {
                        if ((string)$meta->meta_key === '_thumbnail_id') {
                            $thumbnailId = (string)$meta->meta_value;
                            break;
                        }
                    }
                }
                
                if ($thumbnailId && isset($attachments[$thumbnailId])) {
                    $featured_image_url = $attachments[$thumbnailId];
                }

                // b) Tentukan target tabel
                $target = null;
                $categoryName = null;
                $type = null;

                foreach ($categories as $cat) {
                    if (isset($categoryMapping[$cat])) {
                        $target = $categoryMapping[$cat];
                        $categoryName = $categoryNameMapping[$cat]['name'];
                        $type = $categoryNameMapping[$cat]['type'];
                        break; 
                    }
                }

                if (!$target) {
                    $countSkipped++;
                    // $this->warn("[SKIPPED] Kategori tidak dikenal: " . $title);
                    continue;
                }

                // c) Generate slug
                $slugBase = Str::slug($title);
                $slug = $slugBase;
                
                if (!$isDryRun) {
                    $counter = 2;
                    $modelClass = $target === 'news' ? News::class : Article::class;
                    while ($modelClass::where('slug', $slug)->exists()) {
                        $slug = $slugBase . '-' . $counter;
                        $counter++;
                    }
                }

                // e) Download featured image & filename mapping
                $featured_image = null;
                $imageStatus = 'No Image';

                if ($featured_image_url) {
                    $filename = basename(parse_url($featured_image_url, PHP_URL_PATH));
                    $featured_image = 'imports/' . $filename;
                    $imageStatus = $filename;

                    if (!$isDryRun) {
                        try {
                            $imageContents = @file_get_contents($featured_image_url);
                            if ($imageContents === false) {
                                $countImageFailed++;
                                $featured_image = null;
                                $this->warn("Gagal download gambar: " . $featured_image_url);
                            } else {
                                Storage::disk('public')->put($featured_image, $imageContents);
                            }
                        } catch (\Exception $e) {
                             $countImageFailed++;
                             $featured_image = null;
                             $this->warn("Error download: " . $e->getMessage());
                        }
                    }
                }

                if ($isDryRun) {
                    $previewData[] = [
                        $total,
                        $target,
                        $categoryName,
                        Str::limit($title, 40),
                        Str::limit($slug, 30),
                        Str::limit($imageStatus, 30)
                    ];
                } else {
                    // d) Pastikan kategori ada di tabel categories
                    $catRecord = Category::firstOrCreate(
                        ['slug' => Str::slug($categoryName), 'type' => $type],
                        ['name' => $categoryName, 'type' => $type]
                    );

                    // f) Insert ke database
                    if ($target === 'news') {
                        News::updateOrCreate(
                            ['slug' => $slug],
                            [
                                'category_id'    => $catRecord->id,
                                'title'          => $title,
                                'slug'           => $slug,
                                'content'        => $content,
                                'featured_image' => $featured_image,
                                'author_name'    => $author,
                                'status'         => 'published',
                                'created_at'     => Carbon::parse($post_date),
                                'updated_at'     => Carbon::parse($post_date),
                            ]
                        );
                        $countNews++;
                    } else if ($target === 'articles') {
                        Article::updateOrCreate(
                            ['slug' => $slug],
                            [
                                'category_id'    => $catRecord->id,
                                'title'          => $title,
                                'slug'           => $slug,
                                'content'        => $content,
                                'featured_image' => $featured_image,
                                'author_name'    => $author,
                                'status'         => 'published',
                                'created_at'     => Carbon::parse($post_date),
                                'updated_at'     => Carbon::parse($post_date),
                            ]
                        );
                        $countArticles++;
                    }

                    // g) Progress log per post
                    $this->line("[{$target}] {$title} → {$slug}");
                }
            }
        }

        // STEP 4 — DRY RUN MODE OUTPUT
        if ($isDryRun) {
            $this->info("\n--- PREVIEW DRY RUN ---");
            $this->table(
                ['No', 'Target', 'Kategori', 'Judul', 'Slug', 'Gambar'],
                $previewData
            );
            
            // Hitung counts untuk preview
            $countNews = collect($previewData)->where(1, 'news')->count();
            $countArticles = collect($previewData)->where(1, 'articles')->count();
        }

        // STEP 5 — RINGKASAN AKHIR
        $this->info("✅ Import selesai!");
        $this->table(
            ['Keterangan', 'Jumlah'],
            [
                ['Total post diproses', $total],
                ['Berhasil → news', $countNews],
                ['Berhasil → articles', $countArticles],
                ['Dilewati (kategori tidak dikenal)', $countSkipped],
                ['Gagal download gambar', $countImageFailed],
            ]
        );
    }
}
