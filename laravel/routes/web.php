<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

// Route client (trang chủ)
// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route admin với prefix 'admin' và name 'admin.'
Route::prefix('admin')->name('admin.')->group(function () {
    // Trang dashboard admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories/data', [CategoryController::class, 'getData'])->name('categories.data');

    // CRUD danh mục
    Route::resource('categories', CategoryController::class);
});
