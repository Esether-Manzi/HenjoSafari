// ============================================
// SETTINGS API SERVICE
// ============================================

import { apiClient, ApiResponse } from './client';
import { SiteSettings } from '@/types/settings';

export const settingsApi = {
    /**
     * Get the global site settings
     */
    getSettings: async (): Promise<ApiResponse<SiteSettings>> => {
        return apiClient.get('/settings');
    },
};
