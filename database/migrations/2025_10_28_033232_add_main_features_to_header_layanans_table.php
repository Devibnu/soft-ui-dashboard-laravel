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
        Schema::table('header_layanans', function (Blueprint $table) {
            $table->string('judul_main_features')->nullable()->after('status_aktif');
            $table->text('deskripsi_main_features')->nullable()->after('judul_main_features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('header_layanans', function (Blueprint $table) {
            $table->dropColumn(['judul_main_features', 'deskripsi_main_features']);
        });
    }
};
