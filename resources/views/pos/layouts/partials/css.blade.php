<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}') }}">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">

<!-- Line Awesome -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">

<!-- Remixicon -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/remixicon/fonts/remixicon.css') }}">

<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}">


<!-- Dripicons -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/@icon/dripicons/dripicons.css') }}">

<!-- FullCalendar -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/core/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/list/main.css') }}">

<!-- Mapbox -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/mapbox/mapbox-gl.css') }}">



<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('poss/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/remixicon/fonts/remixicon.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/%40icon/dripicons/dripicons.css') }}">

<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/core/main.css') }}">
<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.css') }}">
<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.css') }}">
<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/list/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/mapbox/mapbox-gl.css') }}">
<<<<<<< HEAD
<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}">



=======
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6

<style>
    /* Active Tab Styling */
    .nav-link.active {
        color: #004a89;
        font-weight: bold;
        padding: 12px 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, color 0.3s ease;
        z-index: 2;
    }

    /* Inactive Tab Styling */
    .nav-link:not(.active) {
<<<<<<< HEAD
        margin-left: 10px;
=======
        margin-left:  10px;
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
        transition: all 0.3s ease;
        z-index: 0;
    }

    /* Hover effect for tabs */
    .nav-link:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: all 0.3s ease-in-out;
    }

    /* Icon hover effect */
    .nav-link i {
        margin-right: 8px;
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .nav-link:hover i {
        transform: scale(1.1);
    }

    /* Search Bar Styling */
    .form-control {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #fff;
        color: #fff;
        width: 250px;
        margin-left: 40px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-bottom: 1px solid #f1f1f1;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }

    /* Wrapper styling */
    .wrapper {
        min-height: calc(100vh - 50px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Container flex layout */
    .container-fluid {
        display: flex;
        justify-content: space-between;
<<<<<<< HEAD
=======
        gap: 15px;
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
        flex-grow: 1;
        padding: 0 10px;
    }

    /* Table and Order sections */
    .table-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
<<<<<<< HEAD
        /* padding: 20px; */
=======
        padding: 20px;
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
    }

    .order-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: #ffffff;
        padding: 20px;
        margin-top: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

<<<<<<< HEAD

    #orderTabs {
        overflow-x: auto;
        display: flex;
        flex-wrap: nowrap;
    }

    #orderContent {
        flex-grow: 1;
        overflow-y: auto;
        max-height: calc(100vh - 200px);
    }

    .total {
        padding: 10px;
        text-align: right;
        border-top: 1px solid #ddd;
    }

    .empty-order {
        text-align: center;
        margin-top: 50px;
        color: #777;
    }

    .empty-order p {
        font-size: 16px;
        margin: 5px 0;
    }

=======
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
    /* Search and icon button styles */
    .search-container {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 50px;
        padding: 5px 15px;
        background-color: #f7f7f7;
        max-width: 300px;
    }

    .icon-buttons {
        display: flex;
        gap: 15px;
    }

    .icon-buttons .btn-icon {
        background: none;
        border: none;
        color: #007bff;
        padding: 5px;
        font-size: 22px;
        border-radius: 50%;
        min-width: 40px;
        min-height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.2s ease;
    }

    .icon-buttons .btn-icon:hover {
        background-color: #f0f0f0;
    }

    /* Table grid layout */
    .table-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-gap: 20px;
        margin-top: 20px;
    }

    .table-box {
        background-color: white;
        width: 135px;
        height: 135px;
        display: flex;
        justify-content: center;
        text-align: center;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        border: 1px solid #ccc;
        transition: transform 0.2s, box-shadow 0.2s;
        padding: 10px;
    }

    .table-box:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .table-name {
        font-weight: bold;
        font-size: 16px;
    }

    .table-details {
        font-size: 14px;
        margin-top: 5px;
        color: #888;
    }

    .table-details i {
        margin-right: 5px;
    }

    /* Table location button */
    .table-location .btn {
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        border-radius: 50px;
        color: #007bff;
        padding: 10px 20px;
        font-size: 14px;
    }

    .table-location .btn i {
        margin-right: 8px;
    }


