@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">     
        <div class="row justify-content-end mr-1 mb-4">
            <div>
              <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#addModal">
                <i class="ni ni-fat-add"></i>
                <span>{{__('Add Experience')}}</span>
              </a>  
            </div>
        </div>        
        @foreach($experienceList as $experience)
            <div class="card card-profile shadow">
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">     
                        <div class="col-md-4">
                            <img src="{{asset('assets')}}/img/office-building.png" class="card-img-top banner-img" alt="" />
                        </div>
                        <div class="col-lg-7 ml-2">
                            {{-- <div class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="edit-btn dropdown-item text-primary" data-toggle="modal" data-target="#editModal" data-item-id="{{ $experience->id }}">Edit</a> 
                                        <a class="clear-btn dropdown-item text-warning" href="facilityDelete/{{$experience->id}}">Delete</a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col">
                                <h2>{{__("Workplace")}}: {{$experience->workplace}}</h2>
                                <h4 class="text-muted">{{__('Experience Detail :')}}</h4>
                                <h5 class="ml-3">{{__('Job Position')}}: {{$experience->position}}</h5>
                                <p>Job Description : <span>{{$experience->job_description}}</span></p>
                                <p>Period : <span>{{\Carbon\Carbon::parse($experience->start_month)->format('M Y')}} - {{\Carbon\Carbon::parse($experience->end_month)->format('M Y')}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        @endforeach
        {{-- add modal --}}
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">{{__('Add Experience')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="addForm" method="POST" action="{{ route('tutorAddExperience') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group{{ $errors->has('input-workplace') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-workplace">{{ __('Company Workplace') }}</label>
                                <input type="text" name="input-workplace" id="input-workplace" class="form-control form-control-alternative{{ $errors->has('input-workplace') ? ' is-invalid' : '' }}"   placeholder="{{ __('Company Workplace') }}" required autofocus>
        
                                @if ($errors->has('input-workplace'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-workplace') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('input-position') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-position">{{ __('Job Position') }}</label>
                                <input type="text" name="input-position" id="input-position" class="form-control form-control-alternative{{ $errors->has('input-position') ? ' is-invalid' : '' }}"   placeholder="{{ __('Job Position') }}" required autofocus>
        
                                @if ($errors->has('input-position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-position') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('input-job-description') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-job-description">{{ __('Job Description') }}</label>
                                <textarea name="input-job-description" id="input-job-description" class="form-control form-control-alternative{{ $errors->has('input-job-description') ? ' is-invalid' : '' }}"   placeholder="{{ __('Job Description') }}" required autofocus></textarea>
        
                                @if ($errors->has('input-job-description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-job-description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="form-group{{ $errors->has('input-start-month') ? ' has-danger' : '' }} col-sm-6">
                                    <label class="form-control-label text-white" for="input-start-month">{{ __('Start Month') }}</label>
                                    <input type="month" name="input-start-month" id="input-start-month" class="form-control form-control-alternative{{ $errors->has('input-start-month') ? ' is-invalid' : '' }}"   placeholder="{{ __('Start Month') }}" required autofocus>
            
                                    @if ($errors->has('input-start-month'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-start-month') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('input-end-month') ? ' has-danger' : '' }} col-sm-6">
                                    <label class="form-control-label text-white" for="input-end-month">{{ __('End Month') }}</label>
                                    <input type="month" name="input-end-month" id="input-end-month" class="form-control form-control-alternative{{ $errors->has('input-end-month') ? ' is-invalid' : '' }}"   placeholder="{{ __('End Month') }}" required autofocus>
            
                                    @if ($errors->has('input-end-month'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-end-month') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
        {{-- edit modal --}}
        {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">{{__('Edit Facility Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="editForm" method="POST" action="{{ route('facilityUpdate') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editItemId" name="editItemId">
                            <div class="form-group{{ $errors->has('edit-facility-detail') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="edit-facility-detail">{{ __('Facility Detail') }}</label>
                                <input type="text" name="edit-facility-detail" id="edit-facility-detail" class="form-control form-control-alternative{{ $errors->has('edit-facility-detail') ? ' is-invalid' : '' }}"   placeholder="{{ __('Facility Detail') }}" required autofocus>
        
                                @if ($errors->has('edit-facility-detail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edit-facility-detail') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div><img id="edit-facility-picture-preview" src="" alt=""></div>
                            <div class="form-group{{ $errors->has('edit-facility-picture') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="edit-facility-picture">{{ __('Certificate File') }}</label>
                                <input type="file" name="edit-facility-picture" id="edit-facility-picture" class="form-control form-control-alternative{{ $errors->has('edit-facility-picture') ? ' is-invalid' : '' }}" placeholder="{{ __('Facility Picture') }}">
        
                                @if ($errors->has('edit-facility-picture'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edit-facility-picture') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Add more form fields for editing data as needed -->
                            <button type="submit" form="editForm" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="editForm" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var itemId = $(this).data('item-id');
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/facilityEdit/' + itemId, // Replace with your route to fetch item data
                type: 'GET',
                success: function (data) {
                    var picturePath = '{{asset("assets")}}/img/'+data.pivot.picture;
                    $('#editItemId').val(data.pivot.facility_id);
                    $('#edit-facility-picture-preview').attr('src',picturePath);
                    $('#edit-facility-detail').val(data.pivot.facility_detail);
                    // Populate other form fields as needed
                }
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
<style>
    .banner-img{
        width: 20rem;
        height: 200px;
    }
    #input-id{
        display: none;
    }
    .card{
        margin-top: 20px;
    }
</style>