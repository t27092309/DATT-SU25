<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProductVariantController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Route categories đầy đủ (đã có sẵn)
    Route::resource('categories', CategoryController::class);
    

    // Route resource cho products với chỉ index, create, edit
    Route::resource('products', ProductController::class)->only([
        'index', 'create', 'edit','show','store','destroy','update'
    ]);

    

Route::resource('variants', ProductVariantController::class);

});
