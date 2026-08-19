// ============================================
// MENU TYPES
// ============================================

export interface MenuItem {
    id: number;
    location: string;
    label: string;
    url: string;
    parent_id: number | null;
    sort_order: number;
    is_active: boolean;
    children?: MenuItem[];
}
