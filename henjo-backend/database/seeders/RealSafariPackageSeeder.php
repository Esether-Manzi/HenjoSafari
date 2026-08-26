<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\ItineraryDay;
use App\Models\PackageExclusion;
use App\Models\PackageInclusion;
use App\Models\SafariCategory;
use App\Models\SafariPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Replaces all seeded/placeholder safari packages with 80 real, fully-detailed
 * packages (20 per country) sourced from SafariBookings.com, per the client's
 * audit documents. See henjo-safaris-content-migration notes: this data was
 * parsed from 4 .docx files into database/seeders/data/real_safari_packages.json
 * ahead of time — this seeder just imports it.
 */
class RealSafariPackageSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/real_safari_packages.json');
        $packages = json_decode(file_get_contents($path), true);

        $this->wipeExistingPackages();
        $destinationIds = Destination::pluck('id', 'slug');
        $categoryIds = SafariCategory::pluck('id', 'slug');

        foreach ($packages as $data) {
            $destinationId = $destinationIds[$data['destination_slug']] ?? null;
            if (!$destinationId) {
                $this->command->warn("Skipping '{$data['title']}' — unknown destination slug '{$data['destination_slug']}'");
                continue;
            }

            $package = SafariPackage::create([
                'destination_id' => $destinationId,
                'title' => $data['title'],
                'summary' => $data['summary'],
                'description' => $data['description'],
                'duration_days' => $data['duration_days'],
                'duration_nights' => $data['duration_nights'],
                'base_price' => $data['base_price'],
                'price_max' => $data['price_max'],
                'currency' => $data['currency'],
                'min_people' => $data['min_people'],
                'max_people' => $data['max_people'],
                'min_age' => $data['min_age'],
                'tour_privacy' => $data['tour_privacy'],
                'comfort_level' => $data['comfort_level'],
                'accommodation_style' => $data['accommodation_style'],
                'customizable' => $data['customizable'],
                'solo_travelers_ok' => $data['solo_travelers_ok'],
                'start_flexibility' => $data['start_flexibility'],
                'featured' => $data['featured'],
                'popular' => $data['popular'],
                'status' => $data['status'],
            ]);

            $activityIds = collect($data['activities'])->map(
                fn ($a) => $this->resolveActivityId($a['name'], $a['slug'])
            )->filter()->values()->all();
            $package->activities()->sync($activityIds);

            $categorySlugIds = collect($data['categories'])
                ->map(fn ($slug) => $categoryIds[$slug] ?? null)
                ->filter()->values()->all();
            $package->categories()->sync($categorySlugIds);

            foreach ($data['itinerary'] as $day) {
                ItineraryDay::create([
                    'package_id' => $package->id,
                    'day_number' => $day['day_number'],
                    'day_number_end' => $day['day_number_end'],
                    'destination' => $day['destination'],
                    'title' => $day['title'],
                    'description' => $day['description'],
                    'accommodation' => $day['accommodation'],
                    'breakfast' => $day['breakfast'],
                    'lunch' => $day['lunch'],
                    'dinner' => $day['dinner'],
                ]);
            }

            foreach ($data['inclusions'] as $i => $item) {
                PackageInclusion::create(['package_id' => $package->id, 'item' => $item, 'display_order' => $i]);
            }
            foreach ($data['exclusions'] as $i => $item) {
                PackageExclusion::create(['package_id' => $package->id, 'item' => $item, 'display_order' => $i]);
            }

            if ($data['destination_slug'] === 'uganda') {
                $this->attachCoverImage($package, $data['title']);
            }
        }

        $this->command->info('✅ ' . count($packages) . ' real safari packages seeded!');
    }

    /**
     * Reuse an existing Activity by its known slug (matches ActivitySeeder's
     * curated/featured set); otherwise create the new canonical activity,
     * unfeatured by default so the homepage showcase stays curated.
     */
    protected function resolveActivityId(string $name, ?string $knownSlug): ?int
    {
        $slug = $knownSlug ?? Str::slug($name);

        // withTrashed(): a couple of these slugs (e.g. 'photography') were
        // soft-deleted by an earlier content pass and would otherwise still
        // collide with the slug's unique constraint on a plain insert.
        $activity = Activity::withTrashed()->where('slug', $slug)->first();

        if ($activity) {
            if ($activity->trashed()) {
                $activity->restore();
            }
            $activity->update(['name' => $name]);
        } else {
            $activity = Activity::create(['slug' => $slug, 'name' => $name, 'featured' => false]);
        }

        return $activity->id;
    }

    /**
     * Uganda packages ship with real cover photos (client-supplied, matched
     * by exact title to database/seeders/data/uganda_package_covers.json).
     * Any Uganda package without a matching photo falls back to the
     * chimpanzee-trekking placeholder rather than the generic silhouette.
     */
    protected function attachCoverImage(SafariPackage $package, string $title): void
    {
        static $covers = null;
        $covers ??= json_decode(
            file_get_contents(database_path('seeders/data/uganda_package_covers.json')),
            true
        );

        $filename = $covers[$title] ?? null;
        $path = $filename
            ? public_path('images/safaris/' . $filename)
            : public_path('images/safaris/chimpanzee-trekking-fallback.jpg');

        if (!file_exists($path)) {
            $this->command->warn("Cover image missing on disk for '{$title}': {$path}");
            return;
        }

        $package->addMedia($path)->preservingOriginal()->toMediaCollection('cover');
    }

    protected function wipeExistingPackages(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Bookings/inquiries survive — just lose their package association,
        // matching the existing nullOnDelete FK behavior.
        DB::table('bookings')->whereNotNull('package_id')->update(['package_id' => null]);
        DB::table('inquiries')->whereNotNull('package_id')->update(['package_id' => null]);

        DB::table('itinerary_days')->truncate();
        DB::table('package_inclusions')->truncate();
        DB::table('package_exclusions')->truncate();
        DB::table('package_activity')->truncate();
        DB::table('package_category')->truncate();
        DB::table('package_accommodation')->truncate();
        DB::table('media')->where('model_type', SafariPackage::class)->delete();
        DB::table('safari_packages')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
