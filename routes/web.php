<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Student auth
Route::get('/register', [StudentAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [StudentAuthController::class, 'register']);
Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentAuthController::class, 'login']);
Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Student routes (must be logged in as a student)
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/events/{event}/book', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/events/{event}/book', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/events/{event}/payment', [TicketController::class, 'showPayment'])->name('payment.show');
    Route::post('/events/{event}/payment', [TicketController::class, 'processPayment'])->name('payment.process');
    Route::get('/my-bookings', [TicketController::class, 'myBookings'])->name('bookings.index');
    Route::get('/my-bookings/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/my-bookings/{ticket}/pdf', [TicketController::class, 'downloadPdf'])->name('tickets.pdf');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');

    Route::get('/events', [EventController::class, 'adminIndex'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::get('/debug-storage', function () {
    $event = Event::first();

    return response()->json([
        'banner_db' => $event?->banner,
        'video_db' => $event?->video,
        'banner_exists' => Storage::disk('public')->exists($event?->banner),
        'video_exists' => Storage::disk('public')->exists($event?->video),
        'banner_url' => asset('storage/' . $event?->banner),
        'video_url' => asset('storage/' . $event?->video),
        'storage_url_banner' => Storage::disk('public')->url($event?->banner),
        'storage_url_video' => Storage::disk('public')->url($event?->video),
    ]);
});
