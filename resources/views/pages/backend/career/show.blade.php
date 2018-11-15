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
						<a href="{{ route('backend.career.edit', ['id' => $page_datas->id ]) }}" class="btn btn-sm btn-primary btn-simple"><i class="fa fa-edit"></i>&nbsp; Edit</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-danger btn-simple" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>&nbsp; Delete</a>
					</div>				
				</div>				
			</div>
			<div class="card-body">
				<div class="col-12 pb-4">
					<div class="row">
						<div class="col-3">
							<p>Job Title :</p>
						</div>
						<div class="col-9">
							<p class="text-capitalize">{{ $page_datas->datas->title }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Job Type :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->type }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Location :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->location }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Availability :</p>
						</div>
						<div class="col-9">
							<p>{{ ($page_datas->datas->isAvailable ? 'Available' : "Not Available") }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Job Description :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->description }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Job Responsibilities :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->responsibilities }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Job Requirements :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->requirements }}</p>
						</div>
					</div>																				
					<div class="row">
						<div class="col-12 mt-4 text-left">
							<a href="{{ route('backend.career.index') }}" class="btn btn-outline-primary">Back</a>
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
		'route' => route('backend.career.destroy', ['id' => $page_datas->id])
	])	
@endpush