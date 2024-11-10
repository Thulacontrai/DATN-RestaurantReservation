<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập với OTP</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }

        .login-container img {
            width: 80px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 26px;

            margin-bottom: 10px; /* Giảm khoảng cách dưới tiêu đề */
            font-weight: 600;
            color: #333;
        }

        #timeout-message {
            color: red;
            margin-top: 15px;

            display: none;
            /* Ẩn thông báo ban đầu */
            font-weight: bold;
            /* Làm cho thông báo nổi bật hơn */

        }

        input[type="text"],
        .otp-input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        .otp-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin: 20px 0;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        #error {
            color: red;
            margin-top: 15px;

            display: none; /* Ẩn thông báo lỗi ban đầu */

        }

        #sentMessage {
            color: green;
            margin-top: 15px;

            display: none; /* Ẩn thông báo đã gửi OTP ban đầu */

        }

        #countdown {
            font-size: 18px;
            color: #333;

            margin-top: 15px; /* Tạo khoảng cách với các ô nhập OTP */

        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="{{ asset('images/11b25f74-1f72-44cf-8b1b-d4bf2e3c0999.jpg') }}" alt="Logo" loading="lazy">

        <h1>Đăng Nhập</h1>

        <div id="timeout-message">Hết thời gian nhập mã OTP hãy Đăng Nhập lại.</div>
        <!-- Thông báo đăng nhập lại ở đây -->


        <div id="phone-popup" style="display: block;">
            <form id="phone-form">
                <input type="text" id="number" name="phone" placeholder="Nhập số điện thoại" required>
                <div id="recaptcha-container"></div>
                <button type="button" id="send-otp" onclick="sendOTP()">Gửi OTP</button>
            </form>
        </div>

        <div id="otp-popup" style="display: none;">
            <form id="otp-verification-form">
                <div class="otp-container">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                    <input type="text" class="otp-input" maxlength="1">
                </div>
                <div id="countdown">Thời gian còn lại: <span id="time">90</span> giây</div>
                <button type="button" onclick="verifyCode()">Xác thực</button>
            </form>
        </div>

        <div id="error"></div>
        <div id="sentMessage"></div>
    </div>

    <script type="module" defer>
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

        window.onload = function () {
            renderRecaptcha();
        }

        function renderRecaptcha() {
            window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
                'size': 'normal',
                'callback': function (response) { },
                'expired-callback': function () { }
            }, auth);

            recaptchaVerifier.render().then(function () {
                console.log('Recaptcha rendered');
            }).catch(function (error) {
                console.error("Error rendering recaptcha:", error);
            });
        }

        let countdownTimer;
        let timeRemaining = 90; // Thời gian bắt đầu


        window.sendOTP = function() {

            let phoneNumber = document.getElementById("number").value.trim();
            if (phoneNumber.startsWith("0")) {
                phoneNumber = '+84' + phoneNumber.slice(1);
            }

            if (!phoneNumber.match(/^\+\d{1,15}$/)) {
                document.getElementById("error").innerHTML =
                    "Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại đúng định dạng.";

                document.getElementById("error").style.display = "block";
                return;
            }

            const appVerifier = window.recaptchaVerifier;

            signInWithPhoneNumber(auth, phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    window.confirmationResult = confirmationResult;
                    document.getElementById("sentMessage").innerHTML = "OTP đã được gửi!";
                    document.getElementById("sentMessage").style.display = "block";
                    document.getElementById("error").style.display = "none"; // Ẩn thông báo lỗi nếu có

                    document.getElementById("phone-popup").style.display = "none";
                    document.getElementById("otp-popup").style.display = "block";

                    startCountdown(); // Bắt đầu đếm ngược
                }).catch((error) => {
                    document.getElementById("error").innerHTML = "Có lỗi xảy ra! Vui lòng thử lại.";
                    document.getElementById("error").style.display = "block";
                });
        }

        function startCountdown() {
            timeRemaining = 90; // Đặt lại thời gian
            document.getElementById("time").innerText = timeRemaining; // Hiển thị thời gian ban đầu
            document.getElementById("countdown").style.display = "block"; // Hiển thị đếm ngược
            document.getElementById("timeout-message").style.display = "none"; // Ẩn thông báo hết thời gian
            document.getElementById("sentMessage").style.display = "block"; // Hiển thị thông báo OTP đã gửi

            countdownTimer = setInterval(() => {
                timeRemaining--;
                document.getElementById("time").innerText = timeRemaining;

                if (timeRemaining <= 0) {
                    clearInterval(countdownTimer);
                    document.getElementById("otp-popup").style.display = "none"; // Ẩn popup OTP
                    document.getElementById("sentMessage").style.display = "none"; // Ẩn thông báo OTP đã gửi

                    document.getElementById("timeout-message").style.display =
                    "block"; // Hiển thị thông báo hết thời gian

                    console.log("OTP expired. Showing timeout message."); // Ghi log khi thông báo được hiển thị
                    setTimeout(() => {
                        location.reload(); // Tải lại trang sau 3 giây
                    }, 3000);
                }
            }, 1000);
        }


        window.verifyCode = function() {

            let otpCode = '';
            document.querySelectorAll('.otp-input').forEach(input => otpCode += input.value);

            console.log("Verifying OTP:", otpCode); // Ghi log mã OTP được xác minh

            window.confirmationResult.confirm(otpCode).then((result) => {
                const phoneNumber = document.getElementById("number").value.trim();
                fetch('{{ route('verify.code') }}', {

                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        body: JSON.stringify({
                            phone: phoneNumber,
                            verificationCode: otpCode
                        })

                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ route('client.index') }}";
                        } else {
                            document.getElementById("error").innerHTML = data.message;

                            console.log("Verification failed:", data
                            .message); // Ghi log khi xác minh thất bại

                        }
                    })
                    .catch(error => {
                        document.getElementById("error").innerHTML = "Có lỗi xảy ra. Vui lòng thử lại.";
                        document.getElementById("error").style.display = "block";
                        console.error("Error during verification:", error); // Ghi log lỗi khi xác minh
                    });
            }).catch((error) => {
                document.getElementById("error").innerHTML = "Mã OTP không đúng!";
                document.getElementById("error").style.display = "block";
                console.error("Invalid OTP:", error); // Ghi log khi mã OTP không đúng
            });
        }

        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace') {
                    if (input.value === '' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }
            });
        });
    </script>
</body>

</html>
