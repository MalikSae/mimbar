<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
            DonationProgramSeeder::class,
            BankAccountSeeder::class,
            SettingSeeder::class,
            EbookSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
