@extends('layouts.ekka')

@section('content')  
<div class="sticky-header-next-sec ec-main-slider section section-space-pb">
    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
        <!-- Main slider -->
        <div class="swiper-wrapper">
            <div class="ec-slide-item swiper-slide d-flex ec-slide-2">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title">Advertise Your School Now!!</h1>
                                <h2 class="ec-slide-stitle">Let the world know about your school</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
                                <a href="{{route('merchantRegistration')}}" class="btn btn-lg btn-secondary">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<section class="section ec-category-section ec-category-wrapper-4 section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Classic</h2>
                    <h2 class="ec-title">School List</h2>
                    <p class="sub-title">Browse all the school on the platform</p>
                </div>
            </div>
        </div>
        <div class="row cat-space-3 cat-auto margin-minus-tb-10">
            @foreach($schoolList as $school)
                <div class="col-lg-2 col-md-4 col-sm-12">
                    <a href="schoolDetail/{{$school->id}}"></a>
                    <div class="cat-card">
                        <div class="card-img">
                            @if($school->picture != null)
                                <img class="cat-icon banner-img" src="{{asset('assets')}}/img/{{$school->picture}}" alt="">
                            @else
                                <img class="cat-icon banner-img" src="{{asset('assets')}}/img/noimage.png" alt="">
                            @endif
                        </div>
                        <div class="cat-detail text-center">
                            <h4>{{$school->school_name}}</h4>
                            <h5>{{$school->cityName}}</h5>
                            <h5>Level : <span>{{$school->level}}</span></h5>
                            <h5>Accreditation : <span>{{$school->accreditation}}</span></h5>
                            <a class="btn-primary" href="schoolDetail/{{$school->id}}">See Detail</a>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
            
        </div>
    </div>
</section>
@endsection
<style>
    .banner-img{
    width: 10rem;
    height: 100px;
    }
</style>