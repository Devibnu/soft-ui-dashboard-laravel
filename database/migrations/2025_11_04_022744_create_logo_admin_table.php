<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel untuk menyimpan logo admin panel
     */
    public function up(): void
    {
        Schema::create('logo_admin', function (Blueprint $table) {
            $table->id();
            $table->string('gambar'); // Path file gambar logo
            $table->boolean('status')->default(true); // Status aktif/nonaktif, hanya 1 yang boleh aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_admin');
    }
};
