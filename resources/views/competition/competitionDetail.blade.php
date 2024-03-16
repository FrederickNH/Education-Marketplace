@extends('layouts.ekka')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-OfKtCqT5lG9YufSI"></script>
@section('content')   

<div class="product_page">
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img single-pro-img-no-sidebar col-lg-6 col-md-6">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            <div class="single-slide">
                                                @if($competition->brochure == null)
                                                <img class="img-card" src="{{asset('assets')}}/img/noimage.png"
                                                    alt="">
                                                @else
                                                <img class="img-card" src="{{asset('assets')}}/img/{{$competition->brochure}}"
                                                    alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar col-lg-6 col-md-6">
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title" id="competition-id" data-value="{{ $competition->id }}" >{{$competition->title}}</h5>
                                        <div class="ec-single-desc">
                                            <a href="#">
                                                @if($org->picture != null)
                                                <p>Organised by :&nbsp;<img class="profile-pic" src="{{asset('assets')}}/img/{{$org->picture}}" alt="">&nbsp;{{$org->org_name}} &nbsp;&nbsp;<a class="btn-sm btn-primary" href="/chatify/organiser-{{$org->user_id}}">Contact Organiser</a></p>
                                                @else
                                                <p>Organised by :&nbsp;<img class="profile-pic" src="{{asset('assets')}}/img/defaultUser.jpeg" alt="">&nbsp;{{$org->org_name}} &nbsp;&nbsp;<a class="btn-sm btn-primary" href="/chatify/organiser-{{$org->user_id}}">Contact Organiser</a></p>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="ec-single-desc">{{$competition->description}}</div>
                                        <div class="ec-single-sales">
                                            <div class="ec-single-sales-inner">
                                                <div class="ec-single-sales-visitor">Competition Detail :</div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Registration closed at {{\Carbon\Carbon::parse($competition->campaign_end)->format('j M Y')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Event is held from {{\Carbon\Carbon::parse($competition->competition_start)->format('j M Y')}}-{{\Carbon\Carbon::parse($competition->competition_end)->format('j M Y')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Max member per team : {{$competition->allowed_team_member}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <section class="ec-page-content section-space-p">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="ec-tab-wrapper ec-tab-wrapper-1">
                                                        <div class="ec-single-pro-tab-wrapper">
                                                            <div class="ec-single-pro-tab-nav">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-variant"
                                                                            role="tablist">Variant</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-prize"
                                                                            role="tablist">Prize</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-content  ec-single-pro-tab-content">
                                                                <div id="ec-spt-nav-variant" class="tab-pane fade show active">
                                                                    <div class="ec-single-pro-tab-variant">
                                                                        <div class="ec-vendor-card-body">
                                                                            @foreach($variantList as $variant)
                                                                                <div>
                                                                                    <h5>Variant : <span>{{$variant->name}}</span></h5>
                                                                                    <p>For age : <span>{{$variant->min_age}}-{{$variant->max_age}}</span></p>
                                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                        <div class="col-sm-6">
                                                                                            <p>registration price : <span>{{$variant->price}}</span></p>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <a href="../competitionRegisterDetail/{{$variant->id}}" class="btn-sm btn-primary">Register Now</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="ec-spt-nav-prize" class="tab-pane fade">
                                                                    <div class="ec-single-pro-tab-prize">
                                                                        <div class="ec-vendor-card-body">
                                                                            @foreach($variantList as $variant)
                                                                                <div>
                                                                                    <h5>Variant : <span>{{$variant->name}}</span></h5>
                                                                                    @foreach ($variant->prize as $prize)
                                                                                        <p>Rank {{$prize->rank_no}} : {{$prize->money_prize}} + {{$prize->other_prize}}</p>
                                                                                    @endforeach
                                                                                </div>
                                                                                <br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        {{-- <div class="ec-single-price-stoke">
                                            <div class="ec-single-price">
                                                <span class="new-price">Rp {{number_format($item->price / 1, 2, '.', ',')}}</span>
                                            </div>
                                            @if($item->mode == "Group")
                                            <div class="ec-single-stoke">
                                                <span class="ec-single-ps-title">Slot left: {{$item->group_size}}</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="ec-single-qty">
                                            <div class="ec-single-cart ">
                                                <button class="btn btn-primary btn-book">{{__('Book')}}</button>
                                            </div>
                                        </div> --}} 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <!-- product details description area end -->
                </div>
    
            </div>
        </div>
    </section>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-book').click(function () {
            var dataValue = document.getElementById('competition-id').getAttribute('data-value');
            var promo =  null;
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/bookTutoring/' + dataValue + '/' + promo, // Replace with your route to fetch item data
                type: 'GET',
                success: function (data) {
                    // $('#editItemId').val(data.id);
                    // $('#editStartTime').val(data.start_time);
                    // $('#editEndTime').val(data.end_time);
                    // $('#editStartBreakTime').val(data.start_break_time);
                    // $('#editEndBreakTime').val(data.end_break_time);
                    // // Populate other form fields as needed
                    // window.snap.pay(data);
                    window.snap.pay(data[0], {
                        onSuccess: function(result){
                            /* You may add your own implementation here */
                            alert("payment success!"); console.log(result);
                            
                            
                            window.location.href = '/saveBooking/'+ data[1];
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            alert("payment failed!"); console.log(result);
                            window.location.href = '/cancelBooking/'+ data[1];
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                            window.location.href = '/cancelBooking/'+ data[1];
                        }
                    });
                }
            });
        });
    });
</script>

<style>
    .img-card{
        width: 800px;
    }
    .profile-pic {
        width: 30px; /* Set the width of the container */
        height: 30px; /* Set the height of the container */
        overflow: hidden; /* Hide any overflow */
        border-radius: 50%; /* Create a circular shape */
    }

    .profile-pic img {
        width: 100%; /* Make the image fill the container */
        height: auto; /* Maintain the image's aspect ratio */
        display: block; /* Remove extra space below the image */
        border-radius: 50%; /* Ensure the image is also circular */
    }
</style>