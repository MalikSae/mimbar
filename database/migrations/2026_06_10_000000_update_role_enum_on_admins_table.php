<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah enum column untuk memasukkan pembangun
        DB::statement("ALTER TABLE admins MODIFY COLUMN role ENUM('super_admin', 'publisher', 'pembangun') NOT NULL DEFAULT 'super_admin'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke asalnya
        DB::statement("ALTER TABLE admins MODIFY COLUMN role ENUM('super_admin', 'publisher') NOT NULL DEFAULT 'super_admin'");
    }
};
