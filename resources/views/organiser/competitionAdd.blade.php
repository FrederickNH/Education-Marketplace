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
                            <h3 class="mb-0">{{ __('Make New Competition') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('competitionAdd') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')
                            <h6 class="heading-small text-muted mb-4">{{ __('Competition Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="input-title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $sessionData['title'] ?? '' }}"   placeholder="{{ __('Title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-subject') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                                    <select name="input-subject" id="input-subject" class="form-control form-control-alternative{{ $errors->has('input-subject') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Subject--</option>
                                        @foreach ($subjectList as $subject)
                                        <option value="{{$subject->id}}"  {{$sessionData != null ? ($sessionData['subject'] == $subject->id ? 'selected' : '' ) : '' }} >{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="input-description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ $sessionData['description'] ?? '' }}" placeholder="{{ __('Description') }}"></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('brochure') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-brochure">{{ __('Brochure') }}</label>
                                    <input type="file" name="input-brochure" id="input-brochure" class="form-control form-control-alternative{{ $errors->has('brochure') ? ' is-invalid' : '' }}" placeholder="{{ __('Brochure') }}">

                                    @if ($errors->has('banner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('brochure') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div>
                                    <div class="form-group{{ $errors->has('input-variant') ? ' has-danger' : '' }} pl-2">
                                        <label class="form-control-label" onclick="addDropdownVariant()">{{ __('variant') }} <i class="ni ni-fat-add"></i></label>
                                        <ul id="dropdown-list-variant" class="list-group mt-3 bg-blue"></ul>
                                        <input type="hidden" name="dropdownCountVariant" id="dropdownCountVariant" value="0">
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('allowed-member') ? ' has-danger' : '' }} pl-2">
                                    <label class="form-control-label" for="input-allowed-member">{{ __('Allowed Member') }}</label>
                                    <input type="number" name="input-allowed-member" id="input-allowed-member" class="form-control form-control-alternative{{ $errors->has('input-allowed-member') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-allowed-member'] ?? '' }}" placeholder="{{ __('Alowed Member') }}" required>

                                    @if ($errors->has('input-allowed-member'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-allowed-member') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('input-campaign-start') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-campaign-start">{{ __('Campaign Start Time') }}</label>
                                            <input type="date" name="input-campaign-start" id="input-campaign-start" onchange="setMinEndDate('campStart',this.value)" class="form-control form-control-alternative{{ $errors->has('input-campaign-start') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-campaign-start'] ?? '' }}" placeholder="{{ __('Campaign Start Time') }}" min="{{ now()->toDateString() }}" required>        
                                            @if ($errors->has('input-campaign-start'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-campaign-start') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('input-campaign-end') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-campaign-end">{{ __('Campaign End Time') }}</label>
                                            <input type="date" name="input-campaign-end" id="input-campaign-end" onchange="setMinEndDate('campEnd',this.value)" class="form-control form-control-alternative{{ $errors->has('input-campaign-end') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-campaign-end'] ?? '' }}" placeholder="{{ __('Campaign End Time') }}" min="{{ now()->toDateString() }}" required>
        
                                            @if ($errors->has('input-campaign-end'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-campaign-end') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-2">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('input-competition-start') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-competition-start">{{ __('Competition Start Time') }}</label>
                                            <input type="date" name="input-competition-start" id="input-competition-start" onchange="setMinEndDate('comStart',this.value)" class="form-control form-control-alternative{{ $errors->has('input-competition-start') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-competition-start'] ?? '' }}" placeholder="{{ __('Competition Start') }}" min="{{ now()->toDateString() }}" required>
        
                                            @if ($errors->has('input-competition-start'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-competition-start') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('input-competition-end') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-competition-end">{{ __('Competition End Time') }}</label>
                                            <input type="date" name="input-competition-end" id="input-competition-end" class="form-control form-control-alternative{{ $errors->has('input-competition-end') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-competition-end'] ?? '' }}" placeholder="{{ __('Competition End Time') }}" min="{{ now()->toDateString() }}" required>        
                                            @if ($errors->has('input-competition-end'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-competition-end') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save Competition Data') }}</button>
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
    function setMinEndDate(ins,minDate) {
            // Set the minimum date for the end date input
            if(ins == 'campStart'){
                document.getElementById('input-campaign-end').min = minDate;
            }
            else if(ins == 'campEnd'){
                document.getElementById('input-competition-start').min = minDate;
            }
            else if(ins == 'comStart'){
                document.getElementById('input-competition-end').min = minDate; 
            }
        }
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
            } else {
                document.getElementById("group-size-div").style.display = "none";
            }

        
    }
</script>
<script>
    var dropdownCountPrize = 0;
    var dropdownCountVariant = 0;
    
    function addDropdownPrize(index) {
        var prizeCount = document.getElementById('dropdownCountPrize-'+index);        
        var dropdownList = document.getElementById('dropdown-list-variant-'+index+'-prize');
        var newDropdownCard = createDropdownCardPrize(index,prizeCount.value);
        dropdownList.appendChild(newDropdownCard);
        toggleDropdownPrize(index,prizeCount.value);
        if(prizeCount.value > 0){
            var dropdownContent = document.getElementById('dropdown-variant-'+index+'-prize-content-' + (prizeCount.value-1));
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
        prizeCount.value++;
    }

    function createDropdownCardPrize(vIndex,pIndex) {
        var newDropdownCard = document.createElement('li');
        newDropdownCard.className = 'list-group-item bg-primary';
        newDropdownCard.innerHTML = `
            <div class="bg-primary">
                <h5 class="text-white" onclick="toggleDropdownPrize(${vIndex},${pIndex})">Prize ${(pIndex*1+1)}</h5>
                <div class="dropdown-variant-${vIndex}-prize-content-${pIndex} text-white" style="display: none;" id="dropdown-variant-${vIndex}-prize-content-${pIndex}">
                    <div class="form-group{{ $errors->has('input-variant-${vIndex}-prize-${pIndex}-rank') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-variant-${vIndex}-prize-${pIndex}-rank">{{ __('Prize for Rank no') }}</label>
                        <input type="number" name="input-variant-${vIndex}-prize-${pIndex}-rank" id="input-variant-${vIndex}-prize-${pIndex}-rank" class="form-control form-control-alternative{{ $errors->has('input-variant-${vIndex}-prize-${pIndex}-rank') ? ' is-invalid' : '' }}"   value='${(pIndex*1+1)}' required readonly autofocus>

                        @if ($errors->has('input-variant-${vIndex}-prize-${pIndex}-rank'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-variant-${vIndex}-prize-${pIndex}-rank') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-variant-${vIndex}-prize-${pIndex}-money') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-variant-${vIndex}-prize-${pIndex}-money">{{ __('Prize money nominal') }}</label>
                        <input type="number" name="input-variant-${vIndex}-prize-${pIndex}-money" id="input-variant-${vIndex}-prize-${pIndex}-money" class="form-control form-control-alternative{{ $errors->has('input-variant-${vIndex}-prize-${pIndex}-money') ? ' is-invalid' : '' }}"   placeholder="{{ __('Prize money nominal') }}" min=0 required autofocus>

                        @if ($errors->has('input-variant-${vIndex}-prize-${pIndex}-money'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-variant-${vIndex}-prize-${pIndex}-money') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-variant-${vIndex}-prize-${pIndex}-other') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-variant-${vIndex}-prize-${pIndex}-other">{{ __('Prize other than money') }}</label>
                        <textarea name="input-variant-${vIndex}-prize-${pIndex}-other" id="input-variant-${vIndex}-prize-${pIndex}-other" class="form-control form-control-alternative{{ $errors->has('input-variant-${vIndex}-prize-${pIndex}-other') ? ' is-invalid' : '' }}"   placeholder="{{ __('Prize other than money') }}" autofocus></textarea>

                        @if ($errors->has('input-variant-${vIndex}-prize-${pIndex}-other'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-variant-${vIndex}-prize-${pIndex}-other') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        `;
        return newDropdownCard;
    }

    function toggleDropdownPrize(vIndex,pIndex) {
        var dropdownContent = document.getElementById('dropdown-variant-'+vIndex+'-prize-content-'+pIndex);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }

    function addDropdownVariant() {
        var dropdownList = document.getElementById('dropdown-list-variant');
        var newDropdownCard = createDropdownCardVariant(dropdownCountVariant);
        dropdownList.appendChild(newDropdownCard);
        toggleDropdownVariant(dropdownCountVariant);
        if(dropdownCountVariant > 0){
            var dropdownContent = document.getElementById('dropdown-variant-content-' + (dropdownCountVariant-1));
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
        dropdownCountVariant++;
        document.getElementById('dropdownCountVariant').value = dropdownCountVariant;
    }

    function createDropdownCardVariant(index) {
        var newDropdownCard = document.createElement('li');
        newDropdownCard.className = 'list-group-item bg-primary';
        newDropdownCard.innerHTML = `
            <div class="bg-primary">
                <h5 class="text-white" onclick="toggleDropdownVariant(${index})">variant ${(index+1)}</h5>
                <div class="dropdown-content text-white" style="display: none;" id="dropdown-variant-content-${index}">
                    <div class="form-group{{ $errors->has('input-variant-name-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-variant-name-${index}">{{ __('variant name') }}</label>
                        <input type="text" name="input-variant-name-${index}" id="input-variant-name-${index}" class="form-control form-control-alternative{{ $errors->has('input-variant-name-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('variant name') }}" required autofocus>

                        @if ($errors->has('input-variant-name-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-variant-name-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-variant-price-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-variant-price-${index}">{{ __('Registration price') }}</label>
                        <input type="text" name="input-variant-price-${index}" id="input-variant-price-${index}" class="form-control form-control-alternative{{ $errors->has('input-variant-price-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Registration price') }}" required autofocus>

                        @if ($errors->has('input-variant-price-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-variant-price-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group{{ $errors->has('input-variant-min-age-${index}') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-variant-min-age-${index}">{{ __('variant min age') }}</label>
                                <input type="number" name="input-variant-min-age-${index}" id="input-variant-min-age-${index}" class="form-control form-control-alternative{{ $errors->has('input-variant-min-age-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-variant-min-age-${index}'] ?? '' }}" placeholder="{{ __('variant min age') }}" min=0 required>

                                @if ($errors->has('input-variant-min-age-${index}'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-variant-min-age-${index}') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('input-variant-max-age-${index}') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-variant-max-age-${index}">{{ __('variant max age') }}</label>
                                <input type="number" name="input-variant-max-age-${index}" id="input-variant-max-age-${index}" class="form-control form-control-alternative{{ $errors->has('input-variant-max-age-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-variant-max-age-${index}'] ?? '' }}" placeholder="{{ __('variant max age') }}" min=0 required>        
                                @if ($errors->has('input-variant-max-age-${index}'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-variant-max-age-${index}') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('input-variant-slot-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-variant-slot-${index}">{{ __('variant slot') }}</label>
                        <input type="number" name="input-variant-slot-${index}" id="input-variant-slot-${index}" class="form-control form-control-alternative{{ $errors->has('input-variant-slot-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('variant slot') }}" required autofocus>

                        @if ($errors->has('input-variant-slot-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-variant-slot-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <div class="form-group{{ $errors->has('input-prize') ? ' has-danger' : '' }} pl-2">
                            <button class="form-control-label" onclick="addDropdownPrize(${index})">{{ __('Prize') }} <i class="ni ni-fat-add"></i></button>
                            <ul id="dropdown-list-variant-${index}-prize" class="list-group mt-3 bg-blue"></ul>
                            <input type="hidden" name="dropdownCountPrize-${index}" id="dropdownCountPrize-${index}" value="0">
                        </div>
                    </div>
                    
                </div>
            </div>
        `;
        return newDropdownCard;
    }

    function toggleDropdownVariant(index) {
        var dropdownContent = document.getElementById('dropdown-variant-content-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
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
