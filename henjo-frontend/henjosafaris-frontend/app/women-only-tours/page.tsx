// ============================================
// WOMEN ONLY TOURS PAGE
// ============================================
// Real copy from henjosafaris-content-audit.md §3.5 —
// an informational/marketing page (the old site had no
// standalone women-only product listing either), plus
// Joan Tusubira's featured bio.
// ============================================

import Hero from '@/components/common/Hero';
import Link from 'next/link';
import Image from 'next/image';
import { FaShieldAlt, FaUsers, FaHeart, FaArrowRight } from 'react-icons/fa';

export default function WomenOnlyToursPage() {
    return (
        <div className="min-h-screen">
            <Hero
                size="medium"
                title="Women Only Tours"
                subtitle="Safe, empowering travel across Uganda, Kenya & Rwanda"
                backgroundImage="/images/destinations/rwanda.png"
                overlay={true}
                showTagline={false}
            />

            <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-4xl">
                    <div
                        className="rounded-2xl p-8 md:p-12 space-y-6"
                        style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)', border: '1px solid var(--border-primary)' }}
                    >
                        <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                            Our Women-only travel packages offer a safe and empowering way for women to explore
                            Uganda, Kenya & Rwanda on their terms. These packages enable our clients to feel a
                            sense of security and safety. Henjo African Safaris offers security measures such as
                            women-only attendants in accommodations and transportation, as well as local female
                            guides and support networks in the destinations they visit — giving women the
                            confidence to travel to destinations that may be considered unsafe for solo female
                            travelers.
                        </p>
                        <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                            Choosing women-only travel packages offers the opportunity to connect with other
                            like-minded women and provides a supportive and empowering environment where women
                            can bond and make lasting friendships — particularly beneficial for women traveling
                            solo who may feel lonely or isolated.
                        </p>
                        <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                            In addition to the safety and social aspects, women-only travel packages also offer
                            unique travel experiences tailored to the interests and needs of women, including
                            wellness retreats, cultural immersion experiences, adventure sports, and teenage
                            girls&apos; menstrual health programs. We work with local female-owned businesses and
                            organizations to provide authentic and empowering travel experiences.
                        </p>
                    </div>

                    {/* Feature icons */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                        {[
                            { Icon: FaShieldAlt, title: 'Safety First', desc: 'Women-only attendants, transport, and local female guides throughout.' },
                            { Icon: FaUsers, title: 'Community & Connection', desc: 'Travel alongside like-minded women and build lasting friendships.' },
                            { Icon: FaHeart, title: 'Purpose-Driven Travel', desc: "Supports teenage girls' menstrual health programs and female-owned businesses." },
                        ].map((item) => (
                            <div
                                key={item.title}
                                className="text-center p-6 rounded-2xl"
                                style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-subtle)' }}
                            >
                                <item.Icon className="text-3xl mb-3 mx-auto" style={{ color: 'var(--brand-gold)' }} />
                                <h3 className="font-bold mb-2" style={{ color: 'var(--text-primary)' }}>{item.title}</h3>
                                <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>{item.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Joan Tusubira feature */}
            <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
                <div className="container mx-auto px-4 max-w-4xl">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                        <div className="md:col-span-1">
                            <div className="relative w-48 h-48 mx-auto rounded-full overflow-hidden" style={{ boxShadow: 'var(--shadow-lg)' }}>
                                <Image
                                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop"
                                    alt="Joan Tusubira"
                                    fill
                                    className="object-cover"
                                />
                            </div>
                        </div>
                        <div className="md:col-span-2">
                            <h2 className="text-2xl font-bold mb-1" style={{ color: 'var(--text-primary)' }}>Joan Tusubira</h2>
                            <p className="text-sm font-semibold mb-4" style={{ color: 'var(--brand-gold)' }}>
                                Director / Head of Women Only Safaris
                            </p>
                            <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                                Joan Tusubira is the co-founder/director of Henjo African Safaris. She is among the
                                few women in a male-dominated travel industry in Uganda. She has been working as a
                                tour guide for the past 7 years and is a strong leader passionate about female
                                travel, environment, and culture. She loves doing charity work for vulnerable
                                children and helping teenage girls with menstrual health. Her charming sense of
                                humor will make you smile. She works hard to ensure that travelers have deeply
                                balanced experiences while visiting Uganda, Kenya and Rwanda.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA */}
            <section className="py-16" style={{ background: 'var(--bg-footer)' }}>
                <div className="container mx-auto px-4 text-center">
                    <h2 className="text-2xl md:text-3xl font-bold text-white mb-4">
                        Ready to plan your women-only safari?
                    </h2>
                    <Link
                        href="/contact"
                        className="font-bold px-8 py-4 rounded-full transition transform hover:scale-105 inline-flex items-center gap-2"
                        style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                    >
                        Get in Touch
                        <FaArrowRight />
                    </Link>
                </div>
            </section>
        </div>
    );
}
