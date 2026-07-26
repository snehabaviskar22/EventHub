<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $upcomingEvents = Event::published()
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(6)
            ->get();

        $totalEvents = Event::published()->count();
        $totalSeats = Event::published()->sum('available_seats');

        return view('home', compact('upcomingEvents', 'totalEvents', 'totalSeats'));
    }
}
