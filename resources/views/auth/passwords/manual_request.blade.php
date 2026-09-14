@extends('layouts.app')

@section('title', 'Recovery Access | Shendy')

@section('content')
<div class="auth-page-wrapper d-flex align-items-center justify-content-center py-5" style="min-height: 75vh;">
    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" style="max-width: 500px; width: 100%; border-radius: 24px;" data-aos="zoom-in">
        <div class="text-center mb-5">
            <div class="mx-auto bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                <i class="bi bi-person-badge text-primary fs-2"></i>
            </div>
            <h2 class="fw-800 display-6 mb-2">Account Recovery</h2>
            <p class="text-muted">Verify your identity to reset your password</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; font-size: 0.85rem;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.manual.verify') }}">
            @csrf

            <div class="form-floating mb-3">
                <input id="name" type="text" name="name" value="{{ old('name') }}" 
                    class="form-control border-0 bg-light rounded-3 shadow-none" 
                    placeholder="Full Name" required autofocus style="border-radius: 12px !important; height: 65px;">
                <label for="name" class="ps-3 text-muted">Full Name</label>
            </div>

            <div class="form-floating mb-4">
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    class="form-control border-0 bg-light rounded-3 shadow-none" 
                    placeholder="name@example.com" required style="border-radius: 12px !important; height: 65px;">
                <label for="email" class="ps-3 text-muted">Email Address</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mb-4 shadow-sm" style="border-radius: 14px; font-size: 1.05rem;">
                Verify Identity <i class="bi bi-shield-lock ms-2"></i>
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Back to Login
                </a>
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
