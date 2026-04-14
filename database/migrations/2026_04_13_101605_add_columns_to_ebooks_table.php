<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->string('file_size')->nullable()->after('page_count');
            $table->string('file_url')->nullable()->after('file_path');
            $table->string('preview_url')->nullable()->after('file_url');
            $table->boolean('is_featured')->default(false)->after('status');
            $table->text('synopsis')->nullable()->after('description');
            $table->text('quote')->nullable()->after('synopsis');
            $table->longText('table_of_contents')->nullable()->after('quote');
        });
    }

    public function down(): void
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropColumn(['file_size', 'file_url', 'preview_url', 'is_featured', 'synopsis', 'quote', 'table_of_contents']);
        });
    }
};
