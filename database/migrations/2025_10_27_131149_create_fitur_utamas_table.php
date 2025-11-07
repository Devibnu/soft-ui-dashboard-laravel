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
        Schema::create('fitur_utamas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_bagian');
            $table->text('deskripsi');
            $table->string('gambar_box')->nullable();
            $table->string('judul_box_kanan');
            $table->text('deskripsi_box_kanan');
            $table->string('teks_tombol');
            $table->string('link_tombol')->nullable();
            $table->boolean('status_aktif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitur_utamas');
    }
};
