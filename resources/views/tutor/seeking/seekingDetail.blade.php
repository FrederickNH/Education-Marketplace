@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">             
        <div class="card card-profile shadow">
            <div class="card-body pt-0 pt-md-4">
                <div class="row">
                    @foreach($seeking as $s)
                        <div class="col-lg-5">
                                <img src="{{ asset('assets') }}/img/{{$s->UserPicture}}" class="banner-img">
                        </div>
                        <div class="col-lg-6 ml-2">
                            <h3>Seeking Detail :</h3>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-subject') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-subject">{{ __('Subject') }}</label>
                                    <input type="text" name="input-request-subject" id="input-request-subject" class="form-control form-control-alternative{{ $errors->has('input-request-subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Subject') }}" value="{{$s->SubjectName}}" readonly required>        
                                    @if ($errors->has('input-request-subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-grade') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-grade">{{ __('Grade') }}</label>
                                    <input type="number" name="input-request-grade" id="input-request-grade" class="form-control form-control-alternative{{ $errors->has('input-request-grade') ? ' is-invalid' : '' }}" placeholder="{{ __('Grade') }}" value="{{$s->grade}}" readonly required>        
                                    @if ($errors->has('input-request-grade'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-grade') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-description">{{ __('Description') }}</label>
                                    <textarea name="input-request-description" id="input-request-description" class="form-control form-control-alternative{{ $errors->has('input-request-description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="" readonly required>{{$s->description}}</textarea>        
                                    @if ($errors->has('input-request-description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-date">{{ __('Date') }}</label>
                                    <input type="text" name="input-request-date" id="input-request-date" class="form-control form-control-alternative{{ $errors->has('input-request-date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{$s->day}}, &nbsp;{{\Carbon\Carbon::parse($s->date)->format('j M Y')}}" readonly required>        
                                    @if ($errors->has('input-request-date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row ml-1 mr-1">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('input-request-time-start') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-request-time-start">{{ __('Time') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="input-request-time-start" id="input-request-time-start" class="form-control form-control-alternative{{ $errors->has('input-request-time-start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" value="{{\Carbon\Carbon::parse($s->start_time)->format('H:i')}}" readonly required>        
                                                @if ($errors->has('input-request-time-start'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('input-request-time-start') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <input type="text" name="input-request-time-end" id="input-request-time-end" class="form-control form-control-alternative{{ $errors->has('input-request-time-end') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" value="{{\Carbon\Carbon::parse($s->end_time )->format('H:i')}}" readonly required>        
                                                @if ($errors->has('input-request-time-end'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('input-request-time-end') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-method') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-method">{{ __('Method') }}</label>
                                    <input type="text" name="input-request-method" id="input-request-method" class="form-control form-control-alternative{{ $errors->has('input-request-method') ? ' is-invalid' : '' }}" placeholder="{{ __('Method') }}" value="{{$s->method}}" readonly required>        
                                    @if ($errors->has('input-request-method'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-method') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-location">{{ __('Location') }}</label>
                                    <input type="text" name="input-request-location" id="input-request-location" class="form-control form-control-alternative{{ $errors->has('input-request-location') ? ' is-invalid' : '' }}" placeholder="{{ __('Location') }}" value="{{$s->location}}" readonly required>        
                                    @if ($errors->has('input-request-location'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-session') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-session">{{ __('Session') }}</label>
                                    <input type="text" name="input-request-session" id="input-request-session" class="form-control form-control-alternative{{ $errors->has('input-request-session') ? ' is-invalid' : '' }}" placeholder="{{ __('Session') }}" value="{{($s->repetitive_duration > 1 ? $s->repetitive_duration : 1)}}" readonly required>        
                                    @if ($errors->has('input-request-session'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-request-session') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row ml-1 mr-1">
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-request-time-start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-request-time-start">{{ __('Price') }}</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="input-request-time-start" id="input-request-time-start" class="form-control form-control-alternative{{ $errors->has('input-request-time-start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" value="Rp.{{number_format($s->min_price / 1, 2, '.', ',')}}" readonly required>        
                                            @if ($errors->has('input-request-time-start'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-request-time-start') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <input type="text" name="input-request-time-end" id="input-request-time-end" class="form-control form-control-alternative{{ $errors->has('input-request-time-end') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" value="Rp.{{number_format($s->max_price / 1, 2, '.', ',')}}" readonly required>        
                                            @if ($errors->has('input-request-time-end'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-request-time-end') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#offerModal">
                                <span>Make Offer</span>
                                </a>
                        </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="text-center">
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
                                                    <span class="name mb-0 text-sm">{{\Carbon\Carbon::parse($sep->start_time)->format('H:i A')}}</span>
                                                </div>
                                                </div>
                                            </td>
                                            <td scope="row">
                                                <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{\Carbon\Carbon::parse($sep->end_time)->format('H:i A')}}</span>
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
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal" onclick="getDataSchedule('{{$sep->id}}')">
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
                </div> --}}
            </div>
        </div>   
        <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="offerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="offerModalLabel">{{__('Make Offer')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="addForm" method="POST" action="{{ route('offerAdd') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group{{ $errors->has('input-offer') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-certificate-title">{{ __('Proposed Price') }}</label>
                                @foreach($seeking as $s)
                                <input type="text" name="input-id" id="input-id" value="{{$s->id}}">
                                <input type="number" name="input-offer" id="input-offer" class="form-control form-control-alternative{{ $errors->has('input-offfer') ? ' is-invalid' : '' }}"  placeholder="{{ __('Proposed Price') }}" value="{{$s->min_price}}" min="{{$s->min_price}}" max="{{$s->max_price}}" required autofocus>
                                @endforeach
                                @if ($errors->has('input-offer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-offer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="addForm" class="btn btn-primary">Save Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .banner-img{
        width: 400px;
        height: 400px;
    }
    #input-id{
        display: none;
    }
    .svg_img{
        width: 50px;

    }
</style>