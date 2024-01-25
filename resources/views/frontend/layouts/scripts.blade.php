<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('body').on('click', '.delete-item', function(e) {

        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                        method: "DELETE",
                        url: url,

                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);

                                window.location.reload();

                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                            } else if (response.status === 'error') {
                                toastr.error(response.message);
                            }
                        },
                        error: function(error) {
                            console.error(error);
                        },
                    },

                )

            }
        });
    })

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
            url: '{{ route('get-cart-product') }}',
            data: '',
            beforeSend: function() {},
            success: function(response) {
                $('#headerCartContent').html(response);
                let cartTotal = $('#cartTotal').val()
                let cartTotalCount = $('#cartTotalCountI').val()
                $('#headerCartTotal').text("$" + cartTotal);
                $('#cartItemCount').text(cartTotalCount);
                // toastr is not needed its just reloading heading cart
                // toastr.success(response.message)
            },
            error: function(xhr, status, error) {
                toastr.error(xhr.responseJSON.message);
                console.error(error)
            },
            complete: function() {}
        })
    }

    function removeProductFromSidebar(rowId) {
        $.ajax({
            method: "GET",
            url: "{{ route('remove-cart-product', ':rowId') }}".replace(":rowId", rowId),
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);
                    updateSidebarCart();
                }
            },
            error: function(xhr, status, error) {
                toastr.error(xhr.responseJSON.message);
                console.log(error);
            }
        });
    }
</script>
