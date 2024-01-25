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


                        <form id="billing-form" name="billing-form" class="row mb-0" action="#" method="post">

                            <div class="col-md-6 form-group">
                                <label for="billing-form-name">Name:</label>
                                <input type="text" id="billing-form-name" name="billing-form-name" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="billing-form-lname">Last Name:</label>
                                <input type="text" id="billing-form-lname" name="billing-form-lname" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="w-100"></div>

                            <div class="col-12 form-group">
                                <label for="billing-form-companyname">Company Name:</label>
                                <input type="text" id="billing-form-companyname" name="billing-form-companyname"
                                    value="" class="sm-form-control" />
                            </div>

                            <div class="col-12 form-group">
                                <label for="billing-form-address">Address:</label>
                                <input type="text" id="billing-form-address" name="billing-form-address" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="col-12 form-group">
                                <input type="text" id="billing-form-address2" name="billing-form-adress" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="col-12 form-group">
                                <label for="billing-form-city">City / Town</label>
                                <input type="text" id="billing-form-city" name="billing-form-city" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="billing-form-email">Email Address:</label>
                                <input type="email" id="billing-form-email" name="billing-form-email" value=""
                                    class="sm-form-control" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="billing-form-phone">Phone:</label>
                                <input type="text" id="billing-form-phone" name="billing-form-phone" value=""
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
                                                        src="{{ $cartProduct->options->product_info['thumbnail_path'] }}"
                                                        alt="Pink Printed Dress"></a>
                                            </td>

                                            <td class="cart-product-name">
                                                <a href="#"> {{ $cartProduct->name }} </a>
                                            </td>
                                            <td class="cart-product-name">
                                                <a href="#" class="color"> {{ $cartProduct->options->size['name'] }} </a>
                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="quantity clearfix">
                                                    {{ $cartProduct->qty }}
                                                </div>
                                            </td>

                                            <td class="cart-product-subtotal">
                                                <span class="amount color">$ {{ cartProductTotal($cartProduct->rowId) }} </span>
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
                            <table class="table cart">
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="border-top-0 cart-product-name">
                                            <strong>Cart Subtotal</strong>
                                        </td>

                                        <td class="border-top-0 cart-product-name">
                                            <span class="amount">$106.94</span>
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
                                            <span class="amount color lead"><strong>$106.94</strong></span>
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
                        <a href="#" class="button button-3d float-end">Place Order</a>


                    </div>
                </div>
            </div>
        </div>
    </section><!-- #content end -->
@endsection
