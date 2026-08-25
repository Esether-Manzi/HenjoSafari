// ============================================
// SHARED FORM VALIDATION SCHEMAS
// ============================================
// Mirrors the validation rules in the backend's Form Requests
// (henjo-backend/app/Http/Requests/StoreInquiryRequest.php,
// StoreBookingRequest.php) so the frontend rejects bad input before
// it ever reaches the API. Keep the two in sync when either changes.
// ============================================

import { z } from 'zod';
import { NAME_REGEX, isValidPhone } from '@/lib/utils/validation';

// A travel date must be strictly after today (matches Laravel's `after:today`)
const isAfterToday = (value: string) => {
    if (!value) return false;
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const date = new Date(value);
    return date.getTime() > today.getTime();
};

const nameField = (label: string, max: number) =>
    z.string().trim().min(1, `Please enter your ${label}`).max(max, `${label} is too long`)
        .regex(NAME_REGEX, `${label} can only contain letters, spaces, hyphens, and apostrophes`);

export const contactFormSchema = z.object({
    name: nameField('name', 255),
    email: z.string().trim().min(1, 'Please enter your email').max(255).email('Please enter a valid email address'),
    phone: z.string().trim().max(50, 'Phone number is too long').optional().or(z.literal(''))
        .refine((value) => !value || isValidPhone(value), 'Please enter a valid phone number'),
    message: z.string().trim().min(1, 'Please enter a message').max(5000, 'Message is too long (max 5000 characters)'),
});

export type ContactFormValues = z.infer<typeof contactFormSchema>;

export const bookingFormSchema = z.object({
    first_name: nameField('first name', 100),
    last_name: nameField('last name', 100),
    email: z.string().trim().min(1, 'Please enter your email').max(255).email('Please enter a valid email address'),
    phone: z.string().trim().min(1, 'Please enter your phone number').max(50, 'Phone number is too long')
        .refine(isValidPhone, 'Please enter a valid phone number'),
    country: z.string().trim().min(1, 'Please select your country').max(100),

    package_id: z.number().int().nullable().optional(),
    package_name: z.string().trim().max(255).nullable().optional(),

    travel_date: z
        .string()
        .min(1, 'Please choose a travel date')
        .refine(isAfterToday, 'Travel date must be after today'),

    adults: z.number().int('Adults must be a whole number').min(1, 'At least 1 adult is required').max(50, 'Maximum 50 adults'),
    children: z.number().int('Children must be a whole number').min(0, 'Children cannot be negative').max(50, 'Maximum 50 children'),

    special_requests: z.string().trim().max(2000, 'Special requests are too long (max 2000 characters)').optional().or(z.literal('')),
});

export type BookingFormValues = z.infer<typeof bookingFormSchema>;

// Step-scoped slices of the booking schema, used to validate one step of the
// multi-step booking forms before allowing the user to advance.
export const bookingStep1Schema = bookingFormSchema.pick({
    first_name: true,
    last_name: true,
    email: true,
    phone: true,
    country: true,
});

export const bookingStep2Schema = bookingFormSchema.pick({
    travel_date: true,
    adults: true,
    children: true,
});
