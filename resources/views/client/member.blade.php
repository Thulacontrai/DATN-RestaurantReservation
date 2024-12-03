@extends('client.layouts.master')
@section('title', 'Member')
@section('css')
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Nhúng Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('content')

    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-2.jpg',
        'subtitle' => 'Get in',
        'title' => 'Touch',
        'currentPage' => 'Member',
    ])
    <div id="content" class="">
        <div class="container ">

            <!-- Phần thông tin tài khoản -->

            <div class="container-fluid w-100">
                <div class="row mb-4">
                    <!-- Side Menu -->
                    <div class=" profile col-lg-3  side-menu p-3 bg-dark text-light">
                        <div class="d-flex align-items-center mb-4">
                            <div class="profile-circle bg-secondary text-white">
                                <!-- Profile Icon Placeholder -->
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-white hover-text" href="#" onclick="showSection('reservationSection')">Đặt chỗ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white hover-text" href="#" onclick="showSection('accountDetailsSection')">Chi tiết tài khoản</a>
                            </li>
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: transparent; border: none;" class="nav-link  text-white hover-text">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
        

                    <!-- Main Content -->
                    <div class="col-lg-9 col-md-8 p-4">
                        <div id="reservationSection" class="content-section">
                            <h3>Đặt chỗ sắp tới</h3>
                            <!-- Reservation Details -->
                            @foreach ($bookingData as $reservation)
                            <div class="reservation-card mb-3 p-3 bg-dark text-light rounded">
                                <h5>Mã đặt bàn: {{$reservation->id}} - {{ $reservation->user_name }}</h5>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="text-white"><i class="bi bi-person"></i>Số người: {{ $reservation->guest_count }} người</p>
                                        <p class="text-white"><i class="bi bi-calendar-date"></i> Ngày:{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                            | {{ $reservation->reservation_time }}</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-white"><i class="bi bi-telephone"></i> Số điện thoại:{{ $reservation->user_phone }}</p>
                                        <p class="text-white"><i class="bi bi-cash"></i>Cọc: {{ number_format($reservation->deposit_amount ?? 0, 0, ',', '.') }} VNĐ</p>
                                    </div>
                                    @if($reservation->status=='Refund')
                                    <div class="col-4">
                                        <p class="text-white"><i style="color:#3ca4ff" class="bi bi-cash"></i>Hoàn tiền: {{ number_format($reservation->refund->refund_amount ?? 0, 0, ',', '.') }} VNĐ</p>
                                        <p class="text-white"><i class="bi bi-stickies"></i>Lý do hủy:{{ $reservation->refund->reason ?? '' }}</p>
                                    </div>
                                    @endif
                                </div>
                                @php
                                    $statusClasses = [
                                        'Confirmed' => 'status-confirmed',
                                        'Pending' => 'status-pending',
                                        'Cancelled' => 'status-cancelled',
                                        'Refund' => 'status-refund',
                                        'Completed' => 'status-completed'
                                    ];

                                    $statusLabels = [
                                        'Confirmed' => 'Đã xác nhận',
                                        'Pending' => 'Chờ xử lý',
                                        'Cancelled' => 'Đã hủy',
                                        'Refund' => 'Đang hoàn tiền',
                                        'Completed' => 'Đã hoàn thành'
                                    ];
                                @endphp
                                <strong class=" text-right {{ $statusClasses[$reservation->status] ?? 'status-pending' }}">
                                    {{ $statusLabels[$reservation->status] ?? 'Chờ xử lý' }}
                                </strong>
                            
        
                                <div class=" mt-3">
                                    @if ($reservation->status == 'Pending'||$reservation->status=='Confirmed')
                                            @if($reservation->deposit_amount > 0) 
                                                <button class="text-danger cancel-btn-new"
                                                data-toggle="modal" data-target="#cancelModal"
                                                style="background: transparent; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#cancelModal" data-reservation-id="{{ $reservation->id }}"
                                                data-deposit-amount="{{ $reservation->deposit_amount }}"
                                                data-reservation-time="{{ $reservation->reservation_time }}"
                                                data-reservation-date="{{ \Carbon\Carbon::parse($reservation->reservation_date)->toIso8601String() }}">
                                                Hủy
                                                </button>
                                                @else
                                                    <button style="background: transparent; border: none;" class="text-danger cancel-btn-new deleteButton" id="deleteButton" data-id ="{{$reservation->id}}">Hủy</button>
                                             @endif
                                                
                                            
                                        @elseif($reservation->status =="Completed")
                                             @if (isset($reservation->feedback->content))
                                                 <p class="text-success">Đánh giá của bạn: {{ $reservation->feedback->content }}</p>
                                                
                                             {{-- <button style="background: transparent; border: none;" class="text-warning cancel-btn-new deleteButton" id="deleteButton" data-id ="{{$reservation->id}}">Chỉnh sửa</button>  --}}
                                             @else
                                             <button style="background: transparent; border: none;" class="text-success  fw-bold" onclick="toggleReviewInput({{ $reservation->id }})">Đánh giá</button>
                                            
                                             @endif
                                            
                                    @endif
                                         
                                      
                                </div>
        
                                <!-- Review Input -->
                                <div id="review-input-{{ $reservation->id }}" class="mt-2" style="display: none;">
                                    <textarea id="review-text-{{ $reservation->id }}" class="form-control" placeholder="Nhập đánh giá của bạn..." rows="3"></textarea>
                                    <button class=" btn-primary btn-sm mt-2" onclick="submitReview({{ $reservation->id }})">Gửi đánh giá</button>
                                </div>
                                     <!-- Khu vực hiển thị đánh giá -->
                                   
                            </div>
                            @endforeach
        
                            <div class="justify-content-center mt-3">
                                {{ $bookingData->links('pagination::client-paginate') }}
                            </div>
                        </div>
    
                        
                                    {{-- <div class="actions">
                                        @if ($reservation->status != 'Cancelled')
                                            @if($reservation->deposit_amount > 0) 
                                                <button class="text-danger cancel-btn-new"
                                                data-toggle="modal" data-target="#cancelModal"
                                                style="background: transparent; border: none;" data-bs-toggle="modal"
                                                data-bs-target="#cancelModal" data-reservation-id="{{ $reservation->id }}"
                                                data-deposit-amount="{{ $reservation->deposit_amount }}"
                                                data-reservation-time="{{ $reservation->reservation_time }}"
                                                data-reservation-date="{{ \Carbon\Carbon::parse($reservation->reservation_date)->toIso8601String() }}">
                                                Hủy
                                                </button>
                                                 
                                                @else
                                                    @if ($reservation->status == 'Cancelled')
                                                        <strong>
                                                            Đã hủy
                                                        </strong>
                                                    
                                                    @else
                                                    <button style="background: transparent; border: none;" class="text-danger cancel-btn-new" id="deleteButton" data-id ="{{$reservation->id}}">Hủy</button>
                                                     @endif
                                                
                                            @endif
                                        @endif
                                    </div>
                                    <!-- Nút đánh giá -->
                                    <div class="actions">
                                    @if ($reservation->status !== 'Cancelled')
                                        <button class="text-success review-btn"
                                            style="background: transparent; border: none;"
                                            onclick="toggleReviewInput({{ $reservation->id }}, {{ $reservation->customer_id }})">
                                            Đánh giá
                                        </button>
                                    @endif
                                    </div>
                                        <!-- Khu vực nhập đánh giá -->
                                        <div id="review-input-{{ $reservation->id }}" class="review-input mt-2" style="display: none;">
                                        <textarea id="review-text-{{ $reservation->id }}" class="form-control" placeholder="Nhập đánh giá của bạn..." rows="3"></textarea>
                                        <button class="btn-primary mt-2" onclick="submitReview({{ $reservation->id }}, {{ $reservation->customer_id }})">Gửi đánh giá</button>
                                        </div>

                        
                                        <!-- Khu vực hiển thị đánh giá -->
                                        <div id="review-container-{{ $reservation->id }}" class="mt-2">
                                        @if ($reservation->review)
                                        <p class="text-success">Đánh giá của bạn: {{ $reservation->review }}</p>
                                        @endif
                                        </div>
                                    </div>
                        
                                </div> --}}
                            {{-- @endforeach --}}
                        
                        

                           
                            <div id="accountDetailsSection" class="content-section" style="display:none;">
                                <h3>Thông tin cá nhân</h3>
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
                                    <button onclick="saveChanges()" style="display:none;" id="saveButton"
                                        class="btn-line">Lưu thay đổi</button>
                                    <button onclick="toggleEdit()" id="editButton" class="btn-line">Chỉnh sửa thông
                                        tin</button>
                                </form>
        </div>
                        </div>

                        <!-- Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel">Xác nhận hủy đặt chỗ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-info">
                                            <strong>Chính sách hủy bàn:</strong>
                                            <ul>
                                                {{-- <li>Hủy trước giờ nhận bàn 1 giờ: hoàn 100% tiền cọc.</li> --}}
                                                <li> Hủy trong 1 tiếng trước giờ nhận bàn: hoàn 50% tiền cọc.</li>
                                                <li>Khách hàng không yêu cầu hủy hoặc không đến: không được hoàn cọc.</li>
                                            </ul>
                                        </div>
                                        <form action="{{ route('refunds.cancel') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="reservation_id" name="reservation_id">
                                            <p id="refundAmountDisplay" style="color: #ff0000;"></p>
                                            <input type="hidden" id="refund_amount" name="refund_amount">
                                            <!-- Tài khoản và thông tin liên hệ -->
                                            <div class="form-group">
                                                <label for="account_name" class="form-label">Tên tài khoản</label>
                                                <input type="text"
                                                    class="form-control @error('account_name') is-invalid @enderror"
                                                    id="account_name" name="account_name" required>
                                                @error('account_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="account_number" class="form-label">Số tài khoản</label>
                                                <input type="number"
                                                    class="form-control @error('account_number') is-invalid @enderror"
                                                    id="account_number" name="account_number" required>
                                                @error('account_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Chọn ngân hàng -->
                                            <div class="form-group">
                                                <label for="bankSelect">Chọn Ngân hàng:</label>
                                                <select id="bankSelect" name="bankSelect" class="form-control">
                                                    <option value="">Chọn ngân hàng</option>
                                                    @foreach ($bankList as $bank)
                                                        <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" id="bankSelectError" style="display: none;">
                                                    Vui lòng chọn ngân hàng.</div>
                                            </div>

                                            <!-- Thông tin liên hệ khác -->
                                            <div class="form-group">
                                                <label for="user_phone" class="form-label">Số điện thoại</label>
                                                <input type="text"
                                                    class="form-control @error('user_phone') is-invalid @enderror"
                                                    id="user_phone" name="user_phone" required>
                                                @error('user_phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Lý do hủy -->
                                            <div class="form-group">
                                                <label for="reason" class="form-label">Lý do hoàn tiền</label>
                                                <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason"></textarea>
                                                @error('reason')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Nút Xác Nhận Hủy -->
                                            <br>
                                            <div class="form-group text-end">
                                                <button type="submit" class="btn-danger">Xác Nhận Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        
                    </div>

                    {{-- <div id="paymentSection" class="content-section" style="display:none;">
                        <h3>Phương thức thanh toán</h3>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    // Xử lý khi nhấn vào nút "Hủy"
 

    // Khởi tạo Select2 cho danh mục
    $('#bankSelect').select2({
        placeholder: "Chọn ngân hàng",
        allowClear: true
    });
}); --}}


    </script>


    <script>
        function calculateRefund(depositAmount, reservationDateStr, reservationTimeStr) {
            const currentTime = new Date();
            const vietnamTime = new Date(currentTime.toLocaleString("en-US", {
                timeZone: "Asia/Ho_Chi_Minh"
            }));

            const reservationDate = new Date(reservationDateStr);
            const reservationTime = reservationTimeStr.split(":");
            reservationDate.setHours(reservationTime[0], reservationTime[1], 0, 0);


            if (isNaN(reservationDate)) {
                console.log("Lỗi: Thời gian đặt chỗ không hợp lệ.");
                return 0;
            }


            const diffMs = reservationDate - vietnamTime;
            const diffHours = diffMs / (1000 * 60 * 60);

            let refundAmount = 0;

            if (diffHours >= 1) {
                refundAmount = depositAmount; // Hoàn 100% nếu hủy trước 1 giờ
            } else if (diffHours >= -1) {
                refundAmount = depositAmount * 0.5; // Hoàn 50% nếu hủy trong vòng 1 giờ sau giờ ăn
            } else {
                refundAmount = 0; // Không hoàn tiền nếu hủy quá 1 giờ sau giờ ăn
            }

            return refundAmount;

        }

        $(document).ready(function() {
    $('.deleteButton').click(function() {
        var id = this.getAttribute('data-id'); // Lấy ID từ thuộc tính 'data-id'

        Swal.fire({
            icon: "question",
            title: "Xác nhận hủy",
            text: "Bạn có chắc chắn muốn hủy đặt bàn không?",
            showCancelButton: true,
            confirmButtonText: "Xác nhận",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                // Gọi AJAX hoặc thực hiện hành động xóa
                $.ajax({
                    url: '{{ route('client.cancel.reservationpopup') }}',
                    type: 'POST',
                    data: {
                        id: id, 
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: response.icon,
                            title: response.title,
                            text: response.message
                        }).then(() => {
                            if (response.success) {
                                location.reload(); // Tải lại trang
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: "Có lỗi xảy ra!"
                        });
                    }
                });
            } else {
                // Người dùng hủy bỏ hành động
                Swal.fire({
                    icon: "info",
                    title: "Thông báo",
                    text: "Hành động đã bị hủy."
                });
            }
        });
    });
});

        // modal hủy
        function openCancelModal(reservationId, depositAmount, reservationDateStr, reservationTimeStr) {
            const refundAmount = calculateRefund(depositAmount, reservationDateStr, reservationTimeStr);

            document.getElementById('reservation_id').value = reservationId;
            document.getElementById('refund_amount').value = refundAmount;

            document.getElementById('refundAmountDisplay').innerText =
                `Số tiền hoàn lại: ${refundAmount.toLocaleString()} VNĐ`;
        }

        document.querySelectorAll('.cancel-btn-new').forEach(button => {
            button.addEventListener('click', function() {
                const reservationId = this.getAttribute('data-reservation-id');
                const depositAmount = parseFloat(this.getAttribute('data-deposit-amount'));
                const reservationTime = this.getAttribute('data-reservation-time');
                const reservationDate = this.getAttribute('data-reservation-date');

                // console.log("Reservation ID:", reservationId);
                // console.log("Deposit Amount:", depositAmount);
                // console.log("Reservation Time:", reservationTime);
                // console.log("Reservation Date:", reservationDate);

                openCancelModal(reservationId, depositAmount, reservationDate, reservationTime);
            });
        });
    </script>
@endsection
