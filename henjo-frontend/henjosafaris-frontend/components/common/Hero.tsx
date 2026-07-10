'use client';

import Link from 'next/link';
import Image from 'next/image';
import { FaArrowRight } from 'react-icons/fa';

interface HeroProps {
    title?: string;
    subtitle?: string;
    ctaText?: string;
    ctaLink?: string;
    size?: 'small' | 'medium' | 'large' | 'full';
    backgroundImage?: string;
    overlay?: boolean;
    showTagline?: boolean;
    /** 'home' pins content to the bottom and adds title slide-in animation */
    variant?: 'default' | 'home';
}

export default function Hero({
    title = "Discover Tanzania's Wild Heart",
    subtitle = "Experience unforgettable safaris through the Serengeti, Ngorongoro Crater, and Zanzibar's pristine beaches.",
    ctaText = "Explore Safaris",
    ctaLink = "/safaris",
    size = 'large',
    backgroundImage = '/images/hero-bg.jpg',
    overlay = true,
    showTagline = true,
    variant = 'default',
}: HeroProps) {
    const isHome = variant === 'home';

    const sizeClasses = {
        small: 'min-h-[40vh] py-16',
        medium: 'min-h-[60vh] py-20',
        large: 'min-h-[80vh] py-24',
        full: 'min-h-screen py-32',
    };

    return (
        <section
            className={`relative flex ${isHome ? 'items-end' : 'items-center'} ${sizeClasses[size]} overflow-hidden`}
        >
            {/* Background Image */}
            <div className="absolute inset-0">
                <Image
                    src={backgroundImage}
                    alt={title}
                    fill
                    className="object-cover"
                    priority
                />
                {overlay && (
                    <div className="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-black/30" />
                )}
            </div>

            {/* Content — always centered */}
            <div className={`relative container mx-auto px-4 z-10 ${isHome ? 'pb-8' : ''}`}>
                <div className="max-w-3xl mx-auto text-center">
                    {showTagline && (
                        <div
                            className="inline-block px-4 py-1 rounded-full text-sm font-semibold mb-6"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
                        >
                            🦁 Every step, with us is an adventure
                        </div>
                    )}

                    <h1
                        className={`font-bold text-white leading-tight ${
                            isHome ? 'animate-slideFromRight' : ''
                        } ${
                            size === 'small' ? 'text-3xl md:text-4xl' :
                            size === 'medium' ? 'text-4xl md:text-5xl' :
                            size === 'large' ? 'text-5xl md:text-6xl lg:text-7xl' :
                            'text-5xl md:text-7xl lg:text-8xl'
                        }`}
                    >
                        {title}
                    </h1>

                    <p className={`text-gray-200 max-w-2xl mx-auto ${
                        size === 'small' ? 'text-base mt-3' :
                        size === 'medium' ? 'text-lg mt-4' :
                        size === 'large' ? 'text-xl mt-6' :
                        'text-2xl mt-6'
                    }`}>
                        {subtitle}
                    </p>

                    <div className="flex flex-wrap justify-center gap-4 mt-8">
                        <Link
                            href={ctaLink}
                            className="font-bold px-8 py-4 rounded-full transition transform hover:scale-105 inline-flex items-center gap-2"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
                        >
                            {ctaText}
                            <FaArrowRight />
                        </Link>
                        <Link
                            href="/about"
                            className="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-bold px-8 py-4 rounded-full transition border border-white/30"
                        >
                            Learn More
                        </Link>
                    </div>

                    {(size === 'large' || size === 'full') && (
                        <div className="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-white/20 max-w-lg mx-auto">
                            <div>
                                <p className="text-3xl font-bold" style={{ color: 'var(--brand-gold)' }}>15+</p>
                                <p className="text-gray-300 text-sm">Years Experience</p>
                            </div>
                            <div>
                                <p className="text-3xl font-bold" style={{ color: 'var(--brand-gold)' }}>500+</p>
                                <p className="text-gray-300 text-sm">Happy Travelers</p>
                            </div>
                            <div>
                                <p className="text-3xl font-bold" style={{ color: 'var(--brand-gold)' }}>4.9★</p>
                                <p className="text-gray-300 text-sm">Rating</p>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </section>
    );
}