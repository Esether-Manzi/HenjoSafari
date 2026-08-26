<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('itinerary_days', function (Blueprint $table) {
            $table->string('destination')->nullable()->after('day_number');
            $table->unsignedInteger('day_number_end')->nullable()->after('day_number');
            $table->string('accommodation')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('itinerary_days', function (Blueprint $table) {
            $table->dropColumn(['destination', 'day_number_end', 'accommodation']);
        });
    }
};
