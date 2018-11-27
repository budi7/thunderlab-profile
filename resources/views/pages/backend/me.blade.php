@extends('template.backend')

@push('content')
<div class="row">
    <div class="col-6">
        <div class="card card-chart">
            <div class="card-header pb-4">
                <div class="col-sm-6 text-left">
                    <h3 class="card-title pt-3 mb-0">Profile</h3>
                </div>
			</div>
			<div class="card-body">
                <div class="col-12">
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
                </div>
            </div>
			<div class="card-footer">
                <div class="col-12">
                </div>				
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-chart">
            <div class="card-header pb-4">
                <div class="col-sm-6 text-left">
                    <h3 class="card-title pt-3 mb-0">Update Password</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="col-12">
                    @include('components.backend.alertbox')

                    {!! Form::open([
                        'url' => route('backend.updatePassword')
                    ])!!}
                        {{ Form::token() }}
                        <div class="form-body">   
                            <div class="row">
                                <div class="col-md-10 ">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        {{  Form::password('old-password', ['class' => 'form-control mb-2']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        {{  Form::password('new-password', ['class' => 'form-control mb-2']) }}
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-footer">
                <div class="col-12">
                </div>				
            </div>
        </div>
    </div>
</div>
@endpush