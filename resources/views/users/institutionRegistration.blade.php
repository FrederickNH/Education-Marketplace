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
        <form method="post" action="{{ route('institutionAdd') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')    
            <div class="row justify-content-center">   
                <div class="col-xl-10 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __('Register as Tutoring Institution') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('Institution Detail') }}</h6>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Institution Name') }}</label>
                                    <input type="text" name="input-name" id="input-name" class="form-control form-control-alternative{{ $errors->has('input-name') ? ' is-invalid' : '' }}"   placeholder="{{ __('Institution Name') }}" required autofocus>

                                    @if ($errors->has('input-name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-picture') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-picture">{{ __('Picture File') }}</label>
                                    <input type="file" name="input-picture" id="input-picture" class="form-control form-control-alternative{{ $errors->has('input-picture') ? ' is-invalid' : '' }}" placeholder="{{ __('Picture File') }}">
            
                                    @if ($errors->has('input-picture'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-picture') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Institution Description') }}</label>
                                    <textarea name="input-description" id="input-description" class="form-control form-control-alternative{{ $errors->has('input-description') ? ' is-invalid' : '' }}"   placeholder="{{ __('Institution Description') }}" required autofocus></textarea>

                                    @if ($errors->has('input-description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Institution Address') }}</label>
                                    <input type="text" name="input-address" id="location-input" class=" col form-control form-control-alternative{{ $errors->has('input-address') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-address'] ?? '' }}"   placeholder="{{ __('Institution Address') }}" required autofocus>
                                    <button type="button" class=" col btn btn-primary" data-toggle="modal" data-target="#imageModal" id="btnShowMap">
                                        {{__('View Map')}}
                                    </button>
                                    @if ($errors->has('input-address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-address') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-school-city') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-school-city">{{ __('City') }}</label>
                                    <select name="input-city" id="input-school-city" class="form-control form-control-alternative{{ $errors->has('input-school-city') ? ' is-invalid' : '' }}" onchange="getSubcategories()" required>
                                        <option value=''>--Select City--</option>
                                        @foreach ($cityList as $city)
                                        <option value="{{$city->id}}"  {{$sessionData != null ? ($sessionData['input-school-city'] == $city->id ? 'selected' : '' ) : '' }} >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pl-lg-2">
                                <div class="form-group{{ $errors->has('input-school-subDistrict') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-school-subDistrict">{{ __('Sub District') }}</label>
                                    <select name="input-subDistrict" id="input-school-subDistrict" class="form-control form-control-alternative{{ $errors->has('input-school-subDistrict') ? ' is-invalid' : '' }}" required>
                                        <option value=''>--Select Sub District--</option>
                                    </select>
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
                                        <h3 class="mb-0">{{ __('Awards') }}</h3>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end">
                                            <button class="btn btn-primary" onclick="addDropdown()">Add Award</button>
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
                                                    <input typex="time" name="schedule-start-time-6" id="input-schedule-start-time-6" class="form-control form-control-alternative" placeholder="Start Time"  autofocus="">
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
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save Institution Info') }}</button>
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
                <h5 class="text-white" onclick="toggleDropdown(${index})">Award ${(index+1)}</h5>
                <div class="dropdown-content text-white" style="display: none;" id="dropdown-content-${index}">
                    <div class="form-group{{ $errors->has('input-award-title-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-award-${index}">{{ __('Award Title') }}</label>
                        <input type="text" name="input-award-title-${index}" id="input-award-title-${index}" class="form-control form-control-alternative{{ $errors->has('input-award-title-${index}') ? ' is-invalid' : '' }}"   placeholder="{{ __('Award Title') }}" required autofocus>

                        @if ($errors->has('input-award-title-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-award-title-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-award-certificate-issued-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-award-certificate-issued-${index}">{{ __('Certificate Issued') }}</label>
                        <input type="month" name="input-award-certificate-issued-${index}" id="input-award-certificate-issued-${index}" class="form-control form-control-alternative{{ $errors->has('input-award-certificate-issued-${index}') ? ' is-invalid' : '' }}" value="{{ $sessionData['input-award-certificate-issued-${index}'] ?? '' }}" placeholder="{{ __('Certificate Issued') }}" required>        
                        @if ($errors->has('input-award-certificate-issued-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-award-certificate-issued-${index}') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('input-award-certificate-${index}') ? ' has-danger' : '' }}">
                        <label class="form-control-label text-white" for="input-award-certificate-${index}">{{ __('Certificate File') }}</label>
                        <input type="file" name="input-award-certificate-${index}" id="input-award-certificate-${index}" class="form-control form-control-alternative{{ $errors->has('input-award-certificate-${index}') ? ' is-invalid' : '' }}" placeholder="{{ __('Certificate File') }}">

                        @if ($errors->has('input-award-certificate-${index}'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('input-award-certificate-${index}') }}</strong>
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
        // 'street_number': 'short_name',
        'route': 'long_name',
        // 'locality': 'long_name',
        // 'administrative_area_level_1': 'short_name',
        // 'country': 'long_name',
        // 'postal_code': 'short_name',
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