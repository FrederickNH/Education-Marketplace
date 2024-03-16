@extends('layouts.ekka')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-OfKtCqT5lG9YufSI"></script>
@section('content')
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div class="row">
                                        <div>
                                            <h5>Tutoring Class List</h5>    
                                        </div>
                                    </div>
                                    <section class="ec-page-content section-space-p">
                                        <div class="container">
                                            <div class="row">
                                                <div class="ec-tab-wrapper ec-tab-wrapper-1">
                                                    <div class="ec-single-pro-tab-wrapper">
                                                        <div class="ec-single-pro-tab-nav">
                                                            <ul class="nav nav-tabs">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-all"
                                                                        role="tablist">All Tutoring</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-tutoring"
                                                                        role="tablist">Tutoring</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-seek"
                                                                        role="tablist">Seeking</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content  ec-single-pro-tab-content">
                                                            <div id="ec-spt-nav-all" class="tab-pane fade show active">
                                                                <div class="ec-single-pro-tab-all">
                                                                    <div class="row">
                                                                        @foreach($tutoringList as $tutoring)
                                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                <!-- START single card -->
                                                                                <div class="ec-product-tp">
                                                                                    <div class="ec-product-image">
                                                                                        @if($tutoring->banner != null)
                                                                                        <a href="tutoringList/detail/{{$tutoring->id}}">
                                                                                            <img src="{{asset('assets')}}/img/{{$tutoring->banner}}" class="img-center" alt="">
                                                                                        </a>
                                                                                        @else
                                                                                        <a href="tutoringList/detail/{{$tutoring->id}}">
                                                                                            <img src="{{asset('assets')}}/img/noimage.png" class="img-center" alt="">
                                                                                        </a>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="ec-product-body card-tutor">
                                                                                        <h3 class="ec-title"><a href="tutoringList/detail/{{$tutoring->id}}">{{$tutoring->title}}</a></h3>
                                                                                        <p class="ec-description">
                                                                                            {{$tutoring->SubjectName}}
                                                                                        </p>
                                                                                        <div>
                                                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                                                <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                                                                                @if($tutoring->repetitive_duration > 1)
                                                                                                    <span> {{$tutoring->repetitive_duration}}x&nbsp; {{__('Meeting')}}</span>
                                                                                                @else
                                                                                                    <span> 1x {{__('Meeting')}}</span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-between mb-2">
                                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                                    <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                                                                    @if($tutoring->group_size <= 1 || $tutoring->group_size == null)
                                                                                                        <span>Private</span>
                                                                                                    @else
                                                                                                        <span>Group of {{$tutoring->group_size}}</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                                    <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                                                                    <span>{{$tutoring->method}}</span>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                                                <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                                                                                <h6 class="text-sm">Start at {{$tutoring->day}}, &nbsp;{{\Carbon\Carbon::parse($tutoring->date)->format('j M Y')}}</h6>
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                                                <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                                                                <span>{{\Carbon\Carbon::parse($tutoring->start_time)->format('H:i')}} - {{\Carbon\Carbon::parse($tutoring->end_time )->format('H:i')}}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                        
                                                                                </div>
                                                                                <!-- START single card -->
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="ec-spt-nav-tutoring" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-tutoring">
                                                                    <div class="row">
                                                                        @foreach($tutoringPureList as $tutoring)
                                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                <!-- START single card -->
                                                                                <div class="ec-product-tp">
                                                                                    <div class="ec-product-image">
                                                                                        @if($tutoring->banner != null)
                                                                                        <a href="tutoringList/detail/{{$tutoring->id}}">
                                                                                            <img src="{{asset('assets')}}/img/{{$tutoring->banner}}" class="img-center" alt="">
                                                                                        </a>
                                                                                        @else
                                                                                        <a href="tutoringList/detail/{{$tutoring->id}}">
                                                                                            <img src="{{asset('assets')}}/img/noimage.png" class="img-center" alt="">
                                                                                        </a>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="ec-product-body card-tutor">
                                                                                        <h3 class="ec-title"><a href="tutoringList/detail/{{$tutoring->id}}">{{$tutoring->title}}</a></h3>
                                                                                        <p class="ec-description">
                                                                                            {{$tutoring->SubjectName}}
                                                                                        </p>
                                                                                        <div>
                                                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                                                <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                                                                                @if($tutoring->repetitive_duration > 1)
                                                                                                    <span> {{$tutoring->repetitive_duration}}x&nbsp; {{__('Meeting')}}</span>
                                                                                                @else
                                                                                                    <span> 1x {{__('Meeting')}}</span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-between mb-2">
                                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                                    <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                                                                    @if($tutoring->group_size <= 1 || $tutoring->group_size == null)
                                                                                                        <span>Private</span>
                                                                                                    @else
                                                                                                        <span>Group of {{$tutoring->group_size}}</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                                    <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                                                                    <span>{{$tutoring->method}}</span>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                                                <i class="ni ni-calendar-grid-58 text-primary">&nbsp;&nbsp;</i>
                                                                                                <h6 class="text-sm">Start at {{$tutoring->day}}, &nbsp;{{\Carbon\Carbon::parse($tutoring->date)->format('j M Y')}}</h6>
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                                                <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                                                                <span>{{\Carbon\Carbon::parse($tutoring->start_time)->format('H:i')}} - {{\Carbon\Carbon::parse($tutoring->end_time )->format('H:i')}}</span>
                                                                                            </div>
                                                                                            @if($tutoring->date < now() && $tutoring->rate == null)
                                                                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                                                                <button class="btn btn-primary btnRate" data-item-id="{{$tutoring->id}}">Review</button>
                                                                                            </div>
                                                                                            @elseif($tutoring->date < now() && $tutoring->rate != null)
                                                                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                                                                <span>Given rating :&nbsp;</span>
                                                                                                <p><span> 
                                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                                        @if($i <= $tutoring->rate)
                                                                                                            <i class="ecicon eci-star fill"></i>
                                                                                                        @else
                                                                                                            <i class="ecicon eci-star-o"></i>
                                                                                                        @endif  
                                                                                                    @endfor
                                                                                                    </span>
                                                                                                </p>
                                                                                            </div>
                                                                                            @elseif($tutoring->date > now())
                                                                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                                                                <a class="btn btn-primary" href="cancelTutoringBooking/{{$tutoring->id}}" id="btnCancel">Cancel</a>
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                        
                                                                                </div>
                                                                                <!-- START single card -->
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="ec-spt-nav-seek" class="tab-pane fade">
                                                                <div class="ec-single-pro-tab-seek">
                                                                    <div class="row">
                                                                        <div class="ec-shop-rightside col-lg-12 col-md-12">
                                                                            <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                                                                                <div class="ec-vendor-card-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="ec-vendor-block-profile">
                                                                                                <div class="row">
                                                                                                    <div>
                                                                                                        <h5>List of Seeking Tutors</h5>    
                                                                                                    </div>
                                                                                                </div>
                                                                                                <section class="ec-page-content section-space-p">
                                                                                                    <div class="container">
                                                                                                        <div class="row">
                                                                                                            <div class="ec-tab-wrapper ec-tab-wrapper-1">
                                                                                                                <div class="ec-single-pro-tab-wrapper">
                                                                                                                    <div class="ec-vendor-card-body">
                                                                                                                        <div class="ec-vendor-card-table">
                                                                                                                            <table class="table ec-table">
                                                                                                                                <thead>
                                                                                                                                    <tr>
                                                                                                                                        <th scope="col">Subject</th>
                                                                                                                                        <th scope="col">Grade</th>
                                                                                                                                        <th scope="col">Latest Offer</th>
                                                                                                                                        <th scope="col"></th>
                                                                                                                                    </tr>
                                                                                                                                </thead>
                                                                                                                                <tbody>
                                                                                                                                    @foreach($seekList as $s)
                                                                                                                                        <tr>
                                                                                                                                            <td scope="row"><span>{{$s->SubjectName}}</span></td>
                                                                                                                                            <td scope="row"><span>{{$s->grade}}</span></td>
                                                                                                                                            @if($s->status == "made")
                                                                                                                                                <td scope="row">Deal has been made</td>
                                                                                                                                                <td scope="row"><button class="btn btn-primary btn-book" data-item-id="{{ $s->tutoring_id }}">Proceed to pay</button ></td>
                                                                                                                                            @elseif($s->status == "done")
                                                                                                                                                <td scope="row">Class has been made</td>
                                                                                                                                                <td scope="row"><a class="btn btn-primary " href="tutoringList/detail/{{$s->tutoring_id}}">Go to class -></a ></td>
                                                                                                                                            @else
                                                                                                                                                @if($s->latestOffer == null || $s->latestOffer == 0)
                                                                                                                                                    <td scope="row"><span>No offer yet</span></td>
                                                                                                                                                @else
                                                                                                                                                    <td scope="row"><span>{{$s->latestOffer}}</span></td>
                                                                                                                                                @endif
                                                                                                                                                <td scope="row"><a class="btn btn-primary" href="../offerList/{{$s->id}}">Offer list</a></td>
                                                                                                                                            @endif    
                                                                                                                                        </tr>
                                                                                                                                    @endforeach
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </section>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="reviewModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">{{__('Give Rating')}}</h5>
                                    <button type="button" class="closeModal" data-dismiss="modal" id="closeModal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="rateForm" method="POST" action="{{ route('tutoringRateInput') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group{{ $errors->has('input-rate') ? ' has-danger' : '' }}">
                                            <input type="hidden" name="input-id" id="input-id" value="">
                                            <label class="form-control-label" for="input-rate">{{ __('Rate') }}</label>
                                            <input type="number" name="input-rate" id="input-rate" class="form-control form-control-alternative{{ $errors->has('input-rate') ? ' is-invalid' : '' }}"  placeholder="{{ __('Rate') }}" min="1" max="5" required autofocus>
                
                                            @if ($errors->has('input-rate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-rate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('input-comments') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-comments">{{ __('Comments') }}</label>
                                            <textarea name="input-comments" id="input-comments" class="form-control form-control-alternative{{ $errors->has('input-comments') ? ' is-invalid' : '' }}"  placeholder="{{ __('Comments') }}"required autofocus></textarea>
                
                                            @if ($errors->has('input-comments'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('input-comments') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                                    <button type="submit" form="rateForm" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<style>
    .img-center{
        width: 350px;
        height: 200px;
    }
    .card-tutor{
        height: 375px;
    }
</style>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-book').click(function () {
            var itemId = $(this).data('item-id');
            var promo =  null;
            var child = null;
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/bookTutoring/' + itemId + '/' + promo + '/' + child, // Replace with your route to fetch item data
                type: 'GET',
                success: function (data) {
                    // $('#editItemId').val(data.id);
                    // $('#editStartTime').val(data.start_time);
                    // $('#editEndTime').val(data.end_time);
                    // $('#editStartBreakTime').val(data.start_break_time);
                    // $('#editEndBreakTime').val(data.end_break_time);
                    // // Populate other form fields as needed
                    // window.snap.pay(data);
                    window.snap.pay(data[0], {
                        onSuccess: function(result){
                            /* You may add your own implementation here */
                            alert("payment success!"); console.log(result);
                            $.ajax({
                                url: '/saveBooking/'+ data[1], // Replace with your route to fetch item data
                                type: 'GET',
                                success: function (data) {
                                    if(data = "success"){
                                        location.reload();
                                    }
                                }
                            });
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            alert("payment failed!"); console.log(result);
                            $.ajax({
                                url: '/cancelBooking/'+ data[1], // Replace with your route to fetch item data
                                type: 'GET',
                                success: function (data) {
                                    if(data = "success"){
                                        location.reload();
                                    }
                                }
                            });
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                            $.ajax({
                                url: '/cancelBooking/'+ data[1], // Replace with your route to fetch item data
                                type: 'GET',
                                success: function (data) {
                                    if(data = "success"){
                                        location.reload();
                                    }
                                }
                            });
                        }
                    });
                }
            });
        });
        $('.btnRate').click(function() {
            var itemId = $(this).data('item-id');
            $('#input-id').val('');
            $('#input-rate').val('');
            $('#input-comments').val('');
            $('#input-id').val(itemId);
            $('#reviewModal').show();
        });

        // Button click event to close the modal
        $('.closeModal').click(function() {
            $('#reviewModal').hide();
        });
    });
</script>