@extends('layouts.app')

@section('title', 'About Us | MarketHub Premium')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg p-5 rounded-4 bg-white" data-aos="fade-up">
            <div class="text-center mb-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill fw-bold text-uppercase mb-3" style="font-size: 0.7rem;">Our Story</span>
                <h1 class="fw-800 display-4 mb-3" style="letter-spacing: -2px;">Defining Premium <br><span class="text-primary">Lifestye</span></h1>
                <div class="mx-auto" style="width: 60px; height: 4px; background: #0d6efd; border-radius: 2px;"></div>
            </div>

            <div class="content-body" style="line-height: 1.8; color: #555; font-size: 1.1rem;">
                <p class="mb-4">Welcome to <strong>Shendy</strong>, your primary destination for high-end electronics, fashion, and lifestyle essentials. Founded in 2026, we have quickly grown from a small passionate team to a leading provider of premium products tailored for the modern consumer.</p>
                
                <h3 class="fw-700 text-dark mb-3 mt-5">Our Mission</h3>
                <p class="mb-4">To empower individuals by providing access to the latest innovations and trends without compromising on quality or service excellence. We believe that every purchase should be an experience, not just a transaction.</p>

                <div class="row g-4 my-5">
                    <div class="col-md-4 text-center">
                        <div class="p-4 rounded-4 bg-light h-100">
                            <i class="bi bi-shield-check text-primary fs-1 mb-3"></i>
                            <h5 class="fw-bold">Security</h5>
                            <p class="small mb-0">Your data and payments are always protected.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="p-4 rounded-4 bg-light h-100">
                            <i class="bi bi-truck text-primary fs-1 mb-3"></i>
                            <h5 class="fw-bold">Fast Delivery</h5>
                            <p class="small mb-0">Expedited shipping to your doorstep worldwide.</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="p-4 rounded-4 bg-light h-100">
                            <i class="bi bi-headset text-primary fs-1 mb-3"></i>
                            <h5 class="fw-bold">24/7 Support</h5>
                            <p class="small mb-0">Our experts are here to help you anytime.</p>
                        </div>
                    </div>
                </div>

                <h3 class="fw-700 text-dark mb-3">Why Choose Us?</h3>
                <p>We work directly with top brands and manufacturers to ensure that every item in our curated collection meets our rigorous standards for durability and design. At Shendy, we don't just follow trends—we set them.</p>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('home') }}" class="btn btn-primary px-5 py-3 fw-bold rounded-pill shadow">
                    Start Shopping Now
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
