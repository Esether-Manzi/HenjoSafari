// ============================================
// DESTINATION API SERVICE
// ============================================

import { apiClient, ApiResponse } from './client';
import type { Destination } from '@/types/safari';

export const destinationApi = {
    /**
     * Get all destinations
     */
    getAll: async (): Promise<ApiResponse<Destination[]>> => {
        return apiClient.get('/destinations');
    },

    /**
     * Get a single destination by slug
     */
    getBySlug: async (slug: string): Promise<ApiResponse<Destination>> => {
        return apiClient.get(`/destinations/${slug}`);
    },
};
