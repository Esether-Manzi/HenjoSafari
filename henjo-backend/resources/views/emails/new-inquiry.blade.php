<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inquiry</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 30px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <!-- Header -->
        <tr>
            <td style="background-color: #1a1a2e; padding: 24px 30px; text-align: center;">
                <h1 style="color: #d4a853; margin: 0; font-size: 22px;">🦁 Henjo Safaris</h1>
                <p style="color: #cccccc; margin: 8px 0 0; font-size: 14px;">New Contact Form Inquiry</p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <p style="color: #333333; font-size: 15px; margin: 0 0 20px;">
                    A new inquiry has been submitted through the website contact form.
                </p>

                <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden;">
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 12px 16px; font-weight: bold; color: #555; width: 120px; border-bottom: 1px solid #e0e0e0;">Name</td>
                        <td style="padding: 12px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $inquiry->name }}</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 12px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Email</td>
                        <td style="padding: 12px 16px; border-bottom: 1px solid #e0e0e0;">
                            <a href="mailto:{{ $inquiry->email }}" style="color: #d4a853; text-decoration: none;">{{ $inquiry->email }}</a>
                        </td>
                    </tr>
                    @if($inquiry->phone)
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 12px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Phone</td>
                        <td style="padding: 12px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $inquiry->phone }}</td>
                    </tr>
                    @endif
                    @if($inquiry->subject)
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 12px 16px; font-weight: bold; color: #555; border-bottom: 1px solid #e0e0e0;">Subject</td>
                        <td style="padding: 12px 16px; color: #333; border-bottom: 1px solid #e0e0e0;">{{ $inquiry->subject }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 12px 16px; font-weight: bold; color: #555; vertical-align: top;">Message</td>
                        <td style="padding: 12px 16px; color: #333; line-height: 1.6;">{!! nl2br(e($inquiry->message)) !!}</td>
                    </tr>
                </table>

                <p style="color: #888888; font-size: 13px; margin: 20px 0 0; text-align: center;">
                    Submitted on {{ $inquiry->created_at->format('M d, Y \a\t h:i A') }}
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f9f9f9; padding: 16px 30px; text-align: center; border-top: 1px solid #e0e0e0;">
                <p style="color: #999999; font-size: 12px; margin: 0;">
                    This is an automated notification from your Henjo Safaris website.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
