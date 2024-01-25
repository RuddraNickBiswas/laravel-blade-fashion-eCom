<div>
    <div class="card">
        <div class="card-header">
            <h4>Add Image To Gellary</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.productGallery.store', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Product Thumbnail</label>
                    <div class="d-flex align-items-end mb-2">
                        <img id="GshowImage" src="" width="250" class="rounded me-2">
                    </div>
                    <input class="form-control " name="image" type="file" id="Gimage" />
                </div>
                <button class="btn btn-primary" type="submit">save</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>All Image</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($galleries as $image)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>delete image</h4>
                                <div class="card-header-action">
                                    <a  class="btn btn-danger delete-item" href=" {{ route('admin.product.productGallery.destroy', ['product' => $product->id, 'productGallery' => $image->id]) }} "
                                         >Delete</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="img-fluid" src=" {{ asset($image->path) }} " alt="">
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
