<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $activities = [
            ['name' => 'Game Drive', 'slug' => 'game-drive', 'image' => 'game-drive.jpeg'],
            ['name' => 'Hot Air Balloon', 'slug' => 'hot-air-balloon'],
            ['name' => 'Walking Safari', 'slug' => 'walking-safari', 'image' => 'walking-safari.jpeg'],
            ['name' => 'Boat Safari', 'slug' => 'boat-safari', 'image' => 'boat-safari.jpeg'],
            ['name' => 'Cultural Visit', 'slug' => 'cultural-visit'],
            ['name' => 'Bird Watching', 'slug' => 'bird-watching', 'image' => 'bird-watching.jpeg'],
            ['name' => 'Photography', 'slug' => 'photography'],
            ['name' => 'White Water Rafting', 'slug' => 'white-water-rafting', 'image' => 'white-water-rafting.jpeg'],
        ];

        foreach ($activities as $activity) {
            $image = $activity['image'] ?? null;
            unset($activity['image']);

            $model = Activity::updateOrCreate(
                ['slug' => $activity['slug']],
                $activity
            );

            $imagePath = $image ? public_path('images/activities/' . $image) : null;
            if ($imagePath && file_exists($imagePath)) {
                $model->clearMediaCollection('image');
                $model->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('image');
            }
        }

        $this->command->info('✅ Activities seeded!');
    }
}