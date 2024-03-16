@extends('layouts.ekkaNoMenu')

@section('content')
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Register</h2>
                    <h2 class="ec-title">Register New Account</h2>
                    <p class="sub-title mb-3">{{__('Come join us with making a brand new account')}}</p>
                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <span class="ec-register-wrap ec-register-half">
                                <label>{{__('First name')}}</label>
                                <input type="text" name="fname" placeholder="{{__('Enter first name')}}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>{{__('Last name')}}</label>
                                <input type="text" name="lname" placeholder="{{__('Enter last name')}}" required />
                            </span>
                            <span class="ec-register-wrap">
                                <label>{{__('Birthdate')}}</label>
                                <input type="date" name="birthdate" placeholder="{{__('Enter birthdate')}}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>{{__('Email')}}</label>
                                <input type="email" name="email" placeholder="{{__('Enter email')}}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>{{__('Phone')}}(Optional)</label>
                                <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789" maxlength="12" />
                            </span>
                            <span class="ec-register-wrap">
                                <label for="password">{{__('Password')}}</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="{{__('Enter password')}}" />
                            </span>
                            <span class="ec-register-wrap">
                                <label for="password-confirm">{{__('Confirm Password')}}</label>
                                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('Re-password')}}" />
                            </span>
                            <div class="row mb-3 ec-register-wrap">
                                <div class="card-container center">
                                    <div class="panel center">
                                        <div>
                                            <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                                            <span class="sb-title">Address Selection</span>
                                        </div>
                                        <input type="text" name="address" placeholder="Address" id="location-input"/>
                                        <input type="text" placeholder="Apt, Suite, etc (optional)"/>
                                        <input type="hidden" placeholder="City" id="locality-input"/>
                                        <input type="text" name="input-subdistrict" class="" placeholder="Subdistrict" id="administrative_area_level_3-input" readonly/>
                                        <input type="text" name="input-city" class="" placeholder="City" id="administrative_area_level_2-input" readonly/>
                                        <input type="text" placeholder="Provience" id="administrative_area_level_1-input" readonly/>
                                    </div>
                                    <div class="map" id="gmp-map"></div>
                                </div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0m1BX8scehZGo9O3l3huGJNGzGVZeSjc&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cAB" async defer></script>
                            </div>  
                            <span class="ec-register-wrap">
                                <label>{{__('Profile Picture')}}</label>
                                <input type="file" name="picture" placeholder="{{__('Enter picture file')}}" />
                            </span> 
                            <div class="ec-register-wrap">
                                <label for="picture" class="text-md-end">{{ __('Register as') }}</label>  
                                <div class="row" style="display: flex; justify-content: center">
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center" style=" padding: 5px 0px 15px 0px">
                                        <label class="">Parent</label>
                                        <input type="radio" class="" style="width: 25px; margin: 25px 5px 25px 5px;" name="registration-option" value="parent" id="parentRadio">
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center" style=" padding: 5px 0px 15px 0px">
                                        <label class="">Student</label>
                                        <input type="radio" style="width: 25px; margin: 25px 5px 25px 5px;" class="" name="registration-option" value="child" id="childRadio">
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-center justify-content-center" style=" padding: 5px 0px 15px 0px">
                                        <label class="">General</label> 
                                        <input type="radio" style="width: 25px; margin: 25px 5px 25px 5px;" class="" name="registration-option" value="general" id="generalRadio">
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="parentForm" style="display: none;">
                                <div class="row mb-3 text-center" >
                                    <h4 >Input Child Information</h4>
                                    <h6 class="text-muted">you can add more child from profile setting</h6>
                                </div>
                                <div class="row mb-3">
                                    <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                                
                                    <div class="col-md-6">
                                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror par-req" name="child-fname" value="{{ old('fname') }}" required autocomplete="fname">
                                
                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                
                                    <div class="col-md-6">
                                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror par-req" name="child-lname" value="{{ old('lname') }}" required autocomplete="lname">
                                
                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="grade" class="col-md-4 col-form-label text-md-end">{{ __('Grade') }}</label>
                                    <div class="col-md-6">
                                        <select id="childGrade" class="form-control @error('childGrade') is-invalid @enderror par-req" name="child-grade" required autocomplete="childGrade">
                                            <option value="" disabled selected>Select Grade</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('childGrade') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('childGrade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <span id="parentForm" class="ec-register-wrap" style="display: none;">
                                <div class="row mb-3 text-center" >
                                    <h4 >Input Child Information</h4>
                                    <h6 class="text-muted">you can add more child from profile setting</h6>
                                </div>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>{{__('First name')}}</label>
                                    <input type="text" name="child-fname" placeholder="{{__('Enter child first name')}}" />
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>{{__('Last name')}}</label>
                                    <input type="text" name="child-lname" placeholder="{{__('Enter child last name')}}" />
                                </span>
                                
                                <span class="ec-register-wrap">
                                    <label for="childGrade">{{ __('Grade') }}</label>
                                    <span class="ec-rg-select-inner">
                                        <select id="childGrade" name="child-grade" class="ec-register-select">
                                            <option selected disabled>Select Grade</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('childGrade') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </span>
                                </span>
                                <span class="ec-register-wrap">
                                    <label>{{__('Age')}}</label>
                                    <input type="date" name="child-birthdate" placeholder="{{__('Enter birthdate')}}" />
                                </span>
                            </span>
                            <span id="childForm" class="ec-register-wrap" style="display: none;">
                                <label for="childGrade">{{ __('Grade') }}</label>
                                <span class="ec-rg-select-inner">
                                    <select id="childGrade" name="child-grade" class="ec-register-select">
                                        <option selected disabled>Select Grade</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('childGrade') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </span>
                            </span>
                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
{{-- @extends('layouts.ekkaNoMenu') --}}

{{-- @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register new account') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row mb-3">
                                <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname">

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname">

                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789" maxlength="12" required autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="card-container center">
                                    <div class="panel center">
                                        <div>
                                            <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                                            <span class="sb-title">Address Selection</span>
                                        </div>
                                        <input type="text" name="address" placeholder="Address" id="location-input"/>
                                        <input type="text" placeholder="Apt, Suite, etc (optional)"/>
                                        <input type="hidden" placeholder="City" id="locality-input"/>
                                        <input type="text" name="input-subdistrict" class="" placeholder="Subdistrict" id="administrative_area_level_3-input" readonly/>
                                        <input type="text" name="input-city" class="" placeholder="City" id="administrative_area_level_2-input" readonly/>
                                        <input type="text" placeholder="Provience" id="administrative_area_level_1-input" readonly/>
                                    </div>
                                    <div class="map" id="gmp-map"></div>
                                </div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0m1BX8scehZGo9O3l3huGJNGzGVZeSjc&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cAB" async defer></script>
                            </div>                                
                            <div class="row mb-3">
                                <label for="picture" class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture') }}</label>

                                <div class="col-md-6">
                                    <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" value="{{ old('picture') }}" required autocomplete="picture">

                                    @error('picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="picture" class="col-md-4 col-form-label text-md-end">{{ __('Register as') }}</label>
                            
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="registration-option" value="parent" id="parentRadio">
                                        <label class="form-check-label">Parent</label>
                                    </div>
                            
                                    <div class="form-check form-check-inline mt-2">
                                        <input type="radio" class="form-check-input" name="registration-option" value="child" id="childRadio">
                                        <label class="form-check-label">Student</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <input type="radio" class="form-check-input" name="registration-option" value="general" id="generalRadio">
                                        <label class="form-check-label">General</label>
                                    </div>
                                </div>
                            </div>
                            <div id="parentForm" style="display: none;">
                                <div class="row mb-3 text-center" >
                                    <h4 >Input Child Information</h4>
                                    <h6 class="text-muted">you can add more child from profile setting</h6>
                                </div>
                                <div class="row mb-3">
                                    <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                                
                                    <div class="col-md-6">
                                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror par-req" name="child-fname" value="{{ old('fname') }}" required autocomplete="fname">
                                
                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                
                                    <div class="col-md-6">
                                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror par-req" name="child-lname" value="{{ old('lname') }}" required autocomplete="lname">
                                
                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="grade" class="col-md-4 col-form-label text-md-end">{{ __('Grade') }}</label>
                                    <div class="col-md-6">
                                        <select id="childGrade" class="form-control @error('childGrade') is-invalid @enderror par-req" name="child-grade" required autocomplete="childGrade">
                                            <option value="" disabled selected>Select Grade</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('childGrade') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('childGrade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="childForm" style="display: none;">
                                <!-- Child form input for Grade as a select input -->
                                <div class="row mb-3">
                                    <label for="childGrade" class="col-md-4 col-form-label text-md-end">{{ __('Grade') }}</label>
                                    <div class="col-md-6">
                                        <select id="childGrade" class="form-control @error('childGrade') is-invalid @enderror chi-req" name="child-grade" required autocomplete="childGrade">
                                            <option value="" disabled selected>Select Grade</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('childGrade') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('childGrade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var parentRadio = document.getElementById('parentRadio');
        var childRadio = document.getElementById('childRadio');
        var generalRadio = document.getElementById('generalRadio');
        var parentForm = document.getElementById('parentForm');
        var childForm = document.getElementById('childForm');
        var parentInputs = document.querySelectorAll('.par-req');
        var childInputs = document.querySelectorAll('.chi-req');

        function toggleRequired(inputs, required) {
            inputs.forEach(function (input) {
                input.required = required;
            });
        }

        parentRadio.addEventListener('change', function () {
            if (parentRadio.checked) {
                parentForm.style.display = 'block';
                childForm.style.display = 'none';
                toggleRequired(parentInputs, true);
                toggleRequired(childInputs, false);
            }
        });

        childRadio.addEventListener('change', function () {
            if (childRadio.checked) {
                parentForm.style.display = 'none';
                childForm.style.display = 'block';
                toggleRequired(parentInputs, false);
                toggleRequired(childInputs, true);
            }
        });
        generalRadio.addEventListener('change', function () {
            if (generalRadio.checked) {
                parentForm.style.display = 'none';
                childForm.style.display = 'none';
                toggleRequired(parentInputs, false);
                toggleRequired(childInputs, false);
            }
        });
    });
</script>
<script>
    "use strict";

    function initMap() {
    const CONFIGURATION = {
        "ctaTitle": "Checkout",
        "mapOptions": {"center":{"lat":37.4221,"lng":-122.0841},"fullscreenControl":false,"mapTypeControl":false,"streetViewControl":false,"zoom":11,"zoomControl":true,"maxZoom":22,"mapId":""},
        "mapsApiKey": "AIzaSyDlnH2-icvi6PuSwCoOA-UKNEBlwavjWDI",
        "capabilities": {"addressAutocompleteControl":true,"mapDisplayControl":true,"ctaControl":false}
    };
    const componentForm = [
        'location',
        'locality',
        'administrative_area_level_3',
        'administrative_area_level_2',
        'administrative_area_level_1',
        'country',
        'postal_code',
    ];

    const getFormInputElement = (component) => document.getElementById(component + '-input');
    const map = new google.maps.Map(document.getElementById("gmp-map"), {
        zoom: CONFIGURATION.mapOptions.zoom,
        center: { lat: 37.4221, lng: -122.0841 },
        mapTypeControl: false,
        fullscreenControl: CONFIGURATION.mapOptions.fullscreenControl,
        zoomControl: CONFIGURATION.mapOptions.zoomControl,
        streetViewControl: CONFIGURATION.mapOptions.streetViewControl
    });
    const marker = new google.maps.Marker({map: map, draggable: false});
    const autocompleteInput = getFormInputElement('location');
    const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
        fields: ["address_components", "geometry", "name"],
        types: ["address"],
    });
    autocomplete.addListener('place_changed', function () {
        marker.setVisible(false);
        const place = autocomplete.getPlace();
        if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert('No details available for input: \'' + place.name + '\'');
        return;
        }
        renderAddress(place);
        fillInAddress(place);
    });

    function fillInAddress(place) {  // optional parameter
        console.log(place);
        const addressNameFormat = {
        'street_number': 'short_name',
        'route': 'long_name',
        'locality': 'long_name',
        'administrative_area_level_3': 'short_name',
        'administrative_area_level_2': 'long_name',
        'administrative_area_level_1': 'short_name',
        'country': 'long_name',
        'postal_code': 'short_name',
        };
        const getAddressComp = function (type) {
        for (const component of place.address_components) {
            if (component.types[0] === type) {
            return component[addressNameFormat[type]];
            }
        }
        return '';
        };
        getFormInputElement('location').value = getAddressComp('street_number') + ' '
                + getAddressComp('route');
        for (const component of componentForm) {
        // Location field is handled separately above as it has different logic.
        if (component !== 'location') {
            getFormInputElement(component).value = getAddressComp(component);
        }
        }
    }

    function renderAddress(place) {
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    }
    }
</script>
<style>
    body {
    margin: 0;
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

    .card-container {
    display: flex;
    height: 500px;
    width: 700px;
    }
    .center{
        display: flex;
        justify-content: center;
    }
    .panel {
        background: white;
        width: 500px;
        padding: 20px 20px 20px 0px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .half-input-container {
        display: flex;
        justify-content: space-between;
    }

    .half-input {
     max-width: 220px;
    }

    .map {
       width: 450px;
    }

    h2 {
        margin: 0;
        font-family: Roboto, sans-serif;
    }

    input {
     height: 30px;
    }

    input {
        border: 0;
        border-bottom: 1px solid black;
        font-size: 14px;
        font-family: Roboto, sans-serif;
        font-style: normal;
        font-weight: normal;
    }

    input:focus::placeholder {
      color: white;
    }
</style>