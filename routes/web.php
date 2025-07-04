<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CheckRole;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart routes
Route::get('/cart', [CheckoutController::class, 'showCart'])->name('cart');

Route::post('/cart/update/{key}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout routes
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Admin route
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

// Customer route
Route::middleware(['auth', CheckRole::class . ':customer'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });
});