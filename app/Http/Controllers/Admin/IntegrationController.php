<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntegrationSetting;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    /**
     * Definisi field per grup integrasi.
     * Digunakan sebagai "schema" untuk seed & tampilan.
     */
    private array $schema = [
        'wa_fonnte' => [
            'label'  => 'WhatsApp (Fonnte)',
            'fields' => [
                ['key' => 'fonnte_token',      'label' => 'API Token',             'type' => 'password', 'placeholder' => 'Token dari dashboard Fonnte'],
                ['key' => 'fonnte_sender',     'label' => 'Nomor Pengirim (WA)',   'type' => 'text',     'placeholder' => '628xxxxxxxxxx'],
                ['key' => 'fonnte_active',     'label' => 'Aktifkan Integrasi WA', 'type' => 'toggle'],
            ],
        ],
        'meta_pixel' => [
            'label'  => 'Meta Pixel',
            'fields' => [
                ['key' => 'pixel_id',          'label' => 'Pixel ID',              'type' => 'text',     'placeholder' => 'Contoh: 1234567890123456'],
                ['key' => 'pixel_active',      'label' => 'Aktifkan Meta Pixel',   'type' => 'toggle'],
            ],
        ],
        'meta_capi' => [
            'label'  => 'Meta Conversions API (CAPI)',
            'fields' => [
                ['key' => 'capi_access_token', 'label' => 'Access Token',          'type' => 'password', 'placeholder' => 'Token CAPI dari Meta Events Manager'],
                ['key' => 'capi_test_code',    'label' => 'Test Event Code',       'type' => 'text',     'placeholder' => 'TEST12345 (opsional, untuk testing)'],
                ['key' => 'capi_active',       'label' => 'Aktifkan CAPI',         'type' => 'toggle'],
            ],
        ],
        'google_analytics' => [
            'label'  => 'Google Analytics 4 (GA4)',
            'fields' => [
                ['key' => 'ga4_property_id',       'label' => 'GA4 Property ID',              'type' => 'text',     'placeholder' => 'Contoh: 312345678'],
                ['key' => 'ga4_credentials_json',  'label' => 'Service Account Credentials (.json)', 'type' => 'file',     'placeholder' => 'Upload file JSON kredensial'],
                ['key' => 'ga4_active',            'label' => 'Aktifkan Grafik Analytics',    'type' => 'toggle'],
            ],
        ],
    ];

    public function index()
    {
        // Ambil semua setting yang ada di DB
        $settings = IntegrationSetting::all()->keyBy('key');

        return view('admin.integrations.index', [
            'schema'   => $this->schema,
            'settings' => $settings,
        ]);
    }

    public function update(Request $request, string $group)
    {
        if (!isset($this->schema[$group])) {
            abort(404);
        }

        $fields = $this->schema[$group]['fields'];
        $label  = $this->schema[$group]['label'];

        foreach ($fields as $field) {
            $key = $field['key'];

            if ($field['type'] === 'toggle') {
                $value    = $request->boolean($key) ? '1' : '0';
                $isActive = (bool) $value;
            } elseif ($field['type'] === 'file') {
                if ($request->hasFile($key)) {
                    $path = $request->file($key)->store('analytics');
                    $value = $path;
                    $isActive = true;
                } else {
                    // Jika tidak ada file baru diupload, skip
                    continue;
                }
            } else {
                $value    = $request->input($key);
                $isActive = true;
            }

            // Jangan overwrite password/token kosong (user tidak mengetik ulang)
            if ($field['type'] === 'password' && $value === null) {
                continue;
            }

            IntegrationSetting::setValue($key, $group, $field['label'], $value, $isActive);
        }

        return back()->with('success', "Pengaturan {$label} berhasil disimpan.");
    }
}
