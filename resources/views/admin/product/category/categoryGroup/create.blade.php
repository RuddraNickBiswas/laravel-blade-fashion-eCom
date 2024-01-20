@extends('admin.layouts.master')

@section('page-title', 'Create Category Group')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Create category group </h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.category-group.create') }} " class="btn btn-primary">
                    Crete
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category-group.store') }}" method="POST" ">
                @csrf
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
