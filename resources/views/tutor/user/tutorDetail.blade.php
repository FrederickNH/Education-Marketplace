@extends('layouts.ekka')

@section('content')
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p mt-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            {{-- <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                <div class="ec-sidebar-wrap">
                    <!-- Sidebar Category Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-vendor-block">
                            <!-- <div class="ec-vendor-block-bg"></div>
                            <div class="ec-vendor-block-detail">
                                <img class="v-img" src="assets/images/user/1.jpg" alt="vendor image">
                                <h5>Mariana Johns</h5>
                            </div> -->
                            <div class="ec-vendor-block-items">
                                <ul>
                                    <li><a href="user-profile.html">User Profile</a></li>
                                    <li><a href="user-history.html">History</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="track-order.html">Track Order</a></li>
                                    <li><a href="user-invoice.html">Invoice</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div class="ec-vendor-block-img space-bottom-30">
                                        
                                        <div class="ec-vendor-block-detail">
                                            @if($tutor->institution != null || $tutor->institution == 1)
                                                @if($tutor->institution_picture != null)
                                                    <img class="v-img" src="{{asset('assets')}}/img/{{$tutor->institution_picture}}" alt="vendor image">
                                                @else
                                                    <img class="v-img" src="{{asset('assets')}}/img/defaultUser.jpeg" alt="vendor image">
                                                @endif
                                                <h5 class="name">{{$tutor->institution_name}}<br></h5>
                                            @else
                                                @if($users->picture != null)
                                                    <img class="v-img" src="{{asset('assets')}}/img/{{$users->picture}}" alt="vendor image">
                                                @else
                                                    <img class="v-img" src="{{asset('assets')}}/img/defaultUser.jpeg" alt="vendor image">
                                                @endif
                                                <h5 class="name">{{$users->fname}} {{$users->lname}}<br></h5>
                                            @endif
                                            <p class="d-flex justify-content-center align-items-center mb-2"><span> 
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if($i <= $rate)
                                                        <i class="ecicon eci-star fill"></i>
                                                    @else
                                                        <i class="ecicon eci-star-o"></i>
                                                    @endif  
                                                @endfor
                                                </span><span>({{$rateCounter}})</span>
                                            </p>
                                        </div>
                                        <div class="m-3">
                                            <div>
                                                @if($tutor->institution != null || $tutor->institution == 1)
                                                <h4>Institution Information</h4>
                                                @else
                                                <h4>Tutor Information</h4>    
                                                @endif
                                            </div>
                                        </div>
                                        <div class="m-3">
                                            @if($tutor->institution != null || $tutor->institution == 1)
                                            <h5>About Institution</h5>
                                            @else
                                            <h5>About Tutor</h5>
                                            @endif
                                            <p class="ml-2">{{$tutor->description}}<br></p>    
                                        </div>
                                        <div class="text-center">
                                            @if($tutor->institution != null || $tutor->institution == 1)
                                                <a href="../chatify/institution-{{$tutor->user_id}}" class="btn btn-primary">Contact Institution</a>
                                            @else
                                                <a href="../chatify/tutor-{{$tutor->user_id}}" class="btn btn-primary">Contact Tutor</a>
                                            @endif
                                        </div>
                                        <br>
                                        <div>
                                            <div>
                                                <section class="section ec-brand-area section-space-p">
                                                    
                                                    <div class="container">
                                                        <div class="row">
                                                            @if($tutor->institution != null || $tutor->institution == 1)
                                                            <h5 class=>This Institution teaches :</h5>
                                                            @else
                                                            <h5 class=>This tutor teaches :</h5>
                                                            @endif
                                                            <div style="display: flex;flex-wrap: wrap;">
                                                            @foreach($subjectTeach as $subject)
                                                                <span class="m-2">
                                                                    <label class="subject-card"><a href="subjectTutoring/{{$subject->subject_id}}"><h5 class="mt-1 mb-2 text-center">{{$subject->subjectName}}</h5></a></label>
                                                                </span>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                
                                            </div>
                                        </div>
                                        <div class="m-3">
                                            @if($tutor->institution != null || $tutor->institution == 1)
                                                <h5 class=>{{__("Institution available tutoring class")}}</h5>
                                            @else
                                                <h5>{{__("Tutor available tutoring class")}}</h5>
                                            @endif
                                            @if(count($tutoringList) > 4)
                                                <div class="row">
                                                    @foreach($tutoringList as $tutoring)
                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <!-- START single card -->
                                                            <div class="ec-product-tp">
                                                                <div class="ec-product-image">
                                                                    <a href="../tutoringDetailU/{{$tutoring->id}}">
                                                                        <img src="{{asset('assets')}}/img/{{$tutoring->banner}}" class="img-center tutoring-img" alt="">
                                                                    </a>
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
                                            @elseif(count($tutoringList) < 1)
                                                <div>
                                                    <h3>There's no tutoring classes available</h3>
                                                </div>
                                            @else
                                                <div class="row">
                                                    @foreach($tutoringList as $tutoring)
                                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                                        <!-- START single card -->
                                                        <div class="ec-product-tp">
                                                            <div class="ec-product-image">
                                                                <a href="../tutoringDetailU/{{$tutoring->id}}">
                                                                    <img src="{{asset('assets')}}/img/{{$tutoring->banner}}" class="img-center tutoring-img" alt="">
                                                                </a>
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
                                            @endif
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
                                                                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-schedule"
                                                                        role="tablist">Schedules</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-holiday"
                                                                        role="tablist">Day Off</a>
                                                                </li>
                                                                @if($tutor->institution != null || $tutor->institution == 1)
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-award"
                                                                        role="tablist">Award</a>
                                                                </li>
                                                                @else
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-history"
                                                                        role="tablist">Academic Histories</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-experience"
                                                                        role="tablist">Experiences</a>
                                                                </li>
                                                                @endif
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-past-tutoring"
                                                                        role="tablist">Past Tutoring</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content  ec-single-pro-tab-content">
                                                            <div id="ec-spt-nav-schedule" class="tab-pane fade show active">
                                                                <div class="ec-single-pro-tab-schedule">
                                                                    <div class="ec-vendor-card-body">
                                                                        <div class="ec-vendor-card-table">
                                                                            <table class="table ec-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Day</th>
                                                                                        <th scope="col">Available From</th>
                                                                                        <th scope="col">Break at</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($schedule as $sc)
                                                                                        <tr>
                                                                                            <td scope="row"><span>{{$sc->day_of_the_week}}</span></td>
                                                                                            @if($sc->start_time != null)
                                                                                                <td scope="row"><span>{{$sc->start_time}}-{{$sc->end_time}}</span></td>
                                                                                                <td scope="row"><span>{{$sc->start_break_time}}-{{$sc->end_break_time}}</span></td>
                                                                                            @else
                                                                                                <td scope="row"><span>No Schedule</span></td>
                                                                                                <td scope="row"><span></span></td>
                                                                                            @endif
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="ec-spt-nav-holiday" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-holiday">
                                                                    <div class="ec-vendor-card-body">
                                                                        <div class="ec-vendor-card-table">
                                                                            <table class="table ec-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Date</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($holidayList as $holiday)
                                                                                        <tr>
                                                                                            <td scope="row"><span>{{\Carbon\Carbon::parse($holiday->date)->format('j M Y')}}</span></td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($tutor->institution != null || $tutor->institution == 1)
                                                            <div id="ec-spt-nav-award" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-award">
                                                                    @if(count($acdHistory) > 0)
                                                                        @foreach($acdHistory as $history)
                                                                        <div class="row justify-content-start acd-hist">
                                                                            <div class="col-5 img-acd">
                                                                                <img class="img-acd" src="{{asset('assets')}}/img/school.png" alt="">
                                                                            </div>    
                                                                            <div class="col-7">
                                                                                <h5>Graduated from {{$history->school_name}}</h5>
                                                                                <h6>In {{$history->year_graduated}}</h6>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else 
                                                                        <h3>No Data for Accademic History</h3>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div id="ec-spt-nav-history" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-history">
                                                                    @if(count($acdHistory) > 0)
                                                                        @foreach($acdHistory as $history)
                                                                        <div class="row justify-content-start acd-hist">
                                                                            <div class="col-5 img-acd">
                                                                                <img class="img-acd" src="{{asset('assets')}}/img/school.png" alt="">
                                                                            </div>    
                                                                            <div class="col-7">
                                                                                <h5>Graduated from {{$history->school_name}}</h5>
                                                                                <h6>In {{$history->year_graduated}}</h6>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else 
                                                                        <h3>No Data for Accademic History</h3>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div id="ec-spt-nav-experience" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-history">
                                                                    @if(count($exp) > 0)
                                                                        @foreach($exp as $e)
                                                                        <div class="row justify-content-start acd-hist">
                                                                            <div class="col-5">
                                                                                <img class="img-acd" src="{{asset('assets')}}/img/office-building.png" alt="">
                                                                            </div>    
                                                                            <div class="col-7">
                                                                                <h5>Work at {{$e->workplace}}</h5>
                                                                                <h6>as {{$e->position}} from {{\Carbon\Carbon::parse($e->start_month)->format('M Y')}}-{{\Carbon\Carbon::parse($e->end_month)->format('M Y')}}</h6>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else 
                                                                        <h3>No Data for Experiences</h3>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div id="ec-spt-nav-past-tutoring" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-past-tutoring">
                                                                    <div class="ec-vendor-card-body">
                                                                        <div class="ec-vendor-card-table">
                                                                            <table class="table ec-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Title</th>
                                                                                        <th scope="col">Date</th>
                                                                                        <th scope="col">Time</th>
                                                                                        <th scope="col">Price</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($tutoringPastList as $tutoring)
                                                                                        <tr>
                                                                                            <td scope="row"><span>{{$tutoring->title}}</span></td>
                                                                                            <td scope="row"><span>{{$tutoring->day}},&nbsp;{{\Carbon\Carbon::parse($tutoring->date)->format('j M Y')}}</span></td>
                                                                                            <td scope="row"><span>{{$tutoring->start_time}}-{{$tutoring->end_time}}</span></td>
                                                                                            <td scope="row"><span>{{$tutoring->price}}</span></td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<style>
    .acd-hist{
        align-content: center;
        align-items: center;
    }
    .tutoring-img{
        border: 1px solid lightgray;
        border-radius: 5px;
    }
    .img-center{
        width: 350px;
        height: 200px;
        border: 1px solid lightgray;
    }
    .subject-card{
        border: 1px solid lightgray;
        border-radius: 5px;
        box-shadow: 5px 3px 5px 0px rgba(198,170,170,0.75);
        -webkit-box-shadow: 5px 3px 5px 0px rgba(198,170,170,0.75);
        -moz-box-shadow: 5px 3px 5px 0px rgba(198,170,170,0.75);
        height: 30px;
    }
    .img-acd{
        width: 225px;
        height: 225px;
        margin-bottom: 5px;
    }
</style>