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
        Schema::table('logo_admin', function (Blueprint $table) {
            $table->string('nama_perusahaan')->nullable()->after('gambar');
            $table->string('tagline')->nullable()->after('nama_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logo_admin', function (Blueprint $table) {
            $table->dropColumn(['nama_perusahaan', 'tagline']);
        });
    }
};
