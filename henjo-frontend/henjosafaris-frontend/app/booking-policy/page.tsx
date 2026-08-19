// ============================================
// BOOKING POLICY PAGE
// ============================================
// Content is managed via the admin dashboard (Pages > Booking Policy).
// ============================================

import type { Metadata } from 'next';
import Hero from '@/components/common/Hero';
import Link from 'next/link';
import { pagesApi } from '@/lib/api/pagesApi';
import { sectionsByGroup } from '@/types/page';

async function getPage() {
    try {
        const response = await pagesApi.getBySlug('booking-policy');
        return response.success ? response.data : null;
    } catch {
        return null;
    }
}

export async function generateMetadata(): Promise<Metadata> {
    const page = await getPage();
    return {
        title: page?.meta_title || 'Booking Policy | Henjo African Safaris',
        description: page?.meta_description || 'Terms and conditions for booking your safari.',
    };
}

export default async function BookingPolicyPage() {
    const page = await getPage();
    const policySections = sectionsByGroup(page?.sections, 'policy');

    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title={page?.hero_title || 'Booking Policy'}
                subtitle={page?.hero_subtitle || 'Terms and conditions for booking your safari'}
                ctaText={page?.hero_cta_text || 'Contact Us'}
                ctaLink={page?.hero_cta_href || '/contact'}
                backgroundImage="/images/policy-hero.jpg"
                overlay={true}
                showTagline={false}
            />

            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-6">

                    <h2 className="text-2xl font-bold text-gray-800">BOOKING POLICY</h2>

                    {policySections.map((section) => (
                        <div key={section.title}>
                            <h3 className="text-xl font-semibold text-gray-800 mb-2">{section.title}</h3>
                            <p className="text-gray-600 whitespace-pre-line">
                                {section.description}
                            </p>
                        </div>
                    ))}

                    <div className="bg-gray-50 p-6 rounded-xl mt-6">
                        <p className="text-gray-700">
                            <strong>Need more information?</strong> Contact our booking team for
                            personalized assistance with your safari booking.
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
