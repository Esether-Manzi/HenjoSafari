'use client';

import { useEffect, useMemo, useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import Hero from '@/components/common/Hero';
import SafariCard from '@/components/safari/SafariCard';
import { safariApi } from '@/lib/api/safariApi';
import { pagesApi } from '@/lib/api/pagesApi';
import { testimonialApi } from '@/lib/api/testimonialApi';
import { settingsApi } from '@/lib/api/settingsApi';
import { getInitials } from '@/lib/utils/formatters';
import { cleanText } from '@/lib/utils/textFormat';
import {
    FaGlobeAfrica, FaUserTie, FaMapMarkedAlt, FaUsers, FaLeaf, FaLaptop, FaChild, FaWheelchair,
    FaFirstAid, FaCompass, FaStar, FaRegStar, FaShieldAlt, FaQuoteLeft, FaHandshake,
    FaFacebookF, FaInstagram, FaLinkedinIn, FaTiktok, FaTwitter, FaTripadvisor,
} from 'react-icons/fa';
import type { SafariPackage, Activity } from '@/types/safari';
import type { CmsPage } from '@/types/page';
import type { Testimonial } from '@/types/testimonial';
import type { SiteSettings } from '@/types/settings';
import { sectionsByGroup, firstInGroup } from '@/types/page';

const SECTION_ICONS: Record<string, React.ComponentType<{ className?: string; style?: React.CSSProperties }>> = {
    'user-tie': FaUserTie,
    map: FaMapMarkedAlt,
    users: FaUsers,
    leaf: FaLeaf,
    laptop: FaLaptop,
    child: FaChild,
    wheelchair: FaWheelchair,
    'first-aid': FaFirstAid,
};

// The backend's public API is served under `/api/v1`, but static files
// (Laravel's storage:link) live directly on that same host — so we derive
// the origin from the API URL rather than hardcoding it.
const API_ORIGIN = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/api\/v1\/?$/, '');
const HERO_VIDEO_URL = `${API_ORIGIN}/storage/images/home-page-hero-section.mp4`;

// Picks up to `perCountry` packages from each destination country, preserving
// the order countries first appear in — keeps the featured list varied
// instead of it being dominated by whichever country has the most entries.
function pickPerCountry(packages: SafariPackage[], perCountry = 2): SafariPackage[] {
    const counts = new Map<string, number>();
    const picked: SafariPackage[] = [];

    for (const pkg of packages) {
        const countryKey = pkg.destination?.country?.id != null
            ? String(pkg.destination.country.id)
            : `no-country-${pkg.destination_id ?? 'unknown'}`;
        const count = counts.get(countryKey) ?? 0;
        if (count < perCountry) {
            counts.set(countryKey, count + 1);
            picked.push(pkg);
        }
    }

    return picked;
}

