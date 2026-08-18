<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Booking  $booking,
        public Customer $customer
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🦁 New Booking Request [' . $this->booking->booking_number . '] from ' . $this->customer->first_name . ' ' . $this->customer->last_name,
            replyTo: [$this->customer->email],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-booking',
            with: [
                'booking'  => $this->booking,
                'customer' => $this->customer,
            ],
        );
    }
}
