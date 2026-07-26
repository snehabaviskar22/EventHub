@extends('layouts.app')

@section('title', 'Demo Payment')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-custom overflow-hidden">
                <div class="p-4 text-center" style="background:linear-gradient(135deg,var(--primary),var(--secondary));color:white;">
                    <div class="icon-circle mx-auto mb-3" style="background:rgba(255,255,255,0.2);color:white;">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h3 class="fw-bold mb-0">Demo Payment</h3>
                    <p class="mb-0 small" style="opacity:0.9;">This is a simulated payment — no real transaction occurs.</p>
                </div>

                <div class="p-4 p-md-5">
                    <h5 class="fw-bold mb-3">Payment Summary</h5>
                    <div class="glass-card p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Event</span>
                            <span class="fw-semibold">{{ $event->title }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Ticket Price</span>
                            <span>₹{{ number_format($event->price) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Quantity</span>
                            <span>{{ $booking['ticket_quantity'] }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Amount</span>
                            <span class="fw-bold fs-5 text-primary-brand">₹{{ number_format($totalAmount) }}</span>
                        </div>
                    </div>

                    <form action="{{ route('payment.process', $event) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name on Card</label>
                            <input type="text" class="form-control form-control-brand @error('card_name') is-invalid @enderror" name="card_name" placeholder="John Doe" required>
                            @error('card_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Card Number</label>
                            <input type="text" class="form-control form-control-brand @error('card_number') is-invalid @enderror" name="card_number" placeholder="4242 4242 4242 4242" required>
                            @error('card_number') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Expiry</label>
                                <input type="text" class="form-control form-control-brand @error('expiry') is-invalid @enderror" name="expiry" placeholder="MM/YY" required>
                                @error('expiry') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold">CVV</label>
                                <input type="text" class="form-control form-control-brand @error('cvv') is-invalid @enderror" name="cvv" placeholder="123" required>
                                @error('cvv') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-brand w-100 py-2 mt-4">
                            <i class="bi bi-lock me-2"></i>Pay ₹{{ number_format($totalAmount) }}
                        </button>
                    </form>

                    <p class="text-center text-muted small mt-3 mb-0">
                        <i class="bi bi-shield-check me-1"></i>Secured by DemoPay (no real payment)
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
