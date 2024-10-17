@extends('client.layouts.master')
@section('title', 'Member')

@section('content')

    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-6.jpg',
        'subtitle' => 'Get in',
        'title' => 'Touch',
        'currentPage' => 'Member',
    ])

    <div id="content" class="no-bottom no-top">
        <div class="container ">

            <!-- Phần thông tin tài khoản -->
            <div class="text-center my-4">
                {{-- <img src="{{ $memberData['avatar'] }}" alt="Avatar" class="avatar mb-3"> --}}
                {{-- <h5>{{ $memberData['name'] }}</h5> --}}
            </div>

            <!-- Mã vạch -->

            <!-- Thông tin thành viên -->
            <div class="row text-center mb-3">
                <div class="col-6">
                    {{-- <h5 class="">{{ $memberData['total_spend'] }}</h5> --}}
                    <p>Tổng chi tiêu</p>
                </div>
                <div class="col-6">
                    {{-- <h5 class="">{{ $memberData['reward_points'] }}</h5> --}}
                    <p>Điểm thưởng</p>
                </div>
            </div>

            <!-- Danh sách tùy chọn -->
            <ul class="list-group mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Điểm
                    <span><i class="bi bi-chevron-right"></i></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal"
                    data-bs-target="#bookingModal">
                    Đơn đặt bàn
                    <span><i class="bi bi-chevron-right"></i></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal"
                    data-bs-target="#accountInfoModal">
                    Thông tin tài khoản
                    <span><i class="bi bi-chevron-right"></i></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Lịch sử giao dịch
                    <span><i class="bi bi-chevron-right"></i></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Xóa tài khoản
                    <span><i class="bi bi-chevron-right"></i></span>
                </li>
            </ul>

            <!-- Nút Đăng xuất -->
            <div class="text-center mt-2">
                <form action="{{ route('client.logout') }}" method="POST">
                    @csrf
                    <button type="submit">Đăng xuất</button>
                </form>
            </div>


            <!-- Modal Thông tin tài khoản -->
            <div class="modal fade" id="accountInfoModal" tabindex="-1" aria-labelledby="accountInfoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="accountInfoModalLabel">Thông tin tài khoản</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('member.update') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $member->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $member->phone }}">
                                </div>
                               
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <!-- Modal Đổi mật khẩu -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('member.changePassword') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password">
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<!-- Các phần còn lại của nội dung trang -->

<!-- Modal Đơn đặt bàn -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Thay đổi kích thước modal -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white"> <!-- Đổi màu header -->
                <h5 class="modal-title" id="bookingModalLabel">Thông tin Đơn đặt bàn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Hiển thị dữ liệu dưới dạng danh sách -->
            <div class="modal-body">
                @if (isset($bookingData) && $bookingData->isNotEmpty())
                    @foreach ($bookingData as $booking)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Đơn đặt bàn #{{ $booking->id }}</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Ngày đặt bàn:</strong> {{ $booking->reservation_date }}</li>
                                    <li class="list-group-item"><strong>Tên khách hàng:</strong> {{ $booking->user_name }}</li>
                                    <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $booking->user_phone }}</li>
                                    <li class="list-group-item"><strong>Số lượng khách:</strong> {{ $booking->guest_count }}</li>
                                    <li class="list-group-item"><strong>Giờ đặt bàn:</strong> {{ $booking->reservation_time }}</li>
                                    <li class="list-group-item"><strong>Số tiền đặt cọc:</strong> {{ $booking->deposit_amount }}</li>
                                    <li class="list-group-item"><strong>Ghi chú:</strong> {{ $booking->note }}</li>
                                    <li class="list-group-item"><strong>Trạng thái:</strong> 
                                        <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="mt-3">
                                    <!-- Nút hủy đặt bàn với xác nhận OTP -->
                                    <button type="button" class="btn btn-danger btn-sm" onclick="showCancelModal({{ $booking->id }})">
                                        Hủy đặt bàn
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Không có thông tin đặt bàn để hiển thị.</p>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal xác nhận hủy đặt bàn -->
<div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelBookingModalLabel">Hủy Đặt Bàn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn hủy đặt bàn này? Vui lòng xác nhận bằng mã OTP.</p>
                <form id="cancel-phone-form">
                    <label for="cancel-phone">Số điện thoại:</label>
                    <input type="tel" id="cancel-phone-number" name="phone" placeholder="+84123456789" required>
                    <div id="recaptcha-container"></div>
                    <button type="button" id="send-cancel-otp" onclick="sendCancelOTP()">Gửi OTP</button>
                </form>
                
                <form id="otp-verification-form-cancel" style="display: none;">
                    <label for="verificationCode">Nhập mã OTP</label>
                    <input type="text" id="cancelVerificationCode" name="verificationCode" placeholder="Nhập mã OTP" required>
                    <button type="button" onclick="verifyCancelCode()">Xác thực</button>
                </form>
                <div id="cancel-error" style="display: none;"></div>
                <div id="cancel-sentMessage" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>

