<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductSizeController extends Controller
{
    public function store(Request $request,  Product $product)
    {
       
        $data =  $request->validate([
            'name' => "required|string|max:255",
        ]);

        $slug = Str::slug($request->name);
        
        $data['slug'] = $slug;

        $product->sizes()->create($data);

        toastr()->success('product size added');

        return redirect()->back();
    }

    public function destroy(Product $product, ProductSize $productSize){
        
        try {
            $productSize->delete();
            return response(['status' => 'success', 'message' => 'Image deleted from gallery successfull']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
