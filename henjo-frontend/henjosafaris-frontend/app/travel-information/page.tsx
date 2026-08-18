// ============================================
// TRAVEL INFORMATION PAGE
// ============================================
// Intro copy + article cards from
// henjosafaris-content-audit.md §3.6/§5.6. The two
// articles are seeded as real Blog posts (BlogSeeder),
// so this page links into /blog/[slug] rather than
// duplicating the full article text.
// ============================================

import Hero from '@/components/common/Hero';
import Link from 'next/link';
import { FaPassport, FaFileAlt, FaArrowRight } from 'react-icons/fa';

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

export default function TravelInformationPage() {
    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title="Travel Information"
                subtitle="Reliable information as you dive into the true essence of Africa"
                backgroundImage="/images/destinations/uganda.png"
                overlay={true}
                showTagline={false}
            />

            <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-3xl text-center mb-12">
                    <p className="text-lg leading-relaxed" style={{ color: 'var(--text-secondary)' }}>
                        Africa is extraordinary and her people evoke a sense of adventure, romance and deep
                        connection to nature. Find the reliable information from Henjo African Safaris as you
                        dive into the true essence of Africa.
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
