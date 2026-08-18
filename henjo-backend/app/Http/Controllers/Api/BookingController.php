<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Mail\NewBookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Store a new booking request from the booking form.
     */
    public function store(Request $request)
    {
        // ──────────────────────────────────────────────
        // 1. VALIDATE incoming data
        // ──────────────────────────────────────────────
        $validated = $request->validate([
            // Personal information
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:50',
            'country'          => 'required|string|max:100',

            // Trip details
            'package_id'       => 'nullable|integer|exists:safari_packages,id',
            'package_name'     => 'nullable|string|max:255',
            'travel_date'      => 'required|date|after:today',
            'adults'           => 'required|integer|min:1|max:50',
            'children'         => 'nullable|integer|min:0|max:50',
            'special_requests' => 'nullable|string|max:2000',
        ]);

        // ──────────────────────────────────────────────
        // 2. CREATE OR FIND the Customer record
        // ──────────────────────────────────────────────
        $customer = Customer::firstOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'phone'      => $validated['phone'],
                'country'    => $validated['country'],
            ]
        );

        // Update phone / country if customer already exists
        if (!$customer->wasRecentlyCreated) {
            $customer->update([
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'phone'      => $validated['phone'],
                'country'    => $validated['country'],
            ]);
        }

        // ──────────────────────────────────────────────
        // 3. GENERATE a unique booking number  (HJS-YYYY-XXXX)
        // ──────────────────────────────────────────────
        do {
            $bookingNumber = 'HJS-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (Booking::where('booking_number', $bookingNumber)->exists());

        // ──────────────────────────────────────────────
        // 4. CREATE the Booking record
        //    - quoted_price = 0 (admin will quote later)
        //    - status = 'pending'
        //    - package_id = null allowed if no specific package selected
        // ──────────────────────────────────────────────
        $booking = Booking::create([
            'booking_number'   => $bookingNumber,
            'customer_id'      => $customer->id,
            'package_id'       => $validated['package_id'] ?? null,
            'travel_date'      => $validated['travel_date'],
            'adults'           => $validated['adults'],
            'children'         => $validated['children'] ?? 0,
            'total_people'     => $validated['adults'] + ($validated['children'] ?? 0),
            'quoted_price'     => 0,
            'currency'         => 'USD',
            'special_requests' => $validated['special_requests'] ?? null,
            'status'           => 'pending',
        ]);

        // Attach package name to booking for the email (not in DB, just context)
        $booking->package_name_label = $validated['package_name'] ?? null;

        // ──────────────────────────────────────────────
        // 5. SEND notification email to admin
        // ──────────────────────────────────────────────
        try {
            Mail::to('info@henjosafaris.com')
                ->send(new NewBookingNotification($booking, $customer));
        } catch (\Exception $e) {
            // Log the error but don't fail the request — the booking is already saved
            Log::error('Failed to send booking notification email: ' . $e->getMessage());
        }

        // ──────────────────────────────────────────────
        // 6. RETURN success response
        // ──────────────────────────────────────────────
        return response()->json([
            'success'        => true,
            'message'        => 'Your booking request has been received! We will contact you within 24 hours with a detailed quote.',
            'booking_number' => $bookingNumber,
            'data'           => [
                'booking'  => $booking,
                'customer' => $customer,
            ],
        ], 201);
    }
}
