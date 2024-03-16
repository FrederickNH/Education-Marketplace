{{-- @extends('layouts.app',['class' => 'bg-default'])

@section('content')    

    <div class="header bg-gradient-primary py-8 py-lg-8">
        <div class="container py-5">             
            <div class="card card-profile shadow">
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">
                        <div class="col">
                            @foreach($tutoring as $t)
                                <img src="{{ asset('assets') }}/img/{{$t->banner}}" class="banner-img">
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        <ul class="nav nav-tabs" id="tutoringTab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#detail-tutoring" type="button" role="tab" aria-controls="home" aria-selected="true">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#detail-schedule" type="button" role="tab" aria-controls="profile" aria-selected="false">Schedule</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#detail-member" type="button" role="tab" aria-controls="contact" aria-selected="false">Member</button>
                            </li>
                        </ul>
                        <div class="tutoring-tab-content" id="tutoringTabContent">                            
                            <div id="detail-tutoring" class="tab-pane fade show active">
                                @foreach($tutoring as $item)

                                <div class="single-pro-content">
                                <div class="ec-single-sales">
                                    <div class="ec-single-sales-inner">
                                        <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                            <i class="ni ni-align-center text-primary"> &nbsp;&nbsp;</i>
                                            <span>{{$item->description}}</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                            <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                            <span>{{__('Start on')}} {{$item->day}}, &nbsp;{{\Carbon\Carbon::parse($item->date)->format('j M Y')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                            <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                            <span>{{__('at')}} {{\Carbon\Carbon::parse($item->start_time)->format('H:i A')}} - {{\Carbon\Carbon::parse($item->end_time )->format('H:i A')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-start mb-2 ml-5">
                                            @if($item->method == "Offline")
                                            <div class="d-flex justify-content-start align-items-center">
                                                <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                <span>Tutoring is carried out {{$item->method}} at <span>{{$item->location}}</span></span>
                                            </div>
                                            @elseif($item->method == "Online")
                                            <div class="d-flex justify-content-start align-items-center">
                                                <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                <span>Tutoring is carried out {{$item->method}} using <span>{{$item->location}}</span></span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                            <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                            @if($item->repetitive_duration > 1)
                                                <span> {{$item->repetitive_duration}}x&nbsp; {{__('meeting session per week')}}</span>
                                            @else
                                                <span> 1x {{__('meeting session per week')}}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between mb-2 ml-5">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                @if($item->group_size <= 1 || $item->group_size == null)
                                                    <span>{{__('Done in Private')}}</span>
                                                @else
                                                    <span> {{__('Done in Group of')}} {{$item->group_size}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                            <i class="ni ni-money-coins text-primary"> &nbsp;&nbsp;</i>
                                            <span>{{$item->price}}</span>
                                        </div>
                                    </div>
                                </div>    
                                </div>
                                @endforeach
                            </div>
                            <div id="detail-schedule" class="tab-pane fade order-1">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                          <thead class="thead-light">
                                            <tr>
                                              <th scope="col" class="sort" data-sort="day">Date</th>
                                              <th scope="col" class="sort" data-sort="startTime">Start Time</th>
                                              <th scope="col" class="sort" data-sort="endTime">End Time</th>
                                              <th scope="col" class="sort" data-sort="brerakTime">Location</th>
                                              <th scope="col"></th>
                                            </tr>
                                          </thead>
                                          <tbody class="list">
                                            @foreach($listRepetitive as $rep)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$rep->day}}, &nbsp;{{\Carbon\Carbon::parse($rep->date)->format('j M Y')}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{\Carbon\Carbon::parse($rep->start_time)->format('H:i A')}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{\Carbon\Carbon::parse($rep->end_time)->format('H:i A')}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$rep->location}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal" onclick="getDataSchedule('{{$rep->id}}')">
                                                                {{__('Edit')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                </div>  
                            </div>
                            <div id="detail-member" class="tab-pane fade">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                          <thead class="thead-light">
                                            <tr>
                                              <th scope="col" class="sort" data-sort="day">Name</th>
                                              <th scope="col" class="sort" data-sort="startTime">Grade</th>
                                              <th scope="col" class="sort" data-sort="endTime">Phone</th>
                                              <th scope="col" class="sort" data-sort="brerakTime">Email</th>
                                              <th scope="col"></th>
                                            </tr>
                                          </thead>
                                          <tbody class="list">
                                            @foreach($listMember as $member)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$member->fname}}&nbsp;{{$member->lname}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$member->grade}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$member->phone}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$member->email}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>   
            
        </div>
    </div>
    

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script>
    $(document).ready(function () {       
        var myTab = new bootstrap.Tab(document.getElementById('tutoringTab'));
        // Show the tab content when a tab is clicked
        var tabItems = document.querySelectorAll('.nav-link');
        tabItems.forEach(function(item) {        
            item.addEventListener('click', function(event) {
                myTab.show();
                console.log(item);
                var target = item.getAttribute('data-bs-target');
                var activeTabContent = document.querySelector('.tab-pane.active');
                activeTabContent.classList.remove('active', 'show');
                document.querySelector(target).classList.add('active', 'show');
            });
        });
    });
    function getDataSchedule(id) {
        alert(id);
        // var path = "{{ asset('assets') }}" + '/img/' + imagePath;
        // $('#previewImage').attr('src', path);
    }
</script>
<style>
    .banner-img{
        width: 58.5rem;
        height: 300px;
    }
</style>
   --}}
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
        @if (session('warning'))
        <div class="row alert alert-danger" id="status-messages">
            <span id="status-text">{{ session('warning') }}</span>
            <button class="status-close-button" id="close-button">&times;</button>
        </div>
        @endif         
        <div class="card card-profile shadow">
            <div class="card-body pt-0 pt-md-4">
                <div class="row">
                    @foreach($tutoring as $s)
                        <div class="col-lg-5">
                                <img src="{{ asset('assets') }}/img/{{$s->banner}}" class="banner-img">
                        </div>
                        <div class="col-lg-6 ml-2">
                            <h3>Tutoring Detail :</h3>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-tutoring-subject') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tutoring-subject">{{ __('Subject') }}</label>
                                    <input type="text" name="input-tutoring-subject" id="input-tutoring-subject" class="form-control form-control-alternative{{ $errors->has('input-tutoring-subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Subject') }}" value="{{$s->SubjectName}}" readonly required>        
                                    @if ($errors->has('input-tutoring-subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-tutoring-subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-tutoring-grade') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tutoring-grade">{{ __('Grade') }}</label>
                                    <input type="number" name="input-tutoring-grade" id="input-tutoring-grade" class="form-control form-control-alternative{{ $errors->has('input-tutoring-grade') ? ' is-invalid' : '' }}" placeholder="{{ __('Grade') }}" value="{{$s->grade}}" readonly required>        
                                    @if ($errors->has('input-tutoring-grade'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-tutoring-grade') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-tutoring-description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tutoring-description">{{ __('Description') }}</label>
                                    <textarea name="input-tutoring-description" id="input-tutoring-description" class="form-control form-control-alternative{{ $errors->has('input-tutoring-description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="" readonly required>{{$s->description}}</textarea>        
                                    @if ($errors->has('input-tutoring-description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-tutoring-description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-tutoring-session') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tutoring-session">{{ __('Session') }}</label>
                                    <input type="text" name="input-tutoring-session" id="input-tutoring-session" class="form-control form-control-alternative{{ $errors->has('input-tutoring-session') ? ' is-invalid' : '' }}" placeholder="{{ __('Session') }}" value="{{($s->repetitive_duration > 1 ? $s->repetitive_duration : 1)}}" readonly required>        
                                    @if ($errors->has('input-tutoring-session'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-tutoring-session') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                    @if(count($listRepetitive) > 1)
                        <div id="table-repetitive">
                            <h2>Schedule List</h2>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="day">Date</th>
                                        <th scope="col" class="sort" data-sort="startTime">Time</th>
                                        <th scope="col" class="sort" data-sort="endTime">Method</th>
                                        <th scope="col" class="sort" data-sort="brerakTime">Location</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach($listRepetitive as $sep)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$sep->day}}, &nbsp;{{\Carbon\Carbon::parse($sep->date)->format('j M Y')}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{\Carbon\Carbon::parse($sep->start_time)->format('H:i A')}} - {{\Carbon\Carbon::parse($sep->end_time)->format('H:i A')}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$sep->method}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$sep->location}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <button type="button"class="btn btn-primary btn-edit" data-toggle="modal" data-target="#imageModal" data-item-id="{{$sep->id}}">
                                                                {{__('Edit')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                                </div>
                        </div>  
                    @endif
                    <div>
                        <h2>Student List</h2>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="day">Name</th>
                                    <th scope="col" class="sort" data-sort="startTime">Grade</th>
                                    <th scope="col" class="sort" data-sort="endTime">Phone</th>
                                    <th scope="col" class="sort" data-sort="brerakTime">Email</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @if(count($listMember) > 0 )
                                    @foreach($listMember as $member)
                                    <tr>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{$member->fname}}&nbsp;{{$member->lname}}</span>
                                            </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{$member->grade}}</span>
                                            </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{$member->phone}}</span>
                                            </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{$member->email}}</span>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Student Data</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Update Class Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST" action="{{ route('saveDetailChange') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="input-id" name="id">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                        <input type="date" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"  placeholder="{{ __('Date') }}" required autofocus>

                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row pl-2">
                        <div class="col">
                            <div class="form-group{{ $errors->has('start_time') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-start-time">{{ __('Tutoring Start Time') }}</label>
                                <input type="time" name="start_time" id="input-start-time" class="form-control form-control-alternative{{ $errors->has('start_time') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" required>

                                @if ($errors->has('start_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('end_time') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-end-time">{{ __('Tutoring End Time') }}</label>
                                <input type="time" name="end_time" id="input-end-time" class="form-control form-control-alternative{{ $errors->has('end_time') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" required>

                                @if ($errors->has('end_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row pl-2">
                        <div class="col">
                            <div class="form-group{{ $errors->has('method') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-method">{{ __('Method') }}</label>
                                <select name="method" id="input-method" class="form-control form-control-alternative{{ $errors->has('method') ? ' is-invalid' : '' }}" onchange="methodChanged(this)" required>
                                    <option value=''>--Select Method--</option>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offfline</option>
                                    <option value="HomeService">Home Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}" id="location-div">
                                <label class="form-control-label" for="input-   location" id="location-label">{{ __('Location') }}</label>
                                <input type="text" name="location" id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" value="{{ $sessionData['location'] ?? '' }}" placeholder="{{ __('Location') }}">

                                @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <button type="submit" >Update</button> --}}
                    <!-- Add more form fields for editing data as needed -->
                    <button type="submit" form="addForm" class="btn btn-primary">Save Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .banner-img{
        width: 450px;
        height: 450px;
    }
    #input-id{
        display: none;
    }
    .svg_img{
        width: 50px;

    }
</style>
<script>
    $(document).ready(function () {
            $('#close-button').click(function() {
                $('#status-messages').hide();
            });
            $('.btn-edit').click(function () {
                // Make an Ajax request to fetch data
                var itemId = $(this).data('item-id');
                $.ajax({
                    url: '/tutoringDetail/data/' + itemId, // Replace with your route to fetch item data
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        $('#input-id').val(data.id);
                        $('#input-date').attr("min", data.prev_date);
                        $('#input-date').attr("max", data.next_date);
                        $('#input-date').val(data.date);
                        $('#input-start-time').val(data.start_time);
                        $('#input-end-time').val(data.end_time);
                        $('#input-method').val(data.method);
                        $('#input-location').val(data.location);
                        $('#dataModal').modal('show');
                    }
                });
                
            });
        });
</script>