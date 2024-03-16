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
              <a class="edit-btn btn btn-white text-primary d-flex justify-content-start align-items-center" href="{{route('competitionCreate')}}">
                <i class="ni ni-fat-add"></i>
                <span>New Competition</span>
              </a>  
            </div>
        </div>
        <div class="row justify-content-center">
            {{-- card --}}
            @foreach ($competitionList as $competition)      
                <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                    <div class="card text-black">
                        @if($competition->brochure == null)
                            <a href="competitionDetail/{{$competition->id}}"><img src="{{asset('assets')}}/img/noimage.png" class="card-img-top" alt="" /></a>
                        @else
                            <a href="competitionDetail/{{$competition->id}}"><img src="{{asset('assets')}}/img/{{$competition->brochure}}" class="card-img-top" alt="" /></a>
                        @endif
                        <div class="card-body">
                            <div class="text-left">
                                <h4 class="">{{$competition->title}}</h4>
                            </div>
                            <div>
                                <div class="d-flex justify-content-start align-items-center mb-2">
                                    <i class="ni ni-time-alarm text-primary"> Campaign lenght :</i>
                                </div>
                                <div class=" d-flex ml-3">
                                    <span>{{\Carbon\Carbon::parse($competition->campaign_start)->format('j M Y')}} - {{\Carbon\Carbon::parse($competition->campaign_end)->format('j M Y')}}</span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-start align-items-center mb-2">
                                    <i class="ni ni-time-alarm text-primary"> Competition schedule :</i>
                                </div>
                                <div class="d-flex ml-3">
                                    <span>{{\Carbon\Carbon::parse($competition->competition_start)->format('j M Y')}} - {{\Carbon\Carbon::parse($competition->competition_end)->format('j M Y')}}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end  total font-weight-bold mt-4">
                                <a href="competitionDetail/{{$competition->id}}" class="d-flex  align-items-center justify-content-end">
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
        width: 300px;
        height: 250px;
    }
    .card-body{
        height: 250px;
        width: 300px;
    }
</style>