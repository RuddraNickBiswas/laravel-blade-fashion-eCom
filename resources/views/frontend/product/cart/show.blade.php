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

    <!-- Content
                                  ============================================= -->
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
                                    <span class="amount">$ {{ $cartProduct->price }} </span>
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
                                    <span class="amount">$ {{ cartProductTotal($cartProduct->rowId) }} </span>
                                </td>
                            </tr>
                        @endforeach
                        {{-- redeem code option --}}
                        {{-- <tr class="cart_item">
							<td colspan="6">
								<div class="row justify-content-between py-2 col-mb-30">
									<div class="col-lg-auto ps-lg-0">
										<div class="row">
											<div class="col-md-8">
												<input type="text" value="" class="sm-form-control text-center text-md-start" placeholder="Enter Coupon Code.." />
											</div>
											<div class="col-md-4 mt-3 mt-md-0">
												<a href="#" class="button button-3d button-black m-0">Apply Coupon</a>
											</div>
										</div>
									</div>
									<div class="col-lg-auto pe-lg-0">
										<a href="#" class="button button-3d m-0">Update Cart</a>
									</div>
								</div>
							</td>
						</tr>	 --}}
                    </tbody>

                </table>

                <div class="row d-flex align-items-end justify-content-end col-mb-30">

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
                                            <span class="amount">$ {{ cartTotal() }} </span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Shipping</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span class="amount">Free Delivery</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Total</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span class="amount color lead"><strong>$ {{ cartTotal() }} </strong></span>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('checkout.create') }}" class="button button-desc ms-lg-4">
                            <div> Checkout </div>
                            <span>Free Forever, Enjoy Free Shipping</span>
                        </a>
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
                    if (response.status === 'success') {
                        qtyElement.closest('tr').find('.cart-product-subtotal span').text("$" +
                            cartProductTotal);
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



        });
    </script>
@endpush
