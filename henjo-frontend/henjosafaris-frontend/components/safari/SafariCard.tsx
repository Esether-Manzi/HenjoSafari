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
            className={`group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 ${featured ? 'md:col-span-2 lg:col-span-1' : ''}`}
        >
            <div className="relative h-56 overflow-hidden">
                <Image
                    src={imageUrl}
                    alt={tour.title}
                    fill
                    className="object-cover group-hover:scale-110 transition duration-500"
                />
                {tour.featured && (
                    <span className="absolute top-4 left-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-semibold">
                        ★ Featured
                    </span>
                )}
                {tour.popular && (
                    <span className="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Popular
                    </span>
                )}
            </div>

            <div className="p-6">
                <h3 className="text-xl font-bold text-gray-800 mb-2 group-hover:text-yellow-600 transition line-clamp-1">
                    {tour.title}
                </h3>
                <p className="text-gray-600 text-sm mb-4 line-clamp-2">
                    {tour.summary}
                </p>

                <div className="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span className="flex items-center gap-1">
                        <FaMapMarkerAlt className="text-yellow-500" />
                        {tour.destination?.name || 'Tanzania'}
                    </span>
                    <span className="flex items-center gap-1">
                        <FaClock className="text-yellow-500" />
                        {tour.duration_days} Days
                    </span>
                </div>

                <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div>
                        <span className="text-2xl font-bold text-green-700">
                            {tour.currency} {tour.base_price?.toLocaleString()}
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
}