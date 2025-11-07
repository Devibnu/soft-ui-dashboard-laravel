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
        Schema::table('proyek', function (Blueprint $table) {
            // Drop old kategori column if exists and create new one
            $table->dropColumn('kategori');
        });
        
        Schema::table('proyek', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->after('slug')->constrained('kategori_project')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyek', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
        
        Schema::table('proyek', function (Blueprint $table) {
            $table->string('kategori')->after('slug');
        });
    }
};
