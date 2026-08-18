'use client';

import { useState, useEffect } from 'react';
import Hero from '@/components/common/Hero';
import Image from 'next/image';
import Link from 'next/link';
import { FaHeart, FaLeaf, FaUsers, FaChevronLeft, FaChevronRight, FaPaw, FaHiking, FaPlaneDeparture, FaMountain, FaLandmark, FaFemale, FaCity, FaHandshake, FaCheck, FaStar } from 'react-icons/fa';
import { MOCK_TEAM, getMemberPhoto } from '@/app/our-team/page';
import { teamApi } from '@/lib/api/teamApi';
import type { TeamMember } from '@/types/team';

export default function AboutPage() {
    const [team, setTeam] = useState<TeamMember[]>([]);
    const [currentIndex, setCurrentIndex] = useState(0);

    useEffect(() => {
        const fetchTeam = async () => {
            try {
                const response = await teamApi.getAll();
                if (response.success && response.data?.length > 0) {
                    setTeam(response.data);
                } else {
                    setTeam(MOCK_TEAM);
                }
            } catch (err) {
                console.warn('Unable to fetch team in about page, using mock data:', err);
                setTeam(MOCK_TEAM);
            }
        };
        fetchTeam();
    }, []);

    const handleNext = () => {
        if (team.length <= 3) return;
        setCurrentIndex((prev) => (prev + 1) % (team.length - 2));
    };

    const handlePrev = () => {
        if (team.length <= 3) return;
        setCurrentIndex((prev) => (prev - 1 + (team.length - 2)) % (team.length - 2));
    };

    return (
        <div className="min-h-screen" style={{ background: 'var(--bg-secondary)' }}>
            {/* ============================================
            HERO SECTION
            ============================================ */}
            <Hero 
                size="medium"
                title="About Henjo African Safaris"
                subtitle="Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda"
                ctaText="Contact Us"
                ctaLink="/contact"
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
                            <p className="leading-relaxed text-lg" style={{ color: 'var(--text-secondary)' }}>
                                Henjo African Safaris Ltd is a Ugandan Tour agency offering Bespoke Safaris, 
                                Tailor Made Holidays, Authentic Luxury African Safaris, Fly-In Safaris, 
                                Gorilla Tracking and Cultural Safaris.
                            </p>
                            <p className="leading-relaxed text-lg mt-4" style={{ color: 'var(--text-secondary)' }}>
                                We take pride in having a team of professionals who have traveled in East Africa 
                                and now work to ensure that clients both acquire a unique and educational 
                                experience of African wildlife, landscape, and culture.
                            </p>
                            <p className="leading-relaxed text-lg mt-4" style={{ color: 'var(--text-secondary)' }}>
                                The competence and knowledge of our safari tour guides highly contributes 
                                to the overall experience.
                            </p>
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
                            Our <span style={{ color: 'var(--brand-gold)' }}>Services</span>
                        </h2>
                        <p className="mx-auto max-w-2xl mt-2" style={{ color: 'var(--text-secondary)' }}>
                            We offer a wide range of safari experiences tailored to your preferences
                        </p>
                    </div>

                    <div className="relative">
                        {/* Scrolling container */}
                        <div className="overflow-x-auto pb-6 scrollbar-hide">
                            <div className="flex gap-6 w-max px-2">
                                {[
                                    { Icon: FaPaw, title: 'Wildlife Safaris', desc: 'Experience the thrill of seeing the Big Five in their natural habitat across East Africa\'s national parks.' },
                                    { Icon: FaHiking, title: 'Gorilla Trekking', desc: 'Trek through the lush forests of Uganda and Rwanda to encounter endangered mountain gorillas.' },
                                    { Icon: FaPlaneDeparture, title: 'Fly-In Safaris', desc: 'Skip the long drives and fly directly to your safari destination for more time exploring.' },
                                    { Icon: FaMountain, title: 'Mountaineering', desc: 'Conquer the highest peaks in Africa including Mount Kilimanjaro and the Rwenzori Mountains.' },
                                    { Icon: FaLandmark, title: 'Cultural Tours', desc: 'Immerse yourself in the rich cultures and traditions of East Africa\'s diverse communities.' },
                                    { Icon: FaFemale, title: 'Women Only Tours', desc: 'Specially designed tours for women travelers seeking safe and empowering African adventures.' },
                                    { Icon: FaCity, title: 'City Tours', desc: 'Explore the vibrant cities of East Africa including Kampala, Nairobi, and Dar es Salaam.' },
                                ].map((service, index) => (
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
                                            <service.Icon className="text-3xl" style={{ color: 'var(--brand-gold)' }} />
                                        </div>
                                        <h3 className="text-xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                            {service.title}
                                        </h3>
                                        <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>
                                            {service.desc}
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Scroll Hint */}
                        <div className="text-center mt-6">
                            <p className="text-sm animate-pulse" style={{ color: 'var(--text-muted)' }}>
                                ← Scroll to see more services →
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* ============================================
            SECTION 2.5: Team Members Preview Carousel
            ============================================ */}
            <section className="py-20" style={{ background: 'var(--bg-primary)', borderBottom: '1px solid var(--border-subtle)' }}>
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="flex flex-col md:flex-row md:items-end justify-between mb-12">
                        <div>
                            <span className="inline-flex items-center gap-2 bg-[var(--brand-gold-subtle)] text-[var(--brand-gold)] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                                <FaHandshake /> Meet the Experts
                            </span>
                            <h2 className="text-3xl md:text-4xl font-bold" style={{ color: 'var(--text-primary)' }}>
                                Meet Our Team
                            </h2>
                            <p className="mt-2 text-lg max-w-2xl" style={{ color: 'var(--text-secondary)' }}>
                                Discover the experienced guides, planners, and conservationists who bring your African adventures to life.
                            </p>
                        </div>
                        {/* Navigation Buttons */}
                        {team.length > 3 && (
                            <div className="flex gap-3 mt-6 md:mt-0">
                                <button
                                    onClick={handlePrev}
                                    className="p-3 rounded-full border transition duration-300 hover:scale-105 active:scale-95"
                                    style={{
                                        borderColor: 'var(--border-primary)',
                                        background: 'var(--bg-card)',
                                        color: 'var(--text-primary)'
                                    }}
                                    aria-label="Previous team members"
                                >
                                    <FaChevronLeft size={16} />
                                </button>
                                <button
                                    onClick={handleNext}
                                    className="p-3 rounded-full border transition duration-300 hover:scale-105 active:scale-95"
                                    style={{
                                        borderColor: 'var(--border-primary)',
                                        background: 'var(--bg-card)',
                                        color: 'var(--text-primary)'
                                    }}
                                    aria-label="Next team members"
                                >
                                    <FaChevronRight size={16} />
                                </button>
                            </div>
                        )}
                    </div>

                    {/* Carousel Container */}
                    <div className="relative overflow-hidden w-full py-4">
                        <div
                            className="flex transition-transform duration-500 ease-in-out"
                            style={{
                                transform: `translateX(-${currentIndex * (100 / (team.length || 1))}%)`,
                                width: `${((team.length || 1) * 100) / Math.min(3, team.length || 1)}%`
                            }}
                        >
                            {team.map((member) => {
                                const photoUrl = getMemberPhoto(member);
                                return (
                                    <div
                                        key={member.id}
                                        className="px-3 transition-opacity duration-300"
                                        style={{ width: `${100 / (team.length || 1)}%` }}
                                    >
                                        <div
                                            className="rounded-2xl p-6 transition duration-300 hover:shadow-lg h-full flex flex-col justify-between"
                                            style={{
                                                background: 'var(--bg-card)',
                                                border: '1px solid var(--border-subtle)',
                                                boxShadow: 'var(--shadow-md)'
                                            }}
                                        >
                                            <div>
                                                <div className="relative w-28 h-28 mx-auto mb-4 rounded-full overflow-hidden border-2" style={{ borderColor: 'var(--brand-gold)' }}>
                                                    <Image
                                                        src={photoUrl}
                                                        alt={member.name}
                                                        fill
                                                        className="object-cover"
                                                    />
                                                </div>
                                                <h3 className="text-xl font-bold text-center" style={{ color: 'var(--text-primary)' }}>{member.name}</h3>
                                                <p className="text-sm font-semibold text-center mt-1" style={{ color: 'var(--brand-gold)' }}>{member.position}</p>
                                                <p className="text-xs text-center mt-3 line-clamp-3 leading-relaxed" style={{ color: 'var(--text-tertiary)' }}>
                                                    {member.bio}
                                                </p>
                                            </div>

                                            <div className="mt-6 pt-4 border-t text-center" style={{ borderColor: 'var(--border-subtle)' }}>
                                                <Link
                                                    href="/our-team"
                                                    className="text-xs font-bold transition hover:text-[var(--brand-gold-hover)]"
                                                    style={{ color: 'var(--brand-gold)' }}
                                                >
                                                    View Bio & Profile →
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>
            </section>

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
                                {[
                                    'Integrity and transparency in all our dealings',
                                    'Passion for wildlife and conservation',
                                    'Excellence in customer service',
                                    'Respect for local communities and cultures',
                                ].map((value, i) => (
                                    <li key={i} className="flex items-start gap-3">
                                        <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaCheck /></span>
                                        <span>{value}</span>
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
                            <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>Our Commitment</h3>
                            <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                                Henjo African Safaris continues to endeavor to be sustainable in practice in the 
                                tours offered, to protect African wildlife and ensure the tourism industry continues 
                                to prosper.
                            </p>
                            <p className="leading-relaxed mt-4" style={{ color: 'var(--text-secondary)' }}>
                                We are working towards leaving a minimal negative impact on the 
                                environment and local communities, integrating environmental and social best 
                                practices into every aspect of the business.
                            </p>
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
                            <h3 className="text-xl font-bold mb-4" style={{ color: 'var(--text-primary)' }}>Inclusive Tourism</h3>
                            <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                                Henjo African Safaris believes in Responsible and Inclusive Tourism, and offers 
                                Disability Tours & Safaris — whether a traveler has a disability or not, they are 
                                welcomed to experience their African holiday with Henjo.
                            </p>
                            <p className="leading-relaxed mt-4" style={{ color: 'var(--text-secondary)' }}>
                                We are represented on SafariBookings.com and offer tours ranging from short stays 
                                to longer durations, as well as fully tailor-made safaris on request.
                            </p>
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
                        {[
                            { value: '15+', label: 'Years Experience' },
                            { value: '500+', label: 'Happy Travelers' },
                            { value: '4.9', label: 'Average Rating', Icon: FaStar },
                            { value: '28', label: 'Tour Packages' },
                        ].map((stat) => (
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
