@extends('layouts.admin')

@section('title', 'Add New Product | Shendy')

@section('admin-content')
<div class="mb-5">
    <a href="{{ route('admin.products.index') }}" class="btn btn-link text-muted p-0 mb-3 text-decoration-none">
        <i class="bi bi-arrow-left"></i> Back to Products
    </a>
    <h1 class="display-5 fw-800 mb-2">Create New Product</h1>
    <p class="text-muted">Fill in the details below to add a new item to your storefront.</p>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <!-- Left Column: Primary Details -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4 rounded-4">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-info-circle text-primary me-2"></i> Basic Information
                </h5>
                
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold small text-uppercase text-muted">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg border-2" 
                           placeholder="e.g. Premium Wireless Headphones" value="{{ old('name') }}" required 
                           style="border-radius: 12px; font-size: 1rem;">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="description" class="form-label fw-bold small text-uppercase text-muted">Product Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control border-2" rows="6" 
                              placeholder="Describe your product's key features, specifications, and benefits..." 
                              required style="border-radius: 12px;">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-box-seam text-primary me-2"></i> Inventory & Stock
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="stock" class="form-label fw-bold small text-uppercase text-muted">Stock Quantity <span class="text-danger">*</span></label>
                        <div class="input-group border-2 rounded-3 overflow-hidden">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-stack"></i></span>
                            <input type="number" name="stock" id="stock" class="form-control border-0 bg-light py-2" 
                                   min="0" placeholder="0" value="{{ old('stock') }}" required>
                        </div>
                        @error('stock')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold small text-uppercase text-muted">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select border-2 py-2" required style="border-radius: 10px;">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Secondary Details (Media & Pricing) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 mb-4 rounded-4">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-currency-dollar text-primary me-2"></i> Pricing
                </h5>
                <div class="mb-0">
                    <label for="price" class="form-label fw-bold small text-uppercase text-muted">Sale Price <span class="text-danger">*</span></label>
                    <div class="input-group border-2 rounded-3 overflow-hidden shadow-none">
                        <span class="input-group-text bg-primary text-white border-0 fw-bold">$</span>
                        <input type="number" name="price" id="price" class="form-control border-0 bg-light py-2 fw-bold" 
                               step="0.01" min="0" placeholder="0.00" value="{{ old('price') }}" required>
                    </div>
                    <div class="form-text mt-2 small text-muted">Set the base price for this product.</div>
                    @error('price')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 mb-4 rounded-4">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-image text-primary me-2"></i> Main Thumbnail
                </h5>
                <div class="image-upload-wrapper text-center">
                    <div id="image-preview-container" class="mb-3 rounded-4 bg-light d-flex align-items-center justify-content-center border-dashed overflow-hidden" 
                         style="height: 200px; border: 2px dashed #dee2e6;">
                        <div id="preview-placeholder">
                            <i class="bi bi-cloud-upload fs-1 text-muted d-block mb-2"></i>
                            <span class="text-muted small">Choose Main Image</span>
                        </div>
                        <img id="image-preview" src="#" alt="Preview" class="w-100 h-100 object-fit-cover d-none">
                    </div>
                    <label for="image" class="btn btn-outline-primary w-100 py-2 fw-bold" style="border-radius: 10px;">
                        <i class="bi bi-plus-lg me-1"></i> Main Image
                    </label>
                    <input type="file" name="image" id="image" class="invisible position-absolute" accept="image/*" onchange="previewImage(this)">
                    @error('image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-images text-primary me-2"></i> Gallery Images
                </h5>
                <div class="gallery-upload-wrapper">
                    <label for="images" class="btn btn-light w-100 py-3 border-2 border-dashed d-flex flex-column align-items-center justify-content-center" 
                           style="border-radius: 12px; border-style: dashed !important;">
                        <i class="bi bi-plus-circle fs-3 text-muted mb-2"></i>
                        <span class="text-muted fw-bold">Add Gallery Images</span>
                        <span class="text-muted small">You can select multiple files</span>
                    </label>
                    <input type="file" name="images[]" id="images" class="invisible position-absolute" accept="image/*" multiple onchange="previewGallery(this)">
                    <div id="gallery-preview" class="row g-2 mt-3"></div>
                </div>
                @error('images.*')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm mb-3" style="border-radius: 15px;">
                    <i class="bi bi-check-circle me-1"></i> Create Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light w-100 py-3 fw-bold text-muted" style="border-radius: 15px;">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</form>

<script>
function previewImage(input) {
    const container = document.getElementById('image-preview-container');
    const placeholder = document.getElementById('preview-placeholder');
    const preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
            container.style.borderStyle = 'solid';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "#";
        preview.classList.add('d-none');
        placeholder.classList.remove('d-none');
        container.style.borderStyle = 'dashed';
    }
}

function previewGallery(input) {
    const preview = document.getElementById('gallery-preview');
    preview.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `
                    <div class="ratio ratio-1x1 rounded-3 overflow-hidden border">
                        <img src="${e.target.result}" class="object-fit-cover">
                    </div>
                `;
                preview.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
    .border-dashed {
        transition: all 0.3s ease;
    }
</style>
@endsection
