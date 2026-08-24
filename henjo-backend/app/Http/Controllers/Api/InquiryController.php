<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInquiryRequest;
use App\Mail\NewInquiryNotification;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    /**
     * Store a new inquiry from the contact form.
     */
    public function store(StoreInquiryRequest $request)
    {
        $validated = $request->validated();

        // Default status for new inquiries
        $validated['status'] = 'new';

        // Store in database
        $inquiry = Inquiry::create($validated);

        // Send notification email to admin
        try {
            Mail::to('info@henjosafaris.com')
                ->send(new NewInquiryNotification($inquiry));
        } catch (\Exception $e) {
            // Log the error but don't fail the request — the inquiry is already saved
            Log::error('Failed to send inquiry notification email: '.$e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been submitted successfully. We will get back to you within 24 hours.',
            'data' => $inquiry,
        ], 201);
    }
}
