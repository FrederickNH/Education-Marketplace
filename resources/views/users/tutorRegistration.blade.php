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
        <form method="post" action="{{ route('tutorAdd') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')    
            <div class="row justify-content-center">   
                <div class="col-xl-10 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __('Register as Tutor') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('Tutor Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Profile Description') }}</label>
                                    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"   placeholder="{{ __('Profile Description') }}" required autofocus></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
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
                                        <h3 class="mb-0">{{ __('Experience') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <button class="btn btn-primary" onclick="addDropdown()">Add Experiences</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                

                                <ul id="dropdown-list" class="list-group mt-3 bg-blue"></ul>
                                    <div class="dropdown-menu dropdown-headerTutor" onclick="toggleDropdown(${dropdownCount})">Header ${dropdownCount}</div>
                                    <div class="dropdown-content" style="display: none;" id="dropdown-content-${dropdownCount}">
                                        Inside Div ${dropdownCount} <br>
                                        <input type="text" id="input-${dropdownCount}" placeholder="Enter data">
                                    </div>
                                <input type="hidden" name="dropdownCount" id="dropdownCount" value="0">
                            </div>
                        </div>
                    </div>
                    
                </div>
                {{-- <div class="col-xl-10 order-xl-1">
                    <div>
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Certificate') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <button class="btn btn-primary" onclick="addDropdownCertificate()">Add Certificate</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <ul id="dropdown-list-certificate" class="list-group mt-3 bg-blue"></ul>
                                    <div class="dropdown-menu dropdown-headerTutor" onclick="toggleDropdown(${dropdownCountCertificate})">Header ${dropdownCountCertificate}</div>
                                    <div class="dropdown-content" style="display: none;" id="dropdown-content-${dropdownCountCertificate}">
                                        Inside Div ${dropdownCountCertificate} <br>
                                        <input type="text" id="input-${dropdownCountCertificate}" placeholder="Enter data">
                                    </div>  
                                <input type="hidden" name="dropdownCountCertificate" id="dropdownCountCertificate" value="0">
                            </div>
                        </div>
                    </div>
                    
                </div> --}}
                <div class="col-xl-10 order-xl-1">
                    <div>
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Academic Histories') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <button class="btn btn-primary" onclick="addDropdownAcademic()">{{__('Add Academic History')}}</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <ul id="dropdown-list-academic" class="list-group mt-3 bg-blue"></ul>
                                    <div class="dropdown-menu dropdown-headerTutor" onclick="toggleDropdown(${dropdownCountAcademic})">Header ${dropdownCountAcademic}</div>
                                    <div class="dropdown-content" style="display: none;" id="dropdown-content-${dropdownCountAcademic}">
                                        Inside Div ${dropdownCountAcademic} <br>
                                        <input type="text" id="input-${dropdownCountAcademic}" placeholder="Enter data">
                                    </div>  
                                <input type="hidden" name="dropdownCountAcademic" id="dropdownCountAcademic" value="0">
                                <input type="hidden" name="dropdownCountHistory" id="dropdownCountHistory" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 order-xl-1">
                    <div>
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Schedules') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul id="dropdown-list-schedule" class="list-group mt-3 bg-blue">
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(0)">{{__('Monday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-0">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-0">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-0" id="input-schedule-start-time-0" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-0">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-0" id="input-schedule-end-time-0" class="form-control form-control-alternative" placeholder="End Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-0">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-0" id="input-schedule-start-break-time-0" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-0">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-0" id="input-schedule-end-break-time-0" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(1)">{{__('Tuesday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-1">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-1">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-1" id="input-schedule-start-time-1" class="form-control form-control-alternative" placeholder="Start Time" autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-1">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-1" id="input-schedule-end-time-1" class="form-control form-control-alternative" placeholder="End Time" autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-1">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-1" id="input-schedule-start-break-time-1" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-1">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-1" id="input-schedule-end-break-time-1" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(2)">{{__('Wednesday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-2">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-2">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-2" id="input-schedule-start-time-2" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-2">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-2" id="input-schedule-end-time-2" class="form-control form-control-alternative" placeholder="End Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-2">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-2" id="input-schedule-start-break-time-2" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-2">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-2" id="input-schedule-end-break-time-2" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(3)">{{__('Thursday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-3">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-3">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-3" id="input-schedule-start-time-3" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-3">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-3" id="input-schedule-end-time-3" class="form-control form-control-alternative" placeholder="End Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-3">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-3" id="input-schedule-start-break-time-3" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-3">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-3" id="input-schedule-end-break-time-3" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(4)">{{__('Friday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-4">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-4">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-4" id="input-schedule-start-time-4" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-4">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-4" id="input-schedule-end-time-4" class="form-control form-control-alternative" placeholder="End Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-4">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-4" id="input-schedule-start-break-time-4" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-4">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-4" id="input-schedule-end-break-time-4" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(5)">{{__('Saturday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-5">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-5">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-5" id="input-schedule-start-time-5" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-5">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-5" id="input-schedule-end-time-5" class="form-control form-control-alternative" placeholder="End Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-5">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-5" id="input-schedule-start-break-time-5" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-5">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-5" id="input-schedule-end-break-time-5" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-primary">
                                        <div class="bg-primary">
                                            <h5 class="text-white" onclick="toggleDropdownSchedule(6)">{{__('Sunday')}}</h5>
                                            <div class="dropdown-content-schedule text-white" style="display: none;" id="dropdown-content-schedule-6">
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-time-6">{{__('Start Time')}}</label>
                                                    <input type="time" name="schedule-start-time-6" id="input-schedule-start-time-6" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-time-6">{{__('End Time')}}</label>
                                                    <input type="time" name="schedule-end-time-6" id="input-schedule-end-time-6" class="form-control form-control-alternative" placeholder="End Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-start-break-time-6">{{__('Start Break Time')}}</label>
                                                    <input type="time" name="schedule-start-break-time-6" id="input-schedule-start-break-time-6" class="form-control form-control-alternative" placeholder="Start Break Time"  autofocus="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label text-white" for="input-schedule-end-break-time-6">{{__('End Break Time')}}</label>
                                                    <input type="time" name="schedule-end-break-time-6" id="input-schedule-end-break-time-6" class="form-control form-control-alternative" placeholder="End Break Time"  autofocus="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <input type="hidden" name="dropdownCountAcademic" id="dropdownCountAcademic" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 order-xl-1">
                    <div>
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Teaching Subject') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <button class="btn btn-primary" onclick="addDropdownSubject()">Add Subject</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul id="dropdown-list-subject" class="list-group mt-3 bg-blue"></ul>
                                <input type="hidden" name="dropdownCountSubject" id="dropdownCountSubject" value="0">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xl-10 order-xl-1">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save Tutoring Info') }}</button>
                    </div>
                </div>
            
            </div>
        </form>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var dropdownCount = 0;
    var dropdownCountCertificate = 0;
    var dropdownCountAcademic = 0;
    var dropdownCountHistory = 0;
    var dropdownCountSubject = 0;
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
                <h5 class="text-white" onclick="toggleDropdown(${index})">Experience ${(index+1)}</h5>
                <div class="dropdown-content text-white" style="display: none;" id="dropdown-content-${index}">
                    <div class="form-group{{ $errors->has('input-company-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-company-${index}">{{ __('Company name') }}</label>
                        <input type="text" name="company-${index}" id="input-company-${index}" class="form-control form-control-alternative{{ $errors->has('input-company-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Company name') }}" required autofocus>

                        @if ($errors->has('input-company-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-company-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-position-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-position-${index}">{{ __('Job Position') }}</label>
                        <input type="text" name="position-${index}" id="input-position-${index}" class="form-control form-control-alternative{{ $errors->has('input-position-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Job Position') }}" required autofocus>

                        @if ($errors->has('input-position-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-position-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-description-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-description-${index}">{{ __('Job Description') }}</label>
                        <textarea name="description-${index}" id="input-description-${index}" class="form-control form-control-alternative{{ $errors->has('input-description-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Job Description') }}" required autofocus></textarea>

                        @if ($errors->has('input-description-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-description-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-start-month-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-start-month-${index}">{{ __('Start Working') }}</label>
                        <input type="month" name="start-month-${index}" id="input-start-month-${index}" class="form-control form-control-alternative{{ $errors->has('input-start-month-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-start-month-${index}'] ?? '' }}" placeholder="{{ __('Start Working') }}" required>        
                        @if ($errors->has('input-start-month-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-start-month-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-end-month-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-end-month-${index}">{{ __('End Working') }}</label>
                        <input type="month" name="end-month-${index}" id="input-end-month-${index}" class="form-control form-control-alternative{{ $errors->has('input-end-month-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-end-month-${index}'] ?? '' }}" placeholder="{{ __('End Working') }}" required>        
                        @if ($errors->has('input-end-month-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-end-${index}') }}</strong>
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


    function addDropdownCertificate() {
        var dropdownList = document.getElementById('dropdown-list-certificate');
        var newDropdownCard = createDropdownCardCertificate(dropdownCountCertificate);
        dropdownList.appendChild(newDropdownCard);
        toggleDropdownCertificate(dropdownCountCertificate);
        if(dropdownCountCertificate > 0){
            var dropdownContent = document.getElementById('dropdown-content-certificate-' + (dropdownCountCertificate-1));
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
        dropdownCountCertificate++;
        document.getElementById('dropdownCountCertificate').value = dropdownCountCertificate;
    }

    function createDropdownCardCertificate(index) {
        var newDropdownCard = document.createElement('li');
        newDropdownCard.className = 'list-group-item bg-primary';
        newDropdownCard.innerHTML = `
            <div class="bg-primary">
                <h5 class="text-white" onclick="toggleDropdownCertificate(${index})">Certificate ${(index+1)}</h5>
                <div class="dropdown-content-certificate text-white" style="display: none;" id="dropdown-content-certificate-${index}">
                    <div class="form-group{{ $errors->has('input-certificate-title-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-certificate-title-${index}">{{ __('Certitificate Title') }}</label>
                        <input type="text" name="certificate-title-${index}" id="input-certificate-title-${index}" class="form-control form-control-alternative{{ $errors->has('input-certificate-title-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Certificate Title') }}" required autofocus>

                        @if ($errors->has('input-certificate-title-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-certificate-title-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-certificate-issued-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-certificate-issued-${index}">{{ __('Certificate Issued') }}</label>
                        <input type="month" name="certificate-issued-${index}" id="input-certificate-issued-${index}" class="form-control form-control-alternative{{ $errors->has('input-certificate-issued-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-certificate-issued-${index}'] ?? '' }}" placeholder="{{ __('Certificate Issued') }}" required>        
                        @if ($errors->has('input-certificate-issued-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-certificate-issued-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-certificate-file-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-certificate-file-${index}">{{ __('Certificate File') }}</label>
                        <input type="file" name="certificate-file-${index}" id="input-certificate-file-${index}" class="form-control form-control-alternative{{ $errors->has('input-certificate-file-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('Certificate File') }}">

                        @if ($errors->has('input-certificate-file-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-certificate-file-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        `;
        return newDropdownCard;
    }

    function toggleDropdownCertificate(index) {
        var dropdownContent = document.getElementById('dropdown-content-certificate-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }


    function addDropdownAcademic() {
        var dropdownList = document.getElementById('dropdown-list-academic');
        var newDropdownCard = createDropdownCardAcademic(dropdownCountAcademic);
        dropdownList.appendChild(newDropdownCard);
        toggleDropdownAcademic(dropdownCountAcademic);
        if(dropdownCountAcademic > 0){
            var dropdownContent = document.getElementById('dropdown-content-academic-' + (dropdownCountAcademic-1));
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
        dropdownCountAcademic++;
        document.getElementById('dropdownCountAcademic').value = dropdownCountAcademic;
        dropdownCountHistory++;
        document.getElementById('dropdownCountHistory').value = dropdownCountHistory;
        
    }

    function createDropdownCardAcademic(index) {
        var newDropdownCard = document.createElement('li');
        newDropdownCard.className = 'list-group-item bg-primary';
        newDropdownCard.innerHTML = `
            <div class="bg-primary">
                <h5 class="text-white" onclick="toggleDropdownAcademic(${index})">History ${(index+1)}</h5>
                <div class="dropdown-content-academic text-white" style="display: none;" id="dropdown-content-academic-${index}">
                    <div class="form-group{{ $errors->has('input-academic-school-select') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-academic-school-select">{{ __('Select School') }}</label>
                        <input list="academic-school-selects" name="input-academic-school-select-${index}" id="input-academic-school-select" class="form-control form-control-alternative{{ $errors->has('input-academic-school-select') ? ' is-invalid' : '' }}" placeholder="{{ __('Select School') }}" required>
                        <datalist id="academic-school-selects">
                            @foreach ($schoolList as $school)
                                <option value="{{$school->school_name}}"  {{$sessionData != null ? ($sessionData['school_id'] == $school->id ? 'selected' : '' ) : '' }} >
                            @endforeach
                        </datalist>
                    </div>
                    <div class="form-group{{ $errors->has('input-academic-graduated-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-academic-graduated-${index}">{{ __('Year Graduated') }}</label>
                        <input type="month" name="academic-graduated-${index}" id="input-academic-graduated-${index}" class="form-control form-control-alternative{{ $errors->has('input-academic-graduated-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-academic-graduated-${index}'] ?? '' }}" placeholder="{{ __('Graduated Year') }}" required>        
                        @if ($errors->has('input-academic-graduated-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-academic-graduated-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-academic-certificate-title-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-academic-certificate-title-${index}">{{ __('Certitificate Title') }}</label>
                        <input type="text" name="academic-certificate-title-${index}" id="input-academic-certificate-title-${index}" class="form-control form-control-alternative{{ $errors->has('input-academic-certificate-title-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Certificate Title') }}" required autofocus>

                        @if ($errors->has('input-academic-certificate-title-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-academic-certificate-title-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-academic-certificate-issued-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-academic-certificate-issued-${index}">{{ __('Certificate Issued') }}</label>
                        <input type="month" name="academic-certificate-issued-${index}" id="input-academic-certificate-issued-${index}" class="form-control form-control-alternative{{ $errors->has('input-academic-certificate-issued-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-academic-certificate-issued-${index}'] ?? '' }}" placeholder="{{ __('Certificate Issued') }}" required>        
                        @if ($errors->has('input-academic-certificate-issued-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-academic-certificate-issued-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-academic-certificate-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-academic-certificate-${index}">{{ __('Certificate File') }}</label>
                        <input type="file" name="academic-certificate-${index}" id="input-academic-certificate-${index}" class="form-control form-control-alternative{{ $errors->has('input-academic-certificate-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('Certificate File') }}">

                        @if ($errors->has('input-academic-certificate-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-academic-certificate-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        `;
        return newDropdownCard;
    }

    function toggleDropdownAcademic(index) {
        var dropdownContent = document.getElementById('dropdown-content-academic-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }

    
    function toggleDropdownSchedule(index) {
        var dropdownContent = document.getElementById('dropdown-content-schedule-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }


    function addDropdownSubject() {
        var dropdownList = document.getElementById('dropdown-list-subject');
        var newDropdownCard = createDropdownCardSubject(dropdownCountSubject);
        dropdownList.appendChild(newDropdownCard);
        toggleDropdownSubject(dropdownCountSubject);
        if(dropdownCountSubject > 0){
            var dropdownContent = document.getElementById('dropdown-content-subject-' + (dropdownCountSubject-1));
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
        dropdownCountSubject++;
        document.getElementById('dropdownCountSubject').value = dropdownCountSubject;
    }

    function createDropdownCardSubject(index) {
        var newDropdownCard = document.createElement('li');
        newDropdownCard.className = 'list-group-item bg-primary';
        newDropdownCard.innerHTML = `
            <div class="bg-primary">
                <h5 class="text-white" onclick="toggleDropdownSubject(${index})">Subject ${(index+1)}</h5>
                <div class="dropdown-content-subject text-white" style="display: none;" id="dropdown-content-subject-${index}">
                    <div class="form-group{{ $errors->has('input-subject-select-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-subject-select-${index}">{{ __('Select Subject') }}</label>
                        <input list="subject-list-selects" name="input-subject-select-${index}" id="input-subject-select-${index}" class="form-control form-control-alternative{{ $errors->has('input-subject-select-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('Select Subject') }}" required>
                        <datalist id="subject-list-selects">
                            @foreach ($subjectList as $subject)
                                <option value="{{$subject->name}}"  {{$sessionData != null ? ($sessionData['subject_id'] == $subject->id ? 'selected' : '' ) : '' }} >
                            @endforeach
                        </datalist>
                    </div>
                    <div class="form-group{{ $errors->has('input-subject-grade-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-subject-grade-${index}">{{ __('Grade') }}</label>
                        <select name="subject-grade-${index}" id="input-subject-grade-${index}" class="form-control form-control-alternative{{ $errors->has('input-subject-grade-${index}') ? ' is-invalid' : '' }}" required>
                            <option value=''>--Select Grade--</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group{{ $errors->has('input-subject-certificate-title-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-subject-certificate-title-${index}">{{ __('Certitificate Title') }}</label>
                        <input type="text" name="subject-certificate-title-${index}" id="input-subject-certificate-title-${index}" class="form-control form-control-alternative{{ $errors->has('input-subject-certificate-title-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Certificate Title') }}" required autofocus>

                        @if ($errors->has('input-subject-certificate-title-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-subject-certificate-title-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-subject-certificate-issued-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-subject-certificate-issued-${index}">{{ __('Certificate Issued') }}</label>
                        <input type="month" name="subject-certificate-issued-${index}" id="input-subject-certificate-issued-${index}" class="form-control form-control-alternative{{ $errors->has('input-subject-certificate-issued-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-subject-certificate-issued-${index}'] ?? '' }}" placeholder="{{ __('Certificate Issued') }}" required>        
                        @if ($errors->has('input-subject-certificate-issued-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-subject-certificate-issued-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-subject-certificate-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-subject-certificate-${index}">{{ __('Certificate File') }}</label>
                        <input type="file" name="subject-certificate-${index}" id="input-subject-certificate-${index}" class="form-control form-control-alternative{{ $errors->has('input-subject-certificate-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('Certificate File') }}">

                        @if ($errors->has('input-subject-certificate-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-subject-certificate-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        `;
        return newDropdownCard;
    }

    function toggleDropdownSubject(index) {
        var dropdownContent = document.getElementById('dropdown-content-subject-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
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