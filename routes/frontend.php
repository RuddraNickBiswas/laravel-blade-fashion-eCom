<?php

use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('home');


// Route::get('/dashboard/account' , [UserAccountController::class , 'index'])->name('dashboard.account');
// Route::get('/dashboard/orders' , [UserAccountController::class , 'order'])->name('dashboard.order');
// Route::get('/dashboard/return-orders' , [UserAccountController::class , 'returnOrder'])->name('dashboard.return-order');
// Route::get('/dashboard/track-order' , [UserAccountController::class , 'trackOrder'])->name('dashboard.track-order');


Route::group(['prefix' => 'dashboard'], function () {

    Route::controller(UserProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile', 'profileUpdate')->name('profile.update');
        Route::put('/profile/password', 'passwordUpdate')->name('profile.password.update');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/order', 'index')->name('fn.order.index');
        Route::get('/order/{order}', 'show')->name('fn.order.show');
    });
})->middleware(['auth', 'verified']);

// In your routes/web.php
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/{slug}', 'show')->name('product.show');
    Route::get('load-product-modal/{product}', 'loadProductModal')->name('load-product-modal');
});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('category.index');
    Route::get('/category/{slug}', 'show')->name('category.show');
});

Route::controller(CartController::class)->group(function () {

    Route::post('/add-to-cart',  'addToCart')->name('add-to-cart');
    Route::get('/get-cart-product',  'getCartProduct')->name('get-cart-product');
    Route::get('/remove-cart-product/{rowId}',  'removeCartProduct')->name('remove-cart-product');
   
    //cart details page
    Route::get('/cart',  'show')->name('cart.show');
    Route::get('/cart/{rowId}',  'destroy')->name('cart.destroy');
    Route::post('/cart-update-qty',  'updateQty')->name('cart.update-qty');
    Route::get('/cart/{rowId}',  'destroy')->name('cart.destroy');

});

Route::get('/get-cities/{districtId}', [DeliveryAreaController::class, 'getCities']);


Route::resource('/checkout' ,CheckoutController::class )->only('create' ,'store')->middleware('auth');
