// ============================================
// MENU API SERVICE
// ============================================

import { apiClient, ApiResponse } from './client';
import { MenuItem } from '@/types/menu';

export const menuApi = {
    /**
     * Get the menu tree for a given location (e.g. "navbar", "footer")
     */
    getMenu: async (location: string): Promise<ApiResponse<MenuItem[]>> => {
        return apiClient.get(`/menus/${location}`);
    },
};
