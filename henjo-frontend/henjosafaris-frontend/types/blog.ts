// ============================================
// BLOG TYPES
// ============================================

export interface BlogPost {
    id: number;
    title: string;
    slug: string;
    excerpt: string | null;
    content: string;
    author_id: number;
    featured: boolean;
    status: 'draft' | 'published';
    published_at: string;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
    author?: {
        id: number;
        name: string;
        email: string;
    };
    tags?: Tag[];
    media?: BlogMedia[];
}

export interface BlogPostWithRelated {
    post: BlogPost;
    related: BlogPost[];
}

export interface Tag {
    id: number;
    name: string;
    slug: string;
    created_at?: string;
    updated_at?: string;
    posts_count?: number;
}

export interface BlogMedia {
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

export interface BlogFilters {
    tag?: string;
    search?: string;
    page?: number;
    per_page?: number;
}

// API Response Types
export interface BlogApiResponse<T = any> {
    success: boolean;
    data: T;
    message?: string;
}

export interface PaginatedBlogResponse<T> {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface TagsWithCountResponse {
    data: Tag[];
    success: boolean;
}