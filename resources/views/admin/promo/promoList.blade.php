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
        <div class="row justify-content-end mr-5 mb-4">
            <div>
              <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#addModal">
                <i class="ni ni-fat-add"></i>
                <span>Add Promo</span>
              </a>  
            </div>
        </div>
        <div class="container-fluid mt-1">
            <div class="row">
              <div class="col">
                <div class="card">
                  <!-- Card header -->
                  <div class="card-header border-0">
                    <h3 class="mb-0">{{__('Promo List')}}</h3>
                  </div>
                  <!-- Light table -->
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="sort" data-sort="day">Name</th>
                          <th scope="col" class="sort" data-sort="startTime">Discount</th>
                          <th scope="col" class="sort" data-sort="endTime">In Form</th>
                          <th scope="col" class="sort" data-sort="brerakTime">Expire Date</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach($promoList as $promo)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$promo->name}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$promo->in_form == 'percentage' ? 'Percentage(%)':'Nominal(Rp)'}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$promo->discount}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$promo->expire_date}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        @if($promo->status == 'expired')
                                            <span class="badge badge-info">{{__('Expired')}}</span>
                                        @endif
                                    </div>
                                    </div>
                            </td>
                            @if($promo->status != 'expired')
                            <td class="text-right">
                                <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="edit-btn dropdown-item text-primary" data-toggle="modal" data-target="#editModal" data-item-id="{{ $promo->id }}">Edit</a> 
                                    {{-- <a class="clear-btn dropdown-item text-warning" data-item-id="{{$promo->id}}" href="promoDelete/{{$promo->id}}">Delete Promo</a> --}}
                                </div>
                                </div>
                            </td>
                            @endif
                            
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
                                <h5 class="modal-title" id="editModalLabel">Edit Promo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="editForm" method="POST" action="{{ route('promoUpdate') }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="edit-id" name="edit-id">
                                    <div class="form-group">
                                        <label for="editField">Name:</label>
                                        <input type="text" class="form-control" id="edit-name" name="edit-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="editField">Description:</label>
                                        <textarea class="form-control" id="edit-desc" name="edit-desc"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="editField">In Form:</label>
                                        <select name="edit-in-form" class="form-control">
                                            <option disabled>--Select Form--</option>
                                            <option value="percentage" id="opt-percentage">Percetage (%)</option>
                                            <option value="nominal" id="opt-nominal">Nominal (Rp)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editField">Discount:</label>
                                        <input type="number" class="form-control" id="edit-discount" name="edit-discount">
                                    </div>
                                    <div class="form-group">
                                        <label for="editField">Expire Date:</label>
                                        <input type="date" class="form-control" id="edit-expire" name="edit-expire">
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
                {{-- Add Modal --}}
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">{{__('Add Promo')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="addForm" method="POST" action="{{ route('promoAdd') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group{{ $errors->has('input-name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Promo name') }}</label>
                                        <input type="text" name="input-name" id="input-name" class="form-control form-control-alternative{{ $errors->has('input-name') ? ' is-invalid' : '' }}"  placeholder="{{ __('Promo name') }}" required autofocus>
            
                                        @if ($errors->has('holiday'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-desc') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-desc">{{ __('Holiday Date') }}</label>
                                        <textarea name="input-desc" id="input-desc" class="form-control form-control-alternative{{ $errors->has('input-desc') ? ' is-invalid' : '' }}"  placeholder="{{ __('Description') }}" required autofocus></textarea>
            
                                        @if ($errors->has('input-desc'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-desc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-in-form') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-in-form">{{ __('Discount in form of') }}</label>
                                        <select name="input-in-form" id="input-in-form" class="form-control form-control-alternative{{ $errors->has('input-subject') ? ' is-invalid' : '' }}">
                                            <option selected disabled>--Select Form--</option>
                                            <option value="percentage" >Percetage (%)</option>
                                            <option value="nominal">Nominal (Rp)</option>
                                        </select>

                                        @if ($errors->has('input-in-form'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-in-form') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-discount') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-discount">{{ __('Discount') }}</label>
                                        <input type="number" name="input-discount" id="input-discount" class="form-control form-control-alternative{{ $errors->has('input-discount') ? ' is-invalid' : '' }}"  placeholder="{{ __('Discount value (ex: 5(percentage), 50000(nominal))') }}" required autofocus>
            
                                        @if ($errors->has('input-discount'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-discount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('input-expire') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-expire">{{ __('Expire Date') }}</label>
                                        <input type="date" name="input-expire" id="input-expire" class="form-control form-control-alternative{{ $errors->has('input-expire') ? ' is-invalid' : '' }}"  placeholder="{{ __('Expire Date') }}" required autofocus>
            
                                        @if ($errors->has('input-expire'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('input-expire') }}</strong>
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
            url: '/promoEdit/' + itemId, // Replace with your route to fetch item data
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#edit-id').val(data.id);
                $('#edit-name').val(data.name);
                $('#edit-desc').val(data.description);
                if(data.in_form == 'percentage'){
                    $("#opt-percentage").prop("selected", true);
                }else if(data.in_form == 'nominal'){
                    $("#opt-nominal").prop("selected", true);
                }
                $('#edit-in-form').val(data.end_time);
                $('#edit-discount').val(data.discount);
                $('#edit-expire').val(data.expire_date);
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
