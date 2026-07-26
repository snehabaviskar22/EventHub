@extends('layouts.app')

@section('title', 'Events')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateCountdowns() {
        document.querySelectorAll('.badge-countdown').forEach(function(el) {
            var eventDate = el.dataset.eventDate;
            if (!eventDate) return;
            var target = new Date(eventDate).getTime();
            var now = new Date().getTime();
            var diff = target - now;
            if (diff <= 0) {
                el.querySelector('.countdown-text').textContent = 'Started';
                return;
            }
            var days = Math.floor(diff / 86400000);
            var hours = Math.floor((diff % 86400000) / 3600000);
            var mins = Math.floor((diff % 3600000) / 60000);
            var text = '';
            if (days > 0) text = days + 'd ' + hours + 'h left';
            else if (hours > 0) text = hours + 'h ' + mins + 'm left';
            else text = mins + 'm left';
            el.querySelector('.countdown-text').textContent = text;
        });
    }
    updateCountdowns();
    setInterval(updateCountdowns, 60000);
});
</script>
@endpush

@section('content')
<section class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2">Browse Events</h1>
        <p class="text-muted">Discover and book tickets for exciting college events</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-brand">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-brand">{{ session('error') }}</div>
    @endif

    @if($events->isNotEmpty())
        <div class="row g-4">
            @foreach($events as $event)
                <div class="col-md-6 col-lg-4">
                    @include('partials.event-card')
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5 glass-card">
            <i class="bi bi-calendar-x fs-1 text-muted d-block mb-3"></i>
            <h4 class="fw-bold">No Events Found</h4>
            <p class="text-muted">There are no upcoming events at the moment. Check back soon!</p>
        </div>
    @endif
</section>
@endsection
