 <div class="modal-header">
     <h4 class="modal-title" id="productModal">Product Modal</h4>
     <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
 </div>
 <div class="modal-body ">
     <div class="row mb-4">
         <div class="col-6">
             <img src="{{ asset($product->thumbnail_path) }}" alt="" height="300px" class="img-fluid">
         </div>
         <div class="col-6">
             <h4 class="mb-4">{{ $product->name }}</h4>
             <p> {{ $product->description }} </p>
             @if ($product->discounted_price)
                 <div class="product-price font-primary "><del class="me-1"> ${{ $product->price }} </del> <ins>
                         ${{ $product->discounted_price }} </ins></div>
                 <input type="hidden" name="base_price" value="{{ $product->discounted_price }}">
             @else
                 <div class="product-price font-primary"><ins>
                         ${{ $product->price }} </ins></div>
                 <input type="hidden" name="base_price" value="{{ $product->price }}">
             @endif
         </div>
     </div>

     <form action="#" method="post" class="row mb-0" id="addToCartModalForm" name="addToCartModalForm">
         @csrf
         <input type="hidden" name="productId" value="{{ $product->id }}">

         <div class="quantity col-4">
             <input type="button" value="-" class="minus">
             <input type="number" step="1" min="1" name="qty" value="1" title="Qty"
                 class="qty" />
             <input type="button" value="+" class="plus">
         </div>
         <div class="col-12">
             <label> Size </label>
             <div role="group">
                 @foreach ($product->sizes as $size)
                     <input class="btn-check" type="radio" name="size" id="{{ $size->slug }}" autocomplete="off"
                         value="{{ $size->id }}">
                     <label for="{{ $size->slug }}"
                         class="btn btn-sm btn-outline-secondary fw-normal ls0 nott">{{ $size->name }}</label>
                 @endforeach
             </div>
         </div>
     </form>

 </div>

 <div class="modal-footer w-100 d-flex">

     <h4 class="me-auto"> Total: <span class="color total-product-price">$234</span> </h4>
     <a type="button" class="button button-rounded ">Details</a>
     <button type="button" id="addToCartBtn" class="button button-rounded">Add to cart</button>
 </div>


 <script>
     $(document).ready(function() {

         $(".plus").on("click", function() {
             const input = $(this).siblings(".qty");
             let currentVal = parseInt(input.val());

             if (!isNaN(currentVal)) {
                 input.val(currentVal + 1);
                 input.trigger('change'); // Trigger the change event manually
             }
         });

         $(".minus").on("click", function() {
             const input = $(this).siblings(".qty");
             let currentVal = parseInt(input.val());

             if (!isNaN(currentVal) && currentVal > 1) {
                 input.val(currentVal - 1);
                 input.trigger('change'); // Trigger the change event manually
             }
         });

         $('input[name="qty"]').on('change', function(e) {
             updateTotalPrice();
         });


         function updateTotalPrice() {
             // let size = $('input[name="size"]:checked').val()
             let qty = parseInt($('input[name="qty"]').val())
             let basePrice = parseFloat($('input[name="base_price"]').val());

             if (!isNaN(qty) && !isNaN(basePrice)) {
                 let subtotal = qty * basePrice;
                 $(".total-product-price").text('$' + subtotal.toFixed(2));
             }

         }

         $("#addToCartBtn").on("click", function() {
             // Trigger form submission
             $("#addToCartModalForm").submit();
         });
         $("#addToCartModalForm").on('submit', function(e) {

             e.preventDefault();

             let size = parseInt($('input[name="size"]:checked').val())

             if (!size) {
                 toastr.error('Please select a size');
                 return;
             }


             let formData = $(this).serialize();

             $.ajax({
                 method: "POST",
                 url: '{{ route('add-to-cart') }}',
                 data: formData,
                 beforeSend: function() {
                     $('#addToCartBtn').attr('disabled', true)
                     $('#addToCartBtn').html(
                         '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>'
                     )
                 },
                 success: function(response) {
                    updateSidebarCart()
                     toastr.success(response.message)
                 },
                 error: function(xhr, status, error) {
                     toastr.error(xhr.responseJSON.message);
                     console.error(error)
                 },
                 complete: function() {

                     $('#addToCartBtn').attr('disabled', false)
                     $('#addToCartBtn').html('add to cart')
                 }
             })
         })
     })
 </script>
