<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #FFF8F2; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(124, 58, 237, 0.1);">
        <div style="background: linear-gradient(135deg, #7C3AED, #F472B6); padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">>> EventHub</h1>
            <p style="color: rgba(255,255,255,0.9); margin: 5px 0 0;">Booking Confirmation</p>
        </div>

        <div style="padding: 30px;">
            <h2 style="color: #2D1B3D; margin-top: 0;">Hi {{ $user->name }},</h2>
            <p style="color: #555; line-height: 1.6;">Your booking has been confirmed! Here are the details of your event:</p>

            <div style="background: #FFF8F2; border-radius: 12px; padding: 20px; margin: 20px 0;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #888; font-size: 14px;">Event Name:</td>
                        <td style="padding: 8px 0; color: #2D1B3D; font-weight: bold; font-size: 14px;">{{ $event->title }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #888; font-size: 14px;">Date:</td>
                        <td style="padding: 8px 0; color: #2D1B3D; font-weight: bold; font-size: 14px;">{{ $event->event_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #888; font-size: 14px;">Venue:</td>
                        <td style="padding: 8px 0; color: #2D1B3D; font-weight: bold; font-size: 14px;">{{ $event->venue }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #888; font-size: 14px;">Booking Status:</td>
                        <td style="padding: 8px 0;">
                            <span style="background: #16a34a; color: #fff; padding: 3px 10px; border-radius: 12px; font-size: 12px; text-transform: uppercase;">{{ $ticket->payment_status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #888; font-size: 14px;">Ticket ID:</td>
                        <td style="padding: 8px 0; color: #7C3AED; font-weight: bold; font-size: 14px;">{{ $ticket->ticket_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #888; font-size: 14px;">Quantity:</td>
                        <td style="padding: 8px 0; color: #2D1B3D; font-weight: bold; font-size: 14px;">{{ $ticket->ticket_quantity }}</td>
                    </tr>
                </table>
            </div>

            <p style="color: #555; line-height: 1.6;">You can view and download your ticket from your dashboard. Please present the ticket at the event entrance.</p>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ config('app.url') }}/my-bookings" style="background: #7C3AED; color: #fff; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">View My Bookings</a>
            </div>

            <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
            <p style="color: #999; font-size: 12px; text-align: center;">This is an automated email from EventHub. Please do not reply.<br>&copy; {{ date('Y') }} EventHub - College Event Management Platform</p>
        </div>
    </div>
</body>
</html>
