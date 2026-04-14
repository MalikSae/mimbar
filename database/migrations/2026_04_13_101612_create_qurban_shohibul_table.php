<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qurban_shohibul', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('qurban_order_id')->constrained()->cascadeOnDelete();
            $table->string('shohibul_name');
            $table->unsignedTinyInteger('order_position');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qurban_shohibul');
    }
};
