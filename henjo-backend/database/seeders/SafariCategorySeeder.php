<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SafariCategory;

class SafariCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Wildlife Adventure', 'slug' => 'wildlife-adventure'],
            ['name' => 'Gorilla Trekking', 'slug' => 'gorilla-safaris'],
            ['name' => 'Fly-In Safaris', 'slug' => 'flying'],
            ['name' => 'Mountaineering', 'slug' => 'mountaineering'],
            ['name' => 'Cultural Tour', 'slug' => 'cultural-tour'],
            ['name' => 'Women Only Tours', 'slug' => 'women-only-tours'],
            ['name' => 'City Tours', 'slug' => 'city-tours'],
            ['name' => 'Birding Safari', 'slug' => 'birding'],
            ['name' => 'Cycling Safari', 'slug' => 'cycling'],
            ['name' => 'Day Tours', 'slug' => 'day-tours'],
        ];

        foreach ($categories as $category) {
            SafariCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('✅ Safari categories seeded!');
    }
}
