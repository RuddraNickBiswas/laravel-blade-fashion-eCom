<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index () {

        return view('frontend.product.checkout.index');
    }


    public function show () {

        return view('frontend.product.checkout.index');
    }
}
