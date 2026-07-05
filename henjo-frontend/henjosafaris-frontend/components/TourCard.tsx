'use client';

import Link from 'next/link';
import Image from 'next/image';
import { FaMapMarkerAlt, FaClock, FaStar } from 'react-icons/fa';
import { Tour } from '@/types';

interface TourCardProps {
    tour: Tour;
    featured?: boolean;
}

const TourCard = ({ tour, featured = false }: TourCardProps) => {
    return (
        <div className={`group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 ${featured ? 'md:col-span-2' : ''}`}>
            {/* Image Container */}
            <div className="relative h-64 overflow-hidden">
                <Image
                    src={tour.image_url || '/images/placeholder.jpg'}
                    alt={tour.title}
                    fill
                    className="object-cover group-hover:scale-110 transition duration-500"
                />
                {tour.is_featured && (
                    <span className="absolute top-4 left-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-sm font-semibold">
                        Featured
                    </span>
                )}
                <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <div className="flex items-center gap-4 text-white">
                        <span className="flex items-center gap-1">
                            <FaMapMarkerAlt className="text-yellow-400" />
                            {tour.location}
                        </span>
                        <span className="flex items-center gap-1">
                            <FaClock className="text-yellow-400" />
                            {tour.duration_days} Days
                        </span>
                    </div>
                </div>
            </div>

            {/* Content */}
            <div className="p-6">
                <h3 className="text-xl font-bold text-gray-800 mb-2 group-hover:text-yellow-600 transition">
                    {tour.title}
                </h3>
                <p className="text-gray-600 text-sm mb-4 line-clamp-2">
                    {tour.description}
                </p>

                {/* Highlights */}
                <div className="flex flex-wrap gap-2 mb-4">
                    {tour.highlights?.slice(0, 3).map((highlight, index) => (
                        <span key={index} className="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full">
                            {highlight}
                        </span>
                    ))}
                </div>

                {/* Price & Book */}
                <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div>
                        <span className="text-sm text-gray-500">From</span>
                        <p className="text-2xl font-bold text-green-700">
                            ${tour.price}
                            <span className="text-sm font-normal text-gray-500"> / person</span>
                        </p>
                    </div>
                    <Link
                        href={`/tours/${tour.id}`}
                        className="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition duration-300 transform hover:scale-105"
                    >
                        View Details
                    </Link>
                </div>
            </div>
        </div>
    );
};

export default TourCard;