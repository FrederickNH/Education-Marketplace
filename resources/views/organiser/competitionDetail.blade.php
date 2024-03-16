@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-5">
    <div class="container py-5">             
        <div class="card card-profile shadow">
            <div class="card-body pt-0 pt-md-4">
                <div class="row">
                    <div class="col-lg-5">
                        <img src="{{ asset('assets') }}/img/{{$competition->brochure}}" class="brochure-img">
                    </div>
                    <div class="col-lg-6 ml-2">
                        <h3>Detail :</h3>
                        <div class="col">
                            <div class="form-group{{ $errors->has('input-competition-title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-competition-title">{{ __('Competition Title') }}</label>
                                <input type="text" name="input-competition-title" id="input-competition-title" class="form-control form-control-alternative{{ $errors->has('input-competition-title') ? ' is-invalid' : '' }}" placeholder="{{ __('Competition Title') }}" value="{{$competition->title}}" readonly required>        
                                @if ($errors->has('input-competition-title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-competition-title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('input-competition-subject') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-competition-subject">{{ __('Competition Subject') }}</label>
                                <input type="text" name="input-competition-title" id="input-competition-title" class="form-control form-control-alternative{{ $errors->has('input-competition-subject') ? ' is-invalid' : '' }}" placeholder="{{ __('Competition Subject') }}" value="{{$competition->subjectName}}" readonly required>        
                                @if ($errors->has('input-competition-subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-competition-subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('input-competition-description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-competition-description">{{ __('Competition Description') }}</label>
                                <textarea name="input-competition-description" id="input-competition-description" class="form-control form-control-alternative{{ $errors->has('input-competition-description') ? ' is-invalid' : '' }}" placeholder="{{ __('Competition Description') }}" value="" readonly required>{{$competition->description}}</textarea>        
                                @if ($errors->has('input-competition-description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-competition-description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('input-competition-member') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-competition-member">{{ __('Allowed Member') }}</label>
                                <input type="number" name="input-competition-member" id="input-competition-member" class="form-control form-control-alternative{{ $errors->has('input-competition-member') ? ' is-invalid' : '' }}" placeholder="{{ __('Allowed Member') }}" value="{{$competition->allowed_team_member}}" readonly required>        
                                @if ($errors->has('input-competition-member'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-competition-member') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-competition-campaign-start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-competition-campaign-start">{{ __('Campaign Start') }}</label>
                                    <input type="date" name="input-competition-campaign-start" id="input-competition-campaign-start" class="form-control form-control-alternative{{ $errors->has('input-competition-campaign-start') ? ' is-invalid' : '' }}" placeholder="{{ __('Campaign Start') }}" value="{{$competition->campaign_start}}" readonly required>        
                                    @if ($errors->has('input-competition-campaign-start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-competition-campaign-start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-competition-campaign-end') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-competition-campaign-end">{{ __('Campaign End') }}</label>
                                    <input type="text" name="input-competition-campaign-end" id="input-competition-campaign-end" class="form-control form-control-alternative{{ $errors->has('input-competition-campaign-end') ? ' is-invalid' : '' }}" placeholder="{{ __('Campaign End') }}" value="{{$competition->campaign_end}}" readonly required>        
                                    @if ($errors->has('input-competition-campaign-end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-competition-campaign-end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row ml-1 mr-1">
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-competition-competition-start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-competition-competition-start">{{ __('Competition Start') }}</label>
                                    <input type="date" name="input-competition-competition-start" id="input-competition-competition-start" class="form-control form-control-alternative{{ $errors->has('input-competition-competition-start') ? ' is-invalid' : '' }}" placeholder="{{ __('Competition Start') }}" value="{{$competition->competition_start}}" readonly required>        
                                    @if ($errors->has('input-competition-competition-start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-competition-competition-start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('input-competition-campaign-end') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-competition-competition-end">{{ __('Competition End') }}</label>
                                    <input type="text" name="input-competition-competition-end" id="input-competition-competition-end" class="form-control form-control-alternative{{ $errors->has('input-competition-competition-end') ? ' is-invalid' : '' }}" placeholder="{{ __('Competition End') }}" value="{{$competition->competition_end}}" readonly required>        
                                    @if ($errors->has('input-competition-competition-end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-competition-competition-end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-lg-12 form-group{{ $errors->has('input-variant') ? ' has-danger' : '' }} pl-2">
                        <h3>{{__('Variant')}} :</h3>
                        <ul id="dropdown-list-variant" class="list-group mt-3 bg-light">
                            @foreach ($variantList as $variant)
                                <li class="list-group-item bg-light">
                                    <h5 class="" onclick="toggleDropdownVariant({{$variant->id}})">{{$variant->name}}</h5>
                                    <div style="display:none;" id="dropdown-variant-content-{{$variant->id}}">
                                        <div class="row pl-2 pr-2">
                                            <div class="col-lg-6 pt-2 bg-lighter variant-card">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-variant-price-$variant->id}}">{{ __('Price') }}</label>
                                                    <input type="number" name="input-variant-price-{{$variant->id}}" id="input-variant-price-{{$variant->id}}" class="form-control form-control-alternative"  value="{{$variant->price}}"  placeholder="{{ __('Price') }}" readonly required autofocus>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-variant-min-age-{{$variant->id}}">{{ __('Min Age') }}</label>
                                                            <input type="number" name="input-variant-min-age-{{$variant->id}}" id="input-variant-min-age-{{$variant->id}}" class="form-control form-control-alternative" placeholder="{{ __('Min Age') }}" value="{{$variant->min_age}}" readonly required>         
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-variant-max-age-{{$variant->id}}">{{ __('Max Age') }}</label>
                                                            <input type="number" name="input-variant-max-age-{{$variant->id}}" id="input-variant-max-age-{{$variant->id}}" class="form-control form-control-alternative" placeholder="{{ __('Max Age') }}" value="{{$variant->max_age}}" readonly required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-variant-slot-{{$variant->id}}">{{ __('Slot') }}</label>
                                                    <input type="number" name="input-variant-slot-{{$variant->id}}" id="input-variant-slot-{{$variant->id}}" class="form-control form-control-alternative"  value="{{$variant->slot}}"  placeholder="{{ __('Slot') }}" readonly required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 pt-2 bg-lighter">
                                                <div>
                                                    <ul class="nav nav-tabs" id="variantItemTab-{{$variant->id}}" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="variant-prize-tab-{{$variant->id}}" data-item-id="{{$variant->id}}" data-bs-toggle="tab" data-bs-target="#detail-prize-{{$variant->id}}" type="button" role="tab" aria-controls="prize" aria-selected="true">Prize</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="variant-member-tab-{{$variant->id}}" data-item-id="{{$variant->id}}" data-bs-toggle="tab" data-bs-target="#detail-member-{{$variant->id}}" type="button" role="tab" aria-controls="member" aria-selected="false">Member</button>
                                                        </li>
                                                    </ul>
                                                    <div class="variant-item-tab-content" id="variantTabContent-{{$variant->id}}">                            
                                                        <div id="detail-prize-{{$variant->id}}" class="tab-pane-{{$variant->id}} fade show active">
                                                            <div class="scrollable">
                                                                @foreach ($variant->prize as $prize)
                                                                    <div class="m-2 p-1 pill bg-white">
                                                                        <div class="row">
                                                                            <div class="col-lg-3">
                                                                                <h3>Rank : {{$prize->rank_no}}</h3>
                                                                            </div>
                                                                            <div class="col">
                                                                                <p>Prize : <span>{{$prize->money_prize}} + {{$prize->other_prize}}</span></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div id="detail-member-{{$variant->id}}" class="tab-pane-{{$variant->id}} fade">
                                                            <div class="scrollable">
                                                                @if(count($variant->member) >= 0)
                                                                    @foreach ($variant->member as $member)
                                                                        <div class="row m-2 p-1 pill">
                                                                            <div class="col">
                                                                                <h4>{{$member->pivot->team_name}}</h4>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <a href="#" data-toggle="modal" data-target="#detailModal" onclick="getMemberDetail({{$variant->id}},{{$member->pivot->user_id}})">see detail</a>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <h3>No Member Yet</h4>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Participant Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                            <div class="m-2 p-1">
                                <h1>School : <span id="detailSchool"></span></h1>
                                <h4>Registration Date : <span id="detailRegistrationDate"></span></h4>
                                <div id="participant-div">

                                </div>
                            </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .brochure-img{
        width: 400px;
        height: 620px;
    }
    .variant-card {
      border-right: 1px solid black;
    }
    .scrollable{
        max-height: 260px; /* Set the maximum height of the container */
        overflow: auto; /* Enable vertical scrolling */
    }
    .pill{
        border: 1px solid black;
        border-radius: 10px;
    }
</style>
<script>
    function toggleDropdownVariant(index) {
        var dropdownContent = document.getElementById('dropdown-variant-content-' + index);
        if (dropdownContent.style.display === 'none') {
            dropdownContent.style.display = 'block';
        } else {
            dropdownContent.style.display = 'none';
        }
    }
    function getMemberDetail(varianId,userId){
        $.ajax({
                url: '/memberGetDetail/' + varianId + '/' + userId,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#participant-div').empty();
                    $('#detailSchool').text(data[0]);
                    $('#detailRegistrationDate').text(data[1]);0
                    for (let index = 2; index < data.length; index++) {
                        var newDiv = $('<div>', {
                            'class': 'your-custom-class',  // Add any custom classes you need
                            'html': '<div>' +
                                        '<div><h3>Member '+ (index-1) +'</h3></div>'+
                                        '<div><p>Name : <span>' + data[index].name + '</span></p></div>' +
                                        '<div><p>Phone Number : <span>' + data[index].phone + '</span></p></div>' + // Adjust this based on your data
                                    '</div>' 
                        });
                        $('#participant-div').append(newDiv);
                    }
                }
            });
    }
    $(document).ready(function () {       
        $('.detail-btn').click(function () {
            var itemId = $(this).data('item-id');
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/scheduleGet/' + itemId, // Replace with your route to fetch item data
                type: 'GET',
                success: function (data) {
                    $('#editItemId').val(data.id);
                    $('#editStartTime').val(data.start_time);
                    $('#editEndTime').val(data.end_time);
                    $('#editStartBreakTime').val(data.start_break_time);
                    $('#editEndBreakTime').val(data.end_break_time);
                    // Populate other form fields as needed
                }
            });
        });
        // Show the tab content when a tab is clicked
        var tabItems = document.querySelectorAll('.nav-link');
        tabItems.forEach(function(item) {        
            item.addEventListener('click', function(event) {
                var target = item.getAttribute('data-bs-target');
                var id = item.getAttribute('data-item-id');

                var myTab = new bootstrap.Tab(document.getElementById('variantItemTab-'+id));
                myTab.show();
                
                console.log(id);
                var activeTabContent = document.querySelector('.tab-pane-'+id+'.active');
                activeTabContent.classList.remove('active', 'show');
                activeTabContent.style.display = "none";
                // item.classList.remove('active','show');
                // item.style.display
                document.querySelector(target).classList.add('active', 'show');
                var deactiveContent = document.querySelector(target);
                deactiveContent.style.display = "block";
            });
        });
    });
</script>