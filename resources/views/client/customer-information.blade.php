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
    <!-- Popup OTP -->
    <div id="otp-popup" class="overlay" style="display:none;">
        <div class="popup1">
            <h4 style="color: rgb(0, 154, 250)">Nhập mã OTP</h4>
            <div id="otp-timer" class="text-danger"></div> <!-- Hiển thị bộ đếm thời gian -->
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
            </div>
            <div id="otp-error-message" class="text-danger" style="margin-top: 10px; display: none;"></div>
            <!-- Thông báo lỗi -->
            <div class="button-container">
                <button id="closePopupButton" class="btn-dark">Đóng</button>
                <button type="button" class="btn-success" onclick="verifyCode()">Xác thực OTP</button>
                <button id="resendOtpButton" class="btn-primary" onclick="resendOTP()" style="display: none;">Gửi lại mã
                    OTP</button>
            </div>
        </div>
    </div>


    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            /* Đảm bảo các nút được căn đều */
            gap: 15px;
            /* Khoảng cách giữa các nút */
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 25px;
            /* Đồng nhất kích thước nút */
            border-radius: 5px;
            font-size: 16px;
            /* Đảm bảo kích thước chữ đồng đều */
            cursor: pointer;
            border: none;
            /* Loại bỏ viền mặc định */
            color: white;
            transition: background-color 0.3s ease;
        }

        .button-container .btn-primary {
            background-color: #007bff;
        }

        .button-container .btn-primary:hover {
            background-color: #0056b3;
            /* Màu khi hover */
        }

        .button-container .btn-success {
            background-color: #28a745;
        }

        .button-container .btn-success:hover {
            background-color: #1e7e34;
            /* Màu khi hover */
        }

        .button-container .btn-danger {
            background-color: #dc3545;
        }

        .button-container .btn-danger:hover {
            background-color: #b21f2d;
            /* Màu khi hover */
        }

        #recaptcha-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .popup1 {
            background: white;
            padding: 30px;
            /* Tăng khoảng padding */
            border-radius: 15px;
            /* Tăng độ bo góc */
            text-align: center;
            max-width: 500px;
            /* Tăng chiều rộng tối đa */
            width: 90%;
            /* Điều chỉnh phù hợp với kích thước màn hình */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            /* Tạo hiệu ứng nổi */
        }

        .popup1 h4 {
            color: rgb(0, 154, 250);
            font-size: 1.5rem;
            /* Tăng kích thước chữ */
            margin-bottom: 20px;
        }

        .otp-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            /* Tăng khoảng cách giữa các ô nhập */
            margin-bottom: 20px;
        }

        .otp-input {
            width: 50px;
            /* Tăng chiều rộng */
            height: 50px;
            /* Tăng chiều cao */
            font-size: 24px;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            /* Căn giữa các nút */
            gap: 15px;
            /* Khoảng cách giữa các nút */
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>

@endsection

@include('client.layouts.partials.js');
