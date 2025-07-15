<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Cart Routes ---
Route::prefix('cart')->group(function () {
    // Show the cart contents
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Renamed to cart.index for clarity

    // Add item to cart (POST)
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');

    // Update item quantity in cart (PUT/PATCH method is preferred for updates)
    // You must use @method('PUT') in your HTML form if submitting via POST
    Route::put('/update/{key}', [CartController::class, 'update'])->name('cart.update');

    // Remove item from cart (DELETE method is preferred for removals)
    // You must use @method('DELETE') in your HTML form if submitting via POST
    Route::delete('/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
});

// --- Checkout Routes ---
Route::prefix('checkout')->group(function () {
    // Show the checkout form
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');

    // Process the order
    Route::post('/', [CheckoutController::class, 'processOrder'])->name('checkout.process');
    Route::get('/order-success', [CheckoutController::class, 'success'])->name('order.success');

});


Route::get('/', [HomeController::class, 'index'])->name('home');


// Admin route
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});


// Categories routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
/*
|--------------------------------------------------------------------------
| Client (User) Routes
|--------------------------------------------------------------------------
*/
// Đặt route chi tiết sản phẩm ở đây
Route::get('/san-pham/{product:slug}', [ProductController::class, 'show'])->name('product.detail');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Route categories đầy đủ (đã có sẵn)
    Route::resource('categories', AdminCategoryController::class);


    // Route resource cho products với chỉ index, create, edit
    Route::resource('products', AdminProductController::class)->only([
        'index',
        'create',
        'edit',
        'show',
        'store',
        'destroy',
        'update'
    ]);



    Route::resource('variants', ProductVariantController::class);
});
