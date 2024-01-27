<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class DeliveryAreaController extends Controller
{
    public function getCities($districtId)
    {
        $cities = City::where('district_id', $districtId)->get();

        return response()->json($cities);
    }
}
