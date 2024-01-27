@extends('frontend.layouts.master')

@section('content')
    <!-- Page Title
                                                                      ============================================= -->
    <section id="page-title">

        <div class="container">
            <h1>Cart</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content                                                              ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <table class="table cart mb-5">
                    <thead>
                        <tr>
                            <th class="cart-product-remove">&nbsp;</th>
                            <th class="cart-product-thumbnail">&nbsp;</th>
                            <th class="cart-product-name">Product</th>
                            <th class="cart-product-name">size</th>
                            <th class="cart-product-price">Unit Price</th>
                            <th class="cart-product-quantity">Quantity</th>
                            <th class="cart-product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $cartProduct)
                            <tr class="cart_item">
                                <td class="remove">
                                    <a class="remove-cart-product" data-id="{{ $cartProduct->rowId }}" href="javascript:;"
                                        title="Remove this item"><i class="icon-trash2"></i></a>
                                </td>

                                <td class="cart-product-thumbnail">
                                    <a href="#"><img width="64" height="64"
                                            src="{{ asset($cartProduct->options->product_info['thumbnail_path']) }}"
                                            alt="Pink Printed Dress"></a>
                                </td>


                                <td class="cart-product-name">
                                    <a href="#"> {{ $cartProduct->name }} </a>
                                </td>
                                <td class="cart-product-size">
                                    <a href="#"> {{ $cartProduct->options->size['name'] }} </a>
                                </td>

                                <td class="cart-product-price">
                                    <span class="amount"> {{ currencyPosition($cartProduct->price) }} </span>
                                </td>

                                <td class="cart-product-quantity">
                                    <div class="quantity">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" name="qty" data-id="{{ $cartProduct->rowId }}"
                                            value="{{ $cartProduct->qty }}" class="qty" />
                                        <input type="button" value="+" class="plus">
                                    </div>
                                </td>

                                <td class="cart-product-subtotal">
                                    <span
                                        class="amount">{{ currencyPosition(cartProductTotal($cartProduct->rowId)) }}</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>


                <div class="row col-mb-30">
                    <div class="col-lg-6">
                        <h4>Calculate Shipping</h4>
                        <form action="{{ route('checkout.create') }}" class="row">
                            <div class="col-12 form-group">
                                <label for="district">Select District:</label>
                                <select id="district" name="district" class="form-control">
                                    <option value="" disabled selected>Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="city">Select City:</label>
                                <select id="city" name="city" class="form-control" disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="me-auto">
                                <button type="submit" class="button button-desc ">
                                    <div> Checkout </div>
                                    <span>Go To Checkout Page</span>
                                </button>
                            </div>
        
                        </form>
                    </div>

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
                                            <span id="cartSubTotal" data-value="{{ cartTotal() }}" class="amount"> {{ currencyPosition(cartTotal()) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Shipping</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span id="deliveryFee" class="amount">Pleace Select An Area</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Total</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span  class="amount color lead" id="cartGrandTotal"><strong>
                                                    {{ currencyPosition(cartTotal()) }}
                                                </strong></span>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
             


            </div>

        </div>
        </div>
    </section><!-- #content end -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('input[name="qty"]').on('change', function(e) {
                let qty = $(this).val();
                let rowId = $(this).data('id');

                let qtyElement = $(this);

                cartQtyUpdate(rowId, qty, function(response) {
                    let cartProductTotal = response.cart_product_total;
                    let cartSubTotal = response.cart_total;
                    if (response.status === 'success') {
                        // Table row subtotal update
                        qtyElement.closest('tr').find('.cart-product-subtotal span').text(
                            "{{ currencyPosition(':amount') }}".replace(':amount',
                                cartProductTotal.toFixed(2)));

                        updateCartTotals(cartSubTotal);

                    } else if (response.status === 'error') {
                        qtyElement.val(response.qty)
                        toastr.error(response.message);
                    }


                })
            });



            function cartQtyUpdate(rowId, qty, callback) {
                $.ajax({
                    type: "post",
                    url: "{{ route('cart.update-qty') }}",
                    data: {
                        'rowId': rowId,
                        'qty': qty,
                    },
                    beforeSend: function() {

                    },

                    success: function(response) {
                        if (callback && typeof callback === 'function') {
                            callback(response);
                        }
                    },

                    error: function(xhr, status, error) {

                    },

                    complete: function() {

                    }
                });
            }

            $('.remove-cart-product').on('click', function(e) {
                e.preventDefault();
                rowId = $(this).data('id');
                removeCartProduct(rowId);
                $(this).closest('tr').remove();
            });

            function removeCartProduct($rowId) {
                $.ajax({
                    type: "get",
                    url: "{{ route('remove-cart-product', ':rowId') }}".replace(':rowId', $rowId),
                    data: "",
                    beforeSend: function() {

                    },

                    success: function(response) {
                        updateSidebarCart();
                    },

                    error: function(xhr, status, error) {

                    },

                    complete: function() {

                    }
                });
            }


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
    </script>
@endpush
