@extends('admin.layouts.master')

@section('page-title', 'Category Group')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> All category group </h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.category-group.create') }} " class="btn btn-primary">
                    Crete
                </a>
            </div>
        </div>
        <div class="card-body">
           {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
