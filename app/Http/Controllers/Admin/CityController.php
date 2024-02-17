<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDataTable;
use App\DataTables\DistrictDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CityDataTable $dataTable)
    {   
        return $dataTable->render('admin.order.address.city.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::all();
       return view('admin.order.address.city.create' , compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_charge' => 'numeric|min:0',
            'district_id' => 'required|exists:districts,id',
        ]);

        City::create($request->all());

        toastr()->success('City Stored Successful');

        return redirect()->route('admin.order-city.index');
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
    public function edit(string $id)
    {
        view('admin.order.address.city.edit');
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
    public function destroy(string $id)
    {
        //
    }
}
