<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('translation_caches', function (Blueprint $table) {
            $table->id();
            $table->string('source_hash', 64);
            $table->text('source_text');
            $table->text('translated_text');
            $table->string('source_lang', 5)->default('id');
            $table->string('target_lang', 5)->default('ar');
            $table->timestamps();

            $table->unique(['source_hash', 'target_lang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translation_caches');
    }
};
