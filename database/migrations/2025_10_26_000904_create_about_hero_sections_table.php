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
        Schema::create('about_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('tagline');
            $table->integer('projects_completed')->default(0);
            $table->integer('satisfied_customers')->default(0);
            $table->integer('awards_received')->default(0);
            $table->integer('years_experience')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_hero_sections');
    }
};
