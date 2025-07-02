<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index'])->name('home');


// Admin route
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});



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
    Route::resource('categories', CategoryController::class);


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
