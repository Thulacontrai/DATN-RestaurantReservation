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
                                <a class="nav-link text-white hover-text" href="#"
                                    onclick="showSection('reservationSection')">Đặt chỗ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white hover-text" href="#"
                                    onclick="showSection('accountDetailsSection')">Chi tiết tài khoản</a>
                            </li>
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: transparent; border: none;"
                                        class="nav-link  text-white hover-text">Đăng xuất</button>
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
                                    <h5>Mã đặt bàn: {{ $reservation->id }} - {{ $reservation->user_name }}</h5>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="text-white"><i class="bi bi-person"></i>Số người:
                                                {{ $reservation->guest_count }} người</p>
                                            <p class="text-white"><i class="bi bi-calendar-date"></i>
                                                Ngày:{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                                | {{ $reservation->reservation_time }}</p>
                                        </div>
                                        <div class="col-4">
                                            <p class="text-white"><i class="bi bi-telephone"></i> Số điện
                                                thoại:{{ $reservation->user_phone }}</p>
                                            <p class="text-white"><i class="bi bi-cash"></i>Cọc:
                                                {{ number_format($reservation->deposit_amount ?? 0, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                        @if ($reservation->status == 'Refund')
                                            <div class="col-4">
                                                <p class="text-white"><i style="color:#3ca4ff" class="bi bi-cash"></i>Hoàn
                                                    tiền:
                                                    {{ number_format($reservation->refund->refund_amount ?? 0, 0, ',', '.') }}
                                                    VNĐ</p>
                                                <p class="text-white"><i class="bi bi-stickies"></i>Lý do
                                                    hủy:{{ $reservation->refund->reason ?? '' }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    @php
                                        $statusClasses = [
                                            'Confirmed' => 'status-confirmed',
                                            'Pending' => 'status-pending',
                                            'Cancelled' => 'status-cancelled',
                                            'Refund' => 'status-refund',
                                            'Completed' => 'status-completed',
                                        ];

                                        $statusLabels = [
                                            'Confirmed' => 'Đã xác nhận',
                                            'Pending' => 'Chờ xử lý',
                                            'Cancelled' => 'Đã hủy',
                                            'Refund' => 'Đang hoàn tiền',
                                            'Completed' => 'Đã hoàn thành',
                                        ];
                                    @endphp
                                    <strong
                                        class=" text-right {{ $statusClasses[$reservation->status] ?? 'status-pending' }}">
                                        {{ $statusLabels[$reservation->status] ?? 'Chờ xử lý' }}
                                    </strong>


                                    <div class=" mt-3">

                                        @if ($reservation->status == 'Pending' || $reservation->status == 'Confirmed')
                                            <button class="btn-warning edit-reservation-btn"
                                                data-id="{{ $reservation->id }}">Chỉnh sửa</button>
                                            @if ($reservation->deposit_amount > 0)
                                                <button class="text-danger cancel-btn-new" data-toggle="modal"
                                                    data-target="#cancelModal"
                                                    style="background: transparent; border: none;" data-bs-toggle="modal"
                                                    data-bs-target="#cancelModal"
                                                    data-reservation-id="{{ $reservation->id }}"
                                                    data-deposit-amount="{{ $reservation->deposit_amount }}"
                                                    data-reservation-time="{{ $reservation->reservation_time }}"
                                                    data-reservation-date="{{ \Carbon\Carbon::parse($reservation->reservation_date)->toIso8601String() }}">
                                                    Hủy
                                                </button>
                                            @else
                                                <button style="background: transparent; border: none;"
                                                    class="text-danger cancel-btn-new deleteButton" id="deleteButton"
                                                    data-id ="{{ $reservation->id }}">Hủy</button>
                                            @endif
                                        @elseif($reservation->status == 'Completed')
                                            @if (isset($reservation->feedback->content))
                                                <p class="text-success">Đánh giá của bạn:
                                                    {{ $reservation->feedback->content }}</p>

                                                {{-- <button style="background: transparent; border: none;" class="text-warning cancel-btn-new deleteButton" id="deleteButton" data-id ="{{$reservation->id}}">Chỉnh sửa</button>  --}}
                                            @else
                                                <button button class="rate-reservation-btn  btn-primary"
                                                data-id ="{{ $reservation->id }}">Đánh
                                                    giá</button>
                                            @endif
                                        @endif


                                    </div>



                                    <!-- Review Input -->
                                    <div class="reservation-rating-form reservation-rating-form-{{ $reservation->id }}" style="display: none;">
                                        <form class="rating-form" data-id="{{ $reservation->id }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Đánh giá sao</label>
                                                <div class="rating-stars d-flex" >
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star star-rating"
                                                            data-value="{{ $i }}"></i>
                                                    @endfor
                                                </div>
                                                <input type="hidden" class="rating-value" name="rating" value="0">
                                                <input type="hidden" class="customer_id" name="customer_id"
                                                    value="{{ $member->id }}">
                                                <span id="error-rating" class="text-danger"></span>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="review">Đánh giá</label>
                                                <textarea  name="review" class="review form-control" rows="3" placeholder="Nhập nội dung đánh giá..."></textarea>
                                                <span id="error-review" class="text-danger"></span>
                                            </div>
                                            <button type="submit" class=" btn-success mt-3">Gửi đánh giá</button>
                                            <button type="button" class="rating-cancel btn-secondary"  data-id="{{ $reservation->id }}">Hủy</button>

                                        </form>

                                        
                                    </div>


                                    <!-- Form chỉnh sửa thông tin đặt bàn -->
                                    <div class=" reservation-edit-form reservation-edit-form-{{ $reservation->id }}" style="display: none;">
                                        <form data-id="{{ $reservation->id }}" 
                                            class="edit-reservation" >
                                            @csrf
                                            <div class="form-group">
                                                <label for="customer_name">Tên khách hàng</label>
                                                <input type="text" class=" form-control user_name" name="user_name"
                                                     value="{{ $reservation->user_name }}" required>
                                                <span id="error-customer_name" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="user_phone">Số điện thoại</label>
                                                <input type="text" class=" form-control user_phone" name="user_phone"
                                                     value="{{ $reservation->user_phone }}" required>
                                                <span id="error-user_phone" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="guest_count">Số lượng khách</label>
                                                <input type="number" class=" form-control guest_count" name="guest_count"
                                                     value="{{ $reservation->guest_count }}"
                                                    min="1" max="50" required>
                                                <span id="error-guest_count" class="text-danger"></span>
                                            </div>

                                            <div class="deposit-section" style="display: none;">
                                                <div class="form-group">
                                                    <label for="deposit_amount">Tiền cọc</label>
                                                    <input type="number" class=" form-control deposit_amount" name="deposit_amount"
                                                         readonly>
                                                </div>
                                                <p class="text-warning" class="deposit-warning">
                                                    @if ($reservation->guest_count >= 6)
                                                        Số lượng khách của bạn cần đặt cọc
                                                        {{-- {{ number_format($reservation->guest_count * 100000, 0, ',', '.') }}
                                                        VNĐ. --}}
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="form-group">
                                                <label for="reservation_time">Ngày và giờ đặt</label>
                                                <input type="time" class=" form-control reservation_time" name="reservation_time"
                                                    
                                                    value="{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('TH:i') }}"
                                                    required>
                                                <span id="error-reservation_time" class="text-danger"></span>
                                            </div>

                                            <button type="submit" class="edit-form" class=" btn-primary">Lưu thay
                                                đổi</button>
                                            <button type="button" class="cancel-edit btn-secondary"  data-id="{{ $reservation->id }}">Hủy</button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach

                            <div class="justify-content-center mt-3">
                                {{ $bookingData->links('pagination::client-paginate') }}
                            </div>
                        </div>

                        {{-- Edit thông tin đặt bàn --}}


                        {{-- <div class="actions">
                                        @if ($reservation->status != 'Cancelled')
                                            @if ($reservation->deposit_amount > 0) 
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




                        <div id="accountDetailsSection" class="content-section">
                            <h3>Thông tin cá nhân</h3>
                            <form action="{{ route('member.update') }}" method="POST"
                                onsubmit="return handleFormSubmit(event)">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $member->name }}" oninput="showSaveButton()">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $member->phone }}" oninput="showSaveButton()">
                                    </div>
                                </div>
                                <button type="submit" style="display:none;" id="saveButton" class="btn-line">Lưu thay
                                    đổi</button>
                                <button type="button" onclick="toggleEdit()" id="editButton" class="btn-line">Chỉnh sửa
                                    thông tin</button>
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
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" required>
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
    {{-- edit tài khoản  --}}
    <script>
        function toggleEdit() {
            // Cho phép người dùng chỉnh sửa thông tin
            document.getElementById('name').disabled = false;
            document.getElementById('phone').disabled = false;
        }

        function showSaveButton() {
            // Hiển thị nút "Lưu thay đổi" khi người dùng chỉnh sửa
            document.getElementById('saveButton').style.display = 'inline-block';
        }

        async function handleFormSubmit(event) {
            event.preventDefault(); // Ngăn form reload trang

            // Thu thập dữ liệu từ form
            const form = event.target;
            const formData = new FormData(form);

            try {
                // Gửi dữ liệu qua POST
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                });

                // Kiểm tra phản hồi
                if (response.ok) {
                    const result = await response.json();

                    // Cập nhật giao diện với dữ liệu mới
                    document.getElementById('name').value = result.name;
                    document.getElementById('phone').value = result.phone;


                    document.getElementById('saveButton').style.display = 'none';

                    alert('Cập nhật thành công!');
                } else {
                    alert('Cập nhật thất bại, vui lòng thử lại!');
                }
            } catch (error) {
                console.error('Lỗi:', error);
                alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
            }
        }
    </script>
    {{-- edit thông tin đặt chỗ  --}}
    <script>
        $(document).ready(function() {
            // Khi người dùng thay đổi số lượng khách
            $(".guest_count").on("input", function() {
                let guestCount = $(this).val();
                let depositAmount = 0;
                let depositSection = $(".deposit-section");
                let depositMessage = $(".deposit-warning");
                let depositInput = $(".deposit_amount");

                // Nếu số lượng khách >= 6, hiển thị tiền cọc và thông báo
                if (guestCount >= 6) {
                    depositAmount = guestCount * 100000;
                    depositMessage.text(
                        `Số lượng khách của bạn cần đặt cọc ${depositAmount.toLocaleString('vi-VN')} VNĐ.`
                    );
                    depositSection.show(); // Hiển thị ô tiền cọc
                    depositInput.val(depositAmount);
                } else {
                    depositSection.hide(); // Ẩn ô tiền cọc
                    depositMessage.text(''); // Xóa thông báo
                    depositInput.val('');
                }
            });

            // Hiển thị form chỉnh sửa
            $(".edit-reservation-btn").on("click", function() {
                const reservationId = $(this).data('id');
                $(".reservation-edit-form").hide();

                $(".reservation-edit-form-" + reservationId).show();
            });

            // Gửi form chỉnh sửa qua AJAX
            $(".edit-reservation").on("submit", function(e) {
                e.preventDefault(); // Ngăn refresh trang

                // Lấy dữ liệu từ form
                const form = $(this);
                const reservationId = form.data('id');
                const formData = form.serialize();
                // Gửi thêm reservationId vào dữ liệu
                const fullData = formData + `&reservationId=${reservationId}`;


                $.ajax({
                    url: `/member/reservation/update`, // Đường dẫn cập nhật
                    type: "POST",
                    data: fullData,
                    success: function(response) {
                        console.log(response.message)
                        // Kiểm tra nếu response trả về thông tin đã được cập nhật
                        // if (response.success) {
                        //     // Cập nhật thông tin hiển thị với dữ liệu mới


                        //     // Ẩn form chỉnh sửa và hiển thị lại thông tin
                        //     $("#reservation-info").show();
                        //     $("#reservation-edit-form").hide();

                        //     //         // Thông báo thành công
                        //     alert("Cập nhật thông tin thành công!");
                        // } else {
                        //     // Hiển thị lỗi nếu có
                        //     alert("Có lỗi xảy ra trong quá trình cập nhật.");
                        // }
                    },
                    // error: function(xhr) {
                    //     // Hiển thị lỗi dưới các trường input
                    //     let errors = xhr.responseJSON.errors;
                    //     $(".text-danger").text("");
                    //     for (let key in errors) {
                    //         $(`#error-${key}`).text(errors[key][0]);
                    //     }
                    // },
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const guestCountInput = document.getElementById('guest_count');
                const depositSection = document.getElementById('deposit-section');
                const depositAmountInput = document.getElementById('deposit_amount');
                const depositWarning = document.getElementById('deposit-warning');

                guestCountInput.addEventListener('input', function() {
                    const guestCount = parseInt(guestCountInput.value, 10);

                    if (guestCount >= 6) {
                        const depositAmount = guestCount * 100000;
                        depositAmountInput.value = depositAmount.toLocaleString('vi-VN') + ' VNĐ';
                        depositWarning.textContent =
                            `Số lượng khách của bạn cần đặt cọc ${depositAmount.toLocaleString('vi-VN')} VNĐ.`;
                        depositSection.style.display = 'block';
                    } else {
                        depositAmountInput.value = '';
                        depositWarning.textContent = '';
                        depositSection.style.display = 'none';
                    }
                });
            });


            // Nút "Hủy" để thoát chỉnh sửa
            $(".cancel-edit").on("click", function() {
                const reservationId = $(this).data('id');
                $(".reservation-edit-form-" +reservationId).hide();
                // $("#reservation-info-" + reservationId).show();
            });
        });
    </script>
    {{-- rating --}}
    <script>
       $(document).ready(function() {
    // Hiển thị form đánh giá khi nhấn nút "Đánh giá"
    $(".rate-reservation-btn").on("click", function() {
        const reservationId = $(this).data("id");

        // Đóng tất cả các form đang mở
        $(".reservation-rating-form").hide();

        // Hiển thị form tương ứng với reservationId
        $(".reservation-rating-form-" + reservationId).show();
    });

    // Xử lý đánh giá sao
    $(".star-rating")
        .on("mouseover", function() {
            let ratingValue = $(this).data("value");
            $(".star-rating").each(function() {
                if ($(this).data("value") <= ratingValue) {
                    $(this).removeClass("bi-star").addClass("bi-star-fill text-warning");
                } else {
                    $(this).removeClass("bi-star-fill text-warning").addClass("bi-star");
                }
            });
        })
        .on("click", function() {
            let ratingValue = $(this).data("value");
            $(".rating-value").val(ratingValue); // Gán giá trị rating
        });

    // Gửi đánh giá qua AJAX
    $(".rating-form").on("submit", function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let reservationId = $(this).data("id");

        $.ajax({
            url: `/member/reservation/${reservationId}/rate`,
            type: "POST",
            data: formData,
            success: function(response) {
                alert("Đánh giá thành công!");
                location.reload();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                $(".text-danger").text("");
                for (let key in errors) {
                    $(`#error-${key}`).text(errors[key][0]);
                }
            },
        });
    });

    // Đóng form khi nhấn nút hủy
    $(".rating-cancel").on("click", function() {
        const reservationId = $(this).data("id");
        $(".reservation-rating-form-" + reservationId).hide();
    });
});

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
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Hủy bàn thành công!"
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
