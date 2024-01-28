<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function show(Order $order){

        $city = City::find($order->delivery_city_id);

      
        return view('admin.order.show', compact('order', 'city'));
    }

    public function statusUpdate(Order $order ,Request $request){
        $data = $request->validate([
                'status' => 'required',
                'payment_status' => 'required',
            ]);

        $order->update($data);

        toastr()->success('order status updated successful');

        return redirect()->back();
        
        
    }

}
