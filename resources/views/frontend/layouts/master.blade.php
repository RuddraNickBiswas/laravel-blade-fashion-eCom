<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <!-- Stylesheets

 ============================================= -->
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:300,400,500,600,700|Merriweather:300,400,300i,400i&display=swap"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/dark.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper.css') }}" type="text/css" />

    <!-- shop Demo Specific Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/demos/shop/shop.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/demos/shop/css/fonts.css') }}" type="text/css" />
    <!-- / -->

    <link rel="stylesheet" href="{{ asset('frontend/css/font-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link rel="stylesheet" href="{{ asset('frontend/css/colors.php?color=fd79a8') }}" type="text/css" />



    {{-- TOASTR --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/toastr.min.css') }}">

    @stack('styles')

    <!-- Document Title
 ============================================= -->
    <title>Shop Demo | Canvas</title>

</head>

<body class="stretched">

    <!-- Document Wrapper
 ============================================= -->
    <div id="wrapper" class="clearfix">

        {{-- delete on load model from here  --}}
        {{-- <div class="modal-on-load" data-target="#myModal1"></div> --}}

        <!-- On LOad Modal -->
        {{-- <div class="modal1 mfp-hide subscribe-widget mx-auto" id="myModal1" style="max-width: 750px;">
			<div class="row justify-content-center bg-white align-items-center" style="min-height: 380px;">
				<div class="col-md-5 p-0">
					<div style="background: url('{{asset('frontend/pimages/modals/modal1.jpg')}}') no-repeat center right; background-size: cover;  min-height: 380px;"></div>
				</div>
				<div class="col-md-7 bg-white p-4">
					<div class="heading-block border-bottom-0 mb-3">
						<h3 class="font-secondary nott ">Join Our Newsletter &amp; Get <span class="text-danger">40%</span> Off your First Order</h3>
						<span>Get Latest Fashion Updates &amp; Offers</span>
					</div>
					<div class="widget-subscribe-form-result"></div>
					<form class="widget-subscribe-form2 mb-2" action="include/subscribe.php" method="post">
						<input type="email" id="widget-subscribe-form2-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email Address..">
						<div class="d-flex justify-content-between align-items-center mt-1">
							<button class="button button-dark  bg-dark text-white ms-0" type="submit">Subscribe</button>
							<a href="#" class="btn-link" onClick="$.magnificPopup.close();return false;">Don't Show me</a>
						</div>
					</form>
					<small class="mb-0 fst-italic text-black-50">*We also hate Spam &amp; Junk Emails.</small>
				</div>
			</div>
		</div> --}}

        {{-- End onload model  --}}

        <!-- Login Modal -->
        {{-- <div class="modal1 mfp-hide" id="modal-register">
            <div class="card mx-auto" style="max-width: 540px;">
                <div class="card-header py-3 bg-transparent center">
                    <h3 class="mb-0 fw-normal">Hello, Welcome Back</h3>
                </div>
                <div class="card-body mx-auto py-5" style="max-width: 70%;">

                    <a href="#"
                        class="button button-large w-100 si-colored si-facebook nott fw-normal ls0 center m-0"><i
                            class="icon-facebook-sign"></i> Log in with Facebook</a>

                    <div class="divider divider-center"><span class="position-relative" style="top: -2px">OR</span>
                    </div>

                    <form id="login-form" name="login-form" class="mb-0 row" action="#" method="post">

                        <div class="col-12">
                            <input type="text" id="login-form-username" name="login-form-username" value=""
                                class="form-control not-dark" placeholder="Username" />
                        </div>

                        <div class="col-12 mt-4">
                            <input type="password" id="login-form-password" name="login-form-password" value=""
                                class="form-control not-dark" placeholder="Password" />
                        </div>

                        <div class="col-12">
                            <a href="#" class="float-end text-dark fw-light mt-2">Forgot Password?</a>
                        </div>

                        <div class="col-12 mt-4">
                            <button class="button w-100 m-0" id="login-form-submit" name="login-form-submit"
                                value="login">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer py-4 center">
                    <p class="mb-0">Don't have an account? <a href="#"><u>Sign up</u></a></p>
                </div>
            </div>
        </div> --}}

        {{-- Top Bar and header --}}
        @include('frontend.layouts.header')
        {{-- Top Bar and header --}}
        @include('frontend.modal.product-modal')

        @yield('content')

        {{-- USING AJAS FUNCTION CALL TO TRIGGER THIS MODEL loadProductModail + id --}}
        @include('frontend.layouts.footer')

    </div><!-- #wrapper end -->
    
    <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-line-arrow-up"></div>
        
        <!-- JavaScripts
            ============================================= -->
    @include('frontend.layouts.scripts')
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins.min.js') }}"></script>

    <!-- Footer Scripts
 ============================================= -->
    <script src="{{ asset('frontend/js/functions.js') }}"></script>


    <!-- ADD-ONS JS FILES -->
    <script></script>


    {{-- User Script	 --}}
    {{-- TOASTR --}}
    <script src="{{ asset('frontend/toastr.min.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {

            $('#linked-to-gallery a').click(function() {
                var imageLink = $(this).attr('data-image');
                jQuery('#oc-images').trigger('to.owl.carousel', [Number(imageLink) - 1, 300, true]);
                return false;
            });

        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>


    @stack('scripts')
</body>

</html>
