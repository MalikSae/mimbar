<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');          // Nama bank: BCA, BRI, Mandiri, dst
            $table->string('account_number');     // Nomor rekening
            $table->string('account_holder');     // Atas nama
            $table->string('branch')->nullable(); // Cabang (opsional)
            $table->string('logo')->nullable();   // Path logo bank
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
