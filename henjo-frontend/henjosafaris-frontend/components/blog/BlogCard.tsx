'use client';

import Link from 'next/link';
import Image from 'next/image';
import { FaClock, FaTag, FaUser } from 'react-icons/fa';
import type { BlogPost } from '@/types/blog';

interface BlogCardProps {
    post: BlogPost;
    featured?: boolean;
}

/**
 * Get image URL from a blog post's media array.
 * Looks for the 'featured_image' collection first, then falls back.
 */
function getBlogImageUrl(media: BlogPost['media']): string {
    if (!media || media.length === 0) return '/images/placeholder.png';
    const image = media.find((m) => m.collection_name === 'featured_image');
    return image?.medium_url || image?.original_url || '/images/placeholder.png';
}

export default function BlogCard({ post, featured = false }: BlogCardProps) {
    const imageUrl = getBlogImageUrl(post.media);

    const formattedDate = new Date(post.published_at).toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    });

    return (
        <Link
            href={`/blog/${post.slug}`}
            className={`group rounded-2xl overflow-hidden transition duration-300 ${
                featured ? 'md:col-span-2 lg:col-span-1' : ''
            }`}
            style={{
                background: 'var(--bg-card)',
                boxShadow: 'var(--shadow-md)',
            }}
            onMouseEnter={(e) => {
                e.currentTarget.style.boxShadow = 'var(--shadow-lg)';
            }}
            onMouseLeave={(e) => {
                e.currentTarget.style.boxShadow = 'var(--shadow-md)';
            }}
        >
            {/* Image */}
            <div className="relative h-56 overflow-hidden">
                <Image
                    src={imageUrl}
                    alt={post.title}
                    fill
                    className="object-cover group-hover:scale-110 transition duration-500"
                />
                {post.featured && (
                    <span
                        className="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold"
                        style={{
                            background: 'var(--brand-gold)',
                            color: 'var(--text-on-gold)',
                        }}
                    >
                        ★ Featured
                    </span>
                )}
            </div>

            {/* Content */}
            <div className="p-6">
                {/* Meta row: date & author */}
                <div className="flex items-center gap-4 text-sm mb-2" style={{ color: 'var(--text-muted)' }}>
                    <span className="flex items-center gap-1">
                        <FaClock style={{ color: 'var(--brand-gold)' }} />
                        {formattedDate}
                    </span>
                    {post.author && (
                        <span className="flex items-center gap-1">
                            <FaUser style={{ color: 'var(--brand-gold)' }} />
                            {post.author.name}
                        </span>
                    )}
                </div>

                {/* Title */}
                <h3
                    className="text-xl font-bold mb-2 transition line-clamp-2 group-hover:text-[var(--brand-gold)]"
                    style={{ color: 'var(--text-primary)' }}
                >
                    {post.title}
                </h3>

                {/* Excerpt */}
                <p className="text-sm line-clamp-3 mb-4" style={{ color: 'var(--text-tertiary)' }}>
                    {post.excerpt || post.content.substring(0, 150) + '...'}
                </p>

                {/* Tags */}
                {post.tags && post.tags.length > 0 && (
                    <div className="flex flex-wrap gap-2 mb-4">
                        {post.tags.slice(0, 3).map((tag) => (
                            <span
                                key={tag.id}
                                className="text-xs px-2 py-1 rounded-full flex items-center gap-1"
                                style={{
                                    background: 'var(--bg-tertiary)',
                                    color: 'var(--text-tertiary)',
                                }}
                            >
                                <FaTag className="text-[10px]" />
                                {tag.name}
                            </span>
                        ))}
                        {post.tags.length > 3 && (
                            <span className="text-xs" style={{ color: 'var(--text-muted)' }}>
                                +{post.tags.length - 3}
                            </span>
                        )}
                    </div>
                )}

                {/* Read More CTA */}
                <div className="pt-4" style={{ borderTop: '1px solid var(--border-subtle)' }}>
                    <span
                        className="font-semibold text-sm transition group-hover:text-[var(--brand-gold-hover)]"
                        style={{ color: 'var(--brand-gold)' }}
                    >
                        Read More →
                    </span>
                </div>
            </div>
        </Link>
    );
}

