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

        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDRiOTYCQgDDemeF7QCunNMvlhPwmhh9Tc",
            authDomain: "datn-5b062.firebaseapp.com",
            projectId: "datn-5b062",
            storageBucket: "datn-5b062.appspot.com",
            messagingSenderId: "630325973482",
            appId: "1:630325973482:web:18498f0416b4123f05e293",
            measurementId: "G-HRQ5XG4ELN"
        };

        // Initialize Firebase
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

        // Function to send OTP
        window.sendOTP = function() {
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const phoneNumber = document.getElementById("number").value.trim();
            const appVerifier = window.recaptchaVerifier;

            // Gửi yêu cầu kiểm tra tài khoản và mật khẩu
            $.ajax({
                url: '/check-account', // Đường dẫn tới controller checkAccount
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    phone: phoneNumber,
                    _token: "{{ csrf_token() }}" // Token CSRF để bảo mật
                },
                success: function(response) {
                    if (response.success) {
                        // Tài khoản hợp lệ, gửi OTP
                        signInWithPhoneNumber(auth, phoneNumber, appVerifier)
                            .then((confirmationResult) => {
                                window.confirmationResult = confirmationResult;
                                document.getElementById("sentMessage").innerHTML = "OTP đã được gửi!";
                                document.getElementById("sentMessage").style.display = "block";

                                // Hide phone form and show OTP verification form
                                document.getElementById("phone-form").style.display = "none";
                                document.getElementById("otp-verification-form").style.display =
                                "block";
                            }).catch((error) => {
                                document.getElementById("error").innerHTML =
                                    "Có lỗi xảy ra! Vui lòng thử lại.";
                                document.getElementById("error").style.display = "block";
                            });
                    } else {
                        // Tài khoản hoặc mật khẩu sai
                        document.getElementById("error").innerHTML = response.message;
                        document.getElementById("error").style.display = "block";
                    }
                }
            });
        }



        // Function to verify the OTP code
        window.verifiCode = function() {
            const code = document.getElementById("verificationCode").value.trim();
            const email = document.getElementById("email").value.trim();
            console.log('Mã OTP nhập vào:', code);

            if (!code) {
                document.getElementById("error").innerHTML = "Vui lòng nhập mã OTP!";
                document.getElementById("error").style.display = "block";
                return;
            }

            window.confirmationResult.confirm(code).then((result) => {
                // Gọi API để xác thực và đăng nhập
                fetch('{{ route('verify.code') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            email: email,
                            verificationCode: code
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
                        console.error("Error:", error);
                        document.getElementById("error").innerHTML = "Có lỗi xảy ra. Vui lòng thử lại.";
                        document.getElementById("error").style.display = "block";
                    });
            }).catch((error) => {
                console.error("Error while verifying code", error);
                document.getElementById("error").innerHTML = "Mã OTP không đúng! Vui lòng thử lại.";
                document.getElementById("error").style.display = "block";
            });
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        #error,
        #sentMessage {
            margin-top: 10px;
            font-size: 14px;
        }

        #error {
            color: red;
        }

        #sentMessage {
            color: green;
        }
    </style>
</head>

<body>
    <h1>Đăng Nhập</h1>

    <!-- Form nhập thông tin đăng nhập -->
    <form id="phone-form">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Nhập email" required>

        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>

        <label for="phone">Số điện thoại</label>
        <input type="text" id="number" name="phone" placeholder="+84123456789" required>

        <div id="recaptcha-container"></div>
        <button type="button" id="send-otp" onclick="sendOTP()">Gửi OTP</button>
    </form>

    <!-- Form nhập OTP -->
    <form id="otp-verification-form" style="display: none;">
        <label for="verificationCode">Nhập mã OTP</label>
        <input type="text" id="verificationCode" name="verificationCode" placeholder="Nhập mã OTP" required>
        <button type="button" onclick="verifiCode()">Xác thực</button>
    </form>

    <div id="error" style="display: none;"></div>
    <div id="sentMessage" style="display: none;"></div>
</body>

</html>
