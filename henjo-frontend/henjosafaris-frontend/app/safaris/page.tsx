'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import Hero from '@/components/common/Hero';
import { safariApi } from '@/lib/api/safariApi';
import { getImageUrl } from '@/lib/utils/imageHelper';
import type { SafariPackage } from '@/types/safari';
import { FaMapMarkerAlt, FaClock } from 'react-icons/fa';

export default function SafarisPage() {
    const [packages, setPackages] = useState<SafariPackage[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchPackages = async () => {
            try {
                console.log('📡 Fetching packages...');
                const response = await safariApi.getAll();
                console.log('✅ Response:', response);
                
                if (response.success) {
                    const packageData = response.data?.data || response.data || [];
                    setPackages(packageData);
                } else {
                    setError('Failed to load packages');
                }
            } catch (err: any) {
                console.error('❌ Error:', err);
                const message = err?.response?.data?.message || err?.message || 'An error occurred';
                setError(message);
            } finally {
                setLoading(false);
            }
        };

        fetchPackages();
    }, []);

    return (
        <div className="min-h-screen">
            <Hero 
                size="medium"
                title="Our Safari Packages"
                subtitle="Discover the beauty of Tanzania with our carefully curated safari experiences"
                ctaText="Book Now"
                ctaLink="/contact"
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={true}
            />

            <div className="bg-gray-50 py-16">
                <div className="container mx-auto px-4">
                    {loading ? (
                        <div className="text-center py-12">
                            <div className="inline-block animate-spin rounded-full h-12 w-12 border-4 border-yellow-500 border-t-transparent"></div>
                            <p className="mt-4 text-gray-600">Loading safaris...</p>
                        </div>
                    ) : error ? (
                        <div className="bg-red-50 border border-red-200 rounded-lg p-6 text-center max-w-2xl mx-auto">
                            <p className="text-red-600 font-medium">❌ {error}</p>
                            <p className="mt-2 text-sm text-gray-600">
                                Make sure the Laravel backend is running and that the database has been migrated and seeded.
                            </p>
                            <button 
                                onClick={() => window.location.reload()}
                                className="mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition"
                            >
                                Try Again
                            </button>
                        </div>
                    ) : packages.length === 0 ? (
                        <div className="text-center py-12">
                            <p className="text-gray-500 text-lg">No packages found</p>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {packages.map((pkg) => {
                                // ✅ Get the image URL using the helper
                                const imageUrl = getImageUrl(pkg.media, 'cover');
                                
                                return (
                                    <Link 
                                        key={pkg.id} 
                                        href={`/safaris/${pkg.slug}`}
                                        className="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300"
                                    >
                                        <div className="relative h-56 overflow-hidden">
                                            <Image
                                                src={imageUrl}
                                                alt={pkg.title}
                                                fill
                                                className="object-cover group-hover:scale-110 transition duration-500"
                                                onError={(e) => {
                                                    // Fallback if image fails to load
                                                    const target = e.target as HTMLImageElement;
                                                    target.src = '/images/placeholder.png';
                                                }}
                                            />
                                            {pkg.featured && (
                                                <span className="absolute top-4 left-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-semibold">
                                                    ★ Featured
                                                </span>
                                            )}
                                            {pkg.popular && (
                                                <span className="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                    Popular
                                                </span>
                                            )}
                                        </div>

                                        <div className="p-6">
                                            <h3 className="text-xl font-bold text-gray-800 mb-2 group-hover:text-yellow-600 transition line-clamp-1">
                                                {pkg.title}
                                            </h3>
                                            <p className="text-gray-600 text-sm mb-4 line-clamp-2">
                                                {pkg.summary}
                                            </p>
                                            
                                            <div className="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                                <span className="flex items-center gap-1">
                                                    <FaMapMarkerAlt className="text-yellow-500" />
                                                    {pkg.destination?.name || 'Tanzania'}
                                                </span>
                                                <span className="flex items-center gap-1">
                                                    <FaClock className="text-yellow-500" />
                                                    {pkg.duration_days} Days
                                                </span>
                                            </div>

                                            <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                                                <div>
                                                    <span className="text-2xl font-bold text-green-700">
                                                        {pkg.currency} {pkg.base_price?.toLocaleString()}
                                                    </span>
                                                    <span className="text-sm text-gray-500 ml-1">/ person</span>
                                                </div>
                                                <span className="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-4 py-2 rounded-full text-sm transition">
                                                    View Details →
                                                </span>
                                            </div>
                                        </div>
                                    </Link>
                                );
                            })}
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}