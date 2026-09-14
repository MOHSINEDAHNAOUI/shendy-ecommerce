@extends('layouts.app')

@section('title', 'Welcome Back | Shendy')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 70vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 450px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <h2 class="fw-800 display-6 mb-2">Welcome Back</h2>
            <p class="text-muted">Login to access your premium account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-floating mb-3">
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="name@example.com" required autofocus style="border-radius: 12px;">
                <label for="email">Email Address</label>
                @error('email')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input id="password" type="password" name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Password" required style="border-radius: 12px;">
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 px-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted" for="remember" style="font-size: 0.85rem;">
                        Remember Me
                    </label>
                </div>
                <a href="{{ route('password.manual.request') }}" class="text-primary text-decoration-none fw-bold" style="font-size: 0.85rem;">Forgot?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mb-4" style="border-radius: 14px; font-size: 1.1rem;">
                Sign In
            </button>

            <div class="text-center">
                <p class="text-muted" style="font-size: 0.9rem;">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Sign Up Now</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection