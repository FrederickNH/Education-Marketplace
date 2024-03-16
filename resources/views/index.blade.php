@extends('layouts.ekka')

@section('content')
<div class="sticky-header-next-sec ec-main-slider section">
    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
        <!-- Main slider -->
        <div class="swiper-wrapper">
            <div class="ec-slide-item swiper-slide d-flex ec-slide-1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title bg-lighter">Start Seeking Tutor Now</h1>
                                <h2 class="ec-slide-stitle bg-lighter">for the best experience</h2>
                                {{-- <p class="bg-lighter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
                                <a href="{{route('seekTutoring')}}" class="btn btn-lg btn-secondary">Seek Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-slide-item swiper-slide d-flex ec-slide-2">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 offset-xl-6 col-lg-7 offset-lg-5 col-md-7 offset-md-5 col-sm-7 offset-sm-5 align-self-center">
                            <div class="ec-slide-content slider-animation text-right">
                                <h1 class="ec-slide-title bg-lighter">Become a Tutor Now!!</h1>
                                <h2 class="ec-slide-stitle bg-lighter">Advertise your service in the market</h2>
                                {{-- <p class="bg-lighter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
                                <a href="{{route('tutorRegistration')}}" class="btn btn-lg btn-secondary">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-slide-item swiper-slide d-flex ec-slide-3">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title bg-lighter">Register Your Institution Now!!</h1>
                                <h2 class="ec-slide-stitle bg-lighter">Advertise your service in the market</h2>
                                {{-- <p class="bg-lighter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
                                <a href="{{route('institutionRegistration')}}" class="btn btn-lg btn-secondary">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-slide-item swiper-slide d-flex ec-slide-4">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title bg-lighter">Advertise Your School Now!!</h1>
                                <h2 class="ec-slide-stitle bg-lighter">Let the world know about your school</h2>
                                {{-- <p class="bg-lighter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
                                <a href="{{route('schoolRegistration')}}" class="btn btn-lg btn-secondary">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-slide-item swiper-slide d-flex ec-slide-5">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title bg-lighter">Advertise Your Service Now!!</h1>
                                <h2 class="ec-slide-stitle bg-lighter">Let the people know about your school shuttle service</h2>
                                {{-- <p class="bg-lighter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
                                <a href="{{route('shuttleRegistration')}}" class="btn btn-lg btn-secondary">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-slide-item swiper-slide d-flex ec-slide-6">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h1 class="ec-slide-title bg-lighter">Post You Competition Now!!</h1>
                                <h2 class="ec-slide-stitle bg-lighter">Let the people know about your competition</h2>
                                {{-- <p class="bg-lighter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> --}}
                                <a href="{{route('organiserRegistration')}}" class="btn btn-lg btn-secondary">Join Now</a>
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
<section class="section ec-category-section ec-category-wrapper-4 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Classic</h2>
                    <h2 class="ec-title">Tutoring Titans</h2>
                    <p class="sub-title">Tutor with the most transaction made this month</p>
                </div>
            </div>
        </div>
        <div class="row cat-space-1 cat-auto margin-minus-tb-10">
            @foreach($topTutorList as $tutor)
                <div class="col-lg-2 col-md-4 col-sm-12">
                    <a href="tutorDetail/{{$tutor->id}}">
                        <div class="cat-card card-tutor">
                            <div class="card-img">
                                @if($tutor->picture != null)
                                    <img class="img-center" src="{{asset('assets')}}/img/{{$tutor->picture}}" alt="">
                                @else
                                    <img class="img-center" src="{{asset('assets')}}/img/defaultUser.Jpeg" alt="">
                                @endif
                            </div>
                            <div class="cat-detail">
                                <h4>{{$tutor->fname}}&nbsp;{{$tutor->lname}}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section ec-category-section ec-category-wrapper-4 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Classic</h2>
                    <h2 class="ec-title">HOT Subjects</h2>
                    <p class="sub-title">Tutoring subjects that being bought this month</p>
                </div>
            </div>
        </div>
        <div class="row cat-space-1 cat-auto margin-minus-tb-10">
            @foreach($hotSubjectList as $subject)
                <div class="col-lg-2 col-md-4 col-sm-12">
                    <a href="tutorDetail/{{$subject->id}}">
                        <div class="cat-card card-tutor">
                            <div class="card-img" style="width: 200px; height: 200px; padding: 1px;">
                                {{-- <h1>{{$subject->name}}</h1> --}}
                                <img class="img-center" src="{{asset('assets')}}/img/book.png" alt="">
                            </div>
                            <div class="cat-detail">
                                <h4>{{$subject->name}}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section ec-category-section ec-category-wrapper-4 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Classic</h2>
                    <h2 class="ec-title">Competition For {{$status == 'student' || $status == "general" ? 'You' : 'Your Child'}}</h2>
                    <p class="sub-title">Reccomendation for competition around {{$status == 'student' || $status == "general" ? 'your' : 'your child'}} age</p>
                </div>
            </div>
        </div>
        <div class="row cat-space-1 cat-auto margin-minus-tb-10">
            @foreach($recCompe as $competition)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- START single card -->
                        <div class="ec-product-tp">
                            <div class="ec-product-image">
                                <a href="#">
                                    <img src="{{asset('assets')}}/img/{{$competition->brochure}}" class="img-center" alt="">
                                </a>
                                @if($competition->status == 'SA')
                                    <span class="ec-product-ribbon">Age & Subject</span>
                                @elseif($competition->status == 'A')
                                    <span class="ec-product-ribbon">Age</span>
                                @endif
                            </div>
                            <div class="ec-product-body card-tutor">
                                <h3 class="ec-title"><a href="../competitionDetailU/{{$competition->id}}">{{$competition->title}}</a></h3>
                                <div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>
                                        <span>For age between {{$competition->min_age}} - {{$competition->max_age}}</span>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>
                                        <span>{{$competition->allowed_team_member}} member max per team</span>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                        <span>Regist end : {{\Carbon\Carbon::parse($competition->campaign_end )->format('j M Y')}}</span>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                        <span>Event : {{\Carbon\Carbon::parse($competition->competition_start)->format('j M Y')}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- START single card -->
                    </div>
                @endforeach
        </div>
    </div>
</section>
<br>

@if(count($tutorList) > 0)
<section class="section ec-catalog-multi-vendor margin-bottom-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Classic</h2>
                    <h2 class="ec-title">Maybe You Also Like This Tutor</h2>
                    <p class="sub-title">this reccomendation are given based on your activity</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ec-multi-vendor-detail">
                <div class="ec-page-description ec-page-description-info">
                    <div class="ec-catalog-vendor">
                        <img src="{{asset('assets')}}/img/{{$tutorList[0]->picture}}" alt="vendor img">
                    </div>
                    <div class="ec-catalog-vendor-info">
                        <div class="row vendor-card-height">
                            <div class="col-lg-3 col-md-6 detail-card-space">
                                <div class="seller-name-level catalog-detail-card">

                                    <a href="catalog-single-vendor.html">
                                        <h6 class="name"></h6>
                                    </a>
                                    <p>{{$tutorList[0]->fname.' '.$tutorList[0]->lname}}</p>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-md-6 detail-card-space">
                                <div class="ec-catalog-ratings catalog-detail-card">
                                    <h6>Level</h6>
                                    <p>( Level : 9 out of 10 )</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 detail-card-space">
                                <div class="ec-catalog-pro-count catalog-detail-card">
                                    <h6>Seller Products</h6>
                                    <p>568 Products</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 detail-card-space">
                                <div class="ec-catalog-since catalog-detail-card">
                                    <h6>Seller since</h6>
                                    <p>1year and 11months</p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row vendor-row">
            <div class="ec-multi-vendor-slider">
                @foreach ($tutorList[0]->tutoring as $tutoring)
                    @for($i = 0; $i < count($tutoring); $i++)
                        <div class="ec-product-tp">
                            <div class="ec-product-image">
                                @if($tutoring[$i]->banner != null)
                                <a href="tutoringDetailM/{{$tutoring[$i]->id}}">
                                    <img src="{{asset('assets')}}/img/{{$tutoring[$i]->banner}}" class="img-center" alt="">
                                </a>
                                @else
                                <a href="tutoringDetailM/{{$tutoring[$i]->id}}">
                                    <img src="{{asset('assets')}}/img/noimage.png" class="img-center" alt="">
                                </a>
                                @endif
                            </div>
                            <div class="ec-product-body card-tutor">
                                <h3 class="ec-title"><a href="tutoringDetailM/{{$tutoring[$i]->id}}">{{$tutoring[$i]->title}}</a></h3>
                                <p class="ec-description">
                                    {{$tutoring[$i]->SubjectName}}
                                </p>
                                <div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                        @if($tutoring[$i]->repetitive_duration > 1)
                                            <span> {{$tutoring[$i]->repetitive_duration}}x&nbsp; {{__('Meeting')}}</span>
                                        @else
                                            <span> 1x {{__('Meeting')}}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                            @if($tutoring[$i]->group_size <= 1 || $tutoring[$i]->group_size == null)
                                                <span>Private</span>
                                            @else
                                                <span>Group of {{$tutoring[$i]->group_size}}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                            <span>{{$tutoring[$i]->method}}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-calendar-grid-58 text-primary">&nbsp;&nbsp;</i>
                                        <span class="">Start at {{$tutoring[$i]->day}}, &nbsp;{{\Carbon\Carbon::parse($tutoring[$i]->date)->format('j M Y')}}</span>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                        <span>{{\Carbon\Carbon::parse($tutoring[$i]->start_time)->format('H:i')}} - {{\Carbon\Carbon::parse($tutoring[$i]->end_time )->format('H:i')}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endfor
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
{{-- 
<a href="{{route('catalog.tutoringList')}}" class="btn btn-primary">Tutoring Catalog</a>
<a href="{{route('catalog.tutorList')}}" class="btn btn-primary">Tutor Catalog</a>
<a href="{{route('catalog.schoolList')}}" class="btn btn-primary">School Catalog</a>
<a href="{{route('catalog.shuttleList')}}" class="btn btn-primary">Shuttle Catalog</a>
<a href="{{route('catalog.competitionList')}}" class="btn btn-primary">Competition Catalog</a> --}}
@endsection
<style>
    .img-center{
        width: 175px;
        height: 175px;
        overflow: auto;
        border: 1px solid lightgray;
    }
    .card-tutor{
        height: 265px;
    }
    /* .text-sm{
        font-size: 16px;
    } */
</style>