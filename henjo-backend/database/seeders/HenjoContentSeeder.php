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
                'content' => "BOOKING POLICY:\n\nA 30% deposit is required to confirm your booking within 7 days of written confirmation, otherwise the booking is treated as provisional only, with the possible inability to reinstate the reservation. After confirmation, the 30% deposit is paid and the booking is taken as confirmed. One calendar month before the commencement of the safari, the remaining 70% of the total safari cost is paid. The above is at the discretion of Henjo African Safaris Ltd.\n\nSPECIAL REQUIREMENTS AND INSURANCE:\n\nClients' incoming travel insurance is covered by Henjo African Safaris for 12 days while on safari. If the client is fully covered by their own insurance, details should be forwarded at least 4 weeks before the commencement of the safari. Any medical conditions should be mentioned.\n\nTERMS & CONDITIONS — CANCELLATIONS:\n\nBefore cancellation, Henjo African Safaris and the client will discuss the possibility of rescheduling. Cancellations must be made in writing and are only effective upon acknowledged receipt by Henjo African Safaris.\n\nCancellation penalty schedule:\n- 30 days or more before commencement (remaining 70% due): 5% forfeit of the 30% deposit.\n- 60 days or more before commencement: forfeit 20%.\n- Less than 60 days before commencement: forfeit 50% of the package price.\n- Less than 30 days before commencement: forfeit 100% of the package price.\n\nCHILDREN:\n\nChildren are welcome on our safaris. We offer kids below 5 years a free spot (one kid per group) and a 25% discount for 6-12 year-olds.",
            ],
            [
                'title' => 'Travel Information',
                'slug' => 'travel-information',
                'is_active' => true,
                'content' => "Africa is extraordinary and her people evoke a sense of adventure, romance and deep connection to nature. Find reliable travel information from Henjo African Safaris as you dive into the true essence of Africa.\n\nEAST AFRICA TOURIST VISA GUIDE:\n\nThis is a Joint Tourist Visa and it allows the traveler to travel to Uganda, Kenya, and Rwanda ONLY. It can be used multiple times for tourism purposes. The visa prohibits employment and is issued only for tourism purposes. The visa is valid for 90 days and is not renewable upon expiry or upon exit from the block. NB: the issuing country should be your first entry point. Apply online at visas.immigration.go.ug. Requirements: copy of the passport (bio-data page) with at least 6 months validity, a recent passport-size photograph, a Yellow Fever vaccination certificate, a return ticket, and a travel itinerary.\n\nENTRY REQUIREMENTS FOR UGANDA:\n\nUganda Tourist Visa – Single Entry. This visa is granted to travelers coming to Uganda for tourism, is a single-entry visa, and can be granted for up to 3 months. Apply online at visas.immigration.go.ug. Requirements: passport copy (bio-data page) with at least 6 months validity, a tour plan, travel itinerary/booking, a recent passport-size photograph, and a Yellow Fever vaccination certificate.",
            ],
            [
                'title' => 'Women only tours to Uganda, Rwanda & Kenya',
                'slug' => 'women-only-tours',
                'is_active' => true,
                'content' => "Our Women-only travel packages offer a safe and empowering way for women to explore Uganda, Kenya & Rwanda on their terms. These packages enable our clients to feel a sense of security and safety. Henjo African Safaris offers security measures such as women-only attendants in accommodations and transportation, as well as local female guides and support networks in the destinations they visit. This can give women the confidence to travel to destinations that may be considered unsafe for solo female travelers.\n\nChoosing women-only travel packages offers the opportunity to connect with other like-minded women and provides a supportive and empowering environment where women can bond and make lasting friendships — particularly beneficial for women traveling solo who may feel lonely or isolated.\n\nIn addition to the safety and social aspects, women-only travel packages also offer unique travel experiences tailored to the interests and needs of women, including wellness retreats, cultural immersion experiences, adventure sports, and teenage girls' menstrual health programs. We work with local female-owned businesses and organizations to provide authentic and empowering travel experiences.",
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. Team Members (real Henjo staff, per henjosafaris-content-audit.md §3.3/§3.5/§7)
        $team = [
            [
                'name' => 'Henry Katinda',
                'position' => 'Founder / CEO',
                'bio' => "My passion for tourism began at the age of 18 when I worked as a part time Tour guide at the source of the Nile in Jinja. This experience ignited a deep love for African wildlife and the incredible landscapes that make the continent so unique.\n\nDriven by a desire to share my passion with others, I founded Henjo African Safaris to provide personalized, high-quality tours that showcase the beauty and diversity of East Africa. With a focus on responsible tourism, the company works closely with local communities and conservation organizations to ensure that its tours have a positive impact on both the environment and the people who call them home.\n\nAs a strong advocate for women's empowerment, I am proud that 90% of our employees (both directly and indirectly) are women. I believe that providing opportunities for women to succeed in the tourism industry is crucial to creating a more equitable and sustainable future for Africa.\n\nIn addition to running the safari company, I also founded the Empathy Children Initiative (empathychildren.org), a charity that helps 50 vulnerable children in Mayuge District, Eastern Uganda acquire education, helps single moms and widows with micro-revolving loans to start up their own business ventures, and helps teenage girls from vulnerable backgrounds with sanitary towels. 40% of the earnings from the safari company are directed towards these initiatives.\n\nThrough my commitment to responsible tourism, women's empowerment, and community development, I have established myself as a leader in the safari industry.",
                'email' => 'info@henjosafaris.com',
                'phone' => '+256779557514',
                'is_active' => true,
            ],
            [
                'name' => 'Claire Robinah',
                'position' => 'Head Guide',
                'bio' => 'Claire leads Henjo African Safaris\' guiding team across Uganda, Kenya, and Rwanda, bringing hands-on field experience to every itinerary.',
                'email' => 'info@henjosafaris.com',
                'phone' => '+256779557514',
                'is_active' => true,
            ],
            [
                'name' => 'Magemeso Faziri',
                'position' => 'Driver',
                'bio' => 'Magemeso is one of Henjo African Safaris\' professional driver-guides, ensuring safe and comfortable travel throughout every safari.',
                'email' => 'info@henjosafaris.com',
                'phone' => '+256779557514',
                'is_active' => true,
            ],
        ];

        // Remove earlier fabricated placeholder team members (replaced by the real roster above),
        // plus Joan Tusubira — removed from the site at the client's request.
        TeamMember::whereIn('name', ['Henry Mukasa', 'Joan Nampijja', 'Joan Tusubira'])->delete();

        foreach ($team as $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], $member);
        }

        $this->command->info('✅ Henjo Static Pages & Team Members Seeded!');
    }
}
