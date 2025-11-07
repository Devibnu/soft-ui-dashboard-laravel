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
        Schema::table('hero_pages', function (Blueprint $table) {
            $table->dropColumn('hero_subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_pages', function (Blueprint $table) {
            $table->string('hero_subtitle')->nullable()->after('hero_title');
        });
    }
};
