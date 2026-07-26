<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom d-flex align-items-center gap-2" href="{{ route('home') }}">
            <i class="bi bi-calendar2-event-fill"></i>
            EventHub
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.index') }}">Events</a>
                </li>
                @if(auth()->check() && !auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bookings.index') }}">My Bookings</a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav">
                @if(auth()->check())
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.events.index') }}"><i class="bi bi-calendar-event me-1"></i>Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.bookings') }}"><i class="bi bi-ticket-perforated me-1"></i>Bookings</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link border-0"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('bookings.index') }}"><i class="bi bi-ticket-perforated me-2"></i>My Bookings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary-brand px-3 ms-lg-2" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
