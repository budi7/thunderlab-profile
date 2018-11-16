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
										<br />
										<img id="preview_cover" src="{{ asset('img/logo.png') }}" class="normal pt-4 pb-4 pr-4 pl-0" alt="logo">
										<br />
										{{  Form::file('logo', [
											'class' => 'form-control image-send',
										]) }}
										<a href="#" class="btn btn-sm btn-outline-primary">Change</a>
										<p><small>* PNG Format, Max filesize 2MB</small></p>
									</div>
								</div>
								<div class="col-md-7">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label>Company Name</label>
												{{  Form::text('name', $page_datas->datas ? $page_datas->datas->name : null, ['class' => 'form-control']) }}
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Company Description</label>
												{{  Form::textarea('description', $page_datas->datas ? $page_datas->datas->description : null, ['class' => 'form-control']) }}
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
										{{  Form::email('email', $page_datas->datas ? $page_datas->datas->email : null, ['class' => 'form-control']) }}
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Phone</label>
										{{  Form::text('phone', $page_datas->datas ? $page_datas->datas->phone : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Address</label>
										{{  Form::textarea('address', $page_datas->datas ? $page_datas->datas->address : null, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Operational Hours</label>
										{{  Form::textarea('operational', $page_datas->datas ? $page_datas->datas->operational : null, ['class' => 'form-control']) }}
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
										{{  Form::text('facebook', $page_datas->datas ? $page_datas->datas->facebook : null, ['class' => 'form-control']) }}
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">									
										<label>Instgram</label>
										{{  Form::text('instagram', $page_datas->datas ? $page_datas->datas->instagram : null, ['class' => 'form-control']) }}
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">									
										<label>Twitter</label>
										{{  Form::text('twitter', $page_datas->datas ? $page_datas->datas->twitter : null, ['class' => 'form-control']) }}
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
imageSend.setCsrfToken('{{ csrf_token() }}');
imageSend.setUrl('{{ route('backend.media.upload.webcore') }}');
@endpush
    