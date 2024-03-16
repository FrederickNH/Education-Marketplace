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
              <a class="edit-btn btn btn-white text-primary d-flex justify-content-start align-items-center" href="{{route('tutoringCreate')}}">
                <i class="ni ni-fat-add"></i>
                <span>New Tutoring</span>
              </a>  
            </div>
        </div>
        <div class="row justify-content-center">
            {{-- card --}}
            @foreach ($tutoring as $tutoring)      
                <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                    <div class="card text-black">
                        @if($tutoring->banner == null)
                            <a href="tutoringDetail/{{$tutoring->id}}"><img src="{{asset('assets')}}/img/noimage.png" class="card-img-top" alt="" /></a>
                        @else
                            <a href="tutoringDetail/{{$tutoring->id}}"><img src="{{asset('assets')}}/img/{{$tutoring->banner}}" class="card-img-top" alt="" /></a>
                        @endif
                        <div class="card-body">
                            <div class="text-left">
                                <h4 class="">{{$tutoring->title}}</h4>
                                <p class="text-muted mb-2 text-sm">{{$tutoring->subject_name}}</p>
                            </div>
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
                            <div class="d-flex justify-content-end  total font-weight-bold mt-4">
                                <a href="tutoringDetail/{{$tutoring->id}}" class="d-flex  align-items-center justify-content-end">
                                    <span>{{__('Details')}}</span><i class="ni ni-bold-right"></i>      
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        {{-- end card --}}
        </div>
        
      </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#close-button').click(function() {
            $('#status-messages').hide();
        });
    });
</script>
<style>
    .card-img-top{
        width: 250px;
        height: 250px;
    }
    .card-body{
        height: 350px;
    }
</style>