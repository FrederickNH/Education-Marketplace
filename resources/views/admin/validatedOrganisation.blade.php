@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container py-5">   
        @if (session('status'))
            <div class="row alert alert-success" id="status-messages">
                <span id="status-text">{{ session('status') }}</span>
                <button class="status-close-button" id="close-button">&times;</button>
            </div>
        @endif
        @if (session('failed'))
        <div class="row alert alert-danger" id="status-messages">
            <span id="status-text">{{ session('failed') }}</span>
            <button class="status-close-button" id="close-button">&times;</button>
        </div>
        @endif  
        <div class="row justify-content-end mr-1 mb-4">
            <div>
              <a class="add-btn btn btn-white text-primary d-flex justify-content-start align-items-center" href="{{url('validateOrganisation')}}">
                <span>Waiting Validation</span>
              </a>  
            </div>
        </div>
        @foreach($organiserList as $organisation)
            <div class="card card-profile shadow">
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">     
                        <div class="col-md-4">
                            @if($organisation->picture != null)
                                <img src="{{asset('assets')}}/img/{{$organisation->picture}}" class="card-img-top banner-img" alt="" />
                            @else
                                <img src="{{asset('assets')}}/img/noimage.png" class="card-img-top banner-img" alt="" />
                            @endif
                        </div>
                        <div class="col-lg-7 ml-2">
                            <div class="col">
                                <h2>{{__("Organisation Name")}}: {{$organisation->org_name}}</h2>
                                <h5 class="ml-3">Status : {{$organisation->status}}</h5>
                                <h5 class="ml-3">PIC ID Card : <button class="btn-sm btn-primary btn-certificate" data-item-id="{{$organisation->identity_card}}">ID Card</button> </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        @endforeach
        <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataModalLabel">ID Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul id="dataList"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-certificate').click(function () {
            // Make an Ajax request to fetch data
            var itemId = $(this).data('item-id');
            var dataList = $('#dataList');
            dataList.empty();

            dataList.append("<img src='{{asset('assets')}}/img/" + itemId + "''>'");
            $('#dataModal').modal('show');
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
<style>
    .banner-img{
        width: 20rem;
        height: 200px;
    }
    #input-id{
        display: none;
    }
    .card{
        margin-top: 20px;
    }
</style>