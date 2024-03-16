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
        <form method="post" action="{{ route('institutionUpdate') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')
            <div class="row justify-content-center">       
                <div class="col-xl-10 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">{{ __('Institution Data') }}</h3>
                                </div>
                                <div class="col">
                                    <div class="row justify-content-end">
                                        <a class="btn btn-primary text-white" id="set-edit" onclick="setEdit()">{{__('Edit')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('Institution Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Institution Name') }}</label>
                                    <input type="text" name="input-name" id="input-name" class="form-control form-control-alternative{{ $errors->has('input-name') ? ' is-invalid' : '' }} editable"   placeholder="{{ __('Institution Name') }}" value="{{$tutor->institution_name}}" required autofocus>

                                    @if ($errors->has('input-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Tutor Description') }}</label>
                                    <textarea name="input-description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }} editable"    placeholder="{{ __('Tutor Description') }}" value="{{$tutor->whats}}" required autofocus>{{$tutor->description}}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('School Address') }}</label>
                                    <input type="text" name="input-address" id="input-address" class=" col form-control form-control-alternative{{ $errors->has('input-address') ? ' is-invalid' : '' }} editable" placeholder="{{ $sessionData['input-address'] ?? '' }}" value="{{$tutor->institution_address}}"  placeholder="{{ __('School Address') }}" required autofocus>
                                    @if ($errors->has('input-address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-address') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="form-group{{ $errors->has('input-school-city') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-school-city">{{ __('City') }}</label>
                                    <select name="input-city" id="input-school-city" class="form-control form-control-alternative{{ $errors->has('input-school-city') ? ' is-invalid' : '' }}  disable " onchange="getSubcategories()" required>
                                        <option value=''>--Select City--</option>
                                        @foreach ($cityList as $city)
                                        <option value="{{$city->id}}"  {{$tutor->city_id != null ? ($tutor->city_id == $city->id ? 'selected' : '' ) : '' }} >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-school-subDistrict') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-school-subDistrict">{{ __('Sub District') }}</label>
                                    <select name="input-subDistrict" id="input-school-subDistrict" class="form-control form-control-alternative{{ $errors->has('input-school-subDistrict') ? ' is-invalid' : '' }} disable" required>
                                        @if($subdis[0] != 'none')
                                        <option value="{{$subdis[1]}} selected">{{$subdis[2]}}</option>
                                        @else
                                        <option value=''>--Select Subdistrict--</option>
                                        @endif
                                    </select>
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4" />
                        </div>
                    </div>
                </div>    
                <div class="col-xl-10 order-xl-1">
                    <div class="text-center" id="submit-edit">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save Institution Data') }}</button>
                    </div>
                </div>
            </div>
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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Replace YOUR_API_KEY with your actual Google API key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATMKwEqYnXHLwupMwI8a7aSYdB1bu2-bw&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>
<script>
    var edit = true;
    
    $(document).ready(function() {
        setEdit();
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
            // var certif = document.getElementById("accreditation-edit")
            // certif.style.display = 'block';
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
            // var certif = document.getElementById("accreditation-edit")
            // certif.style.display = 'none';
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
</style>
<script>
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