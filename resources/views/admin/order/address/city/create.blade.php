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

            <form action="{{ route('admin.order-city.store') }}" method="POST" >
                        @csrf
                        <h4>Add more parent category</h4>
                            <div class="form-group">
                                <label for="district">Select District:</label>
                                <select id="district" name="district_id" class="form-control">
                                    <option value="" disabled selected>Select District</option>
                                    @foreach ($districts as $district)
                                        <option  value="{{ $district->id }}">
                                            {{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>City Name</label>
                                <input type="text" name="name" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Delivery Charge</label>
                                <input type="number" step="any" name="delivery_charge" class="form-control" >
                            </div> 

                        <button class="btn btn-primary" type="submit">save</button>
                    </form>
                </div>
            </div>
          
@endsection

@push('scripts')
  
@endpush
