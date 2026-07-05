// ============================================
// BASE LAYOUT COMPONENT
// ============================================
// This is the main layout wrapper that provides:
// 1. Theme support (light/dark mode)
// 2. Navigation bar
// 3. Footer
// 4. Page container with proper spacing
// 5. Consistent padding and max-width
// 
// All pages should be wrapped in this component
// to maintain consistent layout and theming.
// ============================================

'use client';

import { ReactNode } from 'react';
import Navbar from './Navbar';
import Footer from './Footer';
import { useTheme } from 'next-themes';
import { useEffect, useState } from 'react';

interface BaseProps {
    children: ReactNode;
    /**
     * Optional: Hide footer on specific pages (e.g., landing pages)
     * @default false
     */
    hideFooter?: boolean;
    /**
     * Optional: Hide navbar on specific pages (e.g., auth pages)
     * @default false
     */
    hideNavbar?: boolean;
    /**
     * Optional: Add extra padding top for pages without hero
     * @default false
     */
    extraPadding?: boolean;
}

export default function Base({ 
    children, 
    hideFooter = false, 
    hideNavbar = false,
    extraPadding = false 
}: BaseProps) {
    // ============================================
    // STATE: Prevent hydration mismatch
    // ============================================
    const [mounted, setMounted] = useState(false);
    const { theme, systemTheme } = useTheme();

    // ✅ Only render after mounting to avoid hydration issues
    useEffect(() => {
        setMounted(true);
    }, []);

    // Determine current theme for body class
    const currentTheme = theme === 'system' ? systemTheme : theme;
    const isDark = currentTheme === 'dark';

    if (!mounted) {
        // Return a placeholder with the same structure to prevent layout shift
        return (
            <div className="min-h-screen bg-white dark:bg-gray-900">
                <div className="h-20" /> {/* Navbar placeholder */}
                <main className="container mx-auto px-4 py-8">
                    {children}
                </main>
            </div>
        );
    }

    return (
        <div className={`min-h-screen flex flex-col theme-transition
            ${isDark ? 'dark bg-gray-900 text-gray-100' : 'bg-white text-gray-900'}`}
        >
            {/* ============================================
            NAVBAR
            ============================================ */}
            {!hideNavbar && <Navbar />}
            
            {/* ============================================
            MAIN CONTENT
            ============================================ */}
            <main className={`
                flex-grow 
                ${!hideNavbar ? 'pt-20' : ''} 
                ${extraPadding ? 'py-8' : ''}
            `}>
                {children}
            </main>

            {/* ============================================
            FOOTER
            ============================================ */}
            {!hideFooter && <Footer />}
        </div>
    );
}