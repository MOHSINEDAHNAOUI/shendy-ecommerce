<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel | Shendy</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --admin-primary: #0d6efd;
            --admin-primary-dark: #0a58ca;
            --admin-bg-light: #f7f9fc;
            --admin-card-shadow: 0 10px 30px rgba(0,0,0,0.04);
            --admin-sidebar-w: 280px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg-light);
            color: #1a1a1a;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Sidebar: Cohérent avec le style du site */
        .admin-sidebar {
            width: var(--admin-sidebar-w);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            height: calc(100vh - 40px);
            position: fixed;
            left: 20px;
            top: 20px;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 24px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar .brand-area {
            padding: 2.5rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .admin-sidebar .brand-logo {
            font-size: 1.75rem;
            font-weight: 800;
            color: #111;
            letter-spacing: -1.5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .admin-sidebar .brand-logo:hover {
            color: var(--admin-primary);
        }

        .admin-sidebar .nav-link {
            color: #555;
            padding: 0.75rem 1.25rem;
            margin: 0.25rem 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            border-radius: 14px;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .admin-sidebar .nav-link i {
            font-size: 1.15rem;
            opacity: 0.7;
            transition: all 0.2s ease;
        }

        .admin-sidebar .nav-link:hover {
            color: var(--admin-primary);
            background: rgba(13, 110, 253, 0.06);
            transform: translateX(4px);
        }

        .admin-sidebar .nav-link:hover i {
            opacity: 1;
        }

        .admin-sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        .admin-sidebar .nav-link.active i {
            opacity: 1;
            transform: scale(1.05);
        }

        .admin-main {
            margin-left: calc(var(--admin-sidebar-w) + 45px);
            padding: 20px 25px 40px 0;
            min-height: 100vh;
        }

        .admin-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            height: 75px;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-bottom: 2.5rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .admin-card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--admin-card-shadow);
            background: #fff;
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.06);
        }

        .fw-800 { font-weight: 800; }
        .text-admin { color: var(--admin-primary); }

        .btn-admin {
            background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%);
            color: #fff !important;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.75rem;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }
        
        .btn-admin:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #111;
        }

        @media (max-width: 1200px) {
            .admin-sidebar { width: 240px; }
            .admin-main { margin-left: 285px; }
        }

        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-320px); }
            .admin-main { margin-left: 0; padding-left: 20px; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="brand-area">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo text-decoration-none">
                Shendy<span class="text-admin">Store</span>
            </a>
            <div class="mt-1">
                <span class="badge bg-light text-dark fw-bold px-3 py-1 rounded-pill" style="font-size: 0.65rem; border: 1px solid #eee;">ADMIN CONSOLE</span>
            </div>
        </div>
        
        <div class="py-2">
            <nav class="nav flex-column">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-bag-fill"></i> Products
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-stack"></i> Categories
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <i class="bi bi-cart-check-fill"></i> Orders
                </a>
                
                <div class="px-4 mt-5 mb-2 small text-uppercase fw-800" style="color: #999; font-size: 0.65rem; letter-spacing: 1px;">Website Context</div>
                
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <i class="bi bi-globe"></i> View Storefront
                </a>
                
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="document.getElementById('logout-form').submit();" class="nav-link text-danger mt-0.">
                        <i class="bi bi-power"></i> Sign Out
                    </a>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="admin-main">
        <header class="admin-header">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 fw-bold">@yield('admin-title', 'Overview')</h5>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <p class="mb-0 fw-bold small text-dark">{{ auth()->user()->name }}</p>
                    <p class="mb-0 text-muted small" style="font-size: 0.7rem;">Administrator Access</p>
                </div>
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border: 1px solid #eee;">
                    <i class="bi bi-person-badge text-admin fs-5"></i>
                </div>
            </div>
        </header>

        <main class="p-4 p-md-5">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4 rounded-3 d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-3 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('admin-content')
        </main>

        <footer class="p-4 text-center text-muted small border-top bg-white mt-auto">
            &copy; {{ date('Y') }} Shendy Dashboard. System Version 2.4.1
        </footer>
    </div>
</body>
</html>
