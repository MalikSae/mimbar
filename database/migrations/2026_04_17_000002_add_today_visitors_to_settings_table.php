<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')->insertOrIgnore([
            'key'   => 'today_visitors',
            'value' => '0',
        ]);

        DB::table('settings')->insertOrIgnore([
            'key'   => 'today_visitors_date',
            'value' => '',
        ]);
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['today_visitors', 'today_visitors_date'])->delete();
    }
};
