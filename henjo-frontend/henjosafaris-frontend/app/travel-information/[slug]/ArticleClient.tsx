'use client';

import Link from 'next/link';
import { useState } from 'react';
import { FaArrowLeft, FaExternalLinkAlt } from 'react-icons/fa';
import Hero from '@/components/common/Hero';
import type { PageSection } from '@/types/page';
import { parseArticleBody } from '@/lib/utils/articleBody';
import { COUNTRY_FLAGS, type CountryMedia } from '@/lib/utils/countryMedia';

interface ArticleClientProps {
    article: PageSection;
    media: CountryMedia | null;
}

export default function ArticleClient({ article, media }: ArticleClientProps) {
    const hasSwahili = Boolean(article.body_sw);
    const [language, setLanguage] = useState<'en' | 'sw'>('en');
    const body = language === 'sw' && hasSwahili ? article.body_sw : article.body;
    const blocks = parseArticleBody(body);
    const Flag = media?.countryCode ? COUNTRY_FLAGS[media.countryCode] : null;

    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title={article.title}
                subtitle="Reliable, easy-to-follow visa and entry information for your safari"
                secondaryCtaText="Contact Us"
                secondaryCtaLink="/contact"
                backgroundImage={media?.image || '/images/destinations/uganda.png'}
                overlay={true}
                showTagline={false}
            />

            <section className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-primary)' }}>
                <div className="container mx-auto px-4 max-w-3xl">
                    <div className="flex flex-wrap items-center justify-between gap-4 mb-8">
                        <Link
                            href="/travel-information"
                            className="inline-flex items-center gap-2 text-sm font-semibold"
                            style={{ color: 'var(--brand-gold)' }}
                        >
                            <FaArrowLeft className="text-xs" />
                            Back to Travel Information
                        </Link>

                        {media && (
                            <div
                                className="inline-flex items-center gap-2 pl-1.5 pr-3 py-1.5 rounded-full text-sm font-semibold"
                                style={{ background: 'var(--bg-card)', border: '1px solid var(--border-primary)', color: 'var(--text-primary)' }}
                            >
                                {Flag && (
                                    <span className="w-6 h-4 rounded-sm overflow-hidden inline-block ring-1 ring-black/10">
                                        <Flag className="w-full h-full" title={media.name} />
                                    </span>
                                )}
                                {media.name}
                            </div>
                        )}
                    </div>

                    <div className="flex flex-wrap items-center justify-between gap-4 mb-8">
                        {article.source_url && (
                            <a
                                href={article.source_url}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="inline-flex items-center gap-2 font-semibold text-sm px-5 py-2.5 rounded-full transition hover:scale-105"
                                style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                            >
                                {article.source_label || 'Visit official government website'}
                                <FaExternalLinkAlt className="text-xs" />
                            </a>
                        )}

                        {hasSwahili && (
                            <div
                                className="inline-flex rounded-full p-1 text-sm font-semibold"
                                style={{ background: 'var(--bg-card)', border: '1px solid var(--border-primary)' }}
                            >
                                <button
                                    type="button"
                                    onClick={() => setLanguage('en')}
                                    className="px-4 py-1.5 rounded-full transition"
                                    style={
                                        language === 'en'
                                            ? { background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }
                                            : { color: 'var(--text-secondary)' }
                                    }
                                >
                                    English
                                </button>
                                <button
                                    type="button"
                                    onClick={() => setLanguage('sw')}
                                    className="px-4 py-1.5 rounded-full transition"
                                    style={
                                        language === 'sw'
                                            ? { background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }
                                            : { color: 'var(--text-secondary)' }
                                    }
                                >
                                    Kiswahili
                                </button>
                            </div>
                        )}
                    </div>

                    <article
                        className="rounded-2xl p-6 md:p-10"
                        style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)', border: '1px solid var(--border-primary)' }}
                    >
                        {blocks.map((block, i) => {
                            if (block.type === 'heading') {
                                return (
                                    <h2
                                        key={i}
                                        className={`text-lg md:text-xl font-bold mb-3 ${i > 0 ? 'mt-8' : ''}`}
                                        style={{ color: 'var(--brand-gold)' }}
                                    >
                                        {block.text}
                                    </h2>
                                );
                            }
                            if (block.type === 'list') {
                                return (
                                    <ul key={i} className="space-y-2 mb-4 list-disc pl-5" style={{ color: 'var(--text-secondary)' }}>
                                        {block.items.map((item, j) => (
                                            <li key={j} className="leading-relaxed">
                                                {item}
                                            </li>
                                        ))}
                                    </ul>
                                );
                            }
                            return (
                                <p key={i} className="leading-relaxed mb-4" style={{ color: 'var(--text-secondary)' }}>
                                    {block.text}
                                </p>
                            );
                        })}
                    </article>
                </div>
            </section>
        </div>
    );
}
