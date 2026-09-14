@extends('layouts.app')

@section('title', 'Set New Password | Shendy')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 80vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 500px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <h2 class="fw-800 display-6 mb-2">New Password</h2>
            <p class="text-muted">Securely update your account credentials</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-floating mb-3">
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="name@example.com" required style="border-radius: 12px;">
                <label for="email">Email Address</label>
                @error('email')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input id="password" type="password" name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="New Password" required style="border-radius: 12px;">
                <label for="password">New Password</label>
                @error('password')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-4">
                <input id="password-confirm" type="password" name="password_confirmation" 
                    class="form-control" 
                    placeholder="Confirm Password" required style="border-radius: 12px;">
                <label for="password-confirm">Confirm New Password</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow" style="font-size: 1.1rem;">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection