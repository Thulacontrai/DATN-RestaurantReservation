<!-- CSS Files
    ================================================== -->
<link rel="stylesheet" href="client/css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="client/css/plugins.css" type="text/css">
<link rel="stylesheet" href="client/css/style.css" type="text/css">
<link rel="stylesheet" href="client/css/coloring.css" type="text/css">

<!-- css for scheme color -->
<link rel="stylesheet" href="client/css/colors/cream.css" type="text/css" id="colors">

<!-- custom css -->
<link rel="stylesheet" href="client/css/03_custom.css" type="text/css">

<!-- Slider Revolution Stylesheet -->
<link rel="stylesheet" type="text/css" href="client/revolution/css/settings.css">
<link rel="stylesheet" type="text/css" href="client/revolution/css/layers.css">
<link rel="stylesheet" type="text/css" href="client/revolution/css/navigation.css">
<link rel="stylesheet" type="text/css" href="client/revolution/css/rev-settings.css">

<link rel="stylesheet" href="{{ asset('adminn/assets/fonts/bootstrap/bootstrap-icons.css') }}">


<style>

    /* login  */
    .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .btn-option {
            display: inline-block;
            width: 48%;
            text-align: center;
            cursor: pointer;
        }
        .btn-option.active {
            background-color: #FFB347;
            color: white;
        }
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            margin: 5px;
            font-size: 24px;
        }

.profile-section {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    margin: 20px;
}
.upcoming-reservations .reservation-item {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.reservation-details {
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    margin: 20px;
}
.reservation-details .actions {
    margin-top: 20px;
}
.reservation-details .actions .btn {
    margin-right: 10px;
}
.additional-info {
    margin-top: 20px;
}


   /* General container styling */
.container-fluid {
    background-color: #18191B;
    /* padding: 20px; */
}

/* Side Menu Styling */
.side-menu {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.side-menu h5 {
    font-weight: 600;
}

.side-menu .nav-link {
    padding: 10px;
    font-size: 16px;
    color: #333;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-link {
    color: #000; /* Màu mặc định */
    text-decoration: none; /* Bỏ gạch chân */
}

.nav-link.active {
    font-weight: bold; /* In đậm */
    /* color: #007bff; Màu khi đang hoạt động */
}

/* Profile Circle Styling */
.profile-circle {
    background-color: #007bff;
    color: black;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
}
/* edit */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Nền mờ */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Đảm bảo nó nằm trên cùng */
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
    cursor: pointer;
    float: right;
    font-size: 20px;
}

.edit-icon {
    cursor: pointer;
    margin-left: 10px;
    color: #007bff; /* Màu cho icon */
}

.edit-icon:hover {
    color: #0056b3; /* Màu khi hover */
}


/* Profile Info Section */
.profile-info {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.profile-info p {
    font-size: 16px;
    margin-bottom: 10px;
}

/* Reservation Card Styling */
.reservation-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 15px;
    align-items: center;
}

.reservation-card h5 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
}

.reservation-card p {
    font-size: 14px;
    color: #666;
}

.reservation-card .bi-people {
    margin-right: 5px;
    color: #007bff;
}

/* Phân trang  */
.pagination {
    justify-content: center; /* Căn giữa các nút phân trang */
    margin-top: 20px; /* Khoảng cách phía trên */
}

.page-item {
    margin: 0 3px; /* Khoảng cách giữa các nút */
}

.page-link {
    padding: 3px 3px; /* Thu nhỏ kích thước nút */
    font-size: 14px; /* Giảm kích thước font chữ */
}

.page-item.disabled .page-link {
    pointer-events: none; /* Vô hiệu hóa nút khi không thể nhấp */
    color: #6c757d; /* Màu cho nút không khả dụng */
}

.page-item.active .page-link {
    background-color: #007bff; /* Màu nền cho nút đang chọn */
    color: white; /* Màu chữ cho nút đang chọn */
}

.page-link:hover {
    background-color: #f1f1f1; /* Màu nền khi hover */
    border-radius: 5px; /* Bo góc cho nút */
}

.page-link:focus {
    outline: none; /* Bỏ viền focus */
}



/* Responsive Styles */
@media (max-width: 768px) {
    .side-menu {
        margin-bottom: 20px;
    }
    
    .reservation-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .reservation-card img {
        width: 100%;
        height: auto;
        margin-bottom: 10px;
    }
}
</style>