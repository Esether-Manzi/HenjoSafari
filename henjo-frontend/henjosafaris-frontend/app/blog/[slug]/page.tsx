'use client';

import { useEffect, useState } from 'react';
import { useParams } from 'next/navigation';
import Link from 'next/link';
import Image from 'next/image';
import Head from 'next/head';
import { FaClock, FaUser, FaTag, FaArrowLeft, FaShare, FaFacebook, FaTwitter, FaWhatsapp } from 'react-icons/fa';
import { blogApi } from '@/lib/api/blogApi';
import type { BlogPost } from '@/types/blog';

export default function BlogDetailPage() {
    const params = useParams();
    const slug = params.slug as string;

    const [post, setPost] = useState<BlogPost | null>(null);
    const [related, setRelated] = useState<BlogPost[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchPost = async () => {
            try {
                const response = await blogApi.getBySlug(slug);
                if (response.success) {
                    setPost(response.data.post);
                    setRelated(response.data.related || []);
                }
            } catch (err: any) {
                console.error('Error fetching post:', err);
                setError(err.message || 'Post not found');
            } finally {
                setLoading(false);
            }
        };
        if (slug) fetchPost();
    }, [slug]);

    // Helper to get image URL
    const getImageUrl = (media: any[] | undefined): string => {
        if (!media || media.length === 0) return '/images/placeholder.png';
        const image = media.find(m => m.collection_name === 'featured_image');
        return image?.large_url || image?.original_url || '/images/placeholder.png';
    };

    if (loading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-gray-50">
                <div className="text-center">
                    <div className="inline-block animate-spin rounded-full h-12 w-12 border-4 border-yellow-500 border-t-transparent"></div>
                    <p className="mt-4 text-gray-600">Loading post...</p>
                </div>
            </div>
        );
    }

    if (error || !post) {
        return <NotFound />;
    }

    const imageUrl = getImageUrl(post.media);
    const shareUrl = typeof window !== 'undefined' ? window.location.href : '';
    const shareTitle = post.title;

    return (
        <div className="min-h-screen bg-gray-50">
            <Head>
                <title>{post.title} - Henjo Safaris Blog</title>
                <meta name="description" content={post.excerpt || post.content.substring(0, 160)} />
                <meta property="og:title" content={post.title} />
                <meta property="og:description" content={post.excerpt || post.content.substring(0, 160)} />
                <meta property="og:image" content={imageUrl} />
                <meta name="twitter:card" content="summary_large_image" />
            </Head>

            {/* Hero Section */}
            <section className="relative h-[50vh] min-h-[350px]">
                <div className="absolute inset-0">
                    <Image
                        src={imageUrl}
                        alt={post.title}
                        fill
                        className="object-cover"
                        priority
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent" />
                </div>
                <div className="relative h-full container mx-auto px-4 flex flex-col justify-end pb-12">
                    <div className="max-w-4xl">
                        <Link href="/blog" className="inline-flex items-center gap-2 text-yellow-400 hover:text-yellow-300 mb-4 transition">
                            <FaArrowLeft /> Back to Blog
                        </Link>
                        <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">
                            {post.title}
                        </h1>
                        <div className="flex flex-wrap items-center gap-6 text-white/80 text-sm">
                            <span className="flex items-center gap-2">
                                <FaUser className="text-yellow-400" />
                                {post.author?.name || 'Admin'}
                            </span>
                            <span className="flex items-center gap-2">
                                <FaClock className="text-yellow-400" />
                                {new Date(post.published_at).toLocaleDateString('en-US', {
                                    month: 'long',
                                    day: 'numeric',
                                    year: 'numeric',
                                })}
                            </span>
                            {post.tags && post.tags.length > 0 && (
                                <span className="flex items-center gap-2">
                                    <FaTag className="text-yellow-400" />
                                    {post.tags.map(t => t.name).join(', ')}
                                </span>
                            )}
                        </div>
                    </div>
                </div>
            </section>

            {/* Content */}
            <div className="container mx-auto px-4 py-12 max-w-4xl">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                    <div className="prose prose-lg max-w-none prose-headings:text-gray-800 prose-p:text-gray-600 prose-a:text-yellow-600">
                        {post.content.split('\n').map((paragraph, i) => {
                            if (paragraph.startsWith('## ')) {
                                return <h2 key={i} className="text-2xl font-bold mt-8 mb-4">{paragraph.replace('## ', '')}</h2>;
                            } else if (paragraph.startsWith('### ')) {
                                return <h3 key={i} className="text-xl font-bold mt-6 mb-3">{paragraph.replace('### ', '')}</h3>;
                            } else if (paragraph.startsWith('- ')) {
                                return <li key={i} className="ml-4 text-gray-600">{paragraph.replace('- ', '')}</li>;
                            } else if (paragraph.trim()) {
                                return <p key={i} className="mb-4">{paragraph}</p>;
                            }
                            return null;
                        })}
                    </div>

                    {/* Share Section */}
                    <div className="mt-12 pt-8 border-t border-gray-200">
                        <h4 className="font-semibold text-gray-700 mb-4">Share this post</h4>
                        <div className="flex gap-3">
                            <a
                                href={`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="bg-[#1877f2] hover:bg-[#166fe5] text-white p-3 rounded-full transition"
                            >
                                <FaFacebook size={20} />
                            </a>
                            <a
                                href={`https://twitter.com/intent/tweet?text=${encodeURIComponent(shareTitle)}&url=${encodeURIComponent(shareUrl)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="bg-[#000000] hover:bg-[#1a1a1a] text-white p-3 rounded-full transition"
                            >
                                <FaTwitter size={20} />
                            </a>
                            <a
                                href={`https://wa.me/?text=${encodeURIComponent(shareTitle + ' ' + shareUrl)}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="bg-[#25D366] hover:bg-[#20b858] text-white p-3 rounded-full transition"
                            >
                                <FaWhatsapp size={20} />
                            </a>
                            <button
                                onClick={() => {
                                    navigator.clipboard.writeText(shareUrl);
                                    alert('Link copied to clipboard!');
                                }}
                                className="bg-gray-200 hover:bg-gray-300 text-gray-700 p-3 rounded-full transition"
                            >
                                <FaShare size={20} />
                            </button>
                        </div>
                    </div>
                </div>

                {/* Related Posts */}
                {related.length > 0 && (
                    <div className="mt-16">
                        <h3 className="text-2xl font-bold text-gray-800 mb-6">You Might Also Like</h3>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {related.map((p) => {
                                const img = p.media?.find(m => m.collection_name === 'featured_image');
                                const imgUrl = img?.medium_url || img?.original_url || '/images/placeholder.jpg';
                                return (
                                    <Link
                                        key={p.id}
                                        href={`/blog/${p.slug}`}
                                        className="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition"
                                    >
                                        <div className="relative h-48">
                                            <Image
                                                src={imgUrl}
                                                alt={p.title}
                                                fill
                                                className="object-cover group-hover:scale-105 transition duration-300"
                                            />
                                        </div>
                                        <div className="p-4">
                                            <h4 className="font-semibold text-gray-800 group-hover:text-yellow-600 transition line-clamp-2">
                                                {p.title}
                                            </h4>
                                            <p className="text-sm text-gray-500 mt-1 line-clamp-2">
                                                {p.excerpt || p.content.substring(0, 100) + '...'}
                                            </p>
                                        </div>
                                    </Link>
                                );
                            })}
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}

// ============================================
// NOT FOUND COMPONENT
// ============================================
function NotFound() {
    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50">
            <div className="text-center p-8">
                <h1 className="text-6xl font-bold text-gray-300 mb-4">404</h1>
                <h2 className="text-2xl font-bold text-gray-800 mb-2">Post Not Found</h2>
                <p className="text-gray-500 mb-6">The blog post you're looking for doesn't exist.</p>
                <Link
                    href="/blog"
                    className="bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-6 py-3 rounded-full inline-block transition"
                >
                    Back to Blog
                </Link>
            </div>
        </div>
    );
}