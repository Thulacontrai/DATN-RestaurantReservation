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
                                    placeholder="Nhập tên khách hàng" value="{{ old('user_name') }}">
                                @error('user_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="user_phone">Số điện thoại*</label>
                                <input class="form-control" type="text" name="user_phone" id="user_phone"
                                    placeholder="Nhập số điện thoại" value="{{ old('user_phone') }}">
                                @error('user_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div id="recaptcha-container"></div> 
                            </div>

                            <div class="col">
                                <label for="guest_count">Số người đặt bàn*</label>
                                <input class="form-control" type="text" name="guest_count" id="guest_count"
                                    placeholder="Nhập số người đặt bàn" value="{{ old('guest_count') }}">
                                @error('guest_count')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row m-4 d-flex justify-content-center">
                                <div>
                                    <label for="note">Ghi chú thêm</label>
                                    <input class="form-control" type="text" name="note" id="note"
                                        placeholder="Nhập ghi chú" value="{{old('note')}}">
                                </div>
                            </div>
                        </div>
                        @if(isset($date) && isset($time))
                        <input type="hidden" name="reservation_date" value="{{ $date }}">
                        <input type="hidden" name="reservation_time" value="{{ $time }}">
                    @else
                        <div class="alert alert-danger">Không có ngày hoặc giờ đặt bàn! Vui lòng quay lại bước trước.</div>
                    @endif
                    


                        <div class="row m-4 d-flex justify-content-center">
                            <div class="col-2">
                                <a href="{{ route('booking.client') }}" class="text-secondary">Quay lại</a>
                            </div>
                            <div class="col-2">

                                <button type="button" class="btn-line" onclick="sendOTP()">Xác nhận</button>

                            </div>

                        </div>
                    </form>

                    <!-- Modal OTP -->
                    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="otpModalLabel">Xác thực OTP</h5>                            
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="otp_code" class="form-control" placeholder="Nhập mã OTP">
                                    <div id="otpError" class="alert alert-danger mt-2 d-none">Mã OTP không chính xác!</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="verifyOtpButton" class="btn-primary">Xác nhận OTP</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Popup OTP -->
    <div id="otp-popup" class="overlay" style="display:none;">
        <div class="popup">
            <h4 style="color: aqua">Nhập mã OTP</h4>
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
            </div>
            <button type="button" class="btn-success mt-2" onclick="verifyCode()">Xác thực OTP</button>
            <button type="button" class="btn-danger mt-2" onclick="closePopup()">Đóng</button>
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
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .otp-input {
            width: 40px;
            height: 40px;
            font-size: 24px;
            text-align: center;
            margin: 5px;
        }
    </style>
@endsection

<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
    import {
        getAuth,
        RecaptchaVerifier,
        signInWithPhoneNumber
    } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-auth.js";

    const firebaseConfig = {
        apiKey: "AIzaSyDRiOTYCQgDDemeF7QCunNMvlhPwmhh9Tc",
        authDomain: "datn-5b062.firebaseapp.com",
        projectId: "datn-5b062",
        storageBucket: "datn-5b062.appspot.com",
        messagingSenderId: "630325973482",
        appId: "1:630325973482:web:18498f0416b4123f05e293",
        measurementId: "G-HRQ5XG4ELN"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

    window.onload = function() {
        renderRecaptcha();
    }

    function renderRecaptcha() {
    window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
        'size': 'normal',
        'callback': function(response) {},
        'expired-callback': function() {}
    }, auth);

    recaptchaVerifier.render().then(function() {
        console.log('Recaptcha rendered');
    }).catch(function(error) {
        console.error("Error rendering recaptcha:", error);
    });
}


    window.sendOTP = function() {
        let phoneNumber = document.getElementById("user_phone").value.trim();

        // Nếu số điện thoại bắt đầu bằng '0', chuyển sang định dạng +84
        if (phoneNumber.startsWith("0")) {
            phoneNumber = '+84' + phoneNumber.slice(1); // Thay thế '0' bằng '+84'
        }

        // Kiểm tra định dạng số điện thoại quốc tế (bắt đầu bằng dấu + và mã quốc gia)
        if (!phoneNumber.match(/^\+\d{1,15}$/)) {
            alert("Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại đúng định dạng.");
            return;
        }

        const appVerifier = window.recaptchaVerifier;

        signInWithPhoneNumber(auth, phoneNumber, appVerifier)
            .then((confirmationResult) => {
                window.confirmationResult = confirmationResult;
                document.getElementById("otp-popup").style.display = "flex"; // Hiển thị popup OTP
            }).catch((error) => {
                console.error("Error sending OTP:", error); // In lỗi ra console
                alert("Có lỗi xảy ra khi gửi OTP! Vui lòng thử lại.");
            });
    }



    window.verifyCode = function() {
    let otpCode = '';
    document.querySelectorAll('.otp-input').forEach(input => otpCode += input.value);

    window.confirmationResult.confirm(otpCode).then((result) => {
        alert('Xác thực OTP thành công! Đang xử lý đặt bàn.');

        // Lưu trạng thái xác thực OTP vào session qua AJAX
        fetch('{{ route("storeOtpSession") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                otpVerified: true
            })
        }).then(() => {
            document.getElementById("booking-form").submit(); // Sau khi xác thực thành công, submit form
        });

    }).catch((error) => {
        alert("Mã OTP không đúng! Vui lòng thử lại.");
    });
}



    function closePopup() {
        document.getElementById("otp-popup").style.display = "none";
    }
</script>




