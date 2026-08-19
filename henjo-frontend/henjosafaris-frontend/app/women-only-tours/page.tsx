// ============================================
// WOMEN ONLY TOURS PAGE
// ============================================
// Content managed via the admin dashboard (Pages > Women Only Tours).
// ============================================

import type { Metadata } from 'next';
import Hero from '@/components/common/Hero';
import Link from 'next/link';
import Image from 'next/image';
import { FaShieldAlt, FaUsers, FaHeart, FaArrowRight } from 'react-icons/fa';
import { pagesApi } from '@/lib/api/pagesApi';
import { sectionsByGroup, firstInGroup } from '@/types/page';

const FEATURE_ICONS: Record<string, React.ComponentType<{ className?: string; style?: React.CSSProperties }>> = {
    shield: FaShieldAlt,
    users: FaUsers,
    heart: FaHeart,
};

async function getPage() {
    try {
        const response = await pagesApi.getBySlug('women-only-tours');
        return response.success ? response.data : null;
    } catch {
        return null;
    }
}

export async function generateMetadata(): Promise<Metadata> {
    const page = await getPage();
    return {
        title: page?.meta_title || 'Women Only Tours | Henjo African Safaris',
        description: page?.meta_description || 'Safe, empowering travel across Uganda, Kenya & Rwanda.',
    };
}

export default async function WomenOnlyToursPage() {
    const page = await getPage();
    const features = sectionsByGroup(page?.sections, 'features');
    const profile = firstInGroup(page?.sections, 'profile');

    return (
        <div className="min-h-screen">
            <Hero
                size="medium"
                title={page?.hero_title || 'Women Only Tours'}
                subtitle={page?.hero_subtitle || 'Safe, empowering travel across Uganda, Kenya & Rwanda'}
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
                        {(page?.content || '').split('\n').filter(Boolean).map((paragraph, i) => (
                            <p key={i} className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                                {paragraph}
                            </p>
                        ))}
                    </div>

                    {/* Feature icons */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                        {features.map((item) => {
                            const Icon = (item.icon && FEATURE_ICONS[item.icon]) || FaShieldAlt;
                            return (
                                <div
                                    key={item.title}
                                    className="text-center p-6 rounded-2xl"
                                    style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-subtle)' }}
                                >
                                    <Icon className="text-3xl mb-3 mx-auto" style={{ color: 'var(--brand-gold)' }} />
                                    <h3 className="font-bold mb-2" style={{ color: 'var(--text-primary)' }}>{item.title}</h3>
                                    <p className="text-sm" style={{ color: 'var(--text-tertiary)' }}>{item.description}</p>
                                </div>
                            );
                        })}
                    </div>
                </div>
            </section>

            {/* Featured profile */}
            {profile && (
                <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
                    <div className="container mx-auto px-4 max-w-4xl">
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                            <div className="md:col-span-1">
                                <div className="relative w-48 h-48 mx-auto rounded-full overflow-hidden" style={{ boxShadow: 'var(--shadow-lg)' }}>
                                    <Image
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop"
                                        alt={profile.title}
                                        fill
                                        className="object-cover"
                                    />
                                </div>
                            </div>
                            <div className="md:col-span-2">
                                <h2 className="text-2xl font-bold mb-1" style={{ color: 'var(--text-primary)' }}>{profile.title}</h2>
                                {profile.icon && (
                                    <p className="text-sm font-semibold mb-4" style={{ color: 'var(--brand-gold)' }}>
                                        {profile.icon}
                                    </p>
                                )}
                                <p className="leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                                    {profile.description}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            )}

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
