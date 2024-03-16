@extends('layouts.ekka')

@section('content')
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div class="ec-vendor-block-img space-bottom-30">
                                        <div class="ec-vendor-block-bg" style="background-image: url('{{asset('assets')}}/img/noimage.png')">
                                            
                                        </div>
                                        <div class="ec-vendor-block-detail">
                                            <img class="v-img" src="{{asset('assets')}}/img/{{$school->picture}}" alt="vendor image">
                                            <h5 class="name">{{$school->school_name}}({{$school->level}})<br></h5>
                                        </div>
                                        <div class="m-3">
                                            <div>
                                                <h4>School Information</h4>    
                                            </div>
                                        </div>
                                        <div class="m-3">
                                            <h5>School Accreditation</h5>
                                            <p class="ml-2">{{$school->accreditation}}</p><br>
                                        </div>
                                        <div class="m-3">
                                            <h5>School Address</h5>
                                            <p class="ml-2">{{$school->address}} {{$school->subdistrictName}},{{$school->cityName}}</p><br>
                                        </div>
                                        <div class="m-3">
                                            <h5>Vision</h5>
                                            <p class="ml-2">{{$school->vision}}<br></p>    
                                        </div>
                                        <div class="m-3">
                                            <h5>Mission</h5>
                                            <p class="ml-2">{{$school->mission}}<br></p>    
                                        </div>
                                        <div class="m-3">
                                            <h5>Website</h5>
                                            <p class="ml-2">{{$school->website}}<br></p>    
                                        </div>
                                        <div class="m-3">
                                            <h5>Phone Number</h5>
                                            <p class="ml-2">{{$school->phone}}<br></p>    
                                        </div>
                                        <div class="m-3">
                                            <h5>Enrollment Type</h5>
                                            @foreach($enrollmentTypeList as $type)
                                                <div>
                                                    <span class="m-3"><b>{{$type->title}}</b> : <span>Rp.{{number_format($type->price / 1, 2, '.', ',')}}</span></span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="m-3">
                                            <h5>Enrollment Date</h5>
                                            <p class="ml-2">{{\Carbon\Carbon::parse($school->enrollment_start)->format('j M Y')}} - &nbsp;{{\Carbon\Carbon::parse($school->enrollment_end)->format('j M Y')}}<br></p>    
                                        </div>
                                        <div class="text-center">
                                            <a href="../chatify/school-{{$school->user_id}}" class="btn btn-primary">Contact School</a>
                                        </div>
                                        <br>
                                    </div>
                                    <section class="ec-page-content section-space-p">
                                        <div class="container">
                                            <div class="row">
                                                <h2>School Facilities :</h2>
                                                @foreach($facilityList as $facility)
                                                <div class="row justify-content-start subject-card ml-4 mb-3" style="width: 1270px">
                                                    <div class="col-3 img-acd">
                                                        <img class="img-acd" src="{{asset('assets')}}/img/{{$facility->pivot->picture}}" alt="">
                                                    </div>    
                                                    <div class="col-9 alg-justify"><br>
                                                        <h5>{{$facility->name}}</h5>
                                                        <h6>&nbsp;&nbsp;&nbsp;&nbsp; {{$facility->pivot->facility_detail}}</h6>
                                                    </div>
                                                </div>
                                                @endforeach
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
    .alg-justify{
        text-align: justify;
    }
    .acd-hist{
        align-content: center;
        align-items: center;
    }
    .tutoring-img{
        border: 1px solid lightgray;
        border-radius: 5px;
    }
    .subject-card{
        border: 1px solid lightgray;
        border-radius: 5px;
        box-shadow: 2px 4px 13px -5px rgba(0,0,0,0.73);
        -webkit-box-shadow: 2px 4px 13px -5px rgba(0,0,0,0.73);
        -moz-box-shadow: 2px 4px 13px -5px rgba(0,0,0,0.73);
    }
    .img-acd{
        margin-left: 0px;
        width: 300px;
        height: 225px;
        margin-bottom: 5px;
    }
</style>