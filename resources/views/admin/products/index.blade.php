@extends('layouts.admin')

@section('title', 'Manage Products | MarketHub')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="display-5 fw-800 mb-2">Products</h1>
        <p class="text-muted">Maintain your inventory and product listings.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 12px;">
        <i class="bi bi-plus-lg me-1"></i> New Product
    </a>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">ID</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Product</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Category</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Price</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted text-center" style="font-size: 0.75rem;">Stock</th>
                    <th class="pe-4 py-3 border-0 text-uppercase fw-bold text-muted text-end" style="font-size: 0.75rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-light text-dark border fw-bold">#{{ $product->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-thumb rounded-3 border bg-light overflow-hidden" style="width: 48px; height: 48px;">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="font-size: 0.6rem;">N/A</div>
                                    @endif
                                </div>
                                <div class="fw-bold text-dark">{{ $product->name }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary-soft text-secondary px-2 py-1" style="font-size: 0.8rem; background-color: #f1f3f5;">{{ $product->category->name }}</span>
                        </td>
                        <td class="fw-bold text-primary">
                            ${{ number_format($product->price, 2) }}
                        </td>
                        <td class="text-center">
                            @if($product->stock <= 5)
                                <span class="badge bg-danger-soft text-danger border border-danger px-3 py-1" style="font-size: 0.8rem; background-color: #fff5f5;">{{ $product->stock }} <i class="bi bi-exclamation-triangle-fill ms-1"></i></span>
                            @else
                                <span class="badge bg-success-soft text-success border border-success px-3 py-1" style="font-size: 0.8rem; background-color: #f6fff9;">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-5 text-center text-muted">
                            <i class="bi bi-box2 display-4 d-block mb-3 opacity-25"></i>
                            No products found yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection