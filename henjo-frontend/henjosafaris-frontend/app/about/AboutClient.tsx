import Hero from '@/components/common/Hero';
import Image from 'next/image';
import { Playfair_Display } from 'next/font/google';
import { FaHeart, FaLeaf, FaUsers, FaChevronLeft, FaChevronRight, FaPaw, FaHiking, FaPlaneDeparture, FaMountain, FaLandmark, FaFemale, FaCity, FaCheck, FaStar, FaQuoteLeft } from 'react-icons/fa';
import type { CmsPage } from '@/types/page';
import type { SiteSettings } from '@/types/settings';
import { sectionsByGroup, firstInGroup } from '@/types/page';

// The founder photo was supplied directly by the client (not uploaded through
// the media library) and lives under the backend's public storage symlink.
const BACKEND_ORIGIN = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/api\/v1\/?$/, '');
const FOUNDER_PHOTO_URL = `${BACKEND_ORIGIN}/storage/henjo_profile/Henry_Katinda.jpeg`;

// Editorial display face for the founder profile - the rest of the site
// stays on Inter, so this is scoped to that section only.
const playfair = Playfair_Display({ subsets: ['latin'], weight: ['600', '700'] });

const SERVICE_ICONS: Record<string, React.ComponentType<{ className?: string; style?: React.CSSProperties }>> = {
    paw: FaPaw,
    hiking: FaHiking,
    plane: FaPlaneDeparture,
    mountain: FaMountain,
    landmark: FaLandmark,
    female: FaFemale,
    city: FaCity,
};

interface AboutClientProps {
    page: CmsPage | null;
    settings: SiteSettings | null;
}

