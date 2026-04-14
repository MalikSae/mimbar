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
        Schema::table('ebook_downloads', function (Blueprint $table) {
            $table->unsignedSmallInteger('unique_code')->nullable()->after('donation_amount');
            $table->unsignedBigInteger('total_transfer')->nullable()->after('unique_code');
            $table->string('payment_status', 20)->nullable()->after('total_transfer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ebook_downloads', function (Blueprint $table) {
            $table->dropColumn(['unique_code', 'total_transfer', 'payment_status']);
        });
    }
};
