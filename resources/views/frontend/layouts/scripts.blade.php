<script>
    function loadProductModal(productId) {
        $.ajax({
            method: "GET",
            url: '{{ route('load-product-modal', ':productId') }}'.replace(
                ':productId',
                productId
            ),
            success: function(response) {
                $('.load-product-modal-body').html(response)
                $('#cartModal').modal('show')
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
        });
    }

    function updateSidebarCart() {
        $.ajax({
            method: "GET",
            url: '{{route("get-cart-product")}}',
            data: '',
            beforeSend: function() {
            },
            success: function(response) {
                $('#headerCartContent').html(response);
               let cartTotal = $('#cartTotal').val()
                let cartTotalCount = $('#cartTotalCountI').val()
                $('#headerCartTotal').text("$" + cartTotal);
                $('#cartItemCount').text(cartTotalCount);
                toastr.success(response.message)
            },
            error: function(xhr, status, error) {
                // toastr.error(xhr.responseJSON.message);
                console.error(error)
            },
            complete: function() {


            }
        })
    }
</script>
