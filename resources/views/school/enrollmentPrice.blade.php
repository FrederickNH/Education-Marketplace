@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">     
        <div class="row justify-content-end mr-1 mb-4">
            <div>
                <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#addModal">
                <i class="ni ni-fat-add"></i>
                <span>Add Enrollment Type</span>
                </a>  
            </div>
        </div>
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
            <h3 class="mb-0">{{__('Enrollment Type List')}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="day">Enrollment Type</th>
                    <th scope="col" class="sort" data-sort="startTime">Price</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="list">
                @foreach($variantList as $variant)
                <tr>
                    <td scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 text-sm">{{$variant->title}}</span>
                        </div>
                        </div>
                    </td>
                    <td scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="name mb-0 text-sm">{{$variant->price}}</span>
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
                            <a class="edit-btn dropdown-item text-primary" data-toggle="modal" data-target="#editModal" data-item-id="{{ $variant->id }}">Edit</a> 
                            <a class="clear-btn dropdown-item text-warning" data-item-id="{{$variant->id}}" href="#">Delete</a>
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
                        <h5 class="modal-title" id="addModalLabel">{{__('Add Facility')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="addForm" method="POST" action="{{ route('enrollmentPriceAdd') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group{{ $errors->has('input-price-title') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-price-title">{{ __('Enrollment Type') }}</label>
                                <input type="text" name="input-price-title" id="input-price-title" class="form-control form-control-alternative{{ $errors->has('input-price-title') ? ' is-invalid' : '' }}"   placeholder="{{ __('Enrollment type title') }}" required autofocus>
        
                                @if ($errors->has('input-price-title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-price-title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('input-price') ? ' has-danger' : '' }}">
                                <label class="form-control-label text-white" for="input-price">{{ __('Price') }}</label>
                                <input type="text" name="input-price" id="input-price" class="form-control form-control-alternative{{ $errors->has('input-price') ? ' is-invalid' : '' }}"   placeholder="{{ __('Price') }}" required autofocus>
        
                                @if ($errors->has('input-price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('input-price') }}</strong>
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
        {{-- edit modal --}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                                <label class="form-control-label" for="edit-facility-detail">{{ __('Facility Detail') }}</label>
                                <input type="text" name="edit-facility-detail" id="edit-facility-detail" class="form-control form-control-alternative{{ $errors->has('edit-facility-detail') ? ' is-invalid' : '' }}"   placeholder="{{ __('Facility Detail') }}" required autofocus>
        
                                @if ($errors->has('edit-facility-detail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edit-facility-detail') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div><img id="edit-facility-picture-preview" src="" alt="" class="banner-img"></div>
                            <div class="form-group{{ $errors->has('edit-facility-picture') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="edit-facility-picture">{{ __('Certificate File') }}</label>
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
        </div>
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