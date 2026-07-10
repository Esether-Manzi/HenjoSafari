'use client';

import { useEffect, useState } from 'react';
import Hero from '@/components/common/Hero';
import Image from 'next/image';
import Link from 'next/link';
import { FaEnvelope, FaPhone, FaArrowRight } from 'react-icons/fa';
import { teamApi } from '@/lib/api/teamApi';
import type { TeamMember } from '@/types/team';

// Helper to resolve photos from backend media collections or mock URLs
export function getMemberPhoto(member: TeamMember): string {
    if (member.media && member.media.length > 0) {
        const photo = member.media.find(m => m.collection_name === 'photo');
        return photo?.original_url || photo?.medium_url || '/images/placeholder.png';
    }
    return (member as any).image || '/images/placeholder.png';
}

export const MOCK_TEAM: TeamMember[] = [
    {
        id: 1,
        name: 'Moses Safari',
        position: 'Founder & Managing Director',
        bio: 'Moses founded Henjo African Safaris with a vision to share the raw beauty of East Africa while supporting wildlife conservation and local community development.',
        email: 'moses@henjosafaris.com',
        phone: '+256 779 557 514',
        is_active: true,
        media: []
    },
    {
        id: 2,
        name: 'Sarah Kemunto',
        position: 'Head of Operations & Booking',
        bio: 'Sarah ensures every booking, permit, and itinerary detail runs flawlessly. She coordinates our ground teams across Uganda, Kenya, and Tanzania.',
        email: 'operations@henjosafaris.com',
        phone: '+254 739 013 098',
        is_active: true,
        media: []
    },
    {
        id: 3,
        name: 'John Henjo',
        position: 'Senior Wildlife Guide',
        bio: 'With over 15 years of tracking experience in the Serengeti and Masai Mara, John’s knowledge of birdlife, cat behavior, and local history is unparalleled.',
        email: 'john@henjosafaris.com',
        phone: '+256 779 557 514',
        is_active: true,
        media: []
    },
    {
        id: 4,
        name: 'Grace Mukasa',
        position: 'Customer Experience & Quality Manager',
        bio: 'Grace welcomes travelers and provides pre-safari briefings. She guarantees that every lodge, meal, and safari cruiser meets our premium luxury standards.',
        email: 'grace@henjosafaris.com',
        phone: '+256 700 000 001',
        is_active: true,
        media: []
    },
    {
        id: 5,
        name: 'David Ochieng',
        position: 'Lead Primate Tracking Specialist',
        bio: 'Specializing in the tropical rainforests of Bwindi and Kibale, David has a sixth sense for locating mountain gorilla families and chimpanzee troops safely.',
        email: 'david@henjosafaris.com',
        phone: '+256 700 000 002',
        is_active: true,
        media: []
    },
    {
        id: 6,
        name: 'Amelie Dubois',
        position: 'European Relations & Marketing Director',
        bio: 'Based partly in the Netherlands, Amelie manages our partnership network with travel agents across Europe and coordinates sustainable tourism outreach programs.',
        email: 'amelie@henjosafaris.com',
        phone: '+31 6 1675 3816',
        is_active: true,
        media: []
    }
];

// Set local mock image URLs
(MOCK_TEAM[0] as any).image = 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop';
(MOCK_TEAM[1] as any).image = 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop';
(MOCK_TEAM[2] as any).image = 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop';
(MOCK_TEAM[3] as any).image = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop';
(MOCK_TEAM[4] as any).image = 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?q=80&w=400&auto=format&fit=crop';
(MOCK_TEAM[5] as any).image = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop';

