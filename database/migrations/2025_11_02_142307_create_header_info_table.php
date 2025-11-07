<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel header_info untuk menyimpan informasi header website
     */
    public function up(): void
    {
        Schema::create('header_info', function (Blueprint $table) {
            $table->id();
            $table->string('nama_website'); // Nama website yang ditampilkan di header
            $table->string('email'); // Email kontak
            $table->string('telepon'); // Nomor telepon kontak
            $table->string('cta_text'); // Teks tombol Call To Action
            $table->string('cta_link'); // Link tombol Call To Action
            $table->boolean('status')->default(true); // Status aktif/non-aktif (hanya 1 yang boleh aktif)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_info');
    }
};
