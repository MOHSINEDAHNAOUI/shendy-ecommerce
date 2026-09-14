@extends('layouts.app')

@section('title', $product->name . ' | MarketHub Premium')

@section('content')
<div class="container py-4">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}?category={{ $product->category_id }}" class="text-decoration-none text-muted">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Left Column: Image Gallery -->
        <div class="col-lg-6" data-aos="fade-right">
            <div class="product-gallery-container p-3 bg-white rounded-4 shadow-sm">
                <!-- Main Slider -->
                <div class="swiper gallery-top rounded-4 mb-3 overflow-hidden" style="background: #fdfdfd;">
                    <div class="swiper-wrapper">
                        @if($product->image)
                            <div class="swiper-slide d-flex align-items-center justify-content-center p-4">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid main-product-img">
                            </div>
                        @endif
                        @foreach($product->images as $img)
                            <div class="swiper-slide d-flex align-items-center justify-content-center p-4">
                                <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}" class="img-fluid main-product-img">
                            </div>
                        @endforeach
                        
                        @if(!$product->image && $product->images->isEmpty())
                            <div class="swiper-slide d-flex align-items-center justify-content-center p-5 text-muted">
                                <div class="text-center">
                                    <i class="bi bi-image fs-1 opacity-25"></i>
                                    <p class="mt-2">No product images available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                <!-- Thumbnails -->
                @if($product->images->count() > 0 || $product->image)
                    <div class="swiper gallery-thumbs px-1">
                        <div class="swiper-wrapper">
                            @if($product->image)
                                <div class="swiper-slide thumb-slide rounded-3 overflow-hidden">
                                    <img src="{{ asset($product->image) }}" alt="Thumbnail">
                                </div>
                            @endif
                            @foreach($product->images as $img)
                                <div class="swiper-slide thumb-slide rounded-3 overflow-hidden">
                                    <img src="{{ asset($img->image_path) }}" alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Product Info -->
        <div class="col-lg-6" data-aos="fade-left">
            <div class="product-details-info">
                <div class="mb-3">
                    <span class="badge bg-light text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2 border border-primary-subtle" style="font-size: 0.7rem;">
                        {{ $product->category->name }}
                    </span>
                    <h1 class="display-5 fw-800 text-dark mb-2">{{ $product->name }}</h1>
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-muted small fw-500">(1,248 customer reviews)</span>
                    </div>
                </div>

                <div class="price-box mb-4 p-3 rounded-4 bg-light border-0 d-flex align-items-baseline gap-2">
                    <span class="fs-4 fw-600 text-muted">$</span>
                    <span class="display-4 fw-800 text-primary">{{ number_format($product->price, 2) }}</span>
                    <span class="ms-auto badge {{ $product->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2 rounded-pill fw-bold" style="font-size: 0.75rem;">
                        <i class="bi {{ $product->stock > 0 ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </div>

                <div class="description-section mb-5">
                    <h5 class="fw-800 mb-3 text-dark border-bottom pb-2">Description</h5>
                    <p class="text-muted lh-lg" style="font-size: 1.05rem;">
                        {{ $product->description ?: 'No detailed description available for this premium product. Our curation process ensures the highest quality standards.' }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="actions-section d-grid gap-3 p-4 bg-white rounded-4 shadow-sm border">
                    <div class="d-flex align-items-center gap-4 mb-2">
                        <div class="quantity-selector d-flex align-items-center border rounded-pill px-2 py-1 bg-light">
                            <button class="btn btn-sm btn-link text-dark text-decoration-none fw-bold px-3">-</button>
                            <span class="px-3 fw-800">1</span>
                            <button class="btn btn-sm btn-link text-dark text-decoration-none fw-bold px-3">+</button>
                        </div>
                        <span class="text-muted small fw-600">{{ $product->stock }} items available</span>
                    </div>

                    <div class="row g-2">
                        <div class="col-8">
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-800 rounded-4 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(90deg, #ff9000 0%, #ff4400 100%); border: none;">
                                        <i class="bi bi-cart-plus-fill fs-5"></i>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-lg w-100 py-3 fw-800 rounded-4 disabled border-0">
                                    <i class="bi bi-slash-circle me-2"></i> Currently Unavailable
                                </button>
                            @endif
                        </div>
                        <div class="col-4 text-end">
                            <button class="btn btn-outline-dark btn-lg w-100 py-3 rounded-4 d-flex align-items-center justify-content-center">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="mt-5 d-flex flex-wrap gap-4 text-muted small fw-500 opacity-75">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-truck fs-5 text-primary"></i>
                        <span>Express Shipping</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shield-lock-fill fs-5 text-primary"></i>
                        <span>Secure Payments</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-counterclockwise fs-5 text-primary"></i>
                        <span>30 Days Return</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb-item { font-size: 0.85rem; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.2rem; line-height: 0.8; vertical-align: middle; }

    .gallery-top {
        height: 500px;
        position: relative;
    }
    
    .main-product-img {
        max-height: 480px;
        width: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .gallery-top:hover .main-product-img {
        transform: scale(1.05);
    }

    .gallery-thumbs {
        height: 100px;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .thumb-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .thumb-slide img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #f8f9fa;
    }

    .swiper-slide-thumb-active {
        opacity: 1;
        border-color: #ff4400;
    }

    .display-5 { font-weight: 800; letter-spacing: -1.5px; }
    .fw-800 { font-weight: 800; }
    .fw-600 { font-weight: 600; }
    
    .price-box {
        background: rgba(255, 68, 0, 0.03) !important;
        border: 1px dashed rgba(255, 68, 0, 0.2) !important;
    }

    .swiper-button-next, .swiper-button-prev {
        color: #ff4400;
        background: rgba(255,255,255,0.8);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 1.2rem;
        font-weight: 800;
    }

    @media (max-width: 991px) {
        .gallery-top { height: 400px; }
        .display-5 { font-size: 2.25rem; }
    }
</style>
@endsection