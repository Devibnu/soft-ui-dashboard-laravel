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
        Schema::create('about_testimonial_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_title');
            $table->text('section_subtext');
            $table->string('name');
            $table->string('position');
            $table->text('message');
            $table->string('photo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_testimonial_sections');
    }
};
