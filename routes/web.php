<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;


Route::get('/', function () {
    return view('coming-soon');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories/data', [CategoryController::class, 'getData'])->name('categories.data');
    Route::resource('categories', CategoryController::class);

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('trash', [ProductController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::resource('products', ProductController::class);

    // ✅ Thêm CRUD màu và size
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('brands', BrandController::class);
});
