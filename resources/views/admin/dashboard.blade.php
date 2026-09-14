@extends('layouts.admin')

@section('title', 'Admin Dashboard | Shendy')

@section('admin-content')
<div class="mb-5">
    <h1 class="display-5 fw-800 mb-2">Dashboard</h1>
    <p class="text-muted">Overview of your store's performance and activity.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 text-center rounded-4 h-100">
            <div class="mb-2 text-primary">
                <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
            </div>
            <div class="h3 fw-800 mb-1">{{ $totalProducts }}</div>
            <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Products</div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 text-center rounded-4 h-100">
            <div class="mb-2 text-success">
                <i class="bi bi-currency-dollar" style="font-size: 2rem;"></i>
            </div>
            <div class="h3 fw-800 mb-1">{{ $totalOrders }}</div>
            <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Orders</div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 text-center rounded-4 h-100">
            <div class="mb-2 text-info">
                <i class="bi bi-people" style="font-size: 2rem;"></i>
            </div>
            <div class="h3 fw-800 mb-1">{{ $totalUsers }}</div>
            <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Users</div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 text-center rounded-4 h-100">
            <div class="mb-2 text-danger">
                <i class="bi bi-clock-history" style="font-size: 2rem;"></i>
            </div>
            <div class="h3 fw-800 mb-1">{{ $pendingOrders }}</div>
            <div class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Pending Orders</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-5 rounded-4 bg-white mb-4">
    <div class="d-flex align-items-center mb-4 gap-2">
        <i class="bi bi-lightning-charge text-warning h4 mb-0"></i>
        <h3 class="fw-bold mb-0">Quick Actions</h3>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark w-100 py-4 fw-bold rounded-4 shadow-sm hover-up">
                <i class="bi bi-pencil-square me-2"></i> Manage Products
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark w-100 py-4 fw-bold rounded-4 shadow-sm hover-up">
                <i class="bi bi-tags me-2"></i> Manage Categories
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.orders') }}" class="btn btn-outline-dark w-100 py-4 fw-bold rounded-4 shadow-sm hover-up">
                <i class="bi bi-list-check me-2"></i> View Orders
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary w-100 py-4 fw-bold rounded-4 shadow-sm hover-up">
                <i class="bi bi-plus-circle me-2"></i> Add New Product
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary w-100 py-4 fw-bold rounded-4 shadow-sm hover-up">
                <i class="bi bi-plus-circle me-2"></i> Add New Category
            </a>
        </div>
    </div>
</div>

<style>
    .hover-up {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
