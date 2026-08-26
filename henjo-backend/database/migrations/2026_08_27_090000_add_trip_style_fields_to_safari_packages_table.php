<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('safari_packages', function (Blueprint $table) {
            $table->decimal('price_max', 12, 2)->nullable()->after('base_price');
            $table->unsignedTinyInteger('min_age')->nullable()->after('max_people');
            $table->enum('tour_privacy', ['private', 'exclusive_private', 'shared'])->nullable()->after('min_age');
            $table->enum('comfort_level', ['budget', 'mid-range', 'luxury'])->nullable()->after('tour_privacy');
            $table->string('accommodation_style')->nullable()->after('comfort_level');
            $table->boolean('customizable')->nullable()->after('accommodation_style');
            $table->boolean('solo_travelers_ok')->nullable()->after('customizable');
            $table->string('start_flexibility')->nullable()->after('solo_travelers_ok');
        });
    }

    public function down(): void
    {
        Schema::table('safari_packages', function (Blueprint $table) {
            $table->dropColumn([
                'price_max',
                'min_age',
                'tour_privacy',
                'comfort_level',
                'accommodation_style',
                'customizable',
                'solo_travelers_ok',
                'start_flexibility',
            ]);
        });
    }
};
