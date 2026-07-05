<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SafariPackage;
use App\Models\Destination;
use App\Models\Country;
use App\Models\SafariCategory;
use App\Models\Activity;
use App\Models\Accommodation;
use App\Models\ItineraryDay;
use App\Models\PackageInclusion;
use App\Models\PackageExclusion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SafariPackageSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🚀 Starting Safari Package Seeder...');

        try {
            DB::beginTransaction();

            // ========================================
            // STEP 1: CREATE COUNTRY
            // ========================================
            $this->command->info('📌 Step 1: Creating Country...');
            $country = Country::updateOrCreate(
                ['code' => 'TZ'],
                [
                    'name' => 'Tanzania',
                    'code' => 'TZ',
                    'currency' => 'USD',
                ]
            );
            $this->command->info('✅ Country: ' . $country->name);

            // ========================================
            // STEP 2: CREATE DESTINATION
            // ========================================
            $this->command->info('📌 Step 2: Creating Destination...');
            $destination = Destination::updateOrCreate(
                ['slug' => 'serengeti'],
                [
                    'name' => 'Serengeti National Park',
                    'country_id' => $country->id,
                    'description' => 'The Serengeti National Park is a UNESCO World Heritage site and one of the most famous wildlife reserves in the world. Known for the annual Great Migration, it hosts over 1.5 million wildebeest and 250,000 zebras.',
                    'best_time_to_visit' => 'June to October',
                    'featured' => true,
                    'is_active' => true,
                ]
            );
            $this->command->info('✅ Destination: ' . $destination->name);

            // Create another destination
            $destination2 = Destination::updateOrCreate(
                ['slug' => 'ngorongoro'],
                [
                    'name' => 'Ngorongoro Conservation Area',
                    'country_id' => $country->id,
                    'description' => 'A UNESCO World Heritage site featuring the famous Ngorongoro Crater, often called the "Garden of Eden".',
                    'best_time_to_visit' => 'June to October',
                    'featured' => true,
                    'is_active' => true,
                ]
            );
            $this->command->info('✅ Destination: ' . $destination2->name);

            // Create third destination
            $destination3 = Destination::updateOrCreate(
                ['slug' => 'zanzibar'],
                [
                    'name' => 'Zanzibar Archipelago',
                    'country_id' => $country->id,
                    'description' => 'A semi-autonomous archipelago off the coast of Tanzania, known for its beautiful beaches and historic Stone Town.',
                    'best_time_to_visit' => 'June to October, December to February',
                    'featured' => false,
                    'is_active' => true,
                ]
            );
            $this->command->info('✅ Destination: ' . $destination3->name);

            // ========================================
            // STEP 3: CREATE CATEGORIES
            // ========================================
            $this->command->info('📌 Step 3: Creating Categories...');
            $categoryData = [
                ['name' => 'Wildlife Safari', 'slug' => 'wildlife-safari', 'icon' => '🦁'],
                ['name' => 'Adventure', 'slug' => 'adventure', 'icon' => '🏔️'],
                ['name' => 'Luxury', 'slug' => 'luxury', 'icon' => '🌟'],
                ['name' => 'Family', 'slug' => 'family', 'icon' => '👨‍👩‍👧‍👦'],
                ['name' => 'Honeymoon', 'slug' => 'honeymoon', 'icon' => '❤️'],
                ['name' => 'Budget', 'slug' => 'budget', 'icon' => '💰'],
                ['name' => 'Photography', 'slug' => 'photography', 'icon' => '📷'],
                ['name' => 'Cultural', 'slug' => 'cultural', 'icon' => '🏠'],
            ];

            $categories = [];
            foreach ($categoryData as $cat) {
                $category = SafariCategory::updateOrCreate(
                    ['slug' => $cat['slug']],
                    $cat
                );
                $categories[$category->slug] = $category;
                $this->command->info('  ✅ Category: ' . $category->name);
            }

            // ========================================
            // STEP 4: CREATE ACTIVITIES (with icon column)
            // ========================================
            $this->command->info('📌 Step 4: Creating Activities...');
            $activityData = [
                ['name' => 'Game Drive', 'slug' => 'game-drive', 'icon' => '🚗', 'description' => 'Classic safari game drives in a 4x4 vehicle'],
                ['name' => 'Hot Air Balloon Safari', 'slug' => 'hot-air-balloon', 'icon' => '🎈', 'description' => 'Soar above the Serengeti at sunrise'],
                ['name' => 'Walking Safari', 'slug' => 'walking-safari', 'icon' => '🚶', 'description' => 'Guided walking tours to see wildlife up close'],
                ['name' => 'Boat Safari', 'slug' => 'boat-safari', 'icon' => '🚤', 'description' => 'Explore waterways and spot aquatic wildlife'],
                ['name' => 'Cultural Visit', 'slug' => 'cultural-visit', 'icon' => '🏠', 'description' => 'Visit local communities and learn about their culture'],
                ['name' => 'Bird Watching', 'slug' => 'bird-watching', 'icon' => '🦅', 'description' => 'Spot hundreds of bird species'],
                ['name' => 'Photography Tour', 'slug' => 'photography-tour', 'icon' => '📷', 'description' => 'Professional photography guidance'],
                ['name' => 'Night Game Drive', 'slug' => 'night-game-drive', 'icon' => '🌙', 'description' => 'Spot nocturnal wildlife under the stars'],
                ['name' => 'Horseback Safari', 'slug' => 'horseback-safari', 'icon' => '🐴', 'description' => 'Explore the wilderness on horseback'],
            ];

            $activities = [];
            foreach ($activityData as $act) {
                $activity = Activity::updateOrCreate(
                    ['slug' => $act['slug']],
                    $act
                );
                $activities[$activity->slug] = $activity;
                $this->command->info('  ✅ Activity: ' . $activity->name);
            }

            // ========================================
            // STEP 5: CREATE ACCOMMODATIONS
            // ========================================
            $this->command->info('📌 Step 5: Creating Accommodations...');
            $accommodationData = [
                [
                    'name' => 'Serengeti Safari Lodge',
                    'slug' => 'serengeti-safari-lodge',
                    'type' => 'lodge',
                    'star_rating' => 5,
                    'location' => 'Serengeti National Park',
                    'description' => 'A luxury lodge located in the heart of the Serengeti. Offers panoramic views of the plains and exceptional wildlife viewing.',
                    'website' => 'https://serengetilodge.com',
                    'phone' => '+255 123 456 789',
                ],
                [
                    'name' => 'Ngorongoro Crater Camp',
                    'slug' => 'ngorongoro-crater-camp',
                    'type' => 'camp',
                    'star_rating' => 4,
                    'location' => 'Ngorongoro Conservation Area',
                    'description' => 'A premium camp on the rim of the Ngorongoro Crater with stunning views and easy access to the crater floor.',
                ],
                [
                    'name' => 'Zanzibar Beach Resort',
                    'slug' => 'zanzibar-beach-resort',
                    'type' => 'resort',
                    'star_rating' => 5,
                    'location' => 'Zanzibar',
                    'description' => 'A 5-star resort on the beautiful Zanzibar beaches offering pristine white sand and turquoise waters.',
                ],
                [
                    'name' => 'Arusha Hotel',
                    'slug' => 'arusha-hotel',
                    'type' => 'hotel',
                    'star_rating' => 3,
                    'location' => 'Arusha',
                    'description' => 'A comfortable hotel in the heart of Arusha, perfect for starting your safari adventure.',
                ],
                [
                    'name' => 'Lake Manyara Tree Lodge',
                    'slug' => 'lake-manyara-tree-lodge',
                    'type' => 'lodge',
                    'star_rating' => 4,
                    'location' => 'Lake Manyara',
                    'description' => 'Unique treehouse accommodation overlooking Lake Manyara with amazing bird watching opportunities.',
                ],
                [
                    'name' => 'Budget Serengeti Camp',
                    'slug' => 'budget-serengeti-camp',
                    'type' => 'camp',
                    'star_rating' => 2,
                    'location' => 'Serengeti National Park',
                    'description' => 'Comfortable camping experience in the Serengeti at an affordable price.',
                ],
                [
                    'name' => 'Luxury Zanzibar Villa',
                    'slug' => 'luxury-zanzibar-villa',
                    'type' => 'resort',
                    'star_rating' => 5,
                    'location' => 'Zanzibar',
                    'description' => 'Private luxury villa with personal butler service and stunning ocean views.',
                ],
            ];

            $accommodations = [];
            foreach ($accommodationData as $acc) {
                $accommodation = Accommodation::updateOrCreate(
                    ['slug' => $acc['slug']],
                    $acc
                );
                $accommodations[$accommodation->slug] = $accommodation;
                $this->command->info('  ✅ Accommodation: ' . $accommodation->name);
            }

            // ========================================
            // STEP 6: CREATE SAFARI PACKAGES
            // ========================================
            $this->command->info('📌 Step 6: Creating Safari Packages...');

            $packages = [
                [
                    'title' => 'Serengeti Great Migration Safari',
                    'slug' => 'serengeti-great-migration-safari',
                    'destination_id' => $destination->id,
                    'summary' => 'Witness the greatest wildlife spectacle on earth - the Great Migration in the Serengeti National Park.',
                    'description' => "This comprehensive safari takes you deep into the Serengeti to witness the annual Great Migration, where over 1.5 million wildebeest and 250,000 zebras cross the plains in search of fresh grazing.\n\nYour experienced guide will position you at prime viewing spots to capture this incredible natural phenomenon. You'll also visit the Ngorongoro Crater, often called the 'Garden of Eden'.\n\nThis safari includes comfortable accommodations, all meals, and expert guiding throughout your journey.",
                    'duration_days' => 7,
                    'duration_nights' => 6,
                    'base_price' => 3500.00,
                    'currency' => 'USD',
                    'min_people' => 2,
                    'max_people' => 8,
                    'featured' => true,
                    'popular' => true,
                    'status' => 'published',
                    'categories' => ['wildlife-safari', 'luxury', 'adventure', 'photography'],
                    'activities' => ['game-drive', 'hot-air-balloon', 'photography-tour'],
                    'accommodations' => [
                        ['slug' => 'serengeti-safari-lodge', 'level' => 'luxury'],
                        ['slug' => 'ngorongoro-crater-camp', 'level' => 'midrange'],
                    ],
                ],
                [
                    'title' => 'Ngorongoro Crater Experience',
                    'slug' => 'ngorongoro-crater-experience',
                    'destination_id' => $destination2->id,
                    'summary' => 'Descend into the Ngorongoro Crater, a UNESCO World Heritage site and one of the most beautiful wildlife havens on earth.',
                    'description' => "The Ngorongoro Crater is often called the 'Garden of Eden' due to its incredible concentration of wildlife. This safari takes you into this natural wonder where you'll see the Big Five and thousands of flamingos.\n\nYour expert guide will help you spot rare black rhinos and the massive elephants that roam the crater floor.",
                    'duration_days' => 4,
                    'duration_nights' => 3,
                    'base_price' => 1800.00,
                    'currency' => 'USD',
                    'min_people' => 2,
                    'max_people' => 6,
                    'featured' => true,
                    'popular' => false,
                    'status' => 'published',
                    'categories' => ['wildlife-safari', 'family', 'photography'],
                    'activities' => ['game-drive', 'bird-watching', 'photography-tour'],
                    'accommodations' => [
                        ['slug' => 'ngorongoro-crater-camp', 'level' => 'midrange'],
                    ],
                ],
                [
                    'title' => 'Zanzibar Beach Holiday',
                    'slug' => 'zanzibar-beach-holiday',
                    'destination_id' => $destination3->id,
                    'summary' => 'Relax on the pristine beaches of Zanzibar. Explore Stone Town and enjoy the turquoise waters of the Indian Ocean.',
                    'description' => "After your safari, unwind on the beautiful beaches of Zanzibar. This package combines wildlife viewing with beach relaxation.\n\nExplore the historic Stone Town, a UNESCO World Heritage site, visit spice plantations, and swim in the crystal-clear waters of the Indian Ocean.",
                    'duration_days' => 5,
                    'duration_nights' => 4,
                    'base_price' => 1200.00,
                    'currency' => 'USD',
                    'min_people' => 2,
                    'max_people' => 10,
                    'featured' => false,
                    'popular' => false,
                    'status' => 'published',
                    'categories' => ['luxury', 'honeymoon', 'cultural'],
                    'activities' => ['boat-safari', 'cultural-visit', 'photography-tour'],
                    'accommodations' => [
                        ['slug' => 'zanzibar-beach-resort', 'level' => 'luxury'],
                    ],
                ],
                [
                    'title' => 'Tanzania Explorer Safari',
                    'slug' => 'tanzania-explorer-safari',
                    'destination_id' => $destination->id,
                    'summary' => 'Explore the best of Tanzania including Serengeti, Ngorongoro, and Lake Manyara in one unforgettable journey.',
                    'description' => "This comprehensive safari covers the best wildlife destinations in Tanzania's northern circuit.\n\nExperience the Great Migration in the Serengeti, explore the Ngorongoro Crater, and enjoy the diverse birdlife at Lake Manyara. Perfect for first-time safari visitors.",
                    'duration_days' => 10,
                    'duration_nights' => 9,
                    'base_price' => 4200.00,
                    'currency' => 'USD',
                    'min_people' => 2,
                    'max_people' => 7,
                    'featured' => false,
                    'popular' => true,
                    'status' => 'published',
                    'categories' => ['wildlife-safari', 'adventure', 'family', 'photography'],
                    'activities' => ['game-drive', 'walking-safari', 'bird-watching', 'photography-tour'],
                    'accommodations' => [
                        ['slug' => 'serengeti-safari-lodge', 'level' => 'midrange'],
                        ['slug' => 'lake-manyara-tree-lodge', 'level' => 'midrange'],
                        ['slug' => 'ngorongoro-crater-camp', 'level' => 'budget'],
                    ],
                ],
                [
                    'title' => 'Luxury Serengeti & Zanzibar',
                    'slug' => 'luxury-serengeti-zanzibar',
                    'destination_id' => $destination->id,
                    'summary' => 'The ultimate luxury safari experience combining the Serengeti with a beach getaway in Zanzibar.',
                    'description' => "Experience the best of both worlds with this luxury package. Start with a premium safari in the Serengeti, then fly to the beautiful beaches of Zanzibar for some relaxation.\n\nThis package includes exclusive accommodations, private guides, and exceptional service throughout.",
                    'duration_days' => 12,
                    'duration_nights' => 11,
                    'base_price' => 8500.00,
                    'currency' => 'USD',
                    'min_people' => 2,
                    'max_people' => 6,
                    'featured' => true,
                    'popular' => false,
                    'status' => 'published',
                    'categories' => ['luxury', 'honeymoon', 'wildlife-safari', 'photography'],
                    'activities' => ['game-drive', 'hot-air-balloon', 'boat-safari', 'photography-tour'],
                    'accommodations' => [
                        ['slug' => 'serengeti-safari-lodge', 'level' => 'luxury'],
                        ['slug' => 'luxury-zanzibar-villa', 'level' => 'luxury'],
                    ],
                ],
                [
                    'title' => 'Budget Serengeti Safari',
                    'slug' => 'budget-serengeti-safari',
                    'destination_id' => $destination->id,
                    'summary' => 'Experience the Serengeti on a budget without compromising on wildlife viewing.',
                    'description' => "This affordable safari offers the perfect introduction to the Serengeti at a budget-friendly price.\n\nStay in comfortable tents, enjoy home-cooked meals, and still experience the incredible wildlife that makes the Serengeti famous.",
                    'duration_days' => 5,
                    'duration_nights' => 4,
                    'base_price' => 850.00,
                    'currency' => 'USD',
                    'min_people' => 4,
                    'max_people' => 12,
                    'featured' => false,
                    'popular' => false,
                    'status' => 'published',
                    'categories' => ['budget', 'wildlife-safari'],
                    'activities' => ['game-drive', 'photography-tour'],
                    'accommodations' => [
                        ['slug' => 'budget-serengeti-camp', 'level' => 'budget'],
                    ],
                ],
            ];

            $createdPackages = [];

            foreach ($packages as $packageData) {
                // Extract relationship data
                $categorySlugs = $packageData['categories'] ?? [];
                $activitySlugs = $packageData['activities'] ?? [];
                $accommodationData = $packageData['accommodations'] ?? [];

                // Remove relationship data from package data
                unset(
                    $packageData['categories'],
                    $packageData['activities'],
                    $packageData['accommodations']
                );

                // Check if package already exists
                $existingPackage = SafariPackage::where('slug', $packageData['slug'])->first();

                if ($existingPackage) {
                    $this->command->warn("  ⚠️ Package '{$packageData['title']}' already exists, updating...");
                    $package = $existingPackage;
                    $package->update($packageData);
                } else {
                    $package = SafariPackage::create($packageData);
                }

                $this->command->info("  ✅ Package: {$package->title} (ID: {$package->id})");

                // ========================================
                // ATTACH CATEGORIES
                // ========================================
                if (!empty($categorySlugs)) {
                    $categoryIds = SafariCategory::whereIn('slug', $categorySlugs)->pluck('id')->toArray();
                    if (!empty($categoryIds)) {
                        $package->categories()->sync($categoryIds);
                        $this->command->info("     📎 Attached " . count($categoryIds) . " categories");
                    }
                }

                // ========================================
                // ATTACH ACTIVITIES
                // ========================================
                if (!empty($activitySlugs)) {
                    $activityIds = Activity::whereIn('slug', $activitySlugs)->pluck('id')->toArray();
                    if (!empty($activityIds)) {
                        $package->activities()->sync($activityIds);
                        $this->command->info("     📎 Attached " . count($activityIds) . " activities");
                    }
                }

                // ========================================
                // ATTACH ACCOMMODATIONS (with package_level)
                // ========================================
                if (!empty($accommodationData)) {
                    $pivotData = [];
                    foreach ($accommodationData as $acc) {
                        $accommodation = Accommodation::where('slug', $acc['slug'])->first();
                        if ($accommodation) {
                            $pivotData[$accommodation->id] = ['package_level' => $acc['level']];
                        }
                    }
                    if (!empty($pivotData)) {
                        $package->accommodations()->sync($pivotData);
                        $this->command->info("     📎 Attached " . count($pivotData) . " accommodations");
                    }
                }

                // ========================================
                // CREATE ITINERARY
                // ========================================
                $this->command->info("     📌 Creating itinerary...");
                $package->itineraryDays()->delete();

                $itinerary = $this->generateItineraryForPackage($package->slug, $package->duration_days);
                foreach ($itinerary as $day) {
                    ItineraryDay::create([
                        'package_id' => $package->id,
                        'day_number' => $day['day_number'],
                        'title' => $day['title'],
                        'description' => $day['description'],
                        'breakfast' => $day['breakfast'] ?? true,
                        'lunch' => $day['lunch'] ?? true,
                        'dinner' => $day['dinner'] ?? true,
                    ]);
                }
                $this->command->info("     ✅ Itinerary created with " . count($itinerary) . " days");

                // ========================================
                // CREATE INCLUSIONS
                // ========================================
                $this->command->info("     📌 Creating inclusions...");
                $package->inclusions()->delete();
                $inclusions = $this->getInclusionsForPackage($package->slug);
                foreach ($inclusions as $index => $item) {
                    PackageInclusion::create([
                        'package_id' => $package->id,
                        'item' => $item,
                        'display_order' => $index,
                    ]);
                }
                $this->command->info("     ✅ Inclusions added: " . count($inclusions));

                // ========================================
                // CREATE EXCLUSIONS
                // ========================================
                $this->command->info("     📌 Creating exclusions...");
                $package->exclusions()->delete();
                $exclusions = $this->getExclusionsForPackage($package->slug);
                foreach ($exclusions as $index => $item) {
                    PackageExclusion::create([
                        'package_id' => $package->id,
                        'item' => $item,
                        'display_order' => $index,
                    ]);
                }
                $this->command->info("     ✅ Exclusions added: " . count($exclusions));

                $createdPackages[] = $package;
            }

            DB::commit();

            $this->command->info("\n✅ SAFARI PACKAGE SEEDER COMPLETED SUCCESSFULLY! 🎉");
            $this->command->info("📊 Created/Updated " . count($createdPackages) . " packages");

            // ========================================
            // VERIFICATION
            // ========================================
            $this->command->info("\n📋 Verification:");
            $total = SafariPackage::count();
            $this->command->info("  Total Packages: " . $total);
            $this->command->info("  Total Destinations: " . Destination::count());
            $this->command->info("  Total Categories: " . SafariCategory::count());
            $this->command->info("  Total Activities: " . Activity::count());
            $this->command->info("  Total Accommodations: " . Accommodation::count());
            $this->command->info("  Total Itinerary Days: " . ItineraryDay::count());
            $this->command->info("  Total Inclusions: " . PackageInclusion::count());
            $this->command->info("  Total Exclusions: " . PackageExclusion::count());

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Error in seeder: ' . $e->getMessage());
            $this->command->error('   File: ' . $e->getFile() . ' line ' . $e->getLine());
            throw $e;
        }
    }

    /**
     * Generate itinerary for a package based on its slug
     */
    private function generateItineraryForPackage($slug, $durationDays)
    {
        $itineraries = [
            'serengeti-great-migration-safari' => [
                ['day_number' => 1, 'title' => 'Arrival in Arusha', 'description' => 'Arrive at Kilimanjaro International Airport (JRO). Meet your guide and transfer to your hotel in Arusha. Rest and prepare for your safari adventure.'],
                ['day_number' => 2, 'title' => 'Drive to Serengeti National Park', 'description' => 'After breakfast, drive to the Serengeti National Park. Enjoy a scenic drive with a stop at the Ngorongoro Crater viewpoint for stunning photos. Arrive at your lodge in time for sunset.'],
                ['day_number' => 3, 'title' => 'Great Migration Viewing', 'description' => 'Full day game drive in the Serengeti focusing on the Great Migration. Witness thousands of wildebeest and zebras crossing the plains in search of fresh grazing.'],
                ['day_number' => 4, 'title' => 'River Crossing Experience', 'description' => 'Position yourself at the Grumeti or Mara River to witness the dramatic river crossings. Watch as crocodiles lie in wait and the herds make their daring crossing.'],
                ['day_number' => 5, 'title' => 'Central Serengeti Exploration', 'description' => 'Explore the central Serengeti with its abundant wildlife including lions, leopards, elephants, buffalo, and giraffes. Visit the famous Seronera area.'],
                ['day_number' => 6, 'title' => 'Ngorongoro Crater Visit', 'description' => 'Descend into the Ngorongoro Crater, a UNESCO World Heritage site. Spot the Big Five in this unique ecosystem with its diverse wildlife.'],
                ['day_number' => 7, 'title' => 'Departure', 'description' => 'After breakfast, enjoy a game drive en route to Arusha. Transfer to Kilimanjaro Airport for your departure flight.'],
            ],
            'ngorongoro-crater-experience' => [
                ['day_number' => 1, 'title' => 'Arrival and Drive to Ngorongoro', 'description' => 'Arrive at Kilimanjaro Airport and drive to the Ngorongoro Conservation Area. Check in to your camp on the crater rim.'],
                ['day_number' => 2, 'title' => 'Crater Floor Safari', 'description' => 'Descend into the Ngorongoro Crater for a full day of wildlife viewing. See black rhinos, lions, elephants, hippos, and thousands of flamingos.'],
                ['day_number' => 3, 'title' => 'Crater Rim Walk and Maasai Village', 'description' => 'Enjoy a guided walk on the crater rim for spectacular views. Visit a traditional Maasai village to learn about their culture.'],
                ['day_number' => 4, 'title' => 'Departure', 'description' => 'After breakfast, depart to Arusha for your onward journey.'],
            ],
            'zanzibar-beach-holiday' => [
                ['day_number' => 1, 'title' => 'Arrival in Zanzibar', 'description' => 'Arrive at Zanzibar International Airport and transfer to your beach resort. Relax and enjoy the beautiful Indian Ocean.'],
                ['day_number' => 2, 'title' => 'Stone Town Tour', 'description' => 'Explore the historic Stone Town, a UNESCO World Heritage site. Visit the House of Wonders, Old Fort, and the Sultan\'s Palace.'],
                ['day_number' => 3, 'title' => 'Spice Tour', 'description' => 'Take a spice tour to see the plantations that made Zanzibar famous. Learn about cloves, nutmeg, cinnamon, and other spices.'],
                ['day_number' => 4, 'title' => 'Beach Day', 'description' => 'Full day to relax on the pristine white sand beaches. Optional activities include snorkeling, scuba diving, and sailing.'],
                ['day_number' => 5, 'title' => 'Departure', 'description' => 'Transfer to Zanzibar International Airport for your departure flight.'],
            ],
            'tanzania-explorer-safari' => [
                ['day_number' => 1, 'title' => 'Arrival in Arusha', 'description' => 'Arrive at Kilimanjaro Airport and transfer to your hotel in Arusha.'],
                ['day_number' => 2, 'title' => 'Lake Manyara National Park', 'description' => 'Drive to Lake Manyara National Park for game viewing. Famous for tree-climbing lions and abundant birdlife.'],
                ['day_number' => 3, 'title' => 'Drive to Serengeti', 'description' => 'Drive through the Ngorongoro Conservation Area to the Serengeti. Enjoy game viewing en route.'],
                ['day_number' => 4, 'title' => 'Serengeti Game Drive', 'description' => 'Full day exploring the Serengeti. Spot the Big Five and the Great Migration.'],
                ['day_number' => 5, 'title' => 'Serengeti to Ngorongoro', 'description' => 'Morning game drive in the Serengeti, then drive to the Ngorongoro Conservation Area.'],
                ['day_number' => 6, 'title' => 'Ngorongoro Crater', 'description' => 'Descend into the Ngorongoro Crater for amazing wildlife viewing.'],
                ['day_number' => 7, 'title' => 'Tarangire National Park', 'description' => 'Drive to Tarangire National Park, known for its huge elephant herds and baobab trees.'],
                ['day_number' => 8, 'title' => 'Tarangire Game Drive', 'description' => 'Full day game drive in Tarangire National Park.'],
                ['day_number' => 9, 'title' => 'Drive to Arusha', 'description' => 'Morning game drive in Tarangire, then drive to Arusha.'],
                ['day_number' => 10, 'title' => 'Departure', 'description' => 'Transfer to Kilimanjaro Airport for your departure flight.'],
            ],
            'luxury-serengeti-zanzibar' => [
                ['day_number' => 1, 'title' => 'Arrival in Arusha', 'description' => 'Arrive at Kilimanjaro Airport. Private transfer to your luxury hotel in Arusha.'],
                ['day_number' => 2, 'title' => 'Flight to Serengeti', 'description' => 'Take a scenic flight to the Serengeti. Enjoy a game drive en route to your luxury lodge.'],
                ['day_number' => 3, 'title' => 'Private Game Drive', 'description' => 'Exclusive private game drive with your personal guide. Focus on the Great Migration.'],
                ['day_number' => 4, 'title' => 'Hot Air Balloon Safari', 'description' => 'Early morning hot air balloon safari over the Serengeti, followed by champagne breakfast.'],
                ['day_number' => 5, 'title' => 'Fly to Zanzibar', 'description' => 'Fly from Serengeti to Zanzibar. Transfer to your luxury beach resort.'],
                ['day_number' => 6, 'title' => 'Relaxation Day', 'description' => 'Full day to relax, enjoy the spa, and explore the beautiful beaches.'],
                ['day_number' => 7, 'title' => 'Private Dhow Cruise', 'description' => 'Exclusive private dhow cruise with snorkeling and seafood lunch.'],
                ['day_number' => 8, 'title' => 'Stone Town and Spice Tour', 'description' => 'Private tour of Stone Town and spice plantations.'],
                ['day_number' => 9, 'title' => 'Beach Day', 'description' => 'Another day of luxury relaxation by the Indian Ocean.'],
                ['day_number' => 10, 'title' => 'Sunset Cruise', 'description' => 'Private sunset dhow cruise with champagne and canapés.'],
                ['day_number' => 11, 'title' => 'Leisure Day', 'description' => 'Your final day to relax and enjoy the resort facilities.'],
                ['day_number' => 12, 'title' => 'Departure', 'description' => 'Transfer to Zanzibar Airport for your departure flight.'],
            ],
            'budget-serengeti-safari' => [
                ['day_number' => 1, 'title' => 'Arrival and Drive to Serengeti', 'description' => 'Arrive at Kilimanjaro Airport and drive to the Serengeti with a packed lunch.'],
                ['day_number' => 2, 'title' => 'Serengeti Game Drive', 'description' => 'Full day game drive in the Serengeti. Look out for the Big Five and the Great Migration.'],
                ['day_number' => 3, 'title' => 'More Serengeti Exploration', 'description' => 'Another full day exploring the Serengeti. Visit the Seronera River for excellent wildlife viewing.'],
                ['day_number' => 4, 'title' => 'Drive to Arusha', 'description' => 'Morning game drive in the Serengeti, then drive to Arusha.'],
                ['day_number' => 5, 'title' => 'Departure', 'description' => 'Transfer to Kilimanjaro Airport for your departure flight.'],
            ],
        ];

        // Default itinerary if specific one doesn't exist
        $defaultItinerary = [];
        for ($i = 1; $i <= $durationDays; $i++) {
            $defaultItinerary[] = [
                'day_number' => $i,
                'title' => "Day {$i} - Safari Exploration",
                'description' => "Enjoy a full day of safari exploration with your experienced guide.",
                'breakfast' => true,
                'lunch' => true,
                'dinner' => true,
            ];
        }

        return $itineraries[$slug] ?? $defaultItinerary;
    }

    /**
     * Get inclusions for a package based on its slug
     */
    private function getInclusionsForPackage($slug)
    {
        $baseInclusions = [
            'Accommodation as per itinerary',
            'All meals (breakfast, lunch, dinner)',
            'Professional safari guide/driver',
            'Game drives in a 4x4 vehicle',
            'Park entrance fees',
            'Water and soft drinks during game drives',
        ];

        $packageSpecific = [
            'serengeti-great-migration-safari' => [
                'Bottled water in the vehicle',
                'Private safari experience',
                'Comfortable safari vehicle with pop-up roof',
            ],
            'luxury-serengeti-zanzibar' => [
                'Private flights between Serengeti and Zanzibar',
                'Personal butler service',
                'Premium beverages and champagne',
                'Spa treatments',
                'Private vehicle and guide',
            ],
            'budget-serengeti-safari' => [
                'Camping equipment',
                'Group safari experience',
                'Simple meals',
            ],
            'tanzania-explorer-safari' => [
                'All mentioned park fees',
                'Guided game drives',
                'Cultural village visits',
            ],
        ];

        $extra = $packageSpecific[$slug] ?? [];
        return array_merge($baseInclusions, $extra);
    }

    /**
     * Get exclusions for a package based on its slug
     */
    private function getExclusionsForPackage($slug)
    {
        $baseExclusions = [
            'International flights',
            'Visa fees',
            'Travel insurance',
            'Gratuities for guide and staff',
            'Alcoholic beverages',
            'Personal expenses (souvenirs, laundry, etc.)',
        ];

        $packageSpecific = [
            'luxury-serengeti-zanzibar' => [
                'Premium alcohol (some premium brands may be extra)',
                'Additional spa services',
                'Private boat charters not included in itinerary',
            ],
            'budget-serengeti-safari' => [
                'Sleeping bags (available for rent)',
                'Personal camping gear',
                'Snacks and drinks outside meal times',
            ],
        ];

        $extra = $packageSpecific[$slug] ?? [];
        return array_merge($baseExclusions, $extra);
    }
}