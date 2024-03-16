@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container mt-1 pb-3">
        <div class="container-fluid mt-1">
            <div class="row justify-content-end mr-1 mb-3">
                <div>
                  <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#addModal">
                    <i class="ni ni-fat-add"></i>
                    <span>{{__('Add Destination')}}</span>
                  </a>  
                </div>
            </div>  
            <div class="row">
              <div class="col">
                <div class="card">
                  <!-- Card header -->
                  <div class="card-header border-0">
                    <h3 class="mb-0">{{__('Destination List')}}</h3>
                  </div>
                  <!-- Light table -->
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="sort" data-sort="name">School Name</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach($destinationList as $destination)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$destination->school_name}}</span>
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
                                    <a class="clear-btn dropdown-item text-warning" href="destinationDelete/{{$destination->id}}">Delete Destination</a>
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

                {{-- add modal --}}
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">{{__('Add Destination')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="addForm" method="POST" action="{{ route('destinationAdd') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group{{ $errors->has('input-school-select') ? ' has-danger' : '' }}">
                                        <label class="form-control-label " for="input-school-select">{{ __('Select School') }}</label>
                                        <input list="school-list-selects" name="input-school-select" id="input-school-select" class="form-control form-control-alternative{{ $errors->has('input-school-select') ? ' is-invalid' : '' }}" placeholder="{{ __('-- Select School --') }}" required>
                                        <datalist id="school-list-selects">
                                            @foreach ($schoolList as $school)
                                                <option value="{{$school->school_name}}">
                                            @endforeach
                                        </datalist>
                                        <br>
                                        <label class="form-control-label " for="input-school-select">{{ __('Select Subdistrict') }}</label>
                                        <input list="subdistrict-list-selects" name="input-subdistrict-select" id="input-subdistrict-select" class="form-control form-control-alternative{{ $errors->has('input-subdistrict-select') ? ' is-invalid' : '' }}" placeholder="{{ __('-- Select Subdistrict --') }}" required>
                                        <datalist id="subdistrict-list-selects">
                                            @foreach ($subdistrictList as $subdistrict)
                                                <option value="{{$subdistrict->name}}">
                                            @endforeach
                                        </datalist>
                                        <br>    
                                        <label class="form-control-label " for="input-price">{{ __('Route Price') }}</label>
                                        <input type="number" placeholder="Price" name="input-price" id="input-price" class="form-control">

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
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>    
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