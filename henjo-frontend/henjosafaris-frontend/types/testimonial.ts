// ============================================
// TESTIMONIAL TYPES
// ============================================

export interface Testimonial {
    id: number;
    name: string;
    country: string | null;
    trip_name: string | null;
    testimonial: string;
    rating: number;
    featured: boolean;
    created_at?: string;
    updated_at?: string;
    media?: TestimonialMedia[];
}

export interface TestimonialMedia {
    id: number;
    collection_name: string;
    name: string;
    file_name: string;
    mime_type: string;
    disk: string;
    size: number;
    order_column: number;
    original_url: string;
    thumb_url?: string;
    medium_url?: string;
    large_url?: string;
}
