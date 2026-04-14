<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qurban_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('item_id')->constrained('qurban_items')->cascadeOnDelete();
            $table->string('reference_code')->unique();
            $table->string('shohibul_name');
            $table->string('phone');
            $table->string('email');
            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 15, 2);
            $table->text('notes')->nullable();
            $table->enum('status', [
                'pending_payment',
                'pending_verification',
                'confirmed',
                'rejected',
                'distributed',
            ])->default('pending_payment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qurban_orders');
    }
};
