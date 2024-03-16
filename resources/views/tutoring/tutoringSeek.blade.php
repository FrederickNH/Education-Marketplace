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
                        <form method="post" action="{{route('seekingInput')}}">
                            @csrf
                            @method('put')
                            <span class="ec-register-wrap ec-register-half">
                                <label>Subject :</label>
                                <span class="ec-rg-select-inner">
                                    <select name="input-subject" id="input-subject" class="ec-register-select">
                                        <option selected disabled>Choose Subject</option>
                                        @foreach($subject as $s)
                                        <option value="{{$s->id}}">{{$s->name}}</option>
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
                                <input type="date" id="input-date" name="input-date" placeholder="Enter tutoring date" min="{{ now()->toDateString() }}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Day</label>
                                <input type="text" id="input-day" name="input-day" placeholder="Enter day" readonly required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Start Time</label>
                                <input type="time" name="input-start-time" placeholder="Enter when you want to start" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>End Time</label>
                                <input type="time" name="input-end-time" placeholder="Enter when you want to end" required />
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
                                <input type="text" name="input-location" placeholder="Enter where tutoring are done" />
                            </span>
                            {{-- <span class="ec-register-wrap ec-register-half">
                                <label>Repetitive</label>
                                <span class="ec-rg-select-inner">
                                    <select name="input-repetitive" id="input-repetitive" class="ec-register-select">
                                        <option selected disabled>Choose Rep</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    </select>
                                </span>
                            </span> --}}
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
                            <span class="ec-register-wrap ec-register-half" style="display: none">
                                <label>Minimum offer</label>
                                <input type="hidden" name="input-min-price" placeholder="Enter minimum price..." required />
                            </span>
                            <span class="ec-register-wrap ec-register">
                                <label>Maximum offer</label>
                                <input type="number" name="input-max-price" placeholder="Enter maximum price..." required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Start Seeking</label>
                                <input type="date" id="input-campaign-start-time" name="input-start-campaign" placeholder="Enter when you want to start seeking" min="{{ now()->toDateString() }}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>End Seeking</label>
                                <input type="date" id="input-campaign-end-time" name="input-end-campaign" placeholder="Enter when you want to end seeking" min="{{ now()->toDateString() }}" required />
                            </span>
                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit">Submit Form</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
            // Get references to the input elements
            const dateInput = document.getElementById('input-date');
            const startCampaignInput = document.getElementById('input-campaign-start-time');
            const endCampaignInput = document.getElementById('input-campaign-end-time');

            // Add event listener to date input
            dateInput.addEventListener('change', function () {
                // Update the min attribute of startCampaignInput
                startCampaignInput.max = dateInput.value;
                // Reset startCampaignInput value if it's invalid
                if(startCampaignInput.value > dateInput.value) {
                    startCampaignInput.value = '';
                }
                if(endCampaignInput.value > dateInput.value){
                    endCampaignInput.value = '';
                }
            });

            // Add event listener to startCampaign input
            startCampaignInput.addEventListener('change', function () {
                // Update the min attribute of endCampaignInput
                endCampaignInput.min = startCampaignInput.value;
                endCampaignInput.max = dateInput.value;
                // Reset endCampaignInput value if it's invalid
                if(endCampaignInput.value > startCampaignInput.value || endCampaignInput.value > dateInput.value) {
                    endCampaignInput.value = '';
                }
            });
        });
</script>
<style>
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