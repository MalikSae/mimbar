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
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('landing_page_id')->constrained('landing_pages')->cascadeOnDelete();
            $table->string('type');
            $table->unsignedInteger('order')->default(0);
            $table->longText('content')->nullable();
            $table->longText('desktop_settings')->nullable();
            $table->longText('mobile_settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_blocks');
    }
};
