@extends('layouts.ekka')

@section('content')   
<section class="ec-page-content section-space-p">
    <div class="container-fluid">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <!-- Shop Top Start -->
                <form action="{{ url('/catalog/shuttleList') }}" method="GET">
                    <div class="ec-pro-list-top d-flex">
                        <span>Filter :</span>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-city" id="filter-city" onchange="getSubcategories()">
                                    <option value="" disabled selected>Filter City</option>
                                    @foreach($cityList as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-subdistrict" id="filter-subdistrict">
                                    <option value="" disabled selected>Filter Subdistrict</option>
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-school" id="filter-school" onchange="getSubcategories()">
                                    <option value="" disabled selected>Filter School</option>
                                    @foreach($schoolList as $school)
                                        <option value="{{$school->id}}">{{$school->school_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn-md btn-primary">Apply Filters</button>
                            <a href="{{ url('/catalog/shuttleList') }}" class="btn-md btn-secondary">Reset Filters</a>
                        </div>
                    </div>
                </form>
                <!-- Shop Top End -->

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @foreach($shuttleList as $shuttle)
                                <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                                    <!-- START single card -->
                                    <div class="ec-product-tp">
                                        <div class="ec-product-image">
                                            @if($shuttle->picture != null)
                                            <a href="../shuttleDetail/{{$shuttle->id}}">
                                                <img src="{{asset('assets')}}/img/{{$shuttle->picture}}" class="img-center" alt="">
                                            </a>
                                            @else
                                            <a href="../shuttleDetail/{{$shuttle->id}}">
                                                <img src="{{asset('assets')}}/img/defaultUser.jpeg" class="img-center" alt="">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="ec-product-body card-shuttle">
                                            <div class="mt-5">
                                                a
                                                <br>
                                                <br>
                                                <br>
                                                <h6>{{$shuttle->shuttle_name}}</h6>
                                                <h6>{{$shuttle->subdistrictName}},{{$shuttle->cityName}}</h6>
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
    .card-shuttle{
        height: 275px;
    }
</style>
<script>
    function getSubcategories() {
        var cityId = document.getElementById('filter-city').value;
        fetch('/getSubDistrict/' + cityId) // Replace with your route
            .then(response => response.json())
            .then(data => {
                let subDistrictSelect = document.getElementById('filter-subdistrict');
                subDistrictSelect.innerHTML = ''; // Clear existing options
                
                let option = document.createElement('option');
                    option.text = "Select Sub District"; // Replace with your subcategory name field
                    option.value = ""; // Replace with your subcategory ID field
                    subDistrictSelect.appendChild(option);

                data.forEach(subDistrict => {
                    let option = document.createElement('option');
                    option.text = subDistrict.name; // Replace with your subcategory name field
                    option.value = subDistrict.id; // Replace with your subcategory ID field
                    subDistrictSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
</script>