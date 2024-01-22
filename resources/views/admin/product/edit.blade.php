@extends('admin.layouts.master')

@section('page-title', 'product edit')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4> Product Edit </h4>
            <div class="card-header-action">
                <a href=" {{ route('admin.product.index') }} " class="btn btn-primary">
                    {{ $product->name }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h4>Product Edit Section</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general"
                                role="tab" aria-controls="home" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab"
                                aria-controls="profile" aria-selected="false">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="size-tab" data-toggle="tab" href="#size" role="tab"
                                aria-controls="contact" aria-selected="false">Size</a>
                        </li>
                    </ul>

                    {{-- Tab Content --}}
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">

                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" ">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{ $product->name }}" >
                                </div>
                 <div class="form-group">
                                    <label>description</label>
                                    <textarea type="text" name="description" class="form-control"> {{ $product->description }}</textarea>
                                </div>
                               
                                    <div class="row form-group" >
                                        <div  class="col-md-4">
                                    <label for="price">price</label>
                                    <input type="number" class="form-control" name="price"  value="{{ $product->price }}">
                                        </div>
                                        <div  class="col-md-4">

                                    <label for="discounted_price">Discounted Price  (optional)</label>
                                    <input type="number" class="form-control" name="discounted_price" value="{{ $product->discounted_price }}">
                                        </div>

                                        <div  class="col-md-4">

                                    <label for="qty">QTY</label>
                                    <input type="number" class="form-control" name="qty" value="{{ $product->qty }}">
                                        </div>

                                    </div>
         <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control select2">
                                {{-- <option value="" {{ is_null($product->category_id) ? 'selected' : '' }}>No Parent Category --}}
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit">save</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">

                    </div>
                    <div class="tab-pane fade" id="size" role="tabpanel" aria-labelledby="size-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection