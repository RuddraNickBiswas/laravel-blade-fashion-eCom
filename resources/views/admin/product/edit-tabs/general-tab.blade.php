<form action="{{ route('admin.product.update', $product->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <label>Product Thumbnail</label>
        <div class="d-flex align-items-end mb-2">
            <img id="showImage" src="{{ asset($product->thumbnail_path) }}" width="250"
                class="rounded me-2">
            {{-- <img id="showImage" src="{{ auth()->user()->avater }}" width="150" class="rounded d-block"> --}}
        </div>
        <input class="form-control " name="thumbnail" type="file" id="image" />
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}">
    </div>
    <div class="form-group">
        <label>description</label>
        <textarea type="text" name="description" class="form-control"> {{ $product->description }}</textarea>
    </div>

    <div class="row form-group">
        <div class="col-md-4">
            <label for="price">price</label>
            <input type="number" class="form-control" name="price"
                value="{{ $product->price }}">
        </div>
        <div class="col-md-4">

            <label for="discounted_price">Discounted Price (optional)</label>
            <input type="number" class="form-control" name="discounted_price"
                value="{{ $product->discounted_price }}">
        </div>

        <div class="col-md-4">

            <label for="qty">QTY</label>
            <input type="number" class="form-control" name="qty"
                value="{{ $product->qty }}">
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