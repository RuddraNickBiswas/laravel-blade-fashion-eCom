<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/profile', [AdminProfileController::class, 'updateProfile'])->name('profile.profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');
    
});
