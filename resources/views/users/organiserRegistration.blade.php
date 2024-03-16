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
        <div class="row justify-content-center">            
            <div class="col-xl-10 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Register as Competition Organiser') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('organiserAdd') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Organisation Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-picture') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-picture">{{ __('Organisation Picture') }}</label>
                                    <input type="file" name="input-picture" id="input-picture" class="form-control form-control-alternative{{ $errors->has('input-picture') ? ' is-invalid' : '' }}" placeholder="{{ __('Organisation Picture') }}">

                                    @if ($errors->has('input-picture'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-picture') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('org_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-name">{{ __('Organisation Name') }}</label>
                                    <input type="text" name="input-org-name" id="input-org-name" class="form-control form-control-alternative{{ $errors->has('input-org-name') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-org-name'] ?? '' }}"   placeholder="{{ __('Organisation Name') }}" required autofocus>

                                    @if ($errors->has('input-org-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-org-email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-email">{{ __('Organisation Email') }}</label>
                                    <input type="email" name="input-org-email" id="input-org-email" class="form-control form-control-alternative{{ $errors->has('input-org-email') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-org-email'] ?? '' }}"   placeholder="{{ __('Organisation Email') }}" required autofocus>

                                    @if ($errors->has('input-org-email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-org-phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-phone">{{ __('Organisation Phone ') }}</label>
                                    <input type="text" name="input-org-phone" id="input-org-phone" class="form-control form-control-alternative{{ $errors->has('input-org-phone') ? ' is-invalid' : '' }}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="{{ $sessionData['input-org-phone'] ?? '' }}"   placeholder="{{ __('Organisation Phone') }}" maxlength="12" required autofocus>

                                    @if ($errors->has('input-org-phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-org-inCharge-name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-inCharge-name">{{ __('Organisation Person in Charge Name ') }}</label>
                                    <input type="text" name="input-org-inCharge-name" id="input-org-inCharge-name" class="form-control form-control-alternative{{ $errors->has('input-org-inCharge-name') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-org-inCharge-name'] ?? '' }}"   placeholder="{{ __('Organisation Person in Charge Name') }}" maxlength="12" required autofocus>

                                    @if ($errors->has('input-org-inCharge-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-inCharge-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-org-inCharge-file') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-inCharge-file">{{ __('Person in Charge KTP') }}</label>
                                    <input type="file" name="input-org-inCharge-file" id="input-org-inCharge-file" class="form-control form-control-alternative{{ $errors->has('input-org-inCharge-file') ? ' is-invalid' : '' }}" placeholder="{{ __('Person in Charge KTP') }}">

                                    @if ($errors->has('input-org-inCharge-file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-inCharge-file') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save Organiser Data') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                    </div>
                </div>
            </div>
            <div class="modal" id="imageModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Certificate Preview</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-container">    
                            {{-- <div class="panel">
                              <div>
                                <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                                <span class="sb-title">Address Selection</span>
                              </div>
                              <input type="text" placeholder="Address" id="location-input" />
                              <input type="text" placeholder="Apt, Suite, etc (optional)" />
                              <input type="text" placeholder="City" id="locality-input" />
                              <div class="half-input-container">
                                <input type="text" class="half-input" placeholder="State/Province" id="administrative_area_level_1-input" />
                                <input type="text" class="half-input" placeholder="Zip/Postal code" id="postal_code-input" />
                              </div>
                              <input type="text" placeholder="Country" id="country-input" />
                              <button class="button-cta">School Address</button>
                            </div> --}}
                            <div class="map" id="gmp-map"></div>
                        </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATMKwEqYnXHLwupMwI8a7aSYdB1bu2-bw&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>
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