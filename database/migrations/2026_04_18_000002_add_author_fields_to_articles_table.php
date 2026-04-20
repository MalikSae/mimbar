<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom author_id dan admin_id
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('author_id')->nullable()->after('category_id')->constrained('authors')->nullOnDelete();
            $table->foreignId('admin_id')->nullable()->after('author_id')->constrained('admins')->nullOnDelete();
        });

        // Ubah enum status untuk menambahkan pending_review
        DB::statement("ALTER TABLE articles MODIFY COLUMN status ENUM('draft','pending_review','published') NOT NULL DEFAULT 'draft'");
    }

    public function down(): void
    {
        // Kembalikan enum status
        DB::statement("ALTER TABLE articles MODIFY COLUMN status ENUM('draft','published') NOT NULL DEFAULT 'draft'");

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['author_id', 'admin_id']);
        });
    }
};
