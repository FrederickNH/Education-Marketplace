@extends('layouts.app',['class' => 'bg-default'])

@section('content')    

<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container mt-1 pb-3">
        @if (session('status'))
                <div class="row alert alert-warning" id="status-messages">
                    <span id="status-text">{{ session('status') }}</span>
                    <button class="status-close-button" id="close-button">&times;</button>
                </div>
            @endif
            @php
            $sessionData = session('data');
        @endphp
        <form method="post" action="{{ route('schoolUpdate') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')
            @foreach($school as $s)
                <div class="row justify-content-center">       
                    <div class="col-xl-10 order-xl-1">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('School Data') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <a class="btn btn-primary text-white" id="set-edit" onclick="setEdit()">{{__('Edit')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            
                                <h6 class="heading-small text-muted mb-4">{{ __('School Detail') }}</h6>
                                <div class="pl-lg-2">
                                    {{-- not editable --}}
                                    <div class="form-group{{ $errors->has('input-school-name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-school-name">{{ __('School Name') }}</label>
                                        <input type="text" name="input-school-name" id="input-school-name" class="form-control form-control-alternative{{ $errors->has('input-school-name') ? ' is-invalid' : '' }}" value="{{$s->school_name}}"   placeholder="{{ __('School Name') }}" readonly required autofocus>

                                        @if ($errors->has('input-school-name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-school-name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-address') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-address">{{ __('School Address') }}</label>
                                        <input type="text" name="input-address" id="location-input" class=" col form-control form-control-alternative{{ $errors->has('input-address') ? ' is-invalid' : '' }}" value="{{ $s->address }}"   placeholder="{{ __('School Address') }}" readonly required autofocus>
                                        <button type="button" class=" col btn btn-primary" data-toggle="modal" data-target="#imageModal" id="btnShowMap">
                                            {{__('View Map')}}
                                        </button>
                                        @if ($errors->has('input-address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-school-city') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-school-city">{{ __('City') }}</label>
                                        <input type="text" name="input-school-city" id="input-school-city" class=" col form-control form-control-alternative{{ $errors->has('input-school-city') ? ' is-invalid' : '' }}" value="{{ $s->CityName }}"   placeholder="{{ __('School City') }}" readonly required autofocus>
                                    </div>
                                    <div class="form-group{{ $errors->has('input-school-subDistrict') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-school-subDistrict">{{ __('Sub District') }}</label>
                                        <input type="text" name="input-school-subDistrict" id="input-school-subDistrict" class=" col form-control form-control-alternative{{ $errors->has('input-school-subDistrict') ? ' is-invalid' : '' }}" value="{{ $s->SubdistrictName }}"   placeholder="{{ __('School Subdistrict') }}" readonly required autofocus>                                    
                                    </div>
                                    {{-- end not editable --}}
                                    {{-- editable --}}
                                    <div><img id="input-picture-preview" src="{{asset('assets')}}/img/{{$s->picture}}" alt="" class="banner-img"></div>
                                    <div class="form-group{{ $errors->has('edit-picture') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-picture">{{ __('School Picture') }}</label>
                                        <input type="file" name="input-picture" id="input-picture" class="form-control form-control-alternative{{ $errors->has('input-picture') ? ' is-invalid' : '' }} editable" placeholder="{{ __('School Picture') }}">
                
                                        @if ($errors->has('input-picture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-vision') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-vision">{{ __('Vision') }}</label>
                                        <input type="text" name="input-vision" id="input-vision" class="form-control form-control-alternative{{ $errors->has('input-vision') ? ' is-invalid' : '' }} editable" value="{{$s->vision}}"   placeholder="{{ __('Vision') }}" required autofocus>

                                        @if ($errors->has('input-vision'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-vision') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-mission') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-mission">{{ __('Mission') }}</label>
                                        <input type="text" name="input-mission" id="input-mission" class="form-control form-control-alternative{{ $errors->has('input-mission') ? ' is-invalid' : '' }} editable" value="{{ $s->mission}}"   placeholder="{{ __('Mission') }}" required autofocus>

                                        @if ($errors->has('input-mission'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-mission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-phone') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                        <input type="tel" name="input-phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('input-phone') ? ' is-invalid' : '' }} editable" value="{{ $s->phone}}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789" maxlength="12" required autofocus>
    
                                        @if ($errors->has('input-phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-website') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-website">{{ __('Website') }}</label>
                                        <input type="text" name="input-website" id="input-website" class="form-control form-control-alternative{{  $errors->has('input-phone') ? ' is-invalid' : ''}} editable" value="{{$s->website}}" pattern="www\..+" placeholder="https://www.example.com" autofocus>
    
                                        @if ($errors->has('input-website'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-level') ? ' has-danger' : '' }} pl-2">
                                        <label class="form-control-label" for="input-level">{{ __('Level') }}</label>
                                        <select name="input-level" id="input-level" class="form-control form-control-alternative{{ $errors->has('input-level') ? ' is-invalid' : '' }} disable" required>
                                            <option value=''>--Select Level--</option>
                                            <option value="SD"  {{$s->level != null ? ($s->level == 'SD' ? 'selected' : '' ) : '' }}>{{__('Elementary School')}}</option>
                                            <option value="SMP"  {{$s->level != null ? ($s->level == 'SMP' ? 'selected' : '' ) : '' }}>{{__('Junior High School')}}</option>
                                            <option value="SMA"  {{$s->level != null ? ($s->level == 'SMA' ? 'selected' : '' ) : '' }}>{{__('Senior High School')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('input-accreditation') ? ' has-danger' : '' }} pl-2">
                                        <label class="form-control-label" for="input-accreditation">{{ __('Accreditation') }}</label>
                                        <select name="input-accreditation" id="input-accreditation" class="form-control form-control-alternative{{ $errors->has('input-accreditation') ? ' is-invalid' : '' }} disable" required>
                                            <option value=''>--Select Level--</option>
                                            <option value="A"  {{$s->accreditation != null ? ($s->accreditation == 'A' ? 'selected' : '' ) : '' }}>{{__('A')}}</option>
                                            <option value="B"  {{$s->accreditation != null ? ($s->accreditation == 'B' ? 'selected' : '' ) : '' }}>{{__('B')}}</option>
                                            <option value="C"  {{$s->accreditation != null ? ($s->accreditation == 'C' ? 'selected' : '' ) : '' }}>{{__('C')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('input-accreditation-certificate') ? ' has-danger' : '' }}" id="accreditation-edit">
                                        <label class="form-control-label" for="input-accreditation-certificate">{{ __('Accreditation Certificate') }}</label>
                                        <input type="file" name="input-accreditation-certificate" id="input-accreditation-certificate" class="form-control form-control-alternative{{ $errors->has('input-accreditation-certificate') ? ' is-invalid' : '' }} editable" placeholder="{{ __('Accreditaiton Certificate') }}">

                                        @if ($errors->has('input-accreditation-certificate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-accreditation-certificate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="row pl-2">
                                        <div class="col">
                                            <div class="form-group{{ $errors->has('input-enrollment-start') ? ' has-danger' : '' }}">
                                                <label class="form-control-label " for="input-enrollment-start">{{ __('Enrollment Start Date') }}</label>
                                                <input type="date" name="input-enrollment-start" id="input-enrollment-start" class="form-control form-control-alternative{{ $errors->has('input-enrollment-start') ? ' is-invalid' : '' }} editable" value="{{ $s->enrollment_start }}" placeholder="{{ __('Enrollment Start Date') }}" required>
            
                                                @if ($errors->has('input-enrollment-start'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('input-enrollment-start') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group{{ $errors->has('input-enrollment-end') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-enrollment-end">{{ __('Enrollment End Date') }}</label>
                                                <input type="date" name="input-enrollment-end" id="input-enrollment-end" class="form-control form-control-alternative{{ $errors->has('input-enrollment-end') ? ' is-invalid' : '' }} editable" value="{{ $s->enrollment_end }}" placeholder="{{ __('Enrollment End Date') }}" min="{{ now()->toDateString() }}" required>        
                                                @if ($errors->has('input-enrollment-end'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('input-enrollment-end') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            
                                <hr class="my-4" />
                            </div>
                        </div>
                    </div>    
                    <div class="col-xl-10 order-xl-1">
                        <div class="text-center" id="submit-edit">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save School Data') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
        <div class="modal" id="imageModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">  
                  <h5 class="modal-title">School Location</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="card-container">    
                        <div class="map" id="gmp-map"></div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
    .card-container {
        display: flex;
        height: 500px;
        width: 1000px;
    }
    .button-cta {
        height: 40px;
        width: 40%;
        background: #3367d6;
        color: white;
        font-size: 15px;
        text-transform: uppercase;
        font-family: Roboto, sans-serif;
        border: 0;
        border-radius: 3px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.48);
        cursor: pointer;
    }
    .panel {
        background: white;
        width: 300px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .half-input-container {
        display: flex;
        justify-content: space-between;
    }

    .half-input {
        max-width: 120px;
    }

    .map {
        width: 450px;
    }
    .sb-title {
        position: relative;
        top: -12px;
        font-family: Roboto, sans-serif;
        font-weight: 500;
    }

    .sb-title-icon {
        position: relative;
        top: -5px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Replace YOUR_API_KEY with your actual Google API key -->
<script>
    var edit = true;
    
    $(document).ready(function() {
        var button = document.getElementById('btnShowMap');
        button.style.display = 'none';
        var mySessionData = @json($sessionData);
        setEdit();
        console.log('Session Data:', mySessionData);
    });
    function setEdit(){
        if(edit == false){
            var editable = document.querySelectorAll('.editable');
            editable.forEach(function(element) {
                element.readOnly = false;
            });
            var disable = document.querySelectorAll('.disable');
            disable.forEach(function(element) {
                element.disabled = false;
            });
            var certif = document.getElementById("accreditation-edit")
            certif.style.display = 'block';
            var pic = document.getElementById("input-picture")
            pic.style.display = 'block';
            var submit = document.getElementById("submit-edit")
            submit.style.display = 'block';
            var set = document.getElementById("set-edit")
            set.style.display = 'none';
            edit = true;
        }else{
            var editable = document.querySelectorAll('.editable');
            editable.forEach(function(element) {
                element.readOnly = true;
            });
            var disable = document.querySelectorAll('.disable');
            disable.forEach(function(element) {
                element.disabled = true;
            });
            var certif = document.getElementById("accreditation-edit")
            certif.style.display = 'none';
            var pic = document.getElementById("input-picture")
            pic.style.display = 'none';
            var submit = document.getElementById("submit-edit")
            submit.style.display = 'none';
            var set = document.getElementById("set-edit")
            set.style.display = 'block';
            edit = false;
        }
        
    }
</script>
<style>
    .dropdownTutor {
        width: 200px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .dropdown-headerTutor {
        cursor: pointer;
    }

    .dropdown-contentTutor {
        display: none;
        padding: 10px;
        background-color: #c35c5c;
    }
    .banner-img{
        width: 20rem;
        height: 200px;
    }
</style>