@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card-custom p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="icon-circle mx-auto mb-3" style="background:var(--secondary-light);color:var(--secondary);">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Create Account</h2>
                    <p class="text-muted mb-0">Join EventHub to book college events</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-brand">{{ session('error') }}</div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control form-control-brand @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control form-control-brand @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input type="tel" class="form-control form-control-brand @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="academic_program" class="form-label fw-semibold">Academic Program</label>
                            <select class="form-select form-select-brand @error('academic_program') is-invalid @enderror" id="academic_program" name="academic_program" required>
                                <option value="">Select program</option>
                                <option value="BCA" @selected(old('academic_program')==='BCA')>BCA</option>
                                <option value="MCA" @selected(old('academic_program')==='MCA')>MCA</option>
                                <option value="B.Tech" @selected(old('academic_program')==='B.Tech')>B.Tech</option>
                                <option value="M.Tech" @selected(old('academic_program')==='M.Tech')>M.Tech</option>
                                <option value="BBA" @selected(old('academic_program')==='BBA')>BBA</option>
                                <option value="MBA" @selected(old('academic_program')==='MBA')>MBA</option>
                                <option value="B.Sc" @selected(old('academic_program')==='B.Sc')>B.Sc</option>
                                <option value="M.Sc" @selected(old('academic_program')==='M.Sc')>M.Sc</option>
                                <option value="B.Com" @selected(old('academic_program')==='B.Com')>B.Com</option>
                                <option value="M.Com" @selected(old('academic_program')==='M.Com')>M.Com</option>
                                <option value="BA" @selected(old('academic_program')==='BA')>BA</option>
                                <option value="MA" @selected(old('academic_program')==='MA')>MA</option>
                            </select>
                            @error('academic_program') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-brand @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control form-control-brand" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary-brand w-100 py-2 mt-4 mb-3">
                        <i class="bi bi-person-plus me-2"></i>Create Account
                    </button>
                </form>

                <p class="text-center text-muted small mb-0">
                    Already have an account? <a href="{{ route('login') }}" class="text-primary-brand fw-semibold">Login here</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
