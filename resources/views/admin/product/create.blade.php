@extends('admin.layouts.master')

@section('page-title', 'Product Create')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Product Create </h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.product.index') }} " class="btn btn-primary">
                    index
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Product Thumbnail</label>
                    <div class="d-flex align-items-end mb-2">
                        <img id="showImage" src="" width="250" class="rounded me-2">
                        {{-- <img id="showImage" src="{{ auth()->user()->avater }}" width="150" class="rounded d-block"> --}}
                    </div>
                    <input id="productThumbnail" class="form-control " name="thumbnail" type="file"  />
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>description</label>
                    <textarea type="text" name="description" class="form-control"> </textarea>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        <label for="price">price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="col-md-4">

                        <label for="discounted_price">Discounted Price (optional)</label>
                        <input type="number" class="form-control" name="discounted_price">
                    </div>

                    <div class="col-md-4">

                        <label for="qty">QTY</label>
                        <input type="number" class="form-control" name="qty">
                    </div>

                </div>
                <div class="row form-group">
                    <div class=" col-md-6" >
                        <label>Group</label>
                        <select name="group" class="form-control ">
                                <option value="all">All</option>
                                <option value="man">Man</option>
                                <option value="women">women</option>
                        </select>
                    </div>
                    <div class=" col-md-6" >
                        <label>Category</label>
                        <select name="category_id" class="form-control select2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <button class="btn btn-primary" type="submit">save</button>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
        <script type="text/javascript">
        $(document).ready(function() {
            $('#productThumbnail').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        </script>
@endpush