<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{



    public function create(Request $request)
    {
        $request->validate([
            'district' => 'required|exists:districts,id',
            'city' => 'required|exists:cities,id',
        ]);

        $selectedCity = City::find($request->city);
        $selectedDistrict = $selectedCity->district;
        $districts = District::get();
        return view('frontend.product.checkout.create', compact('selectedCity', 'selectedDistrict', 'districts'));

    }

    public function store (Request $request) {

        
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:60',
            'district' => 'required|exists:districts,id',
            'city' => 'required|exists:cities,id',
            'address' => 'required|string', // Corrected the rule to 'string'
        ]);
        

        $invoiceId = generateInvoiceId(); 
    
        $city = City::find($request->city);
        $cartGrandtotal = cartGrandTotal($city->delivery_charge) ;
        $cart = Cart::content();
        $order = Order::create( [
            'invoice_id' => $invoiceId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => auth()->user()->id,
            'qty' => Cart::content()->count(),
            'discount' => null, 
            'subtotal' => cartTotal(),
            'grand_total' => $cartGrandtotal,
            'delivery_charge' => $city->delivery_charge,
            'delivery_city_id' => $city->id,
            'delivery_address' => $request->address,
            'payment_method' => 'cash on delivery',
            'payment_status' => 'incomplete', 
            'transaction_id' => null,
            'coupon_id' => null, 
            'currency_code' => config('settings.site_currency'), 
            'payment_approve_date' => null, 
        ]);

            foreach ($cart as $key => $product) {
                $productModel = Product::find($product->id);
                $productName = $productModel->name; 
                $order->orderProducts()->create([
                    'name' => $productName,
                    'product_id' => $product->id,
                    'qty' => $product->qty,
                    'unit_price' =>  $product->price,
                    'size' => json_encode($product->options->size),
                ]);
            };
        Cart::destroy();

        return redirect()->route('order.payment.index', $order->id);
        
    }
}
