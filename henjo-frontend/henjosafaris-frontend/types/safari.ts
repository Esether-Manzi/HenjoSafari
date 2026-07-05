// ============================================
// SAFARI PACKAGE TYPES
// ============================================

export interface SafariPackage {
    id: number;
    title: string;
    slug: string;
    summary: string;
    description: string;
    duration_days: number;
    duration_nights: number;
    base_price: number;
    currency: string;
    featured: boolean;
    popular: boolean;
    status: 'draft' | 'published' | 'archived';
    destination_id: number;
    destination?: Destination;
    categories?: Category[];
    activities?: Activity[];
    accommodations?: Accommodation[];
    itineraryDays?: ItineraryDay[];
    inclusions?: Inclusion[];
    exclusions?: Exclusion[];
    media?: Media[];
    testimonials?: Testimonial[];
    relatedPackages?: SafariPackage[];
    seo?: SEO;
    meta_title?: string;
    meta_description?: string;
    created_at: string;
    updated_at: string;
}

export interface Destination {
    id: number;
    name: string;
    slug: string;
    description: string;
    country_id: number;
    country?: Country;
    media?: Media[];
    packages?: SafariPackage[];
}

export interface Country {
    id: number;
    name: string;
    code: string;
    flag?: string;
}

export interface Category {
    id: number;
    name: string;
    slug: string;
    description?: string;
    icon?: string;
    color?: string;
}

export interface Activity {
    id: number;
    name: string;
    slug: string;
    icon?: string;
    description?: string;
}

export interface Accommodation {
    id: number;
    name: string;
    type: 'hotel' | 'lodge' | 'camp' | 'resort';
    description: string;
    star_rating: number;
    address?: string;
    phone?: string;
    email?: string;
    website?: string;
    media?: Media[];
}

export interface ItineraryDay {
    id: number;
    safari_package_id: number;
    day_number: number;
    title: string;
    description: string;
    accommodation_id?: number;
    accommodation?: Accommodation;
    activities?: Activity[];
}

export interface Inclusion {
    id: number;
    safari_package_id: number;
    item: string;
}

export interface Exclusion {
    id: number;
    safari_package_id: number;
    item: string;
}

export interface Media {
    id: number;
    model_type: string;
    model_id: number;
    collection_name: string;
    name: string;
    file_name: string;
    mime_type: string;
    disk: string;
    conversions_disk: string;
    size: number;
    order_column: number;
    original_url: string;
    preview_url: string;
    thumb_url: string;
    large_url: string;
    created_at: string;
    updated_at: string;
}

export interface Testimonial {
    id: number;
    customer_name: string;
    country: string;
    trip_name: string;
    rating: number;
    review: string;
    avatar?: string;
    status: 'pending' | 'published' | 'rejected';
    safari_package_id?: number;
    safari_package?: SafariPackage;
    created_at: string;
}

export interface SEO {
    title: string;
    description: string;
    og_image: string;
    keywords: string;
    canonical_url?: string;
}

// ============================================
// FILTERS & PARAMS
// ============================================

export interface SafariFilters {
    destination?: string;
    category?: string;
    featured?: boolean;
    popular?: boolean;
    min_price?: number;
    max_price?: number;
    duration?: string;
    search?: string;
    page?: number;
    per_page?: number;
    sort?: 'price_asc' | 'price_desc' | 'duration_asc' | 'duration_desc' | 'popular';
}

export interface SafariParams {
    page?: number;
    limit?: number;
    search?: string;
    destination?: string;
    category?: string;
    minPrice?: number;
    maxPrice?: number;
    duration?: number;
    featured?: boolean;
}