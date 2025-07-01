<?php

use App\Http\Controllers\Clients\OrderController;
use App\Http\Controllers\Clients\ProductControllerr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CouponController;

// Client Controllers
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Clients\HomeController as ClientsHomeController;

// Trang chủ
Route::get('/', function () {
    return view('coming-soon');
});

// Auth
Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ========================= CLIENT =========================
Route::resource('client/home', ClientsHomeController::class);
Route::resource('client/product', ProductControllerr::class);
Route::get('client/order-tracking', [OrderController::class, 'orderTracking'])->name('client.order-tracking');

// ========================= ADMIN =========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::get('/categories/data', [CategoryController::class, 'getData'])->name('categories.data');
    Route::resource('categories', CategoryController::class);

    // Products + Trash
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('trash', [ProductController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::resource('products', ProductController::class);


    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::get('customers/{id}/show', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('customers/trash', [CustomerController::class, 'trash'])->name('customers.trash');
    Route::get('customers/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
    Route::delete('customers/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customers.forceDelete');

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('trash', [UserController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [UserController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [UserController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::resource('users', UserController::class);

    // Brands, Colors, Sizes
    Route::resource('brands', BrandController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);

    // Blogs
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('trash', [BlogController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [BlogController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [BlogController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::resource('blogs', BlogController::class);

    // Coupon
    Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('trash', [CouponController::class, 'trash'])->name('trash');
        Route::post('{id}/restore', [CouponController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [CouponController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::resource('coupons', CouponController::class);
});
