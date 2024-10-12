@extends('pos.layouts.master')

@section('title', 'POS | Trang chủ')

@section('content')

    <div class="wrapper">
        <div class="container-fluid d-flex flex-grow-1 px-0">
<<<<<<< HEAD
            <!-- Phần bên trái: Phòng bàn và Thực đơn -->
=======
            <!-- Phần bên trái: Phòng bàn và thực đơn -->
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
            <div class="col-md-8 bg-light-gray p-4">
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
<<<<<<< HEAD
                    <!-- Phần lọc bàn theo trạng thái -->
                    <div class="filter-section mb-4 d-flex justify-content-start flex-nowrap" id="table-filter-section">
                        <button class="btn filter-btn active" data-status="all">Tất cả ({{ $totalTablesCount }})</button>
                        <button class="btn filter-btn" data-status="available">Trống ({{ $availableTablesCount }})</button>
                        <button class="btn filter-btn" data-status="reserved">Đã đặt ({{ $reservedTablesCount }})</button>
                        <button class="btn filter-btn" data-status="occupied">Đang sử dụng
                            ({{ $occupiedTablesCount }})</button>
                    </div>

                    <div class="table-container d-flex flex-wrap justify-content-start"
                        style="max-height: 600px; overflow-y: auto;">
                        @foreach ($tables as $table)
                            <div class="table-card {{ strtolower($table->status) }}" data-table-id="{{ $table->id }}"
                                onclick="selectTable({{ $table->id }}, '{{ $table->table_number }}')">
                                <div class="table-number">Bàn {{ $table->table_number }}</div>
                                <div class="border-decoration top"></div>
                                <div class="border-decoration bottom"></div>
                                <div class="border-decoration left"></div>
                                <div class="border-decoration right"></div>
=======
                    <div class="table-container d-flex flex-wrap justify-content-start">
                        @foreach ($tables as $table)
                            <div class="table-box" data-table-id="{{ $table->id }}">
                                <span class="table-name">Bàn {{ $table->table_number }}</span>
                                <div class="table-details">
                                    <i class="fas fa-utensils"></i> 4
                                    <i class="fas fa-user-friends"></i> 8
                                </div>
                                <div class="table-status">Tầng 1</div>
                                <div class="table-price">0 VND</div>
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
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

<<<<<<< HEAD
                    <!-- Phần danh sách món ăn -->
                    <div class="row" id="dish-list" style="max-height: 600px; overflow-y: auto;">
=======
                    <div class="row" id="dish-list">
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                        @foreach ($dishes as $dish)
                            <div class="col-md-3 dish-item"
                                data-category="{{ strtolower(str_replace(' ', '-', $dish->category)) }}"
                                data-dish-id="{{ $dish->id }}" data-dish-price="{{ $dish->price }}">
                                <div class="card menu-item">
                                    <img src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
                                        alt="{{ $dish->name }}" class="img-fluid rounded"
                                        style="height: 200px; object-fit: cover;" />
                                    <div class="card-body text-center">
                                        <h5 class="card-price">{{ number_format($dish->price, 0, ',', '.') }} VND</h5>
                                        <p class="card-title">{{ \Str::limit($dish->name, 20, '...') }}</p>
                                        <button class="btn btn-primary btn-add-dish" data-dish-id="{{ $dish->id }}"
<<<<<<< HEAD
                                            data-dish-price="{{ $dish->price }}" data-dish-name="{{ $dish->name }}"
                                            onclick="addDishToOrder({{ $dish->id }}, '{{ $dish->name }}', {{ $dish->price }})">Thêm
                                            món</button>
=======
                                            data-dish-price="{{ $dish->price }}"
                                            data-dish-name="{{ $dish->name }}">Thêm món</button>
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
<<<<<<< HEAD
=======
                    <!-- Phân trang -->
                    <div class="pagination mt-4">
                        {{ $dishes->links() }} <!-- Hiển thị liên kết phân trang -->
                    </div>
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                </div>
            </div>

            <!-- Phần bên phải: Đơn hàng -->
<<<<<<< HEAD
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
                    </button>
=======
            <div class="col-md-4 p-4 order-section">
                <div id="notification" class="alert alert-success"
                    style="display:none; position:fixed; bottom:10px; right:10px; z-index:9999;">
                    <strong>Thông báo!</strong> <span id="notification-message">Đơn hàng đã được tạo.</span>
                </div>
                <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt"></i> <span id="order-count">0</span> Đơn hàng
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="order-dropdown"></ul>
                </div>

                <div id="order-details" class="order-details mt-4">
                    <div class="empty-cart text-center">
                        <i class="fas fa-utensils fa-3x"></i>
                        <p>Chưa có món trong đơn</p>
                        <span>Vui lòng chọn món từ thực đơn</span>
                    </div>
                </div>

                <div class="payment-actions d-flex justify-content-between align-items-center mt-4">
                    <span class="fw-bold total-price">Tổng tiền: 0 VND</span>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-2">Thông báo (F10)</button>
                        <button class="btn btn-success">Thanh toán (F9)</button>
                    </div>
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
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
=======
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableViewButton = document.getElementById('table-view-button');
            const menuViewButton = document.getElementById('menu-view-button');
            const tableSection = document.getElementById('table-section');
            const menuSection = document.getElementById('menu-section');
            const orderDetails = document.getElementById('order-details');
