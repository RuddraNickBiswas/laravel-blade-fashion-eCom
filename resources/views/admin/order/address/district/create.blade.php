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
           

            <form action="{{ route('admin.order-district.store') }}" method="POST" >
                        @csrf
                        <h4>Add more parent category</h4>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <button class="btn btn-primary" type="submit">save</button>
                    </form>
                </div>
            </div>
          
@endsection

@push('scripts')
@endpush
