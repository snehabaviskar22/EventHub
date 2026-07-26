<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Event;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TicketController extends Controller
{
    /** Show the booking form for an event. */
    public function create(Event $event): View|RedirectResponse
    {
        $user = auth()->user();

        if ($event->tickets()->where('user_id', $user->id)->exists()) {
            return redirect()->route('bookings.index')->with('info', 'You have already booked this event.');
        }

        if (!$event->isBookingOpen()) {
            return redirect()->route('events.show', $event)->with('error', 'The booking deadline for this event has passed.');
        }

        if (!$event->hasSeatsAvailable()) {
            return redirect()->route('events.show', $event)->with('error', 'Sorry, this event is fully booked.');
        }

        if (!$event->isProgramEligible($user->academic_program)) {
            return redirect()->route('events.show', $event)->with('error', 'Your academic program is not eligible for this event.');
        }

        return view('tickets.create', compact('event'));
    }

    /** Validate the booking form and redirect to payment (if paid) or confirm (if free). */
    public function store(Request $request, Event $event): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'academic_program' => ['required', 'string', 'max:255'],
            'ticket_quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = $validated['ticket_quantity'];

        if (!$event->isBookingOpen()) {
            return redirect()->route('events.show', $event)->with('error', 'The booking deadline has passed.');
        }

        if (!$event->hasSeatsAvailable($quantity)) {
            return redirect()->route('events.show', $event)->with('error', 'Not enough seats available.');
        }

        if (!$event->isProgramEligible($validated['academic_program'])) {
            return redirect()->route('events.show', $event)->with('error', 'Your academic program is not eligible.');
        }

        if ($this->hasTimeConflict($user, $event)) {
            return redirect()->route('events.show', $event)->with('error', 'You have already booked another event that overlaps in time.');
        }

        if ($event->price > 0) {
            session([
                'booking' => [
                    'event_id' => $event->id,
                    'phone' => $validated['phone'],
                    'academic_program' => $validated['academic_program'],
                    'ticket_quantity' => $quantity,
                ],
            ]);

            return redirect()->route('payment.show', $event);
        }

        $ticket = $this->createTicket($event, $validated, 'free');
        $this->finalizeBooking($ticket);

        return redirect()->route('bookings.index')->with('success', 'Booking confirmed! Your ticket has been generated.');
    }

    /** Show the demo payment page for a paid event. */
    public function showPayment(Event $event): View|RedirectResponse
    {
        $booking = session('booking');

        if (!$booking || $booking['event_id'] !== $event->id) {
            return redirect()->route('events.show', $event)->with('error', 'Please complete the booking form first.');
        }

        $totalAmount = $event->price * $booking['ticket_quantity'];

        return view('tickets.payment', compact('event', 'booking', 'totalAmount'));
    }

    /** Process the demo payment and generate the ticket. */
    public function processPayment(Request $request, Event $event): RedirectResponse
    {
        $booking = session('booking');

        if (!$booking || $booking['event_id'] !== $event->id) {
            return redirect()->route('events.show', $event)->with('error', 'Booking session expired. Please try again.');
        }

        $request->validate([
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'min:12', 'max:19'],
            'expiry' => ['required', 'string'],
            'cvv' => ['required', 'string', 'min:3', 'max:4'],
        ]);

        $ticket = $this->createTicket($event, $booking, 'paid');
        $this->finalizeBooking($ticket);
        session()->forget('booking');

        return redirect()->route('bookings.index')->with('success', 'Payment successful! Your ticket has been generated.');
    }

    /** List the logged-in student's bookings. */
    public function myBookings(): View
    {
        $tickets = Ticket::with('event')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /** Show a single ticket. */
    public function show(Ticket $ticket): View
    {
        $this->authorizeTicket($ticket);
        $ticket->load('event', 'user');

        return view('tickets.show', compact('ticket'));
    }

    /** Download the ticket as a PDF. */
    public function downloadPdf(Ticket $ticket): mixed
    {
        $this->authorizeTicket($ticket);
        $ticket->load('event', 'user');

        $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));

        return $pdf->download('EventHub-Ticket-' . $ticket->ticket_id . '.pdf');
    }

    /** Check if the student has a time conflict with already-booked events. */
    private function hasTimeConflict($user, Event $event): bool
    {
        $bookedTickets = Ticket::with('event')
            ->where('user_id', $user->id)
            ->whereHas('event', fn ($q) => $q->where('event_date', $event->event_date))
            ->get();

        foreach ($bookedTickets as $ticket) {
            if ($event->overlapsWith($ticket->event)) {
                return true;
            }
        }

        return false;
    }

    /** Create a ticket record and reduce available seats. */
    private function createTicket(Event $event, array $data, string $paymentStatus): Ticket
    {
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'ticket_id' => 'EVT-' . strtoupper(Str::random(8)),
            'ticket_quantity' => $data['ticket_quantity'],
            'phone' => $data['phone'],
            'academic_program' => $data['academic_program'],
            'payment_status' => $paymentStatus,
        ]);

        $event->decrement('available_seats', $data['ticket_quantity']);

        return $ticket;
    }

    /** Send the confirmation email after booking. */
    private function finalizeBooking(Ticket $ticket): void
    {
        $ticket->load('event', 'user');

        try {
            Mail::to($ticket->user->email)->send(new BookingConfirmation($ticket));
        } catch (\Throwable $e) {
            // Email failures should not break the booking flow.
            logger()->error('Failed to send booking email: ' . $e->getMessage());
        }
    }

    /** Ensure the student owns the ticket (or is admin). */
    private function authorizeTicket(Ticket $ticket): void
    {
        if (auth()->user()->isAdmin()) {
            return;
        }

        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'You do not have access to this ticket.');
        }
    }
}
