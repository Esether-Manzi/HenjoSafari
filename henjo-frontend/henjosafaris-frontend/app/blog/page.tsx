'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import Image from 'next/image';
import { FaClock, FaTag } from 'react-icons/fa';
import { blogApi } from '@/lib/api/blogApi';
import type { BlogPost } from '@/types/blog';
import Hero from '@/components/common/Hero';

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
                if (response.success) {
                    const data = response.data;
                    setPosts(data.data || []);
                    setPagination({
                        currentPage: data.current_page,
                        total: data.total,
                        lastPage: data.last_page,
                    });
                } else {
                    setError('Failed to load posts');
                }
            } catch (err: any) {
                console.error('Error fetching posts:', err);
                setError(err.message || 'Failed to load posts');
            } finally {
                setLoading(false);
            }
        };
        fetchPosts();
    }, []);

    // Helper to get image URL
    const getImageUrl = (media: any[] | undefined): string => {
        if (!media || media.length === 0) return '/images/placeholder.png';
        const image = media.find(m => m.collection_name === 'featured_image');
        return image?.medium_url || image?.original_url || '/images/placeholder.png';
    };

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

            <div className="bg-gray-50 py-16">
                <div className="container mx-auto px-4">
                    {loading ? (
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {[1, 2, 3].map((n) => (
                                <div key={n} className="bg-white rounded-2xl h-96 animate-pulse" />
                            ))}
                        </div>
                    ) : error ? (
                        <div className="text-center py-12">
                            <p className="text-red-500">{error}</p>
                            <button
                                onClick={() => window.location.reload()}
                                className="mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition"
                            >
                                Try Again
                            </button>
                        </div>
                    ) : posts.length === 0 ? (
                        <div className="text-center py-12">
                            <p className="text-gray-500 text-lg">No blog posts found</p>
                        </div>
                    ) : (
                        <>
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {posts.map((post) => {
                                    const imageUrl = getImageUrl(post.media);

                                    return (
                                        <Link
                                            key={post.id}
                                            href={`/blog/${post.slug}`}
                                            className="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300"
                                        >
                                            <div className="relative h-56 overflow-hidden">
                                                <Image
                                                    src={imageUrl}
                                                    alt={post.title}
                                                    fill
                                                    className="object-cover group-hover:scale-110 transition duration-500"
                                                />
                                                {post.featured && (
                                                    <span className="absolute top-4 left-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-semibold">
                                                        ★ Featured
                                                    </span>
                                                )}
                                            </div>
                                            <div className="p-6">
                                                <div className="flex items-center text-sm text-gray-500 mb-2">
                                                    <FaClock className="mr-1" />
                                                    {new Date(post.published_at).toLocaleDateString('en-US', {
                                                        month: 'long',
                                                        day: 'numeric',
                                                        year: 'numeric',
                                                    })}
                                                </div>
                                                <h3 className="text-xl font-bold text-gray-800 mb-2 group-hover:text-yellow-600 transition line-clamp-2">
                                                    {post.title}
                                                </h3>
                                                <p className="text-gray-600 text-sm line-clamp-3 mb-4">
                                                    {post.excerpt || post.content.substring(0, 150) + '...'}
                                                </p>
                                                <div className="flex flex-wrap gap-2">
                                                    {post.tags?.slice(0, 3).map((tag) => (
                                                        <span
                                                            key={tag.id}
                                                            className="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full flex items-center gap-1"
                                                        >
                                                            <FaTag className="text-[10px]" />
                                                            {tag.name}
                                                        </span>
                                                    ))}
                                                    {post.tags && post.tags.length > 3 && (
                                                        <span className="text-xs text-gray-400">+{post.tags.length - 3}</span>
                                                    )}
                                                </div>
                                            </div>
                                        </Link>
                                    );
                                })}
                            </div>

                            {/* Pagination */}
                            {pagination.lastPage > 1 && (
                                <div className="flex justify-center gap-2 mt-12">
                                    {[...Array(Math.min(pagination.lastPage, 5))].map((_, i) => {
                                        const pageNum = i + 1;
                                        return (
                                            <button
                                                key={i}
                                                onClick={() => {
                                                    // Implement pagination if needed
                                                    window.location.href = `/blog?page=${pageNum}`;
                                                }}
                                                className={`px-4 py-2 rounded-full transition ${
                                                    pagination.currentPage === pageNum
                                                        ? 'bg-yellow-500 text-black font-semibold'
                                                        : 'bg-white text-gray-600 hover:bg-gray-100'
                                                }`}
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