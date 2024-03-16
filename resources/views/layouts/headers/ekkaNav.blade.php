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
                                <li><a class="dropdown-item" href="register">Register</a></li>
                                <li><a class="dropdown-item" href="login">Login</a></li>
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
                    <div class="align-self-center">
                        {{-- <div class="header-logo">
                            <a href="index.html"><img src="{{ asset('ekka') }}/images/logo/logo.png" alt="Site Logo" /><img
                                    class="dark-logo" src="{{ asset('ekka') }}/images/logo/dark-logo.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div> --}}
                    </div>
                    <!-- Ec Header Log  o End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center">
                        {{-- <div class="header-search">
                            <form class="ec-btn-group-form" action="#">
                                <input class="form-control ec-search-bar" placeholder="Search products..." type="text">
                                <button class="submit" type="submit"><img src="{{ asset('ekka') }}/images/icons/search.svg"
                                        class="svg_img header_svg" alt="" /></button>
                            </form>
                        </div> --}}
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-end justify-item-end">
                        <div class="ec-header-bottons">

                            <!-- Header User Start -->
                            @if(auth()->check())
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                        src="{{ asset('ekka') }}/images/icons/user.svg" class="svg_img header_svg" alt="" /></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    
                                    <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                                    <li><a class="dropdown-item" href="{{route('tutoringListU')}}">Tutoring List</a></li>
                                    <li><a class="dropdown-item" href="{{route('competition')}}">Competition List</a></li>
                                    @can('organiser-access')
                                    <li><a class="dropdown-item" href="{{route('welcome')}}">Merchant Page</a></li>
                                    @endcan
                                    @can('tutor-access')
                                    <li><a class="dropdown-item" href="{{route('welcome')}}">Merchant Page</a></li>
                                    @endcan
                                    @can('institution-access')
                                    <li><a class="dropdown-item" href="{{route('welcome')}}">Merchant Page</a></li>
                                    @endcan
                                    @can('school-access')
                                    <li><a class="dropdown-item" href="{{route('welcome')}}">Merchant Page</a></li>
                                    @endcan
                                    @can('shuttle-access')
                                    <li><a class="dropdown-item" href="{{route('welcome')}}">Merchant Page</a></li>
                                    @endcan
                                    @can('admin-access')
                                    <li><a class="dropdown-item" href="{{route('welcome')}}">Admin Page</a></li>
                                    @endcan
                                    <li><a class="dropdown-item" href="{{route('logoutUser')}}">Logout</a></li>
                                    
                                    {{-- <li><a class="dropdown-item" href="register">Register</a></li>
                                    <li><a class="dropdown-item" href="login">Login</a></li> --}}
                                    
                                </ul>
                            </div>
                            @else                          
                            <h6>
                                <a href="login" class="btn">Login</a>
                                <a href="register" class="btn">Register</a>
                            </h6>
                            @endif
                            <!-- Header User End -->
                            <!-- Header wishlist Start -->
                            <!-- Header wishlist End -->
                            <!-- Header Cart Start -->
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
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
                <div class="col">
                    <div class="header-search">
                        <form class="ec-btn-group-form" action="#">
                            <input class="form-control ec-search-bar" placeholder="Search products..." type="text">
                            <button class="submit" type="submit"><img src="{{ asset('ekka') }}/images/icons/ .svg"
                                    class="svg_img header_svg" alt="icon" /></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ec-main-menu">
                        {{-- <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                            <img src="{{ asset('ekka') }}/images/icons/category-icon.svg" class="svg_img header_svg" alt="icon" />
                        </a> --}}
                        <ul>
                            <li><a href="/">{{__('Home')}}</a></li>
                            <li class=""><a href="{{ route('subjectListM') }}">{{__('Subjects')}}</a></li>
                            {{-- <li class=""><a href="{{route('catalog.tutorList')}}">{{__('Tutor')}}</a></li> --}}
                            <li class=""><a href="{{route('catalog.tutoringList')}}">{{__('Tutoring')}}</a></li>
                            <li class=""><a href="{{route('catalog.schoolList')}}">{{__('School')}}</a></li>
                            <li class=""><a href="{{route('catalog.competitionList')}}">{{__('Competition')}}</a></li>
                            <li class=""><a href="{{route('catalog.shuttleList')}}">{{__('School Shuttle')}}</a></li>
                            {{-- <li class="dropdown"><span class="main-label-note-new" data-toggle="tooltip"
                                    title="NEW"></span><a href="javascript:void(0)">Others</a>
                                <ul class="sub-menu">
                                    <li class="dropdown position-static"><a href="javascript:void(0)">Mail
                                            Confirmation
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="email-template-confirm-1.html">Mail Confirmation 1</a></li>
                                            <li><a href="email-template-confirm-2.html">Mail Confirmation 2</a></li>
                                            <li><a href="email-template-confirm-3.html">Mail Confirmation 3</a></li>
                                            <li><a href="email-template-confirm-4.html">Mail Confirmation 4</a></li>
                                            <li><a href="email-template-confirm-5.html">Mail Confirmation 5</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown position-static"><a href="javascript:void(0)">Mail Reset
                                            password
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="email-template-forgot-password-1.html">Reset password 1</a>
                                            </li>
                                            <li><a href="email-template-forgot-password-2.html">Reset password 2</a>
                                            </li>
                                            <li><a href="email-template-forgot-password-3.html">Reset password 3</a>
                                            </li>
                                            <li><a href="email-template-forgot-password-4.html">Reset password 4</a>
                                            </li>
                                            <li><a href="email-template-forgot-password-5.html">Reset password 5</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown position-static"><a href="javascript:void(0)">Mail
                                            Promotional
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="email-template-offers-1.html">Offer mail 1</a></li>
                                            <li><a href="email-template-offers-2.html">Offer mail 2</a></li>
                                            <li><a href="email-template-offers-3.html">Offer mail 3</a></li>
                                            <li><a href="email-template-offers-4.html">Offer mail 4</a></li>
                                            <li><a href="email-template-offers-5.html">Offer mail 5</a></li>
                                            <li><a href="email-template-offers-6.html">Offer mail 6</a></li>
                                            <li><a href="email-template-offers-7.html">Offer mail 7</a></li>
                                            <li><a href="email-template-offers-8.html">Offer mail 8</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown position-static">
                                        <span class="label-note-hot"></span>
                                        <a href="javascript:void(0)">Vendor account pages
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                            <li><a href="vendor-profile.html">Vendor Profile</a></li>
                                            <li><a href="vendor-uploads.html">Vendor Uploads</a></li>
                                            <li><a href="vendor-settings.html">Vendor Settings</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown position-static">
                                        <span class="label-note-trending"></span>
                                        <a href="javascript:void(0)">User account pages
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="user-profile.html">User Profile</a></li>
                                            <li><a href="user-history.html">History</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="track-order.html">Track Order</a></li>
                                            <li><a href="user-invoice.html">Invoice</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown position-static"><a href="javascript:void(0)">Construction
                                            pages
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="404-error-page.html">404 error page</a></li>
                                            <li><a href="under-maintenance.html">maintanence page</a></li>
                                            <li><a href="coming-soon.html">Coming soon page</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown position-static">
                                        <span class="label-note-new"></span>
                                        <a href="javascript:void(0)">Vendor Catalog pages
                                            <i class="ecicon eci-angle-right"></i></a>
                                        <ul class="sub-menu sub-menu-child">
                                            <li><a href="catalog-single-vendor.html">Catalog Single Vendor</a></li>
                                            <li><a href="catalog-multi-vendor.html">Catalog Multi Vendor</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- <li class="dropdown"><a href="javascript:void(0)">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog-left-sidebar.html">Blog left sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">Blog right sidebar</a></li>
                                    <li><a href="blog-detail-left-sidebar.html">Blog detail left sidebar</a></li>
                                    <li><a href="blog-detail-right-sidebar.html">Blog detail right sidebar</a></li>
                                    <li><a href="blog-full-width.html">Blog full width</a></li>
                                    <li><a href="blog-detail-full-width.html">Blog detail full width</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="javascript:void(0)">Elements</a> --}}
                                {{-- <ul class="sub-menu">
                                    <li><a href="elemets-products.html">Products</a></li>
                                    <li><a href="elemets-typography.html">Typography</a></li>
                                    <li><a href="elemets-title.html">Titles</a></li>
                                    <li><a href="elemets-categories.html">Categories</a></li>
                                    <li><a href="elemets-buttons.html">Buttons</a></li>
                                    <li><a href="elemets-tabs.html">Tabs</a></li>
                                    <li><a href="elemets-accordions.html">Accordions</a></li>
                                    <li><a href="elemets-blog.html">Blogs</a></li>
                                </ul> --}}
                            {{-- </li>
                            <li><a href="offer.html">Hot Offers</a></li> --}}
                            {{-- <li class="dropdown scroll-to"><a href="javascript:void(0)"><img
                                src="{{ asset('ekka') }}/images/icons/scroll.svg" class="svg_img header_svg scroll" alt="" /></a>
                                <ul class="sub-menu">
                                    <li class="menu_title">Scroll To Section</li>
                                    <li><a href="javascript:void(0)" data-scroll="collection" class="nav-scroll">Top Collection</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="categories" class="nav-scroll">Categories</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="offers" class="nav-scroll">Offers</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="vendors" class="nav-scroll">Top Vendors</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="services" class="nav-scroll">Services</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="arrivals" class="nav-scroll">New Arrivals</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="reviews" class="nav-scroll">Client Review</a></li>
                                    <li><a href="javascript:void(0)" data-scroll="insta" class="nav-scroll">Instagram Feed</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- ekka Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li><a href="index.html">{{__('Home')}}</a></li>
                    <li class=""><a href="#">{{__('Subjects')}}</a></li>
                    <li class=""><a href="#">{{__('Tutor')}}</a></li>
                    <li class=""><a href="#">{{__('School')}}</a></li>
                    <li class=""><a href="#">{{__('Competition')}}</a></li>
                    <li class=""><a href="#">{{__('School Shuttle')}}</a></li>
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <div class="header-top-lan-curr">
                    <!-- Language Start -->
                    <div class="header-top-lan dropdown">
                        <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Language <i
                                class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu">
                            <li class="active"><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Italiano</a></li>
                        </ul>
                    </div>
                    <!-- Language End -->
                    <!-- Currency Start -->
                    <div class="header-top-curr dropdown">
                        <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
                                class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu">
                            <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
                            <li><a class="dropdown-item" href="#">EUR €</a></li>
                        </ul>
                    </div>
                    <!-- Currency End -->
                </div>
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- ekka mobile Menu End -->
</header>
{{-- <div class="ec-side-cat-overlay"></div> --}}
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