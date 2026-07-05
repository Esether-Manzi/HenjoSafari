<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SafariCategory;

class SafariCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Wildlife Safari', 'slug' => 'wildlife-safari'],
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'Luxury', 'slug' => 'luxury'],
            ['name' => 'Budget', 'slug' => 'budget'],
            ['name' => 'Family', 'slug' => 'family'],
            ['name' => 'Honeymoon', 'slug' => 'honeymoon'],
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