<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Sarah Mitchell',
                'country' => 'United Kingdom',
                'trip_name' => 'Gorilla Trekking & Queen Elizabeth Safari',
                'testimonial' => 'Henjo African Safaris exceeded every expectation. Our guide knew exactly where to find the gorillas and made the trek feel safe and unforgettable. The whole trip was flawlessly organized from airport pickup to the last game drive.',
                'rating' => 5,
                'featured' => true,
            ],
            [
                'name' => 'Daniel Kruger',
                'country' => 'South Africa',
                'trip_name' => 'Serengeti & Ngorongoro Crater Safari',
                'testimonial' => 'We saw the Big Five within three days thanks to our incredible driver-guide. Every camp was beautifully chosen and the itinerary paced perfectly for our family. Highly recommend Henjo to anyone planning an East Africa trip.',
                'rating' => 5,
                'featured' => true,
            ],
            [
                'name' => 'Emily and Mark Thompson',
                'country' => 'United States',
                'trip_name' => 'Rwanda Gorilla & Golden Monkey Tour',
                'testimonial' => 'From the first email to the final drop-off, the Henjo team was responsive, honest, and clearly passionate about conservation. Trekking the golden monkeys with our kids was the highlight of our year.',
                'rating' => 5,
                'featured' => true,
            ],
            [
                'name' => 'Akiko Tanaka',
                'country' => 'Japan',
                'trip_name' => 'Masai Mara Migration Safari',
                'testimonial' => 'Witnessing the wildebeest migration crossing the Mara River was breathtaking, and our guide timed it perfectly. Comfortable vehicles, great camps, and a team that genuinely cared about our experience.',
                'rating' => 4,
                'featured' => true,
            ],
            [
                'name' => 'Peter and Johanna Voss',
                'country' => 'Germany',
                'trip_name' => 'Uganda Wildlife & Chimpanzee Trek',
                'testimonial' => 'A very well-organized trip across multiple parks. Chimpanzee trekking in Kibale was magical and our guide\'s knowledge of birdlife was outstanding. Would book with Henjo again without hesitation.',
                'rating' => 5,
                'featured' => true,
            ],
            [
                'name' => 'Grace Achieng',
                'country' => 'Kenya',
                'trip_name' => 'Women-Only Uganda Safari',
                'testimonial' => 'Traveling solo as a woman, I felt completely safe and looked after the entire trip. The all-women group tour was a wonderful way to explore Uganda and meet like-minded travelers.',
                'rating' => 5,
                'featured' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'trip_name' => $testimonial['trip_name']],
                $testimonial
            );
        }

        $this->command->info('✅ Testimonials seeded!');
    }
}
