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
        Schema::table('home_hero', function (Blueprint $table) {
            $table->string('warna_overlay')->nullable()->default('rgba(0, 0, 0, 0.5)')->after('gambar_background');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_hero', function (Blueprint $table) {
            $table->dropColumn('warna_overlay');
        });
    }
};
