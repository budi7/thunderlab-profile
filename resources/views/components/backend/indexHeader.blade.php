<div id="index-control">
	<div class="collapse show" id="collapseOne">
		<div class="row">
			<div class="col-12 col-sm-6">
				<div class="row">
					<div class="col-12">
						{!! Form::open(['url' => $index['url'], 'method' => 'GET' ]) !!}
							@if (request()->has('filter'))
								@foreach (request()->get('filter') as $key_filter => $filters)
									@foreach ($filters as $key => $filter)
										<input type="hidden" name="{{ 'filter[' . $key_filter . '][]' }}" value="{{ $filter }}" />
									@endforeach
								@endforeach
							@endif
							<div class="input-group">
								<input type="text" name="search" class="form-control" placeholder="Cari..." >
								<span class="input-group-append">
									<button class="btn btn-info btn-round" type="submit">
										<i class="fa fa-search"></i>
									</button>
								</span>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="col-4">
						@if ($page_attributes->filter)
							<button type="button" class="btn btn-default" data-toggle="collapse" data-parent="#index-control" href="#collapseTwo">
								<i class="nc-icon nc-tag-content"></i> <span class="d-none d-sm-inline">Filter</span>
							</button>
						@endif
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 text-right">
				<div class="hidden-md-up ">
					&nbsp;
				</div>
				<a href="{{ $create['url'] }}" class="btn btn-info btn-round ml-auto">
					<i class="fa fa-plus"></i> <span class="d-none d-sm-inline">{{ $create['caption'] }}</span>
				</a>
			</div>
		</div>
	</div>

	@if ($page_attributes->filter)
		<div class="row collapse" id="collapseTwo">
			<div class="col-12">
				{!! Form::open(['url' => $index['url'], 'method' => 'GET' ]) !!}
					@if (request()->has('search'))
						<input type="hidden" name="search" value="{{ request()->get('search') }}" />
					@endif

					<div class="row">
						<div class="col-12">
							<h5 class="my-0">
								Filter 
								<span class="pull-right">
									<a href="#collapseOne" data-parent="#index-control" data-toggle="collapse">
										<small><i class="nc-icon nc-simple-remove"></i></small>
									</a>
								</span>
							</h5>
							<hr />
						</div>
					</div>

					@if ($page_attributes->filter)
						<div class="row">
							@foreach ($page_attributes->filter as $par_key => $filters)
								<div class="col-4 col-sm-3 col-md-2">
									<p><strong>@stringify($par_key)</strong></p>
									@foreach ($filters as $key => $filter)
										<div class="form-check">
											<label for="filter[{{ $par_key }}][]" class="form-check-label">
													<input class="form-check-input" name="filter[{{ $par_key }}][]" value="{{ $key }}" type="checkbox" />
													{{ $filter }}
											</label>
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					@endif

					<div class="row">
						<div class="col-12">
							<button class="btn btn-primary btn-sm" type="submit">Terapkan</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	@endif

	<div class="row">
		<div class="col-12 {{ request()->get('search') || request()->get('filter') ? 'mt-2' : '' }}">
			{{-- search --}}
			@if (request()->has('search'))
				<span class="label label-default">
					Search : {{ request()->get('search') }} | 
					<a href="{{ closeSearch('search') }}" class="text-white"><i class="fa fa-close"></i></a>
				</span>
			@endif
			{{-- filter --}}
			@if (request()->has('filter'))
				@foreach (request()->get('filter') as $par_key => $filters)
					@foreach ($filters as $key => $filter)
						<span class="label label-default"> 
							@stringify($par_key) : 
							@if ($filter == "1" || $filter == '0') 
								@status($filter) 
							@else 
								{{ $filter }} 
							@endif 
							| <a href="{{ closeFilter($par_key, $filter) }}" class="text-white">
									<i class="nc-icon nc-simple-remove"></i>
								</a>
						</span>
					@endforeach
				@endforeach
			@endif
		</div>
	</div>	

	<div class="row">
		<div class="clearfix col-12 mb-4"></div>
	</div>
</div>

@php
	// generate URL
	function closeSearch($key){
		// get current url
		$qs = Request::except([$key]);

		//rebuild qs and return 
		return  Request::url().'?'.http_build_query($qs);
	}

	function closeFilter($key, $val){
		// get current url
		$filter = ['filter' => []];

		$qs = Request::get("filter");
		foreach ($qs as $ctr => $values) {
			$tmp = [$ctr => []];
			foreach ($values as $value) {
				if($ctr == $key){
					if($value != $val){
						array_push($tmp[$ctr], $value);
					}
				}else{
					array_push($tmp[$ctr], $value);
				}
			}
			if(count($tmp[$ctr]) > 0){
				$filter['filter'] = array_merge($filter['filter'], $tmp);
			}
		}

		$filter = array_merge($filter, Request::except(['filter']));

		return  Request::url().'?'.http_build_query($filter);
	}
@endphp