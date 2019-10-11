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
						'url' => $page_datas->id ? route('backend.portofolio.update', ['id' => $page_datas->id]) : route('backend.portofolio.store')
					])!!}
						{{ Form::token() }}
						{{ $page_datas->datas ? method_field('PUT') : ''}}
						<div class="row">
							<div class="col-12">
								<h4>The Project</h4>
							</div>
						</div>

						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label>Projects Cover</label>
									<br />
									<img id="preview_cover" src="{{ asset('img/noimage.png') }}" class="normal pt-4 pb-4 pr-4 pl-0" alt="logo">
									<br />
									{{  Form::file('cover', [
										'class' => 'form-control image-send',
										"imagePreload" => ( $page_datas->id ? $page_datas->datas->cover : null )
									]) }}
									<a href="#" class="btn btn-sm btn-outline-primary">Change</a>
									{{-- <p><small>* recommended image resolution</small></p> --}}
								</div>
							</div>
							<div class="col-md-7">
								<div class="row">
									<div class="col-8">
										<div class="form-group">
											<label>Project Title</label>
											{{  Form::text('title', $page_datas->id ? $page_datas->datas->title : null, ['class' => 'form-control']) }}
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label>Project Year</label>
											{{  Form::number('year', $page_datas->id ? $page_datas->datas->year : null, ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Project Description</label>
											{{  Form::textarea('description', $page_datas->id ? $page_datas->datas->description : null, ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-12">
								<h4>The Client</h4>
							</div>
						</div>

						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label>Client Logo</label>
									<br />
									<img id="preview_logo" src="{{ asset('img/noimage.png') }}" class="normal pt-4 pb-4 pr-4 pl-0" alt="logo">
									<br />
									{{  Form::file('client_logo', [
                                        'class' => 'form-control image-send',
                                        "imagePreload" => ( $page_datas->id ? $page_datas->datas->client->logo : null )
									]) }}
									<a href="#" class="btn btn-sm btn-outline-primary">Change</a>
									{{-- <p><small>* recommended image resolution</small></p> --}}
								</div>
							</div>
							<div class="col-md-7">
								<div class="row">
									<div class="col-10">
										<div class="form-group">
											<label>Client Name</label>
											{{  Form::text('client_name', $page_datas->id ? $page_datas->datas->client['name'] : null, ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Client Description</label>
											{{  Form::textarea('client_description', $page_datas->id ? $page_datas->datas->client['description'] : null, ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="form-group">
									<a href="{{ $page_datas->id ? route('backend.portofolio.show', ['id' => $page_datas->id]) : route('backend.portofolio.index') }}" class="btn btn-outline-primary">Cancel</a>
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
	imageSend.setUrl('{{ route('backend.media.upload.portofolio') }}');
@endpush
