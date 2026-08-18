<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $activities = [
            ['name' => 'Game Drive', 'slug' => 'game-drive'],
            ['name' => 'Hot Air Balloon', 'slug' => 'hot-air-balloon'],
            ['name' => 'Walking Safari', 'slug' => 'walking-safari'],
            ['name' => 'Boat Safari', 'slug' => 'boat-safari'],
            ['name' => 'Cultural Visit', 'slug' => 'cultural-visit'],
            ['name' => 'Bird Watching', 'slug' => 'bird-watching'],
            ['name' => 'Photography', 'slug' => 'photography'],
        ];

        foreach ($activities as $activity) {
            Activity::updateOrCreate(
                ['slug' => $activity['slug']],
                $activity
            );
        }

        $this->command->info('✅ Activities seeded!');
    }
}