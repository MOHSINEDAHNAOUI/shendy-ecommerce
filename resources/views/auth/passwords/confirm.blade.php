@extends('layouts.app')

@section('title', 'Confirm Password | Shendy')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 70vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 500px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <h2 class="fw-800 display-6 mb-2">Security Check</h2>
            <p class="text-muted">Please confirm your password before continuing</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-floating mb-4">
                <input id="password" type="password" name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Password" required autocomplete="current-password" style="border-radius: 12px;">
                <label for="password">Your Password</label>
                @error('password')
                    <div class="invalid-feedback ps-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mb-4" style="border-radius: 14px; font-size: 1.1rem;">
                Confirm Access
            </button>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-muted text-decoration-none small fw-500">
                        Forgot Your Password?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
