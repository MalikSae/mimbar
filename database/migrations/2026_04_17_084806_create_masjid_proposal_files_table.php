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
        Schema::create('masjid_proposal_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained('masjid_proposals')->cascadeOnDelete();
            $table->string('file_type');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masjid_proposal_files');
    }
};
