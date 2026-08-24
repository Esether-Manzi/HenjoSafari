export interface InquiryFormData {
    name: string;
    email: string;
    phone?: string;
    subject: string;
    message: string;
}

export const submitInquiry = async (data: InquiryFormData) => {
    // Ensure this URL matches your backend server address
    // If running locally, it might be http://localhost:8000/api/inquiries
    // In production, it will be relative or your domain
    const apiUrl = process.env.NEXT_PUBLIC_API_URL || '/api';

    const response = await fetch(`${apiUrl}/inquiries`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(data),
    });

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));

        // Surface Laravel validation errors as a readable message, and attach
        // the raw per-field errors so forms can highlight the offending fields.
        if (errorData.errors) {
            const firstError = Object.values(errorData.errors as Record<string, string[]>)[0];
            const message = Array.isArray(firstError) ? firstError[0] : 'Validation failed. Please check your details.';
            throw Object.assign(new Error(message), { errors: errorData.errors as Record<string, string[]> });
        }

        throw new Error(errorData.message || 'Failed to submit inquiry');
    }

    return response.json();
};