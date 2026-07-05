<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🚀 Starting Database Seeder...');

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Run seeders in order
        $this->call([
            CountrySeeder::class,
            DestinationSeeder::class,
            SafariCategorySeeder::class,
            ActivitySeeder::class,
            AccommodationSeeder::class,
            SafariPackageSeeder::class,
            BlogSeeder::class,  // 👈 ADD THIS
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ All seeders completed successfully! 🎉');
    }
}
