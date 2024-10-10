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
        margin-left:  10px;
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
        gap: 15px;
        flex-grow: 1;
        padding: 0 10px;
    }

    /* Table and Order sections */
    .table-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 20px;
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

</style>
