@extends('layouts.ekka')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-OfKtCqT5lG9YufSI"></script>
@section('content')   

<div class="product_page">
    <section class="ec-page-content section-space-p">
        <div class="container">
            @foreach($tutoring as $item)
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">
                    
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img single-pro-img-no-sidebar col-lg-6 col-md-6">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            <div class="single-slide">
                                                @if($item->banner == null)
                                                <img class="img-card" src="{{asset('assets')}}/img/noimage.png"
                                                    alt="">
                                                @else
                                                <img class="img-card" src="{{asset('assets')}}/img/{{$item->banner}}"
                                                    alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar col-lg-6 col-md-6">
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title" id="tutoring-id" data-value="{{ $item->id }}" >{{$item->title}}</h5>
                                        <div class="ec-single-desc">
                                            <a href="../../tutorDetail/{{$item->tutor_id}}">
                                                <p><img class="profile-pic" src="{{asset('assets')}}/img/{{$item->picture}}" alt="">&nbsp;{{$item->fname}}&nbsp;{{$item->lname}}</p>
                                            </a>
                                        </div>
                                        <div class="ec-single-rating-wrap">
                                            <span class="ec-read-review"><a href="../../subjectTutoring/{{$item->subject_id}}">{{$item->subject_name}}</a></span>
                                        </div>
                                        <br>
                                        <div>
                                            <label for="description">Description :</label>
                                        </div>
                                        <div class="ec-single-desc" id="description">{{$item->description}}</div>
                                        <div class="ec-single-sales">
                                            <div class="ec-single-sales-inner">
                                                <div class="ec-single-sales-visitor">Tutoring Details :</div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-calendar-grid-58 text-primary"> &nbsp;&nbsp;</i>
                                                    <span>{{__('Start on')}} {{$item->day}}, &nbsp;{{\Carbon\Carbon::parse($item->date)->format('j M Y')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-time-alarm text-primary"> &nbsp;&nbsp;</i>
                                                    <span>{{__('at')}} {{\Carbon\Carbon::parse($item->start_time)->format('H:i A')}} - {{\Carbon\Carbon::parse($item->end_time )->format('H:i A')}}</span>
                                                </div>
                                                <div class="d-flex justify-content-start mb-2 ml-5">
                                                    @if($item->method == "Offline")
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>Tutoring is carried out {{$item->method}} at <span>{{$item->location}}</span></span>
                                                    </div>
                                                    @elseif($item->method == "Online")
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>Tutoring is carried out {{$item->method}}</span></span>
                                                    </div>
                                                    @elseif($item->method == "HomeService")
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-pin-3 text-primary">&nbsp;&nbsp;</i>
                                                        <span>Tutoring is carried out at customer home</span></span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center mb-2 ml-5">
                                                    <i class="ni ni-collection text-primary"> &nbsp;&nbsp;</i>
                                                    @if($item->repetitive_duration > 1)
                                                        <span> {{$item->repetitive_duration}}x&nbsp; {{__('meeting session')}}</span>
                                                    @else
                                                        <span> 1x {{__('meeting session per week')}}</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-between mb-2 ml-5">
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <i class="ni ni-single-02 text-primary"> &nbsp;&nbsp;</i>                            
                                                        @if($item->group_size <= 1 || $item->group_size == null)
                                                            <span>{{__('Done in Private')}}</span>
                                                        @else
                                                            <span> {{__('Done in Group of')}} {{$item->group_size}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-single-sales">
                                            <div class="ec-single-sales-inner">
                                                <div class="ec-single-price-stoke">
                                                    <div class="ec-single-stoke">
                                                        @if($item->mode == "Group")
                                                            <h5 >Slot left: {{$item->group_size - $slotCounter[0]->count}}</h5><br>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="ec-single-price" style="text-align: right">
                                                        
                                                        <span class="new-price mr-6">
                                                            <span id="item-discount" style="display: none;text-decoration: line-through; color: red">Rp {{number_format($item->price / 1, 2, '.', ',')}}</span>
                                                            <span id="item-price">Rp {{number_format($item->price / 1, 2, '.', ',')}}</span>
                                                        </span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="ec-btn-bw" style="align-items: right">
                                                <button class="custom-btn btn-2" id="btnPromo" style="font-size: 13px">Apply Promo</button>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="ec-single-qty">
                                            <div class="ec-single-cart ">
                                                <button class="btn btn-primary btn-book">{{__('Book')}}</button>
                                            </div>
                                        </div> --}}
                                        <div class="ec-single-qty">
                                            <div class="ec-single-cart ">
                                                <button class="btn btn-primary" id="btnBook" data-toggle="modal" data-target="#confirmationModal">Book</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <!-- product details description area end -->
                </div>
    
            </div>
            @endforeach
        </div>
    </section>
    <div class="modal" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Promo List</h5>
                    <button type="button" class="closePromoModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 400px ;overflow-y: scroll">
                    <div class="ec-cart col-lg-12 col-md-12 ">
                        <div class="ec-cart-content">
                            <div class="ec-cart-inner">
                                <div class="table-content cart-table-content">
                                    <table>
                                        <tbody>
                                            @foreach($promoList as $promo)
                                                <tr class="" >
                                                    <td class="ec-cart-pro-name" style="width: 60%">
                                                        <h5>{{$promo->name}}</h5>
                                                        <span>{{$promo->description}}</span>
                                                    </td>
                                                    <td class="ec-cart-pro-price">
                                                        <h6>Discount : {{$promo->in_form == 'percentage' ? $promo->discount.'%' : ($promo->in_form == 'nominal' ? 'Rp.'.$promo->discount : '')}}</h6>
                                                    </td>
                                                    <td class="ec-cart-pro-remove">
                                                        <button class="btn btn-primary" onclick="applyPromo({{$promo->id}},'{{$promo->in_form}}',{{$promo->discount}},{{$item->price}})">Apply</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closePromoModal" id="btn-close" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary btn-book" id="btn-book">Apply</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Confirmation</h5>
                    <button type="button" class="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    Are you sure you want to proceed to booking?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModal" id="btn-close" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary btn-book" id="btn-book">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="childModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Confirmation</h5>
                    <button type="button" class="closeChildModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    
                    <div class="ec-register-wrapper">
                        <div class="ec-register-container">
                            <div class="ec-register-form">
                                
                                <label>Which child is this booking for?<div id="errorContainer" style="color: red;"></div>
                                </label>
                                <span class="ec-rg-select-inner">
                                    <select name="child-id" id="child-id" class="ec-register-select">
                                        <option selected disabled value="0">Select Child</option>
                                        @foreach($childList as $child)
                                            <option value="{{$child->id}}">{{$child->fname.' '.$child->lname}}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeChildModal" id="btn-close" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-book2" id="btn-book2">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label">Notification</h5>
                    <button type="button" class="closeNotifModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary closeNotifModal" id="btn-ok">Ok</button>
                    <a href="{{route('tutoringListU')}}" class="btn btn-Primary" id="helper" style="display: none">Ok</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var promo = null;
    function applyPromo(id,in_form,discount,price){
            promo = id;
            var newPrice = 0;
            if (in_form == "percentage") {
                newPrice = price - (price * (discount/100));
            }else if(in_form == "nominal"){
                newPrice = price - discount;
            }
            // alert(newPrice);
            $("#item-discount").text("Rp "+ price.toLocaleString('id-ID', {minimumFractionDigits: 2}));
            $("#item-discount").css("display", "inline-block")
            $("#item-price").text("Rp "+ newPrice.toLocaleString('id-ID', {minimumFractionDigits: 2}));
            $('#promoModal').hide();
    }
    $(document).ready(function () {
        $('.btn-book').click(function () {
            $('#confirmationModal').hide();
            var dataValue = document.getElementById('tutoring-id').getAttribute('data-value');
            // var promo =  null;
            // var child = null;
            // if(document.getElementById('child-id'))
            var child = document.getElementById('child-id').value;
            // if(child.value == 0){
            //     child.value = null;
            // }
            // alert(child);
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/bookTutoring/' + dataValue + '/' + promo + '/' + child, // Replace with your route to fetch item data
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
                            
                            $.ajax({
                                url: '/saveBooking/'+ data[1],
                                type: 'GET',
                                success: function (data) {
                                    $('#notificationModal').show();
                                    $('#modal-body').text('Payment Successful');
                                    $('#btn-ok').hide();
                                    $('#helper').show();
                                }
                            })
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            // alert("payment failed!"); console.log(result);
                            $.ajax({
                                url: '/cancelBooking/'+ data[1],
                                type: 'GET',
                                success: function (data) {
                                    $('#notificationModal').show();
                                    $('#modal-body').text('Payment Failed');
                                    $('#btn-ok').show();
                                    $('#helper').hide();
                                }
                            })
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            $.ajax({
                                url: '/cancelBooking/'+ data[1],
                                type: 'GET',
                                success: function (data) {
                                    $('#notificationModal').show();
                                    $('#modal-body').text('Payment Failed');
                                    $('#btn-ok').show();
                                    $('#helper').hide();
                                }
                            })
                        }
                    });
                }
            });
        });
        $('#btnBook').click(function() {
            if({{count($childList)}} > 0){
                $('#childModal').show();
            }
            else{
                $('#confirmationModal').show();
            }
        });
        $('#btn-book2').click(function() {
            // alert($('#child-id').val());
            if($('#child-id').val() == null){
                $('#errorContainer').text('Please Select your child!');
            }else{ 
                $('#childModal').hide();
                $('#confirmationModal').show();
            }
        });
        $('#btnPromo').click(function() {
            $('#promoModal').show();
        });
        $('.closeModal').click(function() {
            $('#confirmationModal').hide();
        });
        $('.closeNotifModal').click(function() {
            $('#notificationModal').hide();
        });
        $('.closeChildModal').click(function() {
            $('#childModal').hide();
        });
        $('.closePromoModal').click(function() {
            $('#promoModal').hide();
        });
        
    });
</script>
<style>
    .img-card{
        width: 800px;
    }
    .profile-pic {
        width: 30px; /* Set the width of the container */
        height: 30px; /* Set the height of the container */
        overflow: hidden; /* Hide any overflow */
        border-radius: 50%; /* Create a circular shape */
    }

    .profile-pic img {
        width: 100%; /* Make the image fill the container */
        height: auto; /* Maintain the image's aspect ratio */
        display: block; /* Remove extra space below the image */
        border-radius: 50%; /* Ensure the image is also circular */
    }
</style>