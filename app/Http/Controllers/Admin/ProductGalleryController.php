<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGalery;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    use FileUploadTrait;

    public function store(Request $request,  Product $product)
    {
        $request->validate([
            'image' => "required|image|max:4000",
        ]);

        $imagePath = $this->uploadImage(
            request: $request,
            inputName: 'image',
            path: '/uploads/image/product',
            oldPath: null,
            resizeWidth: 700,
            resizeHeight: 900
        );

        $product->galleries()->create([
            'path' => $imagePath,
        ]);

        toastr()->success('added image to gallery');

        return redirect()->back();
    }

    public function destroy(Product $product, ProductGallery $productGallery){
        
        try {
            $productGallery->delete();
            return response(['status' => 'success', 'message' => 'Image deleted from gallery successfull']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
