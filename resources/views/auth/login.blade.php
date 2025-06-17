@extends('layouts.app')
@section('content')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #f4f7fa, #eaf1ff);
        font-family: 'Inter', sans-serif;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .raised-box {
        background-color: #fff;
        border: none;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        border-radius: 12px;
        animation: slideUp 0.8s ease;
    }

    .nice-input {
        width: 100%;
        padding: 12px 16px;
        font-size: 16px;
        font-family: 'Inter', sans-serif;
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
        margin-top: 10px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        appearance: none;
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

    .custom-alert {
        background: linear-gradient(135deg, #e3f2fd, #ffffff);
        border-left: 5px solid #2196f3;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        color: #0d47a1;
        font-size: 15px;
        animation: slideUp 0.6s ease;
    }

    .custom-alert a {
        color: #1565c0;
        font-weight: 600;
    }

    .login-logo {
        display: block;
        margin: 0 auto 1rem auto;
        max-width: 120px;
        animation: slideUp 1s ease;
    }

    h4 {
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.04);
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="custom-alert">
                <strong>Dear Applicant,</strong><br>
                Welcome to the <strong>Kenya Paediatric Fellowship Program (KPFP)</strong> Scholarships Portal.<br>
                If you're new here, create an account by clicking <a href="{{route('enroll.create')}}">here</a> or use the <b>"Create Account"</b> link beside the "Login" button.<br>
                <br><strong>Already registered?</strong> Please log in using the form below.
            </div>

            <div class="card raised-box">
                <div class="card-body">
                    <center>
                        <img class="login-logo" src="{{ asset('img/KPFP.png') }}" alt="KPFP Logo">
                        <h4>{{ trans('panel.site_title') }}</h4>
                    </center>

                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-wrapper mb-3">
                            <i class="fa fa-user"></i>
                            <input id="email" name="email" type="text" class="nice-input {{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
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
                            <span class="checkbox-label">{{ trans('global.remember_me') }}</span>
                        </label>

                        <div class="row mt-4">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">{{ trans('global.login') }}</button><br><br>
                                <small>No Account? <a href="{{route('enroll.create')}}">Create Account</a></small>
                            </div>
                            <div class="col-6 text-right">
                                @if(Route::has('password.request'))
                                    <a class="btn btn-link px-0" href="{{ route('password.request.custom') }}">{{ trans('global.forgot_password') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