<script>
    // Cấu hình Firebase
    const firebaseConfig = {
        apiKey: "AIzaSyDRiOTYCQgDDemeF7QCunNMvlhPwmhh9Tc",
        authDomain: "datn-5b062.firebaseapp.com",
        projectId: "datn-5b062",
        storageBucket: "datn-5b062.appspot.com",
        messagingSenderId: "630325973482",
        appId: "1:630325973482:web:18498f0416b4123f05e293",
        measurementId: "G-HRQ5XG4ELN"
    };

    // Khởi tạo Firebase
    firebase.initializeApp(firebaseConfig);

    // Khởi tạo reCAPTCHA
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        size: 'invisible',
        callback: function(response) {
            // Xử lý sau khi reCAPTCHA được xác nhận
        }
    });

    // Hàm gửi OTP
function sendCancelOTP() {
    const phoneNumber = document.getElementById("cancel-phone-number").value.trim();
    const appVerifier = window.recaptchaVerifier;

    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        .then((confirmationResult) => {
            window.confirmationResult = confirmationResult;
            console.log("OTP đã được gửi thành công");
            document.getElementById("cancel-sentMessage").innerHTML = "OTP đã được gửi!";
            document.getElementById("cancel-sentMessage").style.display = "block";
            document.getElementById("otp-verification-form-cancel").style.display = "block"; 
        }).catch((error) => {
            console.error("Lỗi khi gửi OTP:", error);
            document.getElementById("cancel-error").innerHTML = "Có lỗi xảy ra: " + error.message;
            document.getElementById("cancel-error").style.display = "block";
        });
}

// Hàm hiển thị modal hủy đặt bàn
function showCancelModal(bookingId) {
    window.currentBookingId = bookingId;
    
    // Lấy số điện thoại từ form hoặc data attribute
    const phoneInput = document.getElementById("cancel-phone-number");
    const reservationPhone = phoneInput.getAttribute('data-reservation-phone');
    
    // Chuẩn hóa và hiển thị số điện thoại
    if (reservationPhone) {
        let normalizedPhone = reservationPhone;
        if (!normalizedPhone.startsWith('+84')) {
            normalizedPhone = '+84' + normalizedPhone.replace(/^0/, '');
        }
        phoneInput.value = normalizedPhone;
    }
    
    const modal = new bootstrap.Modal(document.getElementById('cancelBookingModal'));
    modal.show();
}

// Hàm xác thực mã OTP
function verifyCancelCode() {
    const code = document.getElementById("cancelVerificationCode").value;
    window.confirmationResult.confirm(code).then((result) => {
        console.log("Xác thực OTP thành công");
        const user = result.user;
        console.log("User phone number:", user.phoneNumber);
        
        // Gửi cả số điện thoại đã xác thực tới server
        cancelBooking(window.currentBookingId, user.phoneNumber);
    }).catch((error) => {
        console.error("Lỗi xác thực OTP:", error);
        document.getElementById("cancel-error").innerHTML = "Mã OTP không đúng. Vui lòng thử lại.";
        document.getElementById("cancel-error").style.display = "block";
    });
}

// Sửa lại hàm cancelBooking để nhận thêm số điện thoại
function cancelBooking(bookingId, phoneNumber) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found');
        alert("Có lỗi xảy ra. Vui lòng tải lại trang và thử lại.");
        return;
    }

    fetch(`/api/cancel-booking/${bookingId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        body: JSON.stringify({
            phone_number: phoneNumber
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Đặt bàn đã được hủy thành công!");
            bootstrap.Modal.getInstance(document.getElementById('cancelBookingModal')).hide();
            location.reload();
        } else {
            alert("Có lỗi xảy ra khi hủy đặt bàn: " + (data.message || "Vui lòng thử lại sau."));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
    });
}

// Đảm bảo rằng CSRF token được tải khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    const metaTag = document.createElement('meta');
    metaTag.name = 'csrf-token';
    metaTag.content = '{{ csrf_token() }}';
    document.head.appendChild(metaTag);
});
</script>

@endsection
