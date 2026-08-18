<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SafariPackage;
use App\Models\Destination;
use App\Models\Country;
use App\Models\SafariCategory;
use App\Models\ItineraryDay;
use App\Models\PackageInclusion;
use App\Models\PackageExclusion;

class SafariPackageSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🚀 Starting Real Safari Package Seeder with Exact Live Images...');

        $packagesData = [
            [
                'title' => '12-Day Kenya Classic Signature Wildlife Safari',
                'slug' => '12-day-kenya-classic-signature-wildlife-safari-2',
                'country_code' => 'KE',
                'summary' => 'This 12-day safari takes you to around Kenya’s best tourist attractions from lions, elephants, cheetahs, zebras and wildebeests providing an authentic dose of African wildlife and creates memorable experiences.',
                'description' => 'This 12-day safari takes you to around Kenya’s best tourist attractions from lions, elephants, cheetahs, zebras and wildebeests providing an authentic dose of African wildlife and creates memorable experiences.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 12-Day Kenya Classic Signature Wildlife Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/12-day-kenya-classic-signature-wildlife-safari-2.jpg',
            ],
            [
                'title' => '5-Day Masai Mara Flying Luxury Safari',
                'slug' => '5-day-masai-mara-flying-luxury-safari',
                'country_code' => 'KE',
                'summary' => 'This 5-day safari takes you to and Beyond Kichwa Tembo Camp which is sprawled along the Saparingo River on the edge of the Oloololo escarpment, where the riverine forest meets the sweeping plains in the seasonal path of ...',
                'description' => 'This 5-day safari takes you to and Beyond Kichwa Tembo Camp which is sprawled along the Saparingo River on the edge of the Oloololo escarpment, where the riverine forest meets the sweeping plains in the seasonal path of the awe-inspiring great migration. The camp provides an authentic dose of African wildlife, and creates memorable experiences.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 5-Day Masai Mara Flying Luxury Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/5-day-masai-mara-flying-luxury-safari.jpg',
            ],
            [
                'title' => '8 Days Best of Kenya Safari',
                'slug' => '8-days-best-of-kenya-safari',
                'country_code' => 'KE',
                'summary' => 'In this 8 days adventure, you’ll travel to Amboseli National Park, spending two nights in the home of the largest tuskers you will ever see. You’ll be stopping for a night in the idyllic Lake Nakuru and another in Lake N...',
                'description' => 'In this 8 days adventure, you’ll travel to Amboseli National Park, spending two nights in the home of the largest tuskers you will ever see. You’ll be stopping for a night in the idyllic Lake Nakuru and another in Lake Naivasha. You’ll then go on your way to the Masai Mara is probably the most prolific wildlife destination on the planet.',
                'duration_days' => 8,
                'duration_nights' => 7,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.'],
                    ['day_number' => 2, 'title' => 'Day 2 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 2.'],
                    ['day_number' => 3, 'title' => 'Day 3 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 3.'],
                    ['day_number' => 4, 'title' => 'Day 4 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 4.'],
                    ['day_number' => 5, 'title' => 'Day 5 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 5.'],
                    ['day_number' => 6, 'title' => 'Day 6 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 6.'],
                    ['day_number' => 7, 'title' => 'Day 7 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 7.'],
                    ['day_number' => 8, 'title' => 'Day 8 - 8 Days Best of Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 8.']
                ],
                'image_url' => 'images/safaris/8-days-best-of-kenya-safari.jpg',
            ],
            [
                'title' => '9-Day Kenya Beach Holiday and Luxury Wildlife Safari',
                'slug' => '9-day-kenya-beach-holiday-and-luxury-wildlife-safari',
                'country_code' => 'KE',
                'summary' => 'A Kenyan beach holiday and game-safari combo is one of the best ways to explore magical Kenya. The trip will take you to idyllic destinations and is perfect for married couples looking to add some spark to their union, o...',
                'description' => 'A Kenyan beach holiday and game-safari combo is one of the best ways to explore magical Kenya. The trip will take you to idyllic destinations and is perfect for married couples looking to add some spark to their union, or even for honeymooners! A game safari will leave you in awe of Africa’s rich heritage of flora and fauna and leave you feeling connected to nature. While on the Kenyan Coast, you will encounter breathtaking natural attractions, stunningly beautiful beaches, and luxury resorts.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 9-Day Kenya Beach Holiday and Luxury Wildlife Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/9-day-kenya-beach-holiday-and-luxury-wildlife-safari.jpg',
            ],
            [
                'title' => 'Kigali- Rwanda City Tour',
                'slug' => 'kigali-rwanda-city-tour',
                'country_code' => 'RW',
                'summary' => 'This city tour is for those people who wish to visit an interesting place in Africa but don’t have a whole lot of time. Here in Rwanda, this one day visit will take you to the City Markets (Kimironko) where the sites and...',
                'description' => 'This city tour is for those people who wish to visit an interesting place in Africa but don’t have a whole lot of time. Here in Rwanda, this one day visit will take you to the City Markets (Kimironko) where the sites and sounds are amazing and it is also very Cheap! This trip also includes a visit of the Genocide Memorial Centre at Gizozi, where contacts with local people provide the discovery of all types of artisanal products.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - Kigali- Rwanda City Tour', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/kigali-rwanda-city-tour.jpg',
            ],
            [
                'title' => '6-Day Mount Kenya Chogoria Route Climbing Package',
                'slug' => '6-day-mount-kenya-chogoria-route-climbing-package',
                'country_code' => 'KE',
                'summary' => 'The Chogoria Route is our recommended and arguably the most magnificent ascent route to the summit area. It is the driest route up the mountain. The walk beside the Gorges Valley is truly spectacular. The descent by the ...',
                'description' => 'The Chogoria Route is our recommended and arguably the most magnificent ascent route to the summit area. It is the driest route up the mountain. The walk beside the Gorges Valley is truly spectacular. The descent by the Sirimon Route will take you through some beautiful forest tracks and completes the traverse of the mountain. Accommodation on this trek is camping.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 6-Day Mount Kenya Chogoria Route Climbing Package', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/6-day-mount-kenya-chogoria-route-climbing-package.jpg',
            ],
            [
                'title' => '5-Day Masai Mara Fly-in Luxury Safari',
                'slug' => '5-day-masai-mara-fly-in-luxury-safari',
                'country_code' => 'KE',
                'summary' => 'This 5-day safari takes you to and Beyond Kichwa Tembo Camp which is sprawled along the Saparingo River on the edge of the Oloololo escarpment, where the riverine forest meets the sweeping plains in the seasonal path of ...',
                'description' => 'This 5-day safari takes you to and Beyond Kichwa Tembo Camp which is sprawled along the Saparingo River on the edge of the Oloololo escarpment, where the riverine forest meets the sweeping plains in the seasonal path of the awe-inspiring great migration. The camp provides an authentic dose of African wildlife, and creates memorable experiences.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 5-Day Masai Mara Fly-in Luxury Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/5-day-masai-mara-fly-in-luxury-safari.jpg',
            ],
            [
                'title' => '12-Day Kenya Classic Signature Wildlife Safari',
                'slug' => '12-day-kenya-classic-signature-wildlife-safari',
                'country_code' => 'KE',
                'summary' => 'Arrival You’ll be collected from the airport and Accommodation before the tour starts can be arranged for an extra cost.',
                'description' => 'Arrival You’ll be collected from the airport and Accommodation before the tour starts can be arranged for an extra cost.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 12-Day Kenya Classic Signature Wildlife Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/12-day-kenya-classic-signature-wildlife-safari.jpeg',
            ],
            [
                'title' => '4-Day Bwindi Gorilla Trekking Flying Safari',
                'slug' => '4-day-bwindi-gorilla-trekking-flying-safari',
                'country_code' => 'UG',
                'summary' => 'The top highlight on this 4-day Uganda Gorilla Safari is, of course, African Mountain Gorilla Trekking in Uganda’s Bwindi Impenetrable Forest. The Uganda gorilla trek takes us through the dense jungle to encounter the en...',
                'description' => 'The top highlight on this 4-day Uganda Gorilla Safari is, of course, African Mountain Gorilla Trekking in Uganda’s Bwindi Impenetrable Forest. The Uganda gorilla trek takes us through the dense jungle to encounter the endangered mountain gorillas in the wild. Bwindi Forest is also known for its high biodiversity and excellent bird watching.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Bwindi Gorilla Trekking Flying Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-bwindi-gorilla-trekking-flying-safari.jpg',
            ],
            [
                'title' => '5-Day Birding Safari to Uganda',
                'slug' => '5-day-birding-safari-to-uganda',
                'country_code' => 'UG',
                'summary' => 'Uganda is a birding haven for keen birders. Uganda boasts of more than ten thousand birds species including the endangered shoebill stork. This five-day safari will highlight the most crucial sites to spot most of the so...',
                'description' => 'Uganda is a birding haven for keen birders. Uganda boasts of more than ten thousand birds species including the endangered shoebill stork. This five-day safari will highlight the most crucial sites to spot most of the sought-after birds like the pitta, the African finfoot, to mention but a few.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 5-Day Birding Safari to Uganda', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/5-day-birding-safari-to-uganda.jpg',
            ],
            [
                'title' => '8 Days Western Uganda Cycling Safari',
                'slug' => '8-days-western-uganda-cycling-safari',
                'country_code' => 'UG',
                'summary' => 'Key Attractions some primates, lions, spotted hyenas, leopards, elephants, Topis, buffaloes, kobs, baboons, warthogs, forest hog, Leopard some reptiles, and a variety of birds plus different tree species',
                'description' => 'Key Attractions some primates, lions, spotted hyenas, leopards, elephants, Topis, buffaloes, kobs, baboons, warthogs, forest hog, Leopard some reptiles, and a variety of birds plus different tree species',
                'duration_days' => 8,
                'duration_nights' => 7,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.'],
                    ['day_number' => 2, 'title' => 'Day 2 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 2.'],
                    ['day_number' => 3, 'title' => 'Day 3 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 3.'],
                    ['day_number' => 4, 'title' => 'Day 4 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 4.'],
                    ['day_number' => 5, 'title' => 'Day 5 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 5.'],
                    ['day_number' => 6, 'title' => 'Day 6 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 6.'],
                    ['day_number' => 7, 'title' => 'Day 7 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 7.'],
                    ['day_number' => 8, 'title' => 'Day 8 - 8 Days Western Uganda Cycling Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 8.']
                ],
                'image_url' => 'images/safaris/8-days-western-uganda-cycling-safari.jpg',
            ],
            [
                'title' => 'Kampala Cultural Tour',
                'slug' => 'kampala-cultural-tour',
                'country_code' => 'UG',
                'summary' => 'This tour is unique because it will help you appreciate the diverse Ugandan culture. The Kasubi tombs tour and Lubiri tour will help you appreciate Buganda culture. The Ndere Culture Tour will help you enjoy traditional ...',
                'description' => 'This tour is unique because it will help you appreciate the diverse Ugandan culture. The Kasubi tombs tour and Lubiri tour will help you appreciate Buganda culture. The Ndere Culture Tour will help you enjoy traditional dances picked from the 52 tribes of Uganda.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - Kampala Cultural Tour', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/kampala-cultural-tour.jpg',
            ],
            [
                'title' => '1 Day White Water Rafting on the Nile',
                'slug' => '1-day-white-water-rafting-on-the-nile',
                'country_code' => 'UG',
                'summary' => '1 Day White Water Rafting on the Nile River in Jinja, Uganda in a one-day jinja tour for white water rafting at the source of the Nile River. White water rafting on a 1 day Jinja tour is a popular short Uganda safari act...',
                'description' => '1 Day White Water Rafting on the Nile River in Jinja, Uganda in a one-day jinja tour for white water rafting at the source of the Nile River. White water rafting on a 1 day Jinja tour is a popular short Uganda safari activity for adventure travelers.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 1 Day White Water Rafting on the Nile', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/1-day-white-water-rafting-on-the-nile.jpg',
            ],
            [
                'title' => 'Kampala City Tour',
                'slug' => 'kampala-city-tour',
                'country_code' => 'UG',
                'summary' => 'Kampala is one of the most exciting cities in Africa, with so many sights and sounds that you could easily miss in a car ride, but on a walking tour you take in everything one at a time. unlike it is a city just it is al...',
                'description' => 'Kampala is one of the most exciting cities in Africa, with so many sights and sounds that you could easily miss in a car ride, but on a walking tour you take in everything one at a time. unlike it is a city just it is also a district of its own, located in central Uganda in the Buganda Kingdom. Its total population as of 2011 was 1,659,600 people.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - Kampala City Tour', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/kampala-city-tour.jpg',
            ],
            [
                'title' => '8 Days Mountain Rwenzori Hiking Safari',
                'slug' => '8-days-mountain-rwenzori-hiking-safari',
                'country_code' => 'UG',
                'summary' => 'The 8 Days Mount Rwenzori Hiking Safari offers you a remarkable hiking adventure in Uganda to the top of the highest point in Uganda which is Margherita Peak on Mountain Rwenzori a block mountain found in East Africa. Th...',
                'description' => 'The 8 Days Mount Rwenzori Hiking Safari offers you a remarkable hiking adventure in Uganda to the top of the highest point in Uganda which is Margherita Peak on Mountain Rwenzori a block mountain found in East Africa. The Mountain lies on the border of Uganda and the Democratic Republic of Congo serving as a transboundary resource between the two countries. Climb to the famous snow-capped summits.',
                'duration_days' => 8,
                'duration_nights' => 7,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.'],
                    ['day_number' => 2, 'title' => 'Day 2 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 2.'],
                    ['day_number' => 3, 'title' => 'Day 3 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 3.'],
                    ['day_number' => 4, 'title' => 'Day 4 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 4.'],
                    ['day_number' => 5, 'title' => 'Day 5 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 5.'],
                    ['day_number' => 6, 'title' => 'Day 6 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 6.'],
                    ['day_number' => 7, 'title' => 'Day 7 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 7.'],
                    ['day_number' => 8, 'title' => 'Day 8 - 8 Days Mountain Rwenzori Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 8.']
                ],
                'image_url' => 'images/safaris/8-days-mountain-rwenzori-hiking-safari.jpg',
            ],
            [
                'title' => '5 Day Mount Elgon Hiking Safari',
                'slug' => '5-day-mount-elgon-hiking-safari',
                'country_code' => 'KE',
                'summary' => 'Mount Elgon is the 7th highest mountain in Africa at 4,321m and the summit is readily accessible for climbers with limited experience. Found in the Eastern part of Uganda with the Kenya border, Mt Elgon is an extinct Vol...',
                'description' => 'Mount Elgon is the 7th highest mountain in Africa at 4,321m and the summit is readily accessible for climbers with limited experience. Found in the Eastern part of Uganda with the Kenya border, Mt Elgon is an extinct Volcano with the largest surface area in the world, 50km x 80km with the Wagagai Peak at 4321m ASL. The park contains varied peculiar attractions of montane forests, bamboo, giant Lobelia, brilliant species of flowers, birds, bushbuck, antelope, wild cat, rock hyrax, hyena, caves, craters, gorges, the magnificent Sipi falls and many more.',
                'duration_days' => 5,
                'duration_nights' => 4,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 5 Day Mount Elgon Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.'],
                    ['day_number' => 2, 'title' => 'Day 2 - 5 Day Mount Elgon Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 2.'],
                    ['day_number' => 3, 'title' => 'Day 3 - 5 Day Mount Elgon Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 3.'],
                    ['day_number' => 4, 'title' => 'Day 4 - 5 Day Mount Elgon Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 4.'],
                    ['day_number' => 5, 'title' => 'Day 5 - 5 Day Mount Elgon Hiking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 5.']
                ],
                'image_url' => 'images/safaris/5-day-mount-elgon-hiking-safari.jpg',
            ],
            [
                'title' => '3-Day Safari – Tarangire, Ngorongoro & Lake Manyara',
                'slug' => '3-day-safari-tarangire-ngorongoro-lake-manyara',
                'country_code' => 'TZ',
                'summary' => 'This safari will visit Lake Manyara National Park where you can see the tree-climbing lions and Tarangire National Park where you can see the biggest land animals walking in big numbers. You’ll also get a scenic and mesm...',
                'description' => 'This safari will visit Lake Manyara National Park where you can see the tree-climbing lions and Tarangire National Park where you can see the biggest land animals walking in big numbers. You’ll also get a scenic and mesmerizing visit to the Ngorongoro Crater, a place like no other in the entire world. You will enjoy wildlife and phenomenal landscapes.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Safari – Tarangire, Ngorongoro & Lake Manyara', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-safari-tarangire-ngorongoro-lake-manyara.jpg',
            ],
            [
                'title' => '4-Day Luxury Tanzania Safari',
                'slug' => '4-day-luxury-tanzania-safari',
                'country_code' => 'TZ',
                'summary' => 'This Exotic Tanzania Wildlife Safari in a luxury tented Camps and Lodges explores East African wildlife highlights on game drives Tarangire National Park home of elephant the famous endless plain of Serengeti National Pa...',
                'description' => 'This Exotic Tanzania Wildlife Safari in a luxury tented Camps and Lodges explores East African wildlife highlights on game drives Tarangire National Park home of elephant the famous endless plain of Serengeti National Park a home of wildebeest migration & Ngorongoro Crater one of the 7 wonders of the world.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Luxury Tanzania Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-luxury-tanzania-safari.jpg',
            ],
            [
                'title' => '4-Day Tanzania Safari Tarangire, Serengeti & Manyara',
                'slug' => '4-day-tanzania-safari-tarangire-serengeti-manyara',
                'country_code' => 'TZ',
                'summary' => 'On this 4-day lodge safari you will visit the Lake Manyara National Park, Tarangire National Park, the Ngorongoro Crater and Serengeti National Park. The seasonal sight of thousands of wildebeests and zebras crossing the...',
                'description' => 'On this 4-day lodge safari you will visit the Lake Manyara National Park, Tarangire National Park, the Ngorongoro Crater and Serengeti National Park. The seasonal sight of thousands of wildebeests and zebras crossing the grassland savannah is something to behold and is surely one of Africa’s natural wonders. Furthermore you will be awarded with beautiful landscapes, an animal-filled crater and thousands of flamingos.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Tanzania Safari Tarangire, Serengeti & Manyara', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-tanzania-safari-tarangire-serengeti-manyara.jpg',
            ],
            [
                'title' => '7-Day Luxury Tanzania Safari',
                'slug' => '7-day-luxury-tanzania-safari',
                'country_code' => 'TZ',
                'summary' => 'Tanzania is a country bursting with natural beauty, wildlife, memorable experiences and some the friendliest people you will ever meet. On this premium luxury all-inclusive Safari, you will explore the best of the Northe...',
                'description' => 'Tanzania is a country bursting with natural beauty, wildlife, memorable experiences and some the friendliest people you will ever meet. On this premium luxury all-inclusive Safari, you will explore the best of the Northern Safari Circuit in style! You will be amazed by the quality of the lodges and tented camps including food and service. Tanzania offers diverse landscapes and countless opportunities to view and learn about its rich wildlife.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 7-Day Luxury Tanzania Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/7-day-luxury-tanzania-safari.jpg',
            ],
            [
                'title' => '6-Day Kenya Safari Holiday',
                'slug' => '6-day-kenya-safari-holiday',
                'country_code' => 'KE',
                'summary' => 'Masai Mara is a large game reserve measuring 1,510 square kilometers in southwestern Kenya, it is famous for its exceptional population of lions, leopards, cheetahs, and its annual migration of zebra and wildebeest which...',
                'description' => 'Masai Mara is a large game reserve measuring 1,510 square kilometers in southwestern Kenya, it is famous for its exceptional population of lions, leopards, cheetahs, and its annual migration of zebra and wildebeest which occurs from July to October. This is known as the great migration. You will also visit Lake Nakuru and Amboseli national park found along the Rift Valley.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 6-Day Kenya Safari Holiday', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/6-day-kenya-safari-holiday.jpg',
            ],
            [
                'title' => '5-Day Masai Mara, Nakuru, Naivasha',
                'slug' => '5-day-masai-mara-nakuru-naivasha',
                'country_code' => 'KE',
                'summary' => 'This adventure safari takes you through Kenya’s best game reserve, the Masai Mara National Reserve, for 2 nights. Then we head down the great rift valley to Lake Nakuru National Park, home to the rare white rhino species...',
                'description' => 'This adventure safari takes you through Kenya’s best game reserve, the Masai Mara National Reserve, for 2 nights. Then we head down the great rift valley to Lake Nakuru National Park, home to the rare white rhino species as well as a bird’s paradise. We will also visit Lake Naivasha and Hell’s Gate National Park.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 5-Day Masai Mara, Nakuru, Naivasha', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/5-day-masai-mara-nakuru-naivasha.jpg',
            ],
            [
                'title' => '4-Day Tsavo and Amboseli Kenya Safari',
                'slug' => '4-day-tsavo-and-amboseli-kenya-safari',
                'country_code' => 'KE',
                'summary' => 'This Kenya safari with a 4×4 Land Cruiser and a driver-guide who is experienced in spotting wildlife, will visit Amboseli with the majestic Mt. Kilimanjaro on the horizon. Experience the rolling plains, the picturesque T...',
                'description' => 'This Kenya safari with a 4×4 Land Cruiser and a driver-guide who is experienced in spotting wildlife, will visit Amboseli with the majestic Mt. Kilimanjaro on the horizon. Experience the rolling plains, the picturesque Taita Hills and the lava flows, all on a plateau dotted with acacia, scrub and bushland of Tsavo West and the large herds of “red” elephants in Tsavo East.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Tsavo and Amboseli Kenya Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-tsavo-and-amboseli-kenya-safari.jpg',
            ],
            [
                'title' => '3-Day Best of Masai Mara',
                'slug' => '3-day-best-of-masai-mara',
                'country_code' => 'KE',
                'summary' => 'This 3-day Masai Mara National Reserve getaway maximizes the limited available time by offering 3 game drives in this famous park known for the famous annual wildebeest migration.',
                'description' => 'This 3-day Masai Mara National Reserve getaway maximizes the limited available time by offering 3 game drives in this famous park known for the famous annual wildebeest migration.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Best of Masai Mara', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-best-of-masai-mara.jpg',
            ],
            [
                'title' => '3-Day Rwanda’s Remarkable Akagera Safari',
                'slug' => '3-day-rwandas-remarkable-akagera-safari',
                'country_code' => 'RW',
                'summary' => 'These 3 days Akagera national park wildlife safari will offer you the ultimate game drives experience in Akagera national park. The park is the only Savannah park in Rwanda hosting a number of big mammals with the most s...',
                'description' => 'These 3 days Akagera national park wildlife safari will offer you the ultimate game drives experience in Akagera national park. The park is the only Savannah park in Rwanda hosting a number of big mammals with the most sought after being Lions, Buffaloes, Giraffes, Zebras, and Hippos',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Rwanda’s Remarkable Akagera Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-rwandas-remarkable-akagera-safari.jpg',
            ],
            [
                'title' => '8-Day Rwanda Primate Tracking Safari',
                'slug' => '8-day-rwanda-primate-tracking-safari',
                'country_code' => 'RW',
                'summary' => 'Enjoy tracking mountain gorillas and chimpanzees on this 8 Days Rwanda Primate Tracking Safari. Gorilla Tracking in Volcanoes Np is the most done tourist activity in Rwanda thus why tourists from around the world visit R...',
                'description' => 'Enjoy tracking mountain gorillas and chimpanzees on this 8 Days Rwanda Primate Tracking Safari. Gorilla Tracking in Volcanoes Np is the most done tourist activity in Rwanda thus why tourists from around the world visit Rwanda every year to take part in Gorilla trekking.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 8-Day Rwanda Primate Tracking Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/8-day-rwanda-primate-tracking-safari.jpg',
            ],
            [
                'title' => '3-Day Gorillas and Golden Monkey Safari',
                'slug' => '3-day-gorillas-and-golden-monkey-safari',
                'country_code' => 'RW',
                'summary' => 'Welcome to Rwanda ”a country of a thousand hills” this tour has been created to visitors looking into visiting gorillas in Uganda and golden monkeys of volcanoes national park of Rwanda and friendly quote. It starts and ...',
                'description' => 'Welcome to Rwanda ”a country of a thousand hills” this tour has been created to visitors looking into visiting gorillas in Uganda and golden monkeys of volcanoes national park of Rwanda and friendly quote. It starts and end in kigali international airport of Rwanda. Your safari guide will ready to take you places as per program.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Gorillas and Golden Monkey Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-gorillas-and-golden-monkey-safari.jpg',
            ],
            [
                'title' => '3-Day Rwanda Gorilla Safari',
                'slug' => '3-day-rwanda-gorilla-safari',
                'country_code' => 'RW',
                'summary' => 'Mountain gorillas survive of vegetation as their daily food, which comprises of leaves, buds, shoots, fruits, bedstraw, celery, stinging nettles and flowers among others. The young gorilla babies survive of their mother’...',
                'description' => 'Mountain gorillas survive of vegetation as their daily food, which comprises of leaves, buds, shoots, fruits, bedstraw, celery, stinging nettles and flowers among others. The young gorilla babies survive of their mother’s breastfeeding milk rill the age of three after which they start feeding on vegetation just like the grown family members. Unlike other animal species, mountain gorillas do not drink water but only survive on the waters within the vegetation they eat.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Rwanda Gorilla Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-rwanda-gorilla-safari.jpg',
            ],
            [
                'title' => '5-Day Uganda Safari Holiday',
                'slug' => '5-day-uganda-safari-holiday',
                'country_code' => 'UG',
                'summary' => 'This tour will take you through Bwindi, an ancient forest that dates back to over 25,000 years and Queen Elizabeth , Lake Mburo, Kibale National Parks with a variety of different species of mammals and birds. This safari...',
                'description' => 'This tour will take you through Bwindi, an ancient forest that dates back to over 25,000 years and Queen Elizabeth , Lake Mburo, Kibale National Parks with a variety of different species of mammals and birds. This safari will take you home into a family of these gentle mountain gorillas.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 5-Day Uganda Safari Holiday', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/5-day-uganda-safari-holiday.jpg',
            ],
            [
                'title' => '3-Day Queen Elizabeth Safari Holiday',
                'slug' => '3-day-queen-elizabeth-safari-holiday',
                'country_code' => 'UG',
                'summary' => 'This tour will take you through Queen Elizabeth National Park, with a variety of different species of mammals and birds and the famous Kazinga channel for boat cruising.',
                'description' => 'This tour will take you through Queen Elizabeth National Park, with a variety of different species of mammals and birds and the famous Kazinga channel for boat cruising.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Queen Elizabeth Safari Holiday', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-queen-elizabeth-safari-holiday.jpg',
            ],
            [
                'title' => '4-Day Queen Elizabeth & Lake Mburo National Parks Safari',
                'slug' => '4-day-queen-elizabeth-lake-mburo-national-parks-safari',
                'country_code' => 'UG',
                'summary' => 'The safari takes you to both Queen Elizabeth and Lake Mburo National Parks. You will have the opportunity to view a wide variety of wildlife on this tour, including a large number of birds. Both parks also offer boat cru...',
                'description' => 'The safari takes you to both Queen Elizabeth and Lake Mburo National Parks. You will have the opportunity to view a wide variety of wildlife on this tour, including a large number of birds. Both parks also offer boat cruises that will introduce you to many different water species.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Queen Elizabeth & Lake Mburo National Parks Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-queen-elizabeth-lake-mburo-national-parks-safari.jpg',
            ],
            [
                'title' => '7-Day Kibale National Park and Gorillas Safari',
                'slug' => '7-day-kibale-national-park-and-gorillas-safari',
                'country_code' => 'UG',
                'summary' => 'This epic gorilla and chimpanzee journey will take you to bwindi impenetrable National park where you will track the gorillas, Queen Elizabeth National park in Uganda for wildlife game drive and then to Kibale Forest nat...',
                'description' => 'This epic gorilla and chimpanzee journey will take you to bwindi impenetrable National park where you will track the gorillas, Queen Elizabeth National park in Uganda for wildlife game drive and then to Kibale Forest national park for chimpanzee tracking. These are some of the best and popular attractions which one should not miss while on any Uganda safari.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 7-Day Kibale National Park and Gorillas Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/7-day-kibale-national-park-and-gorillas-safari.jpg',
            ],
            [
                'title' => '6-Day Kidepo and Murchison Falls Wilderness Tour',
                'slug' => '6-day-kidepo-and-murchison-falls-wilderness-tour',
                'country_code' => 'UG',
                'summary' => 'This 6-day Kidepo and Murchison safari takes you through rugged and semi-arid terrain with a rewarding experience of beautiful landscapes, and wildlife. You will enjoy wildlife game drives, community visits, a walk to Si...',
                'description' => 'This 6-day Kidepo and Murchison safari takes you through rugged and semi-arid terrain with a rewarding experience of beautiful landscapes, and wildlife. You will enjoy wildlife game drives, community visits, a walk to Sipi Falls and a coffee experience in eastern Uganda.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 6-Day Kidepo and Murchison Falls Wilderness Tour', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/6-day-kidepo-and-murchison-falls-wilderness-tour.jpg',
            ],
            [
                'title' => '4-Day Bwindi, Lake Bunyonyi and Queen Elizabeth Safari',
                'slug' => '4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safari',
                'country_code' => 'UG',
                'summary' => 'This 4-day gorilla trek safari takes you to the misty Bwindi Impenetrable Forest, Enjoy some relaxation at Lake Bunyonyi and to Queen Elizabeth National Park for a great game viewing experience.',
                'description' => 'This 4-day gorilla trek safari takes you to the misty Bwindi Impenetrable Forest, Enjoy some relaxation at Lake Bunyonyi and to Queen Elizabeth National Park for a great game viewing experience.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Bwindi, Lake Bunyonyi and Queen Elizabeth Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safari.jpg',
            ],
            [
                'title' => '3-Day Murchison Falls & Ziwa Rhino Sanctuary',
                'slug' => '3-day-murchison-falls-ziwa-rhino-sanctuary',
                'country_code' => 'UG',
                'summary' => 'This 3 day Safari to Murchison Falls National Park, gives you a great time in the wild with great sights of the magnificent Murchison falls that falls from a 45m wall through an 8m wide gorge hence giving it a very sceni...',
                'description' => 'This 3 day Safari to Murchison Falls National Park, gives you a great time in the wild with great sights of the magnificent Murchison falls that falls from a 45m wall through an 8m wide gorge hence giving it a very scenic look',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 3-Day Murchison Falls & Ziwa Rhino Sanctuary', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/3-day-murchison-falls-ziwa-rhino-sanctuary.jpg',
            ],
            [
                'title' => '7-Day Rwanda Akagera Safari and Golden Monkey Tour',
                'slug' => '7-day-rwanda-akagera-safari-and-golden-monkey-tour',
                'country_code' => 'RW',
                'summary' => 'This trip takes you around to experience the authentic Rwanda and her beauty from the Wildlife safaris of Akagera National Park, the boat cruise, the city tours in Kigali with the genocide memorial center, visit local ma...',
                'description' => 'This trip takes you around to experience the authentic Rwanda and her beauty from the Wildlife safaris of Akagera National Park, the boat cruise, the city tours in Kigali with the genocide memorial center, visit local markets, golden monkeys, cultural tours, Bisoke Hike in Volcanoes National Park and Lake Kivu full relaxation.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 7-Day Rwanda Akagera Safari and Golden Monkey Tour', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/7-day-rwanda-akagera-safari-and-golden-monkey-tour.jpg',
            ],
            [
                'title' => '4-Day Bwindi, Lake Bunyonyi and Queen Elizabeth Safari',
                'slug' => '5-day-highlighted-gorillas-a4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safarnd-wildlife-safari',
                'country_code' => 'UG',
                'summary' => 'This 4 day gorilla trek safari takes you to the misty Bwindi Impenetrable Forest, Home to more than half the population of the remaining 720 Mountain Gorillas.',
                'description' => 'This 4 day gorilla trek safari takes you to the misty Bwindi Impenetrable Forest, Home to more than half the population of the remaining 720 Mountain Gorillas.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Bwindi, Lake Bunyonyi and Queen Elizabeth Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/5-day-highlighted-gorillas-a4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safarnd-wildlife-safari.jpg',
            ],
            [
                'title' => '4-Day Kidepo Wildlife Safari',
                'slug' => '4-day-kidepo-wildlife-safari',
                'country_code' => 'UG',
                'summary' => 'This four day trip takes to Kidepo one of Uganda’s most spectacular parks and it is located in Uganda’s remote north –eastern corner.',
                'description' => 'This four day trip takes to Kidepo one of Uganda’s most spectacular parks and it is located in Uganda’s remote north –eastern corner.',
                'duration_days' => 1,
                'duration_nights' => 0,
                'base_price' => 0.0,
                'currency' => 'USD',
                'min_people' => 1,
                'max_people' => 12,
                'featured' => true,
                'popular' => true,
                'status' => 'published',
                'itinerary' => [
                    ['day_number' => 1, 'title' => 'Day 1 - 4-Day Kidepo Wildlife Safari', 'description' => 'Enjoy full-day game drive and sightseeing experience on Day 1.']
                ],
                'image_url' => 'images/safaris/4-day-kidepo-wildlife-safari.jpg',
            ]
        ];

        // Real per-tour corrections sourced from henjosafaris-content-audit.md
        // (Sections 5.2/5.3/5.4) — duration/price/category data the WordPress
        // site actually had, replacing this seeder's earlier 1-day/$0/
        // wildlife-adventure-only placeholder defaults. Three slugs below
        // aren't documented in the audit (no matching product was found on
        // the live site) — those keep base_price at 0 rather than inventing
        // a number, but still get a corrected duration and a sensible
        // category based on their own title.
        $corrections = [
            '12-day-kenya-classic-signature-wildlife-safari-2' => ['duration_days' => 12, 'duration_nights' => 11, 'base_price' => 0.0, 'categories' => ['wildlife-adventure'], 'flights' => true],
            '5-day-masai-mara-flying-luxury-safari' => ['duration_days' => 5, 'duration_nights' => 4, 'base_price' => 0.0, 'categories' => ['flying', 'wildlife-adventure'], 'flights' => true],
            '8-days-best-of-kenya-safari' => ['duration_days' => 8, 'duration_nights' => 7, 'base_price' => 0.0, 'categories' => ['wildlife-adventure'], 'flights' => true],
            '9-day-kenya-beach-holiday-and-luxury-wildlife-safari' => ['duration_days' => 9, 'duration_nights' => 8, 'base_price' => 0.0, 'categories' => ['wildlife-adventure'], 'flights' => true],
            'kigali-rwanda-city-tour' => ['duration_days' => 1, 'duration_nights' => 0, 'base_price' => 0.0, 'categories' => ['city-tours', 'day-tours']],
            '6-day-mount-kenya-chogoria-route-climbing-package' => ['duration_days' => 6, 'duration_nights' => 5, 'base_price' => 0.0, 'categories' => ['mountaineering']],
            '5-day-masai-mara-fly-in-luxury-safari' => ['duration_days' => 5, 'duration_nights' => 4, 'base_price' => 3000.0, 'categories' => ['flying', 'wildlife-adventure'], 'flights' => true],
            '12-day-kenya-classic-signature-wildlife-safari' => ['duration_days' => 12, 'duration_nights' => 11, 'base_price' => 4000.0, 'categories' => ['wildlife-adventure'], 'flights' => true],
            '4-day-bwindi-gorilla-trekking-flying-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 3480.0, 'categories' => ['flying', 'gorilla-safaris', 'wildlife-adventure']],
            '5-day-birding-safari-to-uganda' => ['duration_days' => 5, 'duration_nights' => 4, 'base_price' => 1308.0, 'categories' => ['birding', 'wildlife-adventure']],
            '8-days-western-uganda-cycling-safari' => ['duration_days' => 8, 'duration_nights' => 7, 'base_price' => 1516.0, 'categories' => ['cycling', 'wildlife-adventure']],
            'kampala-cultural-tour' => ['duration_days' => 1, 'duration_nights' => 0, 'base_price' => 180.0, 'categories' => ['city-tours', 'cultural-tour']],
            '1-day-white-water-rafting-on-the-nile' => ['duration_days' => 1, 'duration_nights' => 0, 'base_price' => 180.0, 'categories' => ['city-tours', 'day-tours', 'wildlife-adventure']],
            'kampala-city-tour' => ['duration_days' => 1, 'duration_nights' => 0, 'base_price' => 80.0, 'categories' => ['city-tours']],
            '8-days-mountain-rwenzori-hiking-safari' => ['duration_days' => 8, 'duration_nights' => 7, 'base_price' => 2650.0, 'categories' => ['mountaineering']],
            '5-day-mount-elgon-hiking-safari' => ['duration_days' => 5, 'duration_nights' => 4, 'base_price' => 1316.0, 'categories' => ['mountaineering']],
            '3-day-safari-tarangire-ngorongoro-lake-manyara' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 906.0, 'categories' => ['wildlife-adventure']],
            '4-day-luxury-tanzania-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 2050.0, 'categories' => ['wildlife-adventure']],
            '4-day-tanzania-safari-tarangire-serengeti-manyara' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 2016.0, 'categories' => ['wildlife-adventure']],
            '7-day-luxury-tanzania-safari' => ['duration_days' => 7, 'duration_nights' => 6, 'base_price' => 3256.0, 'categories' => ['wildlife-adventure']],
            '6-day-kenya-safari-holiday' => ['duration_days' => 6, 'duration_nights' => 5, 'base_price' => 1516.0, 'categories' => ['wildlife-adventure']],
            '5-day-masai-mara-nakuru-naivasha' => ['duration_days' => 5, 'duration_nights' => 4, 'base_price' => 1316.0, 'categories' => ['wildlife-adventure']],
            '4-day-tsavo-and-amboseli-kenya-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 1016.0, 'categories' => ['wildlife-adventure']],
            '3-day-best-of-masai-mara' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 978.0, 'categories' => ['wildlife-adventure']],
            '3-day-rwandas-remarkable-akagera-safari' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 0.0, 'categories' => ['wildlife-adventure']],
            '8-day-rwanda-primate-tracking-safari' => ['duration_days' => 8, 'duration_nights' => 7, 'base_price' => 0.0, 'categories' => ['gorilla-safaris', 'wildlife-adventure']],
            '3-day-gorillas-and-golden-monkey-safari' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 2816.0, 'categories' => ['gorilla-safaris']],
            '3-day-rwanda-gorilla-safari' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 2506.0, 'categories' => ['gorilla-safaris']],
            '5-day-uganda-safari-holiday' => ['duration_days' => 5, 'duration_nights' => 4, 'base_price' => 1960.0, 'categories' => ['gorilla-safaris', 'wildlife-adventure']],
            '3-day-queen-elizabeth-safari-holiday' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 956.0, 'categories' => ['wildlife-adventure']],
            '4-day-queen-elizabeth-lake-mburo-national-parks-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 1050.0, 'categories' => ['wildlife-adventure']],
            '7-day-kibale-national-park-and-gorillas-safari' => ['duration_days' => 7, 'duration_nights' => 6, 'base_price' => 2215.0, 'categories' => ['gorilla-safaris', 'wildlife-adventure']],
            '6-day-kidepo-and-murchison-falls-wilderness-tour' => ['duration_days' => 6, 'duration_nights' => 5, 'base_price' => 1823.0, 'categories' => ['day-tours', 'wildlife-adventure']],
            '4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 1560.0, 'categories' => ['gorilla-safaris', 'wildlife-adventure']],
            '3-day-murchison-falls-ziwa-rhino-sanctuary' => ['duration_days' => 3, 'duration_nights' => 2, 'base_price' => 0.0, 'categories' => ['wildlife-adventure', 'day-tours']],
            '7-day-rwanda-akagera-safari-and-golden-monkey-tour' => ['duration_days' => 7, 'duration_nights' => 6, 'base_price' => 3016.0, 'categories' => ['gorilla-safaris', 'wildlife-adventure']],
            '5-day-highlighted-gorillas-a4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safarnd-wildlife-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 1560.0, 'categories' => ['gorilla-safaris', 'wildlife-adventure']],
            '4-day-kidepo-wildlife-safari' => ['duration_days' => 4, 'duration_nights' => 3, 'base_price' => 750.0, 'categories' => ['day-tours', 'wildlife-adventure']],
        ];

        // Real condensed day-by-day itineraries from the audit (§5.1/§5.3),
        // replacing the generic "Enjoy full-day game drive..." placeholder.
        // Packages sharing one real audit listing (documented near-duplicates)
        // reuse that listing's itinerary.
        $sharedItineraries = [
            'bwindi_gorilla_flying' => [
                ['day_number' => 1, 'title' => 'Arrival at Entebbe Airport and transfer to Hotel', 'description' => "Welcome by our representative at Entebbe International Airport and transfer to your hotel in Entebbe. Overnight at Hotel No.5."],
                ['day_number' => 2, 'title' => 'Entebbe – Fly to Bwindi – Buhoma Lodge', 'description' => 'Transfer to Entebbe Airport for a scheduled flight (approx. 2 hours) to Bwindi (Kihihi or Kisoro airstrip), then transfer to your lodge. Afternoon Batwa trail cultural experience. Overnight at Buhoma Lodge.'],
                ['day_number' => 3, 'title' => 'Bwindi Gorilla Trekking', 'description' => "Briefing at 8am with Uganda Wildlife Authority staff, followed by gorilla trekking (2–6 hours depending on the family's location). Afternoon Buhoma Village Walk. Overnight at Buhoma Lodge."],
                ['day_number' => 4, 'title' => 'Bwindi to the Airstrip, Fly back to Entebbe', 'description' => 'Morning or afternoon flight back to Entebbe (options depart 09:45 or 14:45). End of services.'],
            ],
            'birding_uganda' => [
                ['day_number' => 1, 'title' => 'Arrival & Mabamba Wetlands', 'description' => 'Arrival, shoebill canoe trip at Mabamba wetlands, transfer to Masindi.'],
                ['day_number' => 2, 'title' => 'Birding the Royal Mile', 'description' => 'Full day birding the Royal Mile, transfer to Budongo Eco-Lodge.'],
                ['day_number' => 3, 'title' => 'Kaniyo Pabidi & Murchison Falls', 'description' => 'Birding at Kaniyo Pabidi, transfer to Murchison Falls National Park.'],
                ['day_number' => 4, 'title' => 'Game Drive & Boat Trip', 'description' => 'Morning game drive and afternoon boat trip to the base of Murchison Falls.'],
                ['day_number' => 5, 'title' => 'Top-of-Falls Birding & Departure', 'description' => 'Top-of-the-falls birding walk, transfer to the airport for departure.'],
            ],
            'western_uganda_cycling' => [
                ['day_number' => 1, 'title' => 'Arrival', 'description' => 'Arrival, transfer to Entebbe/Kampala.'],
                ['day_number' => 2, 'title' => 'Kibale to Queen Elizabeth', 'description' => 'Drive to Kibale, cycle to Queen Elizabeth National Park. Overnight Mweya Safari Lodge.'],
                ['day_number' => 3, 'title' => 'Ishasha Sector', 'description' => 'Cycle the Ishasha sector. Overnight Savannah Resort Hotel.'],
                ['day_number' => 4, 'title' => 'Ruhija / Bwindi', 'description' => 'Cycle to the Ruhija sector, Bwindi. Overnight Ruhija Gorilla Lodge.'],
                ['day_number' => 5, 'title' => 'Gorilla Tracking', 'description' => 'Gorilla tracking in Bwindi Impenetrable Forest.'],
                ['day_number' => 6, 'title' => 'Lake Bunyonyi', 'description' => 'Cycle to Lake Bunyonyi. Overnight Bunyonyi Overland Resort.'],
                ['day_number' => 7, 'title' => 'Return to Kampala', 'description' => 'Drive back to Kampala/Entebbe.'],
                ['day_number' => 8, 'title' => 'Departure', 'description' => 'Shopping and flight home.'],
            ],
            'kampala_cultural' => [
                ['day_number' => 1, 'title' => 'Kampala Cultural Day Tour', 'description' => "Visit Maridadi Crafts (1hr), Kasubi Tombs (3hrs — Buganda royal burial site), Kabaka's Palace and the Mengo torture chambers (1hr), and the Ndere Cultural Centre traditional dance show (3hrs, Wed/Fri/Sun 7pm)."],
            ],
            'jinja_rafting' => [
                ['day_number' => 1, 'title' => 'Jinja White Water Rafting', 'description' => 'Depart Kampala at 6am for Jinja. Choose a Grade 5 rapids raft or a family float option (minimum age 6). 3–4 hours on the water, plus a Jinja town city tour.'],
            ],
            'kampala_city' => [
                ['day_number' => 1, 'title' => 'Kampala Walking City Tour', 'description' => "Walking tour covering the old taxi park, Owino market, Kabaka's Palace, the Idi Amin torture chambers, Kasubi Tombs, Kabaka's Lake, the Hindu and Bahai temples, the Gaddafi Mosque, the Uganda Martyrs Shrine, the Independence Monument, and Rolex street food."],
            ],
            'rwenzori_hiking' => [
                ['day_number' => 1, 'title' => 'Journey to Rwenzori', 'description' => 'Transfer to the Rwenzori foothills. Overnight Equator Snow Lodge.'],
                ['day_number' => 2, 'title' => 'Nyakalengija to Nyabitaba', 'description' => 'Trek from Nyakalengija (1,600m) to Nyabitaba Hut (2,650m).'],
                ['day_number' => 3, 'title' => 'Nyabitaba to John Matte', 'description' => 'Trek to John Matte Hut (3,350m).'],
                ['day_number' => 4, 'title' => 'John Matte to Bujuku', 'description' => 'Trek to Bujuku Hut (3,900m).'],
                ['day_number' => 5, 'title' => 'Bujuku to Elena Hut', 'description' => 'Trek to Elena Hut (4,541m).'],
                ['day_number' => 6, 'title' => 'Summit Attempt', 'description' => 'Summit attempt on Margherita Peak (5,109m), or descend to Kitandara Hut (4,023m).'],
                ['day_number' => 7, 'title' => 'Descend to Guy Yeoman Hut', 'description' => 'Descend to Guy Yeoman Hut (3,260m).'],
                ['day_number' => 8, 'title' => 'Descend & Departure', 'description' => 'Descend to Nyakalengija (1,600m), departure.'],
            ],
            'mount_elgon' => [
                ['day_number' => 1, 'title' => 'Kampala to Sasa Camp', 'description' => 'Drive from Kampala to Budadiri, trek to Sasa Camp (2,900m) via the "Wall of Death" staircase section.'],
                ['day_number' => 2, 'title' => 'Sasa Camp to Mude Camp', 'description' => 'Trek to Mude Camp (3,500m).'],
                ['day_number' => 3, 'title' => 'Summit Wagagai Peak', 'description' => 'Summit Wagagai Peak (4,321m), return to Mude Camp.'],
                ['day_number' => 4, 'title' => 'Mude Camp to Budadiri', 'description' => 'Descend from Mude Camp back to Budadiri.'],
                ['day_number' => 5, 'title' => 'Transfer to Kampala', 'description' => 'Transfer via Jinja and the Source of the Nile back to Kampala/Entebbe.'],
            ],
            'tz_tarangire_ngorongoro_manyara_3day' => [
                ['day_number' => 1, 'title' => 'Arusha to Tarangire', 'description' => 'Drive from Arusha to Tarangire National Park, lunch at Matete picnic site.'],
                ['day_number' => 2, 'title' => 'Ngorongoro Crater', 'description' => 'Drive to Ngorongoro Crater with a viewpoint stop, lunch at the hippo pool picnic site.'],
                ['day_number' => 3, 'title' => 'Lake Manyara & Return', 'description' => 'Visit Lake Manyara National Park (Endalla picnic site, tree-climbing lions), return to Arusha. Overnight Fig Tree Lodge & Camp.'],
            ],
            'tz_luxury_4day' => [
                ['day_number' => 1, 'title' => 'Tarangire National Park', 'description' => 'Full-day game drive in Tarangire National Park. Overnight Acacia Tarangire Luxury Camp.'],
                ['day_number' => 2, 'title' => 'Ngorongoro Crater', 'description' => 'Drive to Ngorongoro Crater, visit Lake Magadi. Overnight Ngorongoro Lion\'s Paw Camp.'],
                ['day_number' => 3, 'title' => 'Serengeti National Park', 'description' => 'Drive to Serengeti National Park for game viewing.'],
                ['day_number' => 4, 'title' => 'Return to Arusha', 'description' => 'Morning game drive, return to Arusha.'],
            ],
            'tz_tarangire_serengeti_manyara_4day' => [
                ['day_number' => 1, 'title' => 'Tarangire National Park', 'description' => 'Game drive in Tarangire, known for its elephant migration. Overnight Embalakai Camp.'],
                ['day_number' => 2, 'title' => 'Ngorongoro to Serengeti', 'description' => 'Half-day Ngorongoro Crater tour, then transfer to Serengeti National Park.'],
                ['day_number' => 3, 'title' => 'Serengeti to Karatu', 'description' => "Serengeti game drive, transfer to Karatu. Overnight Eileen's Trees Inn."],
                ['day_number' => 4, 'title' => 'Lake Manyara & Return', 'description' => 'Visit Lake Manyara National Park, return to Arusha.'],
            ],
            'tz_luxury_7day' => [
                ['day_number' => 1, 'title' => 'Arrival Arusha', 'description' => 'Arrive in Arusha. Overnight Gran Melia Arusha.'],
                ['day_number' => 2, 'title' => 'Tarangire National Park', 'description' => 'Full-day game drive in Tarangire National Park.'],
                ['day_number' => 3, 'title' => 'Lake Manyara National Park', 'description' => 'Game drive in Lake Manyara National Park.'],
                ['day_number' => 4, 'title' => 'Serengeti National Park', 'description' => 'Transfer to Serengeti via the Ngorongoro Conservation Area.'],
                ['day_number' => 5, 'title' => 'Serengeti Game Drives', 'description' => 'Full day of Serengeti game drives. Overnight Lahia Tented Camp.'],
                ['day_number' => 6, 'title' => 'Ngorongoro Crater Floor', 'description' => 'Ngorongoro Crater floor tour. Overnight Kitela Lodge.'],
                ['day_number' => 7, 'title' => 'Departure', 'description' => 'Transfer from Karatu to the airport for departure.'],
            ],
            'ke_6day_holiday' => [
                ['day_number' => 1, 'title' => 'Nairobi to Masai Mara', 'description' => 'Drive from Nairobi to Masai Mara. Overnight Mara Enkorok Tented Camp.'],
                ['day_number' => 2, 'title' => 'Masai Mara Game Drives', 'description' => 'Full-day Masai Mara game drives.'],
                ['day_number' => 3, 'title' => 'Lake Nakuru National Park', 'description' => 'Drive to Lake Nakuru National Park. Overnight Hotel Waterbuck.'],
                ['day_number' => 4, 'title' => 'Nakuru to Amboseli', 'description' => 'Visit Lake Nakuru, then drive to Amboseli National Park. Overnight AA Lodge.'],
                ['day_number' => 5, 'title' => 'Amboseli National Park', 'description' => 'Full day in Amboseli, with views of Mount Kilimanjaro.'],
                ['day_number' => 6, 'title' => 'Return to Nairobi', 'description' => 'Drive from Amboseli back to Nairobi.'],
            ],
            'ke_mara_nakuru_naivasha_5day' => [
                ['day_number' => 1, 'title' => 'Nairobi to Masai Mara', 'description' => 'Drive to Masai Mara. Overnight Goshen Camp.'],
                ['day_number' => 2, 'title' => 'Masai Mara Game Drive', 'description' => 'Full-day game drive, optional Maasai village visit ($20pp).'],
                ['day_number' => 3, 'title' => 'Lake Nakuru', 'description' => 'Drive to Lake Nakuru National Park. Overnight Lanet Matfam Resort.'],
                ['day_number' => 4, 'title' => 'Nakuru to Naivasha', 'description' => 'Lake Nakuru game drive, transfer to Lake Naivasha.'],
                ['day_number' => 5, 'title' => "Hell's Gate & Return", 'description' => "Visit Hell's Gate National Park (walking/cycling park), return to Nairobi."],
            ],
            'ke_tsavo_amboseli_4day' => [
                ['day_number' => 1, 'title' => 'Mombasa to Tsavo West', 'description' => 'Drive from Mombasa to Tsavo West National Park, visit Mzima Springs. Overnight Ngulia Safari Lodge.'],
                ['day_number' => 2, 'title' => 'Amboseli National Park', 'description' => 'Drive to Amboseli National Park. Overnight Sentrim Amboseli Camp.'],
                ['day_number' => 3, 'title' => 'Tsavo East National Park', 'description' => 'Drive to Tsavo East National Park, known for its "red elephants." Overnight Voi Safari Lodge.'],
                ['day_number' => 4, 'title' => 'Return to Mombasa', 'description' => 'Drive back to Mombasa.'],
            ],
            'ke_best_of_mara_3day' => [
                ['day_number' => 1, 'title' => 'Nairobi to Masai Mara', 'description' => 'Drive to Masai Mara, evening game drive. Overnight Lenchada Tourist Camp.'],
                ['day_number' => 2, 'title' => 'Full-Day Game Drive', 'description' => 'Full sunrise-to-sunset game drive, optional Maasai village visit ($20pp).'],
                ['day_number' => 3, 'title' => 'Return to Nairobi', 'description' => 'Morning game drive, return to Nairobi.'],
            ],
            'rw_gorillas_golden_monkey_3day' => [
                ['day_number' => 1, 'title' => 'Arrival Kigali to Volcanoes NP', 'description' => 'Kigali airport pickup, optional city tour and Genocide Memorial visit, transfer to Volcanoes National Park.'],
                ['day_number' => 2, 'title' => 'Golden Monkey Trekking', 'description' => 'Golden monkey trekking, then cross the border to Bwindi, Uganda via Cyanika.'],
                ['day_number' => 3, 'title' => 'Gorilla Trekking', 'description' => 'Gorilla trekking, transfer back to Kigali. Lodges used: Da Vinci Gorilla Lodge, Bweza Gorilla Lodge.'],
            ],
            'rw_gorilla_3day' => [
                ['day_number' => 1, 'title' => 'Arrival Kigali', 'description' => 'Arrive in Kigali, hotel transfer, tour briefing.'],
                ['day_number' => 2, 'title' => 'Kigali City Tour to Volcanoes NP', 'description' => 'Kigali city tour (Genocide Memorial, Art Gallery, Kimironko market), transfer to Volcanoes National Park (Musanze). Overnight Hotel Des Mille Collines.'],
                ['day_number' => 3, 'title' => 'Gorilla Trekking & Departure', 'description' => 'Gorilla trekking (2–4 hours), transfer to Kigali airport for departure.'],
            ],
            'ug_5day_holiday' => [
                ['day_number' => 1, 'title' => 'Entebbe to Kibale', 'description' => 'Transfer to Kibale, Bigodi Wetland walk.'],
                ['day_number' => 2, 'title' => 'Kibale to Queen Elizabeth', 'description' => 'Chimpanzee area visit in Kibale, transfer to Queen Elizabeth National Park, Kazinga Channel water safari.'],
                ['day_number' => 3, 'title' => 'Queen Elizabeth to Bwindi', 'description' => 'Queen Elizabeth game drives, transfer to Bwindi.'],
                ['day_number' => 4, 'title' => 'Gorilla Trekking to Lake Mburo', 'description' => 'Gorilla trekking, transfer to Lake Mburo National Park.'],
                ['day_number' => 5, 'title' => 'Lake Mburo & Return', 'description' => 'Lake Mburo walking safari (optional horse riding or cycling), transfer to Entebbe.'],
            ],
            'qe_lake_mburo_3day' => [
                ['day_number' => 1, 'title' => 'Lake Mburo Boat Cruise', 'description' => 'Lake Mburo National Park boat cruise.'],
                ['day_number' => 2, 'title' => 'Lake Mburo to Queen Elizabeth', 'description' => 'Transfer to Queen Elizabeth National Park, game drive.'],
                ['day_number' => 3, 'title' => 'Queen Elizabeth to Kampala', 'description' => 'Queen Elizabeth game drive and Kazinga Channel cruise, transfer to Kampala.'],
            ],
            'qe_lake_mburo_4day' => [
                ['day_number' => 1, 'title' => 'Lake Mburo Boat Cruise', 'description' => 'Lake Mburo National Park boat cruise.'],
                ['day_number' => 2, 'title' => 'Lake Mburo to Queen Elizabeth', 'description' => 'Transfer to Queen Elizabeth National Park, game drive.'],
                ['day_number' => 3, 'title' => 'Queen Elizabeth Game Drive', 'description' => 'Queen Elizabeth game drive and Kazinga Channel cruise.'],
                ['day_number' => 4, 'title' => 'Return to Kampala', 'description' => 'Transfer from Queen Elizabeth back to Kampala.'],
            ],
            'kibale_gorillas_7day' => [
                ['day_number' => 1, 'title' => 'Arrival Entebbe', 'description' => 'Arrive in Entebbe, optional Botanical Gardens birding walk.'],
                ['day_number' => 2, 'title' => 'Mabamba to Kibale', 'description' => 'Mabamba shoebill wetlands visit, transfer to Kibale.'],
                ['day_number' => 3, 'title' => 'Kibale Chimpanzee Tracking', 'description' => 'Chimpanzee tracking and birding in Kibale Forest.'],
                ['day_number' => 4, 'title' => 'Kibale to Queen Elizabeth', 'description' => 'Transfer to Queen Elizabeth National Park.'],
                ['day_number' => 5, 'title' => 'Ishasha to Bwindi', 'description' => 'View the Ishasha tree-climbing lions, transfer to Bwindi.'],
                ['day_number' => 6, 'title' => 'Bwindi Gorilla Trekking', 'description' => 'Gorilla trekking in Bwindi Impenetrable Forest.'],
                ['day_number' => 7, 'title' => 'Departure', 'description' => 'Transfer to Entebbe airport for departure.'],
            ],
            'kidepo_murchison_6day' => [
                ['day_number' => 1, 'title' => 'Sipi Falls', 'description' => 'Hike at Kapchorwa/Sipi Falls, coffee tour.'],
                ['day_number' => 2, 'title' => 'Kidepo Valley National Park', 'description' => 'Transfer to Kidepo Valley National Park.'],
                ['day_number' => 3, 'title' => 'Kidepo Game Drive & Cultural Visit', 'description' => 'Nature walk, game drive, and a Karamojong community cultural visit.'],
                ['day_number' => 4, 'title' => 'Murchison Falls National Park', 'description' => 'Transfer to Murchison Falls National Park.'],
                ['day_number' => 5, 'title' => 'Falls Game Drive & Cruise', 'description' => 'Game drive and afternoon launch cruise to the base of Murchison Falls.'],
                ['day_number' => 6, 'title' => 'Return via Ziwa Rhino Sanctuary', 'description' => 'Transfer to Kampala via Ziwa Rhino Sanctuary, departure.'],
            ],
            'bwindi_bunyonyi_qe_4day' => [
                ['day_number' => 1, 'title' => 'Transfer to Bwindi & Batwa Experience', 'description' => "Transfer to Bwindi, Batwa cultural experience. Overnight Rushaga Gorilla Haven's Lodge / Broadbill Forest Camp."],
                ['day_number' => 2, 'title' => 'Gorilla Trekking & Lake Bunyonyi', 'description' => 'Gorilla trekking, afternoon Lake Bunyonyi canoe ride. Overnight Bunyonyi Safaris Resort.'],
                ['day_number' => 3, 'title' => 'Queen Elizabeth & Kazinga Channel', 'description' => 'Transfer to Queen Elizabeth National Park, Kazinga Channel boat cruise and evening game drive. Overnight The Bush Lodge / Banda.'],
                ['day_number' => 4, 'title' => 'Kalinzu Forest & Departure', 'description' => 'Chimpanzee trek at Kalinzu Forest Reserve, transfer to Entebbe. End of tour.'],
            ],
            'kidepo_wildlife_4day' => [
                ['day_number' => 1, 'title' => 'Kampala to Kidepo', 'description' => 'Transfer to Kidepo Valley National Park via Gulu/Kitgum. Overnight Kidepo Savannah Lodge.'],
                ['day_number' => 2, 'title' => 'Kidepo Game Drives', 'description' => 'Two game drives, optional Kanangorok Hot Springs visit.'],
                ['day_number' => 3, 'title' => 'Game Drive & Cultural Tour', 'description' => 'Game drive and a Karamojong cultural tour.'],
                ['day_number' => 4, 'title' => 'Return to Entebbe', 'description' => 'Transfer to Kampala, then Entebbe airport.'],
            ],
            'rw_akagera_golden_monkey_7day' => [
                ['day_number' => 1, 'title' => 'Arrival Kigali', 'description' => 'Arrival in Kigali.'],
                ['day_number' => 2, 'title' => 'Akagera National Park', 'description' => 'Transfer to Akagera National Park, night game drive.'],
                ['day_number' => 3, 'title' => 'Akagera Game Drives & Boat Cruise', 'description' => 'Akagera game drives and a Lake Ihema boat cruise, transfer back to Kigali. Overnight Akagera Game Lodge.'],
                ['day_number' => 4, 'title' => 'Kigali City Tour to Musanze', 'description' => 'Kigali city tour (Genocide Memorial, Kimironko, Nyamirambo), transfer to Musanze/Volcanoes National Park.'],
                ['day_number' => 5, 'title' => 'Golden Monkey Trek', 'description' => "Golden Monkey trek and a visit to the Iby'iwacu Cultural Village."],
                ['day_number' => 6, 'title' => 'Bisoke Volcano Hike', 'description' => 'Bisoke Volcano hike (crater lake, 4hrs up/2hrs down), transfer to Lake Kivu.'],
                ['day_number' => 7, 'title' => 'Lake Kivu & Departure', 'description' => 'Lake Kivu boat cruise, transfer to Kigali for departure. Overnight Paradise Malahide.'],
            ],
            'kigali_city_1day' => [
                ['day_number' => 1, 'title' => 'Kigali City Tour', 'description' => 'Kimironko city market, Mt. Kigali viewpoint, a milk bar, a public art walk, Rwandan lunch, a coffee stop, and a visit to the Kigali Genocide Memorial Centre (starting 7:30am).'],
            ],
            'mount_kenya_chogoria_6day' => [
                ['day_number' => 1, 'title' => 'Nairobi to Chogoria Gate', 'description' => 'Transfer to Chogoria Gate, trek to Mt Kenya Bandas. Camping accommodation.'],
                ['day_number' => 2, 'title' => 'Lake Ellis Camp', 'description' => 'Trek to Lake Ellis Camp (3,600m).'],
                ['day_number' => 3, 'title' => 'Mintos Hut', 'description' => 'Trek to Mintos Hut (4,200m), visit "the Temple" viewpoint.'],
                ['day_number' => 4, 'title' => 'Austrian Hut', 'description' => 'Trek to Austrian Hut via Tooth Col.'],
                ['day_number' => 5, 'title' => 'Summit Point Lenana', 'description' => "Pre-dawn summit of Point Lenana (hiker's summit), descend via Mackinder's Valley to Liki North Camp (3,900m)."],
                ['day_number' => 6, 'title' => 'Return to Nairobi', 'description' => 'Descend to Old Moses Camp, transfer to Nairobi.'],
            ],
            'masai_mara_flying_5day' => [
                ['day_number' => 1, 'title' => 'Fly to Masai Mara', 'description' => 'Fly from Nairobi (Wilson Airport) to Kichwa Tembo airstrip in the Masai Mara, afternoon game drive.'],
                ['day_number' => 2, 'title' => 'Full-Day Game Drives', 'description' => 'Morning and afternoon game drives, optional hot air balloon safari, sundowners.'],
                ['day_number' => 3, 'title' => 'Full-Day Game Drives', 'description' => 'Morning and afternoon game drives, pool time at camp.'],
                ['day_number' => 4, 'title' => 'Game Drive & Balloon Option', 'description' => 'Morning and afternoon game drives, optional hot air balloon safari (+$450).'],
                ['day_number' => 5, 'title' => 'Sunrise Game Drive & Departure', 'description' => 'Sunrise game drive, optional Maasai village visit, fly back to Nairobi. All 5 nights at &Beyond Kichwa Tembo Tented Camp.'],
            ],
            'ke_coastal_beach' => [
                ['day_number' => 1, 'title' => 'Arrival Mombasa/Malindi', 'description' => 'Airport transfer to Diamonds Dream of Africa Resort.'],
                ['day_number' => 2, 'title' => 'Vasco da Gama & Malindi Marine Park', 'description' => 'Visit the Vasco da Gama Pillar and Malindi Marine Park.'],
                ['day_number' => 3, 'title' => 'Gedi Ruins', 'description' => 'Excursion to the Gedi Ruins.'],
                ['day_number' => 4, 'title' => 'Mombasa & Haller Park', 'description' => 'Transfer to Mombasa, visit the Haller Park nature trail. Overnight Sarova Whitesands Beach Resort.'],
                ['day_number' => 5, 'title' => 'Fort Jesus & Old Town', 'description' => 'Visit Fort Jesus and Old Town Mombasa.'],
                ['day_number' => 6, 'title' => 'Diani & Shimba Hills', 'description' => 'Transfer to Diani, Shimba Hills National Reserve game drive and Sheldrick Falls. Overnight Baobab Beach Resort.'],
                ['day_number' => 7, 'title' => 'Diani Beach Leisure', 'description' => 'Diani Beach leisure day with optional add-ons.'],
                ['day_number' => 8, 'title' => 'Diani Beach Leisure', 'description' => 'Further beach leisure time, optional add-ons.'],
                ['day_number' => 9, 'title' => 'Departure', 'description' => 'Transfer to Moi International Airport, departure.'],
            ],
            'ke_classic_12day' => [
                ['day_number' => 1, 'title' => 'Arrival Nairobi', 'description' => 'Arrive in Nairobi. Overnight Ibis Styles Nairobi Westlands.'],
                ['day_number' => 2, 'title' => 'Nairobi to Masai Mara', 'description' => 'Transfer to Masai Mara. Overnight Fisi Camp.'],
                ['day_number' => 3, 'title' => 'Masai Mara Game Drives', 'description' => 'Full-day Masai Mara game drives, optional hot air balloon safari ($500pp).'],
                ['day_number' => 4, 'title' => 'Masai Mara & Maasai Village', 'description' => 'Further Masai Mara game drives, optional Maasai village visit.'],
                ['day_number' => 5, 'title' => 'Lake Naivasha', 'description' => 'Transfer to Lake Naivasha, boat ride. Overnight Panorama Hotel Naivasha.'],
                ['day_number' => 6, 'title' => 'Lake Nakuru National Park', 'description' => 'Transfer to Lake Nakuru National Park. Overnight Hotel CityMax.'],
                ['day_number' => 7, 'title' => 'Amboseli National Park', 'description' => 'Transfer to Amboseli National Park. Overnight AA Lodge Amboseli.'],
                ['day_number' => 8, 'title' => 'Full-Day Amboseli', 'description' => 'Full day of game viewing in Amboseli National Park.'],
                ['day_number' => 9, 'title' => 'Tsavo West National Park', 'description' => 'Transfer to Tsavo West National Park. Overnight Ngulia Safari Lodge.'],
                ['day_number' => 10, 'title' => 'Tsavo East National Park', 'description' => 'Transfer to Tsavo East National Park. Overnight Ashnil Aruba.'],
                ['day_number' => 11, 'title' => 'Full-Day Tsavo East', 'description' => 'Full day exploring Tsavo East (Aruba Dam, Mudanda Rock, Yatta Plateau).'],
                ['day_number' => 12, 'title' => 'Return to Nairobi', 'description' => 'Transfer to Nairobi, departure.'],
            ],
            'rw_akagera_remarkable_3day' => [
                ['day_number' => 1, 'title' => 'Arrival & Transfer to Akagera', 'description' => 'Arrival in Kigali, transfer to Akagera National Park.'],
                ['day_number' => 2, 'title' => 'Akagera Game Drives', 'description' => 'Full-day game drives and a boat cruise on Lake Ihema.'],
                ['day_number' => 3, 'title' => 'Return to Kigali', 'description' => 'Morning game drive, transfer back to Kigali for departure.'],
            ],
            'rw_primate_tracking_8day' => [
                ['day_number' => 1, 'title' => 'Arrival Kigali', 'description' => 'Arrival in Kigali, transfer to hotel.'],
                ['day_number' => 2, 'title' => 'Kigali City Tour', 'description' => 'Kigali city tour including the Genocide Memorial.'],
                ['day_number' => 3, 'title' => 'Transfer to Volcanoes NP', 'description' => 'Transfer to Volcanoes National Park.'],
                ['day_number' => 4, 'title' => 'Gorilla Trekking', 'description' => 'Mountain gorilla trekking.'],
                ['day_number' => 5, 'title' => 'Golden Monkey Trekking', 'description' => 'Golden monkey trekking and a cultural village visit.'],
                ['day_number' => 6, 'title' => 'Transfer to Nyungwe', 'description' => 'Transfer to Nyungwe Forest National Park.'],
                ['day_number' => 7, 'title' => 'Chimpanzee Tracking', 'description' => 'Chimpanzee tracking and a canopy walk in Nyungwe Forest.'],
                ['day_number' => 8, 'title' => 'Return to Kigali', 'description' => 'Transfer back to Kigali for departure.'],
            ],
            'murchison_ziwa_3day' => [
                ['day_number' => 1, 'title' => 'Kampala to Ziwa', 'description' => 'Transfer to Ziwa Rhino Sanctuary for a rhino tracking walk.'],
                ['day_number' => 2, 'title' => 'Murchison Falls National Park', 'description' => 'Transfer to Murchison Falls National Park, afternoon game drive.'],
                ['day_number' => 3, 'title' => 'Falls Cruise & Return', 'description' => 'Launch cruise to the base of Murchison Falls, transfer back to Kampala.'],
            ],
        ];

        $itineraryOverrides = [
            '4-day-bwindi-gorilla-trekking-flying-safari' => $sharedItineraries['bwindi_gorilla_flying'],
            '5-day-birding-safari-to-uganda' => $sharedItineraries['birding_uganda'],
            '8-days-western-uganda-cycling-safari' => $sharedItineraries['western_uganda_cycling'],
            'kampala-cultural-tour' => $sharedItineraries['kampala_cultural'],
            '1-day-white-water-rafting-on-the-nile' => $sharedItineraries['jinja_rafting'],
            'kampala-city-tour' => $sharedItineraries['kampala_city'],
            '8-days-mountain-rwenzori-hiking-safari' => $sharedItineraries['rwenzori_hiking'],
            '5-day-mount-elgon-hiking-safari' => $sharedItineraries['mount_elgon'],
            '3-day-safari-tarangire-ngorongoro-lake-manyara' => $sharedItineraries['tz_tarangire_ngorongoro_manyara_3day'],
            '4-day-luxury-tanzania-safari' => $sharedItineraries['tz_luxury_4day'],
            '4-day-tanzania-safari-tarangire-serengeti-manyara' => $sharedItineraries['tz_tarangire_serengeti_manyara_4day'],
            '7-day-luxury-tanzania-safari' => $sharedItineraries['tz_luxury_7day'],
            '6-day-kenya-safari-holiday' => $sharedItineraries['ke_6day_holiday'],
            '5-day-masai-mara-nakuru-naivasha' => $sharedItineraries['ke_mara_nakuru_naivasha_5day'],
            '4-day-tsavo-and-amboseli-kenya-safari' => $sharedItineraries['ke_tsavo_amboseli_4day'],
            '3-day-best-of-masai-mara' => $sharedItineraries['ke_best_of_mara_3day'],
            '3-day-gorillas-and-golden-monkey-safari' => $sharedItineraries['rw_gorillas_golden_monkey_3day'],
            '3-day-rwanda-gorilla-safari' => $sharedItineraries['rw_gorilla_3day'],
            '5-day-uganda-safari-holiday' => $sharedItineraries['ug_5day_holiday'],
            '3-day-queen-elizabeth-safari-holiday' => $sharedItineraries['qe_lake_mburo_3day'],
            '4-day-queen-elizabeth-lake-mburo-national-parks-safari' => $sharedItineraries['qe_lake_mburo_4day'],
            '7-day-kibale-national-park-and-gorillas-safari' => $sharedItineraries['kibale_gorillas_7day'],
            '6-day-kidepo-and-murchison-falls-wilderness-tour' => $sharedItineraries['kidepo_murchison_6day'],
            '4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safari' => $sharedItineraries['bwindi_bunyonyi_qe_4day'],
            '5-day-highlighted-gorillas-a4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safarnd-wildlife-safari' => $sharedItineraries['bwindi_bunyonyi_qe_4day'],
            '4-day-kidepo-wildlife-safari' => $sharedItineraries['kidepo_wildlife_4day'],
            '7-day-rwanda-akagera-safari-and-golden-monkey-tour' => $sharedItineraries['rw_akagera_golden_monkey_7day'],
            'kigali-rwanda-city-tour' => $sharedItineraries['kigali_city_1day'],
            '6-day-mount-kenya-chogoria-route-climbing-package' => $sharedItineraries['mount_kenya_chogoria_6day'],
            '5-day-masai-mara-flying-luxury-safari' => $sharedItineraries['masai_mara_flying_5day'],
            '5-day-masai-mara-fly-in-luxury-safari' => $sharedItineraries['masai_mara_flying_5day'],
            '8-days-best-of-kenya-safari' => array_slice($sharedItineraries['ke_coastal_beach'], 0, 8),
            '9-day-kenya-beach-holiday-and-luxury-wildlife-safari' => $sharedItineraries['ke_coastal_beach'],
            '12-day-kenya-classic-signature-wildlife-safari' => $sharedItineraries['ke_classic_12day'],
            '12-day-kenya-classic-signature-wildlife-safari-2' => $sharedItineraries['ke_classic_12day'],
            '3-day-rwandas-remarkable-akagera-safari' => $sharedItineraries['rw_akagera_remarkable_3day'],
            '8-day-rwanda-primate-tracking-safari' => $sharedItineraries['rw_primate_tracking_8day'],
            '3-day-murchison-falls-ziwa-rhino-sanctuary' => $sharedItineraries['murchison_ziwa_3day'],
        ];

        foreach ($packagesData as $pData) {
            $country = Country::where('code', $pData['country_code'])->first();
            $destination = Destination::where('country_id', $country->id ?? 1)->first();

            $correction = $corrections[$pData['slug']] ?? null;
            $itineraryData = $itineraryOverrides[$pData['slug']] ?? $pData['itinerary'];
            $imageUrl = $pData['image_url'];
            unset($pData['country_code'], $pData['itinerary'], $pData['image_url']);

            if ($correction) {
                $pData['duration_days'] = $correction['duration_days'];
                $pData['duration_nights'] = $correction['duration_nights'];
                $pData['base_price'] = $correction['base_price'];
            }

            $pData['destination_id'] = $destination->id ?? 1;

            $package = SafariPackage::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );

            // Copy exact live image to Media Library if available
            if ($imageUrl && file_exists(public_path($imageUrl))) {
                $package->clearMediaCollection('cover');
                $package->addMedia(public_path($imageUrl))
                    ->preservingOriginal()
                    ->toMediaCollection('cover');
            }

            // Seed Itinerary Days
            $package->itineraryDays()->delete();
            foreach ($itineraryData as $dayItem) {
                ItineraryDay::create([
                    'package_id' => $package->id,
                    'day_number' => $dayItem['day_number'],
                    'title' => $dayItem['title'],
                    'description' => $dayItem['description'],
                    'breakfast' => true,
                    'lunch' => true,
                    'dinner' => true,
                ]);
            }

            // Seed standard Inclusions
            $package->inclusions()->delete();
            $inclusions = [
                'Park entrance fees and safari vehicle transfers',
                'All accommodations as specified in itinerary',
                'Full board meals (Breakfast, Lunch, Dinner)',
                'Services of an experienced English-speaking driver/guide',
                'Bottled drinking water in the safari vehicle',
                'Free Emergency Flying Doctors insurance cover'
            ];
            foreach ($inclusions as $idx => $inc) {
                PackageInclusion::create([
                    'package_id' => $package->id,
                    'item' => $inc,
                    'display_order' => $idx
                ]);
            }

            // Premium fly-in/luxury packages include international + domestic
            // flights per the audit (§5.4) — everyone else excludes flights.
            $includesFlights = $correction['flights'] ?? false;

            if ($includesFlights) {
                PackageInclusion::create([
                    'package_id' => $package->id,
                    'item' => 'International and domestic flights as specified in the itinerary',
                    'display_order' => count($inclusions),
                ]);
            }

            // Seed standard Exclusions
            $package->exclusions()->delete();
            $exclusions = $includesFlights
                ? ['Visa fees', 'Personal expenses, tips and gratuities', 'Alcoholic and soft beverages outside game drives', 'Travel and medical insurance']
                : ['International flights and Visa fees', 'Personal expenses, tips and gratuities', 'Alcoholic and soft beverages outside game drives', 'Travel and medical insurance'];
            foreach ($exclusions as $idx => $exc) {
                PackageExclusion::create([
                    'package_id' => $package->id,
                    'item' => $exc,
                    'display_order' => $idx
                ]);
            }

            // Attach the real category set for this tour (audit §5.2/§5.3),
            // replacing whatever it was previously assigned — a full sync()
            // rather than syncWithoutDetaching() so packages that were
            // wrongly stuck on wildlife-adventure-only get corrected.
            $categorySlugs = $correction['categories'] ?? ['wildlife-adventure'];
            $categoryIds = SafariCategory::whereIn('slug', $categorySlugs)->pluck('id')->all();
            $package->categories()->sync($categoryIds);
        }

        $this->command->info('✅ Successfully seeded ' . count($packagesData) . ' Safari Packages with Exact Live Images!');
    }
}
