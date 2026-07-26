<footer class="footer-custom">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h5 class="mb-3"><i class="bi bi-calendar2-event-fill me-2"></i>EventHub</h5>
                <p class="small">Your college event management and ticket booking platform. Discover, book, and attend exciting campus events all in one place.</p>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing:1px;">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
                    <li class="mb-2"><a href="{{ route('events.index') }}">Browse Events</a></li>
                    @if(auth()->check() && !auth()->user()->isAdmin())
                        <li class="mb-2"><a href="{{ route('bookings.index') }}">My Bookings</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing:1px;">Connect</h6>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4" style="border-color: rgba(255,255,255,0.15);">
        <div class="text-center small">
            <p class="mb-0">&copy; {{ date('Y') }} EventHub. College Event Management & Ticket Booking Platform. All rights reserved.</p>
        </div>
    </div>
</footer>
