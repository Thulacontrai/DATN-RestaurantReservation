@extends('pos.layouts.master')

@section('title', 'POS | Trang chủ')

@section('content')

    <div class="wrapper">
        <div class="container-fluid d-flex flex-grow-1 px-0">
            <!-- Phần bên trái: Phòng bàn và thực đơn -->
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
                                    <img src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
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

            <!-- Phần bên phải: Đơn hàng -->
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
                </div>
            </div>
        </div>
    </div>

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