<<<<<<< HEAD
    /* --------------------css Ben phía INDEX---------------------- */
    .table-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .table-box {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: calc(20% - 20px);
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
    }

    .table-name {
        font-size: 18px;
        font-weight: bold;
    }

    .table-details {
        margin: 10px 0;
    }

    .table-status {
        font-size: 14px;
        color: gray;
    }

    .table-price {
        font-size: 16px;
        color: #28a745;
        font-weight: bold;
    }

    .filter-section {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-btn {
        padding: 10px 20px;
        border-radius: 50px;
        border: none;
        font-size: 14px;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
    }

    .filter-btn.active {
        background-color: #007bff;
        color: white;
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
    }

    .filter-btn:hover {
        background-color: #0056b3;
        color: white;
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
    }

    .order-item {
        margin-bottom: 10px;
    }

    .order-item span:nth-child(2) {
        color: #28a745;
        font-weight: bold;
    }

    .quantity-input {
        margin-left: 10px;
    }

    #notification {
        display: none;
        position: fixed;
        bottom: 10px;
        right: 10px;
        z-index: 9999;
        background-color: #28a745;
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    #notification strong {
        margin-right: 10px;
    }























    /* CSS giữ nguyên như hiện tại */
    .table-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-gap: 10px;
        justify-content: center;

    }

    .table-box {
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        background-color: white;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;

        overflow: hidden;
        cursor: pointer;
        width: 100%;
        max-width: 200px;
    }

    .table-box:hover {
        transform: translateY(-10px);
        box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.2);
    }

    /* Hình ảnh bàn */
    .table-image img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 15px;
    }

    /* Tên bàn */
    .table-name {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    /* Chi tiết bàn */
    .table-details {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 10px;
        color: #666;
    }

    /* Trạng thái bàn */
    .table-box.available {
        background: linear-gradient(135deg, #a8e063, #56ab2f);
        border: none;
        color: white;
    }

    .table-box.occupied {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        border: none;
        color: white;
    }

    .table-box.reserved {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        border: none;
        color: white;
    }

    /* Biểu tượng trạng thái */
    .table-box .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 5px 15px;
        font-size: 14px;
        font-weight: 600;
        color: #555;
        border-radius: 30px;
    }

    .table-box.available .status-badge {
        background-color: rgba(255, 255, 255, 0.9);
        color: #28a745;
    }

    .table-box.occupied .status-badge {
        background-color: rgba(255, 255, 255, 0.9);
        color: #dc3545;
    }

    .table-box.reserved .status-badge {
        background-color: rgba(255, 255, 255, 0.9);
        color: #ffc107;
    }

    /* Hiệu ứng hover cho các trạng thái */
    .table-box.available:hover {
        background: linear-gradient(135deg, #8ccf58, #449d28);
    }

    .table-box.occupied:hover {
        background: linear-gradient(135deg, #d34d3c, #a5281a);
    }

    .table-box.reserved:hover {
        background: linear-gradient(135deg, #e57c0a, #c06b1d);
    }

    /* Chi tiết đơn hàng */
    .order-details {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        max-height: 800px;
    }

    #order-list {
        list-style: none;
        padding: 0;
    }

    #order-list li {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    #order-list li:last-child {
        border-bottom: none;
    }

    .empty-cart {
        display: none;
        text-align: center;
    }

    .empty-cart.active {
        display: block;
    }

    .payment-actions {
        margin-top: 20px;
    }

    .payment-actions .total-price {
        font-size: 18px;
        font-weight: bold;
    }



    .navbar {
        background-color: #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* padding: 10px; */
    }

    .tabs {
        display: flex;
        overflow-x: auto;
        white-space: nowrap;
        align-items: center;
        max-width: 50vw;
        margin-left: 10px;
        /* Khoảng cách bên trái cho tabs */
    }

    .tab {
        display: inline-block;
        padding: 5px 8px;
        /* Giữ nguyên padding để tab nhìn đẹp */
        margin: 0 2px;
        /* Giảm khoảng cách giữa các tab */
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px 5px 0 0;
        cursor: pointer;
        font-size: 14px;
        position: relative;
        min-width: 60px;
    }

    .tab.active {
        background: #4285f4;
        color: white;
        border-bottom: 1px solid transparent;
    }

    .tab .close {
        margin-left: 3px;
        color: red;
        cursor: pointer;
        font-size: 12px;
    }

    .icons {
        display: flex;
        align-items: center;
        margin-left: 10px;
    }

    .icon {
        background: white;
        border-radius: 50%;
        padding: 10px;
        margin: 0 5px;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background 0.3s;
    }

    .icon:hover {
        background: #e0e0e0;
    }

    .tab-indicator {
        margin-left: 10px;
        color: white;
        font-weight: bold;
    }

    .container {
        margin-top: 20px;
        text-align: center;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .add-tab-btn {
        background: #28a745;
        border: none;
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-right: 10px;
    }

    .add-tab-btn:hover {
        background-color: #218838;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: white;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .footer-icons {
        display: flex;
        align-items: center;
    }

    .footer-icons .icon {
        margin: 0 5px;
        font-size: 20px;
    }

    .pay-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }

    .pay-button:hover {
        background-color: #0056b3;
    }

    .total {
        font-size: 18px;
        font-weight: bold;
    }

    .empty-state {
        display: none;
    }

    .empty-state.active {
        display: block;
    }

    .table-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
        padding: 10px;
    }

    .table-box {
        flex-basis: calc(19%);
        max-width: calc(19%);
        height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;

        text-align: center;
        border-radius: 10px;
        box-sizing: border-box;
    }




    .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 5px;
        }

        .btn-secondary {
            background-color: #f0f0f0;
            color: #888888;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-secondary:hover, .btn-primary:hover, .btn-info:hover, .btn-warning:hover {
            opacity: 0.9;
        }

        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .dropdown {
            position: absolute;
            right: 10px;
            top: 60px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 300px;
        }

        .dropdown h4 {
            margin-bottom: 10px;
        }

        #notificationList {
            list-style: none;
            padding: 0;
        }

        #notificationList li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }


        .table-card {
    position: relative;
    width: 150px;
    height: 150px;
    margin-left: 10px;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    box-sizing: border-box;
    border-radius: 10px;
    margin-bottom: 10px;
    transition: border-color 0.3s ease;
}

