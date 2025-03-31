<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterConfirmController;
use App\Http\Controllers\RegisterCompleteController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminUserController;

Route::middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/news/{id}', [IndexController::class, 'newsShow'])->name('news.show');
    Route::get('/menulist', [MenuController::class, 'index'])->name('menu');

    Route::get('/cart', [MenuController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/apply-coupon', [MenuController::class, 'applyCoupon'])->name('cart.applyCoupon');

    Route::post('/cart/remove/{id}', [MenuController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/register', [OrderController::class, 'registerOrder'])->name('cart.register');
    Route::get('/order/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order', [OrderController::class, 'viewOrder'])->name('order.view');
    Route::delete('/order/delete/{orderCode}', [OrderController::class, 'deleteOrder'])->name('order.delete');

    Route::get('/order/reservation/{orderCode}', [OrderController::class, 'showReservationForm'])->name('order.reservation');
    Route::post('/order/reserve/{orderCode}', [OrderController::class, 'reserveOrder'])->name('order.reserve');
    Route::post('/order/cancel/{orderCode}', [OrderController::class, 'cancelReservation'])->name('order.cancel');

    Route::get('/order/qr/{orderCode}', [OrderController::class, 'generateQRCode'])->name('order.qr');
    Route::get('/order/wait/{orderCode}', [OrderController::class, 'waitForScan'])->name('order.wait');
    Route::get('/order/check/{orderCode}', [OrderController::class, 'checkScanStatus'])->name('order.check');
    Route::get('/order/complete/{orderCode}', [OrderController::class, 'completeOrder'])->name('order.complete');

    Route::get('/order/complete', function () {
        return view('complete');
    })->name('order.complete.view');

    Route::get('/minigame', function () {
        return view('minigame');
    })->name('minigame');

    Route::post('/minigame/play', [OrderController::class, 'playMiniGame'])->name('minigame.play');

    Route::get('/stamps', [CouponController::class, 'viewStamps'])->name('stamps.view');
    Route::post('/stamps/redeem', [CouponController::class, 'redeemCoupon'])->name('stamps.redeem');
});

// ✅ `markAsScanned()` をログイン不要にする（このルートだけ外に出す）
Route::post('/order/scan/{orderCode}', [OrderController::class, 'markAsScanned'])->name('order.scan');
Route::get('/order/scan/{orderCode}', [OrderController::class, 'scanWithoutAuth'])->name('order.scan');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'index'])->name('registration');
Route::post('/register', [RegisterController::class, 'register'])->name('registration.process');

Route::get('register/confirm', [RegisterConfirmController::class, 'index'])->name('registration.confirm');
Route::post('register/confirm', [RegisterConfirmController::class, 'confirm'])->name('registration.confirm');
Route::get('/register/complete', [RegisterCompleteController::class, 'index'])->name('registration.complete');
Route::post('/register/complete', [RegisterCompleteController::class, 'complete'])->name('registration.complete');

Route::prefix('admin')->group(function () {
    Route::get('/admin_login', [AdminloginController::class, 'admin_index'])->name('admin.login');
    Route::post('/admin_login', [AdminloginController::class, 'admin_login'])->name('admin.process');

    Route::middleware('auth.admin')->group(function () {
        Route::get('/index', [AdminProductController::class, 'index'])->name('admin.index');
        Route::get('/product/add', [AdminProductController::class, 'createProduct'])->name('admin.product_add');
        Route::post('/product/store', [AdminProductController::class, 'storeProduct'])->name('admin.product.store');
        Route::get('/product/edit/{id}', [AdminProductController::class, 'editProduct'])->name('admin.product.edit');
        Route::put('/product/update/{id}', [AdminProductController::class, 'updateProduct'])->name('admin.product.update');
        Route::delete('/product/delete/{id}', [AdminProductController::class, 'deleteProduct'])->name('admin.product.delete');
        

        Route::get('/news/add', [AdminNewsController::class, 'news_add'])->name('admin.news_add');
        Route::post('/news/store', [AdminNewsController::class, 'addnews'])->name('admin.news.add');
        Route::post('/news/add/store', [AdminUserController::class, 'adduser'])->name('admin.news_add.store');
        Route::get('/admin/news/{id}/edit', [AdminNewsController::class, 'editNews'])->name('admin.news.edit');
        Route::put('/admin/news/{id}', [AdminNewsController::class, 'updateNews'])->name('admin.news.update');
        Route::delete('/admin/news/{id}', [AdminNewsController::class, 'deleteNews'])->name('admin.news.delete');



        Route::get('/users', [AdminUserController::class, 'user'])->name('admin.users');
        Route::get('/user/add', [AdminUserController::class, 'user_add'])->name('admin.user_add');
        Route::post('/user/add/store', [AdminUserController::class, 'adduser'])->name('admin.user_add.store');

        Route::get('/user/edit/{id}', [AdminUserController::class, 'edituser'])->name('admin.user.edit');
        Route::put('/user/update/{id}', [AdminUserController::class, 'updateuser'])->name('admin.user.update');
        Route::post('/user/delete/{id}', [AdminUserController::class, 'deleteuser'])->name('admin.user.delete');
    });
});
