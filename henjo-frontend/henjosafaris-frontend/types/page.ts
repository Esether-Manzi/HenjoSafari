// ============================================
// PAGE (CMS CONTENT PAGE) TYPES
// ============================================

export interface PageSection {
    group: string;
    title: string;
    description: string | null;
    icon: string | null;
    sort_order: number;
}

export interface CmsPage {
    id: number;
    title: string;
    slug: string;
    hero_title: string | null;
    hero_subtitle: string | null;
    hero_cta_text: string | null;
    hero_cta_href: string | null;
    content: string | null;
    sections: PageSection[] | null;
    meta_title: string | null;
    meta_description: string | null;
    is_active: boolean;
    hero_image_url: string | null;
    featured_image_url: string | null;
}

/**
 * Groups a flat sections array by `group`, sorted by sort_order.
 * Use to pull a named group of cards (e.g. "features") out of a page.
 */
export function sectionsByGroup(sections: PageSection[] | null | undefined, group: string): PageSection[] {
    if (!sections) return [];
    return sections
        .filter((s) => s.group === group)
        .sort((a, b) => a.sort_order - b.sort_order);
}

/** Convenience for a group that only ever has one item (e.g. a heading block). */
export function firstInGroup(sections: PageSection[] | null | undefined, group: string): PageSection | null {
    return sectionsByGroup(sections, group)[0] ?? null;
}
