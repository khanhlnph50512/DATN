<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Clients\CommentController;
use App\Http\Controllers\Clients\OrderController;
use App\Http\Controllers\Clients\ProductControllerr;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Clients\CartController;
use App\Http\Controllers\Clients\CheckoutController;
use App\Http\Controllers\Clients\HomeController as ClientsHomeController;
use App\Http\Controllers\Clients\PageController;
use App\Http\Controllers\Clients\VnpayController;
use App\Http\Controllers\Clients\WishlistController;

// Trang chủ
Route::get('/', function () {
    return view('client.home.index');
});

// Auth

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
// Xử lý gửi mail/reset token
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Form đổi mật khẩu theo token
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
// Xử lý cập nhật mật khẩu mới
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ========================= CLIENT =========================
Route::resource('client/home', ClientsHomeController::class);
Route::resource('client/product', ProductControllerr::class);
Route::get('/product-detail/{slug}/{id}', [ProductControllerr::class, 'show'])->name('client.products.detailProducts');
Route::get('client/order-tracking', [OrderController::class, 'orderTracking'])->name('client.order-tracking');
Route::get('/order/{orderId}', [OrderController::class, 'showDetail'])->name('client.order.detail');
 Route::get('/search', [ProductControllerr::class, 'search'])->name('search');
Route::get('/discover-you', [PageController::class, 'discoverYou'])->name('discover.you');
// / yeu thich


/// comment
Route::post('/comments', [CommentController::class, 'store'])
    ->name('client.comments.store')
    ->middleware('auth');
// Cart
// routes/web.php
//add coupon
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('client.cart.applyCoupon');

Route::prefix('client/carts')->name('client.carts.')->group(function () {

    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
Route::post('/update/{id}', [CartController::class, 'updateQuantity'])->name('updateQuantity');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});
 // Checkout
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('client.checkout');
Route::post('/checkout', [CheckoutController::class, 'processOrder'])->name('client.checkout.process');
Route::post('/vnpay/payment', [VnpayController::class, 'vnpayPayment'])->name('vnpay.payment');
Route::get('/vnpay/return', [VnpayController::class, 'vnpayReturn'])->name('vnpay.return');


Route::get('/checkout/success', function () {
    return view('client.checkout.success');
})->name('client.checkout.success');
// ========================= ADMIN =========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
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
   Route::resource('coupons', CouponController::class);
    Route::get('/coupons/trash', [CouponController::class, 'trash'])->name('coupons.trash');
Route::post('coupons/{id}/restore', [CouponController::class, 'restore'])->name('coupons.restore');
Route::delete('coupons/{id}/force-delete', [CouponController::class, 'forceDelete'])->name('coupons.forceDelete');

   //binh luận
Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('index');
        Route::post('{id}/approve', [\App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('approve');
        Route::post('{id}/reject', [\App\Http\Controllers\Admin\CommentController::class, 'reject'])->name('reject');
        Route::delete('{id}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('destroy');
    });
    // order
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
////////////////////


});
