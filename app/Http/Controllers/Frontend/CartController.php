<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function addToCart(Request $request)
    {
        try {
            
            $product = Product::with(['sizes'])->findOrFail($request->productId);
            $size = $product->sizes->whereIn('id', $request->size)->first();
    
    
            $options = [
                'size' => [],
                'product_info' => [
                    'slug' => $product->slug,
                    'thumbnail_path' => $product->thumbnail_path,
                ]
            ];
    
            if($size){
                $options['size'] =[
                    'name' => $size->name,
                    'id' => $size->id,
                ];
            }
    
            Cart::add(
                [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $request->qty,
                    'price' => $product->price,
                    'weight' => 0,
                    'options' => $options
                ]);
            return response([
                'status' => 'success',
                'message' => 'Product added to cart'
            ], 200);

        } catch (\Exception $e) {
            return response([ 'status' => 'error' , 'message' => 'Something went wrong' ] , 500);
        }
    }

    function getCartProduct(){
        $products = Cart::content();

        return view('frontend.layouts.ajax.header-cart-item')->render();
    }
}
