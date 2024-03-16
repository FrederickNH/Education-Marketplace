@extends('layouts.ekka')

@section('content')   
<section class="ec-page-content section-space-p">
    <div class="container-fluid">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <!-- Shop Top Start -->
                <form action="{{ url('catalog/competitionList') }}" method="GET">
                    <div class="ec-pro-list-top d-flex">
                        <span>Filter :</span>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-subject" id="filter-subject">
                                    <option value="" disabled selected>Filter Subject</option>
                                    @forEach($subjectList as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-mode" id="filter-mode">
                                    <option value="" disabled selected>Filter Mode</option>
                                    <option value="Group">Group</option>
                                    <option value="Private">Private</option>
                                </select>
                            </div>
                        </div>
                        <div class="ec-sort-select">
                            <div class="ec-select-inner">
                                <select name="filter-rep" id="filter-rep">
                                    <option value="" disabled selected>Filter Repetition</option>
                                    <option value="non">One Time</option>
                                    <option value="rep">Repetitive</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="text-left">
                            <span class="sort-by">Age :</span>
                            <input type="number" class="sort__input" name="filter-age" id="filter-age" width="200px" >
                        </div>
                        <div>
                            <button type="submit" class="btn-md btn-primary">Apply Filters</button>
                            <a href="{{ url('/catalog/tutoringList') }}" class="btn-md btn-secondary">Reset Filters</a>
                        </div>
                    </div>
                </form>
                <!-- Shop Top End -->

                <!-- Shop content Start -->
                <div class="shop-pro-content">
                    <div class="shop-pro-inner">
                        <div class="row">
                            @foreach($filteredCompetition as $competition)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <!-- START single card -->
                                    <div class="ec-product-tp">
                                        <div class="ec-product-image">
                                            <a href="../competitionDetailU/{{$competition->id}}">
                                                <img src="{{asset('assets')}}/img/{{$competition->brochure}}" class="img-center" alt="">
                                            </a>
                                        </div>
                                        <div class="ec-product-body card-tutor">
                                            <h3 class="ec-title"><a href="../competitionDetailU/{{$competition->id}}">{{$competition->title}}</a></h3>
                                            <div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>For age between {{$competition->min_age}} - {{$competition->max_age}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>{{$competition->allowed_team_member}} member max per team</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Regist end : {{\Carbon\Carbon::parse($competition->campaign_end )->format('j M Y')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2">
                                                    <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                    <span>Event start : {{\Carbon\Carbon::parse($competition->competition_start)->format('j M Y')}}</span>
                                                </div>
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
        width: 300px;
        height: 200px;
    }
    .card-tutor{
        height: 300px;
    }
</style>
{{-- <script>
    $(document).ready(function() {
        $('#ageFilter, #nameFilter, #locationFilter').on('input change', function() {
            var maxPrice = parseFloat($('#ageFilter').val()) || Infinity;
            var productName = $('#nameFilter').val().toLowerCase();
            var locationFilter = $('#locationFilter').val();

            $('#productList .card').each(function() {
            var $product = $(this);
            var price = parseFloat($product.data('price'));
            var name = $product.data('name').toLowerCase();
            var location = $product.data('location');

            var priceFilter = price <= maxPrice;
            var nameFilter = name.includes(productName);
            var locationFilter = locationFilter === 'all' || location === locationFilter;

            $product.toggle(priceFilter && nameFilter && locationFilter);
            });
        });
    });
</script> --}}