// ============================================
// ABOUT PAGE (Server wrapper)
// ============================================
// Fetches CMS content + site settings server-side so this route gets real
// per-page SEO metadata; the interactive parts (team carousel) live in
// AboutClient.
// ============================================

import type { Metadata } from 'next';
import AboutClient from './AboutClient';
import { pagesApi } from '@/lib/api/pagesApi';
import { settingsApi } from '@/lib/api/settingsApi';

async function getData() {
    const [pageRes, settingsRes] = await Promise.allSettled([
        pagesApi.getBySlug('about'),
        settingsApi.getSettings(),
    ]);

    const page = pageRes.status === 'fulfilled' && pageRes.value.success ? pageRes.value.data : null;
    const settings = settingsRes.status === 'fulfilled' && settingsRes.value.success ? settingsRes.value.data : null;

    return { page, settings };
}

export async function generateMetadata(): Promise<Metadata> {
    const { page } = await getData();
    return {
        title: page?.meta_title || 'About Us | Henjo African Safaris',
        description: page?.meta_description || 'Learn about Henjo African Safaris, offering custom-designed, authentic tours across Uganda, Kenya, Tanzania and Rwanda.',
    };
}

export default async function AboutPage() {
    const { page, settings } = await getData();
    return <AboutClient page={page} settings={settings} />;
}
