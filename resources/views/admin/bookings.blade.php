@extends('layouts.app')

@section('title', 'Admin Bookings')

@section('content')
<section class="container-fluid py-4 px-md-4">
    @if(session('success'))
        <div class="alert alert-success alert-brand">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <h1 class="fw-bold mb-1">Student Bookings</h1>
        <p class="text-muted mb-0">View all ticket bookings across events</p>
    </div>

    <div class="card-custom p-4">
        @if($bookings->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-brand table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Ticket ID</th><th>Student</th><th>Event</th><th>Date</th><th>Qty</th><th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="fw-semibold text-primary-brand">{{ $booking->ticket_id }}</td>
                                <td>{{ $booking->user->name }}<br><span class="text-muted small">{{ $booking->user->email }}</span></td>
                                <td>{{ $booking->event->title }}<br><span class="text-muted small">{{ $booking->event->event_date->format('M d, Y') }}</span></td>
                                <td class="small">{{ $booking->booking_date->format('M d, Y') }}</td>
                                <td>{{ $booking->ticket_quantity }}</td>
                                <td>
                                    @if($booking->payment_status === 'paid')
                                        <span class="badge badge-paid">Paid</span>
                                    @elseif($booking->payment_status === 'free')
                                        <span class="badge badge-free">Free</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-ticket-perforated fs-1 text-muted d-block mb-3"></i>
                <p class="text-muted mb-0">No bookings yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
