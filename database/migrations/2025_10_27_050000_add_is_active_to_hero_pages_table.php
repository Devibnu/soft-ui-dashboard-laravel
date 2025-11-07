<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('hero_pages')) {
            Schema::table('hero_pages', function (Blueprint $table) {
                if (!Schema::hasColumn('hero_pages', 'is_active')) {
                    $table->boolean('is_active')->default(1)->after('breadcrumb_text');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('hero_pages')) {
            Schema::table('hero_pages', function (Blueprint $table) {
                if (Schema::hasColumn('hero_pages', 'is_active')) {
                    $table->dropColumn('is_active');
                }
            });
        }
    }
};
