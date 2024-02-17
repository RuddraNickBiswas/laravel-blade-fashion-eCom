@extends('frontend.layouts.master')

@section('content')
    <!-- Page Title
                      ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>Payment</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
                      ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="p-6 row  ">
                    <div class="col-md-6">
                        <a href="{{ route('order.payment.paypal', $order->id) }}"><img class="img-fluid" width="350"
                                src="data:image/png;base64,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"
                                alt=""></a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('order.payment.stripe', $order->id) }}"><img class="img-fluid" width="350"
                                src="data:image/png;base64,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"
                                alt=""></a>
                    </div>

                    <div class="col-md-6">
                        <a href=""><img class="img-fluid" width="350"
                                src="https://miro.medium.com/v2/resize:fit:500/1*5c8KOrF2CKKQCcY67sJDWA.jpeg"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- #content end -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        })
    </script>
@endpush
