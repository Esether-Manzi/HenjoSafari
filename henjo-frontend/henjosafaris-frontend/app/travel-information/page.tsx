// ============================================
// TRAVEL INFORMATION PAGE
// ============================================
// Hero, intro copy, and the visa/entry-requirement articles below are all
// managed via the admin dashboard (Pages > Travel Information, "articles"
// section group). This page is the site's standalone travel-info archive —
// there is no separate blog system.
// ============================================

import type { Metadata } from 'next';
import Hero from '@/components/common/Hero';
import { FaPassport, FaFileAlt, FaGlobeAfrica } from 'react-icons/fa';
import { pagesApi } from '@/lib/api/pagesApi';
import { sectionsByGroup } from '@/types/page';

const ARTICLE_ICONS: Record<string, React.ComponentType<{ className?: string; style?: React.CSSProperties }>> = {
    passport: FaPassport,
    file: FaFileAlt,
};

async function getPage() {
    try {
        const response = await pagesApi.getBySlug('travel-information');
        return response.success ? response.data : null;
    } catch {
        return null;
    }
}

export async function generateMetadata(): Promise<Metadata> {
    const page = await getPage();
    return {
        title: page?.meta_title || 'Travel Information | Henjo African Safaris',
        description: page?.meta_description || 'Reliable information as you dive into the true essence of Africa.',
    };
}

export default async function TravelInformationPage() {
    const page = await getPage();
    const articles = sectionsByGroup(page?.sections, 'articles');

    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title={page?.hero_title || 'Travel Information'}
                subtitle={page?.hero_subtitle || 'Reliable information as you dive into the true essence of Africa'}
                backgroundImage="/images/destinations/uganda.png"
                overlay={true}
                showTagline={false}
            />

            <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-3xl text-center mb-12">
                    <p className="text-lg leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                        {page?.content || "Africa is extraordinary and her people evoke a sense of adventure, romance and deep connection to nature. Find the reliable information from Henjo African Safaris as you dive into the true essence of Africa."}
                    </p>
                </div>

                <div className="container mx-auto px-4 max-w-3xl space-y-6">
                    {articles.map((article) => {
                        const Icon = (article.icon && ARTICLE_ICONS[article.icon]) || FaGlobeAfrica;
                        return (
                            <div
                                key={article.title}
                                className="rounded-2xl p-6 md:p-8"
                                style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)', border: '1px solid var(--border-primary)' }}
                            >
                                <div className="flex items-center gap-3 mb-4">
                                    <Icon className="text-2xl" style={{ color: 'var(--brand-gold)' }} />
                                    <h2 className="text-xl md:text-2xl font-bold" style={{ color: 'var(--text-primary)' }}>
                                        {article.title}
                                    </h2>
                                </div>
                                {(article.description || '').split('\n').filter(Boolean).map((paragraph, i) => (
                                    <p key={i} className={`leading-relaxed ${i > 0 ? 'mt-4' : ''}`} style={{ color: 'var(--text-secondary)' }}>
                                        {paragraph}
                                    </p>
                                ))}
                            </div>
                        );
                    })}
                </div>
            </section>
        </div>
    );
}
