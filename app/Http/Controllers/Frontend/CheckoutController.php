<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
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
}
