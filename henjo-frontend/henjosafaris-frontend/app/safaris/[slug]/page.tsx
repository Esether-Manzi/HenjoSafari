'use client';

import { useEffect, useState } from 'react';
import { useParams } from 'next/navigation';
import Image from 'next/image';
import Link from 'next/link';
import Head from 'next/head';
import { 
    FaMapMarkerAlt, 
    FaClock, 
    FaUsers, 
    FaStar,
    FaCheckCircle,
    FaTimesCircle,
    FaChevronDown,
    FaChevronUp,
    FaWhatsapp,
    FaEnvelope,
    FaShare,
    FaHeart,
    FaRegHeart
} from 'react-icons/fa';
import Hero from '@/components/common/Hero';
import { safariApi } from '@/lib/api/safariApi';
import { getImageUrl } from '@/lib/utils/imageHelper';
import type { SafariPackage } from '@/types/safari';

export default function SafariDetailPage() {
    const params = useParams();
    const slug = params.slug as string;
    
    const [packageData, setPackageData] = useState<SafariPackage | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [isLiked, setIsLiked] = useState(false);
    const [expandedDay, setExpandedDay] = useState<number | null>(1);
    const [activeTab, setActiveTab] = useState<'overview' | 'itinerary' | 'inclusions'>('overview');
    const [showBookingForm, setShowBookingForm] = useState(false);

    useEffect(() => {
        const fetchPackage = async () => {
            try {
                console.log(`📡 Fetching package: ${slug}`);
                const response = await safariApi.getBySlug(slug);
                console.log('✅ Response:', response);
                
                if (response.success) {
                    setPackageData(response.data);
                } else {
                    setError('Package not found');
                }
            } catch (err: any) {
                console.error('❌ Error:', err);
                setError(err?.message || 'Failed to load package');
            } finally {
                setLoading(false);
            }
        };

        if (slug) {
            fetchPackage();
        }
    }, [slug]);

    if (loading) {
        return <PackageSkeleton />;
    }

    if (error || !packageData) {
        return <NotFound />;
    }

    const {
        title,
        summary,
        description,
        duration_days,
        duration_nights,
        base_price,
        currency,
        destination,
        categories,
        activities,
        accommodations,
        itineraryDays,
        inclusions,
        exclusions,
        media,
        featured,
        popular,
    } = packageData;

    // Get images using the helper
    const coverImage = getImageUrl(media, 'cover');
    const galleryImages = media?.filter((m: any) => m.collection_name === 'gallery') || [];

    return (
        <div className="min-h-screen" style={{ background: 'var(--bg-secondary)' }}>
            <Head>
                <title>{title} - Henjo African Safaris</title>
                <meta name="description" content={summary || description?.slice(0, 160)} />
            </Head>

            {/* Hero Section */}
            <section className="relative h-[60vh] min-h-[400px]">
                <div className="absolute inset-0">
                    <Image
                        src={coverImage}
                        alt={title}
                        fill
                        className="object-cover"
                        priority
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent" />
                </div>

                <div className="relative h-full container mx-auto px-4 flex flex-col justify-end pb-12">
                    <div className="max-w-3xl">
                        <div className="flex flex-wrap gap-2 mb-4">
                            {featured && (
                                <span className="px-3 py-1 rounded-full text-sm font-semibold" style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}>
                                    ★ Featured
                                </span>
                            )}
                            {popular && (
                                <span className="px-3 py-1 rounded-full text-sm font-semibold" style={{ background: 'var(--brand-maroon)', color: '#FFFFFF' }}>
                                    Popular
                                </span>
                            )}
                            {categories?.map((cat: any) => (
                                <span key={cat.id} className="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm">
                                    {cat.icon} {cat.name}
                                </span>
                            ))}
                        </div>

                        <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                            {title}
                        </h1>
                        <p className="text-lg text-white/90 mb-6 max-w-2xl">
                            {summary}
                        </p>

                        <div className="flex flex-wrap items-center gap-6 text-white">
                            <div className="flex items-center gap-2">
                                <FaMapMarkerAlt style={{ color: 'var(--brand-gold)' }} />
                                <span>{destination?.name}</span>
                            </div>
                            <div className="flex items-center gap-2">
                                <FaClock style={{ color: 'var(--brand-gold)' }} />
                                <span>{duration_days} Days / {duration_nights} Nights</span>
                            </div>
                            <div className="flex items-center gap-2">
                                <span className="text-2xl font-bold" style={{ color: 'var(--brand-gold)' }}>
                                    {currency} {base_price?.toLocaleString()}
                                </span>
                                <span className="text-white/60">/ person</span>
                            </div>
                        </div>

                        <div className="flex flex-wrap gap-4 mt-6">
                            <button
                                onClick={() => setShowBookingForm(true)}
                                className="font-bold px-8 py-3 rounded-full transition transform hover:scale-105"
                                style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                            >
                                Book This Safari
                            </button>
                            <button
                                onClick={() => setIsLiked(!isLiked)}
                                className="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-4 py-3 rounded-full transition"
                            >
                                {isLiked ? <FaHeart className="text-red-500" /> : <FaRegHeart />}
                            </button>
                            <button className="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-4 py-3 rounded-full transition">
                                <FaShare />
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            {/* Main Content */}
            <div className="container mx-auto px-4 py-12">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {/* Left Column - Main Content */}
                    <div className="lg:col-span-2">
                        {/* Breadcrumb */}
                        <nav className="flex items-center gap-2 text-sm mb-6" style={{ color: 'var(--text-muted)' }}>
                            <Link href="/" className="transition hover:text-[var(--brand-gold)]">Home</Link>
                            <span>/</span>
                            <Link href="/safaris" className="transition hover:text-[var(--brand-gold)]">Safaris</Link>
                            <span>/</span>
                            <span style={{ color: 'var(--text-primary)' }}>{title}</span>
                        </nav>

                        {/* Tabs */}
                        <div className="rounded-xl overflow-hidden mb-8" style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)' }}>
                            <div style={{ borderBottom: '1px solid var(--border-primary)' }}>
                                <div className="flex overflow-x-auto">
                                    {['overview', 'itinerary', 'inclusions'].map((tab) => (
                                        <button
                                            key={tab}
                                            onClick={() => setActiveTab(tab as any)}
                                            className="px-6 py-4 font-medium transition-colors whitespace-nowrap"
                                            style={{
                                                color: activeTab === tab ? 'var(--brand-gold)' : 'var(--text-muted)',
                                                borderBottom: activeTab === tab ? '2px solid var(--brand-gold)' : '2px solid transparent',
                                            }}
                                        >
                                            {tab.charAt(0).toUpperCase() + tab.slice(1)}
                                        </button>
                                    ))}
                                </div>
                            </div>

                            <div className="p-6">
                                {activeTab === 'overview' && (
                                    <OverviewTab 
                                        description={description}
                                        activities={activities}
                                        accommodations={accommodations}
                                        destination={destination}
                                    />
                                )}

                                {activeTab === 'itinerary' && (
                                    <ItineraryTab 
                                        itineraryDays={itineraryDays}
                                        expandedDay={expandedDay}
                                        onToggleDay={(day: number) => 
                                            setExpandedDay(expandedDay === day ? null : day)
                                        }
                                    />
                                )}

                                {activeTab === 'inclusions' && (
                                    <InclusionsTab 
                                        inclusions={inclusions}
                                        exclusions={exclusions}
                                    />
                                )}
                            </div>
                        </div>

                        {/* Gallery */}
                        {galleryImages.length > 0 && (
                            <div className="rounded-xl p-6" style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)' }}>
                                <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>Gallery</h3>
                                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    {galleryImages.slice(0, 8).map((image: any, index: number) => {
                                        const imgUrl = getImageUrl(media, 'gallery', index);
                                        return (
                                            <div key={index} className="relative h-32 rounded-lg overflow-hidden">
                                                <Image
                                                    src={imgUrl}
                                                    alt={`Gallery ${index + 1}`}
                                                    fill
                                                    className="object-cover hover:scale-110 transition duration-300"
                                                    onError={(e) => {
                                                        const target = e.target as HTMLImageElement;
                                                        target.src = '/images/placeholder.png';
                                                    }}
                                                />
                                            </div>
                                        );
                                    })}
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Right Column - Sidebar */}
                    <div className="lg:col-span-1">
                        <div className="rounded-xl p-6 sticky top-24" style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-lg)' }}>
                            <div className="text-center pb-4" style={{ borderBottom: '1px solid var(--border-primary)' }}>
                                <p className="text-sm" style={{ color: 'var(--text-muted)' }}>Starting from</p>
                                <p className="text-4xl font-bold" style={{ color: 'var(--brand-green)' }}>
                                    {currency} {base_price?.toLocaleString()}
                                </p>
                                <p className="text-sm" style={{ color: 'var(--text-muted)' }}>per person</p>
                            </div>

                            <div className="py-4 space-y-3">
                                <div className="flex justify-between">
                                    <span style={{ color: 'var(--text-secondary)' }}>Duration</span>
                                    <span className="font-semibold" style={{ color: 'var(--text-primary)' }}>{duration_days} Days / {duration_nights} Nights</span>
                                </div>
                                <div className="flex justify-between">
                                    <span style={{ color: 'var(--text-secondary)' }}>Destination</span>
                                    <span className="font-semibold" style={{ color: 'var(--text-primary)' }}>{destination?.name}</span>
                                </div>
                                <div className="flex justify-between">
                                    <span style={{ color: 'var(--text-secondary)' }}>Group Size</span>
                                    <span className="font-semibold" style={{ color: 'var(--text-primary)' }}>{packageData.min_people} - {packageData.max_people} people</span>
                                </div>
                                <div className="flex justify-between">
                                    <span style={{ color: 'var(--text-secondary)' }}>Guaranteed</span>
                                    <span className="font-semibold" style={{ color: 'var(--brand-green)' }}>✓ Best Price</span>
                                </div>
                            </div>

                            <div className="space-y-3">
                                <button
                                    onClick={() => setShowBookingForm(true)}
                                    className="w-full font-bold py-3 rounded-full transition"
                                    style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                >
                                    Book Now
                                </button>
                                <button className="w-full font-bold py-3 rounded-full transition" style={{ border: '2px solid var(--brand-gold)', color: 'var(--brand-gold)' }}>
                                    <FaWhatsapp className="inline mr-2" />
                                    WhatsApp Inquiry
                                </button>
                                <button className="w-full font-semibold py-3 rounded-full transition" style={{ border: '1px solid var(--border-primary)', color: 'var(--text-secondary)' }}>
                                    <FaEnvelope className="inline mr-2" />
                                    Email Inquiry
                                </button>
                            </div>

                            <div className="mt-4 p-4 rounded-lg text-center" style={{ background: 'var(--bg-secondary)' }}>
                                <p className="text-sm" style={{ color: 'var(--text-muted)' }}>
                                    Need help? Call us at<br />
                                    <span className="text-lg font-semibold" style={{ color: 'var(--text-primary)' }}>+255 123 456 789</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Booking Modal */}
            {showBookingForm && (
                <BookingModal 
                    packageData={packageData}
                    onClose={() => setShowBookingForm(false)}
                />
            )}
        </div>
    );
}

