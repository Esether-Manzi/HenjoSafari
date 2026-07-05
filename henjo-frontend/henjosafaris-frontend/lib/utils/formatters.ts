// ============================================
// FORMATTER UTILITIES
// ============================================

/**
 * Format price with currency symbol
 */
export const formatPrice = (price: number, currency: string = 'USD'): string => {
    const symbols: Record<string, string> = {
        USD: '$',
        EUR: '€',
        GBP: '£',
        UGX: 'UGX',
        KES: 'KES',
        TZS: 'TSh',
    };

    const symbol = symbols[currency] || currency;
    
    if (currency === 'UGX' || currency === 'KES' || currency === 'TZS') {
        return `${symbol} ${price.toLocaleString()}`;
    }
    
    return `${symbol}${price.toLocaleString()}`;
};

/**
 * Format date
 */
export const formatDate = (date: string | Date, format: 'short' | 'long' = 'short'): string => {
    const d = new Date(date);
    
    if (format === 'short') {
        return d.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
        });
    }
    
    return d.toLocaleDateString('en-US', {
        weekday: 'long',
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    });
};

/**
 * Truncate text
 */
export const truncateText = (text: string, maxLength: number = 150): string => {
    if (text.length <= maxLength) return text;
    return text.slice(0, maxLength) + '...';
};

/**
 * Generate slug from string
 */
export const generateSlug = (text: string): string => {
    return text
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
};

/**
 * Get initial letters for avatar
 */
export const getInitials = (name: string): string => {
    return name
        .split(' ')
        .map((n) => n[0])
        .join('')
        .toUpperCase()
        .slice(0, 2);
};

/**
 * Convert currency
 */
export const convertCurrency = (
    amount: number,
    fromCurrency: string,
    toCurrency: string,
    rates: Record<string, number>
): number => {
    if (fromCurrency === toCurrency) return amount;
    const fromRate = rates[fromCurrency] || 1;
    const toRate = rates[toCurrency] || 1;
    return (amount / fromRate) * toRate;
};

/**
 * Pluralize word
 */
export const pluralize = (count: number, singular: string, plural?: string): string => {
    if (count === 1) return `1 ${singular}`;
    return `${count} ${plural || singular + 's'}`;
};