<<<<<<< HEAD
            const totalAmountElement = document.getElementById('totalAmount');

            // Chuyển đổi giữa Phòng bàn và Thực đơn
            tableViewButton.addEventListener('click', function() {
                menuSection.style.display = 'none';
                tableSection.style.display = 'block';
=======
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
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                tableViewButton.classList.add('active');
                menuViewButton.classList.remove('active');
            });

            menuViewButton.addEventListener('click', function() {
<<<<<<< HEAD
                tableSection.style.display = 'none';
                menuSection.style.display = 'block';
=======
                hideSection(tableSection);
                showSection(menuSection);
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                menuViewButton.classList.add('active');
                tableViewButton.classList.remove('active');
            });

<<<<<<< HEAD
            // Lọc bàn theo trạng thái
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    document.querySelectorAll('.table-card').forEach(table => {
                        if (status === 'all' || table.classList.contains(status)) {
                            table.style.display = 'block';
                        } else {
                            table.style.display = 'none';
                        }
                    });
                    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove(
                        'active'));
                    this.classList.add('active');
                });
            });

            // Lọc món ăn theo danh mục
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    document.querySelectorAll('.dish-item').forEach(dish => {
                        if (category === 'all' || dish.getAttribute('data-category') ===
                            category) {
                            dish.style.display = 'block';
                        } else {
                            dish.style.display = 'none';
                        }
                    });
                    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove(
                        'active'));
                    this.classList.add('active');
                });
            });

            // Cập nhật tổng tiền đơn hàng
            function updateTotalAmount(newAmount) {
                totalAmountElement.innerText = newAmount + " ₫";
            }

            // Hàm cập nhật hiển thị đơn hàng
            function updateOrderDisplay(order) {
                let itemsHTML = `
                <div class="order-info">
                    <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
                    <p>Trạng thái: ${order.status}</p>
                </div>`;
                if (order.items.length === 0) {
                    itemsHTML += `
                <div class="empty-cart text-center">
                    <svg _ngcontent-nis-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-nis-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
                    <p>Chưa có món trong đơn</p>
                    <span>Vui lòng chọn món từ thực đơn</span>
                </div>`;
                } else {
                    order.items.forEach(item => {
                        itemsHTML += `
                    <div class="order-item">
                        <p>${item.name} x ${item.quantity}</p>
                        <p>${item.price * item.quantity} ₫</p>
                    </div>`;
                    });
                }
                orderDetails.innerHTML = itemsHTML;
                updateTotalAmount(order.total_amount);
            }

            // Hàm xử lý khi chọn bàn
            function selectTable(tableId, tableNumber) {
                const tableCard = document.querySelector(`[data-table-id="${tableId}"]`);

                if (tableCard.classList.contains('reserved')) {
                    // Gọi API để lấy đơn hàng của bàn đã đặt
                    fetch(`/api/tables/${tableId}/order`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Hiển thị chi tiết đơn hàng và món ăn
                                updateOrderDisplay({
                                    table_number: tableNumber,
                                    status: 'Đã đặt',
                                    items: data.orderItems,
                                    total_amount: data.totalAmount
                                });
                            } else {
                                console.error('Không tìm thấy đơn hàng cho bàn đã đặt.');
                            }
                        })
                        .catch(error => console.error('Lỗi khi lấy đơn hàng:', error));
                } else {
                    console.log(`Bàn ${tableNumber} không ở trạng thái đã đặt.`);
                }
            }


            function updateOrderDisplay(order) {
                let itemsHTML = `
    <div class="order-info">
        <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
        <p>Trạng thái: ${order.status}</p>
    </div>`;

                if (order.items.length === 0) {
                    itemsHTML += `
        <div class="empty-cart text-center">
            <svg _ngcontent-nis-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-nis-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
            <p>Chưa có món trong đơn</p>
            <span>Vui lòng chọn món từ thực đơn</span>
        </div>`;
                } else {
                    order.items.forEach(item => {
                        itemsHTML += `
            <div class="order-item">
                <p>${item.name} x ${item.quantity}</p>
                <p>${item.total_price} ₫</p>
            </div>`;
                    });
                }

                // Cập nhật phần hiển thị đơn hàng
                document.getElementById('order-details').innerHTML = itemsHTML;
                document.getElementById('totalAmount').innerText = order.total_amount + ' ₫';
            }

        });
    </script>

=======
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



>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
@endsection
