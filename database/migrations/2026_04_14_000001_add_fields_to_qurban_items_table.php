<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom weight_info dan image
        Schema::table('qurban_items', function (Blueprint $table) {
            $table->string('weight_info')->nullable()->after('description');
            $table->string('image')->nullable()->after('weight_info');
        });

        // Ubah ENUM type agar mendukung nilai baru (domba, sapi, sapi_kolektif)
        // sekaligus mempertahankan nilai lama (kambing, sapi_penuh, sapi_saham)
        DB::statement("ALTER TABLE qurban_items MODIFY COLUMN `type` ENUM('kambing','sapi_penuh','sapi_saham','domba','sapi','sapi_kolektif') NOT NULL");
    }

    public function down(): void
    {
        Schema::table('qurban_items', function (Blueprint $table) {
            $table->dropColumn(['weight_info', 'image']);
        });

        DB::statement("ALTER TABLE qurban_items MODIFY COLUMN `type` ENUM('kambing','sapi_penuh','sapi_saham') NOT NULL");
    }
};
