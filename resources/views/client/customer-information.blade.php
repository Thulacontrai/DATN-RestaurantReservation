@extends('client.layouts.master')
@section('title', 'Booking')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-2.jpg',
        'subtitle' => 'Make a',
        'title' => 'Reservation',
        'currentPage' => 'Booking',
    ])

    <div id="content" class="no-bottom no-top">
        <section id="section-book-form">
            <div class="container border">
                <div class="row text-center">
                    <div class="col bg-secondary p-2 text-uppercase">
                        <h6><a href="{{ route('booking.client') }}">Bước 1 - Chọn giờ ăn</a></h6>
                    </div>
                    <div class="col bg-warning p-2 text-uppercase">
                        <h6>Bước 2 - Thông tin khách hàng</h6>
                    </div>
                </div>
                <div class="row bg-dark ">
                    <h6 class="text-center mt-4 mb-2">Mời bạn nhập thông tin để đặt bàn</h6>
                    <form id="booking-form" action="{{ route('createReservation.client') }}" method="POST">
                        @csrf
                        <div class="row m-4 d-flex justify-content-center">
                            <div class="col">
                                <label for="user_name">Tên khách hàng*</label>
                                <input class="form-control" type="text" name="user_name" id="user_name"
                                    placeholder="Nhập tên khách hàng"
                                    value="{{ old('user_name') ?? ($data['user_name'] ?? null) }}">
                                @error('user_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="user_phone">Số điện thoại*</label>
                                <input class="form-control" type="text" name="user_phone" id="user_phone"
                                    placeholder="Nhập số điện thoại"
                                    value="{{ old('user_phone') ?? ($data['user_phone'] ?? null) }}">
                                @error('user_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                               
                            </div>

                            <div class="col">
                                <label for="guest_count">Số người đặt bàn*</label>
                                <input class="form-control" type="text" name="guest_count" id="guest_count"
                                    placeholder="Nhập số người đặt bàn"
                                    value="{{ old('guest_count') ?? ($data['guest_count'] ?? null) }}">
                                @error('guest_count')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-4 d-flex justify-content-center">
                            <div>
                                <label for="note">Ghi chú thêm</label>
                                <input class="form-control" type="text" name="note" id="note"
                                    placeholder="Nhập ghi chú" value="{{ old('note') ?? ($data['note'] ?? null) }}">
                            </div>
                        </div>
                        @if (isset($date) && isset($time))
                            <input type="hidden" name="reservation_date" value="{{ $date }}">
                            <input type="hidden" name="reservation_time" value="{{ $time }}">
                        @else
                            <div class="alert alert-danger">Không có ngày hoặc giờ đặt bàn! Vui lòng quay lại bước trước.
                            </div>
                        @endif
                             <!-- Căn chỉnh reCAPTCHA ra giữa -->
                             <div id="recaptcha-container" class="mt-3"></div>


                        <div class="row m-4 d-flex justify-content-center">
                             <!-- Căn chỉnh reCAPTCHA ra giữa -->
                                <div id="recaptcha-container" class="mt-3"></div>
                            <div class="col-2">
                                <a href="{{ route('booking.client') }}" class="text-secondary">Quay lại</a>
                            </div>
                            <div class="col-2">


                                <button type="button" class="btn-line" onclick="sendOTP()">Xác nhận</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    @include('client.layouts.partials.customer-information')

    <!-- Popup OTP -->
    <div id="otp-popup" class="overlay" style="display:none;">
        <div class="popup1">
            <h4 style="color: rgb(0, 154, 250)">Nhập mã OTP</h4>
            <div id="otp-timer" class="text-danger"></div> <!-- Thêm phần hiển thị bộ đếm thời gian -->
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
            </div>
            <button type="button" class="btn-success mt-2" onclick="verifyCode()">Xác thực OTP</button>
            <button id="closePopupButton" class="btn-danger mt-2">Đóng</button>
        </div>
    </div>

    <style>
        /* Style cho popup OTP */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup1 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .otp-input1 {
            width: 40px;
            height: 40px;
            font-size: 24px;
            text-align: center;
            margin: 5px;
        }

        /* Căn chỉnh lại reCAPTCHA cho đúng vị trí trung tâm */
        #recaptcha-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
@endsection

@include('client.layouts.partials.js')
