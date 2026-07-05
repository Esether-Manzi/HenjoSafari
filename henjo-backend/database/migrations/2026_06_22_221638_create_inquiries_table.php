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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('email');

            $table->string('phone')->nullable();

            $table->foreignId('package_id')
                ->nullable()
                ->constrained('safari_packages')
                ->nullOnDelete();

            $table->string('subject')->nullable();

            $table->longText('message');

            $table->enum('status', [
                'new',
                'contacted',
                'closed'
            ])->default('new');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
