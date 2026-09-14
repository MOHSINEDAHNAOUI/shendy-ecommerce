@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' Details | Shendy')

@section('content')
<div class="order-details-container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('orders.index') }}" class="btn btn-link text-muted p-0 text-decoration-none">
            <i class="bi bi-arrow-left"></i> Back to My Orders
        </a>
        <a href="{{ route('orders.downloadPdf', $order->id) }}" class="btn btn-primary">
            <i class="bi bi-file-earmark-pdf"></i> Download PDF
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Order Status & Items -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-4 border-bottom">
                        <div>
                            <p class="text-muted m-0">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <span class="badge rounded-pill px-4 py-2 fw-bold 
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

                    <h4 class="fw-bold mb-4">Order Items</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="text-muted small text-uppercase fw-bold">
                                <tr>
                                    <th class="ps-0" style="min-width: 300px;">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end pe-0">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr class="border-bottom">
                                        <td class="ps-0 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-3 overflow-hidden bg-light" style="width: 60px; height: 60px; flex-shrink: 0;">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-100 h-100 object-fit-cover">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small">No Img</div>
                                                    @endif
                                                </div>
                                                <div class="overflow-hidden">
                                                    <h6 class="fw-bold mb-0 text-truncate" title="{{ $item->product->name ?? 'Deleted Product' }}">
                                                        {{ $item->product->name ?? 'Product no longer available' }}
                                                    </h6>
                                                    @if($item->product)
                                                        <p class="text-muted small mb-0">{{ Str::limit($item->product->description, 50) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center fw-600">${{ number_format($item->price, 2) }}</td>
                                        <td class="text-center text-muted">{{ $item->quantity }}</td>
                                        <td class="text-end pe-0 fw-bold text-dark">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Shipping Info -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-geo-alt text-primary me-2"></i> Shipping Address
                    </h5>
                    <div class="p-3 bg-light rounded-3">
                        <p class="m-0 text-dark fw-500 mb-2" style="line-height: 1.6;">{{ $order->shipping_address }}</p>
                        <hr class="my-2 opacity-10">
                        <p class="m-0 text-dark fw-bold small text-uppercase" style="letter-spacing: 0.5px;">
                            <i class="bi bi-telephone text-primary me-2"></i> {{ $order->phone ?? 'No phone provided' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-600 text-dark">${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-800 m-0">Grand Total</h5>
                        <h3 class="fw-800 text-primary m-0">${{ number_format($order->total, 2) }}</h3>
                    </div>
                </div>
                <div class="bg-light p-4 border-top">
                    <p class="small text-muted mb-0 text-center">
                        <i class="bi bi-check-circle-fill text-success me-1"></i> 
                        Confirmed on {{ $order->created_at->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .object-fit-cover {
        object-fit: cover;
    }
    .fw-500 { font-weight: 500; }
    .table > :not(caption) > * > * {
        box-shadow: none !important;
    }
</style>
@endsection
