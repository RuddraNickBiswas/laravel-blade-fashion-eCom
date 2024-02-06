<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryGroupController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewaySettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/profile', [AdminProfileController::class, 'updateProfile'])->name('profile.profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');


    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting' , 'index')->name('setting.index');
        Route::put('/general-setting' , 'generalSettingUpdate')->name('general.setting.update');
    });

    Route::resource('category-group', CategoryGroupController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product.productGallery', ProductGalleryController::class)->only(['store', 'destroy']);
    Route::resource('product.productSize', ProductSizeController::class)->only(['store', 'destroy']);
    Route::resource('product.productDetails', ProductDetailsController::class)->only(['store']);


    Route::controller(OrderController::class)->group(function(){
        Route::get('/order' , 'index')->name('order.index');
        Route::get('/order/{order}' , 'show')->name('order.show');
        Route::post('/order/{order}' , 'statusUpdate')->name('order.update');
    });

    Route::prefix('payment-setting')->controller(PaymentGatewaySettingController::class)->group(function(){
        Route::get('' , 'index')->name('payment-setting.index');
        Route::put('paypal-setting' , 'paypalSettingUpdate')->name('paypal.setting.update');
    });
});
