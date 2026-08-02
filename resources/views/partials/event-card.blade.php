@php
    if (!$event->banner) {
        $bannerUrl = 'https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=800';
    } elseif (filter_var($event->banner, FILTER_VALIDATE_URL)) {
        $bannerUrl = $event->banner;
    } else {
        $bannerUrl = asset('storage/' . $event->banner);
    }
@endphp
<article class="card-custom h-100">
    <div class="position-relative overflow-hidden">
        <img src="{{ $bannerUrl }}"
             srcset="{{ $bannerUrl }} 400w, {{ $bannerUrl }} 800w"
             sizes="(max-width: 576px) 100vw, (max-width: 992px) 50vw, 33vw"
             alt="{{ $event->title }}" class="event-card-img w-100">
        <span class="badge position-absolute top-0 end-0 m-2 {{ $event->price > 0 ? 'badge-paid' : 'badge-free' }}">
            {{ $event->price > 0 ? '₹' . number_format($event->price) : 'FREE' }}
        </span>
    </div>
    <div class="card-body p-4">
        <h5 class="fw-bold mb-1">{{ \Illuminate\Support\Str::limit($event->title, 40) }}</h5>
        <p class="text-muted small mb-2">
            <i class="bi bi-calendar3 me-1"></i>{{ $event->event_date->format('M d, Y') }}
            <span class="mx-1">•</span>
            <i class="bi bi-clock me-1"></i>{{ $event->start_time->format('g:i A') }}
        </p>
        <p class="text-muted small mb-3">
            <i class="bi bi-geo-alt me-1"></i>{{ $event->venue }}
        </p>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge-countdown" data-event-date="{{ $event->event_date->format('Y-m-d') }}T{{ $event->start_time->format('H:i:s') }}">
                <i class="bi bi-hourglass-split me-1"></i><span class="countdown-text">Calculating...</span>
            </span>
            <span class="small fw-semibold {{ $event->available_seats > 0 ? 'text-success' : 'text-danger' }}">
                <i class="bi bi-people me-1"></i>{{ $event->available_seats }} seats left
            </span>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if($event->isBookingOpen() && $event->available_seats > 0)
                <span class="badge badge-status-open"><i class="bi bi-check-circle me-1"></i>Open</span>
            @else
                <span class="badge badge-status-closed"><i class="bi bi-x-circle me-1"></i>Closed</span>
            @endif
            <a href="{{ route('events.show', $event) }}" class="btn btn-primary-brand btn-sm px-3">
                View Details <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</article>
