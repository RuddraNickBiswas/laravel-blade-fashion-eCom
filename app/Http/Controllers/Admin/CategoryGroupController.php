<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\CategoryGroupsDataTable;
use App\Http\Controllers\Controller;
use App\Models\CategoryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryGroupController extends Controller
{
    public function index(CategoryGroupsDataTable $dataTable)
    {

        return $dataTable->render('admin.product.category.categoryGroup.index');
    }

    public function create()
    {
        return view('admin.product.category.categoryGroup.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug =    Str::slug($request->name);

        CategoryGroup::create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.category-group.index')->with('success', 'Category group created successfully');
    }

    public function show(CategoryGroup $categoryGroup)
    {
        return view('category-groups.show', compact('categoryGroup'));
    }

    public function edit(CategoryGroup $categoryGroup)
    {
        return view('admin.product.category.categoryGroup.edit', compact('categoryGroup'));
    }

    public function update(Request $request, CategoryGroup $categoryGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
          
        ]);

        $slug = Str::slug($request->name);

        $categoryGroup->update([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.category-group.index')->with('success', 'Category group updated successfully');
    }

    public function destroy(CategoryGroup $categoryGroup)
    {
        try {
            $categoryGroup->delete();
            return response(['status' => 'success' , 'message' => 'Category Group deleted successfull']);
        } catch (\Exception $e) {

            return response(['status' => 'error' , 'message' => $e->getMessage()]);
        }

    }
}
