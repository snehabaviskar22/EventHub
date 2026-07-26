@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card-custom p-4 p-md-5" style="background:linear-gradient(135deg,rgba(124,58,237,0.05),rgba(244,114,182,0.05));">
                <div class="text-center mb-4">
                    <div class="icon-circle mx-auto mb-3" style="background:linear-gradient(135deg,var(--primary),var(--secondary));color:white;">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Admin Portal</h2>
                    <p class="text-muted mb-0">Sign in to manage events</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-brand">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Admin Email</label>
                        <input type="email" class="form-control form-control-brand @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control form-control-brand @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary-brand w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Admin Login
                    </button>
                </form>

                <p class="text-center mt-3 small">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Back to site</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
