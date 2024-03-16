@extends('layouts.ekka')

@section('content')    
<section class="ec-page-content section-space-p">
    <div class="container-fluid">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class=" shop-pro-content ">
                    <div class="shop-pro-inner">
                        <div class="container">
                            <div class="row">
                                @foreach($subjectList as $subject)
                                    <div class="col-lg-3 col-md-6 col-sm-8 col-xs-6 mb-6 ">
                                            <!-- START single card -->

                                            {{-- <div class="ec-product-ds" style="border: 1px solid black;border-radius: 2px;">
                                                <a class="" href="subjectTutoring/{{$subject->id}}">
                                                <img src="{{asset('assets')}}/img/defaultimg/Tutors.png" alt="">
                                                    {{$subject->name}}
                                                </a>
                                            </div> --}}
                                            <!--/END single card -->
                                            <div class="ec-product-tp">
                                                <div class="ec-product-image">
                                                    <a href="subjectTutoring/{{$subject->id}}">
                                                        <img src="assets/images/product-image/3.jpg" class="img-center" alt="">
                                                    </a>
                                                    
                                                </div>
                                                <div class="ec-product-body">
                                                    <h3 class="ec-title"><a href="subjectTutoring/{{$subject->id}}">{{$subject->name}}</a></h3>
                                                    
                                                </div>
                                            </div>
                                        
                                    </div>             
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
@endsection