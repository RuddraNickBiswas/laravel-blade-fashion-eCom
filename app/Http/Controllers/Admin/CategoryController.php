<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategorysDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategorysDataTable $dataTable)
    {

        return $dataTable->render('admin.product.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::withoutParent()->get();
        return view('admin.product.category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $slug = Str::slug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('admin.category.create')->with('success', 'Category created successfully');
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
    public function edit(Category $category)
    {
        $parentCategories = Category::withoutParent()->get();
        return view('admin.product.category.edit', compact('parentCategories', 'category')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id . '|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $slug = Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $slug,
        ]);

        return Redirect::route('admin.category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfull']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
