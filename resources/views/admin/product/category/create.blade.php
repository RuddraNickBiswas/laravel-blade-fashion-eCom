@extends('admin.layouts.master')

@section('page-title', 'Create Category Group')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Create Parent Category</h4>
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h4> Create category withen parents </h4>
                        <div class="card-header-action">
                            <a href=" {{ route('admin.category-group.create') }} " class="btn btn-primary">
                                Crete
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.store') }}" method="POST" ">
                @csrf

                <div class="form-group">
                    <label>Parent Category</label>
                    <select name="parent_id" class="form-control select2">
                        @foreach ($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}"> {{ $parentCategory->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">save</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
