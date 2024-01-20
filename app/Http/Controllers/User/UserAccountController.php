<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.account');
    }

    public function order()
    {
        return view('frontend.dashboard.orders');
    }

    public function returnOrder()
    {
        return view('frontend.dashboard.return-orders');
    }

    public function trackOrder()
    {
        return view('frontend.dashboard.track-order');
    }
}
