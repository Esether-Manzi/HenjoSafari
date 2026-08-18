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

        foreach ($packagesData as $pData) {
            $country = Country::where('code', $pData['country_code'])->first();
            $destination = Destination::where('country_id', $country->id ?? 1)->first();

            $itineraryData = $pData['itinerary'];
            $imageUrl = $pData['image_url'];
            unset($pData['country_code'], $pData['itinerary'], $pData['image_url']);

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

            // Seed standard Exclusions
            $package->exclusions()->delete();
            $exclusions = [
                'International flights and Visa fees',
                'Personal expenses, tips and gratuities',
                'Alcoholic and soft beverages outside game drives',
                'Travel and medical insurance'
            ];
            foreach ($exclusions as $idx => $exc) {
                PackageExclusion::create([
                    'package_id' => $package->id,
                    'item' => $exc,
                    'display_order' => $idx
                ]);
            }

            // Attach Category
            $wildlifeCat = SafariCategory::where('slug', 'wildlife-adventure')->first();
            if ($wildlifeCat) {
                $package->categories()->syncWithoutDetaching([$wildlifeCat->id]);
            }
        }

        $this->command->info('✅ Successfully seeded ' . count($packagesData) . ' Safari Packages with Exact Live Images!');
    }
}
