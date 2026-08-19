'use client';

// ============================================
// DESTINATION DETAIL PAGE
// ============================================
// Per-country destination page (Uganda/Kenya/Tanzania/Rwanda),
// matching the old site's /destination/{country}/ tour archives
// (henjosafaris-content-audit.md §3.9). Reuses the shared
// destinations data for the hero/highlights and fetches a live
// tour grid filtered by country via the existing safariApi.
// ============================================

import { useEffect, useState } from 'react';
import { useParams, notFound } from 'next/navigation';
import Link from 'next/link';
import Hero from '@/components/common/Hero';
import SafariCard from '@/components/safari/SafariCard';
import { safariApi } from '@/lib/api/safariApi';
import { destinationApi } from '@/lib/api/destinationApi';
import { FaMapMarkerAlt, FaArrowRight } from 'react-icons/fa';
import type { SafariPackage, Destination } from '@/types/safari';

export default function DestinationDetailPage() {
    const params = useParams();
    const slug = params.slug as string;

    const [destination, setDestination] = useState<Destination | null>(null);
    const [destinationLoading, setDestinationLoading] = useState(true);
    const [notFoundFlag, setNotFoundFlag] = useState(false);

    const [tours, setTours] = useState<SafariPackage[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchDestination = async () => {
            try {
                setDestinationLoading(true);
                const response = await destinationApi.getBySlug(slug);
                if (response.success) {
                    setDestination(response.data);
                } else {
                    setNotFoundFlag(true);
                }
            } catch (err) {
                console.error('Error fetching destination:', err);
                setNotFoundFlag(true);
            } finally {
                setDestinationLoading(false);
            }
        };

        fetchDestination();
    }, [slug]);

    useEffect(() => {
        if (!destination) return;

        const fetchTours = async () => {
            try {
                setLoading(true);
                const countryName = destination.country?.name || destination.name;
                const response = await safariApi.getAll({ country: countryName });
                const packageData = (response.data as any)?.data || response.data || [];
                setTours(packageData);
            } catch (err: any) {
                console.error('Error fetching destination tours:', err);
                setError(err.message || 'Failed to load safaris for this destination');
            } finally {
                setLoading(false);
            }
        };

        fetchTours();
    }, [destination]);

    if (notFoundFlag) {
        notFound();
    }

    if (destinationLoading || !destination) {
        return (
            <div className="min-h-screen flex items-center justify-center">
                <div className="rounded-2xl h-24 w-24 animate-pulse" style={{ background: 'var(--bg-tertiary)' }} />
            </div>
        );
    }

    const displayName = destination.country?.name || destination.name;

    return (
        <div className="min-h-screen">
            <Hero
                size="medium"
                title={displayName}
                subtitle={destination.tagline || undefined}
                ctaText="View All Safaris"
                ctaLink="/safaris"
                backgroundImage={destination.hero_image_url}
                overlay={true}
                showTagline={true}
            />

            {/* Overview */}
            <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-4xl">
                    <div className="flex items-center gap-2 text-sm font-medium mb-4" style={{ color: 'var(--brand-gold)' }}>
                        <FaMapMarkerAlt /> East Africa
                    </div>
                    <p className="text-lg leading-relaxed mb-8" style={{ color: 'var(--text-secondary)' }}>
                        {destination.description}
                    </p>
                    <div className="flex flex-wrap gap-3">
                        {(destination.highlights || []).map((highlight) => (
                            <span
                                key={highlight}
                                className="px-4 py-2 rounded-full text-sm font-semibold"
                                style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                            >
                                {highlight}
                            </span>
                        ))}
                    </div>
                </div>
            </section>

            {/* Tour Grid */}
            <section className="py-20 transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl md:text-4xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>
                            Safaris in <span style={{ color: 'var(--brand-gold)' }}>{displayName}</span>
                        </h2>
                        <p className="max-w-2xl mx-auto" style={{ color: 'var(--text-tertiary)' }}>
                            Browse our full range of {displayName} tours, from short city excursions to
                            multi-day wildlife and gorilla trekking adventures.
                        </p>
                    </div>

                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {[1, 2, 3].map((n) => (
                                <div key={n} className="rounded-2xl h-96 animate-pulse" style={{ background: 'var(--bg-tertiary)' }} />
                            ))}
                        </div>
                    ) : error ? (
                        <p className="text-center" style={{ color: 'var(--brand-maroon)' }}>{error}</p>
                    ) : tours.length === 0 ? (
                        <p className="text-center" style={{ color: 'var(--text-muted)' }}>
                            No {displayName} safaris available right now — check back soon or{' '}
                            <Link href="/contact" className="underline" style={{ color: 'var(--brand-gold)' }}>
                                contact us
                            </Link>{' '}
                            to plan a custom trip.
                        </p>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {tours.map((pkg) => (
                                <SafariCard key={pkg.id} tour={pkg} />
                            ))}
                        </div>
                    )}
                </div>
            </section>

            {/* CTA */}
            <section className="py-16" style={{ background: 'var(--bg-footer)' }}>
                <div className="container mx-auto px-4 text-center">
                    <h2 className="text-2xl md:text-3xl font-bold text-white mb-4">
                        Ready to explore {displayName}?
                    </h2>
                    <Link
                        href="/contact"
                        className="font-bold px-8 py-4 rounded-full transition transform hover:scale-105 inline-flex items-center gap-2"
                        style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                    >
                        Plan My Safari
                        <FaArrowRight />
                    </Link>
                </div>
            </section>
        </div>
    );
}
