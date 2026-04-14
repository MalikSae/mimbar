<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_proofs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('donation_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->string('sender_name');
            $table->string('sender_bank');
            $table->date('transfer_date');
            $table->decimal('transfer_amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_proofs');
    }
};
