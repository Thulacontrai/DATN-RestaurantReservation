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
