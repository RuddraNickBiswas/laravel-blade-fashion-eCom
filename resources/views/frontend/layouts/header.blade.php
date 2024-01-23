  <?php
  use App\Models\Category;
  $categories = Category::with('children')
      ->whereNull('parent_id')
      ->get();
 
  
  ?>
  <!-- Top Bar
  ============================================= -->
  <div id="top-bar" class="dark" style="background-color: #a3a5a7;">
      <div class="container">

          <div class="row justify-content-between align-items-center">

              <div class="col-12 col-lg-auto">
                  <p class="mb-0 d-flex justify-content-center justify-content-lg-start py-3 py-lg-0"><strong>Free U.S.
                          Shipping on Order above $99. Easy Returns.</strong></p>
              </div>

              <div class="col-12 col-lg-auto d-none d-lg-flex">

                  <!-- Top Links
      ============================================= -->
                  <div class="top-links">
                      <ul class="top-links-container">
                          <li class="top-links-item"><a href="#">About</a></li>
                          <li class="top-links-item"><a href="#">FAQS</a></li>
                          <li class="top-links-item"><a href="#">Blogs</a></li>
                          <li class="top-links-item"><a href="#">EN</a>
                              <ul class="top-links-sub-menu">
                                  <li class="top-links-item"><a href="#"><img src="images/icons/flags/french.png"
                                              alt="French"> FR</a></li>
                                  <li class="top-links-item"><a href="#"><img src="images/icons/flags/italian.png"
                                              alt="Italian"> IT</a></li>
                                  <li class="top-links-item"><a href="#"><img src="images/icons/flags/german.png"
                                              alt="German"> DE</a></li>
                              </ul>
                          </li>
                      </ul>
                  </div><!-- .top-links end -->

                  <!-- Top Social
      ============================================= -->
                  <ul id="top-social">
                      <li><a href="#" class="si-facebook"><span class="ts-icon"><i
                                      class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                      <li><a href="#" class="si-instagram"><span class="ts-icon"><i
                                      class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
                      <li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i
                                      class="icon-call"></i></span><span class="ts-text">+1.11.85412542</span></a></li>
                      <li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i
                                      class="icon-envelope-alt"></i></span><span
                                  class="ts-text">info@canvas.com</span></a></li>
                  </ul><!-- #top-social end -->

              </div>
          </div>

      </div>
  </div>

  <!-- Header
  ============================================= -->
  <header id="header" class="full-header header-size-md">
      <div id="header-wrap">
          <div class="container">
              <div class="header-row justify-content-lg-between">

                  <!-- Logo
      ============================================= -->
                  <div id="logo" class="me-lg-4">
                      <a href="{{ route('home') }}" class="standard-logo"><img src="demos/shop/images/logo.png"
                              alt="Canvas Logo"></a>
                      <a href="{{ route('home') }}" class="retina-logo"><img src="demos/shop/images/logo@2x.png"
                              alt="Canvas Logo"></a>
                  </div><!-- #logo end -->

                  <div class="header-misc">

                      <!-- Top Search
       ============================================= -->
                      <div id="top-account">
                        @if (auth()->user())
                        <a href="{{ route('profile') }}">
                            <img src="{{ asset(auth()->user()->avater) }}" class="rounded-circle" style="width: 30px;"
                            alt="Avatar" />
                        </a>
                        @else
                          <a href=" {{ route('login') }} "><i class="icon-line2-user me-1 position-relative"
                                  style="top: 1px;"></i><span
                                  class="d-none d-sm-inline-block font-primary fw-medium">Login</span></a> @endif
                      </div><!-- #top-search end -->


                      <!-- Top Cart
       ============================================= -->
                      <div id="top-cart"
                              class="header-misc-icon d-none d-sm-block" >
                              <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i>
                                @if (count(Cart::content()))
                                <span id="cartItemCount" class="top-cart-number">{{ count(Cart::content()) }}</span></a>
                                @endif
                              <div class="top-cart-content">
                                  <div class="top-cart-title">
                                      <h4>Shopping Cart</h4>
                                  </div>
                                  <div id="headerCartContent" class="top-cart-items scrollable" >

                                    
                                    @foreach (Cart::content() as $cartProduct)
                                        
                                    <div class="top-cart-item">
                                        <div class="top-cart-item-image">
                                            <a href="#"><img src=" {{ asset($cartProduct->options->product_info['thumbnail_path']) }} "
                                                    alt="Blue Round-Neck Tshirt" /></a>
                                        </div>
                                        <div class="top-cart-item-desc">
                                            <div class="top-cart-item-desc-title">
                                                <a href="{{ route('product.show',$cartProduct->options->product_info['slug'] ) }}">{{ $cartProduct->name }}</a>
                                                <div class="d-flex ">
                                                    <span class="top-cart-item-price d-block me-2" >${{ $cartProduct->price }} </span>
                                                    <span class="top-cart-item-price d-block">{{  $cartProduct->options->size['name']  }}</span>
                                                  </div>
                                              </div>
                                              <div class="d-flex flex-column " >
                                                  <div class="top-cart-item-quantity">x {{ $cartProduct->qty }}</div>
                                                  <a href="javascript:;" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')" class="color"> <i class="icon-line2-close "></i></a> 
                                              </div>
                                        </div>
                                    </div>
                                    @endforeach



                                  </div>
                                  <div class="top-cart-action">
                                      <span id="headerCartTotal" class="top-checkout-price">$ {{ cartTotal() }}</span>
                                      <a href="#" class="button button-3d button-small m-0">View Cart</a>
                                  </div>
                              </div>
              </div><!-- #top-cart end -->

              <!-- Top Search
       ============================================= -->
              <div id="top-search" class="header-misc-icon">
                  <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i
                          class="icon-line-cross"></i></a>
              </div><!-- #top-search end -->

          </div>

          <div id="primary-menu-trigger">
              <svg class="svg-trigger" viewBox="0 0 100 100">
                  <path
                      d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                  </path>
                  <path d="m 30,50 h 40"></path>
                  <path
                      d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                  </path>
              </svg>
          </div>

          <!-- Primary Navigation
      ============================================= -->
          <nav class="primary-menu with-arrows me-lg-auto">

              <ul class="menu-container">
                  <li class="menu-item current"><a class="menu-link" href="#">
                          <div>Home</div>
                      </a></li>
                  <li class="menu-item mega-menu"><a class="menu-link" href="#">
                          <div>Category</div>
                      </a>
                      <div class="mega-menu-content mega-menu-style-2">
                          <div class="container">
                              <div class="row">
                                  @foreach ($categories as $category)
                                      <ul class="sub-menu-container mega-menu-column border-start-0 col-lg-3">
                                          <li class="menu-item mega-menu-title"><a class="menu-link" href="#">
                                                  <div>{{ $category->name }} </div>
                                              </a>
                                              <ul class="sub-menu-container">

                                                  @foreach ($category->children as $child)
                                                      <li class="menu-item"><a class="menu-link" href="#">
                                                              <div>{{ $child->name }} </div>
                                                          </a></li>
                                                  @endforeach



                                              </ul>
                                          </li>

                                      </ul>
                                  @endforeach

                              </div>
                          </div>
                      </div>
                  </li>
                  {{-- <li class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#">
                          <div>Women</div>
                      </a>
                      <div class="mega-menu-content mega-menu-style-2">
                          <div class="container">
                              <div class="row">
                                  <ul class="sub-menu-container mega-menu-column col-lg-6">
                                      <li class="menu-item mega-menu-title"><a class="menu-link" href="#">
                                              <div>Footwear</div>
                                          </a>
                                          <ul class="sub-menu-container">
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Casual Shoes</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Formal Shoes</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Sports shoes</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Flip Flops</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Slippers</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Sandals</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Party Shoes</div>
                                                  </a></li>
                                          </ul>
                                      </li>
                                  </ul>
                                  <ul class="sub-menu-container mega-menu-column col-lg-6">
                                      <li class="menu-item mega-menu-title"><a class="menu-link" href="#">
                                              <div>Clothing</div>
                                          </a>
                                          <ul class="sub-menu-container">
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Casual Shirts</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>T-Shirts</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Collared Tees</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Pants / Trousers</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Ethnic Wear</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Jeans</div>
                                                  </a></li>
                                              <li class="menu-item"><a class="menu-link" href="#">
                                                      <div>Swimwear</div>
                                                  </a></li>
                                          </ul>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </li> --}}
                  {{-- <li class="menu-item"><a class="menu-link" href="#">
                          <div>Accessories</div>
                      </a></li> --}}
                  <li class="menu-item"><a class="menu-link" href="#">
                          <div>Blog</div>
                      </a></li>
                  <li class="menu-item"><a class="menu-link" href="#">
                          <div>Sales</div>
                      </a></li>
              </ul>

          </nav><!-- #primary-menu end -->

          <form class="top-search-form" action="search.html" method="get">
              <input type="text" name="q" class="form-control" value=""
                  placeholder="Type &amp; Hit Enter.." autocomplete="off">
          </form>

      </div>
  </div>
  </div>
  <div class="header-wrap-clone"></div>
  </header><!-- #header end -->
