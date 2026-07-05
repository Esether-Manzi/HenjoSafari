// ============================================
// CUSTOM HOOK: useSafari
// ============================================

import { useState, useEffect, useCallback } from 'react';
import { safariApi } from '../api/safariApi';
import { SafariPackage, SafariFilters, PaginatedResponse } from '@/types';

export const useSafari = (initialFilters?: SafariFilters) => {
    const [packages, setPackages] = useState<SafariPackage[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [pagination, setPagination] = useState<{
        currentPage: number;
        total: number;
        perPage: number;
        totalPages: number;
    }>({
        currentPage: 1,
        total: 0,
        perPage: 12,
        totalPages: 0,
    });
    const [filters, setFilters] = useState<SafariFilters>(initialFilters || {});

    const fetchPackages = useCallback(async (params?: SafariFilters) => {
        try {
            setLoading(true);
            setError(null);

            const response = await safariApi.getAll();

            if (response.success) {
                const paginatedData = response.data as PaginatedResponse<SafariPackage>;
                setPackages(paginatedData.data);
                setPagination({
                    currentPage: paginatedData.current_page,
                    total: paginatedData.total,
                    perPage: paginatedData.per_page,
                    totalPages: paginatedData.last_page,
                });
            } else {
                setError(response.message || 'Failed to fetch packages');
            }
        } catch (err) {
            setError('An error occurred while fetching packages');
            console.error('Error fetching packages:', err);
        } finally {
            setLoading(false);
        }
    }, [filters]);

    const updateFilters = useCallback((newFilters: Partial<SafariFilters>) => {
        setFilters((prev) => ({ ...prev, ...newFilters, page: 1 }));
    }, []);

    const goToPage = useCallback((page: number) => {
        setFilters((prev) => ({ ...prev, page }));
    }, []);

    useEffect(() => {
        fetchPackages();
    }, [filters, fetchPackages]);

    return {
        packages,
        loading,
        error,
        pagination,
        filters,
        updateFilters,
        goToPage,
        refetch: fetchPackages,
    };
};