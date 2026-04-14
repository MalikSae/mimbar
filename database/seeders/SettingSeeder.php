<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name',           'value' => 'Yayasan Mimbar Al-Tauhid'],
            ['key' => 'site_tagline',         'value' => 'Menjadi lembaga dakwah, sosial, dan pendidikan yang terdepan untuk umat'],
            ['key' => 'site_email',           'value' => 'info@mimbar.com'],
            ['key' => 'site_phone',           'value' => '+62 823 1111 9499'],
            ['key' => 'site_phone_office',    'value' => '+62 266 6545 616'],
            ['key' => 'site_address',         'value' => 'Jl. Alternatif Nagrak, Kp. Bobojong, RT.04/RW.03, Ds. Balekambang, Kec. Nagrak, Kab. Sukabumi, Jawa Barat 43556'],
            ['key' => 'site_facebook',        'value' => 'https://facebook.com/mimbar'],
            ['key' => 'site_instagram',       'value' => 'https://instagram.com/mimbar'],
            ['key' => 'site_youtube',         'value' => 'https://youtube.com/mimbartvid'],
            ['key' => 'site_telegram',        'value' => 'https://t.me/mimbar'],
            ['key' => 'qurban_active',        'value' => '0'],
            ['key' => 'admin_email_notif',    'value' => 'admin@mimbar.or.id'],
            ['key' => 'donation_thanks_text', 'value' => 'Jazakumullahu khairan atas kepercayaan Anda. Donasi Anda akan kami verifikasi dalam 1x24 jam dan disalurkan dengan penuh amanah.'],
            ['key' => 'stat_masjid',          'value' => '157'],
            ['key' => 'stat_mushaf',          'value' => '21.969'],
            ['key' => 'stat_kajian',          'value' => '1.245'],
            ['key' => 'stat_mualaf',          'value' => '788'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
