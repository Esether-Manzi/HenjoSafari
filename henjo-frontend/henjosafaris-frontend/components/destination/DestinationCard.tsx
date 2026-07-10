'use client';

import Link from 'next/link';
import Image from 'next/image';
import { FaMapMarkerAlt, FaCamera, FaArrowRight } from 'react-icons/fa';

export interface DestinationData {
    name: string;
    slug: string;
    tagline: string;
    description: string;
    image: string;
    country: string;
    tours: number;
    highlights: string[];
    startingPrice: number;
    currency: string;
}

interface DestinationCardProps {
    destination: DestinationData;
    index: number;
    layout?: 'grid' | 'featured';
}

export default function DestinationCard({ destination, index, layout = 'grid' }: DestinationCardProps) {
    const isFeatured = layout === 'featured';

    return (
        <Link
            href={`/destinations/${destination.slug}`}
            className={`group relative block overflow-hidden rounded-2xl transition-all duration-500 ${
                isFeatured ? 'md:col-span-2 row-span-2' : ''
            }`}
            style={{ 
                animationDelay: `${index * 100}ms`,
                boxShadow: 'var(--shadow-lg)',
            }}
        >
            {/* Background Image */}
            <div className={`relative overflow-hidden ${isFeatured ? 'h-[500px]' : 'h-[380px]'}`}>
                <Image
                    src={destination.image}
                    alt={destination.name}
                    fill
                    className="object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                    sizes={isFeatured ? '(max-width: 768px) 100vw, 66vw' : '(max-width: 768px) 100vw, 33vw'}
                />
                {/* Gradient Overlay */}
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent" />

                {/* Tour Count Badge */}
                <div
                    className="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1"
                    style={{
                        background: 'var(--brand-gold)',
                        color: 'var(--text-on-gold)',
                    }}
                >
                    <FaCamera className="text-[10px]" />
                    {destination.tours} Safari{destination.tours !== 1 ? 's' : ''}
                </div>

                {/* Price Badge */}
                <div className="absolute top-4 right-4 bg-white/20 backdrop-blur-md text-white px-3 py-1 rounded-full text-xs font-semibold border border-white/30">
                    From {destination.currency}{destination.startingPrice.toLocaleString()}
                </div>

                {/* Content Overlay */}
                <div className="absolute bottom-0 left-0 right-0 p-6">
                    {/* Country Tag */}
                    <div className="flex items-center gap-1 text-sm font-medium mb-2" style={{ color: 'var(--brand-gold)' }}>
                        <FaMapMarkerAlt className="text-xs" />
                        {destination.country}
                    </div>

                    {/* Title */}
                    <h3 className={`font-bold text-white mb-1 ${isFeatured ? 'text-3xl' : 'text-2xl'}`}>
                        {destination.name}
                    </h3>

                    {/* Tagline */}
                    <p className="text-sm font-medium italic mb-3" style={{ color: 'rgba(229, 184, 58, 0.85)' }}>
                        {destination.tagline}
                    </p>

                    {/* Description */}
                    <p className={`text-gray-200 text-sm leading-relaxed mb-4 ${isFeatured ? 'line-clamp-3' : 'line-clamp-2'}`}>
                        {destination.description}
                    </p>

                    {/* Highlights */}
                    <div className="flex flex-wrap gap-2 mb-4">
                        {destination.highlights.slice(0, isFeatured ? 5 : 3).map((highlight) => (
                            <span
                                key={highlight}
                                className="text-xs bg-white/15 backdrop-blur-sm text-white px-2.5 py-1 rounded-full border border-white/20"
                            >
                                {highlight}
                            </span>
                        ))}
                    </div>

                    {/* CTA */}
                    <div className="flex items-center gap-2 font-semibold text-sm group-hover:gap-3 transition-all duration-300" style={{ color: 'var(--brand-gold)' }}>
                        Explore {destination.name}
                        <FaArrowRight className="text-xs group-hover:translate-x-1 transition-transform duration-300" />
                    </div>
                </div>
            </div>
        </Link>
    );
}
