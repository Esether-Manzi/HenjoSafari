'use client';

import { useEffect, useState } from 'react';
import { blogApi } from '@/lib/api/blogApi';
import type { BlogPost } from '@/types/blog';
import Hero from '@/components/common/Hero';
import BlogCard, { MOCK_POSTS } from '@/components/blog/BlogCard';

export default function BlogPage() {
    const [posts, setPosts] = useState<BlogPost[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [pagination, setPagination] = useState({
        currentPage: 1,
        total: 0,
        lastPage: 1,
    });

    useEffect(() => {
        const fetchPosts = async () => {
            try {
                setLoading(true);
                const response = await blogApi.getAll();
                if (response.success && response.data?.data?.length > 0) {
                    const data = response.data;
                    setPosts(data.data || []);
                    setPagination({
                        currentPage: data.current_page,
                        total: data.total,
                        lastPage: data.last_page,
                    });
                } else {
                    // Fallback to mock data if empty
                    setPosts(MOCK_POSTS);
                    setPagination({
                        currentPage: 1,
                        total: MOCK_POSTS.length,
                        lastPage: 1,
                    });
                }
            } catch (err: any) {
                console.warn('Error fetching posts, using mock data:', err);
                // Fallback to mock data on error so design is visible
                setPosts(MOCK_POSTS);
                setPagination({
                    currentPage: 1,
                    total: MOCK_POSTS.length,
                    lastPage: 1,
                });
            } finally {
                setLoading(false);
            }
        };
        fetchPosts();
    }, []);

    return (
        <div className="min-h-screen">
            <Hero
                size="medium"
                title="Travel Blog"
                subtitle="Stories, tips, and inspiration for your African adventure"
                ctaText="Read More"
                ctaLink="#"
                backgroundImage="/images/blog-hero.jpg"
                overlay={true}
                showTagline={true}
            />

            <div className="py-16 transition-colors duration-300" style={{ background: 'var(--bg-secondary)' }}>
                <div className="container mx-auto px-4">
                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {[1, 2, 3].map((n) => (
                                <div
                                    key={n}
                                    className="rounded-2xl h-96 animate-pulse"
                                    style={{ background: 'var(--bg-tertiary)' }}
                                />
                            ))}
                        </div>
                    ) : error ? (
                        <div className="text-center py-12">
                            <p style={{ color: 'var(--brand-maroon)' }}>{error}</p>
                            <button
                                onClick={() => window.location.reload()}
                                className="mt-4 font-semibold px-6 py-2 rounded-full transition"
                                style={{
                                    background: 'var(--brand-gold)',
                                    color: 'var(--text-on-gold)',
                                }}
                            >
                                Try Again
                            </button>
                        </div>
                    ) : posts.length === 0 ? (
                        <div className="text-center py-12">
                            <p className="text-lg" style={{ color: 'var(--text-muted)' }}>No blog posts found</p>
                        </div>
                    ) : (
                        <>
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {posts.map((post) => (
                                    <BlogCard key={post.id} post={post} />
                                ))}
                            </div>

                            {/* Pagination */}
                            {pagination.lastPage > 1 && (
                                <div className="flex justify-center gap-2 mt-12">
                                    {[...Array(Math.min(pagination.lastPage, 5))].map((_, i) => {
                                        const pageNum = i + 1;
                                        const isActive = pagination.currentPage === pageNum;
                                        return (
                                            <button
                                                key={i}
                                                onClick={() => {
                                                    window.location.href = `/blog?page=${pageNum}`;
                                                }}
                                                className="px-4 py-2 rounded-full transition font-semibold"
                                                style={{
                                                    background: isActive ? 'var(--brand-gold)' : 'var(--bg-card)',
                                                    color: isActive ? 'var(--text-on-gold)' : 'var(--text-secondary)',
                                                    boxShadow: isActive ? 'none' : 'var(--shadow-sm)',
                                                }}
                                            >
                                                {pageNum}
                                            </button>
                                        );
                                    })}
                                </div>
                            )}
                        </>
                    )}
                </div>
            </div>
        </div>
    );
}