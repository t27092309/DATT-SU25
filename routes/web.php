<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // ... các route admin hiện có (dashboard, users, products)

    // Route Resource cho Categories
    Route::resource('categories', CategoryController::class);
});