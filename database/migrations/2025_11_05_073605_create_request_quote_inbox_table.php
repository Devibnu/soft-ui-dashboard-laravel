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
        Schema::create('request_quote_inbox', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->string('service_slug');
            $table->text('pesan');
            $table->enum('status', ['baru', 'dibaca', 'selesai'])->default('baru');
            $table->timestamps();
            
            // Foreign key
            $table->foreign('service_slug')->references('slug')->on('request_quote_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_quote_inbox');
    }
};
