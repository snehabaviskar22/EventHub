<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $totalEvents = Event::count();
        $totalBookings = Ticket::count();
        $upcomingEvents = Event::where('event_date', '>=', now())->orderBy('event_date')->take(5)->get();
        $recentBookings = Ticket::with(['user', 'event'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalEvents', 'totalBookings', 'upcomingEvents', 'recentBookings'));
    }

    public function bookings(): View
    {
        $bookings = Ticket::with(['user', 'event'])->latest()->paginate(15);

        return view('admin.bookings', compact('bookings'));
    }
}
