<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập với OTP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            const phoneNumber = document.getElementById("number").value.trim();
            const appVerifier = window.recaptchaVerifier;

            // Gửi OTP
            signInWithPhoneNumber(auth, phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    window.confirmationResult = confirmationResult;
                    document.getElementById("sentMessage").innerHTML = "OTP đã được gửi!";
                    document.getElementById("sentMessage").style.display = "block";

                    // Ẩn form nhập số điện thoại và hiện form OTP
                    document.getElementById("phone-popup").style.display = "none";
                    document.getElementById("otp-popup").style.display = "block";
                }).catch((error) => {
                    document.getElementById("error").innerHTML = "Có lỗi xảy ra! Vui lòng thử lại.";
                    document.getElementById("error").style.display = "block";
                });
        }

        window.verifyCode = function() {
            let otpCode = '';
            document.querySelectorAll('.otp-input').forEach(input => otpCode += input.value);

            window.confirmationResult.confirm(otpCode).then((result) => {
                const phoneNumber = document.getElementById("number").value.trim(); // Chỉ lấy số điện thoại
                fetch('{{ route('verify.code') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            phone: phoneNumber, // Chỉ gửi số điện thoại
                            verificationCode: otpCode
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ route('client.index') }}";
                        } else {
                            document.getElementById("error").innerHTML = data.message;
                            document.getElementById("error").style.display = "block";
                        }
                    })
                    .catch(error => {
                        document.getElementById("error").innerHTML = "Có lỗi xảy ra. Vui lòng thử lại.";
                        document.getElementById("error").style.display = "block";
                    });
            }).catch((error) => {
                document.getElementById("error").innerHTML = "Mã OTP không đúng!";
                document.getElementById("error").style.display = "block";
            });
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 10;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9;
        }

        .otp-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 24px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .otp-container {
            display: flex;
            justify-content: center;
        }

        button {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        #error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Đăng Nhập</h1>

    <!-- Form nhập số điện thoại -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="phone-popup" style="display: block;">
        <form id="phone-form">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="number" name="phone" placeholder="+84123456789" required>
            <div id="recaptcha-container"></div>
            <button type="button" id="send-otp" onclick="sendOTP()">Gửi OTP</button>
        </form>
    </div>


    <!-- Form nhập OTP -->
    <div class="popup" id="otp-popup">
        <form id="otp-verification-form">
            <label for="verificationCode">Nhập mã OTP</label>
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
            </div>
            <button type="button" onclick="verifyCode()">Xác thực</button>
        </form>
    </div>

    <div id="error" style="display: none;"></div>
    <div id="sentMessage" style="display: none;"></div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
        });
    </script>
</body>

</html>
