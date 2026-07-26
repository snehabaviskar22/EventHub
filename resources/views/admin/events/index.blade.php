@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
<section class="container-fluid py-4 px-md-4">
    @if(session('success'))
        <div class="alert alert-success alert-brand">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="fw-bold mb-1">Manage Events</h1>
            <p class="text-muted mb-0">Create, edit, and delete college events</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary-brand"><i class="bi bi-plus-circle me-1"></i>Add Event</a>
    </div>

    <div class="card-custom p-4">
        <div class="table-responsive">
            <table class="table table-brand table-hover align-middle">
                <thead>
                    <tr>
                        <th>Event</th><th>Date</th><th>Venue</th><th>Price</th><th>Seats</th><th>Status</th><th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($event->title, 30) }}</td>
                            <td class="small">{{ $event->event_date->format('M d, Y') }}</td>
                            <td class="small">{{ \Illuminate\Support\Str::limit($event->venue, 20) }}</td>
                            <td>{{ $event->price > 0 ? '₹' . number_format($event->price) : 'FREE' }}</td>
                            <td>{{ $event->available_seats }}</td>
                            <td>
                                @if($event->isBookingOpen() && $event->available_seats > 0)
                                    <span class="badge badge-status-open">Open</span>
                                @else
                                    <span class="badge badge-status-closed">Closed</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-outline-secondary btn-sm me-1" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-outline-primary-brand btn-sm me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this event? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
