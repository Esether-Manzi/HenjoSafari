// ============================================
// THEME TOGGLE — 3-WAY (Light / Dark / System)
// ============================================
// Cycles through: Light → Dark → System on each click.
// Shows the active mode icon with a tooltip.
//
// Icons: Light = Sun, Dark = Moon, System = Monitor
//
// Uses brand gold as the active indicator color.
// ============================================

'use client';

import { useTheme } from 'next-themes';
import { useEffect, useState } from 'react';

const THEME_CYCLE = ['light', 'dark', 'system'] as const;
type ThemeMode = (typeof THEME_CYCLE)[number];

const THEME_META: Record<ThemeMode, { icon: React.ReactNode; label: string; tooltip: string }> = {
    light: {
        icon: (
            <svg viewBox="0 0 20 20" fill="currentColor" className="w-[18px] h-[18px]">
                <path
                    fillRule="evenodd"
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.222 4.222a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM15.071 4.929a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 7a3 3 0 100 6 3 3 0 000-6zm-7 3a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1zm13 0a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zM5.636 14.364a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zm9.435-.707a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 15a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z"
                    clipRule="evenodd"
                />
            </svg>
        ),
        label: 'Light',
        tooltip: 'Light Mode',
    },
    dark: {
        icon: (
            <svg viewBox="0 0 20 20" fill="currentColor" className="w-[18px] h-[18px]">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
            </svg>
        ),
        label: 'Dark',
        tooltip: 'Dark Mode',
    },
    system: {
        icon: (
            <svg viewBox="0 0 20 20" fill="currentColor" className="w-[18px] h-[18px]">
                <path
                    fillRule="evenodd"
                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm2 0h10v6H5V5z"
                    clipRule="evenodd"
                />
                <path d="M8 15h4v1a1 1 0 01-1 1H9a1 1 0 01-1-1v-1zM7 14a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" />
            </svg>
        ),
        label: 'System',
        tooltip: 'System Theme',
    },
};

export default function ThemeToggle() {
    const [mounted, setMounted] = useState(false);
    const { theme, setTheme } = useTheme();

    useEffect(() => {
        setMounted(true);
    }, []);

    if (!mounted) {
        return (
            <div
                className="w-10 h-10 rounded-full animate-pulse"
                style={{ background: 'var(--bg-tertiary)' }}
            />
        );
    }

    const currentMode = (theme as ThemeMode) || 'system';
    const meta = THEME_META[currentMode] || THEME_META.system;

    const cycleTheme = () => {
        const currentIndex = THEME_CYCLE.indexOf(currentMode);
        const nextIndex = (currentIndex + 1) % THEME_CYCLE.length;
        setTheme(THEME_CYCLE[nextIndex]);
    };

    return (
        <button
            onClick={cycleTheme}
            className="relative group flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300 focus:outline-none"
            style={{
                background: 'var(--bg-tertiary)',
                color: 'var(--brand-gold)',
            }}
            onMouseEnter={(e) => {
                e.currentTarget.style.background = 'var(--brand-gold-subtle)';
            }}
            onMouseLeave={(e) => {
                e.currentTarget.style.background = 'var(--bg-tertiary)';
            }}
            aria-label={`Current theme: ${meta.label}. Click to switch.`}
            title={meta.tooltip}
        >
            {/* Icon with rotation animation */}
            <span
                key={currentMode}
                className="flex items-center justify-center animate-fadeIn"
            >
                {meta.icon}
            </span>

            {/* Tooltip on hover */}
            <span
                className="absolute -bottom-9 left-1/2 transform -translate-x-1/2 text-[10px] font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap px-2.5 py-1 rounded-md pointer-events-none z-50"
                style={{
                    background: 'var(--bg-card)',
                    color: 'var(--text-primary)',
                    border: '1px solid var(--border-primary)',
                    boxShadow: 'var(--shadow-sm)',
                }}
            >
                {meta.tooltip}
            </span>
        </button>
    );
}