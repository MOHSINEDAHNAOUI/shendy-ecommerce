@extends('layouts.app')

@section('title', 'Contact Us | Shendy Premium')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-lg-10">
        <div class="card border-0 shadow-lg overflow-hidden rounded-4 bg-white" data-aos="fade-up">
            <div class="row g-0">
                <!-- Info Side -->
                <div class="col-lg-5 p-5 bg-dark text-white d-flex flex-column justify-content-center">
                    <h2 class="fw-800 display-6 mb-4">Let's <span class="text-primary">Connect.</span></h2>
                    <p class="opacity-75 mb-5">Have a question about an order? Want to partner with us? Our team is ready to respond within 24 hours.</p>
                    
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <div class="p-3 bg-primary rounded-3 text-white">
                            <i class="bi bi-geo-alt fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Our Location</h6>
                            <p class="small opacity-75 mb-0">Bloc 05 Hay El Massira, Oued Zem, Maroc</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-4 mb-4">
                        <div class="p-3 bg-primary rounded-3 text-white">
                            <i class="bi bi-envelope fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Email Us</h6>
                            <p class="small opacity-75 mb-0">support@market.com</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <div class="p-3 bg-primary rounded-3 text-white">
                            <i class="bi bi-telephone fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Call Center</h6>
                            <p class="small opacity-75 mb-0">+ 212 6 00 00 00 00</p>
                        </div>
                    </div>
                </div>

                <!-- Form Side -->
                <div class="col-lg-7 p-5">
                    <h3 class="fw-800 text-dark mb-4">Send a Message</h3>
                    <form action="#" method="POST" id="contact-form">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Full Name</label>
                                <input type="text" class="form-control border-0 bg-light p-3 rounded-3 shadow-none" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Email Address</label>
                                <input type="email" class="form-control border-0 bg-light p-3 rounded-3 shadow-none" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted text-uppercase">Subject</label>
                                <select class="form-select border-0 bg-light p-3 rounded-3 shadow-none">
                                    <option selected>General Inquiry</option>
                                    <option>Order Support</option>
                                    <option>Bulk Ordering</option>
                                    <option>Technical Issue</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted text-uppercase">Your Message</label>
                                <textarea class="form-control border-0 bg-light p-3 rounded-3 shadow-none" rows="2" placeholder="How can we help you?" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow">
                                    Send Inquiry <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
        border: 1px solid #0d6efd !important;
    }
</style>
@endsection
