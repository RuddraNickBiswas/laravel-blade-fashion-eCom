@extends('frontend.layouts.master')

@section('content')
    <!-- Page Title
          ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>Checkout</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
          ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row col-mb-50 gutter-50">
                    <div class="col-lg-6">
                        <h3>Create Your Order</h3>


                        <form id="checkoutForm" name="billing-form" class="row mb-0" action="{{ route('checkout.store') }}"
                            method="post">

                            @csrf

                            <div class="col-md-12 form-group">
                                <label for="billing-form-lname">Full Name:</label>
                                <input type="text" id="billing-form-lname" name="name"
                                    value="{{ auth()->user()->name }}" class="sm-form-control" />
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-6 form-group">
                                <label for="billing-form-email">Email Address:</label>
                                <input type="email" id="billing-form-email" name="email"
                                    value="{{ auth()->user()->email }}" class="sm-form-control" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="billing-form-phone">Phone Number:</label>
                                <input type="tel" id="billing-form-phone" name="phone" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="col-12 form-group">
                                <label for="district">Select District:</label>
                                <select id="district" name="district" class="form-control">
                                    <option value="" disabled selected>Select District</option>
                                    @foreach ($districts as $district)
                                        <option @selected($district->id === $selectedDistrict->id) value="{{ $district->id }}">
                                            {{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="city">Select City:</label>
                                <select id="city" name="city" class="form-control">
                                    @foreach ($selectedDistrict->cities as $city)
                                        <option @selected($city->id === $selectedCity->id) value="{{ $city->id }}"
                                            data-delivery-charge="{{ $city->delivery_charge }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="billing-form-city">Address:(must be incide city)</label>
                                <input type="text" id="billing-form-city" name="address" value=""
                                    class="sm-form-control" />
                            </div>



                        </form>
                    </div>

                    <div class="col-lg-6">
                        <h3>Your Orders</h3>

                        <div class="table-responsive">
                            <table class="table cart">
                                <thead>
                                    <tr>
                                        <th class="cart-product-thumbnail">&nbsp;</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-name">size</th>
                                        <th class="cart-product-quantity">Quantity</th>
                                        <th class="cart-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $cartProduct)
                                        <tr class="cart_item">
                                            <td class="cart-product-thumbnail">
                                                <a href="#"><img width="64" height="64"
                                                        src="{{ asset($cartProduct->options->product_info['thumbnail_path']) }}"
                                                        alt="Pink Printed Dress"></a>
                                            </td>

                                            <td class="cart-product-name">
                                                <a href="#"> {{ $cartProduct->name }} </a>
                                            </td>
                                            <td class="cart-product-name">
                                                <a href="#" class="color"> {{ $cartProduct->options->size['name'] }}
                                                </a>
                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="quantity clearfix">
                                                    {{ $cartProduct->qty }}
                                                </div>
                                            </td>

                                            <td class="cart-product-subtotal">
                                                <span
                                                    class="amount color">{{ currencyPosition(cartProductTotal($cartProduct->rowId)) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>

                    <div class="w-100"></div>

                    <div class="col-lg-6">
                        <h4>Cart Totals</h4>

                        <div class="table-responsive">
                            <table class="table cart cart-totals">
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Cart Subtotal</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span id="cartSubTotal" data-value="{{ cartTotal() }}" class="amount">
                                                {{ currencyPosition(cartTotal()) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Shipping</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span id="deliveryFee"
                                                class="amount">{{ $selectedCity->delivery_charge }}</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Total</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span class="amount color lead" id="cartGrandTotal"><strong>
                                                    {{ currencyPosition(cartTotal()) }}
                                                </strong></span>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h4>Payment Method</h4>
                        <div class="accordion clearfix">
                            <div class="accordion-header">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-line-minus"></i>
                                    <i class="accordion-open icon-line-check"></i>
                                </div>
                                <div class="accordion-title">
                                    Cash On
                                </div>
                            </div>
                            <div class="accordion-content clearfix">Donec sed odio dui. Nulla vitae elit libero, a pharetra
                                augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante
                                venenatis dapibus posuere velit aliquet.</div>


                        </div>
                        <button id="checkoutFormSubmit" class="button button-3d float-end">Place Order</button>


                    </div>
                </div>
            </div>
        </div>
    </section><!-- #content end -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#district').on('change', function() {
                var districtId = $(this).val();

                if (districtId) {
                    $('#city').prop('disabled', true);

                    $.ajax({
                        url: '/get-cities/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#city').empty();
                            $('#city').append('<option  value="">Select City</option>');

                            $.each(data, function(key, value) {
                                $('#city').append('<option value="' + value.id +
                                    '" data-delivery-charge="' + value
                                    .delivery_charge + '" >' +
                                    value.name + '</option>');
                            });

                            $('#city').prop('disabled', false);
                        }
                    });
                } else {
                    $('#city').empty();
                    $('#city').prop('disabled', true);
                }
            });

            $('#city').on('change', function() {
                const selectedCityEl = $(this).find(':selected');
                let deliveryCharge = selectedCityEl.data('delivery-charge');
                const cartSubTotalEl = $('#cartSubTotal');
                let cartSubTotal = cartSubTotalEl.data('value');

                updateCartTotals(cartSubTotal);

                const deliveryEL = $('#deliveryFee');

                deliveryEL.text("{{ currencyPosition(':amount') }}".replace(':amount', deliveryCharge));


            });

            function getCurrentDeliveryCharge() {
                let selectedCity = $('#city').find(':selected');
                let deliveryCharge = parseFloat(selectedCity.data('delivery-charge'));

                // Check if deliveryCharge is a valid number
                if (!isNaN(deliveryCharge)) {
                    return deliveryCharge.toFixed(2);
                } else {
                    return 0;
                }
            }

            function updateCartTotals(cartSubTotal) {
                const cartSubTotalEl = $('#cartSubTotal');
                const cartGrandTotalEl = $('#cartGrandTotal');


                const currentDeliveryCharge = parseFloat(getCurrentDeliveryCharge());

                const cartGrandTotal = cartSubTotal + currentDeliveryCharge;

                cartSubTotalEl.text("{{ currencyPosition(':amount') }}".replace(':amount', cartSubTotal.toFixed(
                    2)));
                cartSubTotalEl.data('value', cartSubTotal);

                cartGrandTotalEl.text("{{ currencyPosition(':amount') }}".replace(':amount', cartGrandTotal
                    .toFixed(2)));

            }



        });


        $('#checkoutFormSubmit').on('click', function() {

            $('#checkoutForm').submit();
        });
    </script>
@endpush