export default function AboutClient({ page, settings }: AboutClientProps) {
    const whoWeAreParagraphs = (page?.content || '').split('\n').filter(Boolean);
    const servicesHeading = firstInGroup(page?.sections, 'services-heading');
    const services = sectionsByGroup(page?.sections, 'services');
    const values = sectionsByGroup(page?.sections, 'values');
    const commitment = firstInGroup(page?.sections, 'commitment');
    const inclusive = firstInGroup(page?.sections, 'inclusive');

    // Founder magazine profile: the two CMS "founder" entries become the
    // article's lead (with a drop cap on its first paragraph) and its
    // closing "philosophy" passage, split around a pull quote.
    const founderSections = sectionsByGroup(page?.sections, 'founder');
    const founderLead = founderSections[0] || null;
    const founderPurpose = founderSections[1] || null;
    const [leadFirstParagraph, ...leadRestParagraphs] = (founderLead?.description || '').split('\n').filter(Boolean);
    const dropCap = leadFirstParagraph ? leadFirstParagraph.charAt(0) : '';
    const leadFirstParagraphRest = leadFirstParagraph ? leadFirstParagraph.slice(1) : '';
    const purposeParagraphs = (founderPurpose?.description || '').split('\n').filter(Boolean);

    const stats = [
        { value: settings?.years_experience || '5+', label: 'Years Experience' },
        { value: settings?.happy_travelers_count || '500+', label: 'Happy Travelers' },
        { value: settings?.average_rating || '4.9', label: 'Average Rating', Icon: FaStar },
        { value: String(settings?.safari_package_count ?? 28), label: 'Tour Packages' },
    ];

    return (
        <div className="min-h-screen" style={{ background: 'var(--bg-secondary)' }}>
            {/* ============================================
            HERO SECTION
            ============================================ */}
            <Hero
                size="medium"
                title={page?.hero_title || 'About Us'}
                subtitle={page?.hero_subtitle || 'Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda'}
                ctaText={page?.hero_cta_text || 'Contact Us'}
                ctaLink={page?.hero_cta_href || '/contact'}
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={true}
            />

            {/* ============================================
            SECTION 1: Who We Are (Image Right, Text Left)
            ============================================ */}
            <section className="py-20" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        {/* Left: Text Content */}
                        <div>
                            <h2 className="text-3xl md:text-4xl font-bold mb-6" style={{ color: 'var(--text-primary)' }}>
                                Who <span style={{ color: 'var(--brand-gold)' }}>We Are</span>
                            </h2>
                            {whoWeAreParagraphs.map((paragraph, i) => (
                                <p key={i} className={`leading-relaxed text-lg ${i > 0 ? 'mt-4' : ''}`} style={{ color: 'var(--text-secondary)' }}>
                                    {paragraph}
                                </p>
                            ))}
                        </div>

                        {/* Right: Image */}
                        <div className="relative h-[400px] rounded-2xl overflow-hidden" style={{ boxShadow: 'var(--shadow-lg)' }}>
                            <Image
                                src="/images/about_us_2.png"
                                alt="Henjo African Safaris - Who We Are"
                                fill
                                className="object-cover"
                            />
                        </div>
                    </div>
                </div>
            </section>

            {/* ============================================
            SECTION 2: Our Services (Horizontal Scrolling)
            ============================================ */}
            <section className="py-20" style={{ background: 'var(--bg-secondary)' }}>
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl md:text-4xl font-bold" style={{ color: 'var(--text-primary)' }}>
                            {servicesHeading?.title || 'Our Services'}
                        </h2>
                        <p className="mx-auto max-w-2xl mt-2" style={{ color: 'var(--text-secondary)' }}>
                            {servicesHeading?.description || 'We offer a wide range of safari experiences tailored to your preferences'}
                        </p>
                    </div>

                    <div className="relative">
                        {/* Scrolling container */}
                        <div className="overflow-x-auto pb-6 scrollbar-hide">
                            <div className="flex gap-6 w-max px-2">
                                {services.map((service, index) => {
                                    const Icon = (service.icon && SERVICE_ICONS[service.icon]) || FaPaw;
                                    return (
                                        <div
                                            key={index}
                                            className="w-72 flex-shrink-0 rounded-2xl p-6 transition duration-300"
                                            style={{
                                                background: 'var(--bg-card)',
                                                boxShadow: 'var(--shadow-md)',
                                            }}
                                        >
                                            <div
                                                className="w-16 h-16 rounded-full flex items-center justify-center mb-4"
                                                style={{ background: 'var(--brand-gold-subtle)' }}
                                            >
                                                <Icon className="text-3xl" style={{ color: 'var(--brand-gold)' }} />
                                            </div>
                                            <h3 className="text-xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                                {service.title}
                                            </h3>
                                            <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>
                                                {service.description}
                                            </p>
                                        </div>
                                    );
                                })}
                            </div>
                        </div>

                        {/* Scroll Hint */}
                        <div className="text-center mt-6">
                            <p className="text-sm animate-pulse inline-flex items-center gap-2" style={{ color: 'var(--text-muted)' }}>
                                <FaChevronLeft className="text-xs" aria-hidden /> Scroll to see more services <FaChevronRight className="text-xs" aria-hidden />
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* ============================================
            SECTION 2.5: Our Founder - magazine-style profile
            ============================================ */}
            {founderLead && (
                <section className="py-20 md:py-28" style={{ background: 'var(--bg-secondary)' }}>
                    <div className="container mx-auto px-4 max-w-5xl">
                        {/* Kicker */}
                        <div className="flex items-center gap-3 mb-4">
                            <span className="h-px w-10" style={{ background: 'var(--brand-gold)' }} />
                            <span className="text-xs font-bold tracking-[0.2em] uppercase" style={{ color: 'var(--brand-gold)' }}>
                                Founder Story
                            </span>
                        </div>

                        {/* Headline */}
                        <h2 className={`${playfair.className} text-4xl md:text-6xl font-bold leading-[1.05] mb-4`} style={{ color: 'var(--text-primary)' }}>
                            {founderPurpose?.title || founderLead.title}
                        </h2>
                        <p className="text-sm font-semibold uppercase tracking-wide mb-12" style={{ color: 'var(--text-tertiary)' }}>
                            Henry Katinda <span style={{ color: 'var(--brand-gold)' }}>&middot;</span> Founder &amp; Director, Henjo African Safaris
                        </p>

                        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">
                            {/* Photo */}
                            <div className="lg:col-span-5">
                                <div className="lg:sticky lg:top-24 relative aspect-[4/5] rounded-2xl overflow-hidden" style={{ boxShadow: 'var(--shadow-lg)' }}>
                                    <Image
                                        src={FOUNDER_PHOTO_URL}
                                        alt="Henry Katinda, Founder and Director of Henjo African Safaris"
                                        fill
                                        className="object-cover"
                                    />
                                </div>
                            </div>

                            {/* Article body */}
                            <div className="lg:col-span-7">
                                {leadFirstParagraph && (
                                    <p className="leading-relaxed text-lg" style={{ color: 'var(--text-secondary)' }}>
                                        <span
                                            className={`${playfair.className} float-left text-7xl leading-[0.75] font-bold mr-3 mt-1`}
                                            style={{ color: 'var(--brand-gold)' }}
                                            aria-hidden="true"
                                        >
                                            {dropCap}
                                        </span>
                                        {leadFirstParagraphRest}
                                    </p>
                                )}
                                {leadRestParagraphs.map((paragraph, i) => (
                                    <p key={i} className="leading-relaxed text-lg mt-4" style={{ color: 'var(--text-secondary)' }}>
                                        {paragraph}
                                    </p>
                                ))}

                                {/* Pull quote */}
                                <blockquote className="my-10 text-center">
                                    <FaQuoteLeft className="text-2xl mx-auto mb-4" style={{ color: 'var(--brand-gold)' }} aria-hidden />
                                    <p className={`${playfair.className} text-2xl md:text-3xl italic leading-snug`} style={{ color: 'var(--text-primary)' }}>
                                        &ldquo;Africa is more than a destination. It is a story, a people, a culture, and an experience. My goal is to help every traveler discover that story while ensuring that tourism creates opportunities for the communities we call home.&rdquo;
                                    </p>
                                    <footer className="mt-4 text-sm font-semibold uppercase tracking-wide" style={{ color: 'var(--brand-gold)' }}>
                                        Henry Katinda
                                    </footer>
                                </blockquote>

                                {purposeParagraphs.map((paragraph, i) => (
                                    <p key={i} className={`leading-relaxed text-lg ${i > 0 ? 'mt-4' : ''}`} style={{ color: 'var(--text-secondary)' }}>
                                        {paragraph}
                                    </p>
                                ))}

                                <p className="mt-8 leading-relaxed text-lg" style={{ color: 'var(--text-secondary)' }}>
                                    Henry continues to lead Henjo African Safaris with a commitment to exceptional service, responsible tourism, authentic experiences, and meaningful impact.
                                </p>
                                <p className={`${playfair.className} mt-4 text-xl font-bold`} style={{ color: 'var(--brand-gold)' }}>
                                    Travel Africa. Experience More. Give Back.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            )}

            {/* ============================================
            SECTION 3: Core Values, Commitment & Inclusive Tourism
            ============================================ */}
            <section className="py-20" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">

                        {/* Values - Green accent */}
                        <div
                            className="p-8 rounded-2xl transition duration-300"
                            style={{
                                background: 'var(--bg-card)',
                                boxShadow: 'var(--shadow-md)',
                                borderTop: '4px solid var(--brand-green)',
                            }}
                        >
                            <div
                                className="w-14 h-14 rounded-full flex items-center justify-center mb-4"
                                style={{ background: 'var(--brand-green-subtle)' }}
                            >
                                <FaHeart className="text-2xl" style={{ color: 'var(--brand-green)' }} />
                            </div>
                            <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>Our Core Values</h3>

                            <ul className="space-y-3" style={{ color: 'var(--text-secondary)' }}>
                                {values.map((value) => (
                                    <li key={value.title} className="flex items-start gap-3">
                                        <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaCheck /></span>
                                        <span>{value.title}</span>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        {/* Commitment - Gold accent */}
                        <div
                            className="p-8 rounded-2xl transition duration-300"
                            style={{
                                background: 'var(--bg-card)',
                                boxShadow: 'var(--shadow-md)',
                                borderTop: '4px solid var(--brand-gold)',
                            }}
                        >
                            <div
                                className="w-14 h-14 rounded-full flex items-center justify-center mb-4"
                                style={{ background: 'var(--brand-gold-subtle)' }}
                            >
                                <FaLeaf className="text-2xl" style={{ color: 'var(--brand-gold)' }} />
                            </div>
                            <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>{commitment?.title || 'Our Commitment'}</h3>
                            {(commitment?.description || '').split('\n').filter(Boolean).map((paragraph, i) => (
                                <p key={i} className={`leading-relaxed ${i > 0 ? 'mt-4' : ''}`} style={{ color: 'var(--text-secondary)' }}>
                                    {paragraph}
                                </p>
                            ))}
                        </div>

                        {/* Inclusive - Maroon accent */}
                        <div
                            className="p-8 rounded-2xl transition duration-300"
                            style={{
                                background: 'var(--bg-card)',
                                boxShadow: 'var(--shadow-md)',
                                borderTop: '4px solid var(--brand-maroon)',
                            }}
                        >
                            <div
                                className="w-14 h-14 rounded-full flex items-center justify-center mb-4"
                                style={{ background: 'rgba(123, 24, 24, 0.08)' }}
                            >
                                <FaUsers className="text-2xl" style={{ color: 'var(--brand-maroon)' }} />
                            </div>
                            <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>{inclusive?.title || 'Inclusive Tourism'}</h3>
                            {(inclusive?.description || '').split('\n').filter(Boolean).map((paragraph, i) => (
                                <p key={i} className={`leading-relaxed ${i > 0 ? 'mt-4' : ''}`} style={{ color: 'var(--text-secondary)' }}>
                                    {paragraph}
                                </p>
                            ))}
                        </div>
                    </div>
                </div>
            </section>


            {/* ============================================
            SECTION 4: Stats / Social Proof
            ============================================ */}
            <section
                className="py-16"
                style={{ background: 'linear-gradient(135deg, var(--brand-gold), var(--brand-gold-hover))' }}
            >
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                        {stats.map((stat) => (
                            <div key={stat.label} className="text-center text-white">
                                <div className="text-5xl font-bold flex items-center justify-center gap-2">
                                    {stat.value}
                                    {stat.Icon && <stat.Icon className="text-4xl" />}
                                </div>
                                <p className="text-sm mt-2 opacity-80">{stat.label}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
        </div>
    );
}
