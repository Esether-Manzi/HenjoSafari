// ============================================
// ABOUT OUR CHARITY PAGE
// ============================================
// Content managed via the admin dashboard (Pages > About Our Charity).
// ============================================

import type { Metadata } from 'next';
import Hero from '@/components/common/Hero';
import Link from 'next/link';
import { pagesApi } from '@/lib/api/pagesApi';

async function getPage() {
    try {
        const response = await pagesApi.getBySlug('about-our-charity');
        return response.success ? response.data : null;
    } catch {
        return null;
    }
}

export async function generateMetadata(): Promise<Metadata> {
    const page = await getPage();
    return {
        title: page?.meta_title || 'About Our Charity | Henjo African Safaris',
        description: page?.meta_description || 'Making a difference through responsible tourism.',
    };
}

export default async function AboutOurCharityPage() {
    const page = await getPage();
    const ctaHref = page?.hero_cta_href || 'https://www.empathychildreninitiative.org/';
    const ctaText = page?.hero_cta_text || 'Learn More';

    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title={page?.hero_title || 'About Our Charity'}
                subtitle={page?.hero_subtitle || 'Making a difference through responsible tourism'}
                backgroundImage="/images/charity-hero.jpg"
                overlay={true}
                showTagline={false}
            />

            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-6">
                    <h2 className="text-2xl font-bold text-gray-800">Our Commitment to Community</h2>

                    <p className="text-gray-600 leading-relaxed whitespace-pre-line">
                        {page?.content || "Henjo African Safaris is more than just a premier safari company; it's a beacon of hope for vulnerable children in Africa."}
                    </p>

                    <a href={ctaHref} target="_blank" rel="noopener noreferrer" className="inline-block mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition">
                        {ctaText}
                    </a>

                    <div className="bg-yellow-50 p-6 rounded-xl border border-yellow-200 mt-6">
                        <p className="text-gray-700">
                            <strong>Want to contribute?</strong> A portion of every safari booking goes
                            towards supporting these community initiatives. Contact us to learn more about
                            how you can make a difference.
                        </p>
                        <Link
                            href="/contact"
                            className="inline-block mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition"
                        >
                            Contact Us
                        </Link>

                    </div>
                </div>
            </div>
        </div>
    );
}
