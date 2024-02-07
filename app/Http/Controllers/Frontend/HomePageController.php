<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index() {
        
        
        $categories = Category::with('children')->whereNull('parent_id')->get();

        $mansProducts = Product::where('group' ,'man')->orWhere('group' , 'all')->take(12)->get();
       
        return view('frontend.home.index', compact('mansProducts') );
    }

    public function mail(){
        $order = Order::find(8);
        return view('mail.demo', compact('order'));
    }
}
