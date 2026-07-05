// ============================================
// DESTINATIONS PAGE
// ============================================
// This is the main destinations page that displays all
// destinations you can visit. Users can click on individual
// destinations to see more details.
// ============================================

import Hero from '@/components/common/Hero';
import Link from 'next/link';
import Image from 'next/image';

// ✅ This data will eventually come from the API
// For now, we use static data from the audit document
const destinations = [
    {
        name: 'Kenya',
        slug: 'kenya',
        description: 'Home to the Masai Mara, Lake Nakuru, and Amboseli National Park. Experience the Great Migration and diverse wildlife.',
        image: '/images/placeholder.png',
        tours: 4
    },
    {
        name: 'Tanzania',
        slug: 'tanzania',
        description: 'Discover the Serengeti, Ngorongoro Crater, and Zanzibar. Witness the Great Migration and climb Mount Kilimanjaro.',
        image: '/images/placeholder.png',
        tours: 4
    },
    {
        name: 'Uganda',
        slug: 'uganda',
        description: 'The Pearl of Africa. Home to mountain gorillas, chimpanzees, and the source of the Nile River.',
        image: '/images/placeholder.png',
        tours: 16
    },
    {
        name: 'Rwanda',
        slug: 'rwanda',
        description: 'The Land of a Thousand Hills. Famous for mountain gorillas, golden monkeys, and beautiful landscapes.',
        image: '/images/placeholder.png',
        tours: 4
    },
];

export default function DestinationsPage() {
    return (
        <div className="min-h-screen">
            <Hero 
                size="medium"
                title="Our Destinations"
                subtitle="Explore the best of East Africa with our curated safari experiences"
                ctaText="View All Safaris"
                ctaLink="/safaris"
                backgroundImage="/images/destinations-hero.jpg"
                overlay={true}
                showTagline={true}
            />

            <div className="container mx-auto px-4 py-16">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    {destinations.map((dest) => (
                        <Link
                            key={dest.slug}
                            href={`/destinations/${dest.slug}`}
                            className="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300"
                        >
                            <div className="relative h-48 overflow-hidden">
                                <Image
                                    src={dest.image}
                                    alt={dest.name}
                                    fill
                                    className="object-cover group-hover:scale-110 transition duration-500"
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent" />
                                <div className="absolute bottom-4 left-4 text-white">
                                    <h3 className="text-2xl font-bold">{dest.name}</h3>
                                    <p className="text-sm text-gray-300">{dest.tours} Tours Available</p>
                                </div>
                            </div>
                            <div className="p-6">
                                <p className="text-gray-600 text-sm leading-relaxed">
                                    {dest.description}
                                </p>
                                <span className="inline-block mt-4 text-yellow-600 font-semibold group-hover:text-yellow-700 transition">
                                    Explore {dest.name} →
                                </span>
                            </div>
                        </Link>
                    ))}
                </div>
            </div>
        </div>
    );
}