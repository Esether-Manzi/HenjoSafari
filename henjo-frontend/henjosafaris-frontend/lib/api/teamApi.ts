// ============================================
// TEAM API SERVICE
// ============================================

import { apiClient, ApiResponse } from './client';
import { TeamMember } from '@/types/team';

export const teamApi = {
    /**
     * Get all active team members
     */
    getAll: async (): Promise<ApiResponse<TeamMember[]>> => {
        return apiClient.get('/team-members');
    },
};
