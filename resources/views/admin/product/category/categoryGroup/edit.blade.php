@extends('admin.layouts.master')

@section('page-title', 'Update Category Group')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Update category group </h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.category-group.create') }} " class="btn btn-primary">
                    Crete
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category-group.update', $categoryGroup->id) }}" method="POST" ">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $categoryGroup->name }}" >
                </div>
                <button class="btn btn-primary" type="submit">update</button>
            </form> 
        </div>
    </div>
@endsection

@push('scripts')
  
@endpush
