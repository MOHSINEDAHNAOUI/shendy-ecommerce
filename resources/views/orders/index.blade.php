@extends('layouts.app')

@section('title', 'My Order History | Shendy')

@section('content')
<div class="orders-container py-4">
    <div class="mb-5">
        <h1 class="display-5 fw-800 mb-2">My Orders</h1>
        <p class="text-muted">Tracking and history of your recent purchases.</p>
    </div>

    @if($orders->isEmpty())
        <div class="card border-0 shadow-sm p-5 text-center rounded-4">
            <div class="mb-4 mx-auto" style="width: 80px; height: 80px; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-bag-x text-muted" style="font-size: 2.5rem;"></i>
            </div>
            <h4 class="fw-bold mb-3">No orders found</h4>
            <p class="text-muted mb-4">You haven't placed any orders yet. Start exploring our premium collection today!</p>
            <a href="{{ route('home') }}" class="btn btn-primary px-5 py-3 fw-bold shadow-sm" style="border-radius: 15px; background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%); border: none;">
                Start Shopping
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden transition-all duration-300 hover-shadow" style="background: white; transition: transform 0.2s ease;">
                        <div class="card-body p-4 p-md-5">
                            <div class="row align-items-center">
                                <div class="col-lg-3 mb-4 mb-lg-0">
                                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Placed On</h6>
                                    <p class="m-0 fw-600 text-dark">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="col-lg-2 mb-4 mb-lg-0">
                                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Total Amount</h6>
                                    <h4 class="m-0 fw-800 text-primary">${{ number_format($order->total, 2) }}</h4>
                                </div>
                                <div class="col-lg-2 mb-4 mb-lg-0">
                                    <h6 class="text-muted small text-uppercase fw-bold mb-1">Status</h6>
                                    <span class="badge rounded-pill px-3 py-2 fw-bold 
                                        @if($order->status == 'pending') bg-warning text-dark
                                        @elseif($order->status == 'processing') bg-info text-white
                                        @elseif($order->status == 'shipped') bg-primary text-white
                                        @elseif($order->status == 'delivered') bg-success text-white
                                        @else bg-danger text-white
                                        @endif
                                    ">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="col-lg-3 text-lg-end d-flex flex-column align-items-lg-end gap-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-dark px-4 py-2 fw-bold w-100 w-lg-auto" style="border-radius: 12px; transition: all 0.2s;">
                                        View Details <i class="bi bi-chevron-right ms-1"></i>
                                    </a>
                                    <a href="{{ route('orders.downloadPdf', $order->id) }}" class="btn btn-outline-dark px-4 py-2 fw-bold w-100 w-lg-auto btn-hover-blue" style="border-radius: 12px; transition: all 0.2s;">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Download Receipt
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
    }
    
    .btn-hover-blue:hover {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }
</style>
@endsection
