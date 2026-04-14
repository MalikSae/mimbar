<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private function hasColumn(string $table, string $column): bool
    {
        $result = DB::select("SHOW COLUMNS FROM `{$table}` WHERE Field = ?", [$column]);
        return count($result) > 0;
    }

    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (!$this->hasColumn('articles', 'author_name')) {
                $table->string('author_name')->nullable()->after('featured_image');
            }
            if (!$this->hasColumn('articles', 'author_photo')) {
                $table->string('author_photo')->nullable()->after('author_name');
            }
            if (!$this->hasColumn('articles', 'author_bio')) {
                $table->text('author_bio')->nullable()->after('author_photo');
            }
            if (!$this->hasColumn('articles', 'reading_time')) {
                $table->unsignedTinyInteger('reading_time')->nullable()->after('author_bio');
            }
            if (!$this->hasColumn('articles', 'tags')) {
                $table->longText('tags')->nullable()->after('reading_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['author_name', 'author_photo', 'author_bio', 'reading_time', 'tags']);
        });
    }
};
