<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shendy | Premium Shopping')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --bs-primary: #0d6efd;
            --bs-primary-rgb: 13, 110, 253;
            --bs-link-color: #0d6efd;
            --bs-link-hover-color: #0a58ca;
            --bs-btn-hover-bg: #0b5ed7;
            --bs-btn-hover-border-color: #0a58ca;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
        }
        
        /* FORCE BLUE ON ALL TEXT/BG UTILITIES */
        .text-primary { color: #0d6efd !important; }
        .bg-primary { background-color: #0d6efd !important; }
        .text-warning { color: #ffc107 !important; } /* Reset warning to yellow, not orange */
        
        /* FORMS - NUCLEAR OPTION */
        .form-control:focus, .form-select:focus, .form-check-input:focus:checked {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        }
        .form-check-input:checked {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        /* BUTTONS */
        .btn-primary {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            background-image: linear-gradient(180deg, rgba(255,255,255,0.1), rgba(255,255,255,0)) !important;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
            background-image: none !important;
        }
        .btn-outline-primary {
            color: #0d6efd !important;
            border-color: #0d6efd !important;
        }
        .btn-outline-primary:hover {
            background-color: #0d6efd !important;
            color: #fff !important;
        }

        /* NAVIGATION & LINKS */
        a { color: #0d6efd; transition: color 0.15s ease-in-out; }
        a:hover { color: #0a58ca; }
        .nav-link:hover, .nav-link.active {
            color: #0d6efd !important;
        }
        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        }
        
        /* SPECIFIC OVERRIDES */
        .hover-primary:hover { color: #0d6efd !important; }
        .swiper-pagination-bullet-active { background: #0d6efd !important; }
        .text-primary-gradient { 
            background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%) !important; 
            -webkit-background-clip: text !important; 
            -webkit-text-fill-color: transparent !important; 
        }
        
        /* NAVBAR SPECIFIC */
        .navbar-light .navbar-nav .nav-link.active, 
        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .show > .nav-link {
            color: #0d6efd !important;
        }
        .navbar-brand span { color: #0d6efd !important; }
        
        /* CART BADGE */
        .badge.bg-primary { background-color: #0d6efd !important; }
        .cart-count-badge { background-color: #0d6efd !important; }
        
        /* DROPDOWN ITEMS */
        .dropdown-item:active, .dropdown-item:hover {
            background-color: #0d6efd !important;
            color: #fff !important;
        }

        /* SELECTION */
        ::selection {
            background: rgba(13, 110, 253, 0.2);
            color: #0d6efd;
        }

        /* LOGO & SEARCH HOVERS */
        .logo:hover { color: #1a1a1a !important; }
        .search-btn:hover { background: #0d6efd !important; }
        .search-input:focus {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
        }

        /* NAVIGATION HOVERS */
        .site-header nav ul li a {
            color: #555;
            transition: all 0.2s ease;
        }
        .site-header nav ul li a:hover {
            color: #0d6efd !important;
        }
        
        /* FOOTER LINK HOVERS */
        footer a:hover {
            color: #0d6efd !important;
        }

        /* ACTIVE STATES */
        .site-header nav ul li a.active {
            color: #0d6efd !important;
        }
    </style>
</head>
<body>
    @auth
        @if(auth()->user()->is_admin)
            <div class="admin-mode-ribbon shadow-sm d-flex align-items-center justify-content-between px-4 py-2" 
                 style="background: #111; color: #fff; font-size: 0.85rem; border-bottom: 2px solid #0d6efd; z-index: 2000;">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge" style="background: #0d6efd; font-size: 0.7rem;">ADMIN VIEW</span>
                    <span class="fw-500">Browsing storefront as administrator</span>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary fw-bold px-3 py-1" style="font-size: 0.75rem; border-radius: 6px; background: #0d6efd; border: none;">
                    <i class="bi bi-speedometer2 me-1"></i> Dashboard Console
                </a>
            </div>
        @endif
    @endauth

    <header class="site-header">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1.5rem;">
                <a href="{{ route('home') }}" class="logo">Shendy</a>
                
                <div class="search-container flex-grow-1 d-md-block d-none" style="max-width: 600px;">
                    <form action="{{ route('search') }}" method="GET" class="d-flex">
                        <input type="text" name="q" placeholder="What are you looking for today?..." value="{{ request('q') }}" class="form-control search-input">
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </div>

                <nav>
                    <ul class="d-flex align-items-center list-unstyled mb-0" style="gap: 1.5rem;">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        @auth
                            @if(!auth()->user()->is_admin)
                                <li class="d-none d-lg-block">
                                    <a href="{{ route('cart.index') }}" class="position-relative d-flex align-items-center gap-1">
                                        <i class="bi bi-cart3 fs-5"></i>
                                        @php $cartCount = count(session('cart', [])); @endphp
                                        @if($cartCount > 0)
                                            <span class="badge bg-primary position-absolute top-0 start-100 translate-middle rounded-pill" style="font-size: 0.6rem;">{{ $cartCount }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif

                            <!-- Account Dropdown -->
                            <li class="nav-item dropdown px-2" style="list-style: none;">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2 bg-light rounded-pill" 
                                   href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                   style="border: 1px solid rgba(13, 110, 253, 0.1); font-weight: 700; color: #333 !important;">
                                    <div class="avatar-small rounded-circle bg-primary d-flex align-items-center justify-content-center text-white" 
                                         style="width: 28px; height: 28px; font-size: 0.8rem; background: #0d6efd !important;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="d-none d-md-inline">My Account</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3 mt-2" aria-labelledby="accountDropdown" style="border-radius: 16px; min-width: 250px; z-index: 2000;">
                                    <li class="px-3 py-2 mb-2 border-bottom">
                                        <div class="fw-800 text-dark">{{ Auth::user()->name }}</div>
                                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                                    </li>
                                    
                                    @if(auth()->user()->is_admin)
                                        <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-speedometer2 text-primary"></i> Admin Dashboard</a></li>
                                    @else
                                        <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('orders.index') }}">
                                            <i class="bi bi-bag-fill text-primary"></i> My Orders</a></li>
                                        <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('cart.index') }}">
                                            <i class="bi bi-cart-fill text-primary"></i> My Cart</a></li>
                                    @endif

                                    <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="{{ route('password.manual.request') }}">
                                        <i class="bi bi-shield-lock-fill text-primary"></i> Security Settings</a></li>
                                    
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger">
                                                <i class="bi bi-box-arrow-right"></i> Sign Out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 12px; font-size: 0.85rem;">Login / Sign Up</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>

            <!-- Mobile Search (only visible on small screens) -->
            <div class="search-container d-md-none mt-3">
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}" class="form-control search-input">
                    <button type="submit" class="search-btn">Find</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="container" style="padding: 2.5rem 0;">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px; border-left: 4px solid #28a745;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; border-left: 4px solid #dc3545;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer style="background: #111; color: #888; padding: 5rem 0 3rem; margin-top: 5rem; border-top: 1px solid #222;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h4 class="text-white mb-4 fw-800">Shendy<span class="text-primary">Store</span></h4>
                    <p class="mb-4" style="line-height: 1.8;">Your ultimate destination for premium tech and lifestyle products. We combine quality with affordability to deliver excellence to your doorstep.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-5 hover-primary transition-all"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-5 hover-primary transition-all"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-5 hover-primary transition-all"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="text-primary mb-4 fw-bold text-uppercase small">Shop</h6>
                    <ul class="list-unstyled d-grid gap-2">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-white transition-all">All Products</a></li>
                        <li><a href="#" class="text-decoration-none text-white transition-all">Best Sellers</a></li>
                        <li><a href="#" class="text-decoration-none text-white transition-all">New Arrivals</a></li>
                        <li><a href="#" class="text-decoration-none text-white transition-all">Special Offers</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="text-primary mb-4 fw-bold text-uppercase small">Company</h6>
                    <ul class="list-unstyled d-grid gap-2">
                        <li><a href="{{ route('about') }}" class="text-decoration-none text-white transition-all">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none text-white transition-all">Contact</a></li>
                        <li><a href="#" class="text-decoration-none text-white transition-all">Careers</a></li>
                        <li><a href="#" class="text-decoration-none text-white transition-all">Press Info</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-white mb-4 fw-bold text-uppercase small">Newsletter</h6>
                    <p class="small mb-4">Be the first to know about new collections and exclusive offers.</p>
                    <div class="input-group mb-3 newsletter-input">
                        <input type="email" class="form-control bg-transparent border-secondary text-white shadow-none" placeholder="Your email address" style="border-radius: 12px 0 0 12px;">
                        <button class="btn btn-primary px-4 fw-bold" type="button" style="border-radius: 0 12px 12px 0;">Join</button>
                    </div>
                    <div class="d-flex align-items-center gap-2 small text-muted">
                        <i class="bi bi-shield-check text-success"></i>
                        <span>Secure & private. No spam ever.</span>
                    </div>
                </div>
            </div>
            <hr class="my-5" style="border-color: #222;">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 small">&copy; {{ date('Y') }} Shendy Inc. Crafted for excellence.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="d-flex justify-content-center justify-content-md-end gap-4 small">
                        <a href="#" class="text-decoration-none text-white transition-all">Terms</a>
                        <a href="#" class="text-decoration-none text-white transition-all">Privacy</a>
                        <a href="#" class="text-decoration-none text-white transition-all">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>
</html>
