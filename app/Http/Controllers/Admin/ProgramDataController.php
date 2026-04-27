<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ProgramDataController extends Controller
{
    public function index()
    {
        $keys = [
            'stat_dakwah_kajian' => '1.245',
            'stat_jamaah' => '100.000+',
            'stat_dakwah_kaderisasi' => '134',
            'stat_dakwah_pengislaman' => '788',
            'stat_dakwah_markaz' => '17',
            'stat_dakwah_kafalah' => '43',
            'stat_dakwah_kerjasama' => '957',
            'stat_mushaf' => '21.969',
            'stat_dakwah_buku' => '11.451',
            
            'stat_pendidikan_markaz' => '17',
            'stat_pendidikan_kaderisasi' => '134',
            'stat_pendidikan_kafalah' => '43',
            
            'stat_pembangunan_masjid' => '157',
            'stat_pembangunan_sumur' => '152',
            'stat_pembangunan_desain' => '4 Tipe',
            
            'stat_sosial_paket_buka_puasa' => '157.099',
            'stat_sosial_pembagian_sembako' => '3.135',
            'stat_sosial_hewan_qurban' => '1.140',

            // Data Home Page
            'stat_home_masjid' => '160',
            'stat_home_sumur' => '155',
            'stat_home_quran' => '27969',
            'stat_home_buku' => '0',
            'stat_home_qurban' => '0',
            'stat_home_dai' => '135',
            'stat_home_pengajar' => '947',
            'stat_home_kegiatan' => '500',
            'stat_home_digital' => '1958',
            'stat_home_sembako' => '3535',
        ];

        $settings = [];
        foreach ($keys as $key => $default) {
            $settings[$key] = SiteSetting::get($key, $default);
        }

        return view('admin.program-data.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'stat_')) {
                SiteSetting::set($key, $value);
            }
        }

        return redirect()->route('admin.program-data.index')->with('success', 'Data pencapaian program berhasil diperbarui.');
    }
}
