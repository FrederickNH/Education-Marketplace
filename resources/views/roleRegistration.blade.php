@extends('layouts.app',['class' => 'bg-default'])

@section('content')    

<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">      
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                <a class="card text-black" href="{{ route('tutorRegistration') }}">
                    <img src="{{asset('assets')}}/img/defaultimg/tutors.png" class="card-img-top" alt="" />
                </a>
            </div>
            <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                <a class="card text-black" href="{{ route('organiserRegistration') }}">
                    <img src="{{asset('assets')}}/img/defaultimg/competition organiser.png" class="card-img-top" alt="" />
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                <a class="card text-black" href="{{ route('schoolRegistration') }}">
                    <img src="{{asset('assets')}}/img/defaultimg/school.png" class="card-img-top" alt="" />
                </a>
            </div>
            <div class="col-md-12 col-lg-4 mb-8 mb-lg-3">
                <a class="card text-black" href="{{ route('shuttleRegistration') }}">
                    <img src="{{asset('assets')}}/img/defaultimg/school shuttle.png" class="card-img-top" alt="" />
                </a>
            </div>
        </div>
        
      </div>
</div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>