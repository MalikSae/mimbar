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
        Schema::table('donation_programs', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('status');
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });

        // Data migration: move string program_category into categories table
        $programs = \Illuminate\Support\Facades\DB::table('donation_programs')->get();
        foreach ($programs as $program) {
            if ($program->program_category) {
                // Find or create category
                $cat = \Illuminate\Support\Facades\DB::table('categories')
                    ->where('name', $program->program_category)
                    ->where('type', 'donation')
                    ->first();
                
                if (!$cat) {
                    $catId = \Illuminate\Support\Facades\DB::table('categories')->insertGetId([
                        'name' => ucfirst($program->program_category),
                        'slug' => \Illuminate\Support\Str::slug($program->program_category),
                        'type' => 'donation',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $catId = $cat->id;
                }
                
                \Illuminate\Support\Facades\DB::table('donation_programs')
                    ->where('id', $program->id)
                    ->update(['category_id' => $catId]);
            }
        }

        Schema::table('donation_programs', function (Blueprint $table) {
            $table->dropColumn('program_category');
        });
    }

    public function down(): void
    {
        Schema::table('donation_programs', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->string('program_category')->nullable()->after('status');
        });

        // Data rollback: we can get the name back, but we don't delete from categories to be safe
        $programs = \Illuminate\Support\Facades\DB::table('donation_programs')->get();
        foreach ($programs as $program) {
            if ($program->category_id) {
                $cat = \Illuminate\Support\Facades\DB::table('categories')->where('id', $program->category_id)->first();
                if ($cat) {
                    \Illuminate\Support\Facades\DB::table('donation_programs')
                        ->where('id', $program->id)
                        ->update(['program_category' => $cat->name]);
                }
            }
        }

        Schema::table('donation_programs', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
};
