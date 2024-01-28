<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
    

        $parentCategories = Category::withoutParent()->get();
        $product = Product::where('slug', $slug)->first();
        $recentProducts = Product::orderBy('created_at', 'desc')->take(3)->get();
        $randomProducts = Product::inRandomOrder()->take(3)->get();
       
        $galleries = $product->galleries;
        $sizes = $product->sizes;
        return view('frontend.product.show', compact(
            'product',
            'parentCategories',
            'galleries',
            'sizes',
            'recentProducts',
            'randomProducts'
        ));
    }

    public function loadProductModal(Product $product){

        $product->load('sizes');
      
        return view('frontend.layouts.ajax.product-popup-modal', compact('product') )->render();

    }
}
