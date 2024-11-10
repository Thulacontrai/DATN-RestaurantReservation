@extends('pos.layouts.master')

@section('title', 'POS | Trang chủ')

@section('content')

<<<<<<< HEAD
    <header class="navbar navbar-expand-lg p-2" style="background: linear-gradient(90deg, #004a89, #007bb5);">
        <div class="container-fluid">
            <!-- Left Section: Tabs for Phòng bàn and Thực đơn -->
            <div class="header-left d-flex align-items-center">
                <a class="nav-link active" href="#" id="table-view-button" aria-label="Xem Bàn">
                    <i class="fas fa-border-all"></i> Phòng bàn
                </a>
                <a class="nav-link" href="#" id="menu-view-button" aria-label="Xem Thực đơn">
                    <i class="material-icons">restaurant</i> Thực đơn
                </a>
                <input class="form-control1 me-2" id="searchInput" type="search" placeholder="Tìm món (F3)"
                    aria-label="Tìm món">
            </div>


            <!-- Right Section: Icons -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <button class="btn btn-link text-white">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <!-- Notification Button -->
                    <button class="btn btn-link text-white" id="notificationButton">
                        <i class="fas fa-bell"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-link text-white">
                        <i class="fas fa-sync"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <!-- Print Button -->
                    <button class="btn btn-link text-white" id="printButton">
                        <i class="fas fa-print"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <!-- Hamburger Menu -->
                    <button class="btn btn-link text-white" id="hamburgerMenu">
                        <i class="fas fa-bars"></i>
                    </button>

                </li>
            </ul>
        </div>

        <!-- Modal Popup Danh Sách Đặt Bàn-->
        <div class="modal fade" id="reservationListModal" tabindex="-1" role="dialog"
            aria-labelledby="reservationListModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservationListModalLabel">Danh sách đặt bàn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="search-filter">
                            <div class="input-group">
                                <label for="search">Tìm kiếm</label>
                                <input type="text" id="search" placeholder="Theo mã phiếu đặt">
                            </div>
                            <div class="input-group">
                                <label for="roomTable">Phòng/bàn</label>
                                <select id="roomTable">
                                    <option value="">Chọn phòng bàn</option>
                                    <!-- Các tùy chọn khác -->
                                </select>
                            </div>
                        </div>
                        <div class="time-group" style="flex-basis: 100%;">
                            <label for="fromDate">Thời Gian</label>
                            <input type="text" id="fromDate" placeholder="Từ ngày" onfocus="(this.type='date')"
                                onblur="if(!this.value){this.type='text'}">
                            <input type="text" id="toDate" placeholder="Đến ngày" onfocus="(this.type='date')"
                                onblur="if(!this.value){this.type='text'}">
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đặt bàn</th>
                                    <th scope="col">Phòng/bàn</th>
                                    <th scope="col">Giờ đến</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Số khách</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu bảng-->
                                @forelse ($reservations as $reservation)
                                    <tr id="reservation-{{ $reservation->id }}">
                                        <td class="text-center"><button type="button" class="transparent-button"
                                                data-toggle="modal"
                                                data-target="#orderDetailModal">{{ $reservation->id }}</button></td>
                                        <td class="text-center">
                                            @foreach ($reservation->tables as $table)
                                                {{ $table->table_number ?? 'Chưa xếp bàn' }}
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ $reservation->reservation_date }} <br>
                                            {{ $reservation->reservation_time }}</td>
                                        <td class="text-center">{{ $reservation->user_name ?? 'Không rõ' }}</td>
                                        <td class="text-center">{{ $reservation->user_phone ?? 'Không rõ' }}</td>
                                        <td class="text-center">{{ $reservation->guest_count ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            @if ($reservation->status === 'Confirmed')
                                                <span class="badge bg-success">Đã xác nhận</span>
                                            @elseif ($reservation->status === 'Pending')
                                                <span class="badge bg-warning">Chờ xử lý</span>
                                            @elseif ($reservation->status === 'Cancelled')
                                                <span class="badge bg-danger">Đã hủy</span>
                                            @elseif ($reservation->status === 'checked-in')
                                                <span class="badge bg-primary">Đã nhận bàn</span>
                                            @else
                                                <span class="badge bg-secondary">Không rõ</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="actions">
                                                <button class="btn btn-primary convertToOrder"
                                                    data-id="{{ $reservation->id }}">
                                                    Chuyển Đơn
                                                </button>
                                                <!-- Các hành động khác như Xem, Sửa, Hủy đơn đặt bàn -->
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">Không có đặt bàn nào được tìm thấy.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Chi Tiết -->
        <div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog"
            aria-labelledby="orderDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailModalLabel">Nguyễn Bá Thư - 0283982424</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <!-- Cột trái -->
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label for="customerName">Khách hàng</label>
                                        <input type="text" class="form-control" id="customerName"
                                            value="Nguyễn Bá Thư">
                                    </div>
                                    <div class="input-group">
                                        <label for="orderCode">Mã đặt bàn</label>
                                        <input type="text" class="form-control" id="orderCode" value="DB0000004"
                                            readonly>
                                    </div>
                                    <div class="input-group">
                                        <label for="arrivalTime">Giờ đến</label>
                                        <input type="text" class="form-control" id="arrivalTime"
                                            value="14/10/2024 21:30">
                                    </div>
                                    <div class="input-group">
                                        <label for="duration">Thời lượng</label>
                                        <select class="form-control" id="duration">
                                            <option selected>1 Giờ</option>
                                            <option>2 Giờ</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="numGuests">Số khách</label>
                                        <input type="number" class="form-control" id="numGuests" value="1"
                                            min="1">
                                    </div>
                                </div>
                                <!-- Cột phải -->
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label for="employee">Nhân viên nhận đặt</label>
                                        <select class="form-control" id="employee">
                                            <option>Nguyễn Văn Quang</option>
                                            <option>Nguyễn Văn A</option>
                                            <option>Nguyễn Văn B</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control" id="status">
                                            <option selected>Chờ xếp bàn</option>
                                            <option>Đã xếp bàn</option>
                                            <option>Đã hủy</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="tableInfo">Phòng/Bàn</label>
                                        <select class="form-control" id="tableInfo">
                                            <option selected>Chờ xếp bàn</option>
                                            <option>Bàn 1</option>
                                            <option>Bàn 2</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" id="notes" placeholder="Ghi Chú">
                                    </div>
                                </div>
                            </div>
                            <div class="btnGroup text-right mt-3">
                                <button type="button" class="btnEdit btn btn-danger">Xóa</button>
                                <button type="button" class="btnEdit btn btn-warning">Hủy đặt</button>
                                <button type="button" class="btnEdit btn btn-primary">Lưu & In</button>
                                <button type="button" class="btnEdit btn btn-success">Lưu</button>
                                <button type="button" class="btnEdit btn btn-secondary" data-dismiss="modal">Bỏ
                                    qua</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </header>
=======
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
    <div class="wrapper">
        <div class="container-fluid d-flex flex-grow-1 px-0">
            <!-- Phần bên trái: Phòng bàn và Thực đơn -->
            <div class="col-md-8 bg-light-gray p-4">
<<<<<<< HEAD
                <!-- Phần hiển thị Bàn -->
                <div class="table-section transition-section" id="table-section">
                    <!-- Lọc Bàn theo Trạng thái -->
                    <div class="filter-section mb-4 d-flex justify-content-start flex-nowrap">
                        <button class="btn btn-outline-primary filter-btn me-2 active" data-status="all">
                            Tất cả ({{ $totalTablesCount }})
                        </button>
                        <button class="btn btn-outline-success filter-btn me-2" data-status="available">
                            Trống ({{ $availableTablesCount }})
                        </button>
                        <button class="btn btn-outline-danger filter-btn" data-status="occupied">
                            Đang sử dụng ({{ $occupiedTablesCount }})
                        </button>
=======
                <!-- Điều hướng Phòng bàn và Thực đơn -->
                <nav class="nav nav-pills nav-fill mb-4">
                    <a class="nav-link active" href="#" id="table-view-button">
                        <i class="fas fa-th"></i> Phòng bàn
                    </a>
                    <a class="nav-link" href="#" id="menu-view-button">
                        <i class="fas fa-utensils"></i> Thực đơn
                    </a>
                </nav>

                <!-- Phần hiển thị các bàn -->
                <div class="table-section transition-section" id="table-section">
                    <!-- Phần lọc bàn theo trạng thái -->
                    <div class="filter-section mb-4 d-flex justify-content-start flex-nowrap" id="table-filter-section">
                        <button class="btn filter-btn active" data-status="all">Tất cả ({{ $totalTablesCount }})</button>
                        <button class="btn filter-btn" data-status="available">Trống ({{ $availableTablesCount }})</button>
                        <button class="btn filter-btn" data-status="reserved">Đã đặt ({{ $reservedTablesCount }})</button>
                        <button class="btn filter-btn" data-status="occupied">Đang sử dụng
                            ({{ $occupiedTablesCount }})</button>
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                    </div>
                    <div class="table-container d-flex flex-wrap justify-content-start"
                        style="max-height: 600px; overflow-y: auto;" id="layoutTable">
                        @foreach ($tables as $table)
<<<<<<< HEAD
                            <div class="table-card {{ strtolower(trim($table->status)) }}"
                                data-table-id="{{ $table->id }}" data-status="{{ $table->status }}">
                                <span class="table-number">Bàn {{ $table->table_number }}</span>
                                @if (strtolower(trim($table->status)) == 'available')
                                    <i class="material-icons text-success"
                                        style="font-size: 35px;padding-top: 50%;">event_seat</i>
                                @elseif (strtolower(trim($table->status)) == 'occupied')
                                    <i class="material-icons text-danger"
                                        style="font-size: 35px; padding-top: 50%;">local_dining</i>
                                @endif
=======
                            <div class="table-card {{ strtolower($table->status) }}" data-table-id="{{ $table->id }}"
                                onclick="selectTable({{ $table->id }}, '{{ $table->table_number }}')">
                                <div class="table-number">Bàn {{ $table->table_number }}</div>
                                <div class="border-decoration top"></div>
                                <div class="border-decoration bottom"></div>
                                <div class="border-decoration left"></div>
                                <div class="border-decoration right"></div>
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Phần hiển thị thực đơn -->
                <div class="menu-section transition-section" id="menu-section" style="display: none;">
                    <div class="filter-section mb-4 d-flex justify-content-start flex-nowrap">
                        <button class="btn filter-btn active" data-category="all">Tất cả</button>
                        <button class="btn filter-btn" data-category="mon-an">Món Ăn</button>
                        <button class="btn filter-btn" data-category="do-uong">Đồ Uống</button>
                        <button class="btn filter-btn" data-category="trang-mieng">Tráng Miệng</button>
                        <button class="btn filter-btn" data-category="combo">Combo</button>
                    </div>

                    <div class="row" id="dish-list">
                        @foreach ($dishes as $dish)
                            <div class="col-md-3 dish-item"
                                data-category="{{ strtolower(str_replace(' ', '-', $dish->category)) }}"
                                data-dish-id="{{ $dish->id }}" data-dish-price="{{ $dish->price }}">
                                <div class="card menu-item">
<<<<<<< HEAD
                                    <img class="btn btn-add-dish" data-dish-id="{{ $dish->id }}"
                                        src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
=======
                                    <img src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                                        alt="{{ $dish->name }}" class="img-fluid rounded"
                                        style="height: 200px; object-fit: cover;" />
                                    <div class="card-body text-center">
                                        <h5 class="card-price">{{ number_format($dish->price, 0, ',', '.') }} VND</h5>
                                        <p class="card-title">{{ \Str::limit($dish->name, 20, '...') }}</p>
                                        <button class="btn btn-primary btn-add-dish" data-dish-id="{{ $dish->id }}"
                                            data-dish-price="{{ $dish->price }}"
                                            data-dish-name="{{ $dish->name }}">Thêm món</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Phân trang -->
                    <div class="pagination mt-4">
                        {{ $dishes->links() }} <!-- Hiển thị liên kết phân trang -->
                    </div>
                </div>
            </div>
<<<<<<< HEAD
            <!-- Phần bên phải: Đơn hàng -->
            <div class="col-md-4 p-0 order-section">
                <nav class="navbar">
                </nav>
                <div class="order-content-container" style="padding-left: 20px;">
                    <div id="order-details" class="order-content-container">
                        <div class="empty-order">
                            <p>Chưa có món trong đơn</p>
                            <p>Vui lòng chọn món trong thực đơn bên trái màn hình</p>
                        </div>
                    </div>
                </div>
                <div class="total mt-4">Tổng tiền: <span id="totalAmount">0</span></div>
                <div class="btn-group">
                    <button class="btn btn-secondary" id="notification-button" aria-label="Thông báo" disabled>
                        <i class="fas fa-bell"></i> Thông báo
                    </button>
                    <button class="btn btn-primary" id="payment-button" aria-label="Thanh toán">
                        <i class="fas fa-dollar-sign"></i> Thanh toán
=======

            <!-- Phần bên phải: Đơn hàng -->
            <div class="col-md-4 p-0 order-section">
                <nav class="navbar">
                    <div class="col-md-5 d-flex align-items-center">

                            <i class="">👩‍💻</i>

                        <div class="tabs" id="orderTabs"></div>

                        <input type="text" class="search-input" placeholder="Tìm khách hàng" aria-label="Tìm khách hàng">

                     <a href=""><i class="bi bi-person-plus">🧛‍♀️</i></a>

						</a>
                    </div>
                </nav>
                <!-- Nội dung đơn hàng -->
                <div id="order-details" class="order-content-container">
                    <div class="empty-order">
                        <svg fill="none" height="40" viewBox="0 0 40 40" width="40"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- SVG nội dung -->
                        </svg>
                        <svg _ngcontent-nis-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40"
                            xmlns="http://www.w3.org/2000/svg">
                            <path _ngcontent-nis-c34=""
                                d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z"
                                fill="#0066CC"></path>
                        </svg>
                        <p>Chưa có món trong đơn</p>
                        <p>Vui lòng chọn món trong thực đơn bên trái màn hình</p>
                    </div>
                </div>
                <div class="total mt-4">Tổng tiền: <span id="totalAmount">0</span>₫</div>
                <div class="btn-group">
                    <button class="btn btn-secondary" id="notification-button">
                        <i class="fas fa-bell"></i> Thông báo (F10)
                    </button>
                    <button class="btn btn-primary" id="payment-button">
                        <i class="fas fa-dollar-sign"></i> Thanh toán (F9)
                    </button>
                    <button class="btn btn-info" id="print-button">
                        <i class="fas fa-print"></i> In hóa đơn tạm
                    </button>
                    <button class="btn btn-warning" id="note-button">
                        <i class="fas fa-edit"></i> Ghi chú
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                    </button>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedTableId = null;
        document.querySelector('#layoutTable').addEventListener('click', function(event) {
            const card = event.target.closest('.table-card');
            if (!card) return;
            selectedTableId = card.dataset.tableId;
            const tableId = card.dataset.tableId;
            const tableStatus = card.dataset.status;
            tableStatus === 'Occupied' ? showOrderDetails(tableId) : createOrder(tableId);
        });
        document.querySelector('#dish-list').addEventListener('click', function(event) {
            const card = event.target.closest('.dish-item');
            if (!card) return;
            const dishId = card.dataset.dishId;
            addDishToOrder(dishId, selectedTableId);
        });

        function createOrder(tableId) {
            Swal.fire({
                title: "Nhận gọi món cho bàn này?",
                showDenyButton: true,
                confirmButtonText: "Đúng",
                denyButtonText: `Hủy`
            }).then((result) => {
                if (result.isConfirmed) {
                    showNotification('Tạo đơn thành công');
                    fetch('/create-order/' + tableId, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => showOrderDetail(tableId))
                        .catch(() => showNotification('Lỗi khi tạo đơn', 'error'));
                } else if (result.isDenied) {
                    showNotification('Tạo đơn thất bại', 'error');
                }
            });
        }
        const orderDetails = document.getElementById('order-details');
        orderDetails.addEventListener("click", function(event) {
            const dishElement = event.target.closest(".item-list");
            if (dishElement) {
                const dishId = dishElement.dataset.dishId;
                if (event.target.classList.contains("plus-item")) {
                    increaseQuantity(dishId, selectedTableId);
                }
                if (event.target.classList.contains("minus-item")) {
                    decreaseQuantity(dishId, selectedTableId);
                }
                if (event.target.classList.contains("delete-item")) {
                    deleteItem(dishId, selectedTableId);
                }
            }
        });

        function increaseQuantity(dishId, selectedTableId) {
            fetch(`/increaseQuantity`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        table_id: selectedTableId,
                        dish_id: dishId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {} else {
                        showNotification('è èèèè', 'error')
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function decreaseQuantity(dishId, selectedTableId) {
            fetch(`/decreaseQuantity`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        table_id: selectedTableId,
                        dish_id: dishId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {} else {
                        showNotification('è èèèè', 'error')
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function deleteItem(dishId, selectedTableId) {
            Swal.fire({
                title: 'Nhập lý do hủy',
                input: 'text',
                inputPlaceholder: 'Nhập lý do...',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = result.value;
                    fetch(`/deleteItem`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                table_id: selectedTableId,
                                dish_id: dishId,
                                reason: reason
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification('Hủy món thành công!', 'success');
                            } else {
                                showNotification('Lỗi khi xóa', 'error');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    showNotification('Hủy món thất bại', 'info');
                }
            });
        }




        function addDishToOrder(dishId, selectedTableId) {
            if (selectedTableId) {
                fetch(`/add-dish-to-order`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            table_id: selectedTableId,
                            dish_id: dishId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Thêm món thành công')
                        } else {
                            showNotification('è èèèè', 'error')
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                showNotification('Hãy chọn bàn trước khi thêm món', 'error')
            }
        }

        function showOrderDetail(tableId) {
            fetch('/order-detail/' + tableId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    const {
                        order,
                        table,
                        tableId
                    } = data;
                    let totalAmount = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(order.final_amount);

                    let htmlContent = `
            <h3>Chi tiết đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> ${order.id}</p>
            <p><strong>Bàn:</strong> ${tableId.table_number}</p>
            <p><strong>Giờ vào:</strong> ${table.pivot.start_time.split(" ")[1]}</p>
            <p><strong>Trạng thái:</strong> ${order.status}</p>
            <h4>Danh sách món</h4>
            <div class="empty-order">
                <p>Chưa có món trong đơn</p>
                <p>Vui lòng chọn món trong thực đơn bên trái màn hình</p>
            </div>
        `;

                    document.getElementById('totalAmount').innerHTML = totalAmount;
                    document.getElementById('order-details').innerHTML = htmlContent;
                })
                .catch(() => showNotification('Không thể lấy chi tiết đơn hàng.', 'error'));
        }

        function showOrderDetails(tableId) {
            fetch('/order-details/' + tableId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    const {
                        order,
                        table,
                        tableId
                    } = data;
                    let totalAmount = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(order.final_amount);

                    let htmlContent = `
            <h3>Chi tiết đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> ${order.id}</p>
            <p><strong>Bàn:</strong> ${tableId.table_number}</p>
            <p><strong>Giờ vào:</strong> ${table.pivot.start_time.split(" ")[1]}</p>
            <p><strong>Trạng thái:</strong> ${order.status}</p>
            <h4>Danh sách món</h4>
        `;

                    table.order_items.forEach(item => {
                        if (item.status == 'chờ xử lý') {
                            htmlContent += `
                <li class="item-list" data-dish-id="${item.item_id}"><span class="text-dark">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
            `;
                        } else if (item.status == 'đang chế biến') {
                            htmlContent += `
                <li class="item-list" data-dish-id="${item.item_id}"><span class="text-danger">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
            `;
                        } else if (item.status == 'chờ cung ứng') {
                            htmlContent += `
                <li class="item-list" data-dish-id="${item.item_id}"><span class="text-primary">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
            `;
                        } else if (item.status == 'hoàn thành') {
                            htmlContent += `
                <li class="item-list" data-dish-id="${item.item_id}"><span class="text-success">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
            `;
                        }
                    });
                    document.getElementById('totalAmount').innerHTML = totalAmount;
                    document.getElementById('order-details').innerHTML = htmlContent;
                })
                .catch(() => showNotification('Không thể lấy chi tiết đơn hàng.', 'error'));
        }

        function showNotification(message, type = 'success') {
            Swal.fire({
                icon: type,
                title: 'Thông báo',
                text: message,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
    });
</script>
@vite(['resources\js\posTable.js', 'resources\js\orderItem.js'])
<style>
    .wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 5px;
        background-image: url('https://apac-marketing.webbeds.com/wp-content/uploads/2018/10/Marco-Polo-Hotel-2.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        /* min-height: 100vh;
        max-height: 100vh; */
        /* Đặt chiều cao tối đa cho wrapper */
        overflow-y: hidden;
        /* Tránh việc hiển thị thanh cuộn không cần thiết */
    }

    .table-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        /* Căn đều các thẻ */
        max-height: calc(100vh - 150px);
        /* Điều chỉnh chiều cao tối đa cho phần chứa bàn để vừa với màn hình */
        overflow-y: auto;
        padding-bottom: 20px;
        /* Thêm khoảng cách dưới để tránh quá sát viền */
    }

    .table-card {
        position: relative;
        padding: 8px;
        margin: 8px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100px;
        /* Giảm kích thước thẻ */
        height: 120px;
        /* Giảm kích thước thẻ */
        text-align: center;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    /* Responsive cho các màn hình nhỏ */
    @media (max-width: 768px) {
        .table-card {
            width: 80px;
            height: 100px;
        }
    }

    @media (max-width: 576px) {
        .table-card {
            width: 60px;
            height: 80px;
        }

        .navbar .form-control {
            width: 100%;
        }

        .order-section {
            padding: 5px;
        }

        .table-container {
            max-height: calc(100vh - 200px);
            /* Giảm chiều cao cho màn hình nhỏ hơn để đảm bảo không bị tràn */
        }

        .progress {
            height: 6px;
            /* Giảm chiều cao của thanh tiến trình */
        }

        .nav-link {
            font-size: 14px;
            /* Giảm kích thước font trên thiết bị nhỏ */
        }

        .btn {
            padding: 8px 10px;
            font-size: 12px;
            /* Giảm kích thước nút trên thiết bị nhỏ */
        }
    }


    .table-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        max-height: 85vh;
        overflow-y: auto;
        padding-bottom: 20px;
        /* Thêm khoảng trống phía dưới để tránh hiển thị chạm đáy */
    }

    .bin-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background-color: rgb(255, 95, 95);
        cursor: pointer;
        border: 2px solid rgb(255, 201, 201);
        transition-duration: 0.3s;
        position: relative;
        overflow: hidden;
    }

    .bin-bottom {
        width: 15px;
        z-index: 2;
    }

    .bin-top {
        width: 17px;
        transform-origin: right;
        transition-duration: 0.3s;
        z-index: 2;
    }

    .bin-button:hover .bin-top {
        transform: rotate(45deg);
    }

    .bin-button:hover {
        background-color: rgb(255, 0, 0);
    }

    .bin-button:active {
        transform: scale(0.9);
    }

    .garbage {
        position: absolute;
        width: 14px;
        height: auto;
        z-index: 1;
        opacity: 0;
        transition: all 0.3s;
    }

    .bin-button:hover .garbage {
        animation: throw 0.4s linear;
    }

    @keyframes throw {
        from {
            transform: translate(-400%, -700%);
            opacity: 0;
        }

        to {
            transform: translate(0%, 0%);
            opacity: 1;
        }
    }


    .scene {
        width: 10em;
        justify-content: center;
        align-items: center;
    }

    .cube {
        color: #ccc;
        cursor: pointer;
        font-family: 'Roboto', sans-serif;
        transition: all 0.85s cubic-bezier(.17, .67, .14, .93);
        transform-style: preserve-3d;
        transform-origin: 100% 50%;
        width: 10em;
        height: 4em;
    }

    .cube:hover {
        transform: rotateX(-90deg);
    }

    .side {
        box-sizing: border-box;
        position: absolute;
        display: inline-block;
        height: 4em;
        width: 10em;
        text-align: center;
        text-transform: uppercase;
        padding-top: 1.5em;
        font-weight: bold;
    }

    .top {
        background: wheat;
        color: #222229;
        transform: rotateX(90deg) translate3d(0, 0, 2em);
        box-shadow: inset 0 0 0 5px #fff;
    }

    .front {
        background: #222229;
        color: #fff;
        box-shadow: inset 0 0 0 5px #fff;
        transform: translate3d(0, 0, 2em);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notificationButton = document.getElementById('notificationButton');
        const printButton = document.getElementById('printButton');

        // Notification Badge Animation
        notificationButton.addEventListener('click', function() {
            alert("Bạn có 3 thông báo mới!");
        });

        // Print Button
        printButton.addEventListener('click', function() {
            alert("Đang in...");
        });

        // Search Bar
        const searchInput = document.getElementById('searchInput');
        const dishItems = document.querySelectorAll('.dish-item');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            dishItems.forEach(function(dish) {
                const dishName = dish.querySelector('.menu-item p').textContent.toLowerCase();

                if (dishName.includes(searchTerm)) {
                    dish.style.display = 'block';
                } else {
                    dish.style.display = 'none';
                }
            });
        });
    });

    // Modal danh sách đặt bàn
    document.getElementById('modalListReservation').addEventListener('click', function() {
        $('#reservationListModal').modal('show');
    });
</script>
=======
    <!-- Modal In hóa đơn tạm -->
    <div id="printModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>In hóa đơn tạm thời</h3>
            <label for="printTemplate">Chọn mẫu in:</label>
            <input type="number" id="printTemplate" value="1">
            <label for="copyCount">Số bản in:</label>
            <input type="number" id="copyCount" value="1">
            <div class="modal-actions">
                <button class="btn btn-primary" id="confirmPrint">Xác nhận</button>
                <button class="btn btn-secondary" id="cancelPrint">Hủy</button>
            </div>
        </div>
    </div>

    <!-- Modal Ghi chú -->
    <div id="noteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>Ghi chú đơn hàng</h3>
            <textarea id="orderNote" rows="4" placeholder="Nhập ghi chú..."></textarea>
            <div class="modal-actions">
                <button class="btn btn-primary" id="confirmNote">Lưu ghi chú</button>
                <button class="btn btn-secondary" id="cancelNote">Hủy</button>
            </div>
        </div>
    </div>

    <!-- Dropdown Thông báo -->
    <div id="notificationDropdown" class="dropdown" style="display: none;">
        <h4>Thông báo đơn hàng</h4>
        <ul id="notificationList">
            <li>Không có thông báo</li>
        </ul>
    </div>

    <!-- Script cho việc xử lý logic -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableViewButton = document.getElementById('table-view-button');
            const menuViewButton = document.getElementById('menu-view-button');
            const tableSection = document.getElementById('table-section');
            const menuSection = document.getElementById('menu-section');
            const orderDetails = document.getElementById('order-details');
            let currentOrder = {};
            let totalAmount = 0;
            let orderId = null;

            // Hàm hiển thị thông báo
            function showNotification(message) {
                const notification = document.getElementById('notification');
                const notificationMessage = document.getElementById('notification-message');
                notificationMessage.textContent = message;
                notification.style.display = 'block';

                // Ẩn thông báo sau 3 giây
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 3000);
            }

            function hideSection(element) {
                element.style.display = "none";
            }

            function showSection(element) {
                element.style.display = "block";
            }

            // Chuyển đổi giữa Phòng bàn và Thực đơn
            tableViewButton.addEventListener('click', function() {
                hideSection(menuSection);
                showSection(tableSection);
                tableViewButton.classList.add('active');
                menuViewButton.classList.remove('active');
            });

            menuViewButton.addEventListener('click', function() {
                hideSection(tableSection);
                showSection(menuSection);
                menuViewButton.classList.add('active');
                tableViewButton.classList.remove('active');
            });

            // Khi bấm vào bàn để tạo đơn hàng
            document.querySelectorAll('.table-box').forEach(function(tableBox) {
                tableBox.addEventListener('click', function() {
                    const tableId = this.getAttribute('data-table-id');
                    createOrder(tableId);
                });
            });

            // Tạo đơn hàng mới và hiển thị đơn hàng bên phải
            function createOrder(tableId) {
                fetch('/create-order', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            table_id: tableId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            orderId = data.order.id;
                            updateOrderDisplay(data.order);
                            currentOrder = {};
                            totalAmount = 0;
                            showNotification('Đã tạo đơn hàng thành công cho Bàn ' + data.table_number);
                        } else {
                            alert('Lỗi khi tạo đơn hàng: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi khi kết nối tới server.');
                    });
            }

            // Cập nhật hiển thị đơn hàng
            function updateOrderDisplay(order) {
                orderDetails.innerHTML = `
            <div class="order-info">
                <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
                <p>Trạng thái: ${order.status}</p>
            </div>
            <div class="empty-cart text-center">
                <i class="fas fa-utensils fa-3x"></i>
                <p>Chưa có món trong đơn</p>
                <span>Vui lòng chọn món từ thực đơn</span>
            </div>`;
                document.querySelector('.total-price').innerText = `Tổng tiền: ${totalAmount} VND`;
            }

            // Thêm món vào đơn hàng và lưu vào cơ sở dữ liệu
            document.querySelectorAll('.btn-add-dish').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const dishId = this.getAttribute('data-dish-id');
                    const dishPrice = parseFloat(this.getAttribute('data-dish-price'));
                    const dishName = this.getAttribute('data-dish-name');

                    if (!orderId) {
                        alert('Vui lòng chọn bàn trước khi thêm món!');
                        return;
                    }

                    if (currentOrder[dishId]) {
                        currentOrder[dishId].quantity += 1;
                    } else {
                        currentOrder[dishId] = {
                            dishName,
                            dishPrice,
                            quantity: 1
                        };
                    }

                    totalAmount = Object.values(currentOrder).reduce((total, item) => total + (item
                        .dishPrice * item.quantity), 0);
                    updateOrderItems();

                    // Gọi API để lưu món ăn vào cơ sở dữ liệu
                    saveDishToOrder(orderId, dishId, currentOrder[dishId].quantity);
                });
            });

            // Lưu món ăn vào cơ sở dữ liệu
            function saveDishToOrder(orderId, dishId, quantity) {
                fetch('/add-dish-to-order', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order_id: orderId,
                            dish_id: dishId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Đã thêm ' + data.orderItem.dishName + ' vào đơn hàng.');
                        } else {
                            alert('Lỗi khi thêm món vào đơn hàng: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi khi kết nối tới server.');
                    });
            }

            // Cập nhật các món trong đơn hàng
            function updateOrderItems() {
                orderDetails.innerHTML = '';
                for (const itemId in currentOrder) {
                    const item = currentOrder[itemId];
                    const orderItemHTML = `
                <div class="order-item d-flex justify-content-between align-items-center">
                    <span>${item.dishName} x
                        <input type="number" min="1" value="${item.quantity}" class="quantity-input" data-dish-id="${itemId}" style="width: 50px; text-align: center;" />
                    </span>
                    <span style="color: #28a745;">${item.dishPrice * item.quantity} VND</span>
                    <button class="btn btn-danger btn-delete" data-dish-id="${itemId}">Xóa</button>
                </div>`;
                    orderDetails.innerHTML += orderItemHTML;
                }

                document.querySelector('.total-price').innerText = `Tổng tiền: ${totalAmount} VND`;

                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const dishId = this.getAttribute('data-dish-id');
                        delete currentOrder[dishId];
                        updateOrderItems();
                    });
                });

                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const dishId = this.getAttribute('data-dish-id');
                        const newQuantity = parseInt(this.value);
                        if (currentOrder[dishId] && newQuantity > 0) {
                            currentOrder[dishId].quantity = newQuantity;
                            updateOrderItems();
                        }
                    });
                });
            }
        });
    </script>



@endsection
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
