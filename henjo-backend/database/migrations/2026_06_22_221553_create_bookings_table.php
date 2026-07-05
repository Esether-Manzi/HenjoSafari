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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_number')->unique();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('package_id')
                ->constrained('safari_packages')
                ->cascadeOnDelete();

            $table->date('travel_date');

            $table->integer('adults')->default(1);

            $table->integer('children')->default(0);

            $table->integer('total_people');

            $table->decimal('quoted_price', 12, 2);

            $table->enum('currency', [
                'USD',
                'EUR',
                'UGX',
                'KES',
                'TZS'
            ]);

            $table->text('special_requests')->nullable();

            $table->enum('status', [
                'pending',
                'confirmed',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
