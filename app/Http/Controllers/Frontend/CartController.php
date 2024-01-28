<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;
use Response;

class CartController extends Controller
{
    function addToCart(Request $request)
    {
        $product = Product::with(['sizes'])->findOrFail($request->productId);



        if ($product->qty < $request->qty) {
            throw ValidationException::withMessages(['Quantity is not available']);
        }

        try {
            $size = $product->sizes->whereIn('id', $request->size)->first();

            $options = [
                'size' => [],
                'product_info' => [
                    'slug' => $product->slug,
                    'thumbnail_path' => $product->thumbnail_path,
                ]
            ];

            if ($size) {
                $options['size'] = [
                    'name' => $size->name,
                    'id' => $size->id,
                ];
            }
            $price = $product->discounted_price > 0 ? $product->discounted_price : $product->price;
            Cart::add(
                [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $request->qty,
                    'price' => $price,
                    'weight' => 0,
                    'options' => $options
                ]
            );
            return response([
                'status' => 'success',
                'message' => 'Product added to cart'
            ], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }

    function getCartProduct()
    {
        /**
         * Cart is taken from Cart package from session
         */

        return view('frontend.layouts.ajax.header-cart-item')->render();
    }

    function removeCartProduct($rowId)
    {

        try {
            Cart::remove($rowId);

            return response(['status' => 'success', 'message' => 'Product removed'], 200);
        } catch (\Exception $e) {

            return response(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }


    function show()
    {
        $districts = District::get();

        return view('frontend.product.cart.show', compact('districts'));
    }


    function updateQty(Request $request)
    {

        $cartProduct = Cart::get($request->rowId);
        $product = Product::findOrFail($cartProduct->id);

        if ($product->qty < $request->qty) {

            return response(['status' => 'error', 'message' => 'quantity is not available', 'qty' => $cartProduct->qty]);
        }

        $rowId = $request->rowId;
        try {
            Cart::update($rowId, $request->qty);
            return response(['status' => 'success', 'cart_product_total' => cartProductTotal($rowId), 'cart_total' => cartTotal()], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'something went wrong'], 500);
        }
    }

    function destroy($rowId)
    {

        Cart::remove($rowId);

        toastr()->success('cart item deleted');

        return redirect()->back();
    }
}
