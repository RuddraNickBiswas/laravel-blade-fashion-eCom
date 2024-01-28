@extends('frontend.dashboard.dashboard')

@push('styles')
   	<link rel="stylesheet" href="asset('frontend/css/components/bs-datatable.css')" type="text/css" /> 
@endpush

@section('sidebar_content')
<div id="snav-content2">
    <div class="table-responsive">
        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Invoice Id</th>
                    <th>Address</th>
                    <th>Product Qty</th>
                    <th>Delivery Charge</th>
                    <th>Grand Total</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            {{-- <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot> --}}
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td><a href="{{ route('fn.order.show', $order->id) }}"><i class="icon-eye-open"></i></a> </td>
                    <td>{{ $order->invoice_id }}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>{{ currencyPosition($order->delivery_charge)  }}</td>
                    <td>{{ currencyPosition($order->grand_total)  }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->payment_status }}</td>
                </tr>
                    
                @endforeach
               
            </tbody>
        </table>
    </div>
</div> 
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/components/bs-datatable.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable1').dataTable();
        });
    </script>
@endpush