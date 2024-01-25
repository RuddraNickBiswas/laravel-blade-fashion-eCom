@extends('frontend.layouts.master')

@section('content')
    <!-- Page Title
      ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1> {{ $product->name }} </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
            </ol>
        </div>

    </section><!-- #page-title end -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="single-product">
                    <div class="product">
                        <div class="row  gutter-40">
                            <div class="col-lg-9 ">
                                <div class="row gutter-40">

                                    <div class="col-md-6">

                                        <!-- Product Single - Gallery
                                        ============================================= -->
                                        <div class="product-image" style="overflow: visible;">
                                            <div id="oc-images" class="owl-carousel image-carousel carousel-widget"
                                                data-lightbox="gallery" data-margin="0" data-items="1" data-pagi="false"
                                                data-autoplay="6000" data-loop="true">
                                                @foreach ($galleries as $image)
                                                    <div class="oc-item">
                                                        <a href=" {{ asset($image->path) }} "
                                                            title="Pink Printed Dress - Front View"
                                                            data-lightbox="gallery-item"><img
                                                                src="{{ asset($image->path) }}"
                                                                alt="Pink Printed Dress"></a>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div><!-- Product Single - Gallery End -->

                                        <div id="linked-to-gallery" style="margin-top: 4px;">
                                            <div id="oc-images-linker" class="owl-carousel image-carousel carousel-widget"
                                                data-margin="4" data-items="4" data-pagi="false" data-loop="true">
                                                @foreach ($galleries as $key => $image)
                                                    <div class="oc-item">
                                                        <a href="#" data-image="{{ ++$key }}"><img
                                                                src="{{ asset($image->path) }}"
                                                                alt="Gallery Thumb  {{ ++$key }} "></a>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6 product-desc">

                                        <div class="d-flex align-items-center justify-content-between">

                                            <!-- Product Single - Price
                                            ============================================= -->
                                            @if ($product->discounted_price)
                                                <div class="product-price"><del>$ {{ $product->price }} </del> <ins>
                                                        {{ $product->discounted_price }} </ins></div>
                                                <!-- Product Single - Price End -->
                                            @else
                                                <div class="product-price"><ins>$ {{ $product->price }} </ins></div>
                                                <!-- Product Single - Price End -->
                                            @endif

                                            <!-- Product Single - Rating
                                            ============================================= -->
                                            <div class="product-rating">
                                                <i class="icon-star3"></i>
                                                <i class="icon-star3"></i>
                                                <i class="icon-star3"></i>
                                                <i class="icon-star-half-full"></i>
                                                <i class="icon-star-empty"></i>
                                            </div><!-- Product Single - Rating End -->

                                        </div>

                                        <div class="line"></div>

                                        <!-- Product Single - Quantity & Cart Button
                                        ============================================= -->
                                        <div class="cart mb-0 d-flex justify-content-between align-items-center"
                                            >
                                            <div class="d-flex justify-content-between  text-center w-100 align-items-center">
                                                {{-- <input type="button" value="-" class="minus">
                                                <input type="number" step="1" min="1" name="quantity"
                                                    value="1" title="Qty" class="qty" />
                                                <input type="button" value="+" class="plus"> --}}
                                                <div >  QTY : <span class="color"> {{ $product->qty }} left </span>  </div>
                                            </div>
                                            <button onclick="loadProductModal({{ $product->id }})" class="add-to-cart button m-0">Add to cart</button>
                                        </div><!-- Product Single - Quantity & Cart Button End -->

                                        <div class="line"></div>

                                        <!-- Product Single - Short Description
                                        ============================================= -->
                                        <p> {{ $product->description }} </p>
                                        {{-- productOption --}}
                                        <ul class="iconlist">
                                            <li><i class="icon-caret-right"></i> Dynamic Color Options</li>
                                            <li><i class="icon-caret-right"></i> Lots of Size Options</li>
                                            <li><i class="icon-caret-right"></i> 30-Day Return Policy</li>
                                        </ul><!-- Product Single - Short Description End -->

                                        <!-- Product Single - Meta
                                        ============================================= -->
                                        <div class="card product-meta">
                                            <div class="card-body">
                                                <span itemprop="productID" class="sku_wrapper">SKU: <span
                                                        class="sku">8465415</span></span>
                                                <span class="posted_in">Category: <a href="#" rel="tag">
                                                        {{ $product->category->name }} </a>.</span>
                                                {{-- Tag Feature Will Added if needed --}}
                                                <span class="tagged_as">Size:
                                                    @foreach ($sizes as $size)
                                                        <a href="#" class="me-2" rel="tag">
                                                            {{ $size->name }} </a>
                                                    @endforeach
                                            </div>
                                        </div><!-- Product Single - Meta End -->

                                        <!-- Product Single - Share
                                        ============================================= -->
                                        {{-- <div class="si-share border-0 d-flex justify-content-between align-items-center mt-4">
                                        <span>Share:</span>
                                        <div>
                                            <a href="#" class="social-icon si-borderless si-facebook">
                                                <i class="icon-facebook"></i>
                                                <i class="icon-facebook"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-twitter">
                                                <i class="icon-twitter"></i>
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-pinterest">
                                                <i class="icon-pinterest"></i>
                                                <i class="icon-pinterest"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-gplus">
                                                <i class="icon-gplus"></i>
                                                <i class="icon-gplus"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-rss">
                                                <i class="icon-rss"></i>
                                                <i class="icon-rss"></i>
                                            </a>
                                            <a href="#" class="social-icon si-borderless si-email3">
                                                <i class="icon-email3"></i>
                                                <i class="icon-email3"></i>
                                            </a>
                                        </div>
                                    </div> --}}
                                        <!-- Product Single - Share End -->

                                    </div>

                                    {{-- <div class="col-md-3">
        
                                    <a href="#" title="Brand Logo" class="d-none d-md-block"><img src="images/shop/brand.jpg" alt="Brand Logo"></a>
        
                                    <div class="divider divider-center"><i class="icon-circle-blank"></i></div>
        
                                    <div class="feature-box fbox-plain fbox-dark fbox-sm">
                                        <div class="fbox-icon">
                                            <i class="icon-thumbs-up2"></i>
                                        </div>
                                        <div class="fbox-content fbox-content-sm">
                                            <h3>100% Original</h3>
                                            <p class="mt-0">We guarantee you the sale of Original Brands.</p>
                                        </div>
                                    </div>
        
                                    <div class="feature-box fbox-plain fbox-dark fbox-sm mt-4">
                                        <div class="fbox-icon">
                                            <i class="icon-credit-cards"></i>
                                        </div>
                                        <div class="fbox-content fbox-content-sm">
                                            <h3>Payment Options</h3>
                                            <p class="mt-0">We accept Visa, MasterCard and American Express.</p>
                                        </div>
                                    </div>
        
                                    <div class="feature-box fbox-plain fbox-dark fbox-sm mt-4">
                                        <div class="fbox-icon">
                                            <i class="icon-truck2"></i>
                                        </div>
                                        <div class="fbox-content fbox-content-sm">
                                            <h3>Free Shipping</h3>
                                            <p class="mt-0">Free Delivery to 100+ Locations on orders above $40.</p>
                                        </div>
                                    </div>
        
                                    <div class="feature-box fbox-plain fbox-dark fbox-sm mt-4">
                                        <div class="fbox-icon">
                                            <i class="icon-undo"></i>
                                        </div>
                                        <div class="fbox-content fbox-content-sm">
                                            <h3>30-Days Returns</h3>
                                            <p class="mt-0">Return or exchange items purchased within 30 days.</p>
                                        </div>
                                    </div>
        
                                </div> --}}



                                    <div class="w-100"></div>

                                    <div class="col-12 mt-5">

                                        {{-- TABS --}}
                                        @include('frontend.product.components.product-details-tab')
                                    </div>

                                </div>

                            </div>

                            <div class="sidebar col-md-3">
                                <div class="sidebar-widgets-wrap">

                                    <div class="widget widget_links clearfix">

                                        <h4>Shop Categories</h4>
                                        <ul>
                                            <li><a href="#">Shirts</a></li>
                                            <li><a href="#">Pants</a></li>
                                            <li><a href="#">Tshirts</a></li>
                                            <li><a href="#">Sunglasses</a></li>
                                            <li><a href="#">Shoes</a></li>
                                            <li><a href="#">Bags</a></li>
                                            <li><a href="#">Watches</a></li>
                                        </ul>

                                    </div>

                                    <div class="widget clearfix">

                                        <h4>Recent Items</h4>
                                        <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">
                                            @foreach ($recentProducts as $recentProduct)
                                                <div class="entry col-12">
                                                    <div class="grid-inner row g-0">
                                                        <div class="col-auto">
                                                            <div class="entry-image">
                                                                <a
                                                                    href="{{ route('product.show', $recentProduct->slug) }}"><img
                                                                        src=" {{ asset($recentProduct->thumbnail_path) }} "
                                                                        alt="Image"></a>
                                                            </div>
                                                        </div>
                                                        <div class="col ps-3">
                                                            <div class="entry-title">
                                                                <h4><a
                                                                        href="{{ route('product.show', $recentProduct->slug) }}">
                                                                        {{ $recentProduct->name }} </a></h4>
                                                            </div>
                                                            <div class="entry-meta no-separator">
                                                                <ul>
                                                                    @if ($recentProduct->discounted_price)
                                                                        <li><del class="me-1 "> $
                                                                                {{ $recentProduct->price }}
                                                                            </del> <ins class="color"> ${{ $recentProduct->discounted_price }}
                                                                            </ins></li>
                                                                    @else
                                                                        <li class="color"><ins> $
                                                                                {{ $recentProduct->price }} </ins> </li>
                                                                    @endif
                                                                    <li><i class="icon-star3"></i><i
                                                                            class="icon-star3"></i><i
                                                                            class="icon-star3"></i><i
                                                                            class="icon-star3"></i><i
                                                                            class="icon-star-half-full"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                    </div>

                                    <div class="widget clearfix">

                                        <h4>Recommanded Product</h4>
                                        <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">
                                            @foreach ($randomProducts as $randomProduct)
                                                <div class="entry col-12">
                                                    <div class="grid-inner row g-0">
                                                        <div class="col-auto">
                                                            <div class="entry-image">
                                                                <a href="#"><img
                                                                        src=" {{ asset($randomProduct->thumbnail_path) }} "
                                                                        alt="Image"></a>
                                                            </div>
                                                        </div>
                                                        <div class="col ps-3">
                                                            <div class="entry-title">
                                                                <h4><a href="#"> {{ $randomProduct->name }} </a>
                                                                </h4>
                                                            </div>
                                                            <div class="entry-meta no-separator">
                                                                <ul>
                                                                    @if ($randomProduct->discounted_price)
                                                                        <li><del class="me-1 color"> $
                                                                                {{ $randomProduct->discounted_price }}
                                                                            </del> <ins> ${{ $randomProduct->price }}
                                                                            </ins></li>
                                                                    @else
                                                                        <li class="color"><ins> $
                                                                                {{ $randomProduct->price }} </ins> </li>
                                                                    @endif
                                                                    <li><i class="icon-star3"></i><i
                                                                            class="icon-star3"></i><i
                                                                            class="icon-star3"></i><i
                                                                            class="icon-star3"></i><i
                                                                            class="icon-star-half-full"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        {{-- <div class="line"></div>

            <div class="w-100">

                <h4>Related Products</h4>

                <div class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">

                    <div class="oc-item">
                        <div class="product">
                            <div class="product-image">
                                <a href="#"><img src="images/shop/dress/1.jpg" alt="Checked Short Dress"></a>
                                <a href="#"><img src="images/shop/dress/1-1.jpg" alt="Checked Short Dress"></a>
                                <div class="sale-flash badge bg-success p-2">50% Off*</div>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                        <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
                                        <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg bg-transparent"></div>
                                </div>
                            </div>
                            <div class="product-desc center">
                                <div class="product-title"><h3><a href="#">Checked Short Dress</a></h3></div>
                                <div class="product-price"><del>$24.99</del> <ins>$12.49</ins></div>
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-half-full"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="oc-item">
                        <div class="product">
                            <div class="product-image">
                                <a href="#"><img src="images/shop/pants/1-1.jpg" alt="Slim Fit Chinos"></a>
                                <a href="#"><img src="images/shop/pants/1.jpg" alt="Slim Fit Chinos"></a>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                        <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
                                        <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg bg-transparent"></div>
                                </div>
                            </div>
                            <div class="product-desc center">
                                <div class="product-title"><h3><a href="#">Slim Fit Chinos</a></h3></div>
                                <div class="product-price">$39.99</div>
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-half-full"></i>
                                    <i class="icon-star-empty"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="oc-item">
                        <div class="product">
                            <div class="product-image">
                                <a href="#"><img src="images/shop/shoes/1-1.jpg" alt="Dark Brown Boots"></a>
                                <a href="#"><img src="images/shop/shoes/1.jpg" alt="Dark Brown Boots"></a>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                        <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
                                        <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg bg-transparent"></div>
                                </div>
                            </div>
                            <div class="product-desc center">
                                <div class="product-title"><h3><a href="#">Dark Brown Boots</a></h3></div>
                                <div class="product-price">$49</div>
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-empty"></i>
                                    <i class="icon-star-empty"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="oc-item">
                        <div class="product">
                            <div class="product-image">
                                <a href="#"><img src="images/shop/dress/2.jpg" alt="Light Blue Denim Dress"></a>
                                <a href="#"><img src="images/shop/dress/2-2.jpg" alt="Light Blue Denim Dress"></a>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                        <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
                                        <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg bg-transparent"></div>
                                </div>
                            </div>
                            <div class="product-desc center">
                                <div class="product-title"><h3><a href="#">Light Blue Denim Dress</a></h3></div>
                                <div class="product-price">$19.95</div>
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-empty"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="oc-item">
                        <div class="product">
                            <div class="product-image">
                                <a href="#"><img src="images/shop/sunglasses/1.jpg" alt="Unisex Sunglasses"></a>
                                <a href="#"><img src="images/shop/sunglasses/1-1.jpg" alt="Unisex Sunglasses"></a>
                                <div class="sale-flash badge bg-success p-2">Sale!</div>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                        <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-cart"></i></a>
                                        <a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg bg-transparent"></div>
                                </div>
                            </div>
                            <div class="product-desc center">
                                <div class="product-title"><h3><a href="#">Unisex Sunglasses</a></h3></div>
                                <div class="product-price"><del>$19.99</del> <ins>$11.99</ins></div>
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-empty"></i>
                                    <i class="icon-star-empty"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div> --}}

                    </div>
                </div>
    </section><!-- #content end -->
@endsection

@push('scripts')
    <script></script>
@endpush
