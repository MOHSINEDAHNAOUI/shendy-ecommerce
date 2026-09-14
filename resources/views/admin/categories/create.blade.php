@extends('layouts.admin')

@section('title', 'Add New Category | MarketHub')

@section('admin-content')
<div class="mb-5">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-link text-muted p-0 mb-3 text-decoration-none">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
    <h1 class="display-5 fw-800 mb-2">New Category</h1>
    <p class="text-muted">Create a new classification for your product catalog.</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label fw-bold small text-uppercase text-muted">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg border-2 shadow-none" 
                           placeholder="e.g. Electronics, Fashion, etc." value="{{ old('name') }}" required 
                           style="border-radius: 12px; font-size: 1rem;">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="form-label fw-bold small text-uppercase text-muted">Description</label>
                    <textarea name="description" id="description" class="form-control border-2 shadow-none" 
                              rows="4" placeholder="Briefly describe what this category represents..." 
                              style="border-radius: 12px;">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary px-5 py-3 fw-bold shadow-sm" style="border-radius: 15px;">
                        <i class="bi bi-check-circle me-1"></i> Create Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light px-4 py-3 fw-bold text-muted" style="border-radius: 15px;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
</style>
@endsection