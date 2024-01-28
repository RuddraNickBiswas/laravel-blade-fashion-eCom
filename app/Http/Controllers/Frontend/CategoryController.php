<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(){

        return view('frontend.category.index');
    }

    public function show($slug)
    {
        $parentCategories = Category::withoutParent()->get();
        $currentCategory = Category::where('slug', $slug)->first();

        $recentProducts = Product::orderBy('created_at', 'desc')->take(3)->get();
        $randomProducts = Product::inRandomOrder()->take(3)->get();
        if (!$currentCategory->products) {
            abort(404);
        }
    
      
        return view('frontend.category.show', compact('currentCategory', 'parentCategories','recentProducts', 'randomProducts'));
    }
}
