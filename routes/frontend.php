<?php

use App\Http\Controllers\frontend\HomePageController;
use App\Http\Controllers\frontend\UserAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [HomePageController::class , 'index'])->name('home');


Route::get('/account' , [UserAccountController::class , 'index'])->name('user.account');