@extends('layouts.ekka')

@section('content')   
    <section class="sec-tp el-prod section-space-p">
        <div class="container">
            <div class="row">
				<div class="col-md-12 text-center">
					<div class="section-title">
						<h2 class="ec-bg-title">Tutoring List</h2>
						<h2 class="ec-title">Tutoring List</h2>
						<p class="sub-title">Browse All Tutoring From the Categories</p>
					</div>
				</div>
			</div>
            <div class="row">
                @foreach($competitionList as $competition)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- START single card -->
                        <div class="ec-product-tp">
                            <div class="ec-product-image">
                                <a href="#">
                                    <img src="{{asset('assets')}}/img/{{$competition->brochure}}" class="img-center" alt="">
                                </a>
                            </div>
                            <div class="ec-product-body card-tutor">
                                <h3 class="ec-title"><a href="../competitionDetailU/{{$competition->id}}">{{$competition->title}}</a></h3>
                                <div>
                                    {{-- <div class="d-flex justify-content-start align-items-center mb-2">
                                        <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                        @if($tutoring->repetitive_duration > 1)
                                            <span> {{$tutoring->repetitive_duration}}x&nbsp; {{__('Meeting')}}</span>
                                        @else
                                            <span> 1x {{__('Meeting')}}</span>
                                        @endif
                                    </div> --}}
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

@endsection

<style>
    .img-center{
        width: 350px;
        height: 200px;
    }
    .card-tutor{
        height: 300px;
    }
</style>