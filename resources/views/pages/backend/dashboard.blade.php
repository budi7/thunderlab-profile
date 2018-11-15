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
                        $datestring=date("d M Y") . "Last Month";
                        $dt=date_create($datestring);
                        @endphp
                        <h5 class="card-category">{{ $dt->format('d M Y') }} - {{ date("d M Y") }}</h5>
                        <h2 class="card-title">Monthly Visitor</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartBig1"></canvas>
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
@endpush
