<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', [UserController::class, 'authenticate'])->name('login');
    Route::view('register', 'auth.register')->name('register');
    Route::post('register', [UserController::class, 'store'])->name('register');
});

Route::match(['get', 'post'], 'logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

Route::group(['as' => 'user.', 'middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'userIndex'])->name('home');
    Route::resource('products', ProductController::class)->only(['index']);
    Route::resource('cart-items', CartItemController::class)->except(['create', 'edit', 'show']);
    Route::post('cart-items/destroy-all', [CartItemController::class, 'destroyAll'])->name('cart-items.destroy-all');
    Route::resource('orders', OrderController::class)->only('index', 'create', 'store');
    Route::resource('messages', MessageController::class)->only(['create', 'store']);
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::view('about', 'user.about')->name('about');
});

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/', [UserController::class, 'adminIndex'])->name('home');
    Route::resource('products', ProductController::class)->except(['show', 'create']);
    Route::resource('messages', MessageController::class)->only(['index', 'destroy']);
    Route::resource('users', UserController::class)->only(['index', 'store', 'destroy']);
    Route::resource('orders', OrderController::class)->only('index', 'update', 'destroy');
});
