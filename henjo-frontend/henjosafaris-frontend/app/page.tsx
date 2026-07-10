'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import Hero from '@/components/common/Hero';
import SafariCard from '@/components/safari/SafariCard';
import { safariApi } from '@/lib/api/safariApi';
import type { SafariPackage, Activity } from '@/types/safari';

function getActivityImage(activity: Activity): string {
    if (activity.media && activity.media.length > 0) {
        return activity.media[0].original_url || activity.media[0].large_url || '/images/placeholder.png';
    }
    return activity.icon || '/images/placeholder.png';
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

    return (
        <div>
            {/* Hero - Full size with image background */}
            <Hero 
                size="large"
                variant="home"
                title="Discover Tanzania's Wild Heart"
                subtitle="Experience unforgettable safaris through the Serengeti, Ngorongoro Crater, and Zanzibar's pristine beaches."
                ctaText="Explore Safaris"
                ctaLink="/safaris"
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={true}
            />

            {/* Featured Tours */}
            <section
                className="py-20 transition-colors duration-300"
                style={{ background: 'var(--bg-secondary)' }}
            >
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
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
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {[1, 2, 3].map((n) => (
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
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {featured.slice(0, 3).map((pkg) => (
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
                        <span className="inline-block bg-[var(--brand-gold-subtle)] text-[var(--brand-gold)] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            🌍 Safari Experiences
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
                        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                            {[1, 2, 3, 4, 5, 6].map((n) => (
                                <div
                                    key={n}
                                    className="rounded-xl h-48 animate-pulse"
                                    style={{ background: 'var(--bg-secondary)' }}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                            {activities.map((activity) => {
                                const imgUrl = getActivityImage(activity);
                                return (
                                    <div
                                        key={activity.id}
                                        className="relative h-48 rounded-xl overflow-hidden group shadow-md"
                                        style={{ border: '1px solid var(--border-subtle)' }}
                                    >
                                        <Image
                                            src={imgUrl}
                                            alt={activity.name}
                                            fill
                                            className="object-cover group-hover:scale-110 transition duration-500 ease-out"
                                        />
                                        {/* Slightly transparent black overlay */}
                                        <div className="absolute inset-0 bg-black/40 group-hover:bg-black/55 transition-colors duration-300" />
                                        
                                        {/* Text content placed on top of the overlay */}
                                        <div className="absolute inset-0 flex flex-col justify-end p-4 z-10">
                                            <h3 className="font-bold text-lg text-white leading-tight group-hover:text-[var(--brand-gold)] transition duration-300">
                                                {activity.name}
                                            </h3>
                                            <p className="text-[10px] text-gray-200 line-clamp-2 mt-1 leading-snug opacity-0 group-hover:opacity-100 transition-opacity duration-300">
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
                style={{ background: 'var(--bg-secondary)' }}
            >
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <h2
                            className="text-3xl md:text-4xl font-bold"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            Why Choose <span style={{ color: 'var(--brand-gold)' }}>Henjo African Safaris</span>
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                        {[
                            { icon: '🦁', title: 'Expert Guides', desc: 'Local experts with years of experience' },
                            { icon: '🗺️', title: 'Custom Itineraries', desc: 'Tailored to your preferences' },
                            { icon: '👥', title: 'Small Groups', desc: 'Intimate experiences with max 6 people' },
                            { icon: '🌿', title: 'Eco-Friendly', desc: 'Sustainable travel practices' },
                        ].map((item, i) => (
                            <div
                                key={i}
                                className="text-center p-6 rounded-2xl transition hover:scale-[1.02]"
                                style={{
                                    background: 'var(--bg-card)',
                                    boxShadow: 'var(--shadow-sm)',
                                    border: '1px solid var(--border-subtle)'
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-md)';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-sm)';
                                }}
                            >
                                <div className="text-4xl mb-4">{item.icon}</div>
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
        </div>
    );
}