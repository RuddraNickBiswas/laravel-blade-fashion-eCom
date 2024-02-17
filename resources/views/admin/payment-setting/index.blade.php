@extends('admin.layouts.master')

@section('page-title', 'product edit')


@push('styles')
      <link rel="stylesheet" href=" {{ asset('frontend/assets/modules/summernote/summernote-bs4.css') }} ">
@endpush

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Product Edit </h4>
           
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h4>Product Edit Section</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="paypal-tab" data-toggle="tab" href="#paypal"
                                role="tab" aria-controls="home" aria-selected="true">PayPal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stripe-tab" data-toggle="tab" href="#stripe" role="tab"
                                aria-controls="profile" aria-selected="false">Stripe</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="size-tab" data-toggle="tab" href="#size" role="tab"
                                aria-controls="contact" aria-selected="false">Size</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab"
                                aria-controls="contact" aria-selected="false">Large Details</a>
                        </li> --}}
                    </ul>

                    {{-- Tab Content --}}
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">

                            @include('admin.payment-setting.payment-setting-tab.paypal-setting-tab')

                        </div>

                        <div class="tab-pane fade   show" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">

                           @include('admin.payment-setting.payment-setting-tab.stripe-setting-tab')

                        </div>
                        <div class="tab-pane fade  " id="size" role="tabpanel" aria-labelledby="size-tab">
                            {{-- @include('admin.product.edit-tabs.size-tab') --}}
                        </div>

                        <div class="tab-pane fade  " id="details" role="tabpanel" aria-labelledby="details-tab">
                            {{-- @include('admin.product.edit-tabs.large-details-tab') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

  <script src=" {{ asset('frontend/assets/modules/summernote/summernote-bs4.js') }}  "></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Gimage').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#GshowImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
