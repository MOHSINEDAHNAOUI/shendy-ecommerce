@extends('layouts.app')

@section('title', 'Reset Password | Shendy')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 70vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 500px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <h2 class="fw-800 display-6 mb-2">Reset Password</h2>
            <p class="text-muted">Enter your email to receive a secure reset link</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px; font-size: 0.9rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-floating mb-4">
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="name@example.com" required autofocus style="border-radius: 12px;">
                <label for="email">Email Address</label>
                @error('email')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mb-4" style="border-radius: 14px; font-size: 1.05rem;">
                Send Reset Link <i class="bi bi-arrow-right ms-2"></i>
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none d-inline-flex align-items-center gap-2">
                    <i class="bi bi-chevron-left small"></i> Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection