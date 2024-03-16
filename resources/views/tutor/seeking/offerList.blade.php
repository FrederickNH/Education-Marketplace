@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container mt-1 pb-3">
        <div class="container-fluid mt-1">
            <div class="row justify-content-end mr-1 mb-4">
                <div>
                  <a class="edit-btn btn btn-white text-primary d-flex justify-content-start align-items-center" data-toggle="modal" data-target="#offerModal" href="{{route('seekingListTutor')}}">
                    <i class="ni ni-fat-add"></i>
                    <span>Make new offers</span>
                  </a>  
                </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="card">
                  <!-- Card header -->
                  <div class="card-header border-0">
                    <h3 class="mb-0">{{__('Bidded Seeking List')}}</h3>
                  </div>
                  <!-- Light table -->
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="sort" data-sort="day">Price</th>
                          <th scope="col" class="sort" data-sort="startTime">Date Offers Made</th>
                          <th scope="col" class="sort" data-sort="endTime">Status</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach($offer as $o)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$o->price}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$o->created_at}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$o->status}}</span>
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
            <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="offerModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="offerModalLabel">{{__('Make Offer')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="addForm" method="POST" action="{{ route('offerAdd') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group{{ $errors->has('input-offer') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-certificate-title">{{ __('Proposed Price') }}</label>
                                    <input type="text" name="input-id" id="input-id" value="{{$seek->id}}">
                                    <input type="number" name="input-offer" id="input-offer" class="form-control form-control-alternative{{ $errors->has('input-offfer') ? ' is-invalid' : '' }}"  placeholder="{{ __('Proposed Price') }}" min="0" max="{{$seek->max_price}}" required autofocus>
                                    @if ($errors->has('input-offer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('input-offer') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .banner-img{
        width: 20rem;
    }
    #input-id{
        display: none;
    }
</style>