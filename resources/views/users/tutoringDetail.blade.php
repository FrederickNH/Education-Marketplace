@extends('layouts.ekka')
@section('content')   

<div class="product_page">
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">
                    
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img single-pro-img-no-sidebar col-lg-6 col-md-6">
                                    <div style="border: 1px solid black">
                                        <div class="">
                                            @if($tutoring->banner == null)
                                                <img class="img-card" src="{{asset('assets')}}/img/noimage.png"
                                                    alt="">
                                            @else
                                                <img class="img-card" src="{{asset('assets')}}/img/{{$tutoring->banner}}"
                                                    alt="">
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar col-lg-6 col-md-6">
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title" id="tutoring-id" data-value="{{ $tutoring->id }}" >{{$tutoring->title}}</h5>
                                        <div class="ec-single-desc">
                                            <a href="../../tutorDetail/{{$tutoring->tutor_id}}">
                                                <p><img class="profile-pic" src="{{asset('assets')}}/img/{{$tutor->institution != 0 ? $tutor->institution_picture : $tutor->picture}}" alt="">&nbsp;{{$tutor->institution != 0 ? $tutor->institution_name : $tutor->name}}</p>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="ec-single-sales">
                                            <div class="ec-single-sales-inner">
                                                <div class="ec-single-sales-visitor">Tutoring Details :</div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>{{__('Start on')}} {{$tutoring->day[0]}}, &nbsp;{{\Carbon\Carbon::parse($tutoring->date[0])->format('j M Y')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                    <span>{{__('at')}} {{\Carbon\Carbon::parse($tutoring->start_time[0])->format('H:i A')}} - {{\Carbon\Carbon::parse($tutoring->end_time[0])->format('H:i A')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start mb-2 ml-5">
                                                    @if($tutoring->method['0'] == "Offline")
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>Tutoring is carried out {{$tutoring->method['0']}} at <span>{{$tutoring->location[0]}}</span></span>
                                                    </div>
                                                    @elseif($tutoring->method == "Online")
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>Tutoring is carried out {{$tutoring->method[0]}}</span></span>
                                                    </div>
                                                    @elseif($tutoring->method == "HomeService")
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>Tutoring is carried out at customer home</span></span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                                    @if($tutoring->repetitive_duration > 1)
                                                        <span> {{$tutoring->repetitive_duration}}x&nbsp; {{__('meeting session')}}</span>
                                                    @else
                                                        <span> 1x {{__('meeting session per week')}}</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-between mb-2 ml-5">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                        @if($tutoring->group_size <= 1 || $tutoring->group_size == null)
                                                            <span>{{__('Done in Private')}}</span>
                                                        @else
                                                            <span> {{__('Done in Group of')}} {{$tutoring->group_size}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2 ml-5">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-money-coins text-primary"> &nbsp;&nbsp;</i>                            
                                                        <span>Rp.{{number_format($tutoring->final_price / 1, 2, '.', ',')}}</span>
                                                    </div>
                                                </div>  
                                                <div class="text-center">
                                                    @if($tutor->institution != null || $tutor->institution == 1)
                                                        <a href="../../chatify/institution-{{$tutor->user_id}}" class="btn btn-primary">Contact Institution</a>
                                                    @else
                                                        <a href="../../chatify/tutor-{{$tutor->user_id}}" class="btn btn-primary">Contact Tutor</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <section class="ec-page-content section-space-p">
                        <div class="container">
                            <div class="row">
                                <div class="ec-tab-wrapper ec-tab-wrapper-1">
                                    <div class="ec-single-pro-tab-wrapper">
                                        <div class="ec-vendor-card-body">
                                            <h3>Class Info</h3> 
                                            <div class="ec-vendor-card-table">
                                                <table class="table ec-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Time</th>
                                                            <th scope="col">Method</th>
                                                            <th scope="col">Location</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for($i = 0;$i < count($tutoring->date);$i++)
                                                            <tr>
                                                                <td scope="row"><span>{{$tutoring->day[$i]}}, &nbsp;{{\Carbon\Carbon::parse($tutoring->date[$i  ])->format('j M Y')}}</span></td>
                                                                <td scope="row"><span>{{\Carbon\Carbon::parse($tutoring->start_time[$i])->format('H:i A')}} - {{\Carbon\Carbon::parse($tutoring->end_time[$i])->format('H:i A')}}</span></td>
                                                                <td scope="row"><span>{{$tutoring->method[$i]}}</span></td>
                                                                @if($tutoring->method[$i] != "Online")
                                                                    <td scope="row"><span>{{$tutoring->location[$i]}}</span></td>
                                                                @else
                                                                    <td scope="row"><span><a href="https://{{$tutoring->location[$i]}}">{{$tutoring->location[$i]}}</a></span></td>
                                                                @endif
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </section>  
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Accreditation Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="dataList"></ul>
            </div>
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
            $('.btn-certificate').click(function () {
                // Make an Ajax request to fetch data
                var itemId = $(this).data('item-id');
                var dataList = $('#dataList');
                dataList.empty();

                dataList.append("<img src='{{asset('assets')}}/img/" + itemId + "''>'");
                $('#dataModal').modal('show');
            });
            $('.clear-btn').click(function () {
                var itemId = $(this).data('item-id');
                // Fetch item data from the server using AJAX
                $.ajax({
                    url: '/scheduleClear/' + itemId, // Replace with your route to fetch item data
                    type: 'GET',
                    success: function (data) {
                        location.reload();
                    }
                });
            });
        });
</script>
<style>
    .img-card{
        width: 800px;
        /* border: 1px solid grey;
        border-radius: 5px; */
    }
    .profile-pic {
        width: 30px; /* Set the width of the container */
        height: 30px; /* Set the height of the container */
        overflow: hidden; /* Hide any overflow */
        border-radius: 50%; /* Create a circular shape */
    }

    .profile-pic img {
        width: 100%; /* Make the image fill the container */
        height: auto; /* Maintain the image's aspect ratio */
        display: block; /* Remove extra space below the image */
        border-radius: 50%; /* Ensure the image is also circular */
    }
</style>