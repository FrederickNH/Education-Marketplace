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
                    <h2 class="ec-title">Competition Registration Detail</h2>
                    {{-- <p class="sub-title mb-3">Start seeking tutor that are most compatible with you</p> --}}
                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form method="post" action="{{route('competitionRegister')}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <span class="ec-register-wrap">
                                <label>Team Name</label>
                                <input type="text" name="input-team-name" placeholder="Team name" value="{{$data->input('input-team-name')}}" class="" readonly>
                            </span>
                            {{-- <span class="ec-register-wrap mb-4">
                                <a class="" onclick="addDropdown()"><i class="ni ni-fat-add"></i> Add Member</a>
                            </span> --}}
                            <section class="ec-page-content section-space-p">
                                <div class="container">
                                    <div class="row">
                                        <div class="ec-faq-container-2">
                                            <div class="ec-faq-wrapper">
                                                @for($i = 0; $i < $data->input('dropdownCount'); $i++)
                                                <div id="ec-faq-1">
                                                    <div class="" >
                                                        <h4 class="">Member {{$i+1}}</h4>
                                                        <div class="">
                                                            <span class="ec-register-wrap">
                                                                <label>Name</label>
                                                                <input type="text" name="input-name-{{$i}}" placeholder="Name" value="{{$data->input('input-name-'.$i)}}" readonly class="">
                                                            </span>
                                                            <span class="ec-register-wrap">
                                                                <label>Phone Number</label>
                                                                <input type="tel" name="input-phone-number-{{$i}}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789    " maxlength="12" value="{{$data->input('input-phone-number-'.$i)}}" readonly>
                                                            </span>
                                                            <span class="ec-register-wrap">
                                                                <label>School Name</label>
                                                                <input type="text" name="input-school-name-{{$i}}" placeholder="School Name" value="{{$data->input('input-school-name-'.$i)}}" class="" readonly>
                                                            </span>
                                                            <span class="ec-register-wrap">
                                                                <label>Student Id</label>
                                                                <input type="file" name="input-student-id-{{$i}}" value="{{$data->file('input-student-id-'.$i)}}" placeholder="Student ID" class="" required>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <input type="hidden" name="dropdownCount" id="dropdownCount" value="{{$data->input('dropdownCount')}}">
                            <input type="hidden" name="variantId" id="variantId" value="{{$variant->id}}">
                            <input type="hidden" name="competitionId" value="{{$variant->competition->id}}">
                            <input type="hidden" name="competitionUser" value="{{$variant->competition->competitionorganiser->user_id}}_{{$variant->competition->competitionorganiser->user->fname}}_{{$variant->competition->competitionorganiser->user->lname}}">
                            <button style="display: none" type="submit" id="btn-submit">Submit</button>
                        </form>
                        <span class="ec-register-wrap ec-register-btn">
                            <button class="btn btn-primary" id="btnBook">Submit Form</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                Are you sure you want to proceed to register?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeModal" id="btn-close" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary btn-regis" id="btn-book">Yes</button>
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
                <button class="btn btn-Primary" id="helper" style="display: none">Ok</button>
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
            alert("Member Reached Maximum");
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
                            <input type="text" name="input-name-${index}" placeholder="Name" class="">
                        </span>
                        <span class="ec-register-wrap">
                            <label>Phone Number</label>
                            <input type="tel" name="input-phone-number-${index}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="ex: 012-345-6789    " maxlength="12" class="">
                        </span>
                        <span class="ec-register-wrap">
                            <label>School Name</label>
                            <input type="text" name="input-school-name-${index}" placeholder="School Name" class="">
                        </span>
                        <span class="ec-register-wrap">
                            <label>Student Id</label>
                            <input type="file" name="input-student-id-${index}" placeholder="Student ID" class="">
                        </span>
                    </div>
                    <br> 
        `;
        return newDropdownCard;
    }
</script>
<script>
    $(document).ready(function () {
        $('#btnBook').click(function() {
            $('#confirmationModal').show();
        });
        $('.closeModal').click(function() {
            $('#confirmationModal').hide();
        });
        $('.closeNotifModal').click(function() {
            $('#notificationModal').hide();
        });
        $('#helper').click(function() {
            $('#btn-submit').click();
        });
        $('.btn-regis').click(function () {
            $('#confirmationModal').hide();
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
                            $('#notificationModal').show();
                            $('#modal-body').text('Payment Successful');
                            $('#btn-ok').hide();
                            $('#helper').show();
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            alert("wating your payment!"); console.log(result);
                        },
                        onError: function(result){
                            $('#notificationModal').show();
                            $('#modal-body').text('Payment Failed');
                            $('#btn-ok').show();
                            $('#helper').hide();
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            $('#notificationModal').show();
                            $('#modal-body').text('Payment Failed');
                            $('#btn-ok').show();
                            $('#helper').hide();
                        }
                    });
                }
            });
        });
    });
</script>