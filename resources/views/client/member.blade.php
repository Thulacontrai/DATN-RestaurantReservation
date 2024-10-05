
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
<div class="container " >

    <!-- Phần thông tin tài khoản -->
    <div class="text-center my-4">
        <img src="{{ $memberData['avatar'] }}" alt="Avatar" class="avatar mb-3">
        <h5>{{ $memberData['name'] }}</h5>
    </div>

    <!-- Mã vạch -->

    <!-- Thông tin thành viên -->
    <div class="row text-center mb-3">
        <div class="col-6">
            <h5 class="">{{ $memberData['total_spend'] }}</h5>
            <p>Tổng chi tiêu</p>
        </div>
        <div class="col-6">
            <h5 class="">{{ $memberData['reward_points'] }}</h5>
            <p>Điểm thưởng</p>
        </div>
    </div>


   


    <!-- Danh sách tùy chọn -->
    <ul class="list-group mb-4">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Điểm 
            <span><i class="bi bi-chevron-right"></i></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#bookingModal">
            Đơn đặt bàn
            <span><i class="bi bi-chevron-right" ></i></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#accountInfoModal">
            Thông tin tài khoản
            <span ><i class="bi bi-chevron-right" ></i></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Lịch sử giao dịch
            <span ><i class="bi bi-chevron-right"></i></span>
        </li>
       
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Xóa tài khoản
            <span><i class="bi bi-chevron-right"></i></span>
        </li>
    </ul>

    

    <!-- Nút Đăng xuất -->
    <div class="text-center">
        <a href="#" class="text-white">Đăng xuất</a>
    </div>

    <!-- Modal Thông tin tài khoản -->
    <div class="modal fade" id="accountInfoModal" tabindex="-1" aria-labelledby="accountInfoModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" id="name" name="name" value="{{ $memberData['name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $memberData['phone'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $memberData['email'] }}">
                        </div>
                        
                        <label class="text-center" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <a href="#" class="text-black">Đổi mật khẩu</a>
                        </label>
                        
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
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
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
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
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

    <!-- Modal Đơn đặt bàn -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Thông tin Đơn đặt bàn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('member.updateBooking') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Khách hàng</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $bookingData['customer_name'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $bookingData['phone'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="people" class="form-label">Số người</label>
                            <input type="number" class="form-control" id="people" name="people" value="{{ $bookingData['people'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="table_number" class="form-label">Số bàn</label>
                            <input type="number" class="form-control" id="table_number" name="table_number" value="{{ $bookingData['table_number'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Ngày đặt</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" value="{{ $bookingData['booking_date'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="booking_time" class="form-label">Giờ</label>
                            <input type="time" class="form-control" id="booking_time" name="booking_time" value="{{ $bookingData['booking_time'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="amount_paid" class="form-label">Số tiền đã thanh toán</label>
                            <input type="number" class="form-control" id="amount_paid" name="amount_paid" value="{{ $bookingData['amount_paid'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="note" name="note">{{ $bookingData['note'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Hủy đơn đặt bàn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</div>

@endsection

