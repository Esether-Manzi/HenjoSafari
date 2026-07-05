// ============================================
// THEME PROVIDER
// ============================================
// This component wraps the entire app with theme support.
// It uses next-themes to manage dark/light mode.
// 
// How it works:
// 1. ThemeProvider stores the user's theme preference
// 2. It persists the preference in localStorage
// 3. All child components can access the theme
// ============================================

'use client';

import { ThemeProvider as NextThemesProvider } from 'next-themes';

export function ThemeProvider({ children }: { children: React.ReactNode }) {
    return (
        <NextThemesProvider
            attribute="class"
            defaultTheme="light"
            enableSystem={true}
            disableTransitionOnChange={false}
            themes={['light', 'dark']}
        >
            {children}
        </NextThemesProvider>
    );
}