function getActivityImage(activity: Activity): string {
    if (activity.media && activity.media.length > 0) {
        return activity.media[0].original_url || activity.media[0].large_url || '/images/placeholder.png';
    }
    // Mock/placeholder activities carry a direct image URL in `icon`; real
    // API activities use it as an icon *key* (e.g. "game-drive"), so only
    // treat it as an image when it actually looks like one.
    if (activity.icon && activity.icon.startsWith('http')) {
        return activity.icon;
    }
    return '/images/placeholder.png';
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
        name: "Mountain Gorilla Trekking",
        slug: "mountain-gorilla-trekking",
        description: "Hike through misty rainforests to sit with mountain gorillas.",
        icon: "https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=600&auto=format&fit=crop"
    },
    {
        id: 3,
        name: "Chimpanzee Trekking",
        slug: "chimpanzee-trekking",
        description: "Track playful chimp families through the forest canopy.",
        icon: "https://images.unsplash.com/photo-1470240731273-7821a6eeb6bd?q=80&w=600&auto=format&fit=crop"
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

// Used only if the backend has no featured testimonials yet, so the section
// never renders empty.
const MOCK_TESTIMONIALS: Testimonial[] = [
    {
        id: -1,
        name: 'Sarah Mitchell',
        country: 'United Kingdom',
        trip_name: 'Gorilla Trekking & Queen Elizabeth Safari',
        testimonial: 'Henjo African Safaris exceeded every expectation. Our guide knew exactly where to find the gorillas and made the trek feel safe and unforgettable.',
        rating: 5,
        featured: true,
    },
    {
        id: -2,
        name: 'Daniel Kruger',
        country: 'South Africa',
        trip_name: 'Serengeti & Ngorongoro Crater Safari',
        testimonial: 'We saw the Big Five within three days thanks to our incredible driver-guide. Every camp was beautifully chosen and the itinerary paced perfectly.',
        rating: 5,
        featured: true,
    },
    {
        id: -3,
        name: 'Emily & Mark Thompson',
        country: 'United States',
        trip_name: 'Rwanda Gorilla & Golden Monkey Tour',
        testimonial: 'From the first email to the final drop-off, the Henjo team was responsive, honest, and clearly passionate about conservation.',
        rating: 5,
        featured: true,
    },
];

const SOCIAL_LINKS = [
    { name: 'Facebook', icon: FaFacebookF, url: (s: SiteSettings | null) => s?.facebook_url, color: '#1877F2' },
    { name: 'Instagram', icon: FaInstagram, url: (s: SiteSettings | null) => s?.instagram_url, color: 'radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%)' },
    { name: 'Twitter', icon: FaTwitter, url: (s: SiteSettings | null) => s?.twitter_url, color: '#1DA1F2' },
    { name: 'LinkedIn', icon: FaLinkedinIn, url: (s: SiteSettings | null) => s?.linkedin_url, color: '#0A66C2' },
    { name: 'TikTok', icon: FaTiktok, url: (s: SiteSettings | null) => s?.tiktok_url, color: '#000000' },
    { name: 'TripAdvisor', icon: FaTripadvisor, url: (s: SiteSettings | null) => s?.tripadvisor_url, color: '#34E0A1' },
];

function StarRating({ rating }: { rating: number }) {
    return (
        <div className="flex gap-1" aria-label={`${rating} out of 5 stars`}>
            {[1, 2, 3, 4, 5].map((n) => (
                n <= rating
                    ? <FaStar key={n} style={{ color: 'var(--brand-gold)' }} />
                    : <FaRegStar key={n} style={{ color: 'var(--brand-gold)' }} />
            ))}
        </div>
    );
}

function getTestimonialAvatar(testimonial: Testimonial): string | null {
    if (testimonial.media && testimonial.media.length > 0) {
        const avatar = testimonial.media.find((m) => m.collection_name === 'avatar');
        return avatar?.original_url || avatar?.medium_url || null;
    }
    return null;
}

export default function Home() {
    const [featured, setFeatured] = useState<SafariPackage[]>([]);
    const [activities, setActivities] = useState<Activity[]>([]);
    const [page, setPage] = useState<CmsPage | null>(null);
    const [testimonials, setTestimonials] = useState<Testimonial[]>([]);
    const [settings, setSettings] = useState<SiteSettings | null>(null);
    const [loading, setLoading] = useState(true);
    const [activitiesLoading, setActivitiesLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchPage = async () => {
            try {
                const response = await pagesApi.getBySlug('home');
                if (response.success) {
                    setPage(response.data);
                }
            } catch (err) {
                console.warn('Unable to load home page content, using defaults:', err);
            }
        };

        fetchPage();

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

        const fetchTestimonials = async () => {
            try {
                const response = await testimonialApi.getFeatured();
                if (response.success && response.data?.length > 0) {
                    setTestimonials(response.data);
                } else {
                    setTestimonials(MOCK_TESTIMONIALS);
                }
            } catch (err) {
                console.warn('Unable to load testimonials from API, using placeholders:', err);
                setTestimonials(MOCK_TESTIMONIALS);
            }
        };

        const fetchSettings = async () => {
            try {
                const response = await settingsApi.getSettings();
                if (response.success) {
                    setSettings(response.data);
                }
            } catch (err) {
                console.warn('Unable to load site settings:', err);
            }
        };

        fetchFeatured();
        fetchActivities();
        fetchTestimonials();
        fetchSettings();
    }, []);

    const featuredByCountry = useMemo(() => pickPerCountry(featured, 2), [featured]);

    const activeSocialLinks = useMemo(
        () => SOCIAL_LINKS
            .map((social) => ({ ...social, href: social.url(settings) }))
            .filter((social): social is typeof social & { href: string } => Boolean(social.href)),
        [settings]
    );

    const introSection = firstInGroup(page?.sections, 'intro');
    const featuredHeading = firstInGroup(page?.sections, 'featured-heading');
    const activitiesHeading = firstInGroup(page?.sections, 'activities-heading');
    const featuresHeading = firstInGroup(page?.sections, 'features-heading');
    const featureCards = sectionsByGroup(page?.sections, 'features');
    const offersHeading = firstInGroup(page?.sections, 'offers-heading');
    const offerCards = sectionsByGroup(page?.sections, 'offers');
    const finalCta = firstInGroup(page?.sections, 'final-cta');
    const partners = sectionsByGroup(page?.sections, 'partners');

    return (
        <div>
            {/* Hero - Full size with image background */}
            <Hero
                size="large"
                variant="home"
                title={page?.hero_title || 'Discover the Wild Side of East Africa'}
                subtitle={page?.hero_subtitle || 'Bespoke safaris, gorilla trekking, and tailor-made holidays across Uganda, Kenya, Tanzania, and Rwanda.'}
                ctaText={page?.hero_cta_text || 'Explore Safaris'}
                ctaLink={page?.hero_cta_href || '/safaris'}
                backgroundImage="/images/placeholder.png"
                backgroundVideo={settings?.homepage_hero_url || HERO_VIDEO_URL}
                overlay={true}
                showTagline={true}
            />

            {/* Why Henjo African Safaris */}
            <section className="relative py-20 overflow-hidden transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                {/* Decorative glow blobs */}
                <div
                    className="absolute -top-24 -left-24 w-72 h-72 rounded-full blur-3xl opacity-20 animate-float pointer-events-none"
                    style={{ background: 'var(--brand-gold)' }}
                />
                <div
                    className="absolute -bottom-24 -right-24 w-72 h-72 rounded-full blur-3xl opacity-20 animate-float pointer-events-none"
                    style={{ background: 'var(--brand-green)', animationDelay: '2s' }}
                />

                <div className="relative container mx-auto px-4 max-w-3xl text-center">
                    <span
                        className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-5"
                        style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                    >
                        <FaCompass /> Why Travel With Us
                    </span>
                    <h2 className="text-3xl md:text-4xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>
                        {introSection?.title || 'Well organized tours to elevate your spirit!'}
                    </h2>
                    <p className="text-lg" style={{ color: 'var(--text-tertiary)' }}>
                        {introSection?.description || 'The combination of our experienced team of travel consultants and our certified driver guide assures a safe, treasurable, thrilling and informative safari.'}
                    </p>
                </div>
            </section>

            {/* Featured Tours */}
            <section
                className="relative py-20 transition-colors duration-300 overflow-hidden"
                style={{ background: 'var(--bg-secondary)' }}
            >
                <div className="absolute inset-0 bg-dot-grid opacity-[0.35] pointer-events-none" />

                <div className="relative container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                        >
                            <FaStar /> Handpicked For You
                        </span>
                        <h2
                            className="text-4xl md:text-5xl font-bold mb-4"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            {featuredHeading?.title || 'Featured Safaris'}
                        </h2>
                        <p className="max-w-2xl mx-auto" style={{ color: 'var(--text-tertiary)' }}>
                            {featuredHeading?.description || 'Our most popular safari experiences handpicked for you'}
                        </p>
                    </div>

                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {[1, 2, 3, 4, 5, 6].map((n) => (
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
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {featuredByCountry.map((pkg) => (
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
                        <span className="inline-flex items-center gap-2 bg-[var(--brand-gold-subtle)] text-[var(--brand-gold)] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            <FaGlobeAfrica /> Safari Experiences
                        </span>
                        <h2
                            className="text-3xl md:text-4xl font-bold"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            {activitiesHeading?.title || 'Popular Experiences'}
                        </h2>
                        <p className="max-w-2xl mx-auto mt-4 text-lg" style={{ color: 'var(--text-tertiary)' }}>
                            {activitiesHeading?.description || 'Choose from unique excursions and activities to customize your ideal safari adventure.'}
                        </p>
                    </div>

                    {activitiesLoading ? (
                        <div className="flex gap-6 overflow-hidden">
                            {[1, 2, 3, 4].map((n) => (
                                <div
                                    key={n}
                                    className="rounded-xl h-64 w-72 flex-shrink-0 animate-pulse"
                                    style={{ background: 'var(--bg-secondary)' }}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="overflow-hidden">
                            <div
                                className="flex gap-6 w-max animate-marquee"
                                style={{ animationDuration: `${Math.max(activities.length * 6, 20)}s` }}
                            >
                                {[...activities, ...activities].map((activity, index) => {
                                    const imgUrl = getActivityImage(activity);
                                    return (
                                        <div
                                            key={`${activity.id}-${index}`}
                                            className="relative h-64 w-72 flex-shrink-0 rounded-xl overflow-hidden group shadow-md transition duration-300 hover:shadow-xl hover:-translate-y-1"
                                            style={{ border: '1px solid var(--border-subtle)' }}
                                        >
                                            <Image
                                                src={imgUrl}
                                                alt={activity.name}
                                                fill
                                                className="object-cover group-hover:scale-110 transition duration-500 ease-out"
                                            />
                                            {/* Gradient scrim for legible text at any time */}
                                            <div className="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent group-hover:from-black/90 transition-colors duration-300" />

                                            {/* Text content placed on top of the overlay */}
                                            <div className="absolute inset-0 flex flex-col justify-end p-5 z-10">
                                                <h3 className="font-bold text-xl text-white leading-tight group-hover:text-[var(--brand-gold)] transition duration-300">
                                                    {activity.name}
                                                </h3>
                                                <p className="text-xs text-gray-200 line-clamp-2 mt-1.5 leading-snug opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    {activity.description}
                                                </p>
                                            </div>
                                        </div>
                                    );
                                })}
                            </div>
                        </div>
                    )}
                </div>
            </section>

            {/* Testimonials */}
            <section
                className="relative py-20 overflow-hidden transition-colors duration-300"
                style={{ background: 'var(--bg-secondary)' }}
            >
                <div className="absolute inset-0 bg-dot-grid opacity-[0.35] pointer-events-none" />

                <div className="relative container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-green-subtle)', color: 'var(--brand-green)' }}
                        >
                            <FaQuoteLeft /> Traveler Stories
                        </span>
                        <h2 className="text-3xl md:text-4xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>
                            What Our Travelers Say
                        </h2>
                        <p className="max-w-2xl mx-auto" style={{ color: 'var(--text-tertiary)' }}>
                            Real reviews from travelers who explored East Africa with us
                        </p>
                    </div>

                    <div className="overflow-hidden">
                        <div
                            className="flex gap-6 w-max animate-marquee"
                            style={{ animationDuration: `${Math.max(testimonials.length * 8, 20)}s` }}
                        >
                            {[...testimonials, ...testimonials].map((item, index) => {
                                const avatarUrl = getTestimonialAvatar(item);
                                const name = cleanText(item.name);
                                const quote = cleanText(item.testimonial);
                                const tripName = cleanText(item.trip_name);
                                const country = cleanText(item.country);
                                return (
                                    <div
                                        key={`${item.id}-${index}`}
                                        className="flex flex-col p-6 rounded-2xl transition duration-300 hover:-translate-y-1 w-80 sm:w-96 flex-shrink-0"
                                        style={{
                                            background: 'var(--bg-card)',
                                            boxShadow: 'var(--shadow-sm)',
                                            border: '1px solid var(--border-subtle)',
                                        }}
                                    >
                                        <FaQuoteLeft className="text-2xl mb-3" style={{ color: 'var(--brand-gold-subtle)' }} />
                                        <StarRating rating={item.rating} />
                                        <p className="mt-3 mb-6 text-sm leading-relaxed flex-1" style={{ color: 'var(--text-secondary)' }}>
                                            &ldquo;{quote}&rdquo;
                                        </p>
                                        <div className="flex items-center gap-3 pt-4" style={{ borderTop: '1px solid var(--border-subtle)' }}>
                                            {avatarUrl ? (
                                                <div className="relative w-11 h-11 rounded-full overflow-hidden flex-shrink-0">
                                                    <Image src={avatarUrl} alt={name} fill className="object-cover" />
                                                </div>
                                            ) : (
                                                <div
                                                    className="w-11 h-11 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm"
                                                    style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                                                >
                                                    {getInitials(name)}
                                                </div>
                                            )}
                                            <div>
                                                <p className="font-bold text-sm" style={{ color: 'var(--text-primary)' }}>{name}</p>
                                                <p className="text-xs" style={{ color: 'var(--text-muted)' }}>
                                                    {[tripName, country].filter(Boolean).join(' · ')}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section
                className="py-20 transition-colors duration-300"
                style={{ background: 'linear-gradient(180deg, var(--bg-secondary), var(--bg-primary))' }}
            >
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                        >
                            <FaShieldAlt /> The Henjo Difference
                        </span>
                        <h2
                            className="text-3xl md:text-4xl font-bold"
                            style={{ color: 'var(--text-primary)' }}
                        >
                            {featuresHeading?.title || 'Why Choose Henjo African Safaris'}
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        {featureCards.map((item, i) => (
                            <div
                                key={item.title + i}
                                className="group text-center p-6 rounded-2xl transition duration-300 hover:-translate-y-1"
                                style={{
                                    background: 'var(--bg-card)',
                                    boxShadow: 'var(--shadow-sm)',
                                    border: '1px solid var(--border-subtle)',
                                    borderTopWidth: '3px',
                                    borderTopColor: 'var(--brand-gold)',
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-lg)';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-sm)';
                                }}
                            >
                                <div
                                    className="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 transition duration-300 group-hover:scale-110"
                                    style={{ background: 'var(--brand-gold-subtle)' }}
                                >
                                    {(() => {
                                        const Icon = (item.icon && SECTION_ICONS[item.icon]) || FaUserTie;
                                        return <Icon className="text-2xl" style={{ color: 'var(--brand-gold)' }} />;
                                    })()}
                                </div>
                                <h3 className="text-xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                    {item.title}
                                </h3>
                                <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>
                                    {item.description}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Special Offers / Value Propositions */}
            <section className="py-20 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4">
                    <div className="text-center mb-12">
                        <span
                            className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                            style={{ background: 'var(--brand-green-subtle)', color: 'var(--brand-green)' }}
                        >
                            <FaShieldAlt /> Peace Of Mind
                        </span>
                        <h2 className="text-3xl md:text-4xl font-bold" style={{ color: 'var(--text-primary)' }}>
                            {offersHeading?.title || 'Travel With Confidence'}
                        </h2>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                        {offerCards.map((item, i) => (
                            <div
                                key={item.title + i}
                                className="group text-center p-6 rounded-2xl transition duration-300 hover:-translate-y-1"
                                style={{
                                    background: 'var(--bg-card)',
                                    boxShadow: 'var(--shadow-sm)',
                                    border: '1px solid var(--border-subtle)',
                                    borderTopWidth: '3px',
                                    borderTopColor: 'var(--brand-green)',
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-lg)';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.boxShadow = 'var(--shadow-sm)';
                                }}
                            >
                                <div
                                    className="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 transition duration-300 group-hover:scale-110"
                                    style={{ background: 'var(--brand-green-subtle)' }}
                                >
                                    {(() => {
                                        const Icon = (item.icon && SECTION_ICONS[item.icon]) || FaLaptop;
                                        return <Icon className="text-2xl" style={{ color: 'var(--brand-green)' }} />;
                                    })()}
                                </div>
                                <h3 className="text-lg font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                    {item.title}
                                </h3>
                                <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>
                                    {item.description}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Partners */}
            {partners.length > 0 && (
                <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-secondary)', borderTop: '1px solid var(--border-subtle)', borderBottom: '1px solid var(--border-subtle)' }}>
                    <div className="container mx-auto px-4">
                        <div className="text-center mb-10">
                            <span
                                className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-4"
                                style={{ background: 'var(--brand-gold-subtle)', color: 'var(--brand-gold)' }}
                            >
                                <FaHandshake /> Trusted Partners
                            </span>
                            <h2 className="text-2xl md:text-3xl font-bold" style={{ color: 'var(--text-primary)' }}>
                                Recognized & Trusted By
                            </h2>
                        </div>
                        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                            {partners.map((partner) => {
                                const logoUrl = partner.icon ? `${API_ORIGIN}/storage/henjo_profile/${partner.icon}` : null;
                                const href = partner.description;
                                const isExternal = href?.startsWith('http');

                                const card = (
                                    <div
                                        className="group flex flex-col items-center justify-center gap-3 p-5 h-32 rounded-xl text-center transition duration-300 hover:-translate-y-1"
                                        style={{ background: 'var(--bg-card)', border: '1px solid var(--border-subtle)' }}
                                    >
                                        {logoUrl ? (
                                            <div className="relative w-full h-12">
                                                <Image
                                                    src={logoUrl}
                                                    alt={partner.title}
                                                    fill
                                                    className="object-contain"
                                                />
                                            </div>
                                        ) : (
                                            <span
                                                className="text-xs font-semibold leading-tight transition-colors duration-300 group-hover:text-[var(--brand-gold)]"
                                                style={{ color: 'var(--text-tertiary)' }}
                                            >
                                                {partner.title}
                                            </span>
                                        )}
                                    </div>
                                );

                                if (!href) {
                                    return <div key={partner.title}>{card}</div>;
                                }

                                return isExternal ? (
                                    <a key={partner.title} href={href} target="_blank" rel="noopener noreferrer" aria-label={partner.title}>
                                        {card}
                                    </a>
                                ) : (
                                    <Link key={partner.title} href={href} aria-label={partner.title}>
                                        {card}
                                    </Link>
                                );
                            })}
                        </div>
                    </div>
                </section>
            )}

            {/* Social Media */}
            {activeSocialLinks.length > 0 && (
                <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                    <div className="container mx-auto px-4 text-center">
                        <h2 className="text-2xl md:text-3xl font-bold mb-3" style={{ color: 'var(--text-primary)' }}>
                            Follow Our Safari Journey
                        </h2>
                        <p className="max-w-xl mx-auto mb-8" style={{ color: 'var(--text-tertiary)' }}>
                            Real trips, real wildlife, real stories — follow along for travel inspiration and behind-the-scenes moments
                        </p>
                        <div className="flex flex-wrap justify-center gap-4">
                            {activeSocialLinks.map((social) => {
                                const Icon = social.icon;
                                return (
                                    <a
                                        key={social.name}
                                        href={social.href}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label={`Follow us on ${social.name}`}
                                        className="w-14 h-14 rounded-full flex items-center justify-center text-white text-xl shadow-md transition duration-300 hover:scale-110 hover:shadow-xl"
                                        style={{ background: social.color }}
                                    >
                                        <Icon />
                                    </a>
                                );
                            })}
                        </div>
                    </div>
                </section>
            )}

            {/* Final CTA */}
            <section className="relative py-20 overflow-hidden">
                <video
                    className="absolute inset-0 w-full h-full object-cover"
                    src={`${API_ORIGIN}/storage/safaris/tour-package.mp4`}
                    autoPlay
                    loop
                    muted
                    playsInline
                    preload="auto"
                />
                <div
                    className="absolute inset-0"
                    style={{ background: 'linear-gradient(120deg, var(--brand-green-hover), var(--brand-green))', opacity: 0.82 }}
                />
                <div
                    className="absolute -top-16 -right-16 w-80 h-80 rounded-full blur-3xl opacity-20 pointer-events-none"
                    style={{ background: 'var(--brand-gold)' }}
                />
                <div className="relative container mx-auto px-4 text-center">
                    <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                        {finalCta?.title || 'Ready for Your African Adventure?'}
                    </h2>
                    <p className="text-lg text-white/80 max-w-xl mx-auto mb-8">
                        {finalCta?.description || 'Let our travel consultants craft a custom-made safari itinerary tailored to you - no obligation, just expert guidance.'}
                    </p>
                    <div className="flex flex-wrap justify-center gap-4">
                        <Link
                            href="/booking"
                            className="font-bold px-8 py-4 rounded-full transition hover:scale-105 shadow-xl"
                            style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                        >
                            Start Planning →
                        </Link>
                        <Link
                            href="/contact"
                            className="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white font-bold px-8 py-4 rounded-full transition border border-white/30"
                        >
                            Talk to an Expert
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    );
}