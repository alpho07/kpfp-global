@extends('layouts.app')
@section('content')
<div class="row justify-content-center" style="border-radius: 10px;">
    <div class="col-md-6">
        <div class="alert alert-info">
            Dear Applicant,<br>
            Welcome to Kenya Paediatric Fellowship Program (KPFP) Scholarships Portal. If you are new here, you will need to create an account to access all the features of the website.
            You can click <a href="{{route('enroll.create')}}">Here</a> or click the <b>"Create Account"</b> link just right of the "Login" button.<br>
            <p></p>
            <b>Note: If you already have an account, you can login using the form below.</b>
        </div>
        <div class="card mx-4">
            <div class="card-body p-4">

                <p class="text-muted"><center> <a class="navbar-brand logo_2" href="{{ route('home') }}"> <img src="{{ asset('img/logo.png') }}" alt="logo"> </a></center>
                </p>

                <h4><center> {{trans('panel.site_title') }}</center></h4>



                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>

                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="form-check checkbox">
                            <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                            <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                {{ trans('global.remember_me') }}
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ trans('global.login') }}
                            </button> OR <a href="{{route('enroll.create')}}">Create Account</a>
                        </div>
                        <div class="col-6 text-right">
                            @if(Route::has('password.request'))
                                <a class="btn btn-link px-0" href="{{ route('password.request.custom') }}">
                                    {{ trans('global.forgot_password') }}
                                </a><br>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
