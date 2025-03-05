<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterConfirmController;
use App\Http\Controllers\RegisterCompleteController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminFoodController;
/*
Route::get('/', function () {
    return view('registration_complete');
});*/


Route::middleware('auth')->group(function () {



    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/news/{id}', [IndexController::class, 'newsShow'])->name('news.show'); // ニュース詳細ページ
    Route::get('/menulist', [MenuController::class, 'index'])->name('menu');

    Route::get('/cart', [MenuController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{id}', [MenuController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/register', [OrderController::class, 'registerOrder'])->name('cart.register');
    Route::get('/order/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order', [OrderController::class, 'viewOrder'])->name('order.view');
    Route::get('/order/qr/{orderCode}', [OrderController::class, 'generateQRCode'])->name('order.qr');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'index'])->name('registration');
Route::post('/register', [RegisterController::class, 'register'])->name('registration.process');

Route::get('register/confirm', [RegisterConfirmController::class, 'index'])->name('registration.confirm');
Route::post('register/confirm', [RegisterConfirmController::class, 'confirm'])->name('registration.confirm');
Route::get('/register/complete', [RegisterCompleteController::class, 'index'])->name('registration.complete');
Route::post('/register/complete', [RegisterCompleteController::class, 'complete'])->name('registration.complete');

Route::prefix('admin')->group(function () {
    // 管理者ログイン関連
    Route::get('/admin_login', [AdminloginController::class, 'admin_index'])->name('admin.login');
    Route::post('/admin_login', [AdminloginController::class, 'admin_login'])->name('admin.process');

    Route::middleware('auth.admin')->group(function () {

        Route::get('/index', [AdminFoodController::class, 'index'])->name('admin.index');
        Route::get('/food/add', [AdminFoodController::class, 'add_Food'])->name('admin.food_add');
        Route::post('/food/store', [AdminFoodController::class, 'addFood'])->name('admin.food.add');


        Route::get('/food/edit/{id}', [AdminFoodController::class, 'edit_Food'])->name('admin.food.edit');
        Route::put('/food/update/{id}', [AdminFoodController::class, 'editFood'])->name('admin.food.update');

        Route::delete('/food/delete/{id}', [AdminFoodController::class, 'deleteFood'])->name('admin.food.delete');
    });
});
