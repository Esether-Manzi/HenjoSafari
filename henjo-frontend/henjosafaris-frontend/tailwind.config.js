/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/**/*.{js,ts,jsx,tsx,mdx}',
    './components/**/*.{js,ts,jsx,tsx,mdx}',
    './lib/**/*.{js,ts,jsx,tsx,mdx}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        // ==========================================
        // HENJO BRAND COLORS
        // ==========================================
        'brand-gold': {
          DEFAULT: 'var(--brand-gold)',
          light: 'var(--brand-gold-light)',
          hover: 'var(--brand-gold-hover)',
          subtle: 'var(--brand-gold-subtle)',
        },
        'brand-green': {
          DEFAULT: 'var(--brand-green)',
          light: 'var(--brand-green-light)',
          hover: 'var(--brand-green-hover)',
          subtle: 'var(--brand-green-subtle)',
        },
        'brand-maroon': {
          DEFAULT: 'var(--brand-maroon)',
          light: 'var(--brand-maroon-light)',
        },
        'brand-charcoal': 'var(--brand-charcoal)',

        // Theme-aware surface colors
        surface: {
          primary: 'var(--bg-primary)',
          secondary: 'var(--bg-secondary)',
          tertiary: 'var(--bg-tertiary)',
          card: 'var(--bg-card)',
          'card-hover': 'var(--bg-card-hover)',
          nav: 'var(--bg-nav)',
          footer: 'var(--bg-footer)',
          input: 'var(--bg-input)',
        },

        // Theme-aware text colors
        content: {
          primary: 'var(--text-primary)',
          secondary: 'var(--text-secondary)',
          tertiary: 'var(--text-tertiary)',
          muted: 'var(--text-muted)',
          inverse: 'var(--text-inverse)',
        },

        // Theme-aware border colors
        edge: {
          primary: 'var(--border-primary)',
          secondary: 'var(--border-secondary)',
          subtle: 'var(--border-subtle)',
        },

        // ==========================================
        // LEGACY PALETTE (kept for gradual migration)
        // ==========================================
        yellow: {
          50: '#FFF8E1',
          100: '#FFECB3',
          200: '#FFE082',
          300: '#FFD54F',
          400: '#FFCA28',
          500: '#D4A017',  // Brand gold
          600: '#C08F10',
          700: '#A67C0A',
          800: '#8B6508',
          900: '#6B4E06',
        },
        green: {
          50: '#E8F5E9',
          100: '#C8E6C9',
          200: '#A5D6A7',
          300: '#81C784',
          400: '#66BB6A',
          500: '#4CAF50',
          600: '#388E3C',
          700: '#2E7D32',  // Brand green
          800: '#1B5E20',
          900: '#0D4715',
        },
        red: {
          50: '#FFEBEE',
          100: '#FFCDD2',
          200: '#EF9A9A',
          300: '#E57373',
          400: '#EF5350',
          500: '#C62828',
          600: '#D32F2F',
          700: '#7B1818',  // Brand maroon
          800: '#B71C1C',
          900: '#880E4F',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.5s ease-out',
        'pulse-slow': 'pulse 3s ease-in-out infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
};