<div>
    <div class="card">
        <div class="card-header">
            <h4>Add size to product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.productSize.store', $product->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>product size</label>
                    <input class="form-control " name="name" type="text" />
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="col">SIZE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sizes as $key => $size)
                        <tr>
                            <th scope="row">{{ ++$key }} </th>
                            <td> {{ $size->name }} </td>
                            <td>
                                <a class="btn btn-danger delete-item"
                                    href=" {{ route('admin.product.productSize.destroy', ['product' => $product->id, 'productSize' => $size->id]) }} ">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
