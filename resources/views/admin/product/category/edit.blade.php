@extends('admin.layouts.master')

@section('page-title', 'Create Category Group')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Available Category</h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.category-group.create') }} " class="btn btn-primary">
                    Crete
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-5">
                @foreach ($parentCategories as $parentCategory)
                    <a href="#" class="badge badge-primary"> {{ $parentCategory->name }} </a>
                @endforeach
            </div>

            <form action="{{ route('admin.category.store') }}" method="POST" ">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" ">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Add|Select Parent Category</label>
                    <select name="parent_id" class="form-control select2">
                        <option value="" {{ is_null($category->parent_id) ? 'selected' : '' }}>No Parent Category
                        </option>
                        @foreach ($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}"
                                {{ $parentCategory->id == $category->parent_id ? 'selected' : '' }}>
                                {{ $parentCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>
                <button class="btn btn-primary" type="submit">save</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
