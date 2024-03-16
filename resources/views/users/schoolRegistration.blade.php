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
        <form method="post" action="{{ route('schoolAdd') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')
            <div class="row justify-content-center">       
                <div class="col-xl-10 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __('Register as School') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                        
                            <h6 class="heading-small text-muted mb-4">{{ __('School Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-picture') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-picture">{{ __('School Picture') }}</label>
                                    <input type="file" name="input-picture" id="input-picture" class="form-control form-control-alternative{{ $errors->has('input-picture') ? ' is-invalid' : '' }}" placeholder="{{ __('School Picture') }}">

                                    @if ($errors->has('input-picture'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-picture') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-school-name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-school-name">{{ __('School Name') }}</label>
                                    <input type="text" name="input-school-name" id="input-school-name" class="form-control form-control-alternative{{ $errors->has('input-school-name') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-school-name'] ?? '' }}"   placeholder="{{ __('School Name') }}" required autofocus>

                                    @if ($errors->has('input-school-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-school-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('School Address') }}</label>
                                    <input type="text" name="input-address" id="location-input" class=" col form-control form-control-alternative{{ $errors->has('input-address') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-address'] ?? '' }}"   placeholder="{{ __('School Address') }}" required autofocus>
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
                                    <select name="input-school-city" id="input-school-city" class="form-control form-control-alternative{{ $errors->has('input-school-city') ? ' is-invalid' : '' }}" onchange="getSubcategories()" required>
                                        <option value=''>--Select City--</option>
                                        @foreach ($cityList as $city)
                                        <option value="{{$city->id}}"  {{$sessionData != null ? ($sessionData['input-school-city'] == $city->id ? 'selected' : '' ) : '' }} >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-school-subDistrict') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-school-subDistrict">{{ __('Sub District') }}</label>
                                    <select name="input-school-subDistrict" id="input-school-subDistrict" class="form-control form-control-alternative{{ $errors->has('input-school-subDistrict') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Sub District--</option>
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-vision') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-vision">{{ __('Vision') }}</label>
                                    <textarea name="input-vision" id="input-vision" class="form-control form-control-alternative{{ $errors->has('input-vision') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-vision'] ?? '' }}"   placeholder="{{ __('Vision') }}" required autofocus></textarea>

                                    @if ($errors->has('input-vision'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-vision') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-mission') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-mission">{{ __('Mission') }}</label>
                                    <textarea name="input-mission" id="input-mission" class="form-control form-control-alternative{{ $errors->has('input-mission') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-mission'] ?? '' }}"   placeholder="{{ __('Mission') }}" required autofocus></textarea>

                                    @if ($errors->has('input-mission'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-mission') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                    <input type="tel" name="input-phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('input-phone') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-phone'] ?? '' }}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789" maxlength="12" required autofocus>

                                    @if ($errors->has('input-phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-website') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-website">{{ __('Website') }}</label>
                                    <input type="text" name="input-website" id="input-website" class="form-control form-control-alternative{{ $errors->has('input-website') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-website'] ?? '' }}" pattern="www\..+" placeholder="www.example.com" autofocus>

                                    @if ($errors->has('input-website'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-website') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-level') ? ' has-danger' : '' }} pl-2">
                                    <label class="form-control-label" for="input-level">{{ __('Level') }}</label>
                                    <select name="input-level" id="input-level" class="form-control form-control-alternative{{ $errors->has('input-level') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Level--</option>
                                        <option value="SD"  {{$sessionData != null ? ($sessionData['input-level'] == 'SD' ? 'selected' : '' ) : '' }}>{{__('Elementary School')}}</option>
                                        <option value="SMP"  {{$sessionData != null ? ($sessionData['input-level'] == 'SMP' ? 'selected' : '' ) : '' }}>{{__('Junior High School')}}</option>
                                        <option value="SMA"  {{$sessionData != null ? ($sessionData['input-level'] == 'SMA' ? 'selected' : '' ) : '' }}>{{__('Senior High School')}}</option>
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-accreditation') ? ' has-danger' : '' }} pl-2">
                                    <label class="form-control-label" for="input-accreditation">{{ __('Accreditation') }}</label>
                                    <select name="input-accreditation" id="input-accreditation" class="form-control form-control-alternative{{ $errors->has('input-accreditation') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Level--</option>
                                        <option value="A"  {{$sessionData != null ? ($sessionData['input-accreditation'] == 'A' ? 'selected' : '' ) : '' }}>{{__('A')}}</option>
                                        <option value="B"  {{$sessionData != null ? ($sessionData['input-accreditation'] == 'B' ? 'selected' : '' ) : '' }}>{{__('B')}}</option>
                                        <option value="C"  {{$sessionData != null ? ($sessionData['input-accreditation'] == 'C' ? 'selected' : '' ) : '' }}>{{__('C')}}</option>
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-accreditation-certificate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-accreditation-certificate">{{ __('Accreditation Certificate') }}</label>
                                    <input type="file" name="input-accreditation-certificate" id="input-accreditation-certificate" class="form-control form-control-alternative{{ $errors->has('input-accreditation-certificate') ? ' is-invalid' : '' }}" placeholder="{{ __('Accreditaiton Certificate') }}">

                                    @if ($errors->has('input-accreditation-certificate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-accreditation-certificate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('input-enrollment-start') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-enrollment-start">{{ __('Enrollment Start Date') }}</label>
                                            <input type="date" name="input-enrollment-start" id="input-enrollment-start" class="form-control form-control-alternative{{ $errors->has('input-enrollment-start') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-enrollment-start'] ?? '' }}" placeholder="{{ __('Enrollment Start Date') }}" min="{{ now()->toDateString() }}" required>
        
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
                                            <input type="date" name="input-enrollment-end" id="input-enrollment-end" class="form-control form-control-alternative{{ $errors->has('input-enrollment-end') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-enrollment-end'] ?? '' }}" placeholder="{{ __('Enrollment End Date') }}" min="{{ now()->toDateString() }}" required>        
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
                    <div>
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('School Facilites') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <button class="btn btn-primary" onclick="addDropdown()">{{__('Add Facilities')}}</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <ul id="dropdown-list" class="list-group mt-3 bg-blue"></ul>
                                <input type="hidden" name="dropdownCount" id="dropdownCount" value="0">
                            </div>
                        </div>
                    </div>
                    
                </div>      
                <div class="col-xl-10 order-xl-1">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save School Data') }}</button>
                    </div>
                </div>
            </div>
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
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0m1BX8scehZGo9O3l3huGJNGzGVZeSjc&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cAB" async defer></script>
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
    $(document).ready(function() {
        var button = document.getElementById('btnShowMap');
        button.style.display = 'none';

        var mySessionData = @json($sessionData);
    // Log the session data to the console
        console.log('Session Data:', mySessionData);
    });
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
        // 'locality',
        // 'administrative_area_level_1',
        // 'country',
        // 'postal_code',
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
</style>
<script>
    var dropdownCount = 0;
    
        function addDropdown() {
        var dropdownList = document.getElementById('dropdown-list');
        var newDropdownCard = createDropdownCard(dropdownCount);
        dropdownList.appendChild(newDropdownCard);
        toggleDropdown(dropdownCount);
        if(dropdownCount > 0){
            var dropdownContent = document.getElementById('dropdown-content-' + (dropdownCount-1));
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
        dropdownCount++;
        document.getElementById('dropdownCount').value = dropdownCount;
    }

    function createDropdownCard(index) {
        var newDropdownCard = document.createElement('li');
        newDropdownCard.className = 'list-group-item bg-primary';
        newDropdownCard.innerHTML = `
            <div class="bg-primary">
                <h5 class="text-white" onclick="toggleDropdown(${index})">Facility ${(index+1)}</h5>
                <div class="dropdown-content text-white" style="display: none;" id="dropdown-content-${index}">
                    <div class="form-group{{ $errors->has('input-facility-select-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-facility-select-${index}">{{ __('Select Facility') }}</label>
                        <input list="facility-list-selects" name="input-facility-select-${index}" id="input-facility-select-${index}" class="form-control form-control-alternative{{ $errors->has('input-facility-select-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('-- Select Facility --') }}" required>
                        <datalist id="facility-list-selects">
                            @foreach ($facilityList as $facility)
                                <option value="{{$facility->name}}"  {{$sessionData != null ? ($sessionData['facility_id'] == $facility->id ? 'selected' : '' ) : '' }} >
                            @endforeach
                        </datalist>
                    </div>
                    <div class="form-group{{ $errors->has('input-facility-detail-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-facility-detail-${index}">{{ __('Facility Detail') }}</label>
                        <textarea name="input-facility-detail-${index}" id="input-facility-detail-${index}" class="form-control form-control-alternative{{ $errors->has('input-facility-detail-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Facility Detail') }}" required autofocus></textarea>

                        @if ($errors->has('input-facility-detail-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-facility-detail-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-facility-picture-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-facility-picture-${index}">{{ __('Certificate File') }}</label>
                        <input type="file" name="input-facility-picture-${index}" id="input-facility-picture-${index}" class="form-control form-control-alternative{{ $errors->has('input-facility-picture-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('Facility Picture') }}">

                        @if ($errors->has('input-facility-picture-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-facility-picture-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        `;
        return newDropdownCard;
    }

    function toggleDropdown(index) {
        var dropdownContent = document.getElementById('dropdown-content-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }
    function getSubcategories() {
        var cityId = document.getElementById('input-school-city').value;
        fetch('/getSubDistrict/' + cityId) // Replace with your route
            .then(response => response.json())
            .then(data => {
                let subDistrictSelect = document.getElementById('input-school-subDistrict');
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