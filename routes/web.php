<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
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

    // CRUD cho khách hàng
    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::get('customers/{id}/show', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('customers/trash', [CustomerController::class, 'trash'])->name('customers.trash');
    Route::get('customers/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
    Route::delete('customers/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customers.forceDelete');

    // CRUD cho Color, Size, Brand
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('brands', BrandController::class);

    // Admin - Quản lý blog
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('trash', [BlogController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [BlogController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [BlogController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::resource('blogs', BlogController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
