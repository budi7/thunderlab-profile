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
					<div class="col-sm-6 text-left">
					<h2 class="card-title pt-3 mb-0"> {{ $page_attributes->title }} <small class="card-title">/ {{ $page_attributes->sub_title }}</small></h2>
					</div>					
					<div class="col-sm-6 text-right">
						{{-- <a href="{{ route('backend.user.edit', ['id' => 1]) }}" class="btn btn-info btn-round ml-auto">
							<i class="fa fa-pencil"></i> <span class="d-none d-sm-inline">Edit User</span>
						</a> --}}
					</div>
				</div>
			</div>			
			<div class="card-body">
				<div class="col-12">
					{!! Form::open([
						'url' => $page_datas->id ? route('backend.user.update', ['id' => $page_datas->id]) : route('backend.user.store')
					])!!}
						{{ $page_datas->datas ? method_field('PUT') : ''}}   
						{{ Form::token() }}
						<div class="form-body">
							<div class="row">
								<div class="col-12">
									<h4>Job Information</h4>
								</div>
							</div>

							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label>Name</label>
										{{  Form::text('name', $page_datas->id ? $page_datas->datas->name : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label>Username (email)</label>
										{{  Form::text('username', $page_datas->id ? $page_datas->datas->username : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-5 ">
									<div class="form-group">
										<label>Password {{ $page_datas->id ? ' ( leave it blank to keep old password )' : '' }}</label>
										{{  Form::password('password', ['class' => 'form-control mb-2']) }}
									</div>
								</div>
							</div>
							
							<div class="row mt-4">
								<div class="col-md-12">
									<div class="form-group">
									<a href="{{ $page_datas->id ? route('backend.user.show', ['id' => $page_datas->id]) : route('backend.user.index') }}" class="btn btn-outline-primary">Cancel</a>
									<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
    </div>
</div>
@endpush
    
    
@push('scripts')

@endpush
    