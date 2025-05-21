@extends('layouts.app')
@section('content')
<style>
    .raised-box {
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        padding: 1rem;
        border-radius: 5px;
    }
    /* Base style for nice input boxes */
    .nice-input {
        width: 100%;
        padding: 12px 16px;
        font-size: 16px;
        font-family: 'Segoe UI', sans-serif;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .nice-input:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
    }

    /* Optional: Input with icon inside */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #888;
    }

    .input-wrapper .nice-input {
        padding-left: 36px;
    }


    .checkbox-wrapper {
        display: flex;
        align-items: center;
        cursor: pointer;
        user-select: none;
        gap: 8px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .checkbox-wrapper input[type="checkbox"]:checked {
        background-color: #4a90e2;
        border-color: #4a90e2;
    }

    .checkbox-wrapper input[type="checkbox"]::after {
        content: '';
        position: absolute;
        width: 6px;
        height: 10px;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        top: 2px;
        left: 6px;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .checkbox-wrapper input[type="checkbox"]:checked::after {
        opacity: 1;
    }

    .checkbox-label {
        font-size: 16px;
        color: #333;
    }
</style>



</style>
<div class="row justify-content-center" style="border-radius: 10px;">
    <div class="col-md-6">
        <div class="alert alert-info">
            Dear Applicant,<br>
            Welcome to Kenya Paediatric Fellowship Program (KPFP) Scholarships Portal. If you are new here, you will need to create an account to access all the features of the website.
            You can click <a href="{{route('enroll.create')}}">Here</a> or click the <b>"Create Account"</b> link just right of the "Login" button.<br>
            <p></p>
            <b>Note: If you already have an account, you can login using the form below.</b>
        </div>
        <div class="card mx-4 raised-box">
            <div class="card-body p-4">

                <p class="text-muted"><center> <a class="navbar-brand logo_2" href="{{ route('home') }}"> <img src="{{ asset('img/KPFP.png') }}" width="120" height="120" alt="logo"> </a></center>
                </p>

                <h4><center> {{trans('panel.site_title') }}</center></h4>



                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-wrapper mb-3">
                        <i class="fa fa-user"></i>

                        <input id="email" name="email" type="text" class="nice-input  {{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>

                    <div class="input-wrapper mb-3">

                        <i class="fa fa-lock"></i>                       

                        <input id="password" name="password" type="password" class="nice-input {{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>

                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="remember" />
                        <span class="checkbox-label"> {{ trans('global.remember_me') }}</span>
                    </label>
                   

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ trans('global.login') }}
                            </button> <br><br>No Account? <a href="{{route('enroll.create')}}">Create Account</a>
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
