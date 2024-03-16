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
            <div class="row justify-content-end mr-1 mb-4">
                <div>
                  <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#addModal">
                    <i class="ni ni-fat-add"></i>
                    <span>Add Subject</span>
                  </a>  
                </div>
            </div>
            <div class="row">                
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                        <h3 class="mb-0">{{__('Subject Teaches')}}</h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="grade">Grade</th>
                                <th scope="col" class="sort" data-sort="certificate">Certificate</th>
                                {{-- <th scope="col" class="sort" data-sort="status">Status</th> --}}
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($subjectTeachesList as $subject)
                            <tr>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{$subject->subject_name}}</span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{$subject->grade}}</span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal" onclick="setImageSrc('{{$subject->file_path}}')">
                                            {{__('View Certificate')}}
                                        </button>
                                    </div>
                                    </div>
                                </td>
                                {{-- <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        @if($subject->status == 'waitingApproval')
                                            <span class="badge badge-warning">{{__('Waiting Approval')}}</span>
                                        @elseif($subject->status == 'approved')
                                            <span class="badge badge-success">{{__('Approved')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('Declined')}}</span>
                                        @endif
                                    </div>
                                    </div>
                                </td> --}}
                                <td class="text-right">
                                    <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                                        <a class="remove-btn dropdown-item text-warning" data-item-id="{{$subject->id}}" href="#">Remove Subject</a>
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
                </div>
            </div>

    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">{{__('Add Subject')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="addForm" method="POST" action="{{ route('subjectAdd') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group{{ $errors->has('subject') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-subject">{{ __('Subject') }}</label>
                            <select name="subject" id="subject" class="form-control form-control-alternative{{ $errors->has('subject') ? ' is-invalid' : '' }}" required>
                                <option value=''>--Select Subject--</option>
                                @foreach ($subjectList as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('grade') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-grade">{{ __('Grade') }}</label>
                            <select name="grade" id="grade" class="form-control form-control-alternative{{ $errors->has('grade') ? ' is-invalid' : '' }}" required>
                                <option value=''>--Select Grade--</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('certificate') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-certificate">{{ __('Certificate') }}</label>
                            <input type="file" name="certificatefile" id="input-certifficate" class="form-control form-control-alternative{{ $errors->has('certificate') ? ' is-invalid' : '' }}" placeholder="{{ __('Certificate') }}">

                            @if ($errors->has('certificate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('certificate') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('certificate_title') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-certificate-title">{{ __('Certificate Title') }}</label>
                            <input type="text" name="certificate_title" id="input-certificate-title" class="form-control form-control-alternative{{ $errors->has('certificate_title') ? ' is-invalid' : '' }}"  placeholder="{{ __('Certifficate Title') }}" required autofocus>

                            @if ($errors->has('certificate_title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('certificate_title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <div class="form-group{{ $errors->has('date_issued') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-date-issued">{{ __('Date Issued') }}</label>
                                <input type="month" name="date_issued" id="input-date-issued" class="form-control form-control-alternative{{ $errors->has('date_issued') ? ' is-invalid' : '' }}" placeholder="{{ __('Date Issued') }}" required>
                                @if ($errors->has('date_issued'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_issued') }}</strong>
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
</div>

<!-- Certificate Modal -->
<div class="modal" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Certificate Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="previewImage" src="" alt="Image" style="width:100%">
        </div>
      </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.remove-btn').click(function () {
            var itemId = $(this).data('item-id');
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/subjectRemove/' + itemId, // Replace with your route to fetch item data
                type: 'GET',
                success: function (data) {
                    location.reload();
                }
            });
        });
    });
    function setImageSrc(imagePath) {
        var path = "{{ asset('assets') }}" + '/img/' + imagePath;
        $('#previewImage').attr('src', path);
    }
</script>