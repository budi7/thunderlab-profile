@extends('template.backend')

@section('menu_guestbook')
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
							<p>IP Address :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->ip }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Nature of Enquiry :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->nature }}</p>
						</div>
					</div>
					<div class="row">
							<div class="col-3">
								<p>Follow Up :</p>
							</div>
							<div class="col-9">
								<p>{{ ($page_datas->datas->isAvailable ? 'Followed Up' : "None") }}</p>
							</div>
						</div>					

					<div class="row">
						<div class="col-12">
							<br/>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<h4>Guest Contact Detail</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-3">
							<p>Phone :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->phone }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<p>Email :</p>
						</div>
						<div class="col-9">
							<p>{{ $page_datas->datas->email }}</p>
						</div>
					</div>

					<div class="row">
						<div class="col-12 mt-4 text-left">
							<a href="{{ route('backend.guestbook.index') }}" class="btn btn-outline-primary">Back</a>
							<a href="{{ route('backend.guestbook.edit', ['id' => $page_datas->id ]) }}" class="btn  btn-primary btn-simple ml-3" {{ $page_datas->datas->isContacted ? "disabled" : ""}}><i class="fa fa-phone"></i>&nbsp; Follow Up</a>
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
		'route' => route('backend.guestbook.destroy', ['id' => $page_datas->id])
	])	
@endpush