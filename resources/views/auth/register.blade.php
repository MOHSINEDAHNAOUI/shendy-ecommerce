@extends('layouts.app')

@section('title', 'Join Shendy Premium')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 80vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 500px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <h2 class="fw-800 display-6 mb-2">Create Account</h2>
            <p class="text-muted">Join our community of premium shoppers</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-floating mb-3">
                <input id="name" type="text" name="name" value="{{ old('name') }}" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Full Name" required autofocus style="border-radius: 12px;">
                <label for="name">Full Name</label>
                @error('name')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="name@example.com" required style="border-radius: 12px;">
                <label for="email">Email Address</label>
                @error('email')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input id="password" type="password" name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Password" required style="border-radius: 12px;">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input id="password-confirm" type="password" name="password_confirmation" 
                            class="form-control" 
                            placeholder="Confirm" required style="border-radius: 12px;">
                        <label for="password-confirm">Confirm</label>
                    </div>
                </div>
            </div>

            <div class="form-check mb-4 px-1">
                <input class="form-check-input ms-0 me-2" type="checkbox" value="" id="terms" required>
                <label class="form-check-label text-muted" for="terms" style="font-size: 0.85rem;">
                    I agree to the <a href="#" class="text-primary text-decoration-none fw-bold">Terms & Conditions</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mb-4" style="border-radius: 14px; font-size: 1.1rem;">
                Create Account
            </button>

            <div class="text-center">
                <p class="text-muted" style="font-size: 0.9rem;">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection