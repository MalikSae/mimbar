<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [

            // ━━━━ STATISTIK HOMEPAGE ━━━━
            // Sudah ada di DB tapi perlu dipastikan:
            ['key' => 'stat_masjid',       'value' => '157'],
            ['key' => 'stat_mushaf',        'value' => '21969'],
            ['key' => 'stat_kajian',        'value' => '1245'],
            ['key' => 'stat_mualaf',        'value' => '788'],

            // Yang BELUM ada:
            ['key' => 'stat_sumur',         'value' => '152'],
            ['key' => 'stat_paket_buka',    'value' => '157000'],

            // ━━━━ STATISTIK PROGRAM ━━━━
            ['key' => 'stat_jamaah',        'value' => '100000'],
            ['key' => 'stat_subscribers_tv','value' => '500000'],
            ['key' => 'stat_santri',        'value' => '500'],

            // ━━━━ STATISTIK QURBAN ━━━━
            ['key' => 'qurban_hewan_tersalurkan', 'value' => '1.140+'],
            ['key' => 'qurban_tahun_aktif',       'value' => '2017-2024'],
            ['key' => 'qurban_active',            'value' => '1'],

            // ━━━━ TENTANG KAMI ━━━━
            ['key' => 'about_profil', 'value' =>
                'Yayasan Mimbar Al-Tauhid hadir di tengah masyarakat dengan ' .
                'program-program dakwah yang menarik dan inovatif dengan berbasis ' .
                'sistem manajemen yang baik, serta sumber daya manusia yang ' .
                'profesional di bidangnya, penuh amanah dan bertanggung jawab.'
            ],
            ['key' => 'about_visi', 'value' =>
                'Menjadi lembaga dakwah, sosial, dan pendidikan yang terdepan untuk umat.'
            ],
            ['key' => 'about_misi', 'value' =>
                json_encode([
                    'Membumikan pemahaman dan pengamalan ajaran Islam berdasarkan Al-Qur\'an dan As-Sunnah sesuai cara pandang generasi terbaik (salafussholib).',
                    'Mempererat ukhuwah (persaudaraan) kaum muslimin dalam bingkai kerja sama dan saling menasehati.',
                    'Memberikan pelayanan dan bantuan sosial kepada masyarakat dengan amanah dan profesional.',
                ])
            ],
            ['key' => 'about_ketua_nama',    'value' => 'Ustadz Rustang Arizal, Lc., MA'],
            ['key' => 'about_ketua_jabatan', 'value' => 'Ketua Pembina Yayasan'],
            ['key' => 'about_ketua_quote',   'value' =>
                'Kesuksesan program kerja Yayasan Mimbar Al-Tauhid dalam berkhidmat ' .
                'kepada masyarakat tentu tidak terlepas dari dukungan seluruh lapisan ' .
                'masyarakat (setelah taufik dari Allah ta\'ala).'
            ],
            ['key' => 'about_ketua_foto',    'value' => ''],

            // ━━━━ KONTAK & SITE INFO ━━━━
            ['key' => 'site_name',          'value' => 'Yayasan Mimbar Al-Tauhid'],
            ['key' => 'site_tagline',       'value' => 'Menjadi lembaga dakwah, sosial, dan pendidikan yang terdepan untuk umat.'],
            ['key' => 'site_email',         'value' => 'info@mimbar.com'],
            ['key' => 'site_phone',         'value' => '+62 823 1111 9499'],
            ['key' => 'site_phone_office',  'value' => '+62 266 6545 616'],
            ['key' => 'site_address',       'value' => 'Jl. Alternatif Nagrak Kp. Bobojong, RT.04/RW.03, Ds. Balekambang, Kec. Nagrak, Kab. Sukabumi, Jawa Barat - 43556'],
            ['key' => 'site_facebook',      'value' => 'https://facebook.com/mimbar'],
            ['key' => 'site_instagram',     'value' => 'https://instagram.com/mimbar'],
            ['key' => 'site_youtube',       'value' => 'https://youtube.com/mimbartvid'],
            ['key' => 'site_telegram',      'value' => 'https://t.me/mimbar'],

            // ━━━━ DONASI ━━━━
            ['key' => 'donation_thanks_text', 'value' =>
                'Jazakumullahu khairan atas kepercayaan dan kebaikan Anda. ' .
                'Semoga sedekah ini menjadi pemberat timbangan kebaikan di akhirat kelak.'
            ],
            ['key' => 'admin_wa',           'value' => '+62 823 1111 9499'],
            ['key' => 'admin_email_notif',  'value' => 'admin@mimbar.or.id'],

            // ━━━━ MEDIA PARTNER ━━━━
            ['key' => 'media_partner_1',    'value' => 'Mimbar TV'],
            ['key' => 'media_partner_2',    'value' => 'Radio Baru Tamarit'],
            ['key' => 'media_partner_3',    'value' => 'Ma\'had Al-Qur\'an Nurin'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }

        $this->command->info('✅ Settings seeder selesai — ' . count($settings) . ' key diproses.');
    }
}
