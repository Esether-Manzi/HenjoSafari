// ============================================
// BLOG API SERVICE
// ============================================

import { apiClient, ApiResponse, PaginatedResponse } from './client';
import { BlogPost, BlogPostWithRelated, Tag, BlogFilters } from '@/types/blog';

export const blogApi = {
    /**
     * Get all blog posts with pagination and filters
     */
    getAll: async (filters?: BlogFilters): Promise<ApiResponse<PaginatedResponse<BlogPost>>> => {
        return apiClient.get('/posts', { params: filters });
    },

    /**
     * Get a single blog post by slug with related posts
     */
    getBySlug: async (slug: string): Promise<ApiResponse<BlogPostWithRelated>> => {
        return apiClient.get(`/posts/${slug}`);
    },

    /**
     * Get featured blog posts for homepage
     */
    getFeatured: async (limit: number = 3): Promise<ApiResponse<BlogPost[]>> => {
        return apiClient.get('/posts/featured', { params: { limit } });
    },

    /**
     * Get all tags with post counts
     */
    getTags: async (): Promise<ApiResponse<Tag[]>> => {
        return apiClient.get('/posts/tags');
    },

    /**
     * Get posts by tag slug
     */
    getPostsByTag: async (tagSlug: string): Promise<ApiResponse<{ tag: Tag; posts: PaginatedResponse<BlogPost> }>> => {
        return apiClient.get(`/posts/tag/${tagSlug}`);
    },
};