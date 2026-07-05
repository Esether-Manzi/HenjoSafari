// ============================================
// AXIOS CLIENT CONFIGURATION
// ============================================

import axios, { AxiosInstance, AxiosRequestConfig, AxiosError } from 'axios';

// ============================================
// DEFINE TYPES HERE (instead of importing from .next)
// ============================================
export interface ApiResponse<T = any> {
    success: boolean;
    data: T;
    message?: string;
    errors?: Record<string, string[]>;
}

export interface PaginatedResponse<T> {
    current_page: number;
    data: T[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

// ============================================
// API URL CONFIGURATION
// ============================================

let API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://127.0.0.1:8000/api/v1';

// Normalize: remove trailing slash if present to avoid double-slash when joining paths
API_URL = API_URL.replace(/\/+$/, '');

console.log('🔗 API URL:', API_URL);

// ============================================
// API CLIENT CLASS
// ============================================

class ApiClient {
    private client: AxiosInstance;
    private static instance: ApiClient;

    private constructor() {
        this.client = axios.create({
            baseURL: API_URL, // ✅ Use the constant, not process.env directly
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            timeout: 30000,
        });

        // ✅ Request interceptor
        this.client.interceptors.request.use(
            (config) => {
                // Log request for debugging
                console.log(`📡 ${config.method?.toUpperCase()} ${config.url}`);
                
                // Add auth token if available
                const token = this.getToken();
                if (token && config.headers) {
                    config.headers.Authorization = `Bearer ${token}`;
                }
                return config;
            },
            (error) => {
                console.error('❌ Request Error:', error);
                return Promise.reject(error);
            }
        );

        // ✅ Response interceptor
        this.client.interceptors.response.use(
            (response) => {
                console.log(`✅ ${response.config.url} - Status: ${response.status}`);
                return response;
            },
            (error: AxiosError) => {
                // Network-level errors (no response) are often CORS or server down
                if (!error.response) {
                    console.error('❌ Network/CORS Error: Could not reach API at', API_URL);
                    console.error('   Message:', error.message);
                    return Promise.reject(new Error(`Network Error: Could not reach API at ${API_URL}. ${error.message}`));
                }

                // Log error for debugging
                console.error('❌ API Error:', error.config?.url, error.message);
                console.error('   Status:', error.response.status);
                console.error('   Data:', error.response.data);

                // Handle 401 unauthorized
                if (error.response.status === 401) {
                    this.handleUnauthorized();
                }

                return Promise.reject(error);
            }
        );
    }

    public static getInstance(): ApiClient {
        if (!ApiClient.instance) {
            ApiClient.instance = new ApiClient();
        }
        return ApiClient.instance;
    }

    private getToken(): string | null {
        if (typeof window !== 'undefined') {
            return localStorage.getItem('auth_token');
        }
        return null;
    }

    private handleUnauthorized(): void {
        if (typeof window !== 'undefined') {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        }
    }

    // ============================================
    // HTTP METHODS
    // ============================================

    public async get<T>(url: string, config?: AxiosRequestConfig): Promise<ApiResponse<T>> {
        try {
            const response = await this.client.get<ApiResponse<T>>(url, config);
            return response.data;
        } catch (error: any) {
            // Improve message for network errors
            if (error.message && error.message.startsWith('Network Error')) {
                throw new Error(`Network Error: Unable to reach the API at ${API_URL}. ${error.message}`);
            }
            throw error;
        }
    }

    public async post<T>(url: string, data?: any, config?: AxiosRequestConfig): Promise<ApiResponse<T>> {
        try {
            const response = await this.client.post<ApiResponse<T>>(url, data, config);
            return response.data;
        } catch (error: any) {
            if (error.message && error.message.startsWith('Network Error')) {
                throw new Error(`Network Error: Unable to reach the API at ${API_URL}. ${error.message}`);
            }
            throw error;
        }
    }

    public async put<T>(url: string, data?: any, config?: AxiosRequestConfig): Promise<ApiResponse<T>> {
        try {
            const response = await this.client.put<ApiResponse<T>>(url, data, config);
            return response.data;
        } catch (error: any) {
            if (error.message && error.message.startsWith('Network Error')) {
                throw new Error(`Network Error: Unable to reach the API at ${API_URL}. ${error.message}`);
            }
            throw error;
        }
    }

    public async patch<T>(url: string, data?: any, config?: AxiosRequestConfig): Promise<ApiResponse<T>> {
        try {
            const response = await this.client.patch<ApiResponse<T>>(url, data, config);
            return response.data;
        } catch (error: any) {
            if (error.message && error.message.startsWith('Network Error')) {
                throw new Error(`Network Error: Unable to reach the API at ${API_URL}. ${error.message}`);
            }
            throw error;
        }
    }

    public async delete<T>(url: string, config?: AxiosRequestConfig): Promise<ApiResponse<T>> {
        try {
            const response = await this.client.delete<ApiResponse<T>>(url, config);
            return response.data;
        } catch (error: any) {
            if (error.message && error.message.startsWith('Network Error')) {
                throw new Error(`Network Error: Unable to reach the API at ${API_URL}. ${error.message}`);
            }
            throw error;
        }
    }
}

// ============================================
// EXPORT SINGLETON INSTANCE
// ============================================

export const apiClient = ApiClient.getInstance();

// ============================================
// EXPORT TYPES FOR CONVENIENCE
// ============================================

export type { ApiResponse as ApiResponseType, PaginatedResponse as PaginatedResponseType };