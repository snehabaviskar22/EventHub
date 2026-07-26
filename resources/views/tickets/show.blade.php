@extends('layouts.app')

@section('title', 'Ticket')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between mb-4 flex-wrap gap-2">
                <a href="{{ route('bookings.index') }}" class="btn btn-outline-primary-brand btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Bookings</a>
                <a href="{{ route('tickets.pdf', $ticket) }}" class="btn btn-accent-brand btn-sm"><i class="bi bi-download me-1"></i>Download PDF</a>
            </div>

            <article class="ticket-card p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-calendar2-event-fill fs-3"></i>
                        <span class="fw-bold fs-4">EventHub</span>
                    </div>
                    <span class="badge {{ $ticket->payment_status === 'paid' ? 'bg-light text-dark' : ($ticket->payment_status === 'free' ? 'bg-success' : 'bg-warning text-dark') }}">
                        {{ ucfirst($ticket->payment_status) }}
                    </span>
                </div>

                <div class="row g-4 text-center text-md-start">
                    <div class="col-md-8">
                        <p class="mb-1" style="opacity:0.8;">Ticket ID</p>
                        <h4 class="fw-bold mb-3">{{ $ticket->ticket_id }}</h4>
                        <p class="mb-1" style="opacity:0.8;">Event</p>
                        <h5 class="fw-bold mb-3">{{ $ticket->event->title }}</h5>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <i class="bi bi-ticket-perforated-fill" style="font-size:5rem;opacity:0.3;"></i>
                    </div>
                </div>

                <div class="ticket-divider"></div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Student Name</p>
                        <p class="fw-semibold mb-0">{{ $ticket->user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Academic Program</p>
                        <p class="fw-semibold mb-0">{{ $ticket->academic_program }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Date</p>
                        <p class="fw-semibold mb-0">{{ $ticket->event->event_date->format('F d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Time</p>
                        <p class="fw-semibold mb-0">{{ $ticket->event->start_time->format('g:i A') }} - {{ $ticket->event->end_time->format('g:i A') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Venue</p>
                        <p class="fw-semibold mb-0">{{ $ticket->event->venue }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Booking Date</p>
                        <p class="fw-semibold mb-0">{{ $ticket->booking_date->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Ticket Quantity</p>
                        <p class="fw-semibold mb-0">{{ $ticket->ticket_quantity }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 small" style="opacity:0.8;">Payment Status</p>
                        <p class="fw-semibold mb-0 text-uppercase">{{ $ticket->payment_status }}</p>
                    </div>
                </div>

                <div class="ticket-divider"></div>

                <p class="text-center small mb-0" style="opacity:0.7;">
                    <i class="bi bi-info-circle me-1"></i>Please present this ticket at the event entrance. Enjoy the event!
                </p>
            </article>
        </div>
    </div>
</section>
@endsection
