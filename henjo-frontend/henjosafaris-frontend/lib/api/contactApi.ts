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
        throw new Error(errorData.message || 'Failed to submit inquiry');
    }

    return response.json();
};