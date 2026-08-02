@extends('layouts.app')

@section('title', $event->title)

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var el = document.querySelector('.badge-countdown');
    if (el && el.dataset.eventDate) {
        var target = new Date(el.dataset.eventDate).getTime();
        var textEl = el.querySelector('.countdown-text');
        function tick() {
            var diff = target - new Date().getTime();
            if (diff <= 0) { textEl.textContent = 'Event Started'; return; }
            var d = Math.floor(diff/86400000), h = Math.floor((diff%86400000)/3600000), m = Math.floor((diff%3600000)/60000);
            textEl.textContent = d > 0 ? d + 'd ' + h + 'h ' + m + 'm left' : h + 'h ' + m + 'm left';
        }
        tick(); setInterval(tick, 60000);
    }
});
</script>
@endpush

@section('content')
@php
    if (!$event->banner) {
        $bannerUrl = 'https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=1200';
    } elseif (filter_var($event->banner, FILTER_VALIDATE_URL)) {
        $bannerUrl = $event->banner;
    } else {
        $bannerUrl = asset('storage/' . $event->banner);
    }

    $audioUrl = $event->audio
        ? (filter_var($event->audio, FILTER_VALIDATE_URL)
            ? $event->audio
            : asset('storage/' . $event->audio))
        : null;

    $videoUrl = $event->video
        ? (filter_var($event->video, FILTER_VALIDATE_URL)
            ? $event->video
            : asset('storage/' . $event->video))
        : null;
@endphp

