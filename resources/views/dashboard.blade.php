@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Tutoring</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$tutoring['data']}} <span class="h5">(<span class="text-success">+{{$tutoring['todayData']}}</span>)</span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="ni ni-hat-3"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$tutoring['diff'] > 0 ? 'success' : 'danger'}} mr-2"><i class="fa fa-arrow-{{$tutoring['diff'] > 0 ? 'up' : 'down'}}"></i> {{$tutoring['diff']}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Competitions</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$competition['data']}} <span class="h5">(<span class="text-success">+{{$competition['todayData']}}</span>)</span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="ni ni-trophy"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$competition['diff'] > 0 ? 'success' : 'danger'}} mr-2"><i class="fas fa-arrow-{{$competition['diff'] > 0 ? 'up' : 'down'}}"></i> {{$competition['diff']}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">School</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$school['data']}} <span class="h5">(<span class="text-success">+{{$school['todayData']}}</span>)</span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="ni ni-building"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$school['diff'] > 0 ? 'success' : 'danger'}} mr-2"><i class="fas fa-arrow-{{$school['diff'] > 0 ? 'up' : 'down'}}"></i> {{$school['diff']}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Shuttle</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$shuttle['data']}} <span class="h5">(<span class="text-success">+{{$shuttle['todayData']}}</span>)</span></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="ni ni-bus-front-12"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-{{$shuttle['diff'] > 0 ? 'success' : 'danger'}} mr-2"><i class="fas fa-arrow-{{$shuttle['diff'] > 0 ? 'up' : 'down'}}"></i> {{$shuttle['diff']}}%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Transactions Made</h2>
                            </div>
                            {{-- <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-test" data-update='{"data":{"datasets":[{"data":"0,0,0,0,0,0,0,0,0,0,0,0"}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Tutoring</span>
                                            <span class="d-md-none">T</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-test" data-update='{"data":{"datasets":[{"data":"[0,0,0,0,0,0,0,0,0,0,0,0]"}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Competition</span>
                                            <span class="d-md-none">C</span>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
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
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                <h2 class="mb-0">Total Transaction This Month</h2>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-orders" data-chart-data="[10,20]" class="chart-canvas">a</canvas>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-transaction" data-chart-data="{{ json_encode($dataTransaction) }}" class="chart-canvas">a</canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
{{-- <script>
    var SalesChart = (function() {
        var $chart = $('#chart-test');

        function init( chartData) {
            var salesChart = new Chart($chart, {
                type: 'line',
                options: {
                    scales: {
					yAxes: [{
						gridLines: {
							color: Charts.colors.gray[900],
							zeroLineColor: Charts.colors.gray[900]
						},
						ticks: {
							callback: function(value) {
								if (!(value % 10)) {
									return '$' + value + 'k';
								}
							}
						}
					}]
				},
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">$' + yLabel + 'k</span>';
                                return content;
                            }
                        }
                    }
                },
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Performance',
                        data: chartData,
                    }]
                }
            });

            // Save to jQuery object
            $chart.data('chart', salesChart);
        }
        function updateChart(newData) {
            if (salesChart && salesChart.data) {
                // Update the chart's data
                salesChart.data.datasets[0].data = newData;
                salesChart.update();
            } else {
                console.error('Sales chart or its data property is undefined.');
            }
        }
        // Events
        if ($chart.length) {
            // init($chart, {!! json_encode($data) !!}); // Pass the data from the controller
            var initialData = $chart.data('update').data;
            initChart(initialData);
        }
    })();
    window.updateChart = updateChart;
</script> --}}