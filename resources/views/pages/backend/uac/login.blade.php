@extends('layouts.backend')

@section('template_content')
    <div class="wrapper">
        <div class="page-header" style="background-image: url('/img/login-image.jpg');">
            <div class="filter"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 ml-auto mr-auto">
                        <div class="card card-register bg-white mx-auto">
                            <h3 class="title">Login</h3>
                             <div class='row'>
                                <div class="col-12 p-b-2">
                                    @include('components.backend.alertbox')
                                </div>
                            </div> 
                            {!! Form::open(['url' => route('backend.logging'), 'class' => 'register-form']) !!}
                                {!! csrf_field() !!}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label text-secondary"><strong>Email</strong></label>
                                    <input id="email" type="email" class="form-control bg-light text-dark font-weight-bold"  name="email" value="{{ old('email') }}" required autofocus placeholder="user@example.com">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                                    <label for="password" class="control-label text-secondary"><strong>Password</strong></label>
                                    <input id="password" type="password" class="form-control bg-light text-dark font-weight-bold" name="password" required placeholder="******">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button class="btn btn-danger btn-block btn-round">Login</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection