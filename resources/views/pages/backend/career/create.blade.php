@extends('template.backend')

@section('menu_career')
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
						'url' => $page_datas->id ? route('backend.career.update', ['id' => $page_datas->id]) : route('backend.career.store')
					])!!}					
						{{ $page_datas->datas ? method_field('PUT') : ''}}   
						{{ Form::token() }}
						
						<div class="row">
							<div class="col-12">
								<h4>Job Information</h4>
							</div>
						</div>

						<div class="row">
							<div class="col-7">
								<div class="form-group">
									<label>Job Title</label>
									{{  Form::text('title', $page_datas->id ? $page_datas->datas->title : null, ['class' => 'form-control']) }}
								</div>
							</div>
							<div class="col-5">
								<div class="form-group">
									<label>Job Type</label>
									{{ Form::select('type', ['Full Time' => 'Full Time', 'Internship' => 'Internship', 'Remote' => 'Remote', 'Outsource' => 'Outsource'], $page_datas->id ? $page_datas->datas->type : null, ['placeholder' => 'Select', 'class' => 'form-control']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-7">
								<div class="form-group">
									<label>Location</label>
									{{  Form::text('location', $page_datas->id ? $page_datas->datas->location : null, ['class' => 'form-control']) }}
								</div>
							</div>
							<div class="col-5">
								<div class="form-group">
									<label>Availability</label>
									{{ Form::select('isAvailable', [0 => 'Not Available', 1 => 'Available'], $page_datas->id ? $page_datas->datas->isAvailable : null, ['placeholder' => 'Select', 'class' => 'form-control']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Job Description</label>
									{{  Form::textarea('description', $page_datas->id ? $page_datas->datas['description'] : null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Job Responsibilities</label>
									{{  Form::textarea('responsibilities', $page_datas->id ? $page_datas->datas['responsibilities'] : null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Job Requirements</label>
									{{  Form::textarea('requirements', $page_datas->id ? $page_datas->datas['requirements'] : null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="form-group">
									<a href="{{ $page_datas->id ? route('backend.career.show', ['id' => $page_datas->id]) : route('backend.career.index') }}" class="btn btn-outline-primary">Cancel</a>
									<button type="submit" class="btn btn-primary">Save</button>
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
	imageSend.setCsrfToken('{{ csrf_token() }}');
@endpush