@extends('layouts.ekka')

@section('content')

<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Seeking Tutor</h2>
                    <h2 class="ec-title">Seeking Tutor Form</h2>
                    <p class="sub-title mb-3">Start seeking tutor that are most compatible with you</p>
                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form method="post" id="formInput" action="{{route('requestInput')}}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="input-tutor-id" id="input-tutor-id" value="{{$tutorId}}">
                            <span class="ec-register-wrap ec-register-half">
                                <label>Subject :</label>
                                <span class="ec-rg-select-inner">
                                    <select name="input-subject" id="input-subject" class="ec-register-select">
                                        <option selected disabled>Choose Subject</option>
                                        @foreach($subjectTeach as $s)
                                        <option value="{{$s->id}}">{{$s->subjectName}}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Grade :</label>
                                <span class="ec-rg-select-inner">
                                    <select name="input-grade" id="input-grade" class="ec-register-select">
                                        <option selected disabled>Select Grade</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </span>
                            </span>
                            <span class="ec-register-wrap">
                                <label>Description</label>
                                <textarea class="mb-3" name="input-description" placeholder="Description" class=""></textarea>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Date</label>
                                <input type="date" id="input-date" name="input-date" placeholder="Enter tutoring date"  min="{{ now()->toDateString() }}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Day</label>
                                <input type="text" id="input-day" name="input-day" placeholder="Enter day" readonly required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Start Time</label>
                                <input type="time" id="input-start-time" name="input-start-time" placeholder="Enter when you want to start" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>End Time</label>
                                <input type="time" id="input-end-time" name="input-end-time" placeholder="Enter when you want to end" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Tutoring Method</label>
                                <span class="ec-rg-select-inner">
                                    <select name="input-method" id="input-method" class="ec-register-select">
                                        <option selected disabled>Choose Method</option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                </span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Location</label>
                                <input type="text" name="input-location" placeholder="Enter where tutoring are done" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Repetitive</label><br>
                                <label class="switch">
                                    <!-- Switch input -->
                                    <input type="checkbox" name="input-repetitive" id="mySwitch">
                                    <!-- Switch slider -->
                                    <span class="slider"></span>
                                </label>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label id="repDur" style="display: none">Repetitive Duration</label>
                                <input id="repDurInput" style="display: none" type="number" name="input-repetitive-duration" placeholder="Enter how many weeks the tutoring are..." />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Mode</label>
                                <span class="ec-rg-select-inner">
                                    <select name="input-mode" id="input-mode" class="ec-register-select" required>
                                        <option selected disabled>Choose Mode</option>
                                        <option value="private">Private</option>
                                        <option value="group">Group</option>
                                    </select>
                                </span>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label id="groupSize" style="display: none">Group Size</label>
                                <input id="groupSizeInput" style="display: none" type="number" name="input-group-size" placeholder="Enter how many people..." />
                            </span>
                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" style="display: none" type="submit">Submit Request</button>
                            </span>
                        </form>
                            <span class="ec-register-wrap ec-register-btn" >
                                <button class="btn btn-primary" style="width: 30%" id="btnCheck" type="button">Check Tutor Avability</button>
                            </span>
                            <span>
                                <a data-toggle="modal" id="checkRequest" class="btn btn-primary">a</a>
                            </span>
                    </div>
                </div>
            </div>
            <div class="modal" id="checkModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">{{__('Avability Check')}}</h5>
                            <button type="button" class="closeModal" data-dismiss="modal" id="closeModal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <h4>{{__('Message')}} :</h4>
                            <p class="ml-3" id="msgContent"></p>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                            <button type="submit" form="formInput" class="btn btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mySwitch').change(function() {
            // Toggle the display property based on the switch state
            $('#repDur').css('display', this.checked ? 'block' : 'none');
            $('#repDurInput').css('display', this.checked ? 'block' : 'none');
            $('#repDurInput').prop('required',this.checked);
        });
        $('#input-mode').change(function(){
            if(this.value == "group"){
                $('#groupSize').css('display','block');
                $('#groupSizeInput').css('display','block');
                $('#groupSizeInput').prop('required',true);
            }else if(this.value  == "private"){
                $('#groupSize').css('display','none');
                $('#groupSizeInput').css('display','none');
                $('#groupSizeInput').prop('required',false);
            }
        });
        const datePicker = $('#input-date');
        const dayDisplay = $('#input-day');

        datePicker.on('change', function() {
            const selectedDate = datePicker.val();
            // alert(selectedDate);
            if (selectedDate) {
                const dateObject = new Date(selectedDate);
                const dayOfWeek = dateObject.toLocaleDateString('en-US', { weekday: 'long' });
                dayDisplay.val(dayOfWeek);
            } else {
                dayDisplay.val('');
            }
        });
        $('#btnCheck').click(function () {
            var tutorId = $("#input-tutor-id").val();
            var date = $("#input-date").val();
            var day = $("#input-day").val();
            var startTime = $("#input-start-time").val();
            var endTime = $("#input-end-time").val();

            if((tutorId != null && tutorId != "") && (date != null && date != "") && (day != null && day != "") && (startTime != null && startTime != "") && (endTime != null && endTime != "")){
                console.log(tutorId+" "+date+" "+day+" "+startTime+" "+endTime);
                $.ajax({
                    url: '/requestCheck/'+tutorId+'/'+date+'/'+day+'/'+startTime+'/'+endTime, // Replace with your route to fetch item data
                    type: 'GET',
                    success: function (data) {
                        // alert(data);
                        if(data == true){
                            var msg = "Tutor is not available during this time, the chance of your request being accepeted is slim!!\nDo you still want to proceed or change to another date and time?";
                            $("#msgContent").text(msg);
                        }else{
                            var msg = "Tutor is available during this time, please press proceed to post your request";
                            $("#msgContent").text(msg);
                        }
                        $("#checkRequest").click();
                    }
                });
            }else{
                alert("Please fill all the data");
            }
            // Fetch item data from the server using AJAX
            
        });
        $('#checkRequest').click(function() {
            $('#checkModal').show();
        });

        // Button click event to close the modal
        $('.closeModal').click(function() {
            $('#checkModal').hide();
        });
    });

</script>
<style>
    .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
    .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Styling for the switch input */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Styling for the switch slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        /* Styling for the switch slider when it's active/toggled on */
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        /* Styling for the switch input when it's checked/toggled on */
        input:checked + .slider {
            background-color: #2196F3;
        }

        /* Styling for the switch slider when it's active/toggled on */
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
</style>