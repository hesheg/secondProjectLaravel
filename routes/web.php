<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrate', [\App\Http\Controllers\UserController::class, 'getRegistrateForm'])->name('registrate');
Route::post('/registrate', [\App\Http\Controllers\UserController::class, 'registrate'])->name('registrate-post');

Route::get('/login', [\App\Http\Controllers\UserController::class, 'getLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login-post');

Route::get('/catalog', [\App\Http\Controllers\ProductController::class, 'getCatalog'])->name('catalog');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'getProfile'])->name('profile');

    Route::post('/add-product', [\App\Http\Controllers\CartController::class, 'addProduct'])->name('add-product');
    Route::post('/decrease-product', [\App\Http\Controllers\CartController::class, 'decreaseProduct'])->name('decrease-product');

    Route::get('/get-product/{product}', [\App\Http\Controllers\ProductController::class, 'getProduct'])->name('get-product');

    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'getCart'])->name('cart');

    Route::get('/edit-profile', [\App\Http\Controllers\UserController::class, 'getEditProfileForm'])->name('edit-profile');
    Route::post('/edit-profile', [\App\Http\Controllers\UserController::class, 'editProfile'])->name('edit-profile-post');

    Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');

    Route::get('/create-order', [\App\Http\Controllers\OrderController::class, 'getOrderForm'])->name('create-order');
    Route::post('/create-order', [\App\Http\Controllers\OrderController::class, 'createOrder'])->name('create-order-post');

    Route::get('/user-order', [\App\Http\Controllers\OrderController::class, 'getAllOrders'])->name('user-order');

    Route::post('/review-add', [\App\Http\Controllers\ProductController::class, 'addReview'])->name('review-add');
});

