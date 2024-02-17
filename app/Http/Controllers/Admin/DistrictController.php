<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DistrictDataTable;
use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DistrictDataTable $dataTable)
    {
        return $dataTable->render('admin.order.address.district.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.order.address.district.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        District::create($request->all());

        toastr()->success('District Created Successful');

        return redirect()->route('admin.order-district.index');
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
    public function edit(District $orderDistrict)
    {
      
        return view('admin.order.address.district.edit' , compact('orderDistrict'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $orderDistrict)
    {
        try {
            $orderDistrict->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfull']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
