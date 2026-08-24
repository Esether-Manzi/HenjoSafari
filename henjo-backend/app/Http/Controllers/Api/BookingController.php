<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Mail\NewBookingNotification;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Store a new booking request from the booking form.
     */
    public function store(StoreBookingRequest $request)
    {
        $validated = $request->validated();

        // ──────────────────────────────────────────────
        // 2-4. CREATE/UPDATE the Customer and the Booking record together —
        // wrapped in a transaction so a failure partway through can't leave
        // a Customer with no corresponding Booking.
        // ──────────────────────────────────────────────
        [$customer, $booking, $bookingNumber] = DB::transaction(function () use ($validated) {
            $customer = Customer::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone' => $validated['phone'],
                    'country' => $validated['country'],
                ]
            );

            // Update phone / country if customer already exists
            if (! $customer->wasRecentlyCreated) {
                $customer->update([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone' => $validated['phone'],
                    'country' => $validated['country'],
                ]);
            }

            // GENERATE a unique booking number  (HJS-YYYY-XXXX)
            do {
                $bookingNumber = 'HJS-'.date('Y').'-'.strtoupper(Str::random(6));
            } while (Booking::where('booking_number', $bookingNumber)->exists());

            // CREATE the Booking record
            //  - quoted_price = 0 (admin will quote later)
            //  - status = 'pending'
            //  - package_id = null allowed if no specific package selected
            $booking = Booking::create([
                'booking_number' => $bookingNumber,
                'customer_id' => $customer->id,
                'package_id' => $validated['package_id'] ?? null,
                'travel_date' => $validated['travel_date'],
                'adults' => $validated['adults'],
                'children' => $validated['children'] ?? 0,
                'total_people' => $validated['adults'] + ($validated['children'] ?? 0),
                'quoted_price' => 0,
                'currency' => 'USD',
                'special_requests' => $validated['special_requests'] ?? null,
                'status' => 'pending',
            ]);

            return [$customer, $booking, $bookingNumber];
        });

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
            Log::error('Failed to send booking notification email: '.$e->getMessage());
        }

        // ──────────────────────────────────────────────
        // 6. RETURN success response
        // ──────────────────────────────────────────────
        return response()->json([
            'success' => true,
            'message' => 'Your booking request has been received! We will contact you within 24 hours with a detailed quote.',
            'booking_number' => $bookingNumber,
            'data' => [
                'booking' => $booking,
                'customer' => $customer,
            ],
        ], 201);
    }
}
