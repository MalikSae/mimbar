<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('integration_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();   // Slug key unik e.g. fonnte_token
            $table->string('group');           // Grup: wa_fonnte | meta_pixel | meta_capi
            $table->string('label');           // Label tampilan
            $table->text('value')->nullable(); // Nilai (enkripsi untuk secret)
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integration_settings');
    }
};
