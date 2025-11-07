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
        Schema::create('daftar_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_bagian');
            $table->text('subjudul');
            $table->string('icon')->nullable();
            $table->string('judul_layanan');
            $table->text('deskripsi_layanan');
            $table->boolean('status_aktif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_layanans');
    }
};
