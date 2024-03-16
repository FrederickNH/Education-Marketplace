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
                                                                                @if($s->status == "Done")
                                                                                    <td scope="row">Deal has been made</td>
                                                                                    <td scope="row"><button class="btn btn-primary btn-book" data-item-id="{{ $s->tutoring_id }}">Proceed to pay</button ></td>
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
</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-book').click(function () {
            var itemId = $(this).data('item-id');
            var promo =  null;
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/bookTutoring/' + itemId + '/' + promo, // Replace with your route to fetch item data
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
                            
                            
                            window.location.href = '/saveBooking/'+ data[1];
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            alert("payment failed!"); console.log(result);
                            window.location.href = '/cancelBooking/'+ data[1];
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                            window.location.href = '/cancelBooking/'+ data[1];
                        }
                    });
                }
            });
        });
    });
</script>