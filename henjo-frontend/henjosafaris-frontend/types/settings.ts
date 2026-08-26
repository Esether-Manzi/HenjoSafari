// ============================================
// SITE SETTINGS TYPES
// ============================================

export interface SiteSettings {
    id: number;
    site_name: string;
    tagline: string | null;
    email: string | null;
    phone: string | null;
    address: string | null;
    working_hours_weekday: string | null;
    working_hours_saturday: string | null;
    facebook_url: string | null;
    twitter_url: string | null;
    instagram_url: string | null;
    linkedin_url: string | null;
    tiktok_url: string | null;
    youtube_url: string | null;
    tripadvisor_url: string | null;
    payment_url: string | null;
    years_experience: string | null;
    happy_travelers_count: string | null;
    average_rating: string | null;
    footer_tagline: string | null;
    safari_package_count: number;
    country_count: number;
    logo_url: string | null;
    homepage_hero_url: string | null;
}
