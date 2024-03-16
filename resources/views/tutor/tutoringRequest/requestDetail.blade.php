@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">             
        <div class="card card-profile shadow">
            <div class="card-body pt-0 pt-md-4">
                <div class="row">
                    @foreach($request as $r)
                        <div class="col-lg-5">
                                <img src="{{ asset('assets') }}/img/{{$r->picture}}" class="banner-img">
                        </div>
                        <div class="col-lg-6 ml-2">
                                <h3>Request Detail :</h3>
                                <div class="col">
                                    <div class="form-group{{ $errors->has('input-request-subject') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-request-subject">{{ __('Subject') }}</label>
                                        <input type="text" name="input-request-subject" id="input-request-subject" class="form-control form-control-alternative{{ $errors->has('input-request-subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Subject') }}" value="{{$r->SubjectName}}" readonly required>        
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
                                        <input type="number" name="input-request-grade" id="input-request-grade" class="form-control form-control-alternative{{ $errors->has('input-request-grade') ? ' is-invalid' : '' }}" placeholder="{{ __('Grade') }}" value="{{$r->grade}}" readonly required>        
                                        @if ($errors->has('input-request-grade'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-request-grade') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group{{ $errors->has('input-request-description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-request-description">{{ __('Subject') }}</label>
                                        <textarea name="input-request-description" id="input-request-description" class="form-control form-control-alternative{{ $errors->has('input-request-description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="" readonly required>{{$r->description}}</textarea>        
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
                                        <input type="text" name="input-request-date" id="input-request-date" class="form-control form-control-alternative{{ $errors->has('input-request-date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{$r->day}}, &nbsp;{{\Carbon\Carbon::parse($r->date)->format('j M Y')}}" readonly required>        
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
                                                    <input type="text" name="input-request-time-start" id="input-request-time-start" class="form-control form-control-alternative{{ $errors->has('input-request-time-start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" value="{{\Carbon\Carbon::parse($r->start_time)->format('H:i')}}" readonly required>        
                                                    @if ($errors->has('input-request-time-start'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('input-request-time-start') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="input-request-time-end" id="input-request-time-end" class="form-control form-control-alternative{{ $errors->has('input-request-time-end') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" value="{{\Carbon\Carbon::parse($r->end_time )->format('H:i')}}" readonly required>        
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
                                        <input type="text" name="input-request-method" id="input-request-method" class="form-control form-control-alternative{{ $errors->has('input-request-method') ? ' is-invalid' : '' }}" placeholder="{{ __('Method') }}" value="{{$r->method}}" readonly required>        
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
                                        <input type="text" name="input-request-location" id="input-request-location" class="form-control form-control-alternative{{ $errors->has('input-request-location') ? ' is-invalid' : '' }}" placeholder="{{ __('Location') }}" value="{{$r->location}}" readonly required>        
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
                                        <input type="text" name="input-request-session" id="input-request-session" class="form-control form-control-alternative{{ $errors->has('input-request-session') ? ' is-invalid' : '' }}" placeholder="{{ __('Session') }}" value="{{($r->repetitive_duration > 1 ? $r->repetitive_duration : 1)}}" readonly required>        
                                        @if ($errors->has('input-request-session'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-request-session') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($r->status == "Waiting")
                                    <a href="/requestAccepted/{{$r->id}}">
                                        <img src="{{ asset('ekka') }}/images/icons/checked.png" class="svg_img" alt="" />
                                    </a>
                                    <a href="/requestDeclined/{{$r->id}}" class="ec-header-btn">
                                        <img src="{{ asset('ekka') }}/images/icons/multiply.png"
                                                class="svg_img" alt="" />
                                    </a>
                                @elseif($r->status == "Rejected")
                                <div class="col">
                                    <div class="form-group{{ $errors->has('input-request-status') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-request-status">{{ __('Status') }}</label>
                                        <input type="text" name="input-request-status" id="input-request-status" class="form-control form-control-alternative{{ $errors->has('input-request-status') ? ' is-invalid' : '' }}" placeholder="{{ __('Status') }}" value="Request Rejected" readonly required>        
                                        @if ($errors->has('input-request-status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-request-status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @elseif($r->status == "Accepted")
                                <div class="col">
                                    <div class="form-group{{ $errors->has('input-request-status') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-request-status">{{ __('Status') }}</label>
                                        <input type="text" name="input-request-status" id="input-request-status" class="form-control form-control-alternative{{ $errors->has('input-request-status') ? ' is-invalid' : '' }}" placeholder="{{ __('Status') }}" value="Request Accepted" readonly required>        
                                        @if ($errors->has('input-request-status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-request-status') }}</strong>
                                            </span>
                                        @endif
                                        <br>
                                        <a href="../tutoringDetail/{{$tutoringId->id}}" class="btn btn-primary">to tutoring detail</a>
                                    </div>
                                </div>
                                @elseif($r->status == "WaitingPayment")
                                <div class="col">
                                    <div class="form-group{{ $errors->has('input-request-status') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-request-status">{{ __('Status') }}</label>
                                        <input type="text" name="input-request-status" id="input-request-status" class="form-control form-control-alternative{{ $errors->has('input-request-status') ? ' is-invalid' : '' }}" placeholder="{{ __('Status') }}" value="Waiting User Payment" readonly required>        
                                        @if ($errors->has('input-request-status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-request-status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                        </div>
                    @endforeach
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