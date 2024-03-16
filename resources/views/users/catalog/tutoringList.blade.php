@extends('layouts.ekka')

@section('content')   
<section class="ec-page-content section-space-p">
    <div class="container-fluid">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <!-- Shop Top Start -->
                <form action="{{ url('catalog/tutoringList') }}" method="GET">
                    <div class="ec-pro-list-top d-flex">
                        <span>Filter :</span>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-method" id="filter-method">
                                    <option value="" disabled selected>Filter Method</option>
                                    <option value="Offline">Offline</option>
                                    <option value="Online">Online</option>
                                    <option value="HomeService">Home Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-mode" id="filter-mode">
                                    <option value="" disabled selected>Filter Mode</option>
                                    <option value="Group">Group</option>
                                    <option value="Private">Private</option>
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-rep" id="filter-rep">
                                    <option value="" disabled selected>Filter Repetition</option>
                                    <option value="non">One Time</option>
                                    <option value="rep">Repetitive</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <span class="sort-by">Max Price :</span>
                            <input type="number" class="sort__input" name="filter-price" id="filter-price" width="200px" >
                        </div>
                        <div>
                            <button type="submit" class="btn-md btn-primary">Apply Filters</button>
                            <a href="{{ url('/catalog/tutoringList') }}" class="btn-md btn-secondary">Reset Filters</a>
                        </div>
                    </div>
                </form>
                <!-- Shop Top End -->

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @foreach($filteredTutoring as $tutoring)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <!-- START single card -->
                                    <div class="ec-product-tp">
                                        <div class="ec-product-image">
                                            @if($tutoring->banner != null)
                                            <a href="../tutoringDetailU/{{$tutoring->id}}">
                                                <img src="{{asset('assets')}}/img/{{$tutoring->banner}}" class="img-center" alt="">
                                            </a>
                                            @else
                                            <a href="../tutoringDetailU/{{$tutoring->id}}">
                                                <img src="{{asset('assets')}}/img/noimage.png" class="img-center" alt="">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="ec-product-body card-tutor">
                                            <h3 class="ec-title"><a href="../tutoringDetailU/{{$tutoring->id}}">{{$tutoring->title}}</a></h3>
                                            <div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                                    @if($tutoring->repetitive_duration > 1)
                                                        <span> {{$tutoring->repetitive_duration}}x&nbsp; {{__('Meeting')}}</span>
                                                    @else
                                                        <span> 1x {{__('Meeting')}}</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                    <span>{{\Carbon\Carbon::parse($tutoring->start_time)->format('H:i')}} - {{\Carbon\Carbon::parse($tutoring->end_time )->format('H:i')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                        @if($tutoring->group_size <= 1 || $tutoring->group_size == null)
                                                            <span>Private</span>
                                                        @else
                                                            <span>Group of {{$tutoring->group_size}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>{{$tutoring->method}}</span>
                                                    </div>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Start at {{$tutoring->day}}, &nbsp;{{\Carbon\Carbon::parse($tutoring->date)->format('j M Y')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-money-coins text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Rp.{{number_format($tutoring->price / 1, 2, '.', ',')}}</span>
                                                </div>
                                            </div>
                                        </div>
            
                                    </div>
                                    <!-- START single card -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Ec Pagination Start -->
                    <!-- Ec Pagination End -->
                </div>
                <!--Shop content End -->
            </div>
            <div class="filter-sidebar-overlay"></div>
                <div class="ec-shop-leftside filter-sidebar">
                    <div class="ec-sidebar-heading">
                        <h1>Filter Products By</h1>
                        <a class="filter-cls-btn" href="javascript:void(0)">×</a>
                    </div>
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Category</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" checked /> <a href="#">clothes</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">Bags</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">Shoes</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">cosmetics</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">electrics</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" /> <a href="#">phone</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li id="ec-more-toggle-content" style="padding: 0; display: none;">
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox" /> <a href="#">Watch</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox" /> <a href="#">Cap</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item ec-more-toggle">
                                            <span class="checked"></span><span id="ec-more-toggle">More
                                                Categories</span>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Size Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Size</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value="" checked /><a href="#">S</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value="" /><a href="#">M</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value="" /> <a href="#">L</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value="" /><a href="#">XL</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value="" /><a href="#">XXL</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Color item -->
                        {{-- <div class="ec-sidebar-block ec-sidebar-block-clr">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Color</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#c4d6f9;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#ff748b;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#000000;"></span></div>
                                    </li>
                                    <li class="active">
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#2bff4a;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#ff7c5e;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#f155ff;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#ffef00;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#c89fff;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#7bfffa;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#56ffc1;"></span></div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        <!-- Sidebar Price Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Price</h3>
                            </div>
                            <div class="ec-sb-block-content es-price-slider">
                                <div class="ec-price-filter">
                                    <div id="ec-sliderPrice" class="filter__slider-price" data-min="0" data-max="250"
                                        data-step="10"></div>
                                    <div class="ec-price-input">
                                        <label class="filter__label"><input type="text" class="filter__input"></label>
                                        <span class="ec-price-divider"></span>
                                        <label class="filter__label"><input type="text" class="filter__input"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Sidebar Area Start -->

        </div>
    </div>
</section>
@endsection
<style>
    .img-center{
        width: 350px;
        height: 200px;
        border: 1px solid lightgray;
    }
    .card-tutor{
        height: 360px;
    }
</style>
<script>
    $(document).ready(function() {
        $('#priceFilter, #nameFilter, #locationFilter').on('input change', function() {
            var maxPrice = parseFloat($('#priceFilter').val()) || Infinity;
            var productName = $('#nameFilter').val().toLowerCase();
            var locationFilter = $('#locationFilter').val();

            $('#productList .card').each(function() {
            var $product = $(this);
            var price = parseFloat($product.data('price'));
            var name = $product.data('name').toLowerCase();
            var location = $product.data('location');

            var priceFilter = price <= maxPrice;
            var nameFilter = name.includes(productName);
            var locationFilter = locationFilter === 'all' || location === locationFilter;

            $product.toggle(priceFilter && nameFilter && locationFilter);
            });
        });
    });
</script>