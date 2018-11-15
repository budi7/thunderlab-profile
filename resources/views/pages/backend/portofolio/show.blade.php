@extends('template.backend')

@section('menu_portofolio')
	active
@stop

@push('content')
<div class="row">
    <div class="col-12">

		@include('components.backend.alertbox')

        <div class="card card-chart">
            <div class="card-header pb-4">
                <div class="row">
					<div class="col-sm-6 text-left pt-3">
						<h2 class="card-title mb-0"> {{ $page_attributes->title }} <small class="card-title">/ {{ $page_attributes->sub_title }}</small></h2>
					</div>					
                    <div class="col-sm-6 text-right pt-2">
						<a href="{{ route('backend.portofolio.edit', ['id' => $page_datas->id ]) }}" class="btn btn-sm btn-primary btn-simple"><i class="fa fa-edit"></i>&nbsp; Edit</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-danger btn-simple" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>&nbsp; Delete</a>
					</div>				
				</div>				
			</div>
			<div class="card-body">
				<div class="col-12 pb-4">
					<div class="row">
						<div class="col-12">
							<h4>The Project</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<p>Project Cover :</p>
							<img src="{{ asset($page_datas->datas->cover) }}" class="normal pb-4 pr-4 pl-0" alt="logo">
							<br />
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-12"><br></div>
							</div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>Project Title :</p>
								</div>
								<div class="col-7 col-md-9">
									<p class="text-capitalize">{{ $page_datas->datas->title }}</p>
								</div>
							</div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>Project Year :</p>
								</div>
								<div class="col-7 col-md-9">
									<p>{{ $page_datas->datas->year }}</p>
								</div>
							</div>
							<div class="row">
								<div class="col-5 col-md-3">
									<p>Project Description :</p>
								</div>
								<div class="col-7 col-md-9">
									<p>{{ $page_datas->datas->description }}</p>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12"></br></div>
					</div>

					<div class="row">
						<div class="col-12">
							<h4>The Client</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<p>Client Logo :</p>
							<img src="{{ asset($page_datas->datas->client['logo']) }}" class="normal pb-4 pr-4 pl-0" alt="logo">
							<br />
						</div>
						<div class="col-md-8">
							<div class="row">
									<div class="col-12"><br></div>
								</div>
								<div class="row">
									<div class="col-5 col-md-3">
										<p>Client Name :</p>
									</div>
									<div class="col-7 col-md-9">
										<p class="text-capitalize">{{ $page_datas->datas->client['name'] }}</p>
									</div>
								</div>
								<div class="row">
									<div class="col-5 col-md-3">
										<p>Client Description :</p>
									</div>
									<div class="col-7 col-md-9">
										<p class="text-capitalize">{{ $page_datas->datas->client['description'] }}</p>
									</div>
								</div>								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 mt-4 text-left">
							<a href="{{ route('backend.portofolio.index') }}" class="btn btn-outline-primary">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endpush

@push("modals")
	@include('components.backend.deleteModal', [
		'title' => 'data',
		'route' => route('backend.portofolio.destroy', ['id' => $page_datas->id])
	])	
@endpush