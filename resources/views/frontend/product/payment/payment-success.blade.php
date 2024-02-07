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
                <div class="section center bg-transparent">
                    <div style="font-size: 4rem" class="fw-bold flip animated color" data-animate="flip">
                        <i  style="font-size: 6rem" class="icon-line-check-circle "></i>
                        <p>SUCCESS</p>
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
