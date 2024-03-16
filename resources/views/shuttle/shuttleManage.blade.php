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
        <form method="post" action="{{ route('shuttleUpdate') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')
            @foreach($shuttle as $s)
                <div class="row justify-content-center">       
                    <div class="col-xl-10 order-xl-1">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Shuttle Data') }}</h3>
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
                                    <div class="form-group{{ $errors->has('input-shuttle-name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-shuttle-name">{{ __('Shuttle Name') }}</label>
                                        <input type="text" name="input-shuttle-name" id="input-shuttle-name" class="form-control form-control-alternative{{ $errors->has('input-shuttle-name') ? ' is-invalid' : '' }}" value="{{$s->shuttle_name}}"   placeholder="{{ __('Shuttle Name') }}" readonly required autofocus>

                                        @if ($errors->has('input-shuttle-name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-shuttle-name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- end not editable --}}
                                    {{-- editable --}}
                                    <div><img id="input-picture-preview" src="{{asset('assets')}}/img/{{$s->picture}}" alt="" class="banner-img"></div>
                                    <div class="form-group{{ $errors->has('input-picture') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-picture">{{ __('Shuttle Picture') }}</label>
                                        <input type="file" name="input-picture" id="input-picture" class="form-control form-control-alternative{{ $errors->has('input-picture') ? ' is-invalid' : '' }} editable" placeholder="{{ __('Shuttle Picture') }}">
                
                                        @if ($errors->has('input-picture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                        <textarea name="input-description" id="input-description" class="form-control form-control-alternative{{ $errors->has('input-description') ? ' is-invalid' : '' }} editable" value=""   placeholder="{{ __('Description') }}" required autofocus>{{$s->description}}</textarea>

                                        @if ($errors->has('input-description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-city') ? ' has-danger' : '' }} pl-2">
                                        <label class="form-control-label" for="input-city">{{ __('Level') }}</label>
                                        <select name="input-city" id="input-city" class="form-control form-control-alternative{{ $errors->has('input-city') ? ' is-invalid' : '' }} disable" onchange="getSubcategories()" required>
                                            <option value=''>--Select City--</option>
                                            @foreach($cityList as $c)
                                            <option value="{{$c->id}}" {{$c->name != null ? ($s->CityName == $c->name ? 'selected' : '' ) : '' }}>{{__($c->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('input-subDistrict') ? ' has-danger' : '' }} pl-2">
                                        <label class="form-control-label" for="input-subDistrict">{{ __('Accreditation') }}</label>
                                        <select name="input-subDistrict" id="input-subDistrict" class="form-control form-control-alternative{{ $errors->has('input-subDistrict') ? ' is-invalid' : '' }} disable" required>
                                            <option value='{{$s->subdistrict_id}}'>{{$s->SubdistrictName}}</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="my-4" />
                            </div>
                        </div>
                    </div>    
                    <div class="col-xl-10 order-xl-1">
                        <div class="text-center" id="submit-edit">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save Shuttle Data') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
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
    .banner-img{
        width: 20rem;
        height: 200px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Replace YOUR_API_KEY with your actual Google API key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATMKwEqYnXHLwupMwI8a7aSYdB1bu2-bw&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>
<script>
    var edit = true;
    
    $(document).ready(function() {
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
            var submit = document.getElementById("submit-edit")
            submit.style.display = 'none';
            var set = document.getElementById("set-edit")
            set.style.display = 'block';
            edit = false;
        }
        
    }
</script>
<script>
    
    "use strict";

    function initMap() {
    const CONFIGURATION = {
        "ctaTitle": "School Address",
        "mapOptions": {"center":{"lat":37.4221,"lng":-122.0841},"fullscreenControl":false,"mapTypeControl":false,"streetViewControl":false,"zoom":11,"zoomControl":true,"maxZoom":22,"mapId":""},
        "mapsApiKey": "AIzaSyATMKwEqYnXHLwupMwI8a7aSYdB1bu2-bw",
        "capabilities": {"addressAutocompleteControl":true,"mapDisplayControl":true,"ctaControl":true}
    };
    const componentForm = [
        'location',
        'locality',
        'administrative_area_level_1',
        'country',
        'postal_code',
    ];

    const getFormInputElement = (component) => document.getElementById(component + '-input');
    
    // const getFormInputElement = document.getElementById('#input-address');
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
        const addressNameFormat = {
        'street_number': 'short_name',
        'route': 'long_name',
        'locality': 'long_name',
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
        var button = document.getElementById('btnShowMap');
        button.style.display = 'block';
    }
    }
</script>
<script>
    function getSubcategories() {
        var cityId = document.getElementById('input-city').value;
        fetch('/getSubDistrict/' + cityId) // Replace with your route
            .then(response => response.json())
            .then(data => {
                let subDistrictSelect = document.getElementById('input-subDistrict');
                subDistrictSelect.innerHTML = ''; // Clear existing options
                
                let option = document.createElement('option');
                    option.text = "-- Select Sub District --"; // Replace with your subcategory name field
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