// ============================================
// DESTINATIONS PAGE — Premium Redesign
// ============================================
// Rich, content-driven destinations page with
// hero, featured grid, highlights section,
// and a CTA. Content sourced from the content audit.
// ============================================

import Hero from '@/components/common/Hero';
import Link from 'next/link';
import Image from 'next/image';
import { FaMapMarkerAlt, FaCamera, FaArrowRight, FaStar, FaPaw, FaMountain, FaWater, FaTree, FaGlobeAfrica } from 'react-icons/fa';
import DestinationCard from '@/components/destination/DestinationCard';
import type { DestinationData } from '@/components/destination/DestinationCard';
import { destinationApi } from '@/lib/api/destinationApi';
import { settingsApi } from '@/lib/api/settingsApi';
import type { Destination } from '@/types/safari';

function toCardData(destination: Destination): DestinationData {
    return {
        name: destination.country?.name || destination.name,
        slug: destination.slug,
        tagline: destination.tagline || '',
        description: destination.description,
        image: destination.hero_image_url || '/images/placeholder.png',
        country: 'East Africa',
        tours: destination.packages_count ?? destination.packages?.length ?? 0,
        highlights: destination.highlights || [],
        startingPrice: Number(destination.starting_price) || 0,
        currency: '$',
    };
}

// ============================================
// WHY EAST AFRICA SECTION DATA
// ============================================

const whyReasons = [
    {
        icon: FaPaw,
        title: 'Unrivalled Wildlife',
        description: 'Home to the Big Five, mountain gorillas, tree-climbing lions, and the Great Migration — the largest animal movement on Earth.',
    },
    {
        icon: FaMountain,
        title: 'Dramatic Landscapes',
        description: 'From Kilimanjaro\'s snow-capped peak to the Great Rift Valley, volcanic craters, and lush rainforests — geography that takes your breath away.',
    },
    {
        icon: FaStar,
        title: 'Authentic Experiences',
        description: 'Immerse yourself in Maasai culture, cruise alongside hippos on the Kazinga Channel, or raft the source of the Nile.',
    },
    {
        icon: FaTree,
        title: 'Conservation at Heart',
        description: 'Henjo Safaris supports community tourism and wildlife conservation, ensuring your visit creates a positive, lasting impact.',
    },
];

// ============================================
// PAGE COMPONENT
// ============================================