.table-number {
    font-size: 1.0rem;
    font-weight: bold;
    color: #333;
    position: absolute;
    top: 10px;
    left: 10px;
}

.border-decoration {
    position: absolute;
    background-color: #ced4da;
}

.border-decoration.left {
    width: 3px;
    height: 120px;
    left: -5px;
    top: 50%;
    transform: translateY(-50%);
}

.border-decoration.right {
    width: 3px;
    height: 120px;
    right: -5px;
    top: 50%;
    transform: translateY(-50%);
}

.border-decoration.top {
    height: 3px;
    width: 120px;
    top: -5px;
    left: 50%;
    transform: translateX(-50%);
}

.border-decoration.bottom {
    height: 3px;
    width: 120px;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
}

.table-card.available .border-decoration.left {
    background-color: green; /* Trống */
}

.table-card.reserved .border-decoration.left {
    background-color: orange; /* Đã đặt */
}

.table-card.occupied .border-decoration.left {
    background-color: red; /* Đang sử dụng */
}
=======
     /* --------------------css Ben phía INDEX---------------------- */
     .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .table-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: calc(20% - 20px);
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
        }

        .table-name {
            font-size: 18px;
            font-weight: bold;
        }

        .table-details {
            margin: 10px 0;
        }

        .table-status {
            font-size: 14px;
            color: gray;
        }

        .table-price {
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 50px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .filter-btn.active {
            background-color: #007bff;
            color: white;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
        }

        .filter-btn:hover {
            background-color: #0056b3;
            color: white;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
        }

        .order-item {
            margin-bottom: 10px;
        }

        .order-item span:nth-child(2) {
            color: #28a745;
            font-weight: bold;
        }

        .quantity-input {
            margin-left: 10px;
        }

        #notification {
            display: none;
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9999;
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        #notification strong {
            margin-right: 10px;
        }

    /* Các kiểu chung */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
    }

    /* Cải tiến cho các ô table */
    .table-box:hover {
        transform: translateY(-5px);
        /* Nổi lên khi hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Bóng đổ mạnh hơn khi hover */
        cursor: pointer;
        /* Con trỏ tay khi hover */
    }

    .table-box.active {
        background-color: #fff3cd;
        /* Màu nền khác cho ô hoạt động */
        border-color: #ffeeba;
        /* Đường viền sáng hơn cho ô hoạt động */
    }

    /* Header Section */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #00aaff;
        padding: 10px;
        color: white;
    }

    .logo-section,
    .main-actions,
    .cart-section {
        display: flex;
        align-items: center;
    }

    .menu-button {
        background: none;
        border: none;
        margin-right: 10px;
        cursor: pointer;
        color: white;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
    }
    .btn-filter {
        background: linear-gradient(135deg, #5a9bd5, #007acc);
        color: white;
        margin-right: 10px;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 1.1em;
        border: none;
        cursor: pointer;
        transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-weight: 500;
    }

    .btn-filter:hover {
        background: linear-gradient(135deg, #007acc, #005b99);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    .btn-filter.active {
        background: linear-gradient(135deg, #28a745, #218838);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
        font-weight: bold;
    }

    .btn-filter:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.7);
    }

    .cart-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(45deg, #4caf50, #43a047);
        color: white;
        padding: 20px;
        border-radius: 8px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.4s ease, visibility 0.4s ease;
        z-index: 1000;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        font-family: 'Arial', sans-serif;
        max-width: 300px;
    }

    .cart-notification.show {
        opacity: 1;
        visibility: visible;
    }

    .cart-notification .notification-content {
        display: flex;
        flex-direction: column;
    }

    .cart-notification .notification-content p {
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
    }

    .cart-notification .close-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        color: white;
        cursor: pointer;
        font-size: 18px;
    }

    .modal-header {
        background-color: #007acc;
        color: white;
    }

    .modal-body {
        background-color: #f9f9f9;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .modal-body:hover {
        transform: scale(1.02);
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-item:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .cart-item-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
    }

    .user-button {
        background-color: #007acc;
        border: none;
        padding: 8px 15px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .product-search-bar {
        padding: 8px;
        width: 250px;
        border-radius: 5px;
        border: none;
    }

    .action-buttons button {
        margin-left: 10px;
        background-color: white;
        border: none;
        padding: 8px;
        border-radius: 5px;
        cursor: pointer;
    }

    .cart-section {
        display: flex;
        align-items: center;
    }

    .cart-info {
        display: flex;
        align-items: center;
        position: relative;
    }

    .cart-icon {
        width: 25px;
        height: 25px;
    }

    .cart-badge {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: green;
        color: white;
        padding: 2px 5px;
        border-radius: 50%;
        font-size: 12px;
    }

    .customer-search-bar {
        margin-left: 15px;
        padding: 8px;
        border-radius: 5px;
        border: none;
        width: 150px;
    }

    .add-customer-button {
        background-color: white;
        border: none;
        padding: 8px;
        border-radius: 5px;
        margin-left: 10px;
        cursor: pointer;
    }

    /* Main Content and Table Grid */
    .main-container {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        flex-grow: 1;
        /* Ensures it stretches to take up available space */
    }

    .tables-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        flex-grow: 1;
    }

    /* Cải tiến cho các ô table */
    .table-box {
        background-color: white;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        transition: transform 0.2s, box-shadow 0.2s;
        /* Hiệu ứng chuyển động */
    }

    .table-box:hover {
        transform: translateY(-5px);
        /* Nổi lên khi hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Bóng đổ mạnh hơn khi hover */
    }

    .table-box.active {
        background-color: #fff3cd;
        /* Màu nền khác cho ô hoạt động */
        border-color: #ffeeba;
        /* Đường viền sáng hơn cho ô hoạt động */
    }

    .table-name {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 20px;
        /* Tăng cỡ chữ cho tên bàn */
    }

    .table-info {
        font-size: 24px;
        /* Tăng cỡ chữ cho thông tin bàn */
        background-color: #dcdcdc;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
        /* Hiệu ứng chuyển màu nền */
    }

    /* Order Section */
    .order-section {
        width: 300px;
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .order-summary {
        margin-bottom: 20px;
    }

    .order-actions button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .dine-in-btn {
        background-color: orange;
    }

    .discount-btn {
        background-color: green;
    }

    .coupon-btn {
        background-color: pink;
    }

    /* Bottom Action Section */
    .bottom-actions {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #f4f4f4;
        border-top: 1px solid #ddd;
    }

    .takeaway-btn {
        background-color: white;
        border: 1px solid #ddd;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
    }

    .badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 3px 7px;
        font-size: 12px;
        position: absolute;
        top: -10px;
        right: -10px;
    }

    .table-actions {
        display: flex;
        align-items: center;
    }

    .table-actions label {
        margin-right: 10px;
    }

    .table-actions select,
    .add-table-btn {
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .order-buttons {
        display: flex;
        align-items: center;
    }

    .order-buttons button {
        padding: 10px;
        margin-left: 10px;
        border: 1px solid #ddd;
        background-color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .final-amount-btn {
        background-color: #00aaff;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Footer */
    footer.footer {
        text-align: left;
        width: 100%;
        padding: 10px 20px;
        background-color: #f4f4f4;
        border-top: 1px solid #ddd;
        position: relative;
        bottom: 0;
        flex-shrink: 0;
    }

    /* Fix footer position at bottom */
    html,
    body {
        min-height: 100vh;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .main-container {
        flex-grow: 1;
    }

    /* Dropdown Menu */
    #menuDropdown ul {
        padding: 0;
        margin: 0;
    }

    #menuDropdown li {
        list-style: none;
        margin-bottom: 10px;
    }

    #menuDropdown a {
        text-decoration: none;
        color: black;
        display: flex;
        align-items: center;
        padding: 8px;
        border-radius: 5px;
        transition: background-color 0.2s ease-in-out;
    }

    #menuDropdown a:hover {
        background-color: #f4f4f4;
    }

    /* Enhanced Animated Icons */
    .animated-icon {
        transition: transform 0.3s, color 0.3s;
    }

    .animated-icon:hover {
        transform: scale(1.2);
        color: #00c6ff;
    }

    /* Quick Checkout and Logout Button Hover Effect */
    .quick-checkout-button:hover,
    .logout-button:hover {
        transform: translateY(-2px);
    }

    /* Header Logo and Button Styling */
    .logo {
        font-family: 'Poppins', sans-serif;
    }

    .product-search-bar,
    .customer-search-bar {
        transition: box-shadow 0.3s;
    }

    .product-search-bar:focus,
    .customer-search-bar:focus {
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Dropdown Menu Styles */
    #menuDropdown {
        transform: translateY(-20px);
        opacity: 0;
        transition: all 0.4s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
    }

    #menuDropdown ul {
        padding: 0;
        margin: 0;
    }

    #menuDropdown li {
        list-style: none;
    }

    #menuDropdown a {
        text-decoration: none;
        color: black;
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #menuDropdown a:hover {
        background-color: #f0f0f0;
    }

    /* Animation for hover on icons */
    .dropdown-item i {
        margin-right: 10px;
        transition: transform 0.3s;
    }

    .dropdown-item:hover i {
        transform: scale(1.2);
        color: #007acc;
    }

    /* Button Hover Effects */
    .quick-checkout-button:hover,
    .logout-button:hover {
        transform: translateY(-2px);
    }

    .animated-icon:hover {
        transform: scale(1.2);
        transition: transform 0.3s ease;
    }
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6

</style>
