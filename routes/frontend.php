<?php

use App\Http\Controllers\frontend\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [HomePageController::class , 'index'])->name('home');