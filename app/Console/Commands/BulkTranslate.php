<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BulkTranslate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:bulk {--model=all : Pilihan: articles|news|donations|all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bulk translate content to Arabic';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $option = $this->option('model');
        $service = app(\App\Services\TranslationService::class);
        $totalTranslated = 0;

        if ($option === 'articles' || $option === 'all') {
            $items = \App\Models\Article::where(function($q) {
                $q->whereNull('title_ar')->orWhere('title_ar', '');
            })->get();

            foreach ($items as $item) {
                $this->info("Artikel #{$item->id}: {$item->title}");
                $item->title_ar = $service->translateText($item->title ?? '');
                usleep(300000);
                $item->excerpt_ar = $service->translateText($item->excerpt ?? '');
                usleep(300000);
                $item->content_ar = $service->translateHtml($item->content ?? '');
                $item->save();
                $this->info("  ✓ Selesai");
                $totalTranslated++;
                usleep(500000);
            }
        }

        if ($option === 'news' || $option === 'all') {
            $items = \App\Models\News::where(function($q) {
                $q->whereNull('title_ar')->orWhere('title_ar', '');
            })->get();

            foreach ($items as $item) {
                $this->info("News #{$item->id}: {$item->title}");
                $item->title_ar = $service->translateText($item->title ?? '');
                usleep(300000);
                $item->excerpt_ar = $service->translateText($item->excerpt ?? '');
                usleep(300000);
                $item->content_ar = $service->translateHtml($item->content ?? '');
                $item->save();
                $this->info("  ✓ Selesai");
                $totalTranslated++;
                usleep(500000);
            }
        }

        if ($option === 'donations' || $option === 'all') {
            $items = \App\Models\DonationProgram::where(function($q) {
                $q->whereNull('name_ar')->orWhere('name_ar', '');
            })->get();

            foreach ($items as $item) {
                $this->info("Donasi #{$item->id}: {$item->name}");
                $item->name_ar = $service->translateText($item->name ?? '');
                usleep(300000);
                $item->description_ar = $service->translateHtml($item->description ?? '');
                $item->save();
                $this->info("  ✓ Donasi #{$item->id}: {$item->name} selesai");
                $totalTranslated++;
                usleep(500000);
            }
        }

        $this->info("\nSelesai. Total {$totalTranslated} item diterjemahkan.");
    }
}
