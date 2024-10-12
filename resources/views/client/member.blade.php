@extends('client.layouts.master')
@section('title', 'Member')

@section('content')

    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-.jpg',
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
                                {{ strtoupper(substr($memberData['name'], 0, 1)) }}
                            </div>
                            <div class="ms-3">
                                <h5 class="text-danger" style="color: #f5cc00;">Hi, {{ $memberData['name'] }}</h5> <!-- Màu vàng nổi bật -->
                                <p class="text-muted" style="color: #b5b5b5;">{{ $memberData['location'] }}</p> <!-- Xám nhạt -->
                                <p class="text-muted" style="color: #b5b5b5;">Thành viên từ {{ $memberData['member_since'] }}</p> <!-- Xám nhạt -->
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" onclick="showSection('reservationSection')" style="color: #f5cc00;">Đặt chỗ</a> <!-- Màu vàng -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" onclick="showSection('accountDetailsSection')" style="color: #f5cc00;">Chi tiết tài khoản</a> <!-- Màu vàng -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" onclick="showSection('paymentSection')" style="color: #f5cc00;">Phương thức thanh toán</a> <!-- Màu vàng -->
                            </li>
                        </ul>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-9 p-4">
                        <div id="reservationSection" class="content-section">
                            <h3>Đặt chỗ sắp tới</h3>
                            <!-- Reservation Details -->
                            @if (count($memberData['reservations']) > 0)
                                @php
                                    $reservationsPerPage = 3; // Số lượng đơn đặt chỗ trên mỗi trang
                                    $totalReservations = count($memberData['reservations']);
                                    $totalPages = ceil($totalReservations / $reservationsPerPage);
                                    $currentPage = request('page', 1); // Lấy trang hiện tại từ query string
                                    $offset = ($currentPage - 1) * $reservationsPerPage; // Tính chỉ số bắt đầu
                                    $reservationsToShow = array_slice(
                                        $memberData['reservations'],
                                        $offset,
                                        $reservationsPerPage,
                                    ); // Lấy mảng đơn đặt chỗ cho trang hiện tại
                                @endphp

                                @foreach ($reservationsToShow as $reservation)
                                    <div class="reservation-card mb-3" style="background-color: #2b2b2b; padding: 15px; border-radius: 5px; color: #d3d3d3;"> <!-- Nền tối và chữ xám nhạt -->
                                        <div>
                                            <p><strong style="color: #f5cc00;">{{ $reservation['status'] }}</strong></p> <!-- Màu vàng -->
                                            <p style="display: inline; margin-right: 10px;">Ngày:
                                                {{ \Carbon\Carbon::parse($reservation['date'])->format('l, d F Y') }}</p>
                                            <p style="display: inline; margin-right: 10px;">Giờ: {{ $reservation['time'] }}
                                            </p>
                                            <p style="display: inline; margin-right: 10px;"><i class="bi bi-people"></i>
                                                {{ $reservation['people'] }} người</p>
                                        </div>
                                        <div class="actions">
                                            <a href="#" class="btn-outline-warning" >Chi tiết</a> <!-- Nút màu nâu nhạt -->
                                            <a href="#" class="btn-outline-danger" >Cancel</a> <!-- Nút đỏ -->
                                            {{-- <a href="#" class="btn btn-secondary">Add to calendar</a> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Bạn không có đặt chỗ sắp tới.</p>
                            @endif
                        </div>

                        <div id="accountDetailsSection" class="content-section" style="display:none;">
                            <h3>Thông tin cá nhân</h3>
                            <div class="profile-info" style="background-color: #2b2b2b; padding: 15px; border-radius: 5px; color: #d3d3d3;"> <!-- Nền tối và chữ xám nhạt -->
                                <p>
                                    <strong>Họ tên:</strong> 
                                    <span id="displayName">{{ $memberData['name'] }}</span>
                                    <input type="text" id="inputName" value="{{ $memberData['name'] }}" style="display:none;" />
                                </p>
                                <p>
                                    <strong>Số điện thoại:</strong> 
                                    <span id="displayPhone">{{ $memberData['phone'] }}</span>
                                    <input type="text" id="inputPhone" value="{{ $memberData['phone'] }}" style="display:none;" />
                                </p>
                                <p>
                                    <strong>Email:</strong> 
                                    <span id="displayEmail">{{ $memberData['email'] }}</span>
                                    <input type="email" id="inputEmail" value="{{ $memberData['email'] }}" style="display:none;" />
                                </p>
                                <p>
                                    <strong>Địa chỉ:</strong> 
                                    <span id="displayLocation">{{ $memberData['location'] }}</span>
                                    <input type="text" id="inputLocation" value="{{ $memberData['location'] }}" style="display:none;" />
                                </p>
                                <p>
                                    <strong>Thành viên từ:</strong> {{ $memberData['member_since'] }}
                                </p>
                            </div>
                            <button onclick="saveChanges()" style="display:none;" id="saveButton" class="btn-line">Lưu thay đổi</button>
                            <button onclick="toggleEdit()" id="editButton" class="btn-line">Chỉnh sửa thông tin</button>
                        </div>

                    <div id="paymentSection" class="content-section" style="display:none;">
                        <h3>Phương thức thanh toán</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-avatar img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-update-savings {
            background-color: #f5a623;
            color: white;
        }
        .btn-save {
            background-color: #f5a623;
            color: white;
            width: 100%;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-inactive {
            background-color: #e0e0e0;
            color: #333;
        }
        .booking-item {
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .badge-reserved {
            color: #f5a623;
            background-color: #fff5e6;
            border: 1px solid #f5a623;
        }
        .badge-cancelled {
            color: #dc3545;
            background-color: #ffe6e6;
            border: 1px solid #dc3545;
        }
        .badge-completed {
            color: #28a745;
            background-color: #e6ffe6;
            border: 1px solid #28a745;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-white border-bottom-0">
                        <h4 class="fw-bold">User Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="profile-avatar mb-3">
                                <img src="user-avatar.jpg" alt="User Avatar">
                            </div>
                            <div class="mb-3 w-100">
                                <label for="fullName" class="form-label fw-bold">Full Name</label>
                                <input type="text" id="fullName" class="form-control" value="Bob Smith">
                            </div>
                            <div class="mb-3 w-100">
                                <label for="mobileNumber" class="form-label fw-bold">Mobile Number</label>
                                <input type="text" id="mobileNumber" class="form-control" value="+1 16538552163">
                            </div>
                            <div class="mb-3 w-100">
                                <label for="emailAddress" class="form-label fw-bold">Email Address</label>
                                <input type="email" id="emailAddress" class="form-control" value="Bob.smith22@gmail.com">
                            </div>
                            <div class="mb-3 w-100">
                                <label for="joinedDate" class="form-label fw-bold">Joined On</label>
                                <input type="text" id="joinedDate" class="form-control" value="12/12/2022" readonly>
                            </div>
                            <div class="mb-3 w-100">
                                <label for="savings" class="form-label fw-bold">Savings/Coins</label>
                                <div class="input-group">
                                    <input type="number" id="savings" class="form-control" value="20">
                                    <button class="btn btn-update-savings" type="button">Update Savings</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100 mt-4">
                                <button class="btn btn-delete w-100 me-2">Delete User</button>
                                <button class="btn btn-inactive w-100 ms-2">Make Inactive</button>
                            </div>
                            <button class="btn btn-save mt-3 w-100">Save/Update Details</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Section -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-white border-bottom-0">
                        <h4 class="fw-bold">History and Recent Bookings</h4>
                    </div>
                    <div class="card-body">
                        <!-- Booking 1 -->
                        <div class="booking-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0">Sea Grill of Merrick Park</h6>
                                <span class="badge badge-reserved">Reserved</span>
                            </div>
                            <small class="text-muted">2 hrs ago</small>
                            <p class="mb-1">
                                <i class="bi bi-calendar"></i> 17 December 2022 | 12:15 PM
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-people"></i> 2 Guests
                            </p>
                            <p class="mb-1"><strong>Saved:</strong> $2</p>
                            <a href="#" class="text-danger text-decoration-none">Cancel Booking</a>
                        </div>

                        <!-- Booking 2 -->
                        <div class="booking-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0">Sea Grill North Miami Beach</h6>
                                <span class="badge badge-cancelled">Cancelled</span>
                            </div>
                            <small class="text-muted">2 Days ago</small>
                            <p class="mb-1">
                                <i class="bi bi-calendar"></i> 17 December 2022 | 12:15 PM
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-people"></i> 2 Guests
                            </p>
                            <p class="mb-1"><strong>Saved:</strong> $0</p>
                        </div>

                        <!-- Booking 3 -->
                        <div class="booking-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0">Villagio Restaurant and Bar</h6>
                                <span class="badge badge-completed">Completed</span>
                            </div>
                            <small class="text-muted">10 Days ago</small>
                            <p class="mb-1">
                                <i class="bi bi-calendar"></i> 17 December 2022 | 12:15 PM
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-people"></i> 2 Guests
                            </p>
                            <p class="mb-1"><strong>Saved:</strong> $2</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
 --}}