// ============================================
// THEME TOGGLE BUTTON
// ============================================
// This component allows users to switch between
// light and dark themes.
// 
// Features:
// - Shows sun icon in dark mode (click to switch to light)
// - Shows moon icon in light mode (click to switch to dark)
// - Smooth transition with animation
// - Accessible with aria-label
// ============================================

'use client';

import { useTheme } from 'next-themes';
import { useEffect, useState } from 'react';
import { FaSun, FaMoon } from 'react-icons/fa';

export default function ThemeToggle() {
    const [mounted, setMounted] = useState(false);
    const { theme, setTheme, systemTheme } = useTheme();

    useEffect(() => {
        setMounted(true);
    }, []);

    if (!mounted) {
        return (
            <button className="p-2 rounded-full bg-gray-200 dark:bg-gray-700 w-10 h-10 animate-pulse" />
        );
    }

    const currentTheme = theme === 'system' ? systemTheme : theme;
    const isDark = currentTheme === 'dark';

    const toggleTheme = () => {
        setTheme(isDark ? 'light' : 'dark');
    };

    return (
        <button
            onClick={toggleTheme}
            className={`
                relative p-2 rounded-full transition-all duration-300
                ${isDark 
                    ? 'bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500/30 hover:text-yellow-300' 
                    : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                }
                focus:outline-none focus:ring-2 focus:ring-yellow-500
                group
            `}
            aria-label={isDark ? 'Switch to light mode' : 'Switch to dark mode'}
        >
            {/* Sun/Moon Icon with transition */}
            <div className="relative w-5 h-5 flex items-center justify-center">
                {/* Sun icon (visible in dark mode) */}
                <span className={`
                    absolute transition-all duration-300
                    ${isDark ? 'opacity-100 rotate-0 scale-100' : 'opacity-0 rotate-90 scale-50'}
                `}>
                    ☀️
                </span>
                {/* Moon icon (visible in light mode) */}
                <span className={`
                    absolute transition-all duration-300
                    ${!isDark ? 'opacity-100 rotate-0 scale-100' : 'opacity-0 -rotate-90 scale-50'}
                `}>
                    🌙
                </span>
            </div>

            {/* Tooltip on hover */}
            <span className="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-[10px] font-medium opacity-0 group-hover:opacity-100 transition whitespace-nowrap bg-gray-800 dark:bg-gray-700 text-white px-2 py-1 rounded">
                {isDark ? 'Switch to Light' : 'Switch to Dark'}
            </span>
        </button>
    );
}