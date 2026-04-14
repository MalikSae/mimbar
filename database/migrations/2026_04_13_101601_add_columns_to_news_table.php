<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('location')->nullable()->after('featured_image');
            $table->string('hijri_date')->nullable()->after('location');
            $table->longText('tags')->nullable()->after('hijri_date');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['location', 'hijri_date', 'tags']);
        });
    }
};
