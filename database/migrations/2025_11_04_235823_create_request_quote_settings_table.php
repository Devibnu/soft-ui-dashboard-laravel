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
        Schema::create('request_quote_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Request A Quote');
            $table->text('subtitle')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('overlay_color')->default('rgba(0,0,0,0.5)');
            $table->string('button_text')->default('Send Message');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_quote_settings');
    }
};
