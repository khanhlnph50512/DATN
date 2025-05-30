<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

// Route client (trang chủ)
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('coming-soon');
});

// Route admin với prefix 'admin' và name 'admin.'
Route::prefix('admin')->name('admin.')->group(function () {
    // Trang dashboard admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories/data', [CategoryController::class, 'getData'])->name('categories.data');

    // CRUD danh mục
    Route::resource('categories', CategoryController::class);
///////////////////////////
Route::prefix('products')->name('products.')->group(function() {
    Route::get('trash', [ProductController::class, 'trash'])->name('trash');
    Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore');
    Route::delete('{id}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');
});
    Route::resource('products', ProductController::class);

// Nếu bạn muốn thêm route cho trash, restore, forceDelete (phần xóa mềm)


});
