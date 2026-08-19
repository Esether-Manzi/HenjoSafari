// ============================================
// TRAVEL INFORMATION PAGE
// ============================================
// Hero + intro copy managed via the admin dashboard (Pages > Travel Information).
// The article cards link into real Blog posts (BlogSeeder), so this page
// links into /blog/[slug] rather than duplicating the full article text.
// ============================================

import type { Metadata } from 'next';
import Hero from '@/components/common/Hero';
import Link from 'next/link';
import { FaPassport, FaFileAlt, FaArrowRight } from 'react-icons/fa';
import { pagesApi } from '@/lib/api/pagesApi';

const articles = [
    {
        slug: 'east-africa-tourist-visa-guide',
        title: 'East Africa Tourist Visa guide',
        excerpt: 'Everything you need to know about the Joint East Africa Tourist Visa covering Uganda, Kenya, and Rwanda.',
        Icon: FaPassport,
    },
    {
        slug: 'entry-requirements-for-uganda',
        title: 'Entry Requirements For Uganda',
        excerpt: 'What you need for a single-entry Uganda tourist visa.',
        Icon: FaFileAlt,
    },
];

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

                <div className="container mx-auto px-4 max-w-3xl grid grid-cols-1 md:grid-cols-2 gap-6">
                    {articles.map((article) => (
                        <Link
                            key={article.slug}
                            href={`/blog/${article.slug}`}
                            className="group block rounded-2xl p-6 transition hover:scale-[1.02]"
                            style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)', border: '1px solid var(--border-primary)' }}
                        >
                            <article.Icon className="text-3xl mb-4" style={{ color: 'var(--brand-gold)' }} />
                            <h3 className="text-xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                                {article.title}
                            </h3>
                            <p className="text-sm mb-4" style={{ color: 'var(--text-tertiary)' }}>
                                {article.excerpt}
                            </p>
                            <span
                                className="inline-flex items-center gap-2 text-sm font-semibold group-hover:gap-3 transition-all"
                                style={{ color: 'var(--brand-gold)' }}
                            >
                                Read more <FaArrowRight />
                            </span>
                        </Link>
                    ))}
                </div>
            </section>
        </div>
    );
}
