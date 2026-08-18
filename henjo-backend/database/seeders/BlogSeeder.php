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

        // Real posts (henjosafaris-content-audit.md §5.6 — the old WordPress
        // blog only ever had these 2 real articles, both travel/visa guides).
        $posts = [
            [
                'title' => 'East Africa Tourist Visa guide',
                'slug' => 'east-africa-tourist-visa-guide',
                'excerpt' => 'Everything you need to know about the Joint East Africa Tourist Visa covering Uganda, Kenya, and Rwanda.',
                'content' => "This is a Joint Tourist Visa and it allows the traveler to travel to Uganda, Kenya, and Rwanda ONLY. It can be used multiple times for tourism purposes. The visa prohibits employment and is issued only for tourism purposes. The visa is valid for 90 days and is not renewable upon expiry or upon exit from the block (Kenya, Uganda, Rwanda).\n\nNB: The issuing country should be your first entry point.\n\n## Where to apply\n\nThe visas are available online through: https://www.visas.immigration.go.ug/#/apply\n\n## Requirements / Attachments\n\n- Copy of the passport (Bio-data page) with at least 6 months validity\n- Copy of recent Passport size Photograph\n- Vaccination Certificate (Yellow fever)\n- Return Ticket\n- Travel Itinerary",
                'featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'tags' => ['travel-guide'],
            ],
            [
                'title' => 'Entry Requirements For Uganda',
                'slug' => 'entry-requirements-for-uganda',
                'excerpt' => 'What you need for a single-entry Uganda tourist visa.',
                'content' => "**Uganda Tourist Visa – Single Entry.** This visa is granted to travelers coming to Uganda for tourism. This is a single-entry visa and can be granted for up to 3 months.\n\n## Where to apply\n\nThe visas are available online through: https://www.visas.immigration.go.ug/#/apply\n\n## Requirements\n\n- Passport copy (bio-data page) with at least 6 months validity\n- Tour Plan\n- Travel itinerary/booking\n- Recent Passport-size Photograph\n- Vaccination Certificate (Yellow Fever)",
                'featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'tags' => ['travel-guide'],
            ],
        ];

        // Remove earlier generic Tanzania-template posts (replaced by the 2 real articles above)
        Post::whereIn('slug', [
            'great-migration-complete-guide',
            'top-10-safari-destinations-tanzania',
            'guide-zanzibar-beaches-culture',
            'conservation-success-stories-tanzania',
            'what-to-pack-safari-tanzania',
        ])->delete();

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

