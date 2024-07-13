<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

// admin routes
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
// Define resource routes for categories
Route::resource('categories', App\Http\Controllers\CategoryController::class);
// Define resource routes for products
   Route::resource('products', ProductController::class);

// Define resource routes for Banner
Route::resource('banners', App\Http\Controllers\BannerController::class);
//user routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category', [App\Http\Controllers\HomeController::class, 'categories'])->name('shop.categories');
Route::get('/shop-products', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop.products');
Route::get('/shop-detail', [App\Http\Controllers\HomeController::class, 'shopDetail'])->name('shop.detail');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/testimonial', [App\Http\Controllers\HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
