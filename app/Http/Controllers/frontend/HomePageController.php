<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index() {
        
        
        $categories = Category::with('children')->whereNull('parent_id')->get();

       
        return view('frontend.home.index' );
    }
}
