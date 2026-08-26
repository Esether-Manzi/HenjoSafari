<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        // These are the ones curated for the homepage showcase (featured => true);
        // RealSafariPackageSeeder adds the rest of the real activity taxonomy
        // unfeatured by default, since package tagging needs to be complete even
        // for activities the homepage shouldn't spotlight.
        $activities = [
            ['name' => 'Game Drive', 'slug' => 'game-drive', 'image' => 'game-drive.jpeg', 'featured' => true],
            ['name' => 'Mountain Gorilla Trekking', 'slug' => 'mountain-gorilla-trekking', 'image' => 'gorilla-trekking.jpg', 'featured' => true],
            ['name' => 'Chimpanzee Trekking', 'slug' => 'chimpanzee-trekking', 'image' => 'chimpanzee-trekking.jpg', 'featured' => true],
            ['name' => 'Walking Safari', 'slug' => 'walking-safari', 'image' => 'walking-safari.jpeg', 'featured' => true],
            ['name' => 'Boat Safari', 'slug' => 'boat-safari', 'image' => 'boat-safari.jpeg', 'featured' => true],
            ['name' => 'Cultural Visit', 'slug' => 'cultural-visit', 'featured' => true],
            ['name' => 'Bird Watching', 'slug' => 'bird-watching', 'image' => 'bird-watching.jpeg', 'featured' => true],
            ['name' => 'White Water Rafting', 'slug' => 'white-water-rafting', 'image' => 'white-water-rafting.jpeg', 'featured' => true],
        ];

        // Retired placeholder activity — removed here so re-running this
        // seeder cleans up anything created by an earlier version of this
        // list. NOTE: 'photography' used to be here too, but that slug is
        // now the real "Photography" activity real packages are tagged
        // with (RealSafariPackageSeeder) — unfeatured, not deleted.
        Activity::whereIn('slug', ['hot-air-balloon'])->delete();

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