@extends('layouts.admin')

@section('title', 'Manage Orders | MarketHub')

@section('admin-content')
<div class="mb-5">
    <h1 class="display-5 fw-800 mb-2">Order Management</h1>
    <p class="text-muted">Track and process customer orders and shipments.</p>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Order ID</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Customer</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Total</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted text-center" style="font-size: 0.75rem;">Status</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Date</th>
                    <th class="pe-4 py-3 border-0 text-uppercase fw-bold text-muted text-end" style="font-size: 0.75rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold">#{{ $order->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ substr($order->user->name, 0, 1) }}
                                </div>
                                <div>{{ $order->user->name }}</div>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">
                            ${{ number_format($order->total, 2) }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" id="status-form-{{ $order->id }}">
                                @csrf
                                @php
                                    $statusColor = [
                                        'pending' => 'warning',
                                        'processing' => 'info',
                                        'shipped' => 'primary',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger'
                                    ][$order->status] ?? 'secondary';
                                @endphp
                                <select name="status" onchange="this.form.submit()" 
                                    class="form-select form-select-sm border-0 bg-{{ $statusColor }}-soft text-{{ $statusColor }} fw-bold text-center" 
                                    style="width: 130px; margin: 0 auto; background-color: rgba(var(--bs-{{ $statusColor }}-rgb), 0.1);">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td class="pe-4 text-end">
                            <button class="btn btn-sm btn-light border fw-bold" onclick="toggleOrderDetails({{ $order->id }})">
                                Details <i class="bi bi-chevron-down ms-1"></i>
                            </button>
                        </td>
                    </tr>
                    <tr id="order-details-{{ $order->id }}" style="display: none;">
                        <td colspan="6" class="p-0 border-0">
                            <div class="bg-light p-4 mx-4 mb-4 rounded-4 shadow-inner">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h6 class="fw-bold text-uppercase small text-muted mb-3">Shipping Details</h6>
                                        <div class="p-3 bg-white rounded-3 border">
                                            <div class="mb-2">
                                                <i class="bi bi-geo-alt text-primary me-2"></i> {{ $order->shipping_address }}
                                            </div>
                                            <div class="pt-2 border-top">
                                                <i class="bi bi-telephone text-success me-2"></i> <span class="fw-bold">{{ $order->phone ?? 'No phone' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="fw-bold text-uppercase small text-muted mb-3">Order Items</h6>
                                        <div class="table-responsive bg-white rounded-3 border">
                                            <table class="table table-sm align-middle mb-0">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th class="ps-3">Product</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-end pe-3">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                        <tr>
                                                            <td class="ps-3">{{ $item->product->name }}</td>
                                                            <td class="text-center">{{ $item->quantity }}</td>
                                                            <td class="text-end pe-3">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-5 text-center text-muted">
                            <i class="bi bi-receipt display-4 d-block mb-3 opacity-25"></i>
                            No orders processed yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleOrderDetails(orderId) {
    var details = document.getElementById('order-details-' + orderId);
    if (details.style.display === 'none') {
        details.style.display = 'table-row';
    } else {
        details.style.display = 'none';
    }
}
</script>
@endsection
