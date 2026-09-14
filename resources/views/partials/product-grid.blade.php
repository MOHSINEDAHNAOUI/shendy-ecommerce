@if($products->isEmpty())
    <div class="col-12 py-5">
        <div class="card p-5 text-center border-0 shadow-sm rounded-4 bg-white">
            <div class="mb-4 mx-auto d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px; background: #fff; border-radius: 50%;">
                <i class="bi bi-search text-primary opacity-50" style="font-size: 2rem;"></i>
            </div>
            <h4 class="fw-800 text-dark mb-2">No matching products found</h4>
            <p class="text-muted">Try refining your search or clearing filters to discover more.</p>
            <div class="mt-4">
                <button type="button" onclick="document.getElementById('reset-filters').click()" class="btn btn-outline-primary fw-bold px-4 py-2 rounded-pill">Clear All Filters</button>
            </div>
        </div>
    </div>
@else
    <div class="row g-4 overflow-visible">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-xl-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 6) * 50 }}">
                <div class="product-card-premium h-100 position-relative">
                    <!-- Image Wrapper -->
                    <div class="image-container overflow-hidden rounded-4 mb-3 position-relative" style="background: #fdfdfd; padding-top: 100%;">
                        <a href="{{ route('product.show', $product->id) }}" class="d-block position-absolute top-0 start-0 w-100 h-100 p-4 d-flex align-items-center justify-content-center">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid product-main-thumb" loading="lazy">
                            @else
                                <div class="text-muted small opacity-25 text-center">
                                    <i class="bi bi-image fs-1 d-block mb-2"></i> No Image
                                </div>
                            @endif
                        </a>
                        
                        <!-- Premium Badges -->
                        @if($product->stock == 0)
                            <div class="position-absolute top-3 start-3" style="z-index: 5; top: 15px; left: 15px;">
                                <span class="badge bg-dark px-3 py-2 fw-bold text-uppercase shadow-sm" style="font-size: 0.65rem; opacity: 0.9;">Sold Out</span>
                            </div>
                        @elseif($product->created_at > now()->subDays(14))
                            <div class="position-absolute top-3 start-3" style="z-index: 5; top: 15px; left: 15px;">
                                <span class="badge bg-primary px-3 py-2 fw-bold text-uppercase shadow-sm" style="font-size: 0.65rem;">New Arrival</span>
                            </div>
                        @endif

                        <!-- Quick Actions -->
                        <div class="quick-actions-overlay">
                            <button class="action-btn" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                            <button class="action-btn" title="Quick View"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="product-details px-1">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="text-muted fw-600 extra-small text-uppercase tracking-wider">{{ $product->category->name }}</span>
                            <div class="rating-stars small text-warning">
                                <i class="bi bi-star-fill"></i>
                                <span class="text-muted ms-1">(4.8)</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none d-block mb-2">
                            <h5 class="product-title-premium fw-700 text-dark mb-1">{{ Str::limit($product->name, 45) }}</h5>
                        </a>

                        <div class="d-flex align-items-center justify-content-between mt-3 mb-2">
                            <div class="product-price-premium">
                                <span class="currency fs-6 fw-bold text-primary">$</span>
                                <span class="amount h4 fw-800 text-dark mb-0">{{ number_format($product->price, 2) }}</span>
                            </div>
                            
                            @if(!auth()->check() || !auth()->user()->is_admin)
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn-add-to-cart-premium shadow-sm" title="Add to Cart">
                                            <i class="bi bi-plus-lg"></i> Add to cart
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                        
                        <!-- Stock Status Progress bar (Subtle) -->
                        <div class="mt-3">
                            <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 0.7rem;">
                                <span class="fw-600">{{ $product->stock > 0 ? 'Stock Available' : 'Waitlist Open' }}</span>
                                <span class="fw-800 text-dark">{{ $product->stock }} items</span>
                            </div>
                            <div class="progress" style="height: 3px; background: #eee;">
                                @php $stock_pct = min(100, max(0, ($product->stock / 20) * 100)); @endphp
                                <div class="progress-bar {{ $product->stock < 5 ? 'bg-danger' : 'bg-primary' }}" style="width: {{ $stock_pct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Enhanced Pagination -->
    <div class="mt-5 pt-4 border-top">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 ajax-pagination">
            <div class="pagination-wrapper overflow-auto pb-1 w-100 w-md-auto">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endif

<style>
    .product-card-premium {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        padding: 10px;
        border-radius: 20px;
    }
    
    .product-card-premium:hover {
        transform: translateY(-8px);
        background: #fff;
        box-shadow: 0 15px 40px rgba(0,0,0,0.06);
    }
    
    .product-main-thumb {
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        max-height: 80%;
        object-fit: contain;
    }
    
    .product-card-premium:hover .product-main-thumb {
        transform: scale(1.1);
    }
    
    .quick-actions-overlay {
        position: absolute;
        right: 15px;
        top: 15px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .product-card-premium:hover .quick-actions-overlay {
        opacity: 1;
        transform: translateX(0);
    }
    
    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: none;
        background: #fff;
        color: #222;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        background: #0d6efd;
        color: #fff;
    }
    
    .product-title-premium {
        font-size: 1.05rem;
        transition: color 0.2s ease;
        line-height: 1.3;
    }
    
    .btn-add-to-cart-premium {
        background: #fff;
        border: 2px solid #0d6efd;
        color: #0d6efd;
        padding: 6px 16px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }
    
    .btn-add-to-cart-premium:hover {
        background: #0d6efd;
        color: #fff;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    }
    
    .extra-small { font-size: 0.65rem; }
    .tracking-wider { letter-spacing: 0.05em; }
    .fw-700 { font-weight: 700; }
    .fw-800 { font-weight: 800; }

    .pagination-wrapper .pagination {
        margin: 0;
    }
    .pagination-wrapper .page-item .page-link {
        border-radius: 10px;
        margin: 0 3px;
        border: none;
        background: #f8f9fa;
        color: #666;
        padding: 8px 16px;
        font-weight: 600;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: #0d6efd;
        color: #fff;
    }
</style>
