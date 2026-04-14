<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ebook_downloads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('ebook_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('whatsapp');
            $table->boolean('want_donate')->default(false);
            $table->unsignedBigInteger('donation_amount')->nullable();
            $table->timestamp('downloaded_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ebook_downloads');
    }
};
