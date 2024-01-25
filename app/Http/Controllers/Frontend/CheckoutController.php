<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   


    public function create () {

        return view('frontend.product.checkout.create');
    }
}
