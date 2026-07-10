'use client';

import Link from 'next/link';
import Image from 'next/image';
import { getImageUrl } from '@/lib/utils/imageHelper';
import { FaMapMarkerAlt, FaClock } from 'react-icons/fa';
import type { SafariPackage } from '@/types/safari';

interface SafariCardProps {
    tour: SafariPackage;
    featured?: boolean;
}

export default function SafariCard({ tour, featured = false }: SafariCardProps) {
    // ✅ Use the image helper
    const imageUrl = getImageUrl(tour.media, 'cover');

    return (
        <Link
            href={`/safaris/${tour.slug}`}
            className={`group rounded-2xl overflow-hidden transition duration-300 ${featured ? 'md:col-span-2 lg:col-span-1' : ''}`}
            style={{
                background: 'var(--bg-card)',
                boxShadow: 'var(--shadow-md)',
            }}
            onMouseEnter={(e) => {
                e.currentTarget.style.boxShadow = 'var(--shadow-lg)';
            }}
            onMouseLeave={(e) => {
                e.currentTarget.style.boxShadow = 'var(--shadow-md)';
            }}
        >
            <div className="relative h-56 overflow-hidden">
                <Image
                    src={imageUrl}
                    alt={tour.title}
                    fill
                    className="object-cover group-hover:scale-110 transition duration-500"
                />
                {tour.featured && (
                    <span
                        className="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold"
                        style={{
                            background: 'var(--brand-gold)',
                            color: 'var(--text-on-gold)',
                        }}
                    >
                        ★ Featured
                    </span>
                )}
                {tour.popular && (
                    <span
                        className="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-semibold"
                        style={{
                            background: 'var(--brand-maroon)',
                            color: '#FFFFFF',
                        }}
                    >
                        Popular
                    </span>
                )}
            </div>

            <div className="p-6">
                <h3
                    className="text-xl font-bold mb-2 transition line-clamp-1 group-hover:text-[var(--brand-gold)]"
                    style={{ color: 'var(--text-primary)' }}
                >
                    {tour.title}
                </h3>
                <p className="text-sm mb-4 line-clamp-2" style={{ color: 'var(--text-tertiary)' }}>
                    {tour.summary}
                </p>

                <div className="flex items-center gap-4 text-sm mb-4" style={{ color: 'var(--text-muted)' }}>
                    <span className="flex items-center gap-1">
                        <FaMapMarkerAlt style={{ color: 'var(--brand-gold)' }} />
                        {tour.destination?.name || 'Tanzania'}
                    </span>
                    <span className="flex items-center gap-1">
                        <FaClock style={{ color: 'var(--brand-gold)' }} />
                        {tour.duration_days} Days
                    </span>
                </div>

                <div
                    className="flex items-center justify-between pt-4"
                    style={{ borderTop: '1px solid var(--border-subtle)' }}
                >
                    <div>
                        <span className="text-2xl font-bold" style={{ color: 'var(--brand-green)' }}>
                            {tour.currency} {tour.base_price?.toLocaleString()}
                        </span>
                        <span className="text-sm ml-1" style={{ color: 'var(--text-muted)' }}>/ person</span>
                    </div>
                    <span
                        className="font-semibold px-4 py-2 rounded-full text-sm transition"
                        style={{
                            background: 'var(--brand-gold)',
                            color: 'var(--text-on-gold)',
                        }}
                    >
                        View Details →
                    </span>
                </div>
            </div>
        </Link>
    );
}