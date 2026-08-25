// ============================================
// TESTIMONIAL API SERVICE
// ============================================

import { apiClient, ApiResponse } from './client';
import { Testimonial } from '@/types/testimonial';

export const testimonialApi = {
    /**
     * Get featured testimonials
     */
    getFeatured: async (): Promise<ApiResponse<Testimonial[]>> => {
        return apiClient.get('/testimonials');
    },
};
