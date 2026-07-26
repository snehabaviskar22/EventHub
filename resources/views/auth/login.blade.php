@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card-custom p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="icon-circle mx-auto mb-3" style="background:var(--primary-light);color:var(--primary);">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Welcome Back</h2>
                    <p class="text-muted mb-0">Login to your student account</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-brand">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-brand">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control form-control-brand @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control form-control-brand @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary-brand w-100 py-2 mb-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>

                <p class="text-center text-muted small mb-0">
                    Don't have an account? <a href="{{ route('register') }}" class="text-primary-brand fw-semibold">Register here</a>
                </p>
                <p class="text-center mt-2 small">
                    <a href="{{ route('admin.login') }}" class="text-muted text-decoration-none">Admin Login <i class="bi bi-arrow-right ms-1"></i></a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
