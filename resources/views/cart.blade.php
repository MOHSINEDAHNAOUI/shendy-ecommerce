@extends('layouts.app')

@section('title', 'Your Shopping Cart | Shendy')

@section('content')
<div class="cart-page-header mb-5" data-aos="fade-down">
    <h1 class="display-5 fw-800 mb-2">Shopping Cart</h1>
    <p class="text-muted">You have {{ count($cart) }} items in your basket</p>
</div>

@if(empty($cart))
    <div class="empty-cart-state text-center py-5 border rounded-4 bg-light" data-aos="fade-up">
        <div class="mb-4" style="font-size: 4rem;">🛒</div>
        <h2 class="fw-bold">Your cart is feeling a bit light.</h2>
        <p class="text-muted mb-4">Add some premium products to your cart and make it happy!</p>
        <a href="{{ route('home') }}" class="btn btn-primary px-5 py-3 fw-bold" style="border-radius: 12px;">
            Start Shopping
        </a>
    </div>
@else
    <div class="row g-4">
        <!-- Cart Items -->
        <div class="col-lg-8" data-aos="fade-right">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Product</th>
                                <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Price</th>
                                <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Quantity</th>
                                <th class="py-3 border-0 text-uppercase fw-bold text-muted text-endpe-4" style="font-size: 0.75rem;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td class="ps-4 py-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="cart-item-image rounded-3 border bg-light overflow-hidden" style="width: 80px; height: 80px;">
                                                @if(isset($item['image']))
                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-100 h-100 object-fit-cover">
                                                @else
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="font-size: 0.8rem;">No Image</div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $item['name'] }}</h6>
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-danger text-decoration-none" style="font-size: 0.8rem;">
                                                        Remove item
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 fw-500">${{ number_format($item['price'], 2) }}</td>
                                    <td class="py-4">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="quantity-form d-flex align-items-center gap-2">
                                            @csrf
                                            <div class="input-group input-group-sm rounded-pill border overflow-hidden" style="width: 120px;">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                                    class="form-control border-0 text-center fw-bold" 
                                                    style="box-shadow: none;">
                                                <button type="submit" class="btn btn-primary border-0 px-3">
                                                    ✓
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="py-4 text-end pe-4 fw-bold text-primary">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 ps-4 py-4">
                    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-primary">
                        ← Continue Shopping
                    </a>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-lg-4" data-aos="fade-left">
            <div class="card border-0 shadow-lg p-4" style="border-radius: 20px; background: #fff; position: sticky; top: 100px;">
                <h4 class="fw-bold mb-4">Order Summary</h4>
                
                <div class="summary-details mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tax</span>
                        <span class="fw-bold">$0.00</span>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between">
                        <span class="h5 fw-bold">Total</span>
                        <span class="h5 fw-800 text-primary">${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <div class="checkout-actions d-grid gap-3">
                    @auth
                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg py-3 fw-bold" style="border-radius: 14px; font-size: 1.1rem;">
                            Go to Checkout
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg py-3 fw-bold" style="border-radius: 14px; font-size: 1.1rem;">
                            Login to Checkout
                        </a>
                    @endauth
                    
                    <div class="mt-3 text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" height="20" class="mx-2 opacity-50">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" height="15" class="mx-2 opacity-50">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" height="20" class="mx-2 opacity-50">
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3" style="font-size: 0.8rem;">
                    <p class="mb-0 text-muted">🛡️ <strong>Secure Checkout</strong>: Your data is protected by industry-standard encryption.</p>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .cart-item-image img {
        transition: transform 0.3s ease;
    }
    tr:hover .cart-item-image img {
        transform: scale(1.1);
    }
    .quantity-form .input-group:focus-within {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
</style>
@endsection
