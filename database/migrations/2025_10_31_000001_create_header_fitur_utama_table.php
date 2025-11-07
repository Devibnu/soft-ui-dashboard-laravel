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
        Schema::create('header_fitur_utama', function (Blueprint $table) {
            $table->id();
            $table->string('judul_section');
            $table->text('deskripsi_section');
            $table->string('gambar_cta')->nullable();
            $table->string('judul_cta');
            $table->text('deskripsi_cta');
            $table->string('button_text')->default('Contact us');
            $table->string('button_url')->default('/contact');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_fitur_utama');
    }
};
