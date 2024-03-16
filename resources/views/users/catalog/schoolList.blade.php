@extends('layouts.ekka')

@section('content')   
<section class="ec-page-content section-space-p">
    <div class="container-fluid">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <!-- Shop Top Start -->
                <form action="{{ url('/catalog/schoolList') }}" method="GET">
                    <div class="ec-pro-list-top d-flex">
                        <span>Filter :</span>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-accreditation" id="filter-accreditation">
                                    <option value="" disabled selected>Filter Accreditation</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-level" id="filter-level">
                                    <option value="" disabled selected>Filter Level</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-city" id="filter-city">
                                    <option value="" disabled selected>Filter City</option>
                                    @foreach($cityList as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn-md btn-primary">Apply Filters</button>
                            <a href="{{ url('/catalog/schoolList') }}" class="btn-md btn-secondary">Reset Filters</a>
                        </div>
                    </div>
                </form>
                <!-- Shop Top End -->

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @foreach($schoolList as $school)
                                <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                                    <!-- START single card -->
                                    <div class="ec-product-tp">
                                        <div class="ec-product-image">
                                            @if($school->picture != null)
                                            <a href="../schoolDetail/{{$school->id}}">
                                                <img src="{{asset('assets')}}/img/{{$school->picture}}" class="img-center" alt="">
                                            </a>
                                            @else
                                            <a href="../schoolDetail/{{$school->id}}">
                                                <img src="{{asset('assets')}}/img/defaultUser.jpeg" class="img-center" alt="">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="ec-product-body card-school">
                                            <div class="mt-5">
                                                a
                                                <br>
                                                <br>
                                                <br>
                                                <h6>{{$school->school_name}}</h6>
                                                <h6>{{$school->cityName}}</h6>
                                                <h6>Level : <span>{{$school->level}}</span></h6>
                                                <h6>Accreditation : <span>{{$school->accreditation}}</span></h6>
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
    .card-school{
        height: 275px;
    }
</style>