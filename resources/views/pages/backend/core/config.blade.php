@extends('template.backend')

@section('menu_config')
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
					<h2 class="card-title pt-3 mb-0"> {{ $page_attributes->title }}</h2>
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
					{!! Form::open(['url' => route('backend.config.store', [ 'files' => true ])]) !!}
						{{ Form::token() }}
						<div class="form-body">

							<div class="row">
								<div class="col-12">
									<h4>Company Profile</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label>Company Logo</label>
										<div class="pt-3 pb-3 pr-4 pl-0">
											<img src="{{ asset('img/logo.png') }}" class="normal" alt="logo">
											{{  Form::file('logo', ['class' => 'form-control']) }}
										</div> 
										<a href="#" class="btn btn-sm btn-outline-primary">Change</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label>Company Name</label>
												{{  Form::text('name', $page_datas->id ? $page_datas->datas->company->name : null, ['class' => 'form-control']) }}
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Company Description</label>
												{{  Form::textarea('username', $page_datas->id ? $page_datas->datas->company->description : null, ['class' => 'form-control']) }}
											</div>
										</div>
									</div>
								</div>								
							</div>

							<div class="row mt-4">
								<div class="col-12">
									<h4>Contacts</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Email</label>
										{{  Form::email('email', $page_datas->id ? $page_datas->datas->contact->email : null, ['class' => 'form-control']) }}
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Phone</label>
										{{  Form::text('phone', $page_datas->id ? $page_datas->datas->contact->phone : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Address</label>
										{{  Form::textarea('username', $page_datas->id ? $page_datas->datas->company->description : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Operational Hours</label>
										{{  Form::textarea('operational', $page_datas->id ? $page_datas->datas->company->operational : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>


							<div class="row mt-4">
								<div class="col-12">
									<h4>Socials</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<div class="form-group">									
										<label>Facebook</label>
										{{  Form::text('facebook', $page_datas->id ? $page_datas->datas->social->facebook : null, ['class' => 'form-control']) }}
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">									
										<label>Instgram</label>
										{{  Form::text('instagram', $page_datas->id ? $page_datas->datas->social->instagram : null, ['class' => 'form-control']) }}
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">									
										<label>Twitter</label>
										{{  Form::text('twitter', $page_datas->id ? $page_datas->datas->social->twitter : null, ['class' => 'form-control']) }}
									</div>								
								</div>								
							</div>

							<div class="row mt-4">
								<div class="col-md-12">
									<div class="form-group">
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
    