<!-- Javascript Files
    ================================================== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $('#cancelTableConfirm').on('click', function() {
        $('#cancelModal').modal('show');
    });
    $(document).ready(function() {
        var selectedTime = null;
        var selectedDate = null;

        // Khi người dùng bấm vào ngày
        $('.day-selector').click(function() {
            var index = $(this).data('index'); // Lấy chỉ số của ngày được bấm

            // Ẩn tất cả các khung thời gian
            $('.time-slots').hide();

            // Hiển thị khung thời gian của ngày được chọn
            $('#day-' + index).show();

            // Đổi màu chữ cho ngày đã chọn
            $('.day-selector .fw-bold').removeClass('text-warning').addClass('text-light');
            $(this).find('.fw-bold').removeClass('text-light').addClass('text-warning');
        });

        // Khi người dùng chọn khung giờ
        $('.time-slot').click(function() {
            // Bỏ chọn khung giờ trước đó
            $('.time-slot').removeClass('bg-warning');
            $('.time-slot p').removeClass('text-light').addClass(
                'text-warning');

            // Đánh dấu khung giờ được chọn
            $(this).addClass('bg-warning');
            $(this).find('p').removeClass('text-warning').addClass(
                'text-light');

            // Lưu lại khung giờ và ngày được chọn
            selectedTime = $(this).data('time');
            selectedDate = $(this).data('date');
        });

        $('#confirm-button').click(function() {

            function convertDateFormat(dateStr) {
                const [year, month, day] = dateStr.split("-");
                return `${day}-${month}-${year}`;
            }
            if (selectedTime && selectedDate) {
                Swal.fire({
                    icon: "question",
                    html: 'Bạn đã chọn thời gian dùng bữa lúc <b>' + selectedTime +
                        '</b> vào ngày <b>' + convertDateFormat(selectedDate) + '</b>',
                    title: 'Vui lòng xác nhận!',
                    showCancelButton: true,
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = '/customerInformation?date=' + encodeURIComponent(
                                selectedDate) +
                            '&time=' +
                            encodeURIComponent(selectedTime);
                        window.location.href = url;
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: "Vui lòng chọn khung giờ!",
                    timer: 4000
                });
            }
        });

    });
