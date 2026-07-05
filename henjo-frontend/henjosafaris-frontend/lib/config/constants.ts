// ============================================
// APP CONSTANTS
// ============================================

export const SITE_CONFIG = {
    name: 'Henjo Safaris',
    description: 'Experience the best safaris in Tanzania',
    url: process.env.NEXT_PUBLIC_APP_URL || 'http://localhost:3000',
    email: 'info@henjosafaris.com',
    phone: '+255 123 456 789',
    address: 'Arusha, Tanzania',
    social: {
        facebook: 'https://facebook.com/henjosafaris',
        twitter: 'https://twitter.com/henjosafaris',
        instagram: 'https://instagram.com/henjosafaris',
        youtube: 'https://youtube.com/henjosafaris',
    },
};

export const CURRENCIES = {
    USD: { code: 'USD', symbol: '$', name: 'US Dollar', rate: 1 },
    EUR: { code: 'EUR', symbol: '€', name: 'Euro', rate: 0.85 },
    GBP: { code: 'GBP', symbol: '£', name: 'British Pound', rate: 0.73 },
    UGX: { code: 'UGX', symbol: 'UGX', name: 'Ugandan Shilling', rate: 3700 },
    KES: { code: 'KES', symbol: 'KES', name: 'Kenyan Shilling', rate: 140 },
    TZS: { code: 'TZS', symbol: 'TSh', name: 'Tanzanian Shilling', rate: 2500 },
} as const;

export const PAGINATION = {
    defaultPerPage: 12,
    perPageOptions: [12, 24, 48, 96],
};

export const DURATION_OPTIONS = [
    { label: '3-5 Days', value: '3-5' },
    { label: '6-8 Days', value: '6-8' },
    { label: '9-12 Days', value: '9-12' },
    { label: '13+ Days', value: '13+' },
];

export const PRICE_RANGES = [
    { label: '$0 - $1000', min: 0, max: 1000 },
    { label: '$1000 - $2500', min: 1000, max: 2500 },
    { label: '$2500 - $5000', min: 2500, max: 5000 },
    { label: '$5000+', min: 5000, max: Infinity },
];

export const BOOKING_STEPS = [
    { number: 1, label: 'Personal Info', icon: 'user' },
    { number: 2, label: 'Travel Details', icon: 'calendar' },
    { number: 3, label: 'Review & Pay', icon: 'credit-card' },
];

export const STATUS_COLORS = {
    draft: 'bg-gray-200 text-gray-700',
    published: 'bg-green-200 text-green-700',
    archived: 'bg-red-200 text-red-700',
} as const;

export const ACCOMMODATION_TYPES = {
    hotel: { label: 'Hotel', icon: '🏨' },
    lodge: { label: 'Lodge', icon: '🏕️' },
    camp: { label: 'Camp', icon: '⛺' },
    resort: { label: 'Resort', icon: '🌴' },
} as const;