<section class="container py-5">
    <a href="{{ route('events.index') }}" class="btn btn-outline-primary-brand btn-sm mb-4"><i class="bi bi-arrow-left me-1"></i>Back to Events</a>

    @if(session('error'))
        <div class="alert alert-danger alert-brand mb-4">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-brand mb-4">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <article class="card-custom overflow-hidden">
                <img src="{{ $bannerUrl }}"
                     srcset="{{ $bannerUrl }} 600w, {{ $bannerUrl }} 1200w"
                     sizes="(max-width: 992px) 100vw, 66vw"
                     alt="{{ $event->title }}" class="w-100" style="height:400px;object-fit:cover;">

                <div class="p-4 p-md-5">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge {{ $event->price > 0 ? 'badge-paid' : 'badge-free' }}">
                            {{ $event->price > 0 ? '₹' . number_format($event->price) : 'FREE' }}
                        </span>
                        @if($event->isBookingOpen() && $event->available_seats > 0)
                            <span class="badge badge-status-open"><i class="bi bi-check-circle me-1"></i>Registration Open</span>
                        @else
                            <span class="badge badge-status-closed"><i class="bi bi-x-circle me-1"></i>Registration Closed</span>
                        @endif
                        @if($event->open_to_all)
                            <span class="badge" style="background:var(--primary-light);color:var(--primary);">Open to All Programs</span>
                        @endif
                    </div>

                    <h1 class="fw-bold mb-3">{{ $event->title }}</h1>
                    <p class="text-muted" style="line-height:1.7;">{{ $event->description }}</p>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2 text-primary-brand"></i>Event Details</h5>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle" style="background:var(--primary-light);color:var(--primary);width:44px;height:44px;font-size:1.1rem;">
                                    <i class="bi bi-calendar3"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Date</p>
                                    <p class="fw-semibold mb-0">{{ $event->event_date->format('F d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle" style="background:var(--secondary-light);color:var(--secondary);width:44px;height:44px;font-size:1.1rem;">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Time</p>
                                    <p class="fw-semibold mb-0">{{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle" style="background:#fef3c7;color:var(--accent);width:44px;height:44px;font-size:1.1rem;">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Venue</p>
                                    <p class="fw-semibold mb-0">{{ $event->venue }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle" style="background:#dcfce7;color:#16a34a;width:44px;height:44px;font-size:1.1rem;">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Available Seats</p>
                                    <p class="fw-semibold mb-0">{{ $event->available_seats }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3"><i class="bi bi-calendar-x me-2 text-primary-brand"></i>Booking Deadline</h5>
                    <p class="mb-0">{{ $event->booking_deadline->format('F d, Y') }}
                        @if($event->isBookingOpen())
                            <span class="badge badge-status-open ms-2"><i class="bi bi-check-circle me-1"></i>Still Open</span>
                        @else
                            <span class="badge badge-status-closed ms-2"><i class="bi bi-x-circle me-1"></i>Passed</span>
                        @endif
                    </p>

                    @if(!$event->open_to_all && $event->eligible_programs)
                        <hr class="my-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-mortarboard me-2 text-primary-brand"></i>Eligible Academic Programs</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($event->getEligibleProgramsArray() as $program)
                                <span class="badge" style="background:var(--primary-light);color:var(--primary);font-size:.85rem;padding:.4rem .8rem;">{{ $program }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($event->audio)
                        <hr class="my-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-soundwave me-2 text-primary-brand"></i>Audio Preview</h5>
                        <audio controls class="w-100">
                            <source src="{{ $audioUrl }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif

                    @if($event->video)
                        <hr class="my-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-play-circle me-2 text-primary-brand"></i>Video Preview</h5>
                        <video controls class="w-100" style="border-radius:1rem;">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            Your browser does not support the video element.
                        </video>
                    @endif
                </div>
            </article>
        </div>

        <aside class="col-lg-4">
            <div class="card-custom p-4 sticky-top" style="top:90px;">
                <h4 class="fw-bold mb-3">Book Your Ticket</h4>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Ticket Price</span>
                    <span class="fw-bold {{ $event->price > 0 ? '' : 'text-success' }}">{{ $event->price > 0 ? '₹' . number_format($event->price) : 'FREE' }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Available Seats</span>
                    <span class="fw-bold">{{ $event->available_seats }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Booking Deadline</span>
                    <span class="fw-semibold small">{{ $event->booking_deadline->format('M d, Y') }}</span>
                </div>

                <div class="badge-countdown w-100 d-block text-center mb-3" data-event-date="{{ $event->event_date->format('Y-m-d') }}T{{ $event->start_time->format('H:i:s') }}">
                    <i class="bi bi-hourglass-split me-1"></i><span class="countdown-text">Calculating...</span>
                </div>

                @if(!auth()->check())
                    <a href="{{ route('login') }}" class="btn btn-primary-brand w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login to Book
                    </a>
                @elseif(auth()->user()->isAdmin())
                    <div class="alert alert-info alert-brand text-center mb-0">
                        <i class="bi bi-info-circle me-1"></i>Admins cannot book tickets.
                    </div>
                @elseif($userBooked)
                    <div class="alert alert-success alert-brand text-center mb-0">
                        <i class="bi bi-check-circle me-1"></i>You've already booked this event!
                        <a href="{{ route('bookings.index') }}" class="d-block mt-2 small fw-semibold">View My Bookings</a>
                    </div>
                @elseif(!$event->isBookingOpen())
                    <div class="alert alert-danger alert-brand text-center mb-0">
                        <i class="bi bi-x-circle me-1"></i>Booking deadline has passed.
                    </div>
                @elseif($event->available_seats <= 0)
                    <div class="alert alert-danger alert-brand text-center mb-0">
                        <i class="bi bi-x-circle me-1"></i>This event is fully booked.
                    </div>
                @elseif(!$event->isProgramEligible(auth()->user()->academic_program))
                    <div class="alert alert-warning alert-brand text-center mb-0">
                        <i class="bi bi-exclamation-triangle me-1"></i>Your program is not eligible for this event.
                    </div>
                @else
                    <a href="{{ route('tickets.create', $event) }}" class="btn btn-primary-brand w-100 py-2">
                        <i class="bi bi-ticket-perforated me-2"></i>Book Ticket
                    </a>
                @endif
            </div>
        </aside>
    </div>
</section>
@endsection
