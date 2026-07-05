<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accommodation;

class AccommodationSeeder extends Seeder
{
    public function run()
    {
        $accommodations = [
            [
                'name' => 'Serengeti Safari Lodge',
                'type' => 'lodge',
                'description' => 'A luxury lodge in the heart of the Serengeti.',
                'star_rating' => 5,
            ],
            [
                'name' => 'Ngorongoro Crater Camp',
                'type' => 'camp',
                'description' => 'A premium camp on the rim of the Ngorongoro Crater.',
                'star_rating' => 4,
            ],
            [
                'name' => 'Zanzibar Beach Resort',
                'type' => 'resort',
                'description' => 'A 5-star resort on the beautiful Zanzibar beaches.',
                'star_rating' => 5,
            ],
            [
                'name' => 'Arusha Hotel',
                'type' => 'hotel',
                'description' => 'A comfortable hotel in the heart of Arusha.',
                'star_rating' => 3,
            ],
        ];

        foreach ($accommodations as $accommodation) {
            Accommodation::updateOrCreate(
                ['name' => $accommodation['name']],
                $accommodation
            );
        }

        $this->command->info('✅ Accommodations seeded!');
    }
}