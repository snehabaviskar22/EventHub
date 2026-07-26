@extends('layouts.app')

@php $event = $event ?? null; @endphp
@section('title', $event ? 'Edit Event' : 'Add Event')

@section('content')
<section class="container py-4">
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary-brand btn-sm mb-4"><i class="bi bi-arrow-left me-1"></i>Back to Events</a>

    @if(session('error'))
        <div class="alert alert-danger alert-brand">{{ session('error') }}</div>
    @endif

    <div class="card-custom p-4 p-md-5">
        <div class="mb-4">
            <h1 class="fw-bold mb-1">{{ $event ? 'Edit Event' : 'Add New Event' }}</h1>
            <p class="text-muted mb-0">{{ $event ? 'Update the event details below' : 'Fill in the details to create a new event' }}</p>
        </div>

        <form action="{{ $event ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($event) @method('PUT') @endif

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Event Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-brand" name="title" value="{{ old('title', $event->title ?? '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Venue <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-brand" name="venue" value="{{ old('venue', $event->venue ?? '') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control form-control-brand" name="description" rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Event Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control form-control-brand" name="event_date" value="{{ old('event_date', $event ? $event->event_date->format('Y-m-d') : '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Start Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control form-control-brand" name="start_time" value="{{ old('start_time', $event ? $event->start_time->format('H:i') : '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">End Time <span class="text-danger">*</span></label>
                    <input type="time" class="form-control form-control-brand" name="end_time" value="{{ old('end_time', $event ? $event->end_time->format('H:i') : '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Ticket Price (₹) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control form-control-brand" name="price" value="{{ old('price', $event->price ?? 0) }}" min="0" step="0.01" required>
                    <div class="form-text">Enter 0 for a free event.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Available Seats <span class="text-danger">*</span></label>
                    <input type="number" class="form-control form-control-brand" name="available_seats" value="{{ old('available_seats', $event->available_seats ?? '') }}" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Booking Deadline <span class="text-danger">*</span></label>
                    <input type="date" class="form-control form-control-brand" name="booking_deadline" value="{{ old('booking_deadline', $event ? $event->booking_deadline->format('Y-m-d') : '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Eligible Academic Programs</label>
                    <input type="text" class="form-control form-control-brand" name="eligible_programs" value="{{ old('eligible_programs', $event->eligible_programs ?? '') }}" placeholder="e.g. BCA, MCA, B.Tech">
                    <div class="form-text">Comma-separated list. Leave empty if open to all.</div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="open_to_all" id="open_to_all" value="1" {{ old('open_to_all', $event ? $event->open_to_all : false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="open_to_all">Open to All Programs</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Banner Image</label>
                    <input type="file" class="form-control form-control-brand" name="banner" accept="image/jpeg,image/png,image/jpg,image/webp">
                    @if($event && $event->banner)
                        <div class="form-text">Current: <a href="{{ asset('storage/' . $event->banner) }}" target="_blank">View banner</a></div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Audio File</label>
                    <input type="file" class="form-control form-control-brand" name="audio" accept="audio/mpeg,audio/ogg,audio/wav">
                    @if($event && $event->audio)
                        <div class="form-text">Current: <a href="{{ asset('storage/' . $event->audio) }}" target="_blank">Listen</a></div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Video File</label>
                    <input type="file" class="form-control form-control-brand" name="video" accept="video/mp4,video/webm,video/ogg">
                    @if($event && $event->video)
                        <div class="form-text">Current: <a href="{{ asset('storage/' . $event->video) }}" target="_blank">Watch</a></div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary-brand px-4 py-2 mt-4">
                <i class="bi bi-check-circle me-2"></i>{{ $event ? 'Update Event' : 'Create Event' }}
            </button>
        </form>
    </div>
</section>
@endsection
