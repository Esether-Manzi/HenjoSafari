// ============================================
// COUNTRY MEDIA (flags + destination photos)
// ============================================
// Small helpers shared by pages that need to show a country's flag and/or
// its Destinations-page photo next to CMS content that only knows the
// country by name/slug (e.g. the Travel Information visa articles).

import type { ComponentType } from 'react';
import { KE, RW, TZ, UG } from 'country-flag-icons/react/3x2';
import { destinationApi } from '@/lib/api/destinationApi';
import type { Destination } from '@/types/safari';

type FlagComponent = ComponentType<{ className?: string; title?: string }>;

export const COUNTRY_FLAGS: Record<string, FlagComponent> = {
    KE, RW, TZ, UG,
};

export interface CountryMedia {
    slug: string;
    name: string;
    image: string;
    countryCode: string | null;
}

/** Turns an "entry-requirements-<country>" article slug into its destination slug, e.g. "kenya". */
export function countrySlugFromArticleSlug(slug: string | null | undefined): string | null {
    if (!slug) return null;
    const match = slug.match(/^entry-requirements-(.+)$/);
    return match ? match[1] : null;
}

/**
 * Fetches the live Destinations data and returns a lookup, by destination
 * slug, of the same photo and flag shown on the Destinations page - so a
 * visa article always matches whatever image/flag the admin has set there,
 * instead of duplicating a static asset that can drift out of sync.
 */
export async function getCountryMediaMap(): Promise<Record<string, CountryMedia>> {
    try {
        const response = await destinationApi.getAll();
        if (!response.success) return {};

        const map: Record<string, CountryMedia> = {};
        response.data.forEach((destination: Destination) => {
            map[destination.slug] = {
                slug: destination.slug,
                name: destination.country?.name || destination.name,
                image: destination.hero_image_url || `/images/destinations/${destination.slug}.png`,
                countryCode: destination.country?.code || null,
            };
        });
        return map;
    } catch {
        return {};
    }
}
