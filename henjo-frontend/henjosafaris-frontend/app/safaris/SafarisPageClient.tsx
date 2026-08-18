'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import Hero from '@/components/common/Hero';
import { safariApi } from '@/lib/api/safariApi';
import { getImageUrl } from '@/lib/utils/imageHelper';
import type { SafariPackage } from '@/types/safari';
import { FaMapMarkerAlt, FaClock, FaSearch, FaFilter, FaTimes, FaGlobeAfrica, FaPaw, FaMountain, FaCompass, FaExclamationTriangle, FaStar, FaCheck } from 'react-icons/fa';

// Fallback search options if database is empty or API fails
const FALLBACK_OPTIONS = {
    countries: [
        { id: 1, name: 'Uganda', code: 'UG' },
        { id: 2, name: 'Kenya', code: 'KE' },
        { id: 3, name: 'Tanzania', code: 'TZ' },
        { id: 4, name: 'Rwanda', code: 'RW' },
    ],
    categories: [
        { id: 1, name: 'Wildlife Adventure', slug: 'wildlife' },
        { id: 2, name: 'Gorilla Trekking', slug: 'gorilla' },
        { id: 3, name: 'Birding Tours', slug: 'birding' },
        { id: 4, name: 'Cultural Trips', slug: 'cultural' },
    ],
    destinations: [
        { id: 1, name: 'Serengeti', slug: 'serengeti' },
        { id: 2, name: 'Masai Mara', slug: 'masai-mara' },
        { id: 3, name: 'Bwindi Impenetrable', slug: 'bwindi' },
        { id: 4, name: 'Volcanoes NP', slug: 'volcanoes' },
    ],
    activities: [
        { id: 1, name: 'Game Drives', slug: 'game-drives' },
        { id: 2, name: 'Gorilla Tracking', slug: 'gorilla-tracking' },
        { id: 3, name: 'Walking Safari', slug: 'walking-safari' },
        { id: 4, name: 'Boat Cruise', slug: 'boat-cruise' },
    ],
};

