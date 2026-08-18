<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accommodation;

class AccommodationSeeder extends Seeder
{
    public function run()
    {
        // Real lodges referenced across the safari itineraries in
        // henjosafaris-content-audit.md §5.1/§5.3, replacing the earlier
        // generic Tanzania-template placeholders.
        $accommodations = [
            ['name' => 'Buhoma Lodge', 'type' => 'lodge', 'description' => 'Lodge on the edge of Bwindi Impenetrable Forest, used on gorilla trekking safaris.', 'star_rating' => 4],
            ['name' => 'Da Vinci Gorilla Lodge', 'type' => 'lodge', 'description' => 'Gorilla-trekking lodge near Volcanoes National Park, Rwanda.', 'star_rating' => 4],
            ['name' => 'Bweza Gorilla Lodge', 'type' => 'lodge', 'description' => 'Lodge used on Rwanda gorilla and golden monkey safaris.', 'star_rating' => 3],
            ['name' => 'Mweya Safari Lodge', 'type' => 'lodge', 'description' => 'Lodge overlooking the Kazinga Channel in Queen Elizabeth National Park, Uganda.', 'star_rating' => 4],
            ['name' => 'Rwakobo Rock', 'type' => 'lodge', 'description' => 'Lodge on the edge of Lake Mburo National Park, Uganda.', 'star_rating' => 3],
            ['name' => 'Sentrim Amboseli Camp', 'type' => 'camp', 'description' => 'Tented camp in Amboseli National Park, Kenya, with views of Mount Kilimanjaro.', 'star_rating' => 3],
            ['name' => 'Mara Serena Safari Lodge', 'type' => 'lodge', 'description' => 'Lodge overlooking the Masai Mara National Reserve, Kenya.', 'star_rating' => 4],
            ['name' => 'Kitela Lodge', 'type' => 'lodge', 'description' => 'Lodge near Karatu on the edge of the Ngorongoro Crater, Tanzania.', 'star_rating' => 4],
            ['name' => "Hotel Des Mille Collines", 'type' => 'hotel', 'description' => 'Hotel in Kigali, Rwanda, used on gorilla safari city stopovers.', 'star_rating' => 4],
            ['name' => 'Akagera Game Lodge', 'type' => 'lodge', 'description' => 'Lodge in Akagera National Park, Rwanda.', 'star_rating' => 3],
            ['name' => 'Equator Snow Lodge', 'type' => 'lodge', 'description' => 'Lodge at the foot of the Rwenzori Mountains, Uganda.', 'star_rating' => 3],
            ['name' => "&Beyond Kichwa Tembo Tented Camp", 'type' => 'camp', 'description' => 'Luxury unfenced tented camp in the Masai Mara, Kenya.', 'star_rating' => 5],
        ];

        foreach ($accommodations as $accommodation) {
            Accommodation::updateOrCreate(
                ['name' => $accommodation['name']],
                $accommodation
            );
        }

        // Remove earlier generic Tanzania-template placeholders
        Accommodation::whereIn('name', [
            'Serengeti Safari Lodge',
            'Ngorongoro Crater Camp',
            'Zanzibar Beach Resort',
            'Arusha Hotel',
        ])->delete();

        $this->command->info('✅ Accommodations seeded!');
    }
}