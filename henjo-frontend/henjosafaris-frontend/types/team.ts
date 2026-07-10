// ============================================
// TEAM TYPES
// ============================================

export interface TeamMember {
    id: number;
    name: string;
    position: string;
    bio: string | null;
    email: string | null;
    phone: string | null;
    is_active: boolean;
    created_at?: string;
    updated_at?: string;
    media?: TeamMemberMedia[];
}

export interface TeamMemberMedia {
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
