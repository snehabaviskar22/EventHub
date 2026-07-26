@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
        <div>
            <h1 class="fw-bold mb-1">My Bookings</h1>
            <p class="text-muted mb-0">View and download your event tickets</p>
        </div>
        <a href="{{ route('events.index') }}" class="btn btn-outline-primary-brand btn-sm"><i class="bi bi-plus-circle me-1"></i>Browse More Events</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-brand">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info alert-brand">{{ session('info') }}</div>
    @endif

    @if($tickets->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-brand table-hover align-middle">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Booking Date</th>
                        <th>Quantity</th>
                        <th>Payment Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="fw-semibold">{{ $ticket->event->title }}</td>
                            <td>{{ $ticket->booking_date->format('M d, Y') }}</td>
                            <td>{{ $ticket->ticket_quantity }}</td>
                            <td>
                                @if($ticket->payment_status === 'paid')
                                    <span class="badge badge-paid">Paid</span>
                                @elseif($ticket->payment_status === 'free')
                                    <span class="badge badge-free">Free</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-outline-primary-brand btn-sm me-1"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('tickets.pdf', $ticket) }}" class="btn btn-accent-brand btn-sm"><i class="bi bi-download me-1"></i>PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5 glass-card">
            <i class="bi bi-ticket-perforated fs-1 text-muted d-block mb-3"></i>
            <h4 class="fw-bold">No Bookings Yet</h4>
            <p class="text-muted mb-3">You haven't booked any events yet.</p>
            <a href="{{ route('events.index') }}" class="btn btn-primary-brand"><i class="bi bi-search me-1"></i>Browse Events</a>
        </div>
    @endif
</section>
@endsection