export default function OurTeamPage() {
    const [members, setMembers] = useState<TeamMember[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchTeam = async () => {
            try {
                setLoading(true);
                const response = await teamApi.getAll();
                if (response.success && response.data?.length > 0) {
                    setMembers(response.data);
                } else {
                    setMembers(MOCK_TEAM);
                }
            } catch (err: any) {
                console.warn('Unable to load team from API, using mock placeholder team:', err);
                setMembers(MOCK_TEAM);
            } finally {
                setLoading(false);
            }
        };
        fetchTeam();
    }, []);

    return (
        <div className="min-h-screen transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
            <Hero 
                size="medium"
                title="Our Dedicated Team"
                subtitle="Meet the experienced guides, planners, and conservationists who bring your African adventures to life"
                ctaText="Book A Meeting"
                ctaLink="/booking"
                backgroundImage="https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=1600&auto=format&fit=crop"
                overlay={true}
                showTagline={true}
            />

            <div className="container mx-auto px-4 max-w-6xl py-20">
                <div className="text-center mb-16">
                    <span className="inline-block bg-[var(--brand-gold-subtle)] text-[var(--brand-gold)] px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                        🌿 Expert Guidance, Unforgettable Journeys
                    </span>
                    <h2 className="text-3xl md:text-4xl font-bold" style={{ color: 'var(--text-primary)' }}>
                        Meet the Experts
                    </h2>
                    <p className="max-w-2xl mx-auto mt-4 text-lg" style={{ color: 'var(--text-secondary)' }}>
                        Our guides, coordinators, and directors represent decades of combined expertise in wilderness hospitality, tracking, and logistics.
                    </p>
                </div>
                
                {loading ? (
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {[1, 2, 3].map((n) => (
                            <div key={n} className="rounded-2xl h-96 animate-pulse" style={{ background: 'var(--bg-tertiary)' }} />
                        ))}
                    </div>
                ) : (
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {members.map((member) => {
                            const photoUrl = getMemberPhoto(member);
                            return (
                                <div 
                                    key={member.id} 
                                    className="rounded-2xl p-8 transition duration-300 hover:scale-[1.02]"
                                    style={{
                                        background: 'var(--bg-card)',
                                        boxShadow: 'var(--shadow-md)',
                                        border: '1px solid var(--border-subtle)'
                                    }}
                                >
                                    <div className="relative w-40 h-40 mx-auto mb-6 rounded-full overflow-hidden border-4" style={{ borderColor: 'var(--brand-gold)' }}>
                                        <Image
                                            src={photoUrl}
                                            alt={member.name}
                                            fill
                                            className="object-cover"
                                        />
                                    </div>
                                    <h3 className="text-2xl font-bold text-center" style={{ color: 'var(--text-primary)' }}>{member.name}</h3>
                                    <p className="font-semibold text-center mt-1" style={{ color: 'var(--brand-gold)' }}>{member.position}</p>
                                    
                                    <p className="text-sm mt-4 text-center leading-relaxed h-20 overflow-y-auto" style={{ color: 'var(--text-tertiary)' }}>
                                        {member.bio}
                                    </p>
                                    
                                    <div className="mt-6 pt-6 border-t flex flex-col gap-2 text-sm" style={{ borderColor: 'var(--border-subtle)' }}>
                                        {member.email && (
                                            <a href={`mailto:${member.email}`} className="flex items-center gap-3 transition hover:text-[var(--brand-gold)]" style={{ color: 'var(--text-secondary)' }}>
                                                <FaEnvelope style={{ color: 'var(--brand-gold)' }} />
                                                {member.email}
                                            </a>
                                        )}
                                        {member.phone && (
                                            <a href={`tel:${member.phone}`} className="flex items-center gap-3 transition hover:text-[var(--brand-gold)]" style={{ color: 'var(--text-secondary)' }}>
                                                <FaPhone style={{ color: 'var(--brand-gold)' }} />
                                                {member.phone}
                                            </a>
                                        )}
                                    </div>
                                </div>
                            );
                        })}
                    </div>
                )}
                
                <div className="mt-16 text-center">
                    <p style={{ color: 'var(--text-secondary)' }}>
                        Interested in joining our team of professional guides?{' '}
                        <Link href="/contact" className="transition hover:text-[var(--brand-gold-hover)] font-bold inline-flex items-center gap-1" style={{ color: 'var(--brand-gold)' }}>
                            Get in touch with us <FaArrowRight size={12} />
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    );
}