function loadProductModal(productId) {
    $.ajax({
        method: "GET",
        url: '{{ route("load-product-modal", :productId) }}'.replace(
            ":productId",
            productId
        ),
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}
