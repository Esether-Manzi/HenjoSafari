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
        Schema::create('destinations', function (Blueprint $table) {
            // $table->id();

            // $table->string('name');
            // $table->string('slug')->unique();
            // $table->string('country');  // eg Kenya Tanzania Uganda
            // $table->text('description')->nullable();
            // $table->string('cover_image')->nullable();
            // $table->string('best_time_to_visit')->nullable();
            // $table->json('gallery')->nullable();   //stores image paths as JSON
            // $table->timestamps();

            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description');

            $table->string('short_description')
                ->nullable()
                ->comment('A brief tagline or catchphrase summarizing the destination.');

            // UG, KE, TZ, RW
            $table->string('country_code', 2);

            $table->boolean('featured')->default(false);

            $table->string('hero_image_path')->nullable();

            $table->string('best_time_to_visit')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
