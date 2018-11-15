@extends('template.backend')

@section('menu_user')
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
						<a href="{{ route('backend.user.edit', ['id' => $page_datas->id ]) }}" class="btn btn-sm btn-primary btn-simple"><i class="fa fa-edit"></i>&nbsp; Edit</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-danger btn-simple" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>&nbsp; Delete</a>
					</div>				
				</div>				
			</div>
			<div class="card-body">
				<div class="col-12 pb-4">
					<div class="row">
						<div class="col-3">
							<p>Name :</p>
						</div>
						<div class="col-9">
							<p class="text-capitalize">{{ $page_datas->datas->name }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Username :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->username }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Access Role :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->role }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12 mt-4 text-left">
							<a href="{{ route('backend.user.index') }}" class="btn btn-outline-primary">Back</a>
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
		'title' => 'user',
		'route' => route('backend.user.destroy', ['id' => $page_datas->id])
	])	
@endpush