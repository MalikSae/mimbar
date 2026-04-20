<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Insert jika belum ada, skip jika sudah ada
        DB::table('settings')->insertOrIgnore([
            'key'   => 'total_visitors',
            'value' => '0',
        ]);
    }

    public function down(): void
    {
        DB::table('settings')->where('key', 'total_visitors')->delete();
    }
};
