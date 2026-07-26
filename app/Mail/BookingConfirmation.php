<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Ticket $ticket) {}

    public function build(): static
    {
        $event = $this->ticket->event;

        return $this->subject('EventHub Booking Confirmation - ' . $event->title)
            ->view('emails.booking-confirmation')
            ->with([
                'ticket' => $this->ticket,
                'event' => $event,
                'user' => $this->ticket->user,
            ]);
    }
}