export default async function DestinationsPage() {
    const [destinationsRes, settingsRes] = await Promise.allSettled([
        destinationApi.getAll(),
        settingsApi.getSettings(),
    ]);

    const destinations = destinationsRes.status === 'fulfilled' && destinationsRes.value.success
        ? destinationsRes.value.data.map(toCardData)
        : [];
    const settings = settingsRes.status === 'fulfilled' && settingsRes.value.success
        ? settingsRes.value.data
        : null;

    const stats = [
        { value: `${settings?.safari_package_count ?? 28}+`, label: 'Safari Packages' },
        { value: String(settings?.country_count ?? 4), label: 'Countries' },
        { value: settings?.years_experience || '15+', label: 'Years Experience' },
        { value: settings?.happy_travelers_count || '500+', label: 'Happy Travelers' },
    ];

    return (
        <div className="min-h-screen">
            {/* Hero */}
            <Hero
                size="medium"
                title="Our Destinations"
                subtitle="Explore the best of East Africa - from the savannas of Kenya to the misty gorilla forests of Uganda and Rwanda"
                ctaText="View All Safaris"
                ctaLink="/safaris"
                backgroundImage="/images/destinations-hero.jpg"
                overlay={true}
                showTagline={true}
            />

            {/* Destinations Grid */}
            <section className="py-20 transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
                <div className="container mx-auto px-4">
                    {/* Section Header */}
                    <div className="text-center mb-14">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{
                                background: 'var(--brand-gold-subtle)',
                                color: 'var(--brand-gold)',
                            }}
                        >
                            <FaGlobeAfrica /> Four Countries, Endless Adventures
                        </span>
                        <h2 className="text-3xl md:text-4xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>
                            Choose Your African Adventure
                        </h2>
                        <p className="max-w-2xl mx-auto text-lg" style={{ color: 'var(--text-secondary)' }}>
                            Each destination offers its own unique wildlife, culture, and landscapes.
                            Let us craft the perfect safari for you.
                        </p>
                    </div>

                    {/* Featured Layout: first destination spans 2 cols, others are standard */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                        {destinations.length === 0 ? (
                            <p className="col-span-full text-center" style={{ color: 'var(--text-muted)' }}>
                                No destinations available right now — check back soon.
                            </p>
                        ) : (
                            <>
                                {/* Featured: first destination */}
                                <DestinationCard
                                    destination={destinations[0]}
                                    index={0}
                                    layout="featured"
                                />

                                {/* Standard: remaining destinations */}
                                {destinations.slice(1).map((dest, i) => (
                                    <DestinationCard
                                        key={dest.slug}
                                        destination={dest}
                                        index={i + 1}
                                    />
                                ))}
                            </>
                        )}
                    </div>
                </div>
            </section>

            {/* Why East Africa Section */}
            <section className="py-20 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4">
                    <div className="text-center mb-14">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{
                                background: 'var(--brand-green-subtle)',
                                color: 'var(--brand-green)',
                            }}
                        >
                            <FaStar /> Why Choose East Africa?
                        </span>
                        <h2 className="text-3xl md:text-4xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>
                            An Experience Like No Other
                        </h2>
                        <p className="max-w-2xl mx-auto text-lg" style={{ color: 'var(--text-secondary)' }}>
                            East Africa is one of the last truly wild places on Earth — and Henjo Safaris has been
                            guiding travelers through it for over 15 years.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                        {whyReasons.map((reason) => (
                            <div
                                key={reason.title}
                                className="text-center group"
                            >
                                <div
                                    className="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 transition-all duration-300"
                                    style={{ background: 'var(--brand-gold-subtle)' }}
                                >
                                    <reason.icon className="text-2xl transition-colors duration-300" style={{ color: 'var(--brand-gold)' }} />
                                </div>
                                <h3 className="text-lg font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                    {reason.title}
                                </h3>
                                <p className="text-sm leading-relaxed" style={{ color: 'var(--text-tertiary)' }}>
                                    {reason.description}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Stats Bar */}
            <section className="py-12" style={{ background: 'var(--bg-footer)' }}>
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto text-center">
                        {stats.map((stat) => (
                            <div key={stat.label}>
                                <p className="text-3xl md:text-4xl font-bold mb-1" style={{ color: 'var(--brand-gold)' }}>
                                    {stat.value}
                                </p>
                                <p className="text-sm" style={{ color: '#9A968E' }}>{stat.label}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="relative py-20 overflow-hidden">
                <div className="absolute inset-0">
                    <Image
                        src="/images/destinations/uganda.png"
                        alt="Plan your safari"
                        fill
                        className="object-cover"
                    />
                    <div className="absolute inset-0 bg-black/60" />
                </div>
                <div className="relative container mx-auto px-4 text-center">
                    <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                        Not Sure Where to Start?
                    </h2>
                    <p className="text-gray-200 text-lg max-w-2xl mx-auto mb-8">
                        Our safari experts will help you design a bespoke itinerary tailored to your
                        interests, budget, and travel dates. Every trip is unique.
                    </p>
                    <div className="flex flex-wrap justify-center gap-4">
                        <Link
                            href="/contact"
                            className="font-bold px-8 py-4 rounded-full transition transform hover:scale-105 inline-flex items-center gap-2"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
                        >
                            Plan My Safari
                            <FaArrowRight />
                        </Link>
                        <Link
                            href="/safaris"
                            className="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-bold px-8 py-4 rounded-full transition border border-white/30"
                        >
                            Browse All Safaris
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    );
}