// ============================================
// COMPONENT: Overview Tab
// ============================================
function OverviewTab({ description, activities, accommodations, destination }: any) {
    return (
        <div className="space-y-8">
            <div>
                <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>Overview</h3>
                <div className="prose prose-lg max-w-none leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                    {description?.split('\n').map((paragraph: string, index: number) => (
                        <p key={index} className="mb-4">{paragraph}</p>
                    ))}
                </div>
            </div>

            {activities && activities.length > 0 && (
                <div>
                    <h4 className="text-lg font-bold mb-3" style={{ color: 'var(--text-primary)' }}>Activities</h4>
                    <div className="flex flex-wrap gap-2">
                        {activities.map((activity: any) => (
                            <span key={activity.id} className="px-4 py-2 rounded-full text-sm flex items-center gap-2" style={{ background: 'var(--bg-tertiary)', color: 'var(--text-secondary)' }}>
                                {activity.icon && <span>{activity.icon}</span>}
                                {activity.name}
                            </span>
                        ))}
                    </div>
                </div>
            )}

            {accommodations && accommodations.length > 0 && (
                <div>
                    <h4 className="text-lg font-bold mb-3" style={{ color: 'var(--text-primary)' }}>Accommodations</h4>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {accommodations.map((acc: any) => (
                            <div key={acc.id} className="rounded-lg p-4" style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-subtle)' }}>
                                <div className="flex justify-between items-start">
                                    <div>
                                        <h5 className="font-semibold">{acc.name}</h5>
                                        <p className="text-sm capitalize" style={{ color: 'var(--text-muted)' }}>{acc.type}</p>
                                        {acc.pivot?.package_level && (
                                            <span className="text-xs px-2 py-1 rounded-full inline-block mt-1 capitalize" style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}>
                                                {acc.pivot.package_level}
                                            </span>
                                        )}
                                    </div>
                                    {acc.star_rating && (
                                        <div className="flex" style={{ color: 'var(--brand-gold)' }}>
                                            {[...Array(acc.star_rating)].map((_, i) => (
                                                <FaStar key={i} size={16} />
                                            ))}
                                        </div>
                                    )}
                                </div>
                                {acc.description && (
                                    <p className="text-sm mt-2" style={{ color: 'var(--text-tertiary)' }}>{acc.description}</p>
                                )}
                            </div>
                        ))}
                    </div>
                </div>
            )}

            {destination && (
                <div className="rounded-lg p-6" style={{ background: 'var(--brand-gold-subtle)', border: '1px solid var(--brand-gold)' }}>
                    <h4 className="text-lg font-bold mb-2" style={{ color: 'var(--text-primary)' }}>About {destination.name}</h4>
                    <p style={{ color: 'var(--text-secondary)' }}>{destination.description}</p>
                    {destination.best_time_to_visit && (
                        <p className="text-sm mt-2" style={{ color: 'var(--text-muted)' }}>
                            <span className="font-semibold">Best time to visit:</span> {destination.best_time_to_visit}
                        </p>
                    )}
                    {destination.country && (
                        <p className="text-sm mt-1" style={{ color: 'var(--text-muted)' }}>
                            <FaMapMarkerAlt className="inline mr-1" />
                            {destination.country.name}
                        </p>
                    )}
                </div>
            )}
        </div>
    );
}

