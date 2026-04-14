<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation_programs', function (Blueprint $table) {
            $table->date('deadline_date')->nullable()->after('status');
            $table->unsignedInteger('donor_count')->default(0)->after('deadline_date');
            $table->string('program_category')->nullable()->after('donor_count');
            $table->string('department')->nullable()->after('program_category');
            $table->longText('gallery')->nullable()->after('department');
            $table->longText('specs')->nullable()->after('gallery');
        });
    }

    public function down(): void
    {
        Schema::table('donation_programs', function (Blueprint $table) {
            $table->dropColumn(['deadline_date', 'donor_count', 'program_category', 'department', 'gallery', 'specs']);
        });
    }
};
