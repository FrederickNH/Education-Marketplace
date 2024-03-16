@extends('layouts.app',['class' => 'bg-default'])

@section('content')    

<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container mt-1 pb-3">
        @if (session('status'))
                <div class="row alert alert-success" id="status-messages">
                    <span id="status-text">{{ session('status') }}</span>
                    <button class="status-close-button" id="close-button">&times;</button>
                </div>
            @endif
            @php
            $sessionData = session('data');
        @endphp
        <form method="post" action="{{ route('organiserUpdate') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')
            <div class="row justify-content-center">       
                <div class="col-xl-10 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">{{ __('Organisation Data') }}</h3>
                                </div>
                                <div class="col">
                                    <div class="row justify-content-end">
                                        <a class="btn btn-primary text-white" id="set-edit" onclick="setEdit()">{{__('Edit')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        
                            <h6 class="heading-small text-muted mb-4">{{ __('Organiser Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('org_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-name">{{ __('Organisation Name') }}</label>
                                    <input type="text" name="input-org-name" id="input-org-name" class="form-control form-control-alternative{{ $errors->has('input-org-name') ? ' is-invalid' : '' }} editable" value="{{ $organiser->org_name }}"   placeholder="{{ __('Organisation Name') }}" required autofocus>

                                    @if ($errors->has('input-org-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div><img id="input-picture-preview" src="{{asset('assets')}}/img/{{$organiser->picture}}" alt="" class="banner-img"></div>
                                    <div class="form-group{{ $errors->has('edit-picture') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-picture">{{ __('Organisation Picture') }}</label>
                                        <input type="file" name="input-picture" id="input-picture" class="form-control form-control-alternative{{ $errors->has('input-picture') ? ' is-invalid' : '' }} disable" placeholder="{{ __('Organisation Picture') }}">
                
                                        @if ($errors->has('input-picture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                <div class="form-group{{ $errors->has('input-org-email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-email">{{ __('Organisation Email') }}</label>
                                    <input type="email" name="input-org-email" id="input-org-email" class="form-control form-control-alternative{{ $errors->has('input-org-email') ? ' is-invalid' : '' }} editable" value="{{ $organiser->org_email }}"   placeholder="{{ __('Organisation Email') }}" required autofocus>

                                    @if ($errors->has('input-org-email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-org-phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-org-phone">{{ __('Organisation Phone ') }}</label>
                                    <input type="text" name="input-org-phone" id="input-org-phone" class="form-control form-control-alternative{{ $errors->has('input-org-phone') ? ' is-invalid' : '' }} editable" value="{{ $organiser->org_phone }}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789" maxlength="12" required autofocus>

                                    @if ($errors->has('input-org-phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-org-phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                            <hr class="my-4" />
                        </div>
                    </div>
                </div>    
                <div class="col-xl-10 order-xl-1">
                    <div class="text-center" id="submit-edit">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save Organisation Data') }}</button>
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