export const MOCK_POSTS: BlogPost[] = [
    {
        id: 1,
        title: "The Ultimate Guide to Gorilla Trekking in Bwindi Impenetrable Forest",
        slug: "gorilla-trekking-bwindi-guide",
        excerpt: "Planning a gorilla safari in Uganda? Discover everything you need to know about trekking permits, what to pack, and what to expect during this once-in-a-lifetime adventure.",
        content: `## The Magic of Mountain Gorillas
Trekking deep into the ancient Bwindi Impenetrable Forest in southwestern Uganda to sit among wild mountain gorillas is often described as one of the most profound wildlife encounters on Earth. With only around 1,000 mountain gorillas remaining in the wild, this exclusive experience offers a rare glimpse into the lives of these gentle giants.

## Securing Your Permit
Gorilla tracking permits are highly sought after and strictly regulated to protect the gorillas. It is recommended to book your permit at least 6 months in advance. Permits in Uganda cost $800 for foreign non-residents.

### What to Pack
- Sturdy hiking boots with good grip
- Long-sleeved shirt and trousers to protect against thorns
- Gardening gloves for holding onto vegetation
- A lightweight rain jacket (rain is unpredictable!)
- Insect repellent and sunscreen`,
        author_id: 1,
        featured: true,
        status: 'published',
        published_at: "2026-07-01T10:00:00Z",
        created_at: "2026-07-01T10:00:00Z",
        updated_at: "2026-07-01T10:00:00Z",
        deleted_at: null,
        author: {
            id: 1,
            name: "Moses Safari",
            email: "moses@henjosafaris.com"
        },
        tags: [
            { id: 1, name: "Uganda", slug: "uganda" },
            { id: 2, name: "Gorilla Trekking", slug: "gorilla-trekking" },
            { id: 3, name: "Adventure", slug: "adventure" }
        ],
        media: [
            {
                id: 1,
                collection_name: "featured_image",
                name: "gorilla",
                file_name: "gorilla.jpg",
                mime_type: "image/jpeg",
                disk: "public",
                size: 102400,
                order_column: 1,
                original_url: "https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=800&auto=format&fit=crop"
            }
        ]
    },
    {
        id: 2,
        title: "Witnessing the Great Wildebeest Migration in Masai Mara",
        slug: "great-wildebeest-migration-masai-mara",
        excerpt: "One of the seven natural wonders of the world, the wildebeest migration is a dramatic spectacle. Learn the best time to visit Kenya's Masai Mara to catch the famous river crossings.",
        content: `## The Greatest Show on Earth
Every year, over 1.5 million wildebeest, zebra, and gazelle migrate in a giant loop across the Serengeti and Masai Mara ecosystems. The Mara River crossings are the most dramatic phase of the migration, as animals face hungry crocodiles and strong currents.

## When to Go
The migration typically arrives in Kenya's Masai Mara between July and October. August and September are the absolute peak months for river crossings.

### Photography Tips
- Bring a zoom lens (at least 300mm or 400mm)
- Use a fast shutter speed to capture the action (1/1000s or faster)
- Keep quiet and follow your guide's instructions to avoid disturbing the herds`,
        author_id: 2,
        featured: false,
        status: 'published',
        published_at: "2026-06-15T08:30:00Z",
        created_at: "2026-06-15T08:30:00Z",
        updated_at: "2026-06-15T08:30:00Z",
        deleted_at: null,
        author: {
            id: 2,
            name: "Sarah Kemunto",
            email: "sarah@henjosafaris.com"
        },
        tags: [
            { id: 4, name: "Kenya", slug: "kenya" },
            { id: 5, name: "Masai Mara", slug: "masai-mara" },
            { id: 6, name: "Wildlife", slug: "wildlife" }
        ],
        media: [
            {
                id: 2,
                collection_name: "featured_image",
                name: "migration",
                file_name: "migration.jpg",
                mime_type: "image/jpeg",
                disk: "public",
                size: 153600,
                order_column: 1,
                original_url: "https://images.unsplash.com/photo-1534447677768-be436bb09401?q=80&w=800&auto=format&fit=crop"
            }
        ]
    },
    {
        id: 3,
        title: "A Traveler's Guide to Tanzania's Serengeti National Park",
        slug: "serengeti-national-park-travelers-guide",
        excerpt: "From endless golden savannas to the famous predator action, the Serengeti is the quintessential safari destination. Read our complete guide to planning your dream Serengeti trip.",
        content: `## Welcome to the Endless Plains
The word "Serengeti" comes from the Maasai word "Siringet", which means "endless plains". This vast national park is home to an incredible concentration of predators, including lions, leopards, cheetahs, and hyenas.

## What to Do
- Go on early morning game drives when predators are most active
- Experience a hot air balloon safari over the plains at sunrise
- Visit a traditional Maasai Boma to learn about local culture

### Best Time to Visit
The Serengeti offers excellent game viewing year-round. January to March is great for the wildebeest calving season in the southern Serengeti, while June to October is dry and ideal for general wildlife spotting.`,
        author_id: 3,
        featured: false,
        status: 'published',
        published_at: "2026-05-20T14:15:00Z",
        created_at: "2026-05-20T14:15:00Z",
        updated_at: "2026-05-20T14:15:00Z",
        deleted_at: null,
        author: {
            id: 3,
            name: "John Henjo",
            email: "john@henjosafaris.com"
        },
        tags: [
            { id: 7, name: "Tanzania", slug: "tanzania" },
            { id: 8, name: "Serengeti", slug: "serengeti" },
            { id: 9, name: "Safari Tips", slug: "safari-tips" }
        ],
        media: [
            {
                id: 3,
                collection_name: "featured_image",
                name: "serengeti",
                file_name: "serengeti.jpg",
                mime_type: "image/jpeg",
                disk: "public",
                size: 204800,
                order_column: 1,
                original_url: "https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?q=80&w=800&auto=format&fit=crop"
            }
        ]
    }
];

