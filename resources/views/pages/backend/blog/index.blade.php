@extends('template.backend')

@section('menu_blog')
	active
@stop

@push('content')

<div class="row">
    <div class="col-12">

		@include('components.backend.alertbox')

        <div class="card card-chart">
            <div class="card-header pb-4">
                <div class="row">
					<div class="col-sm-6 text-left">
						<h2 class="card-title pt-3 mb-0">{{ $page_attributes->title }}</h2>
					</div>
					@php
					/*					
                    <div class="col-sm-6 text-right">
						<a href="{{ route('backend.blog.create') }}" class="btn btn-info btn-round ml-auto">
							<i class="fa fa-plus"></i> <span class="d-none d-sm-inline">Add Data</span>
						</a>
					</div>
					*/	
					@endphp			
				</div>				
			</div>
			<?php
			/*	
			<div class="card-body">
				<div class="col-12">
					<div class="table-responsive ps">
						<table class="table tablesorter " id="">
							<thead class=" text-primary">
								<tr>
									<th>No</th>
									<th>Title</th>
									<th>Last Update</th>
									<th>Availability</th>
								</tr>
							</thead>
							<tbody>
								@php
									$ctr = 1;
								@endphp                                
								@forelse($page_datas->datas as $key => $data)
									<tr class="clickable-row" data-href="{{ route('backend.blog.show', ['id' => $data['id']]) }}">
										<td>@include('helpers.table_numbering')</td>
										<td class="text-capitalize">{{ $data->title }}</td>
										<td class="text-capitalize">{{ $data->updated_at->diffForHumans() }}</td>
										<td class="text-capitalize">{{ ($data->isAvailable ? 'Available' : "Not Available") }}</td>
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
			</div>
			<div class="card-footer">
				<div class="col-12">
					@include('components.backend.paginate', [ 'paginate_data' => $page_datas->datas ])
				</div>				
			</div>
			*/
			?>			
		</div>
    </div>
</div>
@endpush
    
    
@push('scripts')
	@include('components.backend.clickableRow')
@endpush
    