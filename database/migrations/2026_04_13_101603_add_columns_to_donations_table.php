<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('donor_phone');
            $table->text('message')->nullable()->after('notes');
            $table->unsignedSmallInteger('unique_code')->nullable()->after('message');
            $table->timestamp('expired_at')->nullable()->after('verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'message', 'unique_code', 'expired_at']);
        });
    }
};
