@extends('admin.layouts.master')

@section('page-title', 'Create Category Group')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> District </h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.order-district.index') }} " class="btn btn-primary">
                    Index
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="mb-5">
                @foreach ($parentCategories as $parentCategory)
                    <a href="#" class="badge badge-primary"> {{ $parentCategory->name }} </a>
                @endforeach
            </div> --}}

            <form action="{{ route('admin.order-district.store') }}" method="POST" >
                        @csrf
                        <h4>Add more parent category</h4>
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
                        <button class="btn btn-primary" type="submit">save</button>
                    </form>
                </div>
            </div>
          
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
