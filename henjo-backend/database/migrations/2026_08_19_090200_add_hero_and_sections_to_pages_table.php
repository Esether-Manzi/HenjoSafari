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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('hero_title')->nullable()->after('slug');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
            $table->string('hero_cta_text')->nullable()->after('hero_subtitle');
            $table->string('hero_cta_href')->nullable()->after('hero_cta_text');

            $table->json('sections')->nullable()->after('content');

            $table->string('meta_title')->nullable()->after('sections');
            $table->string('meta_description')->nullable()->after('meta_title');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->longText('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title',
                'hero_subtitle',
                'hero_cta_text',
                'hero_cta_href',
                'sections',
                'meta_title',
                'meta_description',
            ]);
        });
    }
};
