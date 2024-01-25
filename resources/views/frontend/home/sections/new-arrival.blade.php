<div class="section my-4">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12 center p-5">
                        <div class="heading-block mb-1 border-bottom-0 mx-auto">
                            <div class="font-secondary text-black-50 mb-1">New Arrivals</div>
                            <h3 class="nott ls0">Fresh Arrivals / Autumn 18</h3>
                            <p class="fw-normal mt-2 mb-3 text-muted" style="font-size: 17px; line-height: 1.4">Dynamically drive interdependent metrics for worldwide portals. Proactively grow client technology schemas.</p>
                            <a href="#" class="button bg-dark text-white button-dark button-small ms-0">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="{{asset('frontend/demos/shop/images/sections/1-2.jpg')}}" data-lightbox="image"><img src="{{asset('frontend/demos/shop/images/sections/1-2.jpg')}}" alt="Image"></a>
                    </div>
                    <div class="col-6">
                        <a href="{{asset('frontend/demos/shop/images/sections/1-3.jpg')}}" data-lightbox="image"><img src="{{asset('frontend/demos/shop/images/sections/1-3.jpg')}}" alt="Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-7 min-vh-50">
                <a href="https://www.youtube.com/watch?v=bpNcuh_BnsA" data-lightbox="iframe" class="d-block position-relative h-100" style="background: url('{{asset('frontend/demos/shop/images/sections/1.jpg')}}') center center no-repeat; background-size: cover;">
                    <div class="vertical-middle text-center">
                        <div class="play-icon"><i class="icon-play-sign display-3 text-light"></i></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>

		<!-- New Arrivals Men
				============================================= -->
				<div class="container clearfix">

					<div class="fancy-title title-border topmargin-sm mb-4 title-center">
						<h4>New Arrivals: Men</h4>
					</div>

					<div class="row grid-6">

						<!-- Shop Item 1
						============================================= -->
						@foreach ($mansProducts as $mansProduct)
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="{{ route('product.show', $mansProduct->slug) }}"><img src="{{asset($mansProduct->thumbnail_path)}}" alt="Image 1"></a>
									{{-- SECOND IMAGE ADD HERE IF NEEDED --}}
									<a href="{{ route('product.show', $mansProduct->slug) }}"><img src="{{asset($mansProduct->thumbnail_path)}}" alt="Image 1"></a>
									@if ($mansProduct->discounted_price)
									<div class="sale-flash badge bg-danger p-2">Sale!</div>
									@endif
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="javascript:;" onclick="loadProductModal('{{ $mansProduct->id }}')" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
											<a href="{{ route('product.show', $mansProduct->slug) }}" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href=" {{ route('product.show', $mansProduct->slug) }} "> {{ $mansProduct->name }} </a></h3></div>
									@if ( $mansProduct->discounted_price)
									<div class="product-price font-primary"><del class="me-1"> {{ currencyPosition($mansProduct->price)  }} </del> <ins> {{ currencyPosition($mansProduct->discounted_price)}} </ins></div>
									@else
									<div class="product-price font-primary"><ins > {{ currencyPosition($mansProduct->price) }} </ins> </div>
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

					
					

					</div>

				</div>
