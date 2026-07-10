// ============================================
// THEME PROVIDER
// ============================================
// This component wraps the entire app with theme support.
// It uses next-themes to manage dark/light/system modes.
// 
// How it works:
// 1. ThemeProvider stores the user's theme preference
// 2. It persists the preference in localStorage
// 3. All child components can access the theme
// 4. 'system' mode follows the OS/browser preference
// ============================================

'use client';

import { ThemeProvider as NextThemesProvider } from 'next-themes';

// Suppress the React 19 false positive warning in development
if (typeof window !== 'undefined' && process.env.NODE_ENV === 'development') {
    const orig = console.error;
    console.error = (...args: unknown[]) => {
        if (typeof args[0] === 'string' && args[0].includes('Encountered a script tag')) return;
        orig.apply(console, args);
    };
}

export function ThemeProvider({ children }: { children: React.ReactNode }) {
    return (
        <NextThemesProvider
            attribute="class"
            defaultTheme="system"
            enableSystem={true}
            disableTransitionOnChange={false}
            themes={['light', 'dark', 'system']}
        >
            {children}
        </NextThemesProvider>
    );
}