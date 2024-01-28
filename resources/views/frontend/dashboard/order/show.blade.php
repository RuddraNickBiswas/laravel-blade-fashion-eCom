@extends('frontend.layouts.master')

@section('content')
    <div class=" container clearfix">

        <div class=" py-4 row ">
            <div class="d-flex justify-content-between align-content-center align-items-center">
                <h2>Invoice</h2>
                <div class="invoice-number"> {{ $order->invoice_id }} </div>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-6">
                <address>
                    <strong>Billed To:</strong><br>
                    {{ $order->name }}<br>
                    {{ $city->district->name }}<br>
                    {{ $city->name }}<br>
                    {{ $order->delivery_address }}
                </address>
            </div>
            <div class="col-md-6 text-md-right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <address>
                    <strong>Payment Method:</strong><br>
                    {{ $order->payment_method }}<br>
                    <strong>Payment Statue</strong><br>
                    {{ $order->payment_status }} <br>
                </address>
            </div>
            <div class="col-md-6 d-flex justify-content-end text-md-right">
                <address>
                    <strong>Order Date:</strong><br>
                    {{ $order->created_at->format('F j, Y') }}<br><br>
                    <strong>Order Status:</strong><br>
                    {{ $order->status }}
                </address>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="section-title">Order Summary</div>
                <p class="section-lead">All items here cannot be deleted.</p>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                        <tr>
                            <th data-width="40">#</th>
                            <th>name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Totals</th>
                        </tr>
                        @foreach ($order->orderProducts as $key => $orderProduct)
                            @php
                                $productTotal = $orderProduct->unit_price * $orderProduct->qty;
                                $size = json_decode($orderProduct->size);
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td> <a href="{{ route('product.show',  $orderProduct->product->slug ) }}">{{ $orderProduct->product->name }}</a>  </td>
                                <td class="text-center">{{ currencyPosition($orderProduct->unit_price) }}</td>
                                <td class="text-center">{{ $size->name }}</td>
                                <td class="text-center">{{ $orderProduct->qty }}</td>
                                <td class="text-right">{{ currencyPosition($productTotal) }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8">

                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-end text-right">

                        <strong>Subtotal</strong>
                        <p>{{ currencyPosition($order->subtotal) }}</p>
                        <strong>Shipping</strong>
                        <p>{{ currencyPosition($order->delivery_charge) }}</p>
                        <strong>Total</strong>
                        <p>{{ currencyPosition($order->grand_total) }}</p>

                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