// ============================================
// COMPONENT: Itinerary Tab
// ============================================
function ItineraryTab({ itineraryDays, expandedDay, onToggleDay }: any) {
    return (
        <div>
            <h3 className="text-xl font-bold mb-6" style={{ color: 'var(--text-primary)' }}>Day-by-Day Itinerary</h3>
            <div className="space-y-4">
                {itineraryDays?.map((day: any) => (
                    <div key={day.id} className="rounded-lg overflow-hidden" style={{ border: '1px solid var(--border-primary)' }}>
                        <button
                            onClick={() => onToggleDay(day.day_number)}
                            className="w-full flex items-center justify-between p-4 transition"
                            style={{ background: 'var(--bg-secondary)' }}
                        >
                            <div className="flex items-center gap-4">
                                <span className="font-bold w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}>
                                    {day.day_number}
                                </span>
                                <span className="font-semibold" style={{ color: 'var(--text-primary)' }}>{day.title}</span>
                            </div>
                            {expandedDay === day.day_number ? <FaChevronUp /> : <FaChevronDown />}
                        </button>
                        {expandedDay === day.day_number && (
                            <div className="p-4" style={{ background: 'var(--bg-card)' }}>
                                <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>{day.description}</p>
                                <div className="flex gap-4 mt-3 text-sm" style={{ color: 'var(--text-muted)' }}>
                                    {day.breakfast && <span>🍳 Breakfast</span>}
                                    {day.lunch && <span>🥪 Lunch</span>}
                                    {day.dinner && <span>🍽️ Dinner</span>}
                                </div>
                            </div>
                        )}
                    </div>
                ))}
            </div>
        </div>
    );
}

