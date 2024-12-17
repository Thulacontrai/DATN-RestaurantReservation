@extends('pos.layouts.master')

@section('title', 'POS | Trang chủ')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>
    .swal2-container .select2-dropdown {
        z-index: 1060 !important;
    }

    .swal2-container .select2-container--default .select2-selection--multiple {
        width: 100%;
    }
</style>
@section('content')
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: session('error'),
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        </script>
    @endif
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
                <input class="form-control1 me-2" id="searchTable" type="search" placeholder="Tìm theo bàn, mã đơn"
                    aria-label="Tìm bàn">
                <input class="form-control1 me-2" id="searchInput" type="search" placeholder="Tìm theo món, giá"
                    aria-label="Tìm món" style="display: none;">
            </div>



            <!-- Right Section: Icons -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
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
            aria-labelledby="reservationListModalLabel" aria-hidden="true" style="display: none">
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
                                    @foreach ($availableTables as $table)
                                        <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                                    @endforeach
                                    <!-- Các tùy chọn khác -->
                                </select>
                            </div>
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
                                    <th scope="col">hành động</th>
                                </tr>
                            </thead>
                            <tbody id="reservationDetailsBody">
                                <!-- Dữ liệu sẽ được load vào đây qua AJAX -->
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
    <div class="wrapper">
        <div class="container-fluid d-flex flex-grow-1 px-0">
            <!-- Phần bên trái: Bàn và Thực đơn -->
            <div class="col-md-8 bg-light-gray p-4">
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
                    </div>
                    <div class="table-container d-flex flex-wrap justify-content-start"
                        style="max-height: 600px; overflow-y: auto;" id="layoutTable">
                        @foreach ($tables as $table)
                            <div class="table-card {{ strtolower(trim($table->status)) }}"
                                data-table-id="{{ $table->id }}" data-status="{{ $table->status }}"
                                data-order-id="@foreach ($table->orders as $column) {{ $column->reservation->user_name ?? null }} @endforeach">
                                <span class="table-number">Bàn {{ $table->table_number }}</span>
                                <div class="table-o">
                                    @foreach ($table->orders as $column)
                                        <span><i class="fa-solid fa-id-card"></i>
                                            {{ $column->reservation->id ?? ($column->id ?? null) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Phần hiển thị Thực đơn -->
                <div class="menu-section transition-section" id="menu-section" style="display: none;">
                    <div class="filter-section mb-4 d-flex justify-content-start flex-nowrap">
                        <button class="btn btn-outline-primary filter-btnn me-2 active" data-category="all">Tất
                            cả</button>
                        <button class="btn btn-outline-primary filter-btnn me-2"
                            data-category="combo">Combo({{ $combo->count() }})</button>
                        @foreach ($cate as $cate)
                            <button class="btn btn-outline-primary filter-btnn me-2"
                                data-category="{{ $cate->id }}">{{ $cate->name }}({{ $cate->dishes->count() }})</button>
                        @endforeach
                    </div>

                    <!-- Phần Danh sách Món ăn -->
                    <div class="row" id="dish-list" style="max-height: 600px; overflow-y: auto;">
                        @foreach ($dishes as $dish)
                            <div class="col-md-3 dish-item" data-category="{{ $dish->category->id }}"
                                data-dish-id="{{ $dish->id }}" data-dish-price="{{ $dish->price }}">
                                <div class="card menu-item">
                                    <img class="btn btn-add-dish" data-dish-id="{{ $dish->id }}"
                                        src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
                                        alt="{{ $dish->name }}" class="img-fluid rounded"
                                        style="height: 200px; object-fit: cover;" />
                                    <div class="card-body text-center">
                                        <h5 class="card-price text-primary">{{ number_format($dish->price, 0, ',', '.') }}
                                            VND</h5>
                                        <p class="card-title">{{ \Str::limit($dish->name, 20, '...') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($combo as $combo)
                            <div class="col-md-3 dish-combo" data-category="combo" data-combo-id="{{ $combo->id }}"
                                data-combo-price="{{ $combo->price }}">
                                <div class="card menu-item">
                                    <img class="btn btn-add-combo" data-combo-id="{{ $combo->id }}"
                                        src="{{ asset($combo->image ? 'storage/' . $combo->image : 'images/placeholder.jpg') }}"
                                        alt="{{ $combo->name }}" class="img-fluid rounded"
                                        style="height: 200px; object-fit: cover;" />
                                    <div class="card-body text-center">
                                        <h5 class="card-price text-primary">
                                            {{ number_format($combo->price, 0, ',', '.') }}
                                            VND</h5>
                                        <p class="card-title">{{ \Str::limit($combo->name, 20, '...') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Phần bên phải: Đơn hàng -->
            <div class="col-md-4 p-0 order-section">
                <nav class="navbar">
                </nav>
                <div class="order-content-container" style="padding-left: 20px;">
                    <div id="order-details" class="order-content-container">
                        <div class="empty-order">
                            <p>Chưa chọn bàn</p>
                            <p>Vui lòng chọn bàn tại phía bên trái màn hình</p>
                        </div>
                    </div>
                </div>
                <div class="total mt-4">Tổng tiền: <span id="totalAmount">0</span></div>
                <div class="btn-group">
                    <button class="btn btn-outline-primary border border-primary" disabled id="notification-button"
                        aria-label="Thông báo">
                        <i class="fas fa-bell"></i> Thông báo
                    </button>
                    <button class="btn btn-primary" id="payment-button" aria-label="Thanh toán" disabled>
                        <i class="fas fa-dollar-sign"></i> Thanh toán
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    $(document).ready(function() {
    // Gửi yêu cầu AJAX khi cần lấy danh sách đặt bàn
    $.ajax({
        url: '{{ route('get.reservations') }}',  // Đường dẫn đến route 'get.reservations'
        method: 'GET',  // Phương thức gửi yêu cầu GET
        success: function(response) {
            // Xử lý dữ liệu trả về từ server (danh sách đặt bàn)
            if (response && response.length > 0) {
                // Tạo các dòng cho bảng danh sách đặt bàn
                var tableRows = '';
                response.forEach(function(reservation) {
                    var tableNumbers = reservation.orders.map(order => {
                        return order.tables.map(table => table.table_number).join(', ');
                    }).join('<br>');
                    
                    tableRows += `
                        <tr>
                            <td class="text-center">${reservation.id}</td>
                            <td class="text-center">${tableNumbers || 'Không có bàn nào được xếp'}</td>
                            <td class="text-center">${reservation.reservation_date} ${reservation.reservation_time}</td>
                            <td class="text-center">${reservation.user_name || 'Không rõ'}</td>
                            <td class="text-center">${reservation.user_phone || 'Không rõ'}</td>
                            <td class="text-center">${reservation.guest_count || 'N/A'}</td>
                        </tr>
                    `;
                });

                // Đổ dữ liệu vào phần tử bảng (tbody) với ID 'reservationDetailsBody'
                $('#reservationDetailsBody').html(tableRows);
                $('#reservationListModal').modal('show');  // Hiển thị modal sau khi dữ liệu đã được load
            } 
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có sự cố khi gửi yêu cầu
            console.error('Có lỗi xảy ra: ', error);
            // alert('Không thể tải danh sách đặt bàn.');
        }
    });
});

</script>
<script>
    let selectedTableId = null;
    document.addEventListener('DOMContentLoaded', function() {
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
            const combo = event.target.closest('.dish-combo');

            if (card) {
                const dishId = card.dataset.dishId;
                addDishToOrder(dishId, selectedTableId);
            }
            if (combo) {
                const comboId = combo.dataset.comboId;
                addComboToOrder(comboId, selectedTableId);
            }
        });
        document.querySelector('#notification-button').addEventListener('click', function(event) {
            notificationButton(selectedTableId);
        });
        document.querySelector('#payment-button').addEventListener('click', function(event) {
            const orderDetails = document.getElementById('order-details');
            if (selectedTableId != null) {
                fetch('/check-payment-condition', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            table_id: selectedTableId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const url = `/viewCheckOut/${selectedTableId}`;
                            window.location.href = url;
                        } else {
                            Swal.fire({
                                title: 'Các món sẽ bị hủy do chưa hoàn thành!',
                                html: data.message,
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Tiếp tục',
                                cancelButtonText: 'Hủy',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const url = `/Ppayment/${selectedTableId}`;
                                    fetch(url, {
                                            method: 'GET',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector(
                                                        'meta[name="csrf-token"]')
                                                    .getAttribute('content'),
                                                'Content-Type': 'application/json',
                                            },
                                        })
                                        .then((response) => {
                                            if (!response.ok) {
                                                throw new Error(
                                                    `HTTP error! Status: ${response.status}`
                                                );
                                            }
                                            return response.json();
                                        })
                                        .then((json) => {
                                            if (json.redirect_url && json.redirect_url
                                                .includes('checkoutt')) {
                                                return fetch(json.redirect_url, {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': document
                                                            .querySelector(
                                                                'meta[name="csrf-token"]'
                                                            )
                                                            .getAttribute(
                                                                'content'),
                                                        'Content-Type': 'application/json',
                                                    },
                                                });
                                            } else {
                                                const url =
                                                    `/viewCheckOut/${selectedTableId}`;
                                                window.location.href = url;
                                            }
                                        })
                                        .then((response) => {
                                            if (!response.ok) {
                                                throw new Error(
                                                    `HTTP error! Status: ${response.status}`
                                                );
                                            }
                                            return response.json();
                                        })
                                        .then((finalJson) => {
                                            if (finalJson.success) {
                                                Swal.fire({
                                                    title: 'Thành công!',
                                                    text: finalJson.message,
                                                    icon: 'success',
                                                })
                                            } else {
                                                Swal.fire({
                                                    title: 'Lỗi!',
                                                    text: finalJson.message,
                                                    icon: 'error',
                                                });
                                            }
                                        })
                                }
                            });

                        }
                    })
                    .catch(error => console.error('Error:', error));

            } else {
                showNotification('Vui lòng chọn bàn trước khi thanh toán', 'warning')
            }
        });

        function notificationButton(selectedTableId) {
            fetch('/notification-button/' + selectedTableId, {
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
                }).then(data => {
                    if (data.success) {} else {
                        showNotification('Thông báo bếp thành công')
                    }
                })
        }

        function createOrder(tableId) {

            fetch('/checkAvailableTables', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch available tables');
                    return response.json();
                })
                .then(data => {
                    const availableTables = data.tables || [];
                    Swal.fire({
                        title: 'Nhận gọi món',
                        html: `
          <div class="container">
            <div class="mb-3">
              <label for="tableRoom" class="form-label">Phòng/Bàn</label><br>
              <select id="tableRoom" class="form-select" multiple>
${availableTables.map(table => `
  <option value="${table.id}" ${table.id == tableId ? 'selected' : ''}>
    Bàn ${table.table_number}
  </option>
`).join('')}
                </select>
            </div>
          </div>
        `,
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        didOpen: () => {
                            const $tableRoom = $('#tableRoom');
                            $tableRoom.select2({
                                allowClear: true,
                                dropdownParent: $('.swal2-container')
                            });
                        },
                        preConfirm: () => {
                            const tableRoom = $('#tableRoom').val();
                            if (!tableRoom.length) {
                                Swal.showValidationMessage('Vui lòng nhập đầy đủ thông tin');
                                return false;
                            }

                            return {
                                tableRoom,
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showNotification('Tạo đơn thành công');
                            fetch('/create-order', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]')
                                            .getAttribute('content'),
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        table_id: result.value.tableRoom,
                                    })
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error(
                                        'Network response was not ok');
                                    return response.json();
                                })
                                .then(data => showOrderDetails(tableId))
                                .catch(() => showNotification('Lỗi khi tạo đơn', 'error'));
                        } else if (result.isDenied) {
                            showNotification('Tạo đơn thất bại', 'error');
                        }
                    });
                })
        }
        const orderDetails = document.getElementById('order-details');
        orderDetails.addEventListener("click", function(event) {
            const dishElement = event.target.closest(".item-list");
            if (dishElement) {
                const dishId = dishElement.dataset.dishId;
                const dishStatus = dishElement.dataset.dishStatus;
                const dishType = dishElement.dataset.dishType;
                const dishOrder = dishElement.dataset.dishOrder;
                if (event.target.classList.contains("plus-item")) {
                    if (dishType == 1) {
                        increaseQuantity(dishId, selectedTableId);
                    } else {
                        increaseQuantityy(dishId, selectedTableId, dishType);
                    }
                }
                if (event.target.classList.contains("minus-item")) {
                    if (dishStatus == 'chờ xử lý') {
                        if (dishType == 1) {
                            decreaseQuantity(dishId, selectedTableId);
                        } else {
                            decreaseQuantityy(dishId, selectedTableId, dishType);
                        }
                    } else {
                        const dishInformed = dishElement.dataset.dishInformed;
                        const dishProcessing = dishElement.dataset.dishProcessing;
                        const dishQuantity = dishElement.dataset.dishQuantity;
                        if (dishInformed > dishProcessing || dishQuantity > dishProcessing) {
                            if (dishType == 1) {
                                decreaseQuantity(dishId, selectedTableId);
                            } else {
                                decreaseQuantityy(dishId, selectedTableId, dishType);
                            }
                        } else {
                            if (dishType == 1) {
                                canelItem(dishId, selectedTableId, dishOrder)
                            } else {
                                canelItemm(dishId, selectedTableId, dishOrder, dishType)
                            }
                        }
                    }
                }
                if (event.target.classList.contains("delete-item")) {
                    if (dishType == 1) {
                        deleteItem(dishId, selectedTableId);
                    } else {
                        deleteItemm(dishId, selectedTableId, dishType);
                    }
                }
                if (event.target.classList.contains("delette-item")) {
                    if (dishType == 1) {
                        deletteItem(dishId, selectedTableId);
                    } else {
                        deletteItemm(dishId, selectedTableId, dishType);
                    }
                }
            }
        });

        function canelItem(dishId, selectedTableId, dishOrder) {
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
                    fetch(`/canelItem`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                table_id: selectedTableId,
                                dish_id: dishId,
                                reason: reason,
                                dishOrder: dishOrder
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

        function canelItemm(dishId, selectedTableId, dishOrder, dishType) {
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
                    fetch(`/canelItemm`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                table_id: selectedTableId,
                                dish_id: dishId,
                                reason: reason,
                                dishOrder: dishOrder,
                                dishType: dishType
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
                        showNotification('Món đã hết nguyên liệu', 'error')
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function increaseQuantityy(dishId, selectedTableId, dishType) {
            fetch(`/increaseQuantityy`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        table_id: selectedTableId,
                        dish_id: dishId,
                        dishType: dishType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {} else {
                        // console.log(data);

                        showNotification('Món đã hết nguyên liệu', 'error')
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
                        showNotification('Món đã hết nguyên liệu', 'error')
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function decreaseQuantityy(dishId, selectedTableId, dishType) {
            fetch(`/decreaseQuantityy`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        table_id: selectedTableId,
                        dish_id: dishId,
                        dishType: dishType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {} else {
                        showNotification('Món đã hết nguyên liệu', 'error')
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
                cancelButtonText: 'Hủy',
                preConfirm: () => {
                    const reason = Swal.getInput().value.trim();
                    if (!reason) {
                        Swal.showValidationMessage(
                            'Vui lòng nhập lý do hủy');
                        return false;
                    }
                    return reason;
                }
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

        function deleteItemm(dishId, selectedTableId, dishType) {
            Swal.fire({
                title: 'Nhập lý do hủy',
                input: 'text',
                inputPlaceholder: 'Nhập lý do...',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy',
                preConfirm: () => {
                    const reason = Swal.getInput().value.trim();
                    if (!reason) {
                        Swal.showValidationMessage(
                            'Vui lòng nhập lý do hủy');
                        return false;
                    }
                    return reason;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = result.value;
                    fetch(`/deleteItemm`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                table_id: selectedTableId,
                                dish_id: dishId,
                                reason: reason,
                                dishType: dishType
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


        function deletteItem(dishId, selectedTableId) {
            fetch(`/deleteItem`, {
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
                        showNotification('Hủy món thành công!', 'success');
                    } else {
                        showNotification('Lỗi khi xóa', 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function deletteItemm(dishId, selectedTableId, dishType) {
            fetch(`/deleteItemm`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        table_id: selectedTableId,
                        dish_id: dishId,
                        dishType: dishType
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
                            showNotification('Món đã hết nguyên liệu', 'error')
                        }
                    })
                    .catch(error => console.log('Error:', error));
            } else {
                showNotification('Hãy chọn bàn trước khi thêm món', 'error')
            }
        }

        function addComboToOrder(comboId, selectedTableId) {
            if (selectedTableId) {
                fetch(`/add-combo-to-order`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            table_id: selectedTableId,
                            combo_id: comboId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Thêm món thành công')
                        } else {
                            // console.log(data);

                            showNotification('Món đã hết nguyên liệu', 'error')
                        }
                    })
                    .catch(error => console.log('Error:', error));
            } else {
                showNotification('Hãy chọn bàn trước khi thêm món', 'error')
            }
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
                    // console.log(data);
                    
                    highlightTables(data);
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }

        function highlightTables(data) {
            const tableCards = document.querySelectorAll('.table-card');
            const selectedTableIds = data.table.tables.map(table => String(table.table_number));
            tableCards.forEach(card => {
                const isSelected = selectedTableIds.includes(card.getAttribute('data-table-id'));

                if (isSelected) {
                    card.style.backgroundColor = '#007bff';
                    card.style.color = '#ffffff';
                    const childElements = card.querySelectorAll('*');
                    childElements.forEach(child => {
                        child.style.color = '#ffffff';
                    });
                } else {
                    if (card.getAttribute('data-status') == 'Occupied') {
                        card.style.backgroundColor = '#f8c1a5';
                        card.style.color = '#333';
                        const childElements = card.querySelectorAll('*');
                        childElements.forEach(child => {
                            child.style.color = '#535f6b';
                        });
                    } else {
                        card.style.backgroundColor = '';
                        card.style.color = '';
                        const childElements = card.querySelectorAll('*');
                        childElements.forEach(child => {
                            child.style.color = '';
                        });
                    }
                }
            }); 
        }

        document.addEventListener('click', function(event) {
    // Kiểm tra nếu phần tử được click là nút với class "reToOrder"
    if (event.target && event.target.matches('.reToOrder')) {
        event.preventDefault();  // Ngừng hành động mặc định của button (nếu có)
        
        var reservationId = event.target.getAttribute('data-reser-id');  // Lấy id từ data attribute
        // Gửi yêu cầu POST bằng jQuery Ajax
        $.ajax({
            url: '/checkReservationHasTable',  // Địa chỉ URL đến controller trong Laravel
                    type: 'GET',  
                    data: { 
                        reservation_id:reservationId  // Dữ liệu gửi đi (reservation_id)
                    },
        success: function(data) {
            if(data.success){
                // Chuyển đơn
               reToOrder(reservationId);
                
            }else{
                // console.log(reservationId);
                showTableSelectionModal(reservationId);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error); // In lỗi nếu có
            // alert("Đã có lỗi xảy ra, vui lòng thử lại.");
        }
});
  
    }
});

    function showTableSelectionModal(reservationId){
        // console.log(typeof(parseInt(reservationId, 10)));
         $.ajax({
                    url: '/getAvailableTables',  // Địa chỉ URL đến controller trong Laravel
                    type: 'GET',  // Phương thức HTTP (GET hoặc POST)
                    data: { 
                        reservation_id:parseInt(reservationId, 10) // Dữ liệu gửi đi (reservation_id)
                    },
                    success: function(data) {
                    //    console.log(data);
        const availableTables =Array.isArray(data.tables) ? data.tables : [];
        // console.log(availableTables.length); 
                    Swal.fire({
                        title: 'Nhận gọi món',
                        html: `
                            <div class="container">
                                <div class="mb-3">
                                    <label for="tableRoom" class="form-label">Phòng/Bàn</label><br>
                                    <select id="tableRoom" class="form-select" multiple>
                                        ${availableTables.map(table => `
                                            <option value="${table.id}">
                                                Bàn ${table.table_number}
                                            </option>
                                        `).join('')}
                                    </select>
                                      <input type="hidden" name="reservationId" id="reservationId" value="${data.reservation_id}">
                                </div>  
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        didOpen: () => {
                            const $reservation_id=$('#reservationId');
                            const $tableRoom = $('#tableRoom');
                            $tableRoom.select2({
                                allowClear: true,
                                dropdownParent: $('.swal2-container')
                            });
                        },
                        preConfirm: () => {

                            const tableRoom = $('#tableRoom').val();
                            if (!tableRoom.length) {
                                Swal.showValidationMessage('Vui lòng nhập đầy đủ thông tin');
                                return false;
                            }

                            return {
                                tableRoom,
                            };
                        }
                    }).then((result) => {
            if (result.isConfirmed) {
                // showNotification('Tạo đơn thành công');
                    // alert(reservationId);
                // console.log(result.value.tableRoom);
                $.ajax({
            url: '/admin/reser-tables/update',
            method: 'POST',
            data: {
                reservation_id: reservationId,
                tables: result.value.tableRoom,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    // console.log(typeof(response.reservation_id));
                    reToOrder(response.reservation_id);
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon:response.type,
                        toast: true,
                        title: response.message,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2500
                    })
                }
            },
            error: function () {
                // alert("Có lỗi xảy ra khi gửi dữ liệu lên server.");
            }
        });     
            } else if (result.isDenied) {
                showNotification('Tạo đơn thất bại', 'error');  // Thông báo nếu người dùng từ chối
            }
        });
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi khi có sự cố với yêu cầu AJAX
                        // console.error('Có lỗi xảy ra:', error);
                        // alert('Đã xảy ra lỗi khi lấy dữ liệu!');
                    }
                });
    }
    function reToOrder(reservationId){
        //  Gửi yêu cầu POST đến server
       fetch("/retoOrder/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({ reservation_id: parseInt(reservationId, 10) }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if(data.success){
                    // Xử lý logic khi server trả kết quả
                    selectedTableId = data.tableId;
                    showOrderDetails(data.tableId);
                    
                    // Đóng modal sau khi nhận bàn thành công
                    $('#reservationListModal').modal('hide');

                    $('.modal-backdrop').remove();
                    // Hiển thị thông báo thành công
                    showNotification('Nhận bàn thành công');
                    } else {
                    // Xử lý logic khi server trả kết quả thất bại
                    showNotification(data.message,data.type);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
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
        $(document).ready(function () {
    function fetchReservations() {
        // Lấy dữ liệu từ các trường tìm kiếm
        const search = $('#search').val().trim();
        const roomTable = $('#roomTable').val();
        const fromDate = $('#fromDate').val();
        const toDate = $('#toDate').val();

        // Gửi yêu cầu AJAX
        $.ajax({
            url: '/reservations/filter',
            type: 'POST',
            data: {
                search: search,
                roomTable: roomTable,
                fromDate: fromDate,
                toDate: toDate,
                _token: $('meta[name="csrf-token"]').attr('content') // Thêm CSRF token
            },
            success: function (data) {
                const reservationDetailsBody = $('#reservationDetailsBody');
                reservationDetailsBody.empty(); // Làm rỗng bảng trước khi thêm dữ liệu mới

                // Kiểm tra xem dữ liệu có hợp lệ không
if (data.success) {
    console.log(data.reservations); // Kiểm tra dữ liệu trả về
    
    // Thêm từng hàng dữ liệu vào bảng
    data.reservations.forEach(function (reservations) {
        var tableNumbers = reservations.orders.map(order => {
                        return order.tables.map(table => table.table_number).join(', ');
                    }).join('<br>');
        // console.log(reservations);
        reservationDetailsBody.append(`
            <tr>
                <td class="text-center" >${reservations.id || 'N/A'}</td>
                <td class="text-center" >${tableNumbers || 'Không có bàn nào được xếp'}</td>
                <td class="text-center" >${reservations.reservation_date || 'N/A'}/${reservations.reservation_time || 'N/A'}</td>
                <td class="text-center" >${reservations.user_name || 'N/A'}</td>
                <td class="text-center" >${reservations.user_phone || 'N/A'}</td>
                <td class="text-center" >${reservations.guest_count || 'N/A'}</td>
               <td class="text-center">
               <button class="reToOrder btn-link " data-reser-id="${reservations.id}">Khách nhận bàn</button>

                </td>
            </tr>
        `);
    });
} else {
    reservationDetailsBody.append('<tr><td colspan="7" class="text-center">Không tìm thấy kết quả</td></tr>');
}
            },
            error: function (xhr, status, error) {
                console.error('Lỗi:', error);
                // alert('Đã xảy ra lỗi khi lấy danh sách đặt bàn.');
            }
        });
    }

    // Lắng nghe các sự kiện thay đổi trên trường tìm kiếm
    $('#search').on('input', fetchReservations);
    $('#roomTable').on('change', fetchReservations);
    $('#fromDate').on('change', fetchReservations);
    $('#toDate').on('change', fetchReservations);
});

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
        min-height: 100vh;

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

    .table-o {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notificationButton = document.getElementById('notificationButton');
        const printButton = document.getElementById('printButton');

        // Notification Badge Animation
        notificationButton.addEventListener('click', function() {
            // alert("Bạn có 3 thông báo mới!");
        });

        // Print Button
        printButton.addEventListener('click', function() {
            // alert("Đang in...");
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
    // document.getElementById('modalListReservation').addEventListener('click', function() {
    //     $('#reservationListModal').modal('show');
    // });
</script>
