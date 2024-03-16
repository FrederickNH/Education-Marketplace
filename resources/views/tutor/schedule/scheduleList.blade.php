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
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                <h3 class="mb-0">{{__('Schedule List')}}</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="day">Day</th>
                        <th scope="col" class="sort" data-sort="startTime">Start Time</th>
                        <th scope="col" class="sort" data-sort="endTime">End Time</th>
                        <th scope="col" class="sort" data-sort="brerakTime">Break Time</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($scheduleList as $schedule)
                    <tr>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$schedule->day_of_the_week}}</span>
                            </div>
                            </div>
                        </td>
                        @if ($schedule->start_time !=null)
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$schedule->start_time}}</span>
                            </div>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$schedule->end_time}}</span>
                            </div>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$schedule->start_break_time}} - {{$schedule->end_break_time}}</span>
                            </div>
                            </div>
                        </td>
                        @else
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{__('No Schedule')}}</span>
                            </div>
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        @endif
                        <td class="text-right">
                            <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="edit-btn dropdown-item text-primary" data-toggle="modal" data-target="#editModal" data-item-id="{{ $schedule->id }}">Edit</a> 
                                <a class="clear-btn dropdown-item text-warning" data-item-id="{{$schedule->id}}" href="#">Clear Schedule</a>
                            </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
            
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="editForm" method="POST" action="{{ route('scheduleUpdate') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="editItemId" name="editItemId">
                                <div class="form-group">
                                    <label for="editField">Start Time:</label>
                                    <input type="time" class="form-control" id="editStartTime" name="editStartTime">
                                </div>
                                <div class="form-group">
                                    <label for="editField">End Time:</label>
                                    <input type="time" class="form-control" id="editEndTime" name="editEndTime">
                                </div>
                                <div class="form-group">
                                    <label for="editField">Break Time Start:</label>
                                    <input type="time" class="form-control" id="editStartBreakTime" name="editStartBreakTime">
                                </div>
                                <div class="form-group">
                                    <label for="editField">Break Time End:</label>
                                    <input type="time" class="form-control" id="editEndBreakTime" name="editEndBreakTime">
                                </div>  
                                <!-- Add more form fields for editing data as needed -->
                            </form>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" form="editForm" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
                            
            </div>
        </div>
        <br><br><br><br>
        <div class="row justify-content-end mr-1 mb-4">
            <div>
                <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#addModal">
                <i class="ni ni-fat-add"></i>
                <span>Add Day Off</span>
                </a>  
            </div>
        </div>
        <div class="row">
                <div class="col">
                  <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                      <h3 class="mb-0">{{__('Day Off List')}}</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                      <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" class="sort" data-sort="day">Day</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="list">
                          @foreach($holidayList as $holiday)
                          <tr>
                              <td scope="row">
                                  <div class="media align-items-center">
                                  <div class="media-body">
                                      <span class="name mb-0 text-sm">{{$holiday->date}}</span>
                                  </div>
                                  </div>
                              </td>
                              <td></td>
                              <td class="text-right">
                                  <div class="dropdown">
                                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <a class="clear-btn dropdown-item text-warning" data-item-id="{{$holiday->id}}" href="#">Delete Date</a>
                                  </div>
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                  
                    </div>
                  </div>
            
                  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">{{__('Add Day Off')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="addForm" method="POST" action="{{ route('holidayAdd') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group{{ $errors->has('holiday') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-holiday">{{ __('Holiday Date') }}</label>
                                        <input type="date" name="holiday" id="input-holiday" class="form-control form-control-alternative{{ $errors->has('holiday') ? ' is-invalid' : '' }}"  placeholder="{{ __('Day off Date') }}" required autofocus>
            
                                        @if ($errors->has('holiday'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('holiday') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <!-- Add more form fields for editing data as needed -->
                                    {{-- <button type="submit" form="addForm" class="btn btn-primary">Save Data</button> --}}
                                </form>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="addForm" class="btn btn-primary">Save Data</button>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
              </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#close-button').click(function() {
            $('#status-messages').hide();
        });
    $('.edit-btn').click(function () {
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
                $('#editStartBreakTime').attr({
                    'min': data.start_time,
                    'max': data.end_time
                });
                $('#editEndBreakTime').attr({
                    'min': data.start_break_time,
                    'max': data.end_time
                });
            }
        });
    });
    $('#editStartTime, #editEndTime').change(function () {
        // Get the values of the start time and max time inputs
        var startTime = $('#editStartTime').val();
        var endTime = $('#editEndTime').val();
        console.log(startTime,endTime);
        // Set the min and max attributes of the end time input
        $('#editStartBreakTime').attr({
            'min': startTime,
            'max': endTime
        });
    });
    $('.clear-btn').click(function () {
        var itemId = $(this).data('item-id');
        // Fetch item data from the server using AJAX
        $.ajax({
            url: '/scheduleClear/' + itemId, // Replace with your route to fetch item data
            type: 'GET',
            success: function (data) {
                location.reload();
            }
        });
    });
});

</script>