export default function SafarisPage() {
    const [packages, setPackages] = useState<SafariPackage[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    // Filters Dropdowns Data
    const [options, setOptions] = useState({
        countries: FALLBACK_OPTIONS.countries,
        categories: FALLBACK_OPTIONS.categories,
        destinations: FALLBACK_OPTIONS.destinations,
        activities: FALLBACK_OPTIONS.activities,
    });

    // Active dropdown selector state
    const [activeDropdown, setActiveDropdown] = useState<string | null>(null);

    // Filters Selected State — initialized from the URL's query string
    // (e.g. /safaris?category=gorilla-safaris from the nav dropdown) so
    // links into this page land pre-filtered instead of showing everything.
    const [filters, setFilters] = useState(() => {
        if (typeof window === 'undefined') {
            return { search: '', country: '', category: '', destination: '', activity: '' };
        }
        const params = new URLSearchParams(window.location.search);
        return {
            search: params.get('search') || '',
            country: params.get('country') || '',
            category: params.get('category') || '',
            destination: params.get('destination') || '',
            activity: params.get('activity') || '',
        };
    });

    // Fetch filters drop-down options on mount
    useEffect(() => {
        const fetchFilters = async () => {
            try {
                const response = await safariApi.getFilterOptions();
                if (response.success && response.data) {
                    setOptions({
                        countries: response.data.countries?.length ? response.data.countries : FALLBACK_OPTIONS.countries,
                        categories: response.data.categories?.length ? response.data.categories : FALLBACK_OPTIONS.categories,
                        destinations: response.data.destinations?.length ? response.data.destinations : FALLBACK_OPTIONS.destinations,
                        activities: response.data.activities?.length ? response.data.activities : FALLBACK_OPTIONS.activities,
                    });
                }
            } catch (err) {
                console.warn('Unable to load api filter options, using fallbacks:', err);
            }
        };
        fetchFilters();
    }, []);

    // Fetch packages whenever filters change
    useEffect(() => {
        const fetchPackages = async () => {
            try {
                setLoading(true);
                // Construct query parameters
                const params: any = {};
                if (filters.search) params.search = filters.search;
                if (filters.country) params.country = filters.country;
                if (filters.category) params.category = filters.category;
                if (filters.destination) params.destination = filters.destination;
                if (filters.activity) params.activity = filters.activity;

                const response = await safariApi.getAll(params);
                
                if (response.success) {
                    const packageData = response.data?.data || response.data || [];
                    setPackages(packageData);
                    setError(null);
                } else {
                    setError('Failed to load packages');
                }
            } catch (err: any) {
                console.error('Error fetching filtered packages:', err);
                setError(err.message || 'An error occurred while loading packages');
            } finally {
                setLoading(false);
            }
        };

        fetchPackages();
    }, [filters]);

    const handleSelectFilter = (type: string, value: string) => {
        setFilters((prev) => ({
            ...prev,
            [type]: value,
        }));
        setActiveDropdown(null);
    };

    const handleClearFilters = () => {
        setFilters({
            search: '',
            country: '',
            category: '',
            destination: '',
            activity: '',
        });
        setActiveDropdown(null);
    };

    // Close dropdowns if user clicks outside
    useEffect(() => {
        const handleOutsideClick = () => setActiveDropdown(null);
        if (typeof window !== 'undefined') {
            window.addEventListener('click', handleOutsideClick);
        }
        return () => {
            if (typeof window !== 'undefined') {
                window.removeEventListener('click', handleOutsideClick);
            }
        };
    }, []);

    const toggleDropdown = (e: React.MouseEvent, type: string) => {
        e.stopPropagation(); // Avoid triggering window click
        setActiveDropdown((prev) => (prev === type ? null : type));
    };

    // Helper to get active filter display label
    const getFilterLabel = (type: 'country' | 'category' | 'destination' | 'activity', value: string) => {
        if (!value) {
            return type.charAt(0).toUpperCase() + type.slice(1);
        }
        if (type === 'country') {
            const country = options.countries.find(c => c.name === value || c.code === value);
            return country ? country.name : value;
        }
        
        let list: any[] = [];
        if (type === 'category') {
            list = options.categories;
        } else if (type === 'destination') {
            list = options.destinations;
        } else if (type === 'activity') {
            list = options.activities;
        }

        const item = list?.find((item: any) => item.slug === value);
        return item ? item.name : value;
    };

    const hasActiveFilters = Object.values(filters).some(val => val !== '');

    return (
        <div className="min-h-screen transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
            {/* Hero Banner */}
            <Hero 
                size="medium"
                title="Our Safari Packages"
                subtitle="Discover the beauty of East Africa with our carefully curated safari experiences"
                ctaText="Customize My Safari"
                ctaLink="/contact"
                backgroundImage="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?q=80&w=1600&auto=format&fit=crop"
                overlay={true}
                showTagline={true}
            />

            {/* Mini Search & Filter Navigation Overlay */}
            <div className="relative z-30 px-4 -mt-12 md:-mt-16">
                <div 
                    className="max-w-5xl mx-auto rounded-3xl p-4 md:p-6 transition-all duration-300 shadow-2xl border"
                    style={{
                        background: 'rgba(255, 255, 255, 0.12)',
                        backdropFilter: 'blur(16px)',
                        borderColor: 'rgba(255, 255, 255, 0.25)',
                    }}
                    onMouseEnter={(e) => {
                        e.currentTarget.style.background = 'rgba(255, 255, 255, 0.2)';
                        e.currentTarget.style.borderColor = 'rgba(255, 255, 255, 0.35)';
                    }}
                    onMouseLeave={(e) => {
                        e.currentTarget.style.background = 'rgba(255, 255, 255, 0.12)';
                        e.currentTarget.style.borderColor = 'rgba(255, 255, 255, 0.25)';
                    }}
                >
                    <div className="grid grid-cols-1 md:grid-cols-5 gap-3 md:gap-4 items-center">
                        {/* Text Search Input */}
                        <div className="relative">
                            <span className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/70">
                                <FaSearch size={14} />
                            </span>
                            <input
                                type="text"
                                className="w-full pl-9 pr-4 py-3 rounded-2xl outline-none text-sm text-white placeholder-white/75 bg-black/35 focus:bg-black/50 border border-white/10 focus:border-white/30 transition-colors"
                                placeholder="Search safaris..."
                                value={filters.search}
                                onChange={(e) => setFilters(prev => ({ ...prev, search: e.target.value }))}
                            />
                        </div>

                        {/* Country Filter Dropdown */}
                        <div className="relative">
                            <button
                                onClick={(e) => toggleDropdown(e, 'country')}
                                className="w-full px-4 py-3 rounded-2xl text-left text-sm text-white bg-black/35 focus:bg-black/50 border border-white/10 hover:border-white/30 transition-colors flex justify-between items-center"
                            >
                                <span className={`flex items-center gap-2 ${filters.country ? 'font-bold text-[var(--brand-gold)]' : ''}`}>
                                    <FaGlobeAfrica /> {getFilterLabel('country', filters.country)}
                                </span>
                                <span className="text-white/60">▼</span>
                            </button>
                            {activeDropdown === 'country' && (
                                <div className="absolute left-0 mt-2 w-56 rounded-2xl shadow-lg border p-2 z-50 bg-[#152018] border-[#2A3E2E]">
                                    <button
                                        onClick={() => handleSelectFilter('country', '')}
                                        className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition"
                                    >
                                        All Countries
                                    </button>
                                    {options.countries.map((c) => (
                                        <button
                                            key={c.id}
                                            onClick={() => handleSelectFilter('country', c.name)}
                                            className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition flex justify-between"
                                        >
                                            <span>{c.name}</span>
                                            {filters.country === c.name && <span className="text-[var(--brand-gold)]"><FaCheck /></span>}
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Category Filter Dropdown */}
                        <div className="relative">
                            <button
                                onClick={(e) => toggleDropdown(e, 'category')}
                                className="w-full px-4 py-3 rounded-2xl text-left text-sm text-white bg-black/35 focus:bg-black/50 border border-white/10 hover:border-white/30 transition-colors flex justify-between items-center"
                            >
                                <span className={`flex items-center gap-2 ${filters.category ? 'font-bold text-[var(--brand-gold)]' : ''}`}>
                                    <FaPaw /> {getFilterLabel('category', filters.category)}
                                </span>
                                <span className="text-white/60">▼</span>
                            </button>
                            {activeDropdown === 'category' && (
                                <div className="absolute left-0 mt-2 w-56 rounded-2xl shadow-lg border p-2 z-50 bg-[#152018] border-[#2A3E2E]">
                                    <button
                                        onClick={() => handleSelectFilter('category', '')}
                                        className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition"
                                    >
                                        All Categories
                                    </button>
                                    {options.categories.map((c: any) => (
                                        <button
                                            key={c.id}
                                            onClick={() => handleSelectFilter('category', c.slug)}
                                            className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition flex justify-between"
                                        >
                                            <span>{c.name}</span>
                                            {filters.category === c.slug && <span className="text-[var(--brand-gold)]"><FaCheck /></span>}
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Destination Filter Dropdown */}
                        <div className="relative">
                            <button
                                onClick={(e) => toggleDropdown(e, 'destination')}
                                className="w-full px-4 py-3 rounded-2xl text-left text-sm text-white bg-black/35 focus:bg-black/50 border border-white/10 hover:border-white/30 transition-colors flex justify-between items-center"
                            >
                                <span className={`flex items-center gap-2 ${filters.destination ? 'font-bold text-[var(--brand-gold)]' : ''}`}>
                                    <FaMountain /> {getFilterLabel('destination', filters.destination)}
                                </span>
                                <span className="text-white/60">▼</span>
                            </button>
                            {activeDropdown === 'destination' && (
                                <div className="absolute left-0 mt-2 w-56 rounded-2xl shadow-lg border p-2 z-50 bg-[#152018] border-[#2A3E2E]">
                                    <button
                                        onClick={() => handleSelectFilter('destination', '')}
                                        className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition"
                                    >
                                        All Destinations
                                    </button>
                                    {options.destinations.map((d: any) => (
                                        <button
                                            key={d.id}
                                            onClick={() => handleSelectFilter('destination', d.slug)}
                                            className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition flex justify-between"
                                        >
                                            <span>{d.name}</span>
                                            {filters.destination === d.slug && <span className="text-[var(--brand-gold)]"><FaCheck /></span>}
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Activity Filter Dropdown */}
                        <div className="relative">
                            <button
                                onClick={(e) => toggleDropdown(e, 'activity')}
                                className="w-full px-4 py-3 rounded-2xl text-left text-sm text-white bg-black/35 focus:bg-black/50 border border-white/10 hover:border-white/30 transition-colors flex justify-between items-center"
                            >
                                <span className={`flex items-center gap-2 ${filters.activity ? 'font-bold text-[var(--brand-gold)]' : ''}`}>
                                    <FaCompass /> {getFilterLabel('activity', filters.activity)}
                                </span>
                                <span className="text-white/60">▼</span>
                            </button>
                            {activeDropdown === 'activity' && (
                                <div className="absolute left-0 mt-2 w-56 rounded-2xl shadow-lg border p-2 z-50 bg-[#152018] border-[#2A3E2E]">
                                    <button
                                        onClick={() => handleSelectFilter('activity', '')}
                                        className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition"
                                    >
                                        All Activities
                                    </button>
                                    {options.activities.map((a: any) => (
                                        <button
                                            key={a.id}
                                            onClick={() => handleSelectFilter('activity', a.slug)}
                                            className="w-full text-left px-4 py-2 text-sm text-white hover:bg-white/10 rounded-xl transition flex justify-between"
                                        >
                                            <span>{a.name}</span>
                                            {filters.activity === a.slug && <span className="text-[var(--brand-gold)]"><FaCheck /></span>}
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Active Filter Tags Bar */}
                    {hasActiveFilters && (
                        <div className="mt-4 pt-4 border-t border-white/10 flex flex-wrap items-center gap-2 text-xs text-white">
                            <span className="text-white/60 flex items-center gap-1 font-semibold"><FaFilter size={10} /> Active Filters:</span>
                            {filters.search && (
                                <span className="bg-white/15 px-3 py-1 rounded-full flex items-center gap-1 border border-white/10">
                                    Search: &quot;{filters.search}&quot;
                                    <button onClick={() => handleSelectFilter('search', '')} className="hover:text-[var(--brand-gold)]"><FaTimes size={10} /></button>
                                </span>
                            )}
                            {filters.country && (
                                <span className="bg-white/15 px-3 py-1 rounded-full flex items-center gap-1 border border-white/10">
                                    Country: {getFilterLabel('country', filters.country)}
                                    <button onClick={() => handleSelectFilter('country', '')} className="hover:text-[var(--brand-gold)]"><FaTimes size={10} /></button>
                                </span>
                            )}
                            {filters.category && (
                                <span className="bg-white/15 px-3 py-1 rounded-full flex items-center gap-1 border border-white/10">
                                    Category: {getFilterLabel('category', filters.category)}
                                    <button onClick={() => handleSelectFilter('category', '')} className="hover:text-[var(--brand-gold)]"><FaTimes size={10} /></button>
                                </span>
                            )}
                            {filters.destination && (
                                <span className="bg-white/15 px-3 py-1 rounded-full flex items-center gap-1 border border-white/10">
                                    Destination: {getFilterLabel('destination', filters.destination)}
                                    <button onClick={() => handleSelectFilter('destination', '')} className="hover:text-[var(--brand-gold)]"><FaTimes size={10} /></button>
                                </span>
                            )}
                            {filters.activity && (
                                <span className="bg-white/15 px-3 py-1 rounded-full flex items-center gap-1 border border-white/10">
                                    Activity: {getFilterLabel('activity', filters.activity)}
                                    <button onClick={() => handleSelectFilter('activity', '')} className="hover:text-[var(--brand-gold)]"><FaTimes size={10} /></button>
                                </span>
                            )}
                            <button
                                onClick={handleClearFilters}
                                className="text-[var(--brand-gold)] hover:underline ml-auto font-bold"
                            >
                                Clear All
                            </button>
                        </div>
                    )}
                </div>
            </div>

            {/* Safaris Packages Listing */}
            <div className="py-20 transition-colors duration-300">
                <div className="container mx-auto px-4">
                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {[1, 2, 3].map((n) => (
                                <div
                                    key={n}
                                    className="rounded-2xl h-[450px] animate-pulse"
                                    style={{ background: 'var(--bg-tertiary)' }}
                                />
                            ))}
                        </div>
                    ) : error ? (
                        <div
                            className="rounded-2xl p-8 text-center max-w-2xl mx-auto border"
                            style={{
                                background: 'var(--bg-card)',
                                borderColor: 'var(--brand-maroon)',
                            }}
                        >
                            <p className="font-semibold text-lg flex items-center justify-center gap-2" style={{ color: 'var(--brand-maroon)' }}><FaExclamationTriangle /> Error Loading Safaris</p>
                            <p className="text-sm mt-2" style={{ color: 'var(--text-secondary)' }}>{error}</p>
                            <button 
                                onClick={() => window.location.reload()}
                                className="mt-6 font-semibold px-6 py-2 rounded-full transition hover:scale-105"
                                style={{
                                    background: 'var(--brand-gold)',
                                    color: 'var(--text-on-gold)',
                                }}
                            >
                                Try Again
                            </button>
                        </div>
                    ) : packages.length === 0 ? (
                        <div className="text-center py-20">
                            <p className="text-xl font-bold" style={{ color: 'var(--text-secondary)' }}>No safari packages found</p>
                            <p className="text-sm mt-2" style={{ color: 'var(--text-muted)' }}>Try adjusting your filters or keyword query.</p>
                            <button
                                onClick={handleClearFilters}
                                className="mt-6 font-semibold px-6 py-2 rounded-full transition hover:scale-105"
                                style={{
                                    background: 'var(--brand-gold)',
                                    color: 'var(--text-on-gold)',
                                }}
                            >
                                Reset Search Filters
                            </button>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {packages.map((pkg) => {
                                const imageUrl = getImageUrl(pkg.media, 'cover');
                                return (
                                    <Link 
                                        key={pkg.id} 
                                        href={`/safaris/${pkg.slug}`}
                                        className="group rounded-2xl overflow-hidden transition duration-300 flex flex-col justify-between"
                                        style={{
                                            background: 'var(--bg-card)',
                                            boxShadow: 'var(--shadow-md)',
                                        }}
                                    >
                                        <div>
                                            <div className="relative h-56 overflow-hidden">
                                                <Image
                                                    src={imageUrl}
                                                    alt={pkg.title}
                                                    fill
                                                    className="object-cover group-hover:scale-110 transition duration-500"
                                                    onError={(e) => {
                                                        const target = e.target as HTMLImageElement;
                                                        target.src = '/images/placeholder.png';
                                                    }}
                                                />
                                                {pkg.featured && (
                                                    <span
                                                        className="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1"
                                                        style={{
                                                            background: 'var(--brand-gold)',
                                                            color: 'var(--text-on-gold)',
                                                        }}
                                                    >
                                                        <FaStar /> Featured
                                                    </span>
                                                )}
                                                {pkg.popular && (
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
                                                    {pkg.title}
                                                </h3>
                                                <p className="text-sm mb-4 line-clamp-2" style={{ color: 'var(--text-tertiary)' }}>
                                                    {pkg.summary}
                                                </p>
                                                
                                                <div className="flex items-center gap-4 text-sm mb-4" style={{ color: 'var(--text-muted)' }}>
                                                    <span className="flex items-center gap-1">
                                                        <FaMapMarkerAlt style={{ color: 'var(--brand-gold)' }} />
                                                        {pkg.destination?.name || 'Tanzania'}
                                                    </span>
                                                    <span className="flex items-center gap-1">
                                                        <FaClock style={{ color: 'var(--brand-gold)' }} />
                                                        {pkg.duration_days} Days
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="p-6 pt-0">
                                            <div
                                                className="flex items-center justify-between pt-4"
                                                style={{ borderTop: '1px solid var(--border-subtle)' }}
                                            >
                                                <div>
                                                    {Number(pkg.base_price) > 0 ? (
                                                        <>
                                                            <span className="text-2xl font-bold" style={{ color: 'var(--brand-green)' }}>
                                                                {pkg.currency} {pkg.base_price?.toLocaleString()}
                                                            </span>
                                                            <span className="text-sm ml-1" style={{ color: 'var(--text-muted)' }}>/ person</span>
                                                        </>
                                                    ) : (
                                                        <span className="text-lg font-bold" style={{ color: 'var(--brand-green)' }}>
                                                            Contact for Price
                                                        </span>
                                                    )}
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
                            })}
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}