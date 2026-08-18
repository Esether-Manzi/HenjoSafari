// ============================================
// BOOKING API
// ============================================
// Handles submitting booking requests to the backend.
// Follows the same pattern as contactApi.ts.
// ============================================

export interface BookingFormData {
    // Step 1 — Personal Information
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    country: string;

    // Step 2 — Trip Details
    package_id?: number | null;
    package_name?: string | null;
    travel_date: string;          // ISO date string: YYYY-MM-DD
    adults: number;
    children: number;
    special_requests?: string;
}

export interface BookingResponse {
    success: boolean;
    message: string;
    booking_number: string;
    data: {
        booking: {
            id: number;
            booking_number: string;
            status: string;
            travel_date: string;
            adults: number;
            children: number;
            total_people: number;
        };
        customer: {
            id: number;
            first_name: string;
            last_name: string;
            email: string;
        };
    };
}

export const submitBooking = async (data: BookingFormData): Promise<BookingResponse> => {
    const apiUrl = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/+$/, '');

    const response = await fetch(`${apiUrl}/bookings`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(data),
    });

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));

        // Surface Laravel validation errors as a readable message
        if (errorData.errors) {
            const firstError = Object.values(errorData.errors as Record<string, string[]>)[0];
            throw new Error(Array.isArray(firstError) ? firstError[0] : 'Validation failed. Please check your details.');
        }

        throw new Error(errorData.message || 'Failed to submit booking. Please try again.');
    }

    return response.json();
};
