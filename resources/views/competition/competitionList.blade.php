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
                                            <h5> Registered Competition List</h5>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($competitionList as $competition)
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <!-- START single card -->
                                                <div class="ec-product-tp">
                                                    <div class="ec-product-image">
                                                        <a href="#">
                                                            <img src="{{asset('assets')}}/img/{{$competition->brochure}}" class="img-center" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="ec-product-body card-tutor">
                                                        <h3 class="ec-title"><a href="../competitionDetailU/{{$competition->id}}">{{$competition->title}}</a></h3>
                                                        <div>
                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>
                                                                <span>{{$competition->allowed_team_member}} member max per team</span>
                                                            </div>
                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                                <span>Regist end : {{\Carbon\Carbon::parse($competition->campaign_end )->format('j M Y')}}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-start align-items-center mb-2">
                                                                <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                                <span>Event : {{\Carbon\Carbon::parse($competition->competition_start)->format('j M Y')}}</span>
                                                            </div>
                                                            @if($competition->competition_end < now() && $competition->rate == null)
                                                                <div class="d-flex justify-content-center align-items-center mb-2">
                                                                    <button class="btn btn-primary" data-item-id="{{$competition->id}}" id="btnRate">Review</button>
                                                                </div>
                                                                @elseif($competition->rate != null)
                                                                <div class="d-flex justify-content-center align-items-center mb-2">
                                                                    <span>Given rating :&nbsp;</span>
                                                                    <p><span> 
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if($i <= $competition->rate)
                                                                                <i class="ecicon eci-star fill"></i>
                                                                            @else
                                                                                <i class="ecicon eci-star-o"></i>
                                                                            @endif  
                                                                        @endfor
                                                                        </span>
                                                                    </p>
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
                                    <form id="rateForm" method="POST" action="{{ route('competitionRateInput') }}" enctype="multipart/form-data">
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
        height: 360px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#btnRate').click(function() {
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