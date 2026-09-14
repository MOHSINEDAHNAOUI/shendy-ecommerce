@extends('layouts.app')

@section('title', 'Set New Password | Shendy')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 75vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 500px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <div class="mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 70px; height: 70px;">
                <i class="bi bi-key-fill fs-2"></i>
            </div>
            <h2 class="fw-800 display-6 mb-2">New Password</h2>
            <p class="text-muted">You're verified! Enter your new password below.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; font-size: 0.85rem;">
                <i class="bi bi-shield-exclamation me-2"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.manual.update') }}">
            @csrf

            <div class="form-floating mb-3">
                <input id="password" type="password" name="password" 
                    class="form-control border-0 bg-light rounded-3 shadow-none" 
                    placeholder="New Password" required autofocus style="border-radius: 12px !important; height: 65px;">
                <label for="password" class="ps-3 text-muted">New Password</label>
            </div>

            <div class="form-floating mb-4">
                <input id="password-confirm" type="password" name="password_confirmation" 
                    class="form-control border-0 bg-light rounded-3 shadow-none" 
                    placeholder="Confirm Password" required style="border-radius: 12px !important; height: 65px;">
                <label for="password-confirm" class="ps-3 text-muted">Confirm New Password</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mb-4 shadow-sm" style="border-radius: 14px; font-size: 1.1rem;">
                Update Password <i class="bi bi-check-circle-fill ms-2"></i>
            </button>

            <div class="text-center">
                <p class="small text-muted mb-0">Security Note: Your password should be at least 8 characters.</p>
            </div>
        </form>
    </div>
</div>

<style>
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
        border: 1px solid #0d6efd !important;
    }
</style>
@endsection
