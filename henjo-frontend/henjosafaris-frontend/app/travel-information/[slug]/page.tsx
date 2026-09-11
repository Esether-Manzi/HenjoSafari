// ============================================
// TRAVEL INFORMATION - ARTICLE DETAIL (Server wrapper)
// ============================================
// Full entry-requirement articles live as "articles"-group sections on the
// travel-information CMS page (see app/travel-information/page.tsx). This
// route looks up one section by its `slug` field and renders the full
// body; the interactive language toggle lives in ArticleClient.
// ============================================

import type { Metadata } from 'next';
import { notFound } from 'next/navigation';
import ArticleClient from './ArticleClient';
import { pagesApi } from '@/lib/api/pagesApi';
import { sectionsByGroup } from '@/types/page';
import { countrySlugFromArticleSlug, getCountryMediaMap } from '@/lib/utils/countryMedia';

async function getArticle(slug: string) {
    try {
        const response = await pagesApi.getBySlug('travel-information');
        if (!response.success) return null;
        const articles = sectionsByGroup(response.data.sections, 'articles');
        return articles.find((article) => article.slug === slug) || null;
    } catch {
        return null;
    }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
    const { slug } = await params;
    const article = await getArticle(slug);
    if (!article) {
        return { title: 'Travel Information | Henjo African Safaris' };
    }
    return {
        title: `${article.title} | Henjo African Safaris`,
        description: article.description || undefined,
    };
}

export default async function TravelArticlePage({ params }: { params: Promise<{ slug: string }> }) {
    const { slug } = await params;
    const article = await getArticle(slug);

    if (!article) {
        notFound();
    }

    const countrySlug = countrySlugFromArticleSlug(article.slug);
    const countryMedia = await getCountryMediaMap();
    const media = countrySlug ? countryMedia[countrySlug] || null : null;

    return <ArticleClient article={article} media={media} />;
}