// ============================================
// COMPONENT: Inclusions Tab
// ============================================
function InclusionsTab({ inclusions, exclusions }: any) {
    return (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 className="text-lg font-bold mb-4 flex items-center gap-2" style={{ color: 'var(--brand-green)' }}>
                    <FaCheckCircle /> Included
                </h3>
                <ul className="space-y-2">
                    {inclusions?.map((item: any) => (
                        <li key={item.id} className="flex items-start gap-2" style={{ color: 'var(--text-secondary)' }}>
                            <FaCheckCircle className="mt-1 flex-shrink-0" style={{ color: 'var(--brand-green)' }} />
                            <span>{item.item}</span>
                        </li>
                    ))}
                </ul>
            </div>

            <div>
                <h3 className="text-lg font-bold mb-4 flex items-center gap-2" style={{ color: 'var(--brand-maroon)' }}>
                    <FaTimesCircle /> Excluded
                </h3>
                <ul className="space-y-2">
                    {exclusions?.map((item: any) => (
                        <li key={item.id} className="flex items-start gap-2" style={{ color: 'var(--text-secondary)' }}>
                            <FaTimesCircle className="mt-1 flex-shrink-0" style={{ color: 'var(--brand-maroon)' }} />
                            <span>{item.item}</span>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    );
}

// ============================================
// COMPONENT: Booking Modal
// ============================================
function BookingModal({ packageData, onClose }: any) {
    const [step, setStep] = useState(1);
    const [formData, setFormData] = useState({
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        country: '',
        travelDate: '',
        adults: 1,
        children: 0,
        specialRequests: ''
    });

    const totalPrice = packageData.base_price * (formData.adults + formData.children * 0.5);

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            console.log('Booking submitted:', { ...formData, package_id: packageData.id });
            alert('Booking submitted successfully! We will contact you shortly.');
            onClose();
        } catch (error) {
            console.error('Booking error:', error);
            alert('There was an error submitting your booking. Please try again.');
        }
    };

    return (
        <div className="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div className="rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" style={{ background: 'var(--bg-card)' }}>
                <div className="sticky top-0 p-4 flex justify-between items-center" style={{ background: 'var(--bg-card)', borderBottom: '1px solid var(--border-primary)' }}>
                    <h2 className="text-xl font-bold" style={{ color: 'var(--text-primary)' }}>Book Your Safari</h2>
                    <button onClick={onClose} className="text-2xl" style={{ color: 'var(--text-muted)' }}>
                        ×
                    </button>
                </div>

                <div className="p-6">
                    <div className="rounded-lg p-4 mb-6" style={{ background: 'var(--brand-gold-subtle)', border: '1px solid var(--brand-gold)' }}>
                        <p className="font-semibold" style={{ color: 'var(--text-primary)' }}>{packageData.title}</p>
                        <p className="text-sm" style={{ color: 'var(--text-secondary)' }}>
                            {packageData.duration_days} Days / {packageData.duration_nights} Nights
                        </p>
                        <p className="text-lg font-bold" style={{ color: 'var(--brand-green)' }}>
                            {packageData.currency} {packageData.base_price.toLocaleString()} / person
                        </p>
                    </div>

                    <div className="flex items-center gap-2 mb-6">
                        {[1, 2].map((num) => (
                            <div key={num} className="flex items-center">
                                <div className="w-8 h-8 rounded-full flex items-center justify-center"
                                    style={{
                                        background: step >= num ? 'var(--brand-gold)' : 'var(--bg-tertiary)',
                                        color: step >= num ? 'var(--text-on-gold)' : 'var(--text-muted)'
                                    }}>
                                    {num}
                                </div>
                                {num < 2 && <div className="w-12 h-0.5" style={{ background: 'var(--border-primary)' }} />}
                            </div>
                        ))}
                    </div>

                    <form onSubmit={handleSubmit}>
                        {step === 1 && (
                            <div className="space-y-4">
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium mb-1" style={{ color: 'var(--text-secondary)' }}>First Name *</label>
                                        <input
                                            type="text"
                                            name="firstName"
                                            required
                                            value={formData.firstName}
                                            onChange={handleChange}
                                            className="w-full rounded-lg px-4 py-2 outline-none"
                                            style={{ background: 'var(--bg-input)', border: '1px solid var(--border-primary)', color: 'var(--text-primary)' }}
                                        />
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                                        <input
                                            type="text"
                                            name="lastName"
                                            required
                                            value={formData.lastName}
                                            onChange={handleChange}
                                            className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input
                                        type="email"
                                        name="email"
                                        required
                                        value={formData.email}
                                        onChange={handleChange}
                                        className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                                    <input
                                        type="tel"
                                        name="phone"
                                        required
                                        value={formData.phone}
                                        onChange={handleChange}
                                        className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                                    <select
                                        name="country"
                                        required
                                        value={formData.country}
                                        onChange={handleChange}
                                        className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                    >
                                        <option value="">Select your country</option>
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="DE">Germany</option>
                                        <option value="FR">France</option>
                                        <option value="IT">Italy</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="KE">Kenya</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="UG">Uganda</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        )}

                        {step === 2 && (
                            <div className="space-y-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Travel Date *</label>
                                    <input
                                        type="date"
                                        name="travelDate"
                                        required
                                        value={formData.travelDate}
                                        onChange={handleChange}
                                        min={new Date().toISOString().split('T')[0]}
                                        className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                    />
                                </div>

                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-1">Adults (12+ yrs) *</label>
                                        <input
                                            type="number"
                                            name="adults"
                                            required
                                            min={1}
                                            max={20}
                                            value={formData.adults}
                                            onChange={handleChange}
                                            className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                        />
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-1">Children (3-11 yrs)</label>
                                        <input
                                            type="number"
                                            name="children"
                                            min={0}
                                            max={10}
                                            value={formData.children}
                                            onChange={handleChange}
                                            className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Special Requests</label>
                                    <textarea
                                        name="specialRequests"
                                        rows={3}
                                        value={formData.specialRequests}
                                        onChange={handleChange}
                                        placeholder="Dietary requirements, accessibility needs, etc."
                                        className="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none resize-none"
                                    />
                                </div>

                                <div className="rounded-lg p-4" style={{ background: 'var(--bg-secondary)' }}>
                                    <h4 className="font-semibold mb-2">Price Summary</h4>
                                    <div className="space-y-1 text-sm">
                                        <div className="flex justify-between">
                                            <span>Adults ({formData.adults})</span>
                                            <span>{packageData.currency} {(packageData.base_price * formData.adults).toLocaleString()}</span>
                                        </div>
                                        {formData.children > 0 && (
                                            <div className="flex justify-between">
                                                <span>Children ({formData.children}) - 50%</span>
                                                <span>{packageData.currency} {(packageData.base_price * formData.children * 0.5).toLocaleString()}</span>
                                            </div>
                                        )}
                                        <div className="border-t border-gray-200 pt-2 mt-2 font-bold flex justify-between">
                                            <span>Total</span>
                                            <span style={{ color: 'var(--brand-green)' }}>{packageData.currency} {totalPrice.toLocaleString()}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )}

                        <div className="flex gap-4 mt-6 pt-6 border-t border-gray-200">
                            {step === 2 && (
                                <button
                                    type="button"
                                    onClick={() => setStep(1)}
                                    className="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-lg transition"
                                >
                                    Back
                                </button>
                            )}
                            {step === 1 ? (
                                <button
                                    type="button"
                                    onClick={() => setStep(2)}
                                    className="flex-1 font-bold py-3 rounded-lg transition"
                                    style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                >
                                    Continue
                                </button>
                            ) : (
                                <button
                                    type="submit"
                                    className="flex-1 font-bold py-3 rounded-lg transition"
                                    style={{ background: 'var(--brand-green)', color: '#FFFFFF' }}
                                >
                                    Book Safari
                                </button>
                            )}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}

// ============================================
// COMPONENT: Loading Skeleton
// ============================================
function PackageSkeleton() {
    return (
        <div className="min-h-screen" style={{ background: 'var(--bg-secondary)' }}>
            <div className="h-[60vh] animate-pulse" style={{ background: 'var(--bg-tertiary)' }} />
            <div className="container mx-auto px-4 py-12">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div className="lg:col-span-2">
                        <div className="rounded-xl p-6" style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-sm)' }}>
                            <div className="h-8 bg-gray-200 rounded w-1/3 mb-4 animate-pulse" />
                            <div className="h-4 bg-gray-200 rounded w-full mb-2 animate-pulse" />
                            <div className="h-4 bg-gray-200 rounded w-5/6 animate-pulse" />
                            <div className="h-4 bg-gray-200 rounded w-3/4 animate-pulse mt-2" />
                        </div>
                        <div className="mt-6 rounded-xl p-6" style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-sm)' }}>
                            <div className="h-6 bg-gray-200 rounded w-1/4 mb-4 animate-pulse" />
                            {[1, 2, 3, 4].map((i) => (
                                <div key={i} className="h-12 bg-gray-200 rounded mb-2 animate-pulse" />
                            ))}
                        </div>
                    </div>
                    <div>
                        <div className="rounded-xl p-6 sticky top-24" style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-lg)' }}>
                            <div className="h-24 bg-gray-200 rounded mb-4 animate-pulse" />
                            <div className="h-10 bg-gray-200 rounded mb-2 animate-pulse" />
                            <div className="h-10 bg-gray-200 rounded mb-2 animate-pulse" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

// ============================================
// COMPONENT: Not Found
// ============================================
function NotFound() {
    return (
        <div className="min-h-screen flex items-center justify-center" style={{ background: 'var(--bg-secondary)' }}>
            <div className="text-center">
                <h1 className="text-6xl font-bold mb-4" style={{ color: 'var(--text-muted)' }}>404</h1>
                <h2 className="text-2xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>Safari Not Found</h2>
                <p className="mb-6" style={{ color: 'var(--text-muted)' }}>The safari package you&apos;re looking for doesn&apos;t exist.</p>
                <Link href="/safaris" className="font-bold px-6 py-3 rounded-full transition inline-block" style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}>
                    View All Safaris
                </Link>
            </div>
        </div>
    );
}