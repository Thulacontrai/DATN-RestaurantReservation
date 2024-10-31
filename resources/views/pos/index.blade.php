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
                        <input class="form-control1 me-2" id="searchInput" type="search" placeholder="Tìm khách (F4)"
                            aria-label="Tìm khách hàng">
                    </div>
                    <button class="btn btn-success ms-2" id="openReservationModal">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </nav>

                <div class="d-flex justify-content-center mt-5">


                    <div class="scene">
                        <div class="cube">
                            <span class="side top">
                                <i class="fas fa-chair"></i> <!-- Icon cho Bàn -->
                                {{ $order->table->table_number }}
                            </span>
                            <span class="side front">
                                <i class="fas fa-receipt"></i> <!-- Icon cho Đơn -->
                                {{ $order->id }}
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Nội dung Đơn hàng -->
                <div id="order-details" class="order-content-container" style="padding-left: 20px;">
                    @if (isset($order) && $order->items->count() > 0)
                        <h5>Thông tin đơn hàng cho Bàn {{ $order->table->number }}</h5> <!-- Thêm thông tin bàn -->
                        @foreach ($order->items as $item)
                            <div class="order-item d-flex justify-content-between align-items-center">
                                <span>{{ $item->name }} x {{ $item->quantity }}</span>
                                <span style="color: #28a745;">{{ number_format($item->total_price, 0, ',', '.') }}
                                    VND</span>
                                <button class="bin-button" data-item-id="{{ $item->id }}"
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
                        <div class="empty-order">
                            <svg fill="none" height="40" viewBox="0 0 40 40" width="40"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z"
                                    fill="#0066CC"></path>
                            </svg>
                            <p>Chưa có món trong đơn</p>
                            <p>Vui lòng chọn món trong thực đơn bên trái màn hình</p>
                        </div>
                    @endif
                </div>


                <!-- Tổng tiền -->
                <div class="total mt-4">Tổng tiền: <span
                        id="totalAmount">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}</span>₫</div>


                <div class="btn-group">
                    <button class="btn btn-secondary" id="notification-button" aria-label="Thông báo">
                        <i class="fas fa-bell"></i> Thông báo (F10)
                    </button>
                    <button class="btn btn-primary" id="payment-button" aria-label="Thanh toán">
                        <i class="fas fa-dollar-sign"></i> Thanh toán (F9)
                    </button>
                    <div>
                        <p id="table-number"></p> <!-- Thay đổi số bàn phù hợp -->
                        <div id="order-details">
                            <!-- Các món ăn sẽ được thêm vào đây -->
                        </div>
                        <div id="totalAmount"></div> <!-- Tổng tiền sẽ được cập nhật -->
                    </div>

                    <button class="btn btn-info" id="print-button" aria-label="In Hóa đơn"
                        onclick="printTemporaryInvoice()">
                        <i class="fas fa-print"></i> In hóa đơn tạm
                    </button>


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
    // Modal danh sách đặt bàn
    document.getElementById('modalListReservation').addEventListener('click', function() {
        $('#reservationListModal').modal('show');
    });
</script>
