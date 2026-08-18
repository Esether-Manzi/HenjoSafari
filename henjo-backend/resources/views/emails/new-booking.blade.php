<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Request</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 620px; margin: 30px auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.12);">

        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #1a1a2e 0%, #2d1f0e 100%); padding: 28px 30px; text-align: center;">
                <h1 style="color: #D4A017; margin: 0; font-size: 24px; letter-spacing: 1px;">🦁 Henjo African Safaris</h1>
                <p style="color: #cccccc; margin: 8px 0 0; font-size: 14px;">New Booking Request Received</p>
            </td>
        </tr>

        <!-- Booking Number Banner -->
        <tr>
            <td style="background-color: #D4A017; padding: 14px 30px; text-align: center;">
                <p style="margin: 0; color: #1a1a1a; font-weight: bold; font-size: 16px;">
                    📋 Booking Reference: <span style="font-size: 18px; letter-spacing: 2px;">{{ $booking->booking_number }}</span>
                </p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <p style="color: #333333; font-size: 15px; margin: 0 0 24px;">
                    A new booking request has been submitted through the website. Please review the details below and contact the customer within 24 hours with a quote.
                </p>

                <!-- Section: Customer Information -->
                <h2 style="color: #7B1818; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px; padding-bottom: 6px; border-bottom: 2px solid #D4A017;">
                    👤 Customer Information
                </h2>
                <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden; margin-bottom: 24px;">
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; width: 130px; border-bottom: 1px solid #e0e0e0;">Full Name</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Email</td>
                        <td style="padding: 11px 16px; border-bottom: 1px solid #e0e0e0;">
                            <a href="mailto:{{ $customer->email }}" style="color: #D4A017; text-decoration: none;">{{ $customer->email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Phone</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555;">Country</td>
                        <td style="padding: 11px 16px; color: #333;">{{ $customer->country }}</td>
                    </tr>
                </table>

                <!-- Section: Trip Details -->
                <h2 style="color: #7B1818; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px; padding-bottom: 6px; border-bottom: 2px solid #D4A017;">
                    🌍 Trip Details
                </h2>
                <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden; margin-bottom: 24px;">
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; width: 130px; border-bottom: 1px solid #e0e0e0;">Safari Package</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">
                            @if($booking->package_name_label)
                                {{ $booking->package_name_label }}
                            @elseif($booking->safariPackage)
                                {{ $booking->safariPackage->title }}
                            @else
                                <em style="color: #999;">To be discussed</em>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Travel Date</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">
                            {{ \Carbon\Carbon::parse($booking->travel_date)->format('F j, Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Adults</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $booking->adults }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Children</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $booking->children }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Total Travellers</td>
                        <td style="padding: 11px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $booking->total_people }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 11px 16px; font-weight: bold; color: #555; vertical-align: top;">Special Requests</td>
                        <td style="padding: 11px 16px; color: #333; line-height: 1.6;">
                            @if($booking->special_requests)
                                {!! nl2br(e($booking->special_requests)) !!}
                            @else
                                <em style="color: #999;">None</em>
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- Action Button -->
                <div style="text-align: center; margin: 24px 0;">
                    <a href="{{ config('app.url') }}/admin/bookings/{{ $booking->id }}"
                       style="background-color: #D4A017; color: #1a1a1a; padding: 14px 32px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 15px; display: inline-block;">
                        View Booking in Admin Panel
                    </a>
                </div>

                <p style="color: #888888; font-size: 13px; margin: 20px 0 0; text-align: center;">
                    Submitted on {{ $booking->created_at->format('F j, Y \a\t g:i A') }} (EAT)
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f9f9f9; padding: 16px 30px; text-align: center; border-top: 1px solid #e0e0e0;">
                <p style="color: #999999; font-size: 12px; margin: 0;">
                    This is an automated notification from the Henjo African Safaris booking system.<br>
                    Status: <strong>Pending</strong> — Please respond within 24 hours.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
