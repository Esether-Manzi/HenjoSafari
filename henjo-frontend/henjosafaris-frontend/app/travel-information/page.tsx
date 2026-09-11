// ============================================
// TRAVEL INFORMATION PAGE
// ============================================
// Hero, intro copy, and the visa/entry-requirement articles below are all
// managed via the admin dashboard (Pages > Travel Information, "articles"
// section group). This page is the site's standalone travel-info archive -
// there is no separate blog system.
// ============================================

import type { Metadata } from 'next';
import Link from 'next/link';
import Image from 'next/image';
import Hero from '@/components/common/Hero';
import { FaArrowRight } from 'react-icons/fa';
import { pagesApi } from '@/lib/api/pagesApi';
import { sectionsByGroup } from '@/types/page';
import { COUNTRY_FLAGS, countrySlugFromArticleSlug, getCountryMediaMap } from '@/lib/utils/countryMedia';

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
    const [page, countryMedia] = await Promise.all([getPage(), getCountryMediaMap()]);
    const articles = sectionsByGroup(page?.sections, 'articles');

    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title={page?.hero_title || 'Travel Information'}
                subtitle={page?.hero_subtitle || 'Reliable information as you dive into the true essence of Africa'}
                secondaryCtaText="Contact Us"
                secondaryCtaLink="/contact"
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

                <div className="container mx-auto px-4 max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-6">
                    {articles.map((article) => {
                        const countrySlug = countrySlugFromArticleSlug(article.slug);
                        const media = countrySlug ? countryMedia[countrySlug] : null;
                        const Flag = media?.countryCode ? COUNTRY_FLAGS[media.countryCode] : null;

                        return (
                            <div
                                key={article.title}
                                className="rounded-2xl overflow-hidden flex flex-col"
                                style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-md)', border: '1px solid var(--border-primary)' }}
                            >
                                {media && (
                                    <div className="relative h-44 md:h-52">
                                        <Image
                                            src={media.image}
                                            alt={media.name}
                                            fill
                                            className="object-cover"
                                            sizes="(max-width: 768px) 100vw, 50vw"
                                        />
                                        <div className="absolute inset-0 bg-gradient-to-t from-black/50 via-black/5 to-transparent" />
                                        {Flag && (
                                            <div
                                                className="absolute top-3 left-3 w-9 h-6 rounded overflow-hidden ring-1 ring-white/70"
                                                style={{ boxShadow: 'var(--shadow-md)' }}
                                            >
                                                <Flag className="w-full h-full" title={media.name} />
                                            </div>
                                        )}
                                    </div>
                                )}
                                <div className="p-6 md:p-8 flex flex-col flex-1">
                                    <h2 className="text-xl md:text-2xl font-bold mb-3" style={{ color: 'var(--text-primary)' }}>
                                        {article.title}
                                    </h2>
                                    <p className="leading-relaxed flex-1" style={{ color: 'var(--text-secondary)' }}>
                                        {article.description}
                                    </p>
                                    {article.slug && (
                                        <Link
                                            href={`/travel-information/${article.slug}`}
                                            className="group inline-flex items-center gap-2 font-semibold text-sm mt-5"
                                            style={{ color: 'var(--brand-gold)' }}
                                        >
                                            Read More
                                            <FaArrowRight className="text-xs group-hover:translate-x-1 transition-transform duration-300" />
                                        </Link>
                                    )}
                                </div>
                            </div>
                        );
                    })}
                </div>
            </section>
        </div>
    );
}
