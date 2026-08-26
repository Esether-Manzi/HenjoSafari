<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('tripadvisor_url')->nullable()->after('youtube_url');
            $table->string('payment_url')->nullable()->after('tripadvisor_url');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['tripadvisor_url', 'payment_url']);
        });
    }
};
