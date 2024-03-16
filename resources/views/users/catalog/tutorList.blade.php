@extends('layouts.ekka')

@section('content')   
<section class="ec-page-content section-space-p">
    <div class="container-fluid">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <!-- Shop Top Start -->
                <div class="ec-pro-list-top d-flex">
                    <div class="col-md-6 ec-grid-list">
                        
                    </div>
                    <div class="col-md-6 ec-sort-select">
                        <span class="sort-by">Sort by</span>
                        <div class="ec-select-inner">
                            <select name="ec-select" id="ec-select">
                                <option selected disabled>Position</option>
                                <option value="1">Relevance</option>
                                <option value="2">Name, A to Z</option>
                                <option value="3">Name, Z to A</option>
                                <option value="4">Price, low to high</option>
                                <option value="5">Price, high to low</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Shop Top End -->

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @foreach($tutorList as $tutor)
                                <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                                    <!-- START single card -->
                                    <div class="ec-product-tp">
                                        <div class="ec-product-image">
                                            @if($tutor->picture != null)
                                            <a href="../tutorDetail/{{$tutor->id}}">
                                                <img src="{{asset('assets')}}/img/{{$tutor->picture}}" class="img-center" alt="">
                                            </a>
                                            @else
                                            <a href="../tutorDetail/{{$tutor->id}}">
                                                <img src="{{asset('assets')}}/img/noimage.png" class="img-center" alt="">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="ec-product-body card-tutor">
                                            <div class="mt-5">
                                                a
                                                <br>
                                                <br>
                                                <br>
                                                <h6 class="text-small">{{$tutor->fname}}&nbsp;{{$tutor->lname}}</h6>
                                                <h6 class="">Teaches {{$tutor->subjectName}} <br> and <br>{{$tutor->SubjectCount}} other</h6>
                                            </div>

                                        </div>
            
                                    </div>
                                    <!-- START single card -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Ec Pagination Start -->
                    <!-- Ec Pagination End -->
                </div>
                <!--Shop content End -->
            </div>
            <!-- Sidebar Area Start -->

        </div>
    </div>
</section>
@endsection
<style>
    .img-center{
        width: 150px;
        height: 150px;
        border: 1px solid lightgray;
    }
    .card-tutor{
        height: 275px;
    }
</style>