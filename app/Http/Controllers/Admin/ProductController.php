<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->input('name'));

        // $imagePath = $this->uploadImage($request, 'thumbnail', NULL, "/uploads/image/product");

        $imagePath = $this->uploadImage(
            request: $request,
            inputName: 'thumbnail',
            path: '/uploads/image/product',
            oldPath: null,
            resizeWidth: 700,
            resizeHeight: 900
        );
        $data['thumbnail_path'] = $imagePath;
        unset($data['thumbnail']);
        $product = Product::create($data);

        toastr()->success('product created complete');

        return redirect()->route('admin.product.edit', $product->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::get();
        $galleries = $product->galleries;
        $sizes  = $product->sizes;
        $details  = $product->details;
        return view('admin.product.edit', compact('product', 'categories', 'galleries', 'sizes', 'details'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->input('name'));

        if ($request->hasFile('thumbnail')) {


            $imagePath = $this->uploadImage(
                request: $request,
                inputName: 'thumbnail',
                path: '/uploads/image/product',
                oldPath: $product->thumbnail_path,
                resizeWidth: 700,
                resizeHeight: 900
            );
            $data['thumbnail_path'] = $imagePath;
            unset($data['thumbnail']);
            $product->update($data);
        } else {
            unset($data['thumbnail']);
            $product->update($data);
        }

        toastr()->success('product update complete');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->destroyImage($product->thumbnail_path);
            $product->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfull']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
