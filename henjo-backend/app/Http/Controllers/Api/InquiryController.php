<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Mail\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InquiryController extends Controller
{
    /**
     * Store a new inquiry from the contact form.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:50',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string|max:5000',
            'package_id' => 'nullable|integer|exists:safari_packages,id',
        ]);

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
            Log::error('Failed to send inquiry notification email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Your inquiry has been submitted successfully. We will get back to you within 24 hours.',
            'data'    => $inquiry,
        ], 201);
    }
}
