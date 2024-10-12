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

            <div class="container-fluid">
                <div class="row">
                    <!-- Side Menu -->
                    <div class="col-md-3 side-menu p-3">
                        <div class="d-flex align-items-center mb-4">
                            <div class="profile-circle">{{ strtoupper(substr($memberData['name'], 0, 1)) }}</div>
                            <div class="ms-3">
                                <h5 class="text-danger">Hi, {{ $memberData['name'] }}</h5>
                                <p class="text-muted">{{ $memberData['location'] }}</p>
                                <p class="text-muted">Thành viên từ {{ $memberData['member_since'] }}</p>
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link " href="#" onclick="showSection('reservationSection')">Đặt
                                    chỗ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#" onclick="showSection('accountDetailsSection')">Chi tiết
                                    tài khoản</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#" onclick="showSection('paymentSection')">Phương thức
                                    thanh
                                    toán</a>
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
                                    <div class="reservation-card mb-3">
                                        <div>
                                            <p><strong>{{ $reservation['status'] }}</strong></p>
                                            <p style="display: inline; margin-right: 10px;">Ngày:
                                                {{ \Carbon\Carbon::parse($reservation['date'])->format('l, d F Y') }}</p>
                                            <p style="display: inline; margin-right: 10px;">Giờ: {{ $reservation['time'] }}
                                            </p>
                                            <p style="display: inline; margin-right: 10px;"><i class="bi bi-people"></i>
                                                {{ $reservation['people'] }} người</p>
                                        </div>
                                        <div class="actions">
                                            <a href="#" class="btn btn-primary">Modify</a>
                                            <a href="#" class="btn btn-danger">Cancel</a>
                                            <a href="#" class="btn btn-secondary">Add to calendar</a>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Phân trang -->
                               
                            @else
                                <p>Bạn không có đặt chỗ sắp tới.</p>
                            @endif
                            <!-- Add the rest of your reservation content here -->
                        </div>
                    


                    {{-- <div class="reservation-details">
                           
                            <p><strong>Status:</strong> Reservation confirmed</p>
                            <p><strong>Guests:</strong> {{ $reservation->guest_count }}</p>
                            <p><strong>Date:</strong> {{ $reservation->reservation_date->format('D, M d at g:i A') }}</p>
                        
                            <div class="actions">
                                <a href="#" class="btn btn-primary">Modify</a>
                                <a href="#" class="btn btn-danger">Cancel</a>
                                <a href="#" class="btn btn-secondary">Add to calendar</a>
                            </div>
                        
                            <div class="additional-info">
                                <a href="#">Browse Menu</a>
                                <a href="#">Get Directions</a>
                                <a href="#">Send Message</a>
                            </div>
                        </div> --}}


                        <div id="accountDetailsSection" class="content-section" style="display:none;">
                            <h3>Thông tin cá nhân</h3>
                            <div class="profile-info">
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
                        <!-- Payment details -->
                    </div>
                </div>
</div>
            </div>
        </div>












    </div>

    </div>

@endsection
