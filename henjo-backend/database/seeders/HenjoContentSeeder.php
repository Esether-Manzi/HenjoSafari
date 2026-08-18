<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\TeamMember;

class HenjoContentSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('📌 Seeding Static Pages & Team Members...');

        // 1. Pages
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'is_active' => true,
                'content' => 'Henjo African Safaris Ltd is a registered Ugandan Tour Agency offering bespoke safaris, tailor-made holidays, authentic luxury African safaris, fly-in safaris, and mountain gorilla tracking. The combination of our experienced team of travel consultants and certified driver-guides assures a safe, treasurable, thrilling, and informative safari across Uganda, Kenya, Tanzania, and Rwanda.',
            ],
            [
                'title' => 'About Our Charity',
                'slug' => 'about-our-charity',
                'is_active' => true,
                'content' => 'At Henjo African Safaris, we believe in giving back to the local communities that host our safari adventures. A percentage of every safari booking goes directly toward supporting local community projects, child education initiatives, clean water access, and wildlife conservation education in rural East Africa.',
            ],
            [
                'title' => 'Booking Policy',
                'slug' => 'booking-policy',
                'is_active' => true,
                'content' => "BOOKING AND PAYMENT TERMS:\n\n1. Reservations: A 30% deposit is required at the time of booking confirmation. Gorilla and Chimpanzee permits must be paid 100% in advance as required by wildlife authorities.\n\n2. Final Payment: The remaining balance is due 30 days prior to the safari start date.\n\n3. Cancellation Policy:\n- 60+ days prior: Full refund minus administrative fee and non-refundable permit fees.\n- 30-59 days prior: 50% refund.\n- Less than 30 days prior: No refund.\n\n4. Insurance: All clients are strongly advised to hold comprehensive travel, medical, and cancellation insurance.",
            ],
            [
                'title' => 'Travel Information',
                'slug' => 'travel-information',
                'is_active' => true,
                'content' => "TRAVEL INFORMATION FOR EAST AFRICA:\n\n- Visas: Single East Africa Tourist Visa covers Uganda, Kenya, and Rwanda. Visas can be applied for online (E-Visa).\n- Health: Yellow Fever vaccination certificate is mandatory. Anti-malaria medication is recommended.\n- Currency: US Dollars (USD) printed after 2013 are widely accepted alongside local currencies (UGX, KES, TZS, RWF).\n- Weather: Tropical climate with dry seasons from June to September and December to February.",
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. Team Members
        $team = [
            [
                'name' => 'Henry Mukasa',
                'position' => 'Managing Director & Tour Lead',
                'bio' => 'Over 12 years experience designing tailor-made luxury safaris and gorilla trekking experiences across East Africa.',
                'email' => 'info@henjosafaris.com',
                'phone' => '+256779557514',
                'is_active' => true,
            ],
            [
                'name' => 'Joan Nampijja',
                'position' => 'Senior Travel Consultant',
                'bio' => 'Passionate about custom safari itineraries, birding tours, and customer service excellence.',
                'email' => 'info@henjosafaris.com',
                'phone' => '+256779557514',
                'is_active' => true,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], $member);
        }

        $this->command->info('✅ Henjo Static Pages & Team Members Seeded!');
    }
}
