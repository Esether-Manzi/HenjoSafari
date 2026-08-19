// ============================================
// PAGES (CMS CONTENT) API SERVICE
// ============================================

import { apiClient, ApiResponse } from './client';
import { CmsPage } from '@/types/page';

export const pagesApi = {
    /**
     * Get a single content page by slug
     */
    getBySlug: async (slug: string): Promise<ApiResponse<CmsPage>> => {
        return apiClient.get(`/pages/${slug}`);
    },
};
