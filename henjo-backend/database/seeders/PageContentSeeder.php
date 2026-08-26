<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run()
    {
        $this->seedSiteSettings();
        $this->seedMenus();
        $this->seedPages();

        $this->command->info('✅ Site settings, menus, and pages seeded!');
    }

    protected function seedSiteSettings(): void
    {
        $settings = SiteSetting::current();
        $settings->update([
            'site_name' => 'Henjo African Safaris',
            'tagline' => 'Every day with us is an adventure',
            'email' => 'info@henjosafaris.com',
            'phone' => '+256 779 557 514',
            'address' => 'Plot 402, Seguku, Entebbe, Box 700589, Entebbe, Uganda',
            'working_hours_weekday' => 'Mon - Fri: 8:00 AM - 6:00 PM (EAT)',
            'working_hours_saturday' => 'Sat: 9:00 AM - 4:00 PM (EAT)',
            'facebook_url' => 'https://www.facebook.com/share/1JMp2DU53k/?mibextid=wwXIfr',
            'twitter_url' => 'https://x.com/henjosafaris?s=11',
            'instagram_url' => 'https://www.instagram.com/henjo.african.safaris?igsi=MTlzaDNkdDc4NDZncg%3D%3D&utm_source=qr',
            'linkedin_url' => 'https://www.linkedin.com/company/henjo-african-safaris/',
            'youtube_url' => 'https://youtube.com/henjosafaris',
            'tripadvisor_url' => 'https://www.tripadvisor.com/Attraction_Review-g293841-d25282203-Reviews-Henjo_African_Safaris-Kampala_Central_Region.html',
            'payment_url' => 'https://payments.pesapal.com/henjoafricansafaris',
            'years_experience' => '5+',
            'happy_travelers_count' => '500+',
            'average_rating' => '4.9',
            'footer_tagline' => 'Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda. Bespoke tours, tailor-made holidays, and luxury experiences.',
        ]);

        $heroVideoPath = public_path('videos/home-page-hero-section.mp4');
        if (file_exists($heroVideoPath)) {
            $settings->clearMediaCollection('homepage_hero');
            $settings->addMedia($heroVideoPath)
                ->preservingOriginal()
                ->toMediaCollection('homepage_hero');
        }
    }

    protected function seedMenus(): void
    {
        Menu::query()->delete();

        $this->seedMenuTree('navbar', [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Safaris', 'url' => '/safaris', 'children' => [
                ['label' => 'Wildlife Adventure', 'url' => '/safaris?category=wildlife-adventure'],
                ['label' => 'Gorilla Trekking', 'url' => '/safaris?category=gorilla-safaris'],
                ['label' => 'Fly In Safaris', 'url' => '/safaris?category=flying'],
                ['label' => 'Mountaineering', 'url' => '/safaris?category=mountaineering'],
                ['label' => 'Cultural Tour', 'url' => '/safaris?category=cultural-tour'],
                ['label' => 'Women Only Tours', 'url' => '/women-only-tours'],
                ['label' => 'City Tours', 'url' => '/safaris?category=city-tours'],
                ['label' => 'Day Tours', 'url' => '/safaris?category=day-tours'],
            ]],
            ['label' => 'Women Only Tours', 'url' => '/women-only-tours'],
            ['label' => 'Destinations', 'url' => '/destinations', 'children' => [
                ['label' => 'Kenya', 'url' => '/destinations/kenya'],
                ['label' => 'Tanzania', 'url' => '/destinations/tanzania'],
                ['label' => 'Uganda', 'url' => '/destinations/uganda'],
                ['label' => 'Rwanda', 'url' => '/destinations/rwanda'],
            ]],
            ['label' => 'Travel Information', 'url' => '/travel-information'],
            ['label' => 'About Us', 'url' => '/about', 'children' => [
                ['label' => 'About Our Charity', 'url' => '/about-our-charity'],
                ['label' => 'Our Team', 'url' => '/our-team'],
                ['label' => 'Booking Policy', 'url' => '/booking-policy'],
            ]],
            ['label' => 'Contact', 'url' => '/contact'],
        ]);

        $this->seedMenuTree('footer', [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Kenya Safaris', 'url' => '/safaris'],
            ['label' => 'Uganda Safaris', 'url' => '/safaris'],
            ['label' => 'Gorilla Trekking', 'url' => '/safaris?category=gorilla'],
            ['label' => 'Tanzania Safaris', 'url' => '/safaris'],
            ['label' => 'Rwanda Safaris', 'url' => '/safaris'],
            ['label' => 'Book Schedule A Meeting', 'url' => '/booking'],
            ['label' => 'Pay Online', 'url' => 'https://payments.pesapal.com/henjoafricansafaris'],
        ]);
    }

    protected function seedMenuTree(string $location, array $items): void
    {
        foreach ($items as $index => $item) {
            $menu = Menu::create([
                'location' => $location,
                'label' => $item['label'],
                'url' => $item['url'],
                'parent_id' => null,
                'sort_order' => $index,
                'is_active' => true,
            ]);

            foreach ($item['children'] ?? [] as $childIndex => $child) {
                Menu::create([
                    'location' => $location,
                    'label' => $child['label'],
                    'url' => $child['url'],
                    'parent_id' => $menu->id,
                    'sort_order' => $childIndex,
                    'is_active' => true,
                ]);
            }
        }
    }

    protected function seedPages(): void
    {
        Page::updateOrCreate(['slug' => 'home'], [
            'title' => 'Home',
            'hero_title' => 'Discover the Wild Side of East Africa',
            'hero_subtitle' => 'Bespoke safaris, gorilla trekking, and tailor-made holidays across Uganda, Kenya, Tanzania, and Rwanda.',
            'hero_cta_text' => 'Explore Safaris',
            'hero_cta_href' => '/safaris',
            'meta_title' => 'Henjo African Safaris | Bespoke East Africa Tours',
            'meta_description' => 'Explore the beauty of East Africa with our expert-guided safaris across Uganda, Kenya, Tanzania, and Rwanda.',
            'sections' => [
                ['group' => 'intro', 'title' => 'Well organized tours to elevate your spirit!', 'description' => 'The combination of our experienced team of travel consultants and our certified driver guide assures a safe, treasurable, thrilling and informative safari.', 'icon' => null, 'sort_order' => 0],

                ['group' => 'featured-heading', 'title' => 'Featured Safaris', 'description' => 'Our most popular safari experiences handpicked for you', 'icon' => null, 'sort_order' => 0],

                ['group' => 'activities-heading', 'title' => 'Popular Experiences', 'description' => 'Choose from unique excursions and activities to customize your ideal safari adventure.', 'icon' => null, 'sort_order' => 0],

                // 'icon' here holds the logo filename under storage/app/public/henjo_profile/
                // (client-supplied partner logos), not an icon key like other groups use.
                // 'description' holds an optional link — left null where we don't have a
                // confirmed URL for that partner, rather than guessing one.
                ['group' => 'partners', 'title' => 'Uganda Tourism Board', 'description' => null, 'icon' => 'Uganda_Toursim_Board.jpeg', 'sort_order' => 0],
                ['group' => 'partners', 'title' => 'SafariBookings', 'description' => null, 'icon' => 'safariBookings.jpg', 'sort_order' => 1],
                ['group' => 'partners', 'title' => 'TripAdvisor', 'description' => 'https://www.tripadvisor.com/Attraction_Review-g293841-d25282203-Reviews-Henjo_African_Safaris-Kampala_Central_Region.html', 'icon' => 'TripAdvisor.jpg', 'sort_order' => 2],
                ['group' => 'partners', 'title' => 'Empathy Children Initiative', 'description' => 'https://www.empathychildreninitiative.org/', 'icon' => 'Empathy_childer_initiative.webp', 'sort_order' => 3],
                ['group' => 'partners', 'title' => 'Empathy Community High School', 'description' => '/about-our-charity', 'icon' => 'Empathy_Community_High_School.webp', 'sort_order' => 4],
                ['group' => 'partners', 'title' => 'Dear Future International', 'description' => null, 'icon' => 'Dear_Future.webp', 'sort_order' => 5],

                ['group' => 'features-heading', 'title' => 'Why Choose Henjo African Safaris', 'description' => null, 'icon' => null, 'sort_order' => 0],
                ['group' => 'features', 'title' => 'Expert Guides', 'description' => 'Local experts with years of experience', 'icon' => 'user-tie', 'sort_order' => 0],
                ['group' => 'features', 'title' => 'Custom Itineraries', 'description' => 'Tailored to your preferences', 'icon' => 'map', 'sort_order' => 1],
                ['group' => 'features', 'title' => 'Small Groups', 'description' => 'Intimate experiences with max 6 people', 'icon' => 'users', 'sort_order' => 2],
                ['group' => 'features', 'title' => 'Eco-Friendly', 'description' => 'Sustainable travel practices', 'icon' => 'leaf', 'sort_order' => 3],

                ['group' => 'offers-heading', 'title' => 'Travel With Confidence', 'description' => null, 'icon' => null, 'sort_order' => 0],
                ['group' => 'offers', 'title' => 'Book With Us Online', 'description' => 'Make your booking online directly with us as soon as possible in the fastest and best way possible.', 'icon' => 'laptop', 'sort_order' => 0],
                ['group' => 'offers', 'title' => 'Special Offers For Children', 'description' => 'Free safari for children below 5 years from one family or group and a 25% discount for children between 6-12 years.', 'icon' => 'child', 'sort_order' => 1],
                ['group' => 'offers', 'title' => 'Disability Tours & Safaris', 'description' => 'We believe in Responsible and Inclusive Tourism, and whether you have a disability or not, we welcome you to experience your African holiday with us.', 'icon' => 'wheelchair', 'sort_order' => 2],

                ['group' => 'final-cta', 'title' => 'Ready for Your African Adventure?', 'description' => 'Let our travel consultants craft a custom-made safari itinerary tailored to you - no obligation, just expert guidance.', 'icon' => null, 'sort_order' => 0],
            ],
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'about'], [
            'title' => 'About Us',
            'hero_title' => 'About Us',
            'hero_subtitle' => 'Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda',
            'hero_cta_text' => 'Contact Us',
            'hero_cta_href' => '/contact',
            'content' => "Henjo African Safaris Ltd is a Ugandan Tour agency offering Bespoke Safaris, Tailor Made Holidays, Authentic Luxury African Safaris, Fly-In Safaris, Gorilla Tracking and Cultural Safaris.\nWe take pride in having a team of professionals who have traveled in East Africa and now work to ensure that clients both acquire a unique and educational experience of African wildlife, landscape, and culture.\nThe competence and knowledge of our safari tour guides highly contributes to the overall experience.",
            'meta_title' => 'About Us | Henjo African Safaris',
            'meta_description' => 'Learn about Henjo African Safaris — bespoke, authentic tours across Uganda, Kenya, Tanzania and Rwanda.',
            'sections' => [
                ['group' => 'services-heading', 'title' => 'Our Services', 'description' => 'We offer a wide range of safari experiences tailored to your preferences', 'icon' => null, 'sort_order' => 0],
                ['group' => 'services', 'title' => 'Wildlife Safaris', 'description' => "Experience the thrill of seeing the Big Five in their natural habitat across East Africa's national parks.", 'icon' => 'paw', 'sort_order' => 0],
                ['group' => 'services', 'title' => 'Gorilla Trekking', 'description' => 'Trek through the lush forests of Uganda and Rwanda to encounter endangered mountain gorillas.', 'icon' => 'hiking', 'sort_order' => 1],
                ['group' => 'services', 'title' => 'Fly-In Safaris', 'description' => 'Skip the long drives and fly directly to your safari destination for more time exploring.', 'icon' => 'plane', 'sort_order' => 2],
                ['group' => 'services', 'title' => 'Mountaineering', 'description' => 'Conquer the highest peaks in Africa including Mount Kilimanjaro and the Rwenzori Mountains.', 'icon' => 'mountain', 'sort_order' => 3],
                ['group' => 'services', 'title' => 'Cultural Tours', 'description' => "Immerse yourself in the rich cultures and traditions of East Africa's diverse communities.", 'icon' => 'landmark', 'sort_order' => 4],
                ['group' => 'services', 'title' => 'Women Only Tours', 'description' => 'Specially designed tours for women travelers seeking safe and empowering African adventures.', 'icon' => 'female', 'sort_order' => 5],
                ['group' => 'services', 'title' => 'City Tours', 'description' => 'Explore the vibrant cities of East Africa including Kampala, Nairobi, and Dar es Salaam.', 'icon' => 'city', 'sort_order' => 6],

                ['group' => 'values', 'title' => 'Integrity and transparency in all our dealings', 'description' => null, 'icon' => null, 'sort_order' => 0],
                ['group' => 'values', 'title' => 'Passion for wildlife and conservation', 'description' => null, 'icon' => null, 'sort_order' => 1],
                ['group' => 'values', 'title' => 'Excellence in customer service', 'description' => null, 'icon' => null, 'sort_order' => 2],
                ['group' => 'values', 'title' => 'Respect for local communities and cultures', 'description' => null, 'icon' => null, 'sort_order' => 3],

                ['group' => 'founder', 'title' => 'Our Founder — Henry Katinda', 'description' => "Henry Katinda is the Founder and Director of Henjo African Safaris, an East African travel company dedicated to creating authentic, responsible, and unforgettable travel experiences across Uganda, Kenya, Tanzania, and Rwanda.\nWith 5+ years of experience in tourism, Henry founded Henjo with a vision of connecting travelers from around the world with the incredible wildlife, landscapes, cultures, and communities of East Africa.\nBeyond tourism, Henry is also deeply committed to community development and social impact. He is the founder of Empathy Children Initiative (ECI), a nonprofit organization in Uganda working to expand opportunities for vulnerable children and communities through education, access to essential services, and community-focused initiatives.\nOne of ECI's key programs is Empathy Community High School – Mayuge, a tuition-free donor funded non profit high school established to provide vulnerable children with access to quality secondary education and a supportive learning environment.\nFor Henry, tourism and community development are closely connected. A portion of Henjo African Safaris' proceeds helps support the work of Empathy Children Initiative and Empathy Community High School, allowing travelers who choose to explore Africa with Henjo to indirectly contribute to positive change in the communities that make these journeys possible.", 'icon' => null, 'sort_order' => 0],
                ['group' => 'founder', 'title' => 'Tourism With a Purpose', 'description' => "Henry believes that travel should create value not only for the traveler, but also for the people and communities in the destinations they visit.\nThrough Henjo African Safaris, he is building a model of tourism where unforgettable experiences and meaningful community impact can go hand in hand.\nWhen you travel with Henjo, you are not only discovering Africa—you are also becoming part of a journey that gives back.", 'icon' => null, 'sort_order' => 1],

                ['group' => 'commitment', 'title' => 'Our Commitment', 'description' => "Henjo African Safaris continues to endeavor to be sustainable in practice in the tours offered, to protect African wildlife and ensure the tourism industry continues to prosper.\nWe are working towards leaving a minimal negative impact on the environment and local communities, integrating environmental and social best practices into every aspect of the business.", 'icon' => null, 'sort_order' => 0],

                ['group' => 'inclusive', 'title' => 'Inclusive Tourism', 'description' => "Henjo African Safaris believes in Responsible and Inclusive Tourism, and offers Disability Tours & Safaris — whether a traveler has a disability or not, they are welcomed to experience their African holiday with Henjo.\nWe are represented on SafariBookings.com and offer tours ranging from short stays to longer durations, as well as fully tailor-made safaris on request.", 'icon' => null, 'sort_order' => 0],
            ],
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'booking-policy'], [
            'title' => 'Booking Policy',
            'hero_title' => 'Booking Policy',
            'hero_subtitle' => 'Terms and conditions for booking your safari',
            'hero_cta_text' => 'Contact Us',
            'hero_cta_href' => '/contact',
            'meta_title' => 'Booking Policy | Henjo African Safaris',
            'meta_description' => 'Deposit, cancellation, and children\'s discount terms for booking a safari with Henjo African Safaris.',
            'sections' => [
                ['group' => 'policy', 'title' => 'The booking deposit and cancellation policy', 'description' => "A 30% deposit is required to confirm your booking within 7 days of written confirmation, otherwise, the booking will be taken as a provisional only, with the possible inability to reinstate the reservation. After confirmation, a 30% deposit should be paid and the booking is taken as confirmed.\nOne calendar month before the commencement of the safari- 70% of the total safari cost is paid.\nThe above is at the discretion of Henjo African Safaris Ltd\n\nSpecial requirements and insurance\nClients will have their incoming Travel insurance covered by Henjo African Safaris for 12 days while on a safari. However, if the client is fully covered by their insurance, details should be forwarded at least 4 weeks before the commencement of the safari\nAny medical conditions should be mentioned", 'icon' => null, 'sort_order' => 0],
                ['group' => 'policy', 'title' => 'Cancellation Policy', 'description' => "Before cancellation, Henjo African Safaris and the client will discuss the possibility of rescheduling. In case of cancellations, they should be made in writing and will only deem effective upon acknowledged receipt by Henjo African Safaris.\nCancellation will be subject to the following penalties:\n30 days or more before the remaining 70% of the total package is paid: 5% forfeit of the 30% deposit.\n60 days or more before commencement: Forfeit 20%\nLess than 60 days before commencement: Forfeit 50% of the package price\nLess than 30 days before commencement: Forfeit 100% of the package price", 'icon' => null, 'sort_order' => 1],
                ['group' => 'policy', 'title' => 'Children', 'description' => 'Children are welcome on our safaris, we offer kids below 5 years a free spot one kid per group and we also give a 25% discount for 6-12 year-olds.', 'icon' => null, 'sort_order' => 2],
            ],
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'travel-information'], [
            'title' => 'Travel Information',
            'hero_title' => 'Travel Information',
            'hero_subtitle' => 'Reliable information as you dive into the true essence of Africa',
            'content' => 'Africa is extraordinary and her people evoke a sense of adventure, romance and deep connection to nature. Find the reliable information from Henjo African Safaris as you dive into the true essence of Africa.',
            'meta_title' => 'Travel Information | Henjo African Safaris',
            'meta_description' => 'Visa guides, entry requirements, and reliable travel information for your East Africa safari.',
            'sections' => [
                ['group' => 'articles', 'title' => 'East Africa Tourist Visa Guide', 'description' => "This is a Joint Tourist Visa and it allows the traveler to travel to Uganda, Kenya, and Rwanda ONLY. It can be used multiple times for tourism purposes. The visa prohibits employment and is issued only for tourism purposes. The visa is valid for 90 days and is not renewable upon expiry or upon exit from the block. NB: the issuing country should be your first entry point. Apply online at visas.immigration.go.ug.\nRequirements: copy of the passport (bio-data page) with at least 6 months validity, a recent passport-size photograph, a Yellow Fever vaccination certificate, a return ticket, and a travel itinerary.", 'icon' => 'passport', 'sort_order' => 0],
                ['group' => 'articles', 'title' => 'Entry Requirements For Uganda', 'description' => "Uganda Tourist Visa – Single Entry. This visa is granted to travelers coming to Uganda for tourism, is a single-entry visa, and can be granted for up to 3 months. Apply online at visas.immigration.go.ug.\nRequirements: passport copy (bio-data page) with at least 6 months validity, a tour plan, travel itinerary/booking, a recent passport-size photograph, and a Yellow Fever vaccination certificate.", 'icon' => 'file', 'sort_order' => 1],
            ],
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'about-our-charity'], [
            'title' => 'About Our Charity',
            'hero_title' => 'About Our Charity',
            'hero_subtitle' => 'Making a difference through responsible tourism',
            'content' => "Henjo African Safaris is more than just a premier safari company; it's a beacon of hope for vulnerable children in Africa.\nThrough a strategic partnership with Empathy Children Initiative, Henjo African Safaris dedicates itself to making a tangible difference in the lives of these children. Every booking made directly with Henjo African Safaris contributes directly to the well-being, education and menstrual hygiene programs of these children.\nWhether you're embarking on a thrilling safari adventure or planning a serene getaway, your decision to book with Henjo African Safaris means you're actively participating in changing lives and building brighter futures for those in need.\nJoin us in making a lasting impact through unforgettable experiences.",
            'hero_cta_text' => 'Learn More',
            'hero_cta_href' => 'https://www.empathychildreninitiative.org/',
            'meta_title' => 'About Our Charity | Henjo African Safaris',
            'meta_description' => "Henjo African Safaris' partnership with Empathy Children Initiative supports vulnerable children across Africa.",
            'sections' => [
                ['group' => 'programs', 'title' => 'Empathy Children Initiative (ECI)', 'description' => 'A nonprofit organization in Uganda working to expand opportunities for vulnerable children and communities through education, access to essential services, and community-focused initiatives.', 'icon' => null, 'sort_order' => 0],
                ['group' => 'programs', 'title' => 'Empathy Community High School – Mayuge', 'description' => 'A tuition-free, donor-funded nonprofit high school established to provide vulnerable children with access to quality secondary education and a supportive learning environment.', 'icon' => null, 'sort_order' => 1],
            ],
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'women-only-tours'], [
            'title' => 'Women Only Tours',
            'hero_title' => 'Women Only Tours',
            'hero_subtitle' => 'Safe, empowering travel across Uganda, Kenya & Rwanda',
            'content' => "Our Women-only travel packages offer a safe and empowering way for women to explore Uganda, Kenya & Rwanda on their terms. These packages enable our clients to feel a sense of security and safety. Henjo African Safaris offers security measures such as women-only attendants in accommodations and transportation, as well as local female guides and support networks in the destinations they visit — giving women the confidence to travel to destinations that may be considered unsafe for solo female travelers.\nChoosing women-only travel packages offers the opportunity to connect with other like-minded women and provides a supportive and empowering environment where women can bond and make lasting friendships — particularly beneficial for women traveling solo who may feel lonely or isolated.\nIn addition to the safety and social aspects, women-only travel packages also offer unique travel experiences tailored to the interests and needs of women, including wellness retreats, cultural immersion experiences, adventure sports, and teenage girls' menstrual health programs. We work with local female-owned businesses and organizations to provide authentic and empowering travel experiences.",
            'meta_title' => 'Women Only Tours | Henjo African Safaris',
            'meta_description' => 'Safe, empowering women-only safari packages across Uganda, Kenya, and Rwanda.',
            'sections' => [
                ['group' => 'features', 'title' => 'Safety First', 'description' => 'Women-only attendants, transport, and local female guides throughout.', 'icon' => 'shield', 'sort_order' => 0],
                ['group' => 'features', 'title' => 'Community & Connection', 'description' => 'Travel alongside like-minded women and build lasting friendships.', 'icon' => 'users', 'sort_order' => 1],
                ['group' => 'features', 'title' => 'Purpose-Driven Travel', 'description' => "Supports teenage girls' menstrual health programs and female-owned businesses.", 'icon' => 'heart', 'sort_order' => 2],
            ],
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'contact'], [
            'title' => 'Contact',
            'hero_title' => 'Get In Touch',
            'hero_subtitle' => "Have questions about our safaris? We'd love to hear from you.",
            'hero_cta_text' => 'Book Now',
            'hero_cta_href' => '/safaris',
            'meta_title' => 'Contact Us | Henjo African Safaris',
            'meta_description' => 'Get in touch with Henjo African Safaris — office locations, phone numbers, and a contact form.',
            'is_active' => true,
        ]);
    }
}
