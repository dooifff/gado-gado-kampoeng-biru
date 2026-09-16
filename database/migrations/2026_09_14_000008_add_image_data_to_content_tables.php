<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['menus', 'galleries', 'testimonials'] as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->longText('image_data')->nullable()->after('image');
                $blueprint->string('image_mime', 64)->nullable()->after('image_data');
            });
        }
    }

    public function down(): void
    {
        foreach (['menus', 'galleries', 'testimonials'] as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->dropColumn(['image_mime', 'image_data']);
            });
        }
    }
};