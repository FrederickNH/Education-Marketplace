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
                            <h3 class="mb-0">{{ __('Make New Tutoring Schedule') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tutoringAdd') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Tutoring Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $sessionData['title'] ?? '' }}"   placeholder="{{ __('Title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('banner') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-banner">{{ __('Banner') }}</label>
                                    <input type="file" name="banner" id="input-banner" class="form-control form-control-alternative{{ $errors->has('banner') ? ' is-invalid' : '' }}" placeholder="{{ __('Banner') }}">

                                    @if ($errors->has('banner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('banner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                                    <select name="subject" id="subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Subject--</option>
                                        @foreach ($subjectList as $subject)
                                        <option value="{{$subject->id}}"  {{$sessionData != null ? ($sessionData['subject_id'] == $subject->id ? 'selected' : '' ) : '' }} >{{$subject->subject_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ $sessionData['description'] ?? '' }}" placeholder="{{ __('Description') }}"></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                            <input type="date" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{ $sessionData['date'] ?? '' }}" placeholder="{{ __('Date') }}" min="{{ now()->toDateString() }}" required>
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                            <div class="form-group{{ $errors->has('day') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-day">{{ __('Day') }}</label>
                                                <input type="text" name="day" id="input-day" class="form-control form-control-alternative{{ $errors->has('day') ? ' is-invalid' : '' }}" value="{{ $sessionData['day'] ?? '' }}" placeholder="{{ __('Day') }}" readonly autofocus>

                                                @if ($errors->has('day'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('day') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('start_time') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-start-time">{{ __('Tutoring Start Time') }}</label>
                                            <input type="time" name="start_time" id="input-start-time" class="form-control form-control-alternative{{ $errors->has('start_time') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" required>
        
                                            @if ($errors->has('start_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('start_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('end_time') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-end-time">{{ __('Tutoring End Time') }}</label>
                                            <input type="time" name="end_time" id="input-end-time" class="form-control form-control-alternative{{ $errors->has('end_time') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" required>
        
                                            @if ($errors->has('end_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('end_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }} pl-2">
                                    <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
                                    <input type="number" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $sessionData['price'] ?? '' }}" placeholder="{{ __('Price') }}" required>

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('mode') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-mode">{{ __('Mode') }}</label>
                                            <select name="mode" id="input-mode" class="form-control form-control-alternative{{ $errors->has('mode') ? ' is-invalid' : '' }}" onchange="modeChanged(this)" required>
                                                <option value=''>--Select Mode--</option>
                                                <option value="private" {{$sessionData != null ? ($sessionData['mode'] == 'private' ? 'selected' : '' ) : '' }}>Private</option>
                                                <option value="group" {{$sessionData != null ? ($sessionData['mode'] == 'group' ? 'selected' : '' ) : '' }}>Group</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('group_size') ? ' has-danger' : '' }}" id="group-size-div">
                                            <label class="form-control-label" for="input-group-size">{{ __('Group Size') }}</label>
                                            <input type="number" name="group_size" id="input-group-size" class="form-control form-control-alternative{{ $errors->has('group_size') ? ' is-invalid' : '' }}" value="{{ $sessionData['group_size'] ?? '' }}" placeholder="{{ __('Group Size') }}">
        
                                            @if ($errors->has('group_size'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('group_size') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('method') ? ' has-danger' : '' }} pl-2">
                                            <label class="form-control-label" for="input-method">{{ __('Method') }}</label>
                                            <select name="method" id="method" class="form-control form-control-alternative{{ $errors->has('method') ? ' is-invalid' : '' }}" onchange="methodChanged(this)" required>
                                                <option value=''>--Select Method--</option>
                                                <option value="online"  {{$sessionData != null ? ($sessionData['method'] == 'online' ? 'selected' : '' ) : '' }}>Online</option>
                                                <option value="offline"  {{$sessionData != null ? ($sessionData['method'] == 'offline' ? 'selected' : '' ) : '' }}>Offfline</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}" style="display: none" id="location-div">
                                            <label class="form-control-label" for="location" id="location-label">{{ __('Location') }}</label>
                                            <input type="text" name="location" id="location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" value="{{ $sessionData['location'] ?? '' }}" placeholder="{{ __('Location') }}">
        
                                            @if ($errors->has('location'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('repetitive') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-repetitive">{{ __('Repetitive') }}</label>
                                            <select name="repetitive" id="repetitive" class="form-control form-control-alternative{{ $errors->has('rrepetitive') ? ' is-invalid' : '' }}">
                                                <option value=''>--Select Repetitive Status--</option>
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('repetitive_duration') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-repetitive-duration">{{ __('Repetitive Duration') }}</label>
                                            <input type="number" name="repetitive_duration" id="input-repetitive_duration" class="form-control form-control-alternative{{ $errors->has('repetitive_duration') ? ' is-invalid' : '' }}" placeholder="{{ __('Repetitive Duration') }}">
        
                                            @if ($errors->has('repetitive_duration'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('repetitive_duration') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="d-flex pl-3 container-fluid">
                                    <div class="custom-control custom-switch form-group{{ $errors->has('repetitive') ? ' has-danger' : '' }} mt-4 mr-5">
                                            <input type="checkbox" name="repetitive" class="custom-control-input form-control form-control-alternative{{ $errors->has('rrepetitive') ? ' is-invalid' : '' }}" id="repetitive">
                                            <label class="custom-control-label for-control-label" for="repetitive">{{ __('Repetitive') }}</label>
                                    </div>
                                    <div class="form-group{{ $errors->has('repetitive_duration') ? ' has-danger' : '' }} mr-1" id="rep-dur-div">
                                        <label class="form-control-label" for="input-repetitive-duration">{{ __('Repetitive Duration') }}</label>
                                        <input type="number" name="repetitive_duration" id="input-repetitive-duration" class="form-control form-control-alternative{{ $errors->has('repetitive_duration') ? ' is-invalid' : '' }}" value="{{ $sessionData['repetitive_duration'] ?? '' }}" placeholder="{{ __('Repetitive Duration') }}">
    
                                        @if ($errors->has('repetitive_duration'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('repetitive_duration') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                             
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('campaign_start_time') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-campaign-start-time">{{ __('Campaign Start Time') }}</label>
                                            <input type="date" name="campaign_start_time" id="input-campaign-start-time" class="form-control form-control-alternative{{ $errors->has('campaign_start_time') ? ' is-invalid' : '' }}" value="{{ $sessionData['campaign_start'] ?? '' }}" placeholder="{{ __('Campaign Start Time') }}" min="{{ now()->toDateString() }}" required>
        
                                            @if ($errors->has('campaign_start_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('campaign_start_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('campaign_end_time') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-campaign-end-time">{{ __('Campaign End Time') }}</label>
                                            <input type="date" name="campaign_end_time" id="input-campaign-end-time" class="form-control form-control-alternative{{ $errors->has('campaign_end_time') ? ' is-invalid' : '' }}" value="{{ $sessionData['campaign_end'] ?? '' }}" placeholder="{{ __('Campaign End Time') }}" min="{{ now()->toDateString() }}" required>        
                                            @if ($errors->has('campaign_end_time'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('campaign_end_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save Tutoring Info') }}</button>
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
<script>
    $(document).ready(function() {

        var mySessionData = @json($sessionData);
    // Log the session data to the console
        console.log('Session Data:', mySessionData);
        if(mySessionData['repetitive'] != null){
            var repetitive = document.getElementById('repetitive');
            if(mySessionData['repetitive'] == true){
                repetitive.checked = true;
                document.getElementById("rep-dur-div").style.display = "block";
                // document.getElementById("rep-dur-div").value = mySessionData['repetitive_duration']; 
            }else{
                repetitive.checked = false;
            }
        }
        if(mySessionData['group_size'] != null){
            document.getElementById("group-size-div").style.display = "block";      
            // document.getElementById('group_size').value = mySessionData['group_size'];
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
            // Get references to the input elements
            const dateInput = document.getElementById('input-date');
            const startCampaignInput = document.getElementById('input-campaign-start-time');
            const endCampaignInput = document.getElementById('input-campaign-end-time');

            // Add event listener to date input
            dateInput.addEventListener('change', function () {
                // Update the min attribute of startCampaignInput
                startCampaignInput.max = dateInput.value;
                // Reset startCampaignInput value if it's invalid
                if (endCampaignInput.value < dateInput.value) {
                    endCampaignInput.value = dateInput.value;
                }
            });

            // Add event listener to startCampaign input
            endCampaignInput.addEventListener('change', function () {
                // Update the min attribute of endCampaignInput
                startCampaignInput.min = new Date();
                startCampaignInput.max = dateInput.value;
                // Reset endCampaignInput value if it's invalid
                if (endCampaignInput.value < startCampaignInput.value) {
                    endCampaignInput.value = startCampaignInput.value;
                }
            });
        });
</script>
<script>
    $(document).ready(function() {

        $('#close-button').click(function() {
            $('#status-messages').hide();
        });
        const datePicker = $('#input-date');
        const dayDisplay = $('#input-day');

        datePicker.on('change', function() {
            const selectedDate = datePicker.val();
            // alert(selectedDate);
            if (selectedDate) {
                const dateObject = new Date(selectedDate);
                const dayOfWeek = dateObject.toLocaleDateString('en-US', { weekday: 'long' });
                dayDisplay.val(dayOfWeek);
            } else {
                dayDisplay.val('');
            }
        });
        $('#repetitive').change(function() {
            if (this.checked) {
                document.getElementById("rep-dur-div").style.display = "block";       
            } else {
                document.getElementById("rep-dur-div").style.display = "none";
            }
        });
    });
    const modePicker = $('#input-mode');
    const groupSize = $('#input-group-size');

    modePicker.on('change', function() {
        if (modePicker.value == 'group') {
            alert('true');
        } else {
         alert('false');
        }
    });
    
    function modeChanged(selectElement) {
        // Get the selected option's value and text
        const selectedValue = selectElement.value;
        const selectedText = selectElement.options[selectElement.selectedIndex].text;

        if (selectedValue == 'group') {
                document.getElementById("group-size-div").style.display = "block";       
                $('#method').empty();
                $('#method').append('<option value="online">Online</option>');
                $('#method').append('<option value="offline">Offline</option>');
            } else {
                document.getElementById("group-size-div").style.display = "none";
                $('#method').empty();
                $('#method').append('<option value="online">Online</option>');
                $('#method').append('<option value="offline">Offline</option>');
                $('#method').append('<option value="homeService">Home Service</option>');
            }
    }
    function methodChanged(selectElement) {
        // Get the selected option's value and text
        const selectedValue = selectElement.value;
        const selectedText = selectElement.options[selectElement.selectedIndex].text;
        if(selectedValue != 'homeService'){
            document.getElementById("location-div").style.display = "block"; 
        }
        if (selectedValue == 'offline') {
                $("#location-label").text("Location Address");     
                $('#location').attr('placeholder', 'Location Address');  
        }else if(selectedValue == 'online'){
                $("#location-label").text("Meeting Link");       
                $('#location').attr('placeholder', 'Meeting Link');
        }else if(selectedValue == 'homeService'){
            document.getElementById("location-div").style.display = "none"; 
        }
        $("#location").val("");
    }
</script>

<style>
    /* Custom CSS to move the label to the left */
    .custom-control-label {
      order: 0; /* This moves the label to the left */
    }
    .repetitive-gap{
        gap: 10px
    }
    #rep-dur-div, #group-size-div{
        display: none;
    }
  </style>
