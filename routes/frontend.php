<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [HomePageController::class , 'index'])->name('home');


// Route::get('/dashboard/account' , [UserAccountController::class , 'index'])->name('dashboard.account');
// Route::get('/dashboard/orders' , [UserAccountController::class , 'order'])->name('dashboard.order');
// Route::get('/dashboard/return-orders' , [UserAccountController::class , 'returnOrder'])->name('dashboard.return-order');
// Route::get('/dashboard/track-order' , [UserAccountController::class , 'trackOrder'])->name('dashboard.track-order');


Route::group(['prefix' => 'dashboard'], function () {
    
    Route::controller(UserProfileController::class)->group(function() {
        Route::get('/profile' , 'index')->name('profile');
        Route::put('/profile' , 'profileUpdate')->name('profile.update');
        Route::put('/profile/password' , 'passwordUpdate')->name('profile.password.update');
    });
 
})->middleware(['auth', 'verified']);

// In your routes/web.php
Route::controller(ProductController::class)->group(function() {
    Route::get('/product/{slug}' , 'show')->name('product.show');
    Route::get('load-product-modal/{product}' ,'loadProductModal')->name('load-product-modal');
});

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/get-cart-product', [CartController::class, 'getCartProduct'])->name('get-cart-product');
