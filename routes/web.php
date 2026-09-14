<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/place', [App\Http\Controllers\OrderController::class, 'place'])->name('order.place');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show'); // Fixing route name consistency
    Route::get('/orders/{id}/pdf', [App\Http\Controllers\OrderController::class, 'downloadPdf'])->name('orders.downloadPdf');
});

// Simplified Manual Password Reset (No Email)
Route::get('/forgot-password-manual', [HomeController::class, 'showManualResetForm'])->name('password.manual.request');
Route::post('/forgot-password-manual/verify', [HomeController::class, 'verifyUserForReset'])->name('password.manual.verify');
Route::get('/reset-password-manual', [HomeController::class, 'showNewPasswordForm'])->name('password.manual.reset');
Route::post('/reset-password-manual/update', [HomeController::class, 'updatePasswordManual'])->name('password.manual.update');

// Auth routes
Auth::routes();

// Cart routes (requires auth for checkout)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Categories
    Route::resource('categories', AdminCategoryController::class);
    
    // Products
    Route::resource('products', AdminProductController::class);
    Route::delete('/products/image/{id}', [AdminProductController::class, 'destroyImage'])->name('products.image.destroy');
    
    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');
});
