@extends('template.backend')

@section('menu_dashboard')
active
@stop

@push('content')
<div class="row">
    <div class="col-12">
        <div class="card card-chart">
            <div class="card-header ">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        @php
                        $datestring=date("d M Y") . "Last Week";
                        $dt=date_create($datestring);
                        @endphp
                        <h5 class="card-category">{{ $dt->format('d M Y') }} - {{ date("d M Y") }}</h5>
                        <h2 class="card-title">Weekly Visitor</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartAnalytics"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Follow Up List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th>No</th>
                            <th>Name</th>
                            <th>Nature Of Enquiry</th>
                            <th>Submit Date</th>
                        </thead>
                        <tbody>
                            @php
                            $ctr = 1;
                            @endphp                                
                            @forelse($page_datas->guestbooks as $key => $data)
                            <tr class="clickable-row" data-href="{{ route('backend.guestbook.show', ['id' => $data['id']]) }}">
                                <td>@include('helpers.table_numbering')</td>
                                <td class="text-capitalize">{{ $data->name }}</td>
                                <td class="text-capitalize">{{ $data->nature }}</td>
                                <td class="text-capitalize">{{ $data->created_at->diffForHumans() }}</td>
                            </tr>									
                            @php
                            $ctr++;
                            @endphp
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{route('backend.guestbook.index')}}" class="btn btn-primary btn-sm">More <i class="fa fa-angle-right"></i></a>
            </div>            
        </div>
    </div>
</div>
@endpush


@push('scripts')
    @include('components.backend.clickableRow')

    // init chart
    gradientChartOptionsConfiguration =  {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        
        tooltips: {
            backgroundColor: '#fff',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales:{
            yAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.0)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    suggestedMin:50,
                    suggestedMax: 110,
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
            }],
            
            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(220,53,69,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
            }]
        }
    };

    var ctx = document.getElementById("chartAnalytics").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0,230,0,50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    var data_source = {!! json_encode($page_datas->analytics) !!};
    var ds_date = [], ds_visitors = [];

    data_source.forEach(function(element) {
        ds_date.push(element.date);
        ds_visitors.push(element.visitors);
    });

    var data = {
        labels: ds_date,
        datasets: [{
            label: "Visitors",
            fill: true,
            backgroundColor: gradientStroke,
            borderColor: '#d048b6',
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: '#d048b6',
            pointBorderColor:'rgba(255,255,255,0)',
            pointHoverBackgroundColor: '#d048b6',
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            data: ds_visitors,
        }]
    };

    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: gradientChartOptionsConfiguration
    });    
@endpush
