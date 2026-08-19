'use client';

import Link from 'next/link';
import Image from 'next/image';
import { useEffect, useState } from 'react';
import { FaArrowRight, FaPaw, FaStar } from 'react-icons/fa';
import { settingsApi } from '@/lib/api/settingsApi';

const DEFAULT_TAGLINE = 'Every step, with us is an adventure';

interface HeroProps {
    title?: string;
    subtitle?: string;
    ctaText?: string;
    ctaLink?: string;
    size?: 'small' | 'medium' | 'large' | 'full';
    backgroundImage?: string;
    /** When set, plays as a looping muted background video instead of the static image (backgroundImage is used as its poster). */
    backgroundVideo?: string;
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
    backgroundVideo,
    overlay = true,
    showTagline = true,
    variant = 'default',
}: HeroProps) {
    const isHome = variant === 'home';
    const [tagline, setTagline] = useState(DEFAULT_TAGLINE);

    useEffect(() => {
        if (!showTagline) return;
        settingsApi.getSettings()
            .then((res) => {
                if (res.success && res.data.tagline) setTagline(res.data.tagline);
            })
            .catch(() => {});
    }, [showTagline]);

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
            {/* Background Image / Video */}
            <div className="absolute inset-0">
                {backgroundVideo ? (
                    <video
                        className="absolute inset-0 w-full h-full object-cover"
                        src={backgroundVideo}
                        poster={backgroundImage}
                        autoPlay
                        loop
                        muted
                        playsInline
                        preload="auto"
                    />
                ) : (
                    <Image
                        src={backgroundImage}
                        alt={title}
                        fill
                        className="object-cover"
                        priority
                    />
                )}
                {overlay && (
                    <div className="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-black/30" />
                )}
            </div>

            {/* Smooth cinematic vignette into the section below (deepens to black
                regardless of theme — fading to a theme color here would wash out
                against the still-visible photo underneath) */}
            <div
                className="absolute inset-x-0 bottom-0 h-24 z-[1] pointer-events-none"
                style={{ background: 'linear-gradient(to bottom, transparent, rgba(0,0,0,0.9))' }}
            />

            {/* Content — always centered */}
            <div className={`relative container mx-auto px-4 z-10 ${isHome ? 'pb-10 md:pb-12' : ''}`}>
                <div className="text-center">
                    {showTagline && (
                        <div
                            className="inline-flex items-center gap-2 px-4 py-1 rounded-full text-sm font-semibold mb-6 animate-slideUp shadow-lg"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
                        >
                            <FaPaw /> {tagline}
                        </div>
                    )}

                    {/* Full parent width so the title has the best chance of staying on one line */}
                    <div className="w-full">
                        <h1
                            className={`font-bold text-white leading-tight text-shadow-lg ${
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
                    </div>

                    <p className={`text-gray-200 max-w-2xl mx-auto animate-slideUp animation-delay-150 ${
                        size === 'small' ? 'text-base mt-3' :
                        size === 'medium' ? 'text-lg mt-4' :
                        size === 'large' ? 'text-xl mt-6' :
                        'text-2xl mt-6'
                    }`}>
                        {subtitle}
                    </p>

                    {/* Buttons + stats grouped together and pushed toward the bottom,
                        well clear of the heading/subtitle above */}
                    <div className={isHome ? 'mt-16 md:mt-20' : 'mt-8'}>
                        <div className="flex flex-wrap justify-center gap-3 animate-slideUp animation-delay-300">
                            <Link
                                href={ctaLink}
                                className="font-bold text-sm md:text-base px-6 py-3 rounded-full transition transform hover:scale-105 inline-flex items-center gap-2 shadow-xl"
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
                                className="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white font-bold text-sm md:text-base px-6 py-3 rounded-full transition border border-white/30"
                            >
                                Learn More
                            </Link>
                        </div>

                        {(size === 'large' || size === 'full') && (
                            <div
                                className="inline-grid grid-cols-3 gap-5 sm:gap-8 mt-6 px-6 py-3.5 rounded-2xl mx-auto animate-slideUp animation-delay-450"
                                style={{
                                    background: 'rgba(255, 255, 255, 0.08)',
                                    backdropFilter: 'blur(10px)',
                                    border: '1px solid rgba(255, 255, 255, 0.15)',
                                }}
                            >
                                <div>
                                    <p className="text-xl md:text-2xl font-bold" style={{ color: 'var(--brand-gold)' }}>15+</p>
                                    <p className="text-gray-300 text-xs">Years Experience</p>
                                </div>
                                <div className="border-x border-white/15 px-5 sm:px-8">
                                    <p className="text-xl md:text-2xl font-bold" style={{ color: 'var(--brand-gold)' }}>500+</p>
                                    <p className="text-gray-300 text-xs">Happy Travelers</p>
                                </div>
                                <div>
                                    <p className="text-xl md:text-2xl font-bold flex items-center justify-center gap-1" style={{ color: 'var(--brand-gold)' }}>4.9 <FaStar className="text-lg" /></p>
                                    <p className="text-gray-300 text-xs">Rating</p>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
}