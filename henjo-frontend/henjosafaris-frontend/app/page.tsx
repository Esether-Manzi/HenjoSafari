'use client';

import { useEffect, useMemo, useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import Hero from '@/components/common/Hero';
import SafariCard from '@/components/safari/SafariCard';
import { safariApi } from '@/lib/api/safariApi';
import { FaGlobeAfrica, FaUserTie, FaMapMarkedAlt, FaUsers, FaLeaf, FaLaptop, FaChild, FaWheelchair, FaFirstAid, FaCompass, FaStar, FaShieldAlt } from 'react-icons/fa';
import type { SafariPackage, Activity } from '@/types/safari';

// The backend's public API is served under `/api/v1`, but static files
// (Laravel's storage:link) live directly on that same host — so we derive
// the origin from the API URL rather than hardcoding it.
const API_ORIGIN = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/api\/v1\/?$/, '');
const HERO_VIDEO_URL = `${API_ORIGIN}/storage/images/home-page-hero-section.mp4`;

// Picks up to `perCountry` packages from each destination country, preserving
// the order countries first appear in — keeps the featured list varied
// instead of it being dominated by whichever country has the most entries.
function pickPerCountry(packages: SafariPackage[], perCountry = 2): SafariPackage[] {
    const counts = new Map<string, number>();
    const picked: SafariPackage[] = [];

    for (const pkg of packages) {
        const countryKey = pkg.destination?.country?.id != null
            ? String(pkg.destination.country.id)
            : `no-country-${pkg.destination_id ?? 'unknown'}`;
        const count = counts.get(countryKey) ?? 0;
        if (count < perCountry) {
            counts.set(countryKey, count + 1);
            picked.push(pkg);
        }
    }

    return picked;
}

function getActivityImage(activity: Activity): string {
    if (activity.media && activity.media.length > 0) {
        return activity.media[0].original_url || activity.media[0].large_url || '/images/placeholder.png';
    }
    // Mock/placeholder activities carry a direct image URL in `icon`; real
    // API activities use it as an icon *key* (e.g. "game-drive"), so only
    // treat it as an image when it actually looks like one.
    if (activity.icon && activity.icon.startsWith('http')) {
        return activity.icon;
    }
    return '/images/placeholder.png';
}

const MOCK_ACTIVITIES: Activity[] = [
    {
        id: 1,
        name: "Game Drives",
        slug: "game-drives",
        description: "Search for the Big Five in open-top 4x4 safari vehicles.",
        icon: "https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?q=80&w=600&auto=format&fit=crop"
    },
    {
        id: 2,
        name: "Gorilla Trekking",
        slug: "gorilla-trekking",
        description: "Hike through misty rainforests to sit with mountain gorillas.",
        icon: "https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=600&auto=format&fit=crop"
    },
    {
        id: 3,
        name: "Hot Air Ballooning",
        slug: "hot-air-ballooning",
        description: "Float over the Serengeti plains at sunrise.",
        icon: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600&auto=format&fit=crop"
    },
    {
        id: 4,
        name: "Walking Safaris",
        slug: "walking-safaris",
        description: "Explore the savanna on foot with an armed ranger guide.",
        icon: "https://images.unsplash.com/photo-1470240731273-7821a6eeb6bd?q=80&w=600&auto=format&fit=crop"
    },
    {
        id: 5,
        name: "Boat Cruises",
        slug: "boat-cruises",
        description: "Cruise down channels to spot elephants, hippos, and birds.",
        icon: "https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=600&auto=format&fit=crop"
    },
    {
        id: 6,
        name: "Cultural Visits",
        slug: "cultural-visits",
        description: "Meet traditional communities and learn about local customs.",
        icon: "https://images.unsplash.com/photo-1489749798305-4fea3ae63d43?q=80&w=600&auto=format&fit=crop"
    }
];

