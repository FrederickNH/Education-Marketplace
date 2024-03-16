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
        <div class="row justify-content-end mr-1 mb-4">
            <div>
              <a class="edit-btn btn btn-white text-primary d-flex justify-content-start align-items-center" href="{{route('requestNeedActionList')}}">
                <i class="ni ni-book-bookmark"></i>
                <span>Request List</span>
              </a>  
            </div>
        </div>
        <div class="row justify-content-center">
            {{-- card --}}
            @foreach ($requestList as $r)      
                <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                    <div class="card text-black">
                        <div class="card-body">
                            <a href="/requestDetail/{{$r->id}}" style="color: black">
                                <div class="text-left">
                                    <div>
                                        @if($r->UserPicture == null)
                                            <img src="{{asset('assets')}}/img/noimage.png" class="card-img-top" alt="" />
                                        @else
                                            <img src="{{asset('assets')}}/img/{{$r->UserPicture}}" class="card-img-top" alt="" />
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <h4 class="">Requester: {{$r->UserFName}}&nbsp;{{$r->UserLName}}</h4>
                                        <p class="text-muted mb-2 text-sm">{{$r->SubjectName}} Grade {{$r->grade}}</p>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                            <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                            @if($r->repetitive == 1)
                                                <span> {{$r->repetitive_duration}}x&nbsp; {{__('Meeting')}}</span>
                                            @else
                                                <span> 1x {{__('Meeting')}}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                @if($r->group_size <= 1 || $r->group_size == null)
                                                    <span>Private</span>
                                                @else
                                                    <span>Group of {{$r->group_size}}</span>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                <span>{{$r->method}}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                            <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                            <span>Start at {{$r->day}}, &nbsp;{{\Carbon\Carbon::parse($r->date)->format('j M Y')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                            <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                            <span>{{\Carbon\Carbon::parse($r->start_time)->format('H:i')}} - {{\Carbon\Carbon::parse($r->end_time )->format('H:i')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                            <i class="ni ni-money-coins text-primary"> &nbsp;&nbsp;</i>
                                            <span>Rp.{{number_format($r->fee / 1, 2, '.', ',')}}</span>
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}