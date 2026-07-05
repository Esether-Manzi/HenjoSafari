'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import Hero from '@/components/common/Hero';
import SafariCard from '@/components/safari/SafariCard';
import { safariApi } from '@/lib/api/safariApi';
import type { SafariPackage } from '@/types/safari';

export default function Home() {
    const [featured, setFeatured] = useState<SafariPackage[]>([]);
    const [loading, setLoading] = useState(true);
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
        fetchFeatured();
    }, []);

    return (
        <div>
            {/* Hero - Full size with image background */}
            <Hero 
                size="large"
                title="Discover Tanzania's Wild Heart"
                subtitle="Experience unforgettable safaris through the Serengeti, Ngorongoro Crater, and Zanzibar's pristine beaches."
                ctaText="Explore Safaris"
                ctaLink="/safaris"
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={true}
            />

            {/* Featured Tours */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <h2 className="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                            Featured <span className="text-yellow-500">Safaris</span>
                        </h2>
                        <p className="text-gray-600 max-w-2xl mx-auto">
                            Our most popular safari experiences handpicked for you
                        </p>
                    </div>

                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {[1, 2, 3].map((n) => (
                                <div key={n} className="bg-gray-200 rounded-2xl h-96 animate-pulse" />
                            ))}
                        </div>
                    ) : error ? (
                        <p className="text-center text-red-500">{error}</p>
                    ) : featured.length === 0 ? (
                        <p className="text-center text-gray-500">No featured tours available</p>
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
                            className="bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-8 py-3 rounded-full transition inline-block"
                        >
                            View All Safaris →
                        </Link>
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl md:text-4xl font-bold text-gray-800">
                            Why Choose <span className="text-yellow-500">Henjo African Safaris</span>
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                        {[
                            { icon: '🦁', title: 'Expert Guides', desc: 'Local experts with years of experience' },
                            { icon: '🗺️', title: 'Custom Itineraries', desc: 'Tailored to your preferences' },
                            { icon: '👥', title: 'Small Groups', desc: 'Intimate experiences with max 6 people' },
                            { icon: '🌿', title: 'Eco-Friendly', desc: 'Sustainable travel practices' },
                        ].map((item, i) => (
                            <div key={i} className="text-center p-6 bg-gray-50 rounded-2xl hover:shadow-lg transition">
                                <div className="text-4xl mb-4">{item.icon}</div>
                                <h3 className="text-xl font-bold text-gray-800 mb-2">{item.title}</h3>
                                <p className="text-gray-600 text-sm">{item.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
        </div>
    );
}