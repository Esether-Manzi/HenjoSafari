// ============================================
// SAFARI API SERVICE
// ============================================

import { apiClient, ApiResponse, PaginatedResponse } from './client';
import { SafariPackage } from '@/types/safari';

export const safariApi = {
    /**
     * Get all safari packages with pagination and filters
     */
    getAll: async (): Promise<ApiResponse<PaginatedResponse<SafariPackage>>> => {
        try {
            const response = await apiClient.get<PaginatedResponse<SafariPackage>>('/safaris');
            return response;
        } catch (error: any) {
            console.error('API Error:', error.response?.data || error.message);
            throw error;
        }
    },

    getBySlug: async (slug: string): Promise<ApiResponse<SafariPackage>> => {
        try {
            const response = await apiClient.get<SafariPackage>(`/safaris/${slug}`);
            return response;
        } catch (error: any) {
            console.error('API Error:', error.response?.data || error.message);
            throw error;
        }
    },


    // getPackages: async (filters?: SafariFilters): Promise<ApiResponse<PaginatedResponse<SafariPackage>>> => {
    //     return apiClient.get('/safaris', { params: filters });
    // },

    /**
     * Get a single safari package by slug
     */
    // getPackage: async (slug: string): Promise<ApiResponse<SafariPackage>> => {
    //     return apiClient.get(`/safaris/${slug}`);
    // },

    /**
     * Get featured safari packages
     */
    getFeatured: async (limit: number = 6): Promise<ApiResponse<SafariPackage[]>> => {
        return apiClient.get('/safaris/featured', { params: { limit } });
    },

    /**
     * Get popular safari packages
     */
    getPopular: async (limit: number = 6): Promise<ApiResponse<SafariPackage[]>> => {
        return apiClient.get('/safaris/popular', { params: { limit } });
    },

    /**
     * Search safari packages
     */
    searchPackages: async (query: string): Promise<ApiResponse<PaginatedResponse<SafariPackage>>> => {
        return apiClient.get('/safaris', { params: { search: query } });
    },

    /**
     * Get packages by destination
     */
    getPackagesByDestination: async (destinationSlug: string): Promise<ApiResponse<PaginatedResponse<SafariPackage>>> => {
        return apiClient.get('/safaris', { params: { destination: destinationSlug } });
    },

    /**
     * Get packages by category
     */
    getPackagesByCategory: async (categorySlug: string): Promise<ApiResponse<PaginatedResponse<SafariPackage>>> => {
        return apiClient.get('/safaris', { params: { category: categorySlug } });
    },
};