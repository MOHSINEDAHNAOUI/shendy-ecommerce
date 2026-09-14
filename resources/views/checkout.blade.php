@extends('layouts.app')

@section('title', 'Secure Checkout | Shendy')

@section('content')
<div class="checkout-container py-4">
    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('cart.index') }}" class="btn btn-link text-muted p-0 text-decoration-none">
            <i class="bi bi-arrow-left"></i> Back to Cart
        </a>
    </div>

    <h1 class="display-6 fw-800 mb-5">Checkout</h1>

    <div class="row g-5">
        <!-- Left: Shipping & Payment Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 mb-4">
                <h4 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-geo-alt text-primary me-2"></i> Shipping Information
                </h4>
                
                <form action="{{ route('order.place') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase text-muted">Full Name</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0 shadow-none" 
                                   value="{{ auth()->user()->name }}" readonly style="border-radius: 12px; font-size: 0.95rem;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                            <input type="email" class="form-control form-control-lg bg-light border-0 shadow-none" 
                                   value="{{ auth()->user()->email }}" readonly style="border-radius: 12px; font-size: 0.95rem;">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="phone" class="form-label fw-bold small text-uppercase text-muted">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-lg border-2 shadow-none" 
                                   value="{{ old('phone') }}" required placeholder="e.g. +212 600 000 000" style="border-radius: 12px; font-size: 0.95rem;">
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <label for="shipping_address" class="form-label fw-bold small text-uppercase text-muted">Shipping Address <span class="text-danger">*</span></label>
                            <textarea name="shipping_address" id="shipping_address" class="form-control border-2 shadow-none" 
                                      rows="4" required placeholder="Street address, apartment, suite, unit, building, floor, etc."
                                      style="border-radius: 12px;">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="payment-method-section mt-4 p-4 rounded-4 bg-light border-dashed">
                        <h6 class="fw-bold mb-3"><i class="bi bi-credit-card me-2 text-primary"></i> Payment Method</h6>
                        <div class="form-check p-0 d-flex align-items-center gap-3">
                            <div class="bg-white p-3 rounded-3 border d-flex align-items-center flex-grow-1">
                                <input class="form-check-input ms-0 me-3 shadow-none" type="radio" name="payment" id="cod" checked>
                                <label class="form-check-label fw-600 m-0" for="cod">
                                    Cash on Delivery (COD)
                                    <small class="d-block text-muted fw-normal mt-1">Pay when you receive your order.</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold mt-5 shadow-sm" 
                            style="border-radius: 15px; font-size: 1.1rem; background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%); border: none;">
                        Complete Purchase
                    </button>

                    <div class="text-center mt-4 text-muted small">
                        <i class="bi bi-shield-lock-fill me-1"></i> Secure SSL encrypted checkout
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 rounded-4 sticky-top" style="top: 100px; z-index: 10;">
                <h4 class="fw-bold mb-4">Order Summary</h4>
                
                <div class="checkout-items mb-4" style="max-height: 400px; overflow-y: auto;">
                    @foreach($cart as $id => $item)
                        <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                            <div class="bg-light rounded-3 overflow-hidden" style="width: 70px; height: 70px; flex-shrink: 0;">
                                @if(isset($item['image']))
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small">No Img</div>
                                @endif
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="fw-bold mb-1 text-truncate" title="{{ $item['name'] }}">{{ $item['name'] }}</h6>
                                <p class="text-muted small mb-0">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <div class="fw-bold text-dark">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="summary-details">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-600 text-dark">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-800 m-0">Order Total</h5>
                        <h4 class="fw-800 text-primary m-0">${{ number_format($total, 2) }}</h4>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <p class="small text-muted mb-0">
                        By placing your order, you agree to Shendy's 
                        <a href="#" class="text-primary text-decoration-none">Terms of Service</a> and 
                        <a href="#" class="text-primary text-decoration-none">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    textarea:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1) !important;
    }
</style>
@endsection
