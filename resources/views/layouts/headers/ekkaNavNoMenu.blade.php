<header class="ec-header">
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top responsive Action -->
                <div class="col d-lg-none ">
                    <div class="ec-header-bottons">
                        <!-- Header User Start -->
                        <div class="ec-header-user dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                    src="{{ asset('ekka') }}/images/icons/user.svg" class="svg_img header_svg" alt="" /></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="register.html">Register</a></li>
                                <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
                                <li><a class="dropdown-item" href="login.html">Login</a></li>
                            </ul>
                        </div>
                        <!-- Header User End -->
                        <!-- Header WishList Start -->
                        <a href="wishlist.html" class="ec-header-btn ec-header-wishlist">
                            <div class="header-icon"><img src="{{ asset('ekka') }}/images/icons/wishlist.svg"
                                    class="svg_img header_svg" alt="" /></div>
                            <span class="ec-header-count">4</span>
                        </a>
                        <!-- Header Wishlist End -->
                        {{-- <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                            <img src="{{ asset('ekka') }}/images/icons/category-icon.svg" class="svg_img header_svg" alt="icon" />
                        </a> --}}
                    </div>
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    {{-- <div class="align-self-center">
                        <div class="header-logo">
                            <a href="{{url('/')}}"><img src="{{ asset('ekka') }}/images/logo/logo.png" alt="Site Logo" /><img
                                    class="dark-logo" src="{{ asset('ekka') }}/images/logo/dark-logo.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div> --}}
                    <!-- Ec Header Log  o End -->

                    <!-- Ec Header Search Start -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">

                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{ asset('ekka') }}/images/logo/logo.png" alt="Site Logo" /><img
                                class="dark-logo" src="{{ asset('ekka') }}/images/logo/dark-logo.png" alt="Site Logo"
                                style="display: none;" /></a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
</header>

    {{-- <div class="col-lg-3 category-sidebar" data-animation="fadeIn">
            <div class="cat-sidebar">
                <div class="cat-sidebar-box">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Category<button class="ec-close">×</button></h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/dress-8.svg" class="svg_img" alt="drink" />Cothes</div>
                                        <ul style="display: block;">
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Shirt <span title="Available Stock">- 25</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">shorts & jeans <span title="Available Stock">- 52</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">jacket<span title="Available Stock">- 500</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">dress & frock  <span title="Available Stock">- 35</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/shoes-8.svg" class="svg_img" alt="drink" />Footwear</div>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Sports <span title="Available Stock">- 25</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Formal <span title="Available Stock">- 52</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Casual <span title="Available Stock">- 40</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">safety shoes <span title="Available Stock">- 35</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/jewelry-8.svg" class="svg_img" alt="drink" />jewelry</div>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Earrings <span title="Available Stock">- 50</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Couple Rings <span title="Available Stock">- 35</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Necklace <span title="Available Stock">- 40</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/perfume-8.svg" class="svg_img" alt="drink" />perfume</div>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Clothes perfume<span title="Available Stock">- 4 pcs</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">deodorant <span title="Available Stock">- 52 pcs</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Flower fragrance <span title="Available Stock">- 10 pack</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Air Freshener<span title="Available Stock">- 35 pack</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/cosmetics-8.svg" class="svg_img" alt="drink" />cosmetics</div>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">shampoo<span title="Available Stock"></span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Sunscreen<span title="Available Stock"></span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">body wash<span title="Available Stock"></span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">makeup kit<span title="Available Stock"></span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/glasses-8.svg" class="svg_img" alt="drink" />glasses</div>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Sunglasses <span title="Available Stock">- 20</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Lenses <span title="Available Stock">- 52</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><img src="{{ asset('ekka') }}/images/icons/bag-8.svg" class="svg_img" alt="drink" />bags</div>
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">shopping bag <span title="Available Stock">- 25</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">Gym backpack <span title="Available Stock">- 52</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">purse <span title="Available Stock">- 40</span></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-sub-item"><a href="shop-left-sidebar-col-3.html">wallet <span title="Available Stock">- 35</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Category Block -->
                    </div>
                </div>
                <div class="ec-sidebar-slider-cat">
                    <div class="ec-sb-slider-title">Best Sellers</div>
                    <div class="ec-sb-pro-sl">
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/1.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">baby fabric shoes</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$5.00</span>
                                        <span class="new-price">$4.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/2.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Men's hoodies t-shirt</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$10.00</span>
                                        <span class="new-price">$7.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/3.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Girls t-shirt</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star"></i>
                                        <i class="ecicon eci-star"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$5.00</span>
                                        <span class="new-price">$3.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/4.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">woolen hat for men</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$15.00</span>
                                        <span class="new-price">$12.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/5.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Womens purse</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$15.00</span>
                                        <span class="new-price">$12.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/6.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Baby toy doctor kit</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star"></i>
                                        <i class="ecicon eci-star"></i>
                                        <i class="ecicon eci-star"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$50.00</span>
                                        <span class="new-price">$45.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/7.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">teddy bear baby toy</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$35.00</span>
                                        <span class="new-price">$25.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ec-sb-pro-sl-item">
                                <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                        src="{{ asset('ekka') }}/images/product-image/2.jpg" alt="product" /></a>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Mens hoodies blue</a></h5>
                                    <div class="ec-pro-rating">
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star fill"></i>
                                        <i class="ecicon eci-star"></i>
                                        <i class="ecicon eci-star"></i>
                                    </div>
                                    <span class="ec-price">
                                        <span class="old-price">$15.00</span>
                                        <span class="new-price">$13.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div> --}}