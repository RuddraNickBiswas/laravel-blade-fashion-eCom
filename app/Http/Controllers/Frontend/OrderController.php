<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index(){
        $user = auth()->user();
        $orders = $user->orders;
        return view('frontend.dashboard.order.index' ,compact('orders'));
    }

    function show(Order $order){
        $city = City::find($order->delivery_city_id);
        return view('frontend.dashboard.order.show', compact('order', 'city'));
    }
}
