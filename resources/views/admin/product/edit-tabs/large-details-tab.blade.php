<div class="card">
    <form action="{{ route('admin.product.productDetails.store', $product->id) }}" method="POST">
        <div class="card-header">
            <h4>Add size to product</h4>
            <div class="card-header-action">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
        <div class="card-body">
            @csrf
            <textarea class="summernote" name="data"> {{$details?->data }}</textarea>
    </form>
</div>
