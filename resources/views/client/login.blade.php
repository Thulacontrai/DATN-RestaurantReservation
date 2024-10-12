@extends('client.layouts.master')
@section('title', 'Login')

@section('content')
    
@include('client.layouts.component.subheader', [
    'backgroundImage' => 'client/03_images/background/bg-6.jpg',
    'subtitle' => 'Get in',
    'title' => 'Touch',
    'currentPage' => 'Login',
])

<div id="content" class="no-bottom no-top">

    <div class="login-container">
        <h3 class="text-center">Welcome Back</h3>


        <form id="loginForm" method="POST" action="">
            @csrf
            <div class="form-group mb-3">
                <label for="phoneNumber">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text">🇺🇸 +1</span>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter phone number" required>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('client.login') }}">

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                {{-- <a class="btn btn-link" href="{{ route('register') }}">
                                    Register
                                </a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100">Submit</button>
        </form>

        <form id="otpForm" method="POST" action="" style="">
            @csrf
            <div class="form-group text-center my-3">
                <label>One Time Password</label>
                <div>
                    <input type="text" maxlength="1" class="otp-input" name="otp1">
                    <input type="text" maxlength="1" class="otp-input" name="otp2">
                    <input type="text" maxlength="1" class="otp-input" name="otp3">
                    <input type="text" maxlength="1" class="otp-input" name="otp4">
                </div>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <small><a href="#" id="resendOtp">Resend OTP in <span id="timer">05:15</span></a></small>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="terms">
                <label class="form-check-label" for="terms">
                    I agree to <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </form>

        <div class="text-center my-3">
            <p>Don't have an account? <a href="#">Sign Up</a></p>
            <a href="#" class="btn btn-outline-secondary w-100">Continue as Guest</a>
        </div>
    </div>
@endsection
