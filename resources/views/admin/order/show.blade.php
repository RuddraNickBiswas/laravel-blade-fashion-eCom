@extends('admin.layouts.master')

@section('page-title', 'Invoice')

@section('content')
<div class="section-body">
    <div id="invoice" class="invoice">
      <div class="invoice-print">
        <div class="row">
          <div class="col-lg-12">
            <div class="invoice-title">
              <h2>Invoice</h2>
              <div class="invoice-number"> {{ $order->invoice_id }} </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <address>
                  <strong>Billed To:</strong><br>
                   {{ $order->name }}<br>
                    {{  $city->district->name }}<br>
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
              <div class="col-md-6 text-md-right">
                <address>
                  <strong>Order Date:</strong><br>
                  {{ $order->created_at->format('F j, Y') }}<br><br>
                  <strong>Order Status:</strong><br>
                  {{ $order->status }}
                </address>
              </div>
            </div>
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
                  <td ><a href="{{ route('product.show',$orderProduct->product->slug ) }}"> {{ $orderProduct->product->name }}</a> </td>
                  <td class="text-center">{{ currencyPosition($orderProduct->unit_price) }}</td>
                  <td class="text-center">{{ $size->name }}</td>
                  <td class="text-center">{{ $orderProduct->qty }}</td>
                  <td class="text-right">{{  currencyPosition($productTotal) }}</td>
                </tr>
                @endforeach
              
              </table>
            </div>
            <div class="row mt-4">
              <div class="col-lg-8" ">
                <div class="col-md-4">
                  <form action="{{ route('admin.order.update' ,$order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="">Order Status</label>
                      <select name="status" class="form-control">
                        <option @selected($order->status === 'pending') value="pending">Pending</option>
                        <option @selected($order->status === 'processing') value="processing">Processing</option>
                        <option @selected($order->status === 'shipped') value="shipped">Shipped</option>
                        <option @selected($order->status === 'delivered') value="delivered">Delivered</option>
                        <option @selected($order->status === 'cancelled') value="cancelled">Cancelled</option>
                        <option @selected($order->status === 'on_hold') value="on_hold">On Hold</option>
                        <option @selected($order->status === 'refunded') value="refunded">Refunded</option>
                    </select>
                    
                    </div>
                        <div class="form-group">
                      <label for="">Payment Status</label>
                      <select name="payment_status" class="form-control">
                        <option @selected($order->payment_status === 'incomplete') value="incomplete">Incomplete</option>
                        <option @selected($order->payment_status === 'complete') value="complete">Completed</option>
                    </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
                  </form>


                </div>
              </div>
              <div class="col-lg-4 text-right">
                <div class="invoice-detail-item">
                  <div class="invoice-detail-name">Subtotal</div>
                  <div class="invoice-detail-value">{{ currencyPosition($order->subtotal) }}</div>
                </div>
                <div class="invoice-detail-item">
                  <div class="invoice-detail-name">Shipping</div>
                  <div class="invoice-detail-value">{{ currencyPosition($order->delivery_charge) }}</div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="invoice-detail-item">
                  <div class="invoice-detail-name">Total</div>
                  <div class="invoice-detail-value invoice-detail-value-lg">{{ currencyPosition($order->grand_total) }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="text-md-right">
        <div class="float-lg-left mb-lg-0 mb-3">

        </div>
        <button id="print_btn" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
      </div>
    </div>
  </div>
    </div>
@endsection

@push('scripts')
<script>
   $(document).ready(function () {
      $('#print_btn').on('click', function () {
        
        const printContent = $('#invoice').html();

         let printWindow = window.open('','','width=600,height=600');
         printWindow.document.open();
         printWindow.document.write('<html>');
         printWindow.document.write('<link rel="stylesheet" href="{{ asset("admin/assets/modules/bootstrap/css/bootstrap.min.css") }}">');
         printWindow.document.write('<body>');
         printWindow.document.write(printContent);
         printWindow.document.write('</body></html>');
         printWindow.document.close();

         printWindow.print()
   ;
        

      });
  });
</script>
@endpush
