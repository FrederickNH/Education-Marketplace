@extends('layouts.app',['class' => 'bg-default'])

@section('content')

<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">      
        @if (session('status'))
            <div class="row alert alert-success" id="status-messages">
                <span id="status-text">{{ session('status') }}</span>
                <button class="status-close-button" id="close-button">&times;</button>
            </div>
        @endif
        {{-- <div class="row justify-content-end mr-1 mb-4">
            <div>
              <a class="edit-btn btn btn-white text-primary d-flex justify-content-start align-items-center" href="{{route('seekingListTutor')}}">
                <i class="ni ni-fat-add"></i>
                <span>Bidded list</span>
              </a>  
            </div>
        </div> --}}
        <div class="row justify-content-center">
            {{-- card --}}
            @foreach ($seekList as $sl)      
                <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                    <div class="card text-black">
                        <div class="card-body">
                            <a href="/seekingDetailTutor/{{$sl->id}}">
                                <div class="text-left">
                                    <div>
                                        @if($sl->UserPicture == null)
                                            <img src="{{asset('assets')}}/img/noimage.png" class="card-img-top sl-img" alt="" />
                                        @else
                                            <img src="{{asset('assets')}}/img/{{$sl->UserPicture}}" class="card-img-top sl-img" alt="" />
                                        @endif
                                    </div>
                                    <div class="mt-3" id="badge-div">
                                        <div class="media-body">
                                            @if($sl->timeBlocked == 0)
                                                <span class="badge badge-success">{{__('Schecule Available')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <h4 class="mb-2 text-sm">{{__('Requester')}} : {{$sl->UserFName}}&nbsp;{{$sl->UserLName}}</h4>
                                        <h6 class='text-muted mb-2 text-sm'>{{$sl->SubjectName}} for Grade {{$sl->grade}}</h6>
                                        <div class="d-flex justify-content-start align-items-center mb-2 text-sm">
                                            <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                            <span>Start at {{$sl->day}}, &nbsp;{{\Carbon\Carbon::parse($sl->date)->format('j M Y')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2 text-sm">
                                            <i class="ni ni-tag text-primary">&nbsp;&nbsp;</i>
                                            <span>Rp.{{number_format($sl->min_price / 1, 2, '.', ',')}} - Rp.{{number_format($sl->max_price / 1, 2, '.', ',')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        {{-- end card --}}
        </div>
        
      </div>
</div>



@endsection
<style>
    .sl-img{
        width: 250px;
        height: 250px;
    }
</style>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}