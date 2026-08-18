<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Country;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            [
                'country_code' => 'UG',
                'name' => 'Uganda - The Pearl of Africa',
                'slug' => 'uganda',
                'description' => 'Home to over half of the world remaining mountain gorilla population, source of the mighty River Nile, snow-capped Rwenzori mountains, and magnificent wildlife national parks.',
                'best_time_to_visit' => 'June to September, December to February',
                'featured' => true,
                'is_active' => true,
            ],
            [
                'country_code' => 'KE',
                'name' => 'Kenya - Wildebeest Migration',
                'slug' => 'kenya',
                'description' => 'World-famous for the Masai Mara annual wildebeest migration, majestic Mt. Kilimanjaro backdrops in Amboseli, and pristine Indian Ocean beaches.',
                'best_time_to_visit' => 'July to October, January to March',
                'featured' => true,
                'is_active' => true,
            ],
            [
                'country_code' => 'TZ',
                'name' => 'Tanzania - Home of Mt. Kilimanjaro',
                'slug' => 'tanzania',
                'description' => 'Experience the legendary Serengeti plains, the ancient Ngorongoro Crater floor, Lake Manyara tree-climbing lions, and exotic Zanzibar beaches.',
                'best_time_to_visit' => 'June to October, December to March',
                'featured' => true,
                'is_active' => true,
            ],
            [
                'country_code' => 'RW',
                'name' => 'Rwanda - Land of a Thousand Hills',
                'slug' => 'rwanda',
                'description' => 'Remarkable gorilla tracking in Volcanoes National Park, Big Five wildlife game drives in Akagera, and rich cultural heritage in Kigali.',
                'best_time_to_visit' => 'June to September, December to February',
                'featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destData) {
            $country = Country::where('code', $destData['country_code'])->first();
            if ($country) {
                unset($destData['country_code']);
                $destData['country_id'] = $country->id;
                Destination::updateOrCreate(
                    ['slug' => $destData['slug']],
                    $destData
                );
            }
        }

        $this->command->info('✅ Destinations seeded!');
    }
}
