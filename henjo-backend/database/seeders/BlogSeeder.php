<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('📝 Creating Blog Content...');

        // Create author if doesn't exist
        $author = User::first();
        if (!$author) {
            $author = User::create([
                'name' => 'Admin Author',
                'email' => 'admin@henjosafaris.com',
                'password' => Hash::make('password'),
                'country' => 'Tanzania',
            ]);
            $this->command->info('  ✅ Author created: ' . $author->name);
        }

        // Create Tags
        $tags = [
            ['name' => 'Safari Tips', 'slug' => 'safari-tips'],
            ['name' => 'Wildlife', 'slug' => 'wildlife'],
            ['name' => 'Destinations', 'slug' => 'destinations'],
            ['name' => 'Travel Guide', 'slug' => 'travel-guide'],
            ['name' => 'Culture', 'slug' => 'culture'],
            ['name' => 'Conservation', 'slug' => 'conservation'],
        ];

        $tagModels = [];
        foreach ($tags as $tagData) {
            $tag = Tag::updateOrCreate(
                ['slug' => $tagData['slug']],
                $tagData
            );
            $tagModels[] = $tag;
            $this->command->info('  ✅ Tag: ' . $tag->name);
        }

        // Create Posts
        $posts = [
            [
                'title' => 'The Great Migration: A Complete Guide',
                'slug' => 'great-migration-complete-guide',
                'excerpt' => 'Everything you need to know about witnessing the greatest wildlife spectacle on earth.',
                'content' => "The Great Migration is one of the most spectacular wildlife events on the planet. Each year, over 1.5 million wildebeest and 250,000 zebras make their way across the Serengeti in search of fresh grazing.\n\n## When to Visit\n\nThe best time to witness the migration is between June and October when the herds cross the Grumeti and Mara rivers.\n\n## Where to Stay\n\nThere are numerous lodges and camps along the migration route offering incredible viewing opportunities.\n\n## Tips for Photographers\n\n- Bring a telephoto lens (300mm or longer)\n- Early morning and late afternoon offer the best light\n- Be patient - the river crossings can take hours",
                'featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'tags' => ['wildlife', 'safari-tips', 'destinations'],
            ],
            [
                'title' => 'Top 10 Safari Destinations in Tanzania',
                'slug' => 'top-10-safari-destinations-tanzania',
                'excerpt' => 'Discover the most incredible safari destinations Tanzania has to offer.',
                'content' => "Tanzania is home to some of the most incredible wildlife destinations in Africa. From the endless plains of the Serengeti to the lush forests of the Mahale Mountains.\n\n## 1. Serengeti National Park\n\nThe Serengeti is Tanzania's most famous park, known for the Great Migration and incredible predator sightings.\n\n## 2. Ngorongoro Crater\n\nOften called the 'Garden of Eden,' this UNESCO World Heritage site offers incredible wildlife viewing in a unique setting.\n\n## 3. Tarangire National Park\n\nFamous for its massive elephant herds and iconic baobab trees.\n\n## 4. Lake Manyara National Park\n\nKnown for tree-climbing lions and abundant birdlife.\n\n## 5. Selous Game Reserve\n\nOne of Africa's largest protected areas, offering boat safaris and walking experiences.",
                'featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'tags' => ['destinations', 'travel-guide'],
            ],
            [
                'title' => 'A Guide to Zanzibar Beaches and Culture',
                'slug' => 'guide-zanzibar-beaches-culture',
                'excerpt' => 'Explore the stunning beaches and rich cultural heritage of Zanzibar.',
                'content' => "Zanzibar is an archipelago off the coast of Tanzania known for its beautiful beaches and rich history.\n\n## Stone Town\n\nThis UNESCO World Heritage site is the historic heart of Zanzibar, with winding alleys and beautiful architecture.\n\n## Beaches\n\n- Nungwi Beach - The most famous beach with turquoise waters\n- Kendwa Beach - Known for its beautiful sunsets\n- Paje Beach - Perfect for kite surfing\n\n## Culture\n\nZanzibar has a unique Swahili culture, influenced by African, Arab, and European traditions.",
                'featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'tags' => ['destinations', 'culture', 'travel-guide'],
            ],
            [
                'title' => 'Conservation Success Stories in Tanzania',
                'slug' => 'conservation-success-stories-tanzania',
                'excerpt' => 'Learn about the incredible conservation efforts protecting Tanzania\'s wildlife.',
                'content' => "Tanzania has made significant progress in wildlife conservation over the past decades.\n\n## The Great Migration Protection\n\nConservation efforts have helped maintain the migration corridors essential for the wildebeest and zebras.\n\n## Anti-Poaching Initiatives\n\nSuccess stories include the recovery of black rhino populations and elephant protection efforts.\n\n## Community Conservation\n\nMany communities are now benefiting from conservation through tourism partnerships.",
                'featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(15),
                'tags' => ['conservation', 'wildlife'],
            ],
            [
                'title' => 'What to Pack for a Safari in Tanzania',
                'slug' => 'what-to-pack-safari-tanzania',
                'excerpt' => 'Essential items to bring on your Tanzanian safari adventure.',
                'content' => "Packing properly can make your safari experience much more comfortable and enjoyable.\n\n## Clothing\n\n- Neutral colors (khaki, beige, olive green)\n- Long-sleeved shirts and pants for sun protection\n- Warm layers for early morning game drives\n- Comfortable walking shoes\n\n## Equipment\n\n- Binoculars\n- Camera with telephoto lens\n- Power bank\n- Headlamp or torch\n\n## Other Essentials\n\n- Sunscreen and insect repellent\n- Hat and sunglasses\n- Reusable water bottle\n- First aid kit\n- Travel documents and vaccination certificate",
                'featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'tags' => ['safari-tips', 'travel-guide'],
            ],
        ];

        foreach ($posts as $postData) {
            $tagSlugs = $postData['tags'];
            unset($postData['tags']);

            // Remove any fields that don't exist in the database
            unset($postData['views']); // Make sure views is not in the data

            $post = Post::updateOrCreate(
                ['slug' => $postData['slug']],
                array_merge($postData, ['author_id' => $author->id])
            );

            // Attach tags
            $tagIds = Tag::whereIn('slug', $tagSlugs)->pluck('id')->toArray();
            if (!empty($tagIds)) {
                $post->tags()->sync($tagIds);
            }

            $this->command->info("  ✅ Post: {$post->title}");
        }

        $this->command->info('✅ Blog content seeded successfully!');
    }
}

