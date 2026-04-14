<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qurban_orders', function (Blueprint $table) {
            $table->string('order_number')->nullable()->unique()->after('reference_code');
            $table->string('donor_name')->nullable()->after('order_number');
            $table->string('whatsapp')->nullable()->after('phone');
            $table->boolean('is_anonymous')->default(false)->after('email');
            $table->text('prayer')->nullable()->after('notes');
            $table->unsignedSmallInteger('unique_code')->nullable()->after('prayer');
            $table->timestamp('expired_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('qurban_orders', function (Blueprint $table) {
            $table->dropUnique(['order_number']);
            $table->dropColumn(['order_number', 'donor_name', 'whatsapp', 'is_anonymous', 'prayer', 'unique_code', 'expired_at']);
        });
    }
};
