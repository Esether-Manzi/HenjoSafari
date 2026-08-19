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
                'tagline' => 'The Pearl of Africa',
                'description' => 'Home to over half of the world remaining mountain gorilla population, source of the mighty River Nile, snow-capped Rwenzori mountains, and magnificent wildlife national parks.',
                'highlights' => ['Gorilla Trekking', 'Chimpanzee Tracking', 'Source of the Nile', 'Queen Elizabeth NP', 'Rwenzori Mountains'],
                'starting_price' => 1050,
                'best_time_to_visit' => 'June to September, December to February',
                'featured' => true,
                'is_active' => true,
            ],
            [
                'country_code' => 'KE',
                'name' => 'Kenya - Wildebeest Migration',
                'slug' => 'kenya',
                'tagline' => 'Where the Wild Runs Free',
                'description' => 'World-famous for the Masai Mara annual wildebeest migration, majestic Mt. Kilimanjaro backdrops in Amboseli, and pristine Indian Ocean beaches.',
                'highlights' => ['Great Migration', 'Masai Mara', 'Amboseli', 'Lake Nakuru', 'Tsavo'],
                'starting_price' => 978,
                'best_time_to_visit' => 'July to October, January to March',
                'featured' => true,
                'is_active' => true,
            ],
            [
                'country_code' => 'TZ',
                'name' => 'Tanzania - Home of Mt. Kilimanjaro',
                'slug' => 'tanzania',
                'tagline' => 'The Roof of Africa',
                'description' => 'Experience the legendary Serengeti plains, the ancient Ngorongoro Crater floor, Lake Manyara tree-climbing lions, and exotic Zanzibar beaches.',
                'highlights' => ['Serengeti', 'Ngorongoro Crater', 'Kilimanjaro', 'Tarangire', 'Zanzibar'],
                'starting_price' => 1200,
                'best_time_to_visit' => 'June to October, December to March',
                'featured' => true,
                'is_active' => true,
            ],
            [
                'country_code' => 'RW',
                'name' => 'Rwanda - Land of a Thousand Hills',
                'slug' => 'rwanda',
                'tagline' => 'The Land of a Thousand Hills',
                'description' => 'Remarkable gorilla tracking in Volcanoes National Park, Big Five wildlife game drives in Akagera, and rich cultural heritage in Kigali.',
                'highlights' => ['Gorilla Safaris', 'Golden Monkeys', 'Volcanoes NP', 'Lake Kivu', 'Akagera NP'],
                'starting_price' => 1500,
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
