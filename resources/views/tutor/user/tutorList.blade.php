@extends('layouts.ekka')

@section('content')  
<section class="section ec-category-section ec-category-wrapper-4 section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Classic</h2>
                    <h2 class="ec-title">Tutor List</h2>
                    <p class="sub-title">Browse The List of Top Tutor</p>
                </div>
            </div>
        </div>
        <div class="row cat-space-3 cat-auto margin-minus-tb-10">
            @foreach($tList as $tutor)
                <div class="col-lg-2 col-md-4 col-sm-12">
                    <a href="tutorDetail/{{$tutor->id}}"></a>
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
                            <h5 class="">Teaches {{$tutor->SubjectName}} <br> and <br>{{$tutor->SubjectCount}} other</h5>
                            <a class="btn-primary" href="tutorDetail/{{$tutor->id}}">See Detail</a>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
            
        </div>
    </div>
</section>
@endsection
<style>
    .img-center{
        width: 100%;
        height: auto; 
        display: block; 
    }
    .card-tutor{
        height: 360px;
    }
    .card-img{
        height: 175px;
        width: 175px;
    }
    
</style>