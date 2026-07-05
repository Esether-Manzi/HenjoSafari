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
        Schema::create('safari_packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('destination_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('summary')->nullable();

            $table->longText('description')->nullable();

            $table->integer('duration_days');

            $table->integer('duration_nights')->default(0);

            $table->decimal('base_price', 12, 2);

            $table->enum('currency', [
                'USD',
                'EUR',
                'UGX',
                'KES',
                'TZS',
            ])->default('USD');

            $table->integer('min_people')->default(1);

            $table->integer('max_people')->nullable();

            $table->boolean('featured')->default(false);

            $table->boolean('popular')->default(false);

            $table->enum('status', [
                'draft',
                'published',
                'archived',
            ])->default('draft');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safari_packages');
    }
};
