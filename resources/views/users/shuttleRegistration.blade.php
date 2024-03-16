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
                            <h3 class="mb-0">{{ __('Register as Shuttle') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('shuttleAdd') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('School Shuttle Detail') }}</h6>
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
                                <div class="form-group{{ $errors->has('input-shuttle-name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-shuttle-name">{{ __('Shuttle Name') }}</label>
                                    <input type="text" name="input-shuttle-name" id="input-shuttle-name" class="form-control form-control-alternative{{ $errors->has('input-shuttle-name') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-shuttle-name'] ?? '' }}"   placeholder="{{ __('Shuttle Name') }}" required autofocus>

                                    @if ($errors->has('input-shuttle-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-shuttle-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-shuttle-description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-shuttle-description">{{ __('Shuttle Description') }}</label>
                                    <textarea type="text" name="input-shuttle-description" id="input-shuttle-description" class="form-control form-control-alternative{{ $errors->has('input-shuttle-description') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-shuttle-description'] ?? '' }}"   placeholder="{{ __('Shuttle Description') }}" required autofocus></textarea>

                                    @if ($errors->has('input-shuttle-description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-shuttle-description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('input-shuttle-price') ? ' has-danger' : '' }} col-9">
                                        <label class="form-control-label" for="input-shuttle-price">{{ __('Price ') }}</label>
                                        <input type="number" name="input-shuttle-price" id="input-shuttle-price" class="form-control form-control-alternative{{ $errors->has('input-shuttle-price') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-shuttle-price'] ?? '' }}"   placeholder="{{ __('Price') }}" required autofocus>
    
                                        @if ($errors->has('input-shuttle-price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-shuttle-price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-shuttle-form') ? ' has-danger' : '' }} col-3">
                                        <label class="form-control-label" for="input-shuttle-form">{{ __('Type') }}</label>
                                        <select name="input-shuttle-form" id="input-shuttle-form" class="form-control form-control-alternative{{ $errors->has('input-shuttle-form') ? ' is-invalid' : '' }}" required>
                                            <option value='' selected disabled>--Select Price Type--</option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="KM">Rp/Km</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('input-shuttle-city') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-shuttle-city">{{ __('City') }}</label>
                                    <select name="input-shuttle-city" id="input-shuttle-city" class="form-control form-control-alternative{{ $errors->has('input-shuttle-city') ? ' is-invalid' : '' }}" onchange="getSubcategories()" required>
                                        <option value=''>--Select City--</option>
                                        @foreach ($cityList as $city)
                                        <option value="{{$city->id}}"  {{$sessionData != null ? ($sessionData['input-shuttle-city'] == $city->id ? 'selected' : '' ) : '' }} >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-shuttle-subDistrict') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-shuttle-subDistrict">{{ __('Sub District') }}</label>
                                    <select name="input-shuttle-subDistrict" id="input-shuttle-subDistrict" class="form-control form-control-alternative{{ $errors->has('input-shuttle-subDistrict') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Sub District--</option>
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('input-shuttle-identity-file') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-shuttle-identity-file">{{ __('KTP') }}</label>
                                    <input type="file" name="input-shuttle-identity-file" id="input-shuttle-identity-file" class="form-control form-control-alternative{{ $errors->has('input-shuttle-identity-file') ? ' is-invalid' : '' }}" placeholder="{{ __('KTP') }}">

                                    @if ($errors->has('input-shuttle-identity-file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-shuttle-identity-file') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save Shuttle Data') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Replace YOUR_API_KEY with your actual Google API key -->
<script>
    function getSubcategories() {
        var cityId = document.getElementById('input-shuttle-city').value;
        fetch('/getSubDistrict/' + cityId) // Replace with your route
            .then(response => response.json())
            .then(data => {
                let subDistrictSelect = document.getElementById('input-shuttle-subDistrict');
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






