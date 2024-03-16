@extends('layouts.app',['class' => 'bg-default'])

@section('content')

<div class="header bg-gradient-primary py-8 py-lg-8">
    <div class="container mt-1 pb-3">
        <div class="container-fluid mt-1">
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
                          <th scope="col" class="sort" data-sort="day">Name</th>
                          <th scope="col" class="sort" data-sort="startTime">Subject</th>
                          <th scope="col" class="sort" data-sort="endTime">Grade</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach($seeking as $s)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$s->UserFName}}&nbsp;{{$s->UserLName}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$s->SubjectName}}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">{{$s->grade}}</span>
                                    </div>
                                </div>
                            </td>
                            @if($s->status == 'done')
                            <td class="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm">Bidding has Ended</span>
                                    </div>
                                </div>
                            </td>
                                @if($s->winner == true)
                                <td class="text-right">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">You are the Winner //Change to button to check detail tutoring</span>
                                        </div>
                                    </div>
                                </td>
                                @else
                                <td class="text-right">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">Sorry you didn't win, better luck next time!</span>
                                        </div>
                                    </div>
                                </td>
                                @endif
                            @else
                            <td></td>
                            <td class="text-right">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <a class="btn btn-primary" href="offerListTutor/{{$s->id}}">{{__('Your Offfer')}}</a>
                                    </div>
                                </div>
                            </td>
                            @endif
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
    
    </div>
</div>    

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>