export default function Home() {
    const [featured, setFeatured] = useState<SafariPackage[]>([]);
    const [activities, setActivities] = useState<Activity[]>([]);
    const [loading, setLoading] = useState(true);
    const [activitiesLoading, setActivitiesLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchFeatured = async () => {
            try {
                const response = await safariApi.getFeatured();
                if (response.success) {
                    setFeatured(response.data || []);
                }
            } catch (err: any) {
                console.error('Error fetching featured:', err);
                setError(err.message || 'Failed to load featured tours');
            } finally {
                setLoading(false);
            }
        };

        const fetchActivities = async () => {
            try {
                setActivitiesLoading(true);
                const response = await safariApi.getActivities();
                if (response.success && response.data?.length > 0) {
                    setActivities(response.data);
                } else {
                    setActivities(MOCK_ACTIVITIES);
                }
            } catch (err: any) {
                console.warn('Unable to load activities from API, using mock placeholders:', err);
                setActivities(MOCK_ACTIVITIES);
            } finally {
                setActivitiesLoading(false);
            }
        };

        fetchFeatured();
        fetchActivities();
    }, []);

    const featuredByCountry = useMemo(() => pickPerCountry(featured, 2), [featured]);

    return (
        <div>
            {/* Hero - Full size with image background */}
            <Hero
                size="large"
                variant="home"
                title="Discover the Wild Side of East Africa"
                subtitle="Bespoke safaris, gorilla trekking, and tailor-made holidays across Uganda, Kenya, Tanzania, and Rwanda."
                ctaText="Explore Safaris"
                ctaLink="/safaris"
                backgroundImage="/images/placeholder.png"
                backgroundVideo={HERO_VIDEO_URL}
                overlay={true}
                showTagline={true}
            />

            {/* Why Henjo African Safaris */}
            <section className="relative py-20 overflow-hidden transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                {/* Decorative glow blobs */}
                <div
                    className="absolute -top-24 -left-24 w-72 h-72 rounded-full blur-3xl opacity-20 animate-float pointer-events-none"
                    style={{ background: 'var(--brand-gold)' }}
                />
                <div
                    className="absolute -bottom-24 -right-24 w-72 h-72 rounded-full blur-3xl opacity-20 animate-float pointer-events-none"
                    style={{ background: 'var(--brand-green)', animationDelay: '2s' }}
                />

                <div className="relative container mx-auto px-4 max-w-3xl text-center">
                    <span
                        className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-5"
                        style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                    >
                        <FaCompass /> Why Travel With Us
                    </span>
                    <h2 className="text-3xl md:text-4xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>
                        Well organized tours to elevate your <span style={{ color: 'var(--brand-gold)' }}>spirit!</span>
                    </h2>
                    <p className="text-lg" style={{ color: 'var(--text-tertiary)' }}>
                        The combination of our experienced team of travel consultants and our certified driver guide
                        assures a safe, treasurable, thrilling and informative safari.
                    </p>
                </div>
            </section>

            {/* Featured Tours */}
            <section
                className="relative py-20 transition-colors duration-300 overflow-hidden"
                style={{ background: 'var(--bg-secondary)' }}
            >
                <div className="absolute inset-0 bg-dot-grid opacity-[0.35] pointer-events-none" />

                <div className="relative container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                        >
                            <FaStar /> Handpicked For You
                        </span>
                        <h2
                            className="text-4xl md:text-5xl font-bold mb-4"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            Featured <span style={{ color: 'var(--brand-gold)' }}>Safaris</span>
                        </h2>
                        <p className="max-w-2xl mx-auto" style={{ color: 'var(--text-tertiary)' }}>
                            Our most popular safari experiences handpicked for you
                        </p>
                    </div>

                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {[1, 2, 3, 4, 5, 6].map((n) => (
                                <div
                                    key={n}
                                    className="rounded-2xl h-96 animate-pulse"
                                    style={{ background: 'var(--bg-tertiary)' }}
                                />
                            ))}
                        </div>
                    ) : error ? (
                        <p className="text-center" style={{ color: 'var(--brand-maroon)' }}>{error}</p>
                    ) : featured.length === 0 ? (
                        <p className="text-center" style={{ color: 'var(--text-muted)' }}>No featured tours available</p>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {featuredByCountry.map((pkg) => (
                                <SafariCard key={pkg.id} tour={pkg} />
                            ))}
                        </div>
                    )}

                    <div className="text-center mt-12">
                        <Link
                            href="/safaris"
                            className="font-bold px-8 py-3 rounded-full transition inline-block hover:scale-105"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
                        >
                            View All Safaris →
                        </Link>
                    </div>
                </div>
            </section>

            {/* Activities Section */}
            <section
                className="py-20 transition-colors duration-300"
                style={{ background: 'var(--bg-primary)', borderBottom: '1px solid var(--border-subtle)' }}
            >
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span className="inline-flex items-center gap-2 bg-[var(--brand-gold-subtle)] text-[var(--brand-gold)] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            <FaGlobeAfrica /> Safari Experiences
                        </span>
                        <h2
                            className="text-3xl md:text-4xl font-bold"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            Adventure <span style={{ color: 'var(--brand-gold)' }}>Activities</span>
                        </h2>
                        <p className="max-w-2xl mx-auto mt-4 text-lg" style={{ color: 'var(--text-tertiary)' }}>
                            Choose from unique excursions and activities to customize your ideal safari adventure.
                        </p>
                    </div>

                    {activitiesLoading ? (
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
                            {[1, 2, 3, 4, 5, 6, 7, 8].map((n) => (
                                <div
                                    key={n}
                                    className="rounded-xl h-64 animate-pulse"
                                    style={{ background: 'var(--bg-secondary)' }}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
                            {activities.map((activity) => {
                                const imgUrl = getActivityImage(activity);
                                return (
                                    <div
                                        key={activity.id}
                                        className="relative h-64 rounded-xl overflow-hidden group shadow-md transition duration-300 hover:shadow-xl hover:-translate-y-1"
                                        style={{ border: '1px solid var(--border-subtle)' }}
                                    >
                                        <Image
                                            src={imgUrl}
                                            alt={activity.name}
                                            fill
                                            className="object-cover group-hover:scale-110 transition duration-500 ease-out"
                                        />
                                        {/* Gradient scrim for legible text at any time */}
                                        <div className="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent group-hover:from-black/90 transition-colors duration-300" />

                                        {/* Text content placed on top of the overlay */}
                                        <div className="absolute inset-0 flex flex-col justify-end p-5 z-10">
                                            <h3 className="font-bold text-xl text-white leading-tight group-hover:text-[var(--brand-gold)] transition duration-300">
                                                {activity.name}
                                            </h3>
                                            <p className="text-xs text-gray-200 line-clamp-2 mt-1.5 leading-snug opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                {activity.description}
                                            </p>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    )}
                </div>
            </section>

            {/* Features Section */}
            <section
                className="py-20 transition-colors duration-300"
                style={{ background: 'linear-gradient(180deg, var(--bg-secondary), var(--bg-primary))' }}
            >
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                        >
                            <FaShieldAlt /> The Henjo Difference
                        </span>
                        <h2
                            className="text-3xl md:text-4xl font-bold"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            Why Choose <span style={{ color: 'var(--brand-gold)' }}>Henjo African Safaris</span>
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        {[
                            { Icon: FaUserTie, title: 'Expert Guides', desc: 'Local experts with years of experience' },
                            { Icon: FaMapMarkedAlt, title: 'Custom Itineraries', desc: 'Tailored to your preferences' },
                            { Icon: FaUsers, title: 'Small Groups', desc: 'Intimate experiences with max 6 people' },
                            { Icon: FaLeaf, title: 'Eco-Friendly', desc: 'Sustainable travel practices' },
                        ].map((item, i) => (
                            <div
                                key={i}
                                className="group text-center p-6 rounded-2xl transition duration-300 hover:-translate-y-1"
                                style={{
                                    background: 'var(--bg-card)',
                                    boxShadow: 'var(--shadow-sm)',
                                    border: '1px solid var(--border-subtle)',
                                    borderTopWidth: '3px',
                                    borderTopColor: 'var(--brand-gold)',
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-lg)';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-sm)';
                                }}
                            >
                                <div
                                    className="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 transition duration-300 group-hover:scale-110"
                                    style={{ background: 'var(--brand-gold-subtle)' }}
                                >
                                    <item.Icon className="text-2xl" style={{ color: 'var(--brand-gold)' }} />
                                </div>
                                <h3 className="text-xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                    {item.title}
                                </h3>
                                <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>
                                    {item.desc}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Special Offers / Value Propositions */}
            <section className="py-20 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-green-subtle)', color: 'var(--brand-green)' }}
                        >
                            <FaShieldAlt /> Peace Of Mind
                        </span>
                        <h2 className="text-3xl md:text-4xl font-bold" style={{ color: 'var(--text-primary)' }}>
                            Travel With <span style={{ color: 'var(--brand-green)' }}>Confidence</span>
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        {[
                            { Icon: FaLaptop, title: 'Book With Us Online', desc: 'Make your booking online directly with us as soon as possible in the fastest and best way possible.' },
                            { Icon: FaChild, title: 'Special Offers For Children', desc: 'Free safari for children below 5 years from one family or group and a 25% discount for children between 6-12 years.' },
                            { Icon: FaWheelchair, title: 'Disability Tours & Safaris', desc: 'We believe in Responsible and Inclusive Tourism, and whether you have a disability or not, we welcome you to experience your African holiday with us.' },
                            { Icon: FaFirstAid, title: 'Medical Travel Insurance', desc: 'Our tours come with free medical insurance for up to 10 days, which protects you in the event of an illness or injury while on safari with Henjo African Safaris.' },
                        ].map((item, i) => (
                            <div
                                key={i}
                                className="group text-center p-6 rounded-2xl transition duration-300 hover:-translate-y-1"
                                style={{
                                    background: 'var(--bg-card)',
                                    boxShadow: 'var(--shadow-sm)',
                                    border: '1px solid var(--border-subtle)',
                                    borderTopWidth: '3px',
                                    borderTopColor: 'var(--brand-green)',
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-lg)';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-sm)';
                                }}
                            >
                                <div
                                    className="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 transition duration-300 group-hover:scale-110"
                                    style={{ background: 'var(--brand-green-subtle)' }}
                                >
                                    <item.Icon className="text-2xl" style={{ color: 'var(--brand-green)' }} />
                                </div>
                                <h3 className="text-lg font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                    {item.title}
                                </h3>
                                <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>
                                    {item.desc}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Final CTA */}
            <section className="relative py-20 overflow-hidden">
                <div className="absolute inset-0" style={{ background: 'linear-gradient(120deg, var(--brand-green-hover), var(--brand-green))' }} />
                <div
                    className="absolute -top-16 -right-16 w-80 h-80 rounded-full blur-3xl opacity-20 pointer-events-none"
                    style={{ background: 'var(--brand-gold)' }}
                />
                <div className="relative container mx-auto px-4 text-center">
                    <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                        Ready for Your African Adventure?
                    </h2>
                    <p className="text-lg text-white/80 max-w-xl mx-auto mb-8">
                        Let our travel consultants craft a custom-made safari itinerary tailored to you - no obligation, just expert guidance.
                    </p>
                    <div className="flex flex-wrap justify-center gap-4">
                        <Link
                            href="/booking"
                            className="font-bold px-8 py-4 rounded-full transition hover:scale-105 shadow-xl"
                            style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                        >
                            Start Planning →
                        </Link>
                        <Link
                            href="/contact"
                            className="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white font-bold px-8 py-4 rounded-full transition border border-white/30"
                        >
                            Talk to an Expert
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    );
}