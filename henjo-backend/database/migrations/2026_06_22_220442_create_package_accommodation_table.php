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
        Schema::create('package_accommodation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
        ->constrained('safari_packages')
        ->cascadeOnDelete();

            $table->foreignId('accommodation_id')
        ->constrained()
        ->cascadeOnDelete();

            $table->enum('package_level', [
        'budget',
        'midrange',
        'luxury'
    ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_accommodation');
    }
};
