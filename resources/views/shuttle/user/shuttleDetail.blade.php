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
                                            <img class="v-img" src="{{asset('assets')}}/img/{{$shuttle->picture}}" alt="vendor image">
                                            <h5 class="name">{{$shuttle->shuttle_name}}<br></h5>
                                            <h6>{{$shuttle->subdistrictName}},{{$shuttle->cityName}}</h6>
                                        </div>
                                        <div class="m-3">
                                            <div>
                                                <h4>Shuttle Information</h4>    
                                            </div>
                                        </div>
                                        {{-- <div class="m-3">
                                            <h5>Price: <span>Rp.{{number_format($shuttle->price / 1, 2, '.', ',')}}</span>({{$shuttle->form == "Fixed" ? "Fixed" : ($shuttle->form == "KM" ? "per KM" : "")}})</h5><br>
                                        </div> --}}
                                        <div class="m-3">
                                            <h5>Description</h5>
                                            <p class="ml-2">{{$shuttle->description}}<br></p>    
                                        </div>
                                        <div class="text-center">
                                            <a href="../chatify/shuttle-{{$shuttle->user_id}}" class="btn btn-primary">Contact Shuttle</a>
                                        </div>
                                        <br>
                                    </div>
                                    <section class="ec-page-content section-space-p">
                                        <div class="container">
                                            <div class="row">
                                                <h2>Shuttle Destination :</h2>
                                                @foreach($destinationList as $destination)
                                                <div class="row justify-content-start subject-card ml-4 mb-3" style="width: 620px">
                                                    <div class="col-5 img-acd">
                                                        <img class="img-acd" src="{{asset('assets')}}/img/{{$destination->picture}}" alt="">
                                                    </div>    
                                                    <div class="col-7 acd-hist pt-1  pb-0"><br>
                                                        <h5>Stating Point:</h4>
                                                        <h6>{{$destination->subdistrict_name}}</h5>
                                                        <h5>Destination:</h4>
                                                        <h6>{{$destination->school_name}}   </h5>
                                                        <h5>Price:</h4>
                                                        <h6>Rp. {{number_format($destination->price / 1, 2, '.', ',')}}</h5>
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