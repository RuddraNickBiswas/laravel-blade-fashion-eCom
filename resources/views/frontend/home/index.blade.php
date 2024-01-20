@extends('frontend.layouts.master')

@section('content')
  
		@include('frontend.home.sections.slider')
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<!-- Shop Categories
					============================================= -->
						@include('frontend.home.sections.shop-categories')

					<!-- Featured Carousel
					============================================= -->
						@include('frontend.home.sections.featured-items')
				<!-- New Arrival Section
				============================================= -->
					@include('frontend.home.sections.new-arrival')

		
		<!-- Sign Up
				============================================= -->
				@include('frontend.home.sections.sign-up')

    <!-- Features
    ============================================= -->
				@include('frontend.home.sections.features')

				<!-- App Buttons
				============================================= -->
				@include('frontend.home.sections.app-buttons')

				<!-- Last Section
				============================================= -->
				@include('frontend.home.sections.last-section')
			</div>
			</div>
		</section><!-- #content end -->
@endsection