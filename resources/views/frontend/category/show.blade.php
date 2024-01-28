@extends('frontend.layouts.master')

@section('content')
    <!-- Page Title
      ============================================= -->
    <section id="page-title">
        <div class="container clearfix">
            <h1>Shop</h1>
            <span>Start Buying your Favourite Theme</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
        </div>
    </section><!-- #page-title end -->
    <!-- Content
      ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">
                    <!-- Post Content
          ============================================= -->
                    <div class="postcontent col-lg-9 order-lg-last">

                        <!-- Shop
           ============================================= -->
                        <div id="shop" class="shop row grid-container gutter-20" data-layout="fitRows">

                            @foreach ($currentCategory->products as $product)
                                <div class="product col-md-4 col-sm-6 col-12">
                                    <div class="product">
                                        <div class="product-image">
                                            <a href="{{ route('product.show', $product->slug) }}"><img
                                                    src="{{ asset($product->thumbnail_path) }}" alt="Image 1"></a>
                                            {{-- SECOND IMAGE ADD HERE IF NEEDED --}}
                                            <a href="{{ route('product.show', $product->slug) }}"><img
                                                    src="{{ asset($product->thumbnail_path) }}" alt="Image 1"></a>
                                            @if ($product->discounted_price)
                                                <div class="sale-flash badge bg-danger p-2">Sale!</div>
                                            @endif
                                            <div class="bg-overlay">
                                                <div class="bg-overlay-content align-items-end justify-content-between"
                                                    data-hover-animate="fadeIn" data-hover-speed="400">
                                                    <a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"
                                                        class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
                                                    <a href="{{ route('product.show', $product->slug) }}"
                                                        class="btn btn-dark"><i class="icon-line-expand"></i></a>
                                                </div>
                                                <div class="bg-overlay-bg bg-transparent"></div>
                                            </div>
                                        </div>
                                        <div class="product-desc">
                                            <div class="product-title mb-1">
                                                <h3><a href=" {{ route('product.show', $product->slug) }} ">
                                                        {{ $product->name }} </a></h3>
                                            </div>
                                            @if ($product->discounted_price)
                                                <div class="product-price font-primary"><del class="me-1">
                                                        {{ currencyPosition($product->price) }} </del> <ins>
                                                        {{ currencyPosition($product->discounted_price) }} </ins></div>
                                            @else
                                                <div class="product-price font-primary"><ins>
                                                        {{ currencyPosition($product->price) }} </ins> </div>
                                            @endif

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
                            @endforeach

                        </div><!-- #shop end -->

                        <div class=" mt-6 d-flex justify-content-center">
                            <ul class="pagination pagination-rounded pagination-3d">
                                <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                            aria-hidden="true">»</span></a></li>
                            </ul>
                        </div>
                    </div><!-- .postcontent end -->

                    <!-- Sidebar
          ============================================= -->
                    <div class="sidebar col-lg-3">
                        <div class="side-panel-wrap">

                            <div class="widget clearfix">

                                <h4>Category</h4>

                                <nav class="nav-tree mb-0">
                                    <ul>
                                        @foreach ($parentCategories as $category)
                                            <li><a href="#"><i class="icon-clip"></i>{{ $category->name }}</a>
                                                <ul>
                                                    @foreach ($category->children as $child)
                                                        <li><a
                                                                href="{{ route('category.show', $child->slug) }}">{{ $child->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>

                            </div>
                            <div class="widget clearfix">

                                <h4>Recent Items</h4>
                                <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">
                                    @foreach ($recentProducts as $recentProduct)
                                        <div class="entry col-12">
                                            <div class="grid-inner row g-0">
                                                <div class="col-auto">
                                                    <div class="entry-image">
                                                        <a href="{{ route('product.show', $recentProduct->slug) }}"><img
                                                                src=" {{ asset($recentProduct->thumbnail_path) }} "
                                                                alt="Image"></a>
                                                    </div>
                                                </div>
                                                <div class="col ps-3">
                                                    <div class="entry-title">
                                                        <h4><a href="{{ route('product.show', $recentProduct->slug) }}">
                                                                {{ $recentProduct->name }} </a></h4>
                                                    </div>
                                                    <div class="entry-meta no-separator">
                                                        <ul>
                                                            @if ($recentProduct->discounted_price)
                                                                <li><del class="me-1 ">
                                                                        {{ currencyPosition($recentProduct->price) }}
                                                                    </del> <ins class="color">
                                                                        {{ currencyPosition($recentProduct->discounted_price) }}
                                                                    </ins></li>
                                                            @else
                                                                <li class="color">
                                                                    <ins>{{ currencyPosition($recentProduct->price) }}
                                                                    </ins> </li>
                                                            @endif
                                                            <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i class="icon-star3"></i><i
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
                                                                <li><del class="me-1 color">
                                                                        {{ currencyPosition($randomProduct->discounted_price) }}
                                                                    </del>
                                                                    <ins>{{ currencyPosition($randomProduct->price) }}
                                                                    </ins></li>
                                                            @else
                                                                <li class="color">
                                                                    <ins>{{ currencyPosition($randomProduct->price) }}
                                                                    </ins> </li>
                                                            @endif
                                                            <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i class="icon-star3"></i><i
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
                    </div><!-- .sidebar end -->
                </div>

            </div>
        </div>
    </section><!-- #content end -->
@endsection
