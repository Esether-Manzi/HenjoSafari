<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Allow bookings to be created without a specific package_id
     * (admin will assign the package after reviewing the booking request).
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the existing foreign key constraint first
            $table->dropForeign(['package_id']);

            // Re-add as nullable with a nullable foreign key
            $table->foreignId('package_id')
                ->nullable()
                ->change();

            // Re-add the foreign key constraint (nullable-safe)
            $table->foreign('package_id')
                ->references('id')
                ->on('safari_packages')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['package_id']);

            $table->foreignId('package_id')
                ->nullable(false)
                ->change();

            $table->foreign('package_id')
                ->references('id')
                ->on('safari_packages')
                ->cascadeOnDelete();
        });
    }
};
