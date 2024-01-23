<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
   

public function store(Request $request, Product $product)
{
    $data = $request->validate([
        'data' => 'required',
    ]);

    $productDetails = $product->details;

    if ($productDetails) {
        $productDetails->update($data);
    } else {
        $product->details()->create($data);
    }

    toastr()->success('Product size added');

    return redirect()->back();
}


}
