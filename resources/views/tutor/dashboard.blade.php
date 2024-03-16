@extends('layouts.app',['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-9 mb-5 mb-xl-0">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                    <h2 class="text-white mb-0">Transactions Made</h2>
                                </div>
    
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            {{-- <div class="chart">
                                <!-- Chart wrapper -->
                                <canvas id="chart-sales" class="chart-canvas"></canvas>
                            </div> --}}
                            <div class="chart">
                                <!-- Chart wrapper -->
                                <canvas id="chart-test" data-chart-data="{{ json_encode($data) }}" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Class</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$allClass}} <span class="h5">(<span class="text-success">+{{$todayData}}</span>)</span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="ni ni-hat-3"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$diff > 0 ? 'success' : 'danger'}} mr-2"><i class="fa fa-arrow-{{$diff > 0 ? 'up' : 'down'}}"></i> {{$diff}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                    <div class="card card-stats mb-4 mb-xl-0 mt-xl-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Active Class</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$activeClass}} <span class="h5"></span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="ni ni-hat-3"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$tutoring['diff'] > 0 ? 'success' : 'danger'}} mr-2"><i class="fa fa-arrow-{{$tutoring['diff'] > 0 ? 'up' : 'down'}}"></i> {{$tutoring['diff']}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> --}}
                        </div>
                    </div>
                    <div class="card card-stats mb-4 mb-xl-0 mt-xl-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Today Booking</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$todayBooking}} <span class="h5"></span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="ni ni-tag"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$tutoring['diff'] > 0 ? 'success' : 'danger'}} mr-2"><i class="fa fa-arrow-{{$tutoring['diff'] > 0 ? 'up' : 'down'}}"></i> {{$tutoring['diff']}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <br><br>
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                <h3 class="mb-0">{{__('Today Schedules')}}</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="startTime">Start Time</th>
                        <th scope="col" class="sort" data-sort="endTime">End Time</th>
                        <th scope="col" class="sort" data-sort="method">Method</th>
                        <th scope="col" class="sort" data-sort="lcoation">Location/Link</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @if(count($nearbyClass) >0)
                    @foreach($nearbyClass as $class)
                    <tr>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$class->start_time}}</span>
                            </div>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$class->end_time}}</span>
                            </div>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$class->method}}</span>
                            </div>
                            </div>
                        </td>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="name mb-0 text-sm">{{$class->location}}</span>
                            </div>
                            </div>
                        </td>
                        <td class="text-right">
                            {{-- <div class="dropdown"> --}}
                            <a class="text-primary" style="text-decoration: underline" href="tutoringDetail/{{$class->main_tutoring_id != null ? $class->main_tutoring_id : $class->id}}" role="button">
                                Go to Class <i class="ni ni-bold-right"></i>
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="edit-btn dropdown-item text-primary" data-toggle="modal" data-target="#editModal" data-item-id="{{ $schedule->id }}">Edit</a> 
                                <a class="clear-btn dropdown-item text-warning" data-item-id="{{$schedule->id}}" href="#">Clear Schedule</a>
                            </div>
                            </div> --}}
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5"><h2>No Classes Today</h2></td>
                    </tr>
                    @endif
                    </tbody>
                </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
            
                </div>
            </div>

            <!-- Edit Modal -->      
            </div>
        </div>
    </div>
</div>
    
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
<style>

</style>