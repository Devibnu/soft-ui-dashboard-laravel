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
        Schema::table('about_sections', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('success_title')->nullable();
            $table->text('success_description')->nullable();
            $table->string('welcome_title')->nullable();
            $table->text('welcome_paragraph1')->nullable();
            $table->text('welcome_paragraph2')->nullable();
            $table->text('welcome_paragraph3')->nullable();
            $table->string('consultation_title')->nullable();
            $table->text('consultation_paragraph1')->nullable();
            $table->text('consultation_paragraph2')->nullable();
            $table->string('guidance_title')->nullable();
            $table->string('video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'phone',
                'address',
                'success_title',
                'success_description',
                'welcome_title',
                'welcome_paragraph1',
                'welcome_paragraph2',
                'welcome_paragraph3',
                'consultation_title',
                'consultation_paragraph1',
                'consultation_paragraph2',
                'guidance_title',
                'video_url'
            ]);
        });
    }
};
