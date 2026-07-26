<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::published()
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->paginate(9);

        return view('events.index', compact('events'));
    }

    public function show(Event $event): View
    {
        $event->load('tickets');

        $userBooked = auth()->check()
            ? $event->tickets()->where('user_id', auth()->id())->exists()
            : false;

        return view('events.show', compact('event', 'userBooked'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateEvent($request);

        $validated['banner'] = $this->uploadFile($request, 'banner', 'banners');
        $validated['audio'] = $this->uploadFile($request, 'audio', 'audio');
        $validated['video'] = $this->uploadFile($request, 'video', 'videos');
        $validated['is_published'] = true;

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $this->validateEvent($request, $event);

        $validated['banner'] = $this->uploadFile($request, 'banner', 'banners', $event->banner);
        $validated['audio'] = $this->uploadFile($request, 'audio', 'audio', $event->audio);
        $validated['video'] = $this->uploadFile($request, 'video', 'videos', $event->video);

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        foreach (['banner', 'audio', 'video'] as $field) {
            if ($event->$field) {
                Storage::disk('public')->delete($event->$field);
            }
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    public function adminIndex(): View
    {
        $events = Event::latest()->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    private function validateEvent(Request $request, ?Event $event = null): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'venue' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'available_seats' => ['required', 'integer', 'min:1'],
            'booking_deadline' => ['required', 'date'],
            'eligible_programs' => ['nullable', 'string'],
            'open_to_all' => ['boolean'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'audio' => ['nullable', 'file', 'mimes:mp3,wav,ogg', 'max:10240'],
            'video' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:51200'],
        ];

        $validated = $request->validate($rules);

        $validated['open_to_all'] = $request->boolean('open_to_all');
        if ($validated['open_to_all']) {
            $validated['eligible_programs'] = null;
        }

        return $validated;
    }

    private function uploadFile(Request $request, string $field, string $folder, ?string $existing = null): ?string
    {
        if ($request->hasFile($field)) {
            if ($existing) {
                Storage::disk('public')->delete($existing);
            }

            return $request->file($field)->store($folder, 'public');
        }

        return $existing;
    }
}
