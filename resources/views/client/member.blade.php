@extends('client.layouts.master')
@section('title', 'Member')

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
                    <div class="col-md-3 side-menu p-3" style="background-color: #2b2b2b; color: #d3d3d3;"> <!-- Màu nền tối và chữ xám nhạt -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="profile-circle" style="background-color: #8c6c3d; color: white;"> <!-- Màu nâu nhạt -->
                                {{-- {{ strtoupper(substr($memberData['name'], 0, 1)) }} --}}
                            </div>
                            <div class="ms-3">
                                {{-- <h5 class="text-danger" style="color: #f5cc00;">Hi, {{ $memberData['name'] }}</h5> <!-- Màu vàng nổi bật -->
                                <p class="text-muted" style="color: #b5b5b5;">{{ $memberData['location'] }}</p> <!-- Xám nhạt -->
                                <p class="text-muted" style="color: #b5b5b5;">Thành viên từ {{ $memberData['member_since'] }}</p> <!-- Xám nhạt --> --}}
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" onclick="showSection('reservationSection')" style="color: #f5cc00;">Đặt chỗ</a> <!-- Màu vàng -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" onclick="showSection('accountDetailsSection')" style="color: #f5cc00;">Chi tiết tài khoản</a> <!-- Màu vàng -->
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link text-light" href="#" onclick="showSection('paymentSection')" style="color: #f5cc00;">Phương thức thanh toán</a> <!-- Màu vàng -->
                            </li> --}}
                        </ul>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-9 p-4">
                        <div id="reservationSection" class="content-section">
                            <h3>Đặt chỗ sắp tới</h3>
                            <!-- Reservation Details -->
                            @foreach ($bookingData as $reservation)
                                <div class="reservation-card mb-3" style="background-color: #2b2b2b; border-radius: 5px; color: #d3d3d3;">
                                    <div>
                                        <h3 style="color:white">Họ tên: {{ $reservation->user_name }} - {{ $reservation->user_phone }}</h3>
                                        <div class="d-flex">
                                            <div>
                                                <p style="color:white;">Ngày: {{ $reservation->reservation_date }}</p>
                                                <p style="display: inline; color:white;">Giờ: {{ $reservation->reservation_time }}</p>
                                            </div>
                                            <div>
                                                <p style="color:white; margin-left: 10px;"><i class="bi bi-people"></i> {{ $reservation->guest_count }} người</p>
                                                <p style="color:white; margin-right: 10px;">
                                                    Cọc: {{ number_format($reservation->deposit_amount ?? 0, 0, ',', '.') . ' VNĐ' }}
                                                </p>
                                            </div>
                                        </div>
                                        <strong class="{{ $reservation->status === 'Confirmed' ? 'status-confirmed' : ($reservation->status === 'Checked-in' ? 'status-checked-in' : ($reservation->status === 'Cancelled' ? 'status-cancelled' : 'status-pending')) }}">
                                            {{ $reservation->status === 'Confirmed' ? 'Đã xác nhận' : ($reservation->status === 'Checked-in' ? 'Đã nhận bàn' : ($reservation->status === 'Cancelled' ? 'Đã hủy' : 'Chờ xử lý')) }}
                                        </strong>
                                    </div>
                                    <div class="actions">
                                        <button class="text-danger cancel-btn" style="background: transparent; border: none;" data-reservation-id="{{ $reservation->id }}">Hủy</button>
                                    </div>
                                </div>
                            @endforeach

                                <div class="justify-content-center mt-3">
                                    {{ $bookingData->links() }}
                                </div>
                        </div>

                        <!-- Modal -->
                        <div id="cancelModal" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xác Nhận Hủy Đơn</h5>
                                        <button type="button" class="closeCancalledModal" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span> 
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-info">
                                            <strong>Chính sách hủy bàn:</strong>
                                            <ul>
                                                <li>Hủy trước 24 giờ: hoàn 100% số tiền cọc.</li>
                                                <li>Hủy trước 12 giờ: hoàn 50% số tiền cọc.</li>
                                                <li>Hủy sát giờ nhận bàn: không được hoàn cọc.</li>
                                            </ul>
                                        </div>
                                        <form id="cancelForm">
                                            <div class="form-group">
                                                <label for="fullName">Họ Và Tên:</label>
                                                <input type="text" id="fullName" name="fullName" class="form-control">
                                                <div class="invalid-feedback" id="fullNameError" style="display: none;">Vui lòng nhập họ và tên.</div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="bankSelect">Chọn Ngân hàng:</label>
                                                <select id="bankSelect" name="bankSelect" class="form-control">
                                                    <option value="">Chọn ngân hàng</option>
                                                    @foreach ($bankList as $bank)
                                                        <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" id="bankSelectError" style="display: none;">Vui lòng chọn ngân hàng.</div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="accountNumber">Số tài khoản:</label>
                                                <input type="text" id="accountNumber" name="accountNumber" class="form-control">
                                                <div class="invalid-feedback" id="accountNumberError" style="display: none;">Vui lòng nhập số tài khoản.</div>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" id="email" name="email" class="form-control">
                                                <div class="invalid-feedback" id="emailError" style="display: none;">Vui lòng nhập email hợp lệ.</div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="reason">Lí do hủy:</label>
                                                <textarea id="reason" name="reason" class="form-control"></textarea>
                                                <div class="invalid-feedback" id="reasonError" style="display: none;">Vui lòng nhập lý do hủy.</div>
                                            </div>
                                            <br>

                                            <div class="form-group text-end">
                                                <button type="submit" class="btn-danger">Xác Nhận Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


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
                                    <button onclick="saveChanges()" style="display:none;" id="saveButton" class="btn-line">Lưu thay đổi</button>
                                    <button onclick="toggleEdit()" id="editButton" class="btn-line">Chỉnh sửa thông tin</button>
                                </div>
                            </form>
                        </div>

                    {{-- <div id="paymentSection" class="content-section" style="display:none;">
                        <h3>Phương thức thanh toán</h3>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
   



