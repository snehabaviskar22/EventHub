@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="container-fluid py-4 px-md-4">
    @if(session('success'))
        <div class="alert alert-success alert-brand">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <h1 class="fw-bold mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="dashboard-card card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-circle" style="background:var(--primary-light);color:var(--primary);">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">{{ $totalEvents }}</h2>
                        <p class="text-muted small mb-0">Total Events</p>
                    </div>
                </div>
                <a href="{{ route('admin.events.index') }}" class="text-primary-brand small fw-semibold mt-3 d-block">Manage Events <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="dashboard-card card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-circle" style="background:var(--secondary-light);color:var(--secondary);">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">{{ $totalBookings }}</h2>
                        <p class="text-muted small mb-0">Total Bookings</p>
                    </div>
                </div>
                <a href="{{ route('admin.bookings') }}" class="text-primary-brand small fw-semibold mt-3 d-block">Manage Bookings <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="dashboard-card card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-circle" style="background:#fef3c7;color:var(--accent);">
                        <i class="bi bi-calendar-week"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0">{{ $upcomingEvents->count() }}</h2>
                        <p class="text-muted small mb-0">Upcoming Events</p>
                    </div>
                </div>
                <a href="{{ route('admin.events.create') }}" class="text-primary-brand small fw-semibold mt-3 d-block"><i class="bi bi-plus-circle me-1"></i>Add New Event</a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Upcoming Events</h5>
                    <a href="{{ route('admin.events.index') }}" class="small text-primary-brand">View All</a>
                </div>
                @if($upcomingEvents->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Event</th><th>Date</th><th>Seats</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingEvents as $event)
                                    <tr>
                                        <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($event->title, 25) }}</td>
                                        <td class="small">{{ $event->event_date->format('M d') }}</td>
                                        <td><span class="badge bg-light text-dark">{{ $event->available_seats }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-3 mb-0">No upcoming events.</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Recent Bookings</h5>
                    <a href="{{ route('admin.bookings') }}" class="small text-primary-brand">View All</a>
                </div>
                @if($recentBookings->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Student</th><th>Event</th><th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                    <tr>
                                        <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($booking->user->name, 15) }}</td>
                                        <td class="small">{{ \Illuminate\Support\Str::limit($booking->event->title, 18) }}</td>
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
                @else
                    <p class="text-muted text-center py-3 mb-0">No bookings yet.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
