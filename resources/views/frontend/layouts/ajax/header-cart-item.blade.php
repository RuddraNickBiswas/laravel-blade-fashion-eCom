<input type="hidden" value="{{ cartTotal() }}" id="cartTotal">
<input type="hidden" value="{{ count(Cart::content()) }}" id="cartTotalCountI">
@foreach (Cart::content() as $cartProduct)
    <div class="top-cart-item">
        <div class="top-cart-item-image">
            <a href="#"><img src=" {{ asset($cartProduct->options->product_info['thumbnail_path']) }} "
                    alt="Blue Round-Neck Tshirt" /></a>
        </div>
        <div class="top-cart-item-desc">
            <div class="top-cart-item-desc-title">
                <a
                    href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{{ $cartProduct->name }}</a>
                <div class="d-flex ">
                    <span class="top-cart-item-price d-block me-2">${{ $cartProduct->price }} </span>
                    <span class="top-cart-item-price d-block">{{ $cartProduct->options->size['name'] }}</span>
                </div>
            </div>
            <div class="d-flex flex-column ">
                <div class="top-cart-item-quantity">x {{ $cartProduct->qty }}</div>
                <a href="javascript:;" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')" class="color">
                    <i class="icon-line2-close "></i></a>
            </div>
        </div>
    </div>
@endforeach
