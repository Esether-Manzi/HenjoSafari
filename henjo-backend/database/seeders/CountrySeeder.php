<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Tanzania', 'code' => 'TZ'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'Uganda', 'code' => 'UG'],
            ['name' => 'Rwanda', 'code' => 'RW'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                $country
            );
        }

        // South Africa is no longer an offered destination — remove any
        // leftover row (and, via cascade, its destinations) on reseed.
        Country::whereIn('code', ['ZA'])->delete();

        $this->command->info('✅ Countries seeded!');
    }
}