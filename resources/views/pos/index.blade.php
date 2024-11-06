@extends('pos.layouts.master')

@section('title', 'POS | Trang chủ')

@section('content')

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
                                    <td class="text-center" ><button type="button" class="transparent-button" data-toggle="modal" data-target="#orderDetailModal">{{$reservation->id}}</button></td>
                                    <td class="text-center">
                                        @foreach ($reservation->tables as $table)
                                            {{ $table->table_number ?? 'Chưa xếp bàn' }}
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $reservation->reservation_date }} <br> {{ $reservation->reservation_time }}</td>
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
                                            <button class="btn btn-primary convertToOrder" data-id="{{ $reservation->id }}">
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
                        <button class="btn btn-outline-warning filter-btn me-2" data-status="reserved">
                            Đã đặt ({{ $reservedTablesCount }})
                        </button>
                        <button class="btn btn-outline-danger filter-btn" data-status="occupied">
                            Đang sử dụng ({{ $occupiedTablesCount }})
                        </button>
                    </div>

                    <div class="table-container d-flex flex-wrap justify-content-start"
                        style="max-height: 600px; overflow-y: auto;">
                        @foreach ($tables as $table)
                            <div class="table-card {{ strtolower(trim($table->status)) }}"
                                data-table-id="{{ $table->id }}">
                                <span class="table-number">Bàn {{ $table->table_number }}</span>
                                @if (strtolower(trim($table->status)) == 'available')
                                    <i class="material-icons text-success"
                                        style="font-size: 35px;padding-top: 50%;">event_seat</i>
                                    <!-- Thay icon ghế bằng biểu tượng bàn -->
                                @elseif (strtolower(trim($table->status)) == 'reserved')
                                    <i class="material-icons text-warning"
                                        style="font-size: 35px; padding-top: 50%;">bookmark</i>
                                @elseif (strtolower(trim($table->status)) == 'occupied')
                                    <i class="material-icons text-danger"
                                        style="font-size: 35px; padding-top: 50%;">local_dining</i>
                                    <!-- Biểu tượng dĩa và ly -->
                                @else
                                    <i class="material-icons text-danger" style="font-size: 35px;">error</i>
                                    <span>Lỗi: Trạng thái không xác định!</span>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Phần hiển thị Thực đơn -->
                <div class="menu-section transition-section" id="menu-section" style="display: none;">
                    <div class="filter-section mb-4 d-flex justify-content-start flex-nowrap">
                        <button class="btn btn-outline-primary filter-btn me-2 active" data-category="all">Tất cả</button>
                        <button class="btn btn-outline-success filter-btn me-2" data-category="mon-an">Món Ăn</button>
                        <button class="btn btn-outline-warning filter-btn me-2" data-category="do-uong">Đồ Uống</button>
                        <button class="btn btn-outline-danger filter-btn" data-category="trang-mieng">Tráng Miệng</button>
                        <button class="btn btn-outline-info filter-btn" data-category="combo">Combo</button>
                    </div>

                    <!-- Phần Danh sách Món ăn -->
                    <div class="row" id="dish-list" style="max-height: 600px; overflow-y: auto;">
                        @foreach ($dishes as $dish)
                            <div class="col-md-3 dish-item"
                                data-category="{{ strtolower(str_replace(' ', '-', $dish->category)) }}"
                                data-dish-id="{{ $dish->id }}" data-dish-price="{{ $dish->price }}">
                                <div class="card menu-item">
                                    <img class="btn btn-add-dish" data-dish-id="{{ $dish->id }}"
                                        data-dish-price="{{ $dish->price }}" data-dish-name="{{ $dish->name }}"
                                        onclick="addDishToOrder({{ $dish->id }}, '{{ $dish->name }}', {{ $dish->price }})"
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
                    </div>
                </div>
            </div>


            <!-- Phần bên phải: Đơn hàng -->
            <div class="col-md-4 p-0 order-section">
                <nav class="navbar">
                    <div class="col-md-5 d-flex align-items-center">
                        <div class="btn-group flex-wrap">
                            <button class="btn btn-warning" id="addCustomerButton" title="Thêm khách hàng">
                                <i class="fas fa-user-plus"></i>
                            </button>

                        </div>
                        <div class="tabs" id="orderTabs"></div>
                        <input clafss="form-control1 me-2" id="searchInput" type="search" placeholder="Tìm khách (F4)"
                            aria-label="Tìm khách hàng">
                    </div>
                    <button class="btn btn-success ms-2" id="openReservationModal">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </nav>
                <div id="order-details" class="order-content-container" style="padding-left: 20px;">
                    @if (isset($order) && $order->items->count() > 0)
                        <h5>Thông tin đơn hàng cho Bàn {{ $order->table->number }}</h5> <!-- Thêm thông tin bàn -->
                        @foreach ($order->items as $item)
                            <div class="order-item d-flex justify-content-between align-items-center">
                                <span>{{ $item->name }} x {{ $item->quantity }}</span>
                                <span style="color: #28a745;">{{ number_format($item->total_price, 0, ',', '.') }}
                                    VND</span>
                                <button class="bin-button " data-item-id="{{ $item->id }}"
                                    data-order-id="{{ $order->id }}">
                                    <!-- SVG của nút xóa -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 39 7"
                                        class="bin-top">
                                        <line stroke-width="4" stroke="white" y2="5" x2="39"
                                            y1="5"></line>
                                        <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357"
                                            y1="1.5" x1="12"></line>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 39"
                                        class="bin-bottom">
                                        <mask fill="white" id="path-1-inside-1_8_19">
                                            <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                            </path>
                                        </mask>
                                        <path mask="url(#path-1-inside-1_8_19)" fill="white"
                                            d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z">
                                        </path>
                                        <path stroke-width="4" stroke="white" d="M12 6L12 29"></path>
                                        <path stroke-width="4" stroke="white" d="M21 6V29"></path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 89 80"
                                        class="garbage">
                                        <path fill="white"
                                            d="M20.5 10.5L37.5 15.5L42.5 11.5L51.5 12.5L68.75 0L72 11.5L79.5 12.5H88.5L87 22L68.75 31.5L75.5066 25L86 26L87 35.5L77.5 48L70.5 49.5L80 50L77.5 71.5L63.5 58.5L53.5 68.5L65.5 70.5L45.5 73L35.5 79.5L28 67L16 63L12 51.5L0 48L16 25L22.5 17L20.5 10.5Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <!-- Hiển thị khi không có món trong đơn hàng -->
                        <div id="order-details" class="order-content-container">
                            <div class="empty-order">
                                </svg>
                                <p>Chưa có món trong đơn</p>
                                <p>Vui lòng chọn món trong thực đơn bên trái màn hình</p>
                            </div>

                            <div class="order-items" style="display: none;">
                                <!-- Đây sẽ là nơi hiển thị các món đã chọn -->
                            </div>
                        </div>
                    @endif
                </div>

                <div class="total mt-4">Tổng tiền: <span
                        id="totalAmount">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}</span>₫</div>


                <div class="btn-group">
                    <button class="btn btn-secondary" id="notification-button" aria-label="Thông báo">
                        <i class="fas fa-bell"></i> Thông báo
                    </button>
                    <button class="btn btn-primary" id="payment-button" aria-label="Thanh toán">
                        <i class="fas fa-dollar-sign"></i> Thanh toán
                    </button>
                    <div>
                        <p id="table-number"></p> <!-- Thay đổi số bàn phù hợp -->
                        <div id="order-details">
                            <!-- Các món ăn sẽ được thêm vào đây -->
                        </div>
                        <div id="totalAmount"></div> <!-- Tổng tiền sẽ được cập nhật -->
                    </div>
                    <button class="btn btn-warning" id="note-button" aria-label="Thêm Ghi chú">
                        <i class="fas fa-edit"></i> Ghi chú
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/pos.js') }}" defer></script>
@endsection

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

