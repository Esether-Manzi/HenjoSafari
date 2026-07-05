<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $activities = [
            ['name' => 'Game Drive', 'slug' => 'game-drive', 'icon' => '🚗'],
            ['name' => 'Hot Air Balloon', 'slug' => 'hot-air-balloon', 'icon' => '🎈'],
            ['name' => 'Walking Safari', 'slug' => 'walking-safari', 'icon' => '🚶'],
            ['name' => 'Boat Safari', 'slug' => 'boat-safari', 'icon' => '🚤'],
            ['name' => 'Cultural Visit', 'slug' => 'cultural-visit', 'icon' => '🏠'],
            ['name' => 'Bird Watching', 'slug' => 'bird-watching', 'icon' => '🦅'],
            ['name' => 'Photography', 'slug' => 'photography', 'icon' => '📷'],
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