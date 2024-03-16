<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-OfKtCqT5lG9YufSI"></script>
@extends('layouts.ekka')

@section('content')

<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Competition Registration</h2>
                    <h2 class="ec-title">Competition Registration Form</h2>
                    {{-- <p class="sub-title mb-3">Start seeking tutor that are most compatible with you</p> --}}
                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form method="post" action="{{route('competitionRegisterDetailU')}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <span class="ec-register-wrap">
                                <label>Team Name</label>
                                <input type="text" name="input-team-name" placeholder="Team name" class="">
                            </span>
                            <span class="ec-register-wrap mb-4">
                                <a class="" onclick="addDropdown()"><i class="ni ni-fat-add"></i> Add Member</a>
                            </span>
                            <section class="ec-page-content section-space-p">
                                <div class="container">
                                    <div class="row">
                                        <div class="ec-faq-container-2">
                                            <div class="ec-faq-wrapper">
                                                <div id="ec-faq-1">
                                                    <div class="" >
                                                        <h4 class="">Member 1</h4>
                                                        <div class="">
                                                            <span class="ec-register-wrap">
                                                                <label>Name</label>
                                                                <input type="text" name="input-name-0" placeholder="Name" class="" required>
                                                            </span>
                                                            <span class="ec-register-wrap">
                                                                <label>Phone Number</label>
                                                                <input type="tel" name="input-phone-number-0" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789    " maxlength="12" class="" required>
                                                            </span>
                                                            <span class="ec-register-wrap">
                                                                <label>School Name</label>
                                                                <input type="text" name="input-school-name-0" placeholder="School Name" class="" required>
                                                            </span>
                                                            {{-- <span class="ec-register-wrap">
                                                                <label>Student Id</label>
                                                                <input type="file" name="input-student-id-0" placeholder="Student ID" class="">
                                                            </span> --}}
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <input type="hidden" name="dropdownCount" id="dropdownCount" value="1">
                            <input type="hidden" name="variantId" id="variantId" value="{{$variant->id}}">
                            <input type="hidden" name="competitionId" value="{{$variant->competition->id}}">
                            <input type="hidden" name="competitionUser" value="{{$variant->competition->competitionorganiser->user_id}}_{{$variant->competition->competitionorganiser->user->fname}}_{{$variant->competition->competitionorganiser->user->lname}}">
                            <button type="submit" style="display: none" id="btn-submit">Submit</button>
                            
                        </form>
                        <span class="ec-register-wrap ec-register-btn">
                            <button id="btnReq" class="btn btn-primary">Submit</button>
                        </span>
                        {{-- <span class="ec-register-wrap ec-register-btn">
                            <button class="btn btn-primary btn-regis">Submit Form</button>
                        </span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Notiffication</h5>
                <button type="button" class="closeNotifModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                Member already reached limit!!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeNotifModal" id="btn-close" data-dismiss="modal">Ok</button>
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
                Are you sure all data is correct?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" id="btn-close" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary btn-reg" id="btn-req">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var dropdownCount = 1;
    var maxMember = {{$variant->competition->allowed_team_member}}
    function addDropdown() {
        if(maxMember > dropdownCount){
            var dropdownList = document.getElementById('ec-faq-1');
            var newDropdownCard = createDropdownCard(dropdownCount);
            dropdownList.appendChild(newDropdownCard);
            dropdownCount++;
            document.getElementById('dropdownCount').value = dropdownCount;
        }else{
            $('#notificationModal').show();
        }
    }

    function createDropdownCard(index) {
        var newDropdownCard = document.createElement('div');
        newDropdownCard.className = 'row text-left';
        newDropdownCard.innerHTML = `
                    <h4 class="">Member ${index+1}</h4>
                    <div class="">
                        <span class="ec-register-wrap">
                            <label>Name</label>
                            <input type="text" name="input-name-${index}" placeholder="Name" class="" required>
                        </span>
                        <span class="ec-register-wrap">
                            <label>Phone Number</label>
                            <input type="tel" name="input-phone-number-${index}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789    " maxlength="12" class="" required>
                        </span>
                        <span class="ec-register-wrap">
                            <label>School Name</label>
                            <input type="text" name="input-school-name-${index}" placeholder="School Name" class="" required>
                        </span>
                        
                    </div>
                    <br> 
        `;
        return newDropdownCard;
        // <span class="ec-register-wrap">
        //                     <label>Student Id</label>
        //                     <input type="file" name="input-student-id-${index}" placeholder="Student ID" class="">
        //                 </span>
    }
</script>
<script>
    $(document).ready(function () {
        $('#btnReq').click(function() {
            $('#confirmationModal').show();
        });
        $('.closeModal').click(function() {
            $('#confirmationModal').hide();
        });
        $('#btn-req').click(function() {
            $('#btn-submit').click();
        });
        $('.closeNotifModal').click(function() {
            $('#notificationModal').hide();
        });
        $('.btn-regis').click(function () {
            var dataValue = document.getElementById('variantId').value;
            // Fetch item data from the server using AJAX
            $.ajax({
                url: '/payRegistration/' + dataValue, // Replace with your route to fetch item data
                type: 'GET',
                success: function (data) {
                    // $('#editItemId').val(data.id);
                    // $('#editStartTime').val(data.start_time);
                    // $('#editEndTime').val(data.end_time);
                    // $('#editStartBreakTime').val(data.start_break_time);
                    // $('#editEndBreakTime').val(data.end_break_time);
                    // // Populate other form fields as needed
                    window.snap.pay(data, {
                        onSuccess: function(result){
                            /* You may add your own implementation here */
                            alert("payment success!"); console.log(result);
                            
                            $('#btn-submit').click();
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            alert("payment failed!"); console.log(result);
                            // window.location.href = '/cancelBooking/'+ data[1];
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                            // window.location.href = '/cancelBooking/'+ data[1];
                        }
                    });
                }
            });
        });
    });
</script>