</script>
{{-- // Hiệp --}}


<script>
    function showSection(sectionId) {
        // Hide all sections first
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show the clicked section
        document.getElementById(sectionId).style.display = 'block';
    }

    // edit thông tin

    function toggleEdit() {
        // Ẩn các phần hiển thị và hiện các input để chỉnh sửa
        document.getElementById('displayName').style.display = 'none';
        document.getElementById('inputName').style.display = 'inline';

        document.getElementById('displayPhone').style.display = 'none';
        document.getElementById('inputPhone').style.display = 'inline';

        document.getElementById('displayEmail').style.display = 'none';
        document.getElementById('inputEmail').style.display = 'inline';

        document.getElementById('displayLocation').style.display = 'none';
        document.getElementById('inputLocation').style.display = 'inline';

        // Ẩn nút "Chỉnh sửa thông tin" và hiện nút "Lưu thay đổi"
        document.getElementById('editButton').style.display = 'none';
        document.getElementById('saveButton').style.display = 'inline';
    }

    function saveChanges() {
        // Lấy giá trị từ các input sau khi chỉnh sửa
        const name = document.getElementById('inputName').value;
        const phone = document.getElementById('inputPhone').value;
        const email = document.getElementById('inputEmail').value;
        const location = document.getElementById('inputLocation').value;

        // Gửi dữ liệu đến server bằng Ajax hoặc submit form
        // Dưới đây là ví dụ với Ajax
        fetch('/update-profile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Đừng quên token CSRF
                },
                body: JSON.stringify({
                    name: name,
                    phone: phone,
                    email: email,
                    location: location
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật các giá trị mới vào phần hiển thị
                    document.getElementById('displayName').innerText = name;
                    document.getElementById('displayPhone').innerText = phone;
                    document.getElementById('displayEmail').innerText = email;
                    document.getElementById('displayLocation').innerText = location;

                    // Ẩn các input và hiển thị lại phần thông tin sau khi lưu
                    document.getElementById('inputName').style.display = 'none';
                    document.getElementById('displayName').style.display = 'inline';

                    document.getElementById('inputPhone').style.display = 'none';
                    document.getElementById('displayPhone').style.display = 'inline';

                    document.getElementById('inputEmail').style.display = 'none';
                    document.getElementById('displayEmail').style.display = 'inline';

                    document.getElementById('inputLocation').style.display = 'none';
                    document.getElementById('displayLocation').style.display = 'inline';

                    // Ẩn nút "Lưu thay đổi" và hiển thị lại nút "Chỉnh sửa thông tin"
                    document.getElementById('saveButton').style.display = 'none';
                    document.getElementById('editButton').style.display = 'inline';
                } else {
                    alert('Đã xảy ra lỗi khi cập nhật thông tin.');
                }
            }).catch(error => console.error('Lỗi:', error));
    }


    // login
    document.getElementById('phoneOption').addEventListener('click', function() {
        document.getElementById('phoneOption').classList.add('active');
        document.getElementById('emailOption').classList.remove('active');
    });

    document.getElementById('emailOption').addEventListener('click', function() {
        document.getElementById('phoneOption').classList.remove('active');
        document.getElementById('emailOption').classList.add('active');
    });

    // Optional: Countdown timer for resending OTP
    let timeLeft = 315; // In seconds
    let timerElement = document.getElementById('timer');
    setInterval(function() {
        if (timeLeft <= 0) {
            document.getElementById('resendOtp').style.pointerEvents = 'auto';
        } else {
            timeLeft--;
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerElement.innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    }, 1000);


    $(document).ready(function() {
        var selectedTime = null;
        var selectedDate = null;

        // Khi người dùng bấm vào ngày
        $('.day-selector').click(function() {
            var index = $(this).data('index'); // Lấy chỉ số của ngày được bấm

            // Ẩn tất cả các khung thời gian
            $('.time-slots').hide();


            // Hiển thị khung thời gian của ngày được chọn
            $('#day-' + index).show();

            // Đổi màu chữ cho ngày đã chọn
            $('.day-selector .fw-bold').removeClass('text-warning').addClass('text-light');
            $(this).find('.fw-bold').removeClass('text-light').addClass('text-warning');
        });

        // Khi người dùng chọn khung giờ
        $('.time-slot').click(function() {
            // Bỏ chọn khung giờ trước đó
            $('.time-slot').removeClass('bg-warning');
            $('.time-slot p').removeClass('text-light').addClass(
                'text-warning');

            // Đánh dấu khung giờ được chọn
            $(this).addClass('bg-warning');
            $(this).find('p').removeClass('text-warning').addClass(
                'text-light');

            // Lưu lại khung giờ và ngày được chọn
            selectedTime = $(this).data('time');
            selectedDate = $(this).data('date');
        });

        $('#confirm-button').click(function() {

            function convertDateFormat(dateStr) {
                const [year, month, day] = dateStr.split("-");
                return `${day}-${month}-${year}`;
            }
            if (selectedTime && selectedDate) {
                Swal.fire({
                    icon: "question",
                    html: 'Bạn đã chọn thời gian dùng bữa lúc <b>' + selectedTime +
                        '</b> vào ngày <b>' + convertDateFormat(selectedDate) + '</b>',
                    title: 'Vui lòng xác nhận!',
                    showCancelButton: true,
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = '/customerInformation?date=' + encodeURIComponent(
                                selectedDate) +
                            '&time=' +
                            encodeURIComponent(selectedTime);
                        window.location.href = url;
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: "Vui lòng chọn khung giờ!",
                    timer: 4000
                });
            }
        });

    });
</script>

<script src="client/js/plugins.js"></script>
<script src="client/js/designesia.js"></script>

<!-- RS5.0 Core JS Files -->
<script src="client/revolution/js/jquery.themepunch.tools.min838f.js?rev=5.0"></script>
<script src="client/revolution/js/jquery.themepunch.revolution.min838f.js?rev=5.0"></script>

<!-- RS5.0 Extensions Files -->
<script src="client/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.parallax.min.js"></script>



<script>
    jQuery(document).ready(function() {
        // revolution slider
        jQuery("#revolution-slider").revolution({
            sliderType: "standard",
            sliderLayout: "fullscreen",
            delay: 3500,
            navigation: {
                arrows: {
                    enable: true
                }
            },
            parallax: {
                type: "mouse",
                origo: "slidercenter",
                speed: 2000,
                levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
            },
            spinner: "off",
            gridwidth: 1140,
            gridheight: 600,
            disableProgressBar: "on"
        });
    });
</script>



<!-- Lộc -->
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

    let countdownTimer;
    let timeRemaining = 90; // Thời gian bắt đầu

    window.onload = function() {
        renderRecaptcha();
        document.getElementById('closePopupButton').onclick = closePopup;
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

        if (phoneNumber.startsWith("0")) {
            phoneNumber = '+84' + phoneNumber.slice(1); // Thay thế '0' bằng '+84'
        }

        if (!phoneNumber.match(/^\+\d{1,15}$/)) {
            alert("Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại đúng định dạng.");
            return;
        }

        const appVerifier = window.recaptchaVerifier;

        signInWithPhoneNumber(auth, phoneNumber, appVerifier)
            .then((confirmationResult) => {
                window.confirmationResult = confirmationResult;
                document.getElementById("otp-popup").style.display = "flex"; // Hiển thị popup OTP
                startOTPTimer(); // Bắt đầu bộ đếm thời gian
            }).catch((error) => {
                console.error("Error sending OTP:", error);
                alert("Có lỗi xảy ra khi gửi OTP! Vui lòng thử lại.");
            });
    }

    let otpTimer; // Khai báo biến bộ đếm thời gian

    function startOTPTimer() {
        let timeLeft = 90; // 90 giây
        document.getElementById("otp-timer").innerText = `Thời gian còn lại: ${timeLeft} giây`;

        otpTimer = setInterval(() => {
            timeLeft--;
            document.getElementById("otp-timer").innerText = `Thời gian còn lại: ${timeLeft} giây`;

            if (timeLeft <= 0) {
                clearInterval(otpTimer);
                alert("Thời gian nhập OTP đã hết! Vui lòng thử lại.");
                closePopup(); // Đóng popup
            }
        }, 1000);
    }


    window.verifyCode = function() {
        let otpCode = '';
        document.querySelectorAll('.otp-input').forEach(input => otpCode += input.value);

        window.confirmationResult.confirm(otpCode).then((result) => {
            alert('Xác thực OTP thành công! Đang xử lý đặt bàn.');

            // Lưu trạng thái xác thực OTP vào session qua AJAX
            fetch('{{ route('storeOtpSession') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    otpVerified: true
                })
            }).then(() => {
                document.getElementById("booking-form")
            .submit(); // Sau khi xác thực thành công, submit form
            });

        }).catch((error) => {
            alert("Mã OTP không đúng! Vui lòng thử lại.");
        });
    }

    function closePopup() {
        clearInterval(countdownTimer); // Dừng bộ đếm nếu popup bị đóng
        document.getElementById("otp-popup").style.display = "none";
    }

    window.onclick = function(event) {
        const popup = document.getElementById("otp-popup");
        if (event.target === popup) {
            closePopup();
        }
    };

    // Bắt sự kiện nhấn nút đóng popup
    document.getElementById('closePopupButton').onclick = closePopup;

    // Script to handle OTP input with focus control and deletion
    document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
        input.addEventListener('keydown', (event) => {
            if (event.key === 'Backspace' && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });

        input.addEventListener('input', (event) => {
            const value = event.target.value;

            if (value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
    });
</script>


{{-- <script>
    // Chặn click chuột phải
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Chặn F12 (mở console)
    document.onkeydown = function(e) {
        if (e.key == 'F12') {
            e.preventDefault();
            return false;
        }
    };
</script> --}}
