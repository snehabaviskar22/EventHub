@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero-section">
    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <span class="badge mb-3" style="background:rgba(255,255,255,0.2);color:#fff;padding:.5rem 1.2rem;border-radius:2rem;">
                    <i class="bi bi-mortarboard-fill me-2"></i>College Event Platform
                </span>
                <h1 class="display-3 fw-bold mb-3" style="line-height:1.15;">Discover &amp; Book<br>Campus Events</h1>
                <p class="lead mb-4" style="opacity:0.92;">From tech fests to cultural nights, workshops to seminars — explore and book tickets for every exciting event happening at your college.</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                    <a href="{{ route('events.index') }}" class="btn btn-light btn-lg px-4" style="color:var(--primary);font-weight:600;">
                        <i class="bi bi-search me-2"></i>Browse Events
                    </a>
                    @if(!auth()->check())
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-person-plus me-2"></i>Get Started
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <i class="bi bi-calendar2-event-fill" style="font-size:14rem;opacity:0.3;"></i>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card p-4 text-center text-white">
                <i class="bi bi-calendar-event fs-1 mb-2 d-block"></i>
                <h3 class="fw-bold mb-0">{{ $totalEvents }}</h3>
                <p class="mb-0 small">Total Events</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card p-4 text-center text-white">
                <i class="bi bi-people-fill fs-1 mb-2 d-block"></i>
                <h3 class="fw-bold mb-0">{{ $totalSeats }}</h3>
                <p class="mb-0 small">Seats Available</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card p-4 text-center text-white">
                <i class="bi bi-ticket-perforated-fill fs-1 mb-2 d-block"></i>
                <h3 class="fw-bold mb-0">100%</h3>
                <p class="mb-0 small">Free to Join</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-1">Upcoming Events</h2>
            <p class="text-muted mb-0">Don't miss out on what's happening on campus</p>
        </div>
        <a href="{{ route('events.index') }}" class="btn btn-outline-primary-brand d-none d-md-inline-block">View All <i class="bi bi-arrow-right ms-1"></i></a>
    </div>

    @if($upcomingEvents->isNotEmpty())
        <div class="row g-4">
            @foreach($upcomingEvents as $event)
                @include('partials.event-card')
            @endforeach
        </div>
        <div class="text-center mt-4 d-md-none">
            <a href="{{ route('events.index') }}" class="btn btn-outline-primary-brand">View All Events</a>
        </div>
    @else
        <div class="text-center py-5 glass-card">
            <i class="bi bi-calendar-x fs-1 text-muted d-block mb-3"></i>
            <p class="text-muted mb-0">No upcoming events yet. Check back soon!</p>
        </div>
    @endif
</section>

<section class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-custom p-4 text-center h-100">
                <div class="icon-circle mx-auto mb-3" style="background:var(--primary-light);color:var(--primary);">
                    <i class="bi bi-search-heart"></i>
                </div>
                <h5 class="fw-bold">Discover Events</h5>
                <p class="text-muted small mb-0">Browse a wide range of college events — from hackathons to cultural festivals.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-custom p-4 text-center h-100">
                <div class="icon-circle mx-auto mb-3" style="background:var(--secondary-light);color:var(--secondary);">
                    <i class="bi bi-ticket-perforated"></i>
                </div>
                <h5 class="fw-bold">Book Tickets</h5>
                <p class="text-muted small mb-0">Reserve your spot instantly with our easy booking and demo payment system.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-custom p-4 text-center h-100">
                <div class="icon-circle mx-auto mb-3" style="background:#fef3c7;color:var(--accent);">
                    <i class="bi bi-download"></i>
                </div>
                <h5 class="fw-bold">Download Tickets</h5>
                <p class="text-muted small mb-0">Get your confirmation email and download your ticket as a PDF instantly.</p>
            </div>
        </div>
    </div>
</section>
@endsection
