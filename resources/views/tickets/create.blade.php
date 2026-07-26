@extends('layouts.app')

@section('title', 'Book Ticket')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary-brand btn-sm mb-4"><i class="bi bi-arrow-left me-1"></i>Back to Event</a>

            @if(session('error'))
                <div class="alert alert-danger alert-brand">{{ session('error') }}</div>
            @endif

            <div class="card-custom p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="icon-circle mx-auto mb-3" style="background:var(--primary-light);color:var(--primary);">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Book Your Ticket</h2>
                    <p class="text-muted mb-0">{{ $event->title }}</p>
                </div>

                <div class="glass-card p-3 mb-4">
                    <div class="row text-center">
                        <div class="col-6">
                            <p class="text-muted small mb-0">Date</p>
                            <p class="fw-semibold small">{{ $event->event_date->format('M d, Y') }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-muted small mb-0">Price</p>
                            <p class="fw-semibold small {{ $event->price > 0 ? '' : 'text-success' }}">{{ $event->price > 0 ? '₹' . number_format($event->price) : 'FREE' }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('tickets.store', $event) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Student Name</label>
                            <input type="text" class="form-control form-control-brand" value="{{ auth()->user()->name }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control form-control-brand" value="{{ auth()->user()->email }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input type="tel" class="form-control form-control-brand @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="academic_program" class="form-label fw-semibold">Academic Program</label>
                            <input type="text" class="form-control form-control-brand @error('academic_program') is-invalid @enderror" id="academic_program" name="academic_program" value="{{ old('academic_program', auth()->user()->academic_program) }}" required>
                            @error('academic_program') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label for="ticket_quantity" class="form-label fw-semibold">Ticket Quantity</label>
                            <input type="number" class="form-control form-control-brand @error('ticket_quantity') is-invalid @enderror" id="ticket_quantity" name="ticket_quantity" value="{{ old('ticket_quantity', 1) }}" min="1" max="{{ $event->available_seats }}" required>
                            @error('ticket_quantity') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            <div class="form-text">Maximum {{ $event->available_seats }} seats available.</div>
                        </div>
                    </div>

                    @if($event->price > 0)
                        <div class="alert alert-info alert-brand mt-4">
                            <i class="bi bi-info-circle me-1"></i>This is a paid event. You'll proceed to a demo payment page after submitting.
                        </div>
                    @else
                        <div class="alert alert-success alert-brand mt-4">
                            <i class="bi bi-check-circle me-1"></i>This is a free event. Your ticket will be generated instantly.
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary-brand w-100 py-2 mt-3">
                        <i class="bi bi-arrow-right me-2"></i>{{ $event->price > 0 ? 'Proceed to Payment' : 'Confirm Booking' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
