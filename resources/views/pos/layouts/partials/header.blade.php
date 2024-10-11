<<<<<<< HEAD
<header class="navbar navbar-expand-lg navbar-dark bg-primary p-2" style="background: #004a89;">
    <div class="container-fluid">
        <!-- Left Section: Tabs for Phòng bàn và Thực đơn -->
        <div class="navbar-nav d-flex align-items-center">
            <!-- Add more tabs here if needed -->
=======

<header class="navbar navbar-expand-lg navbar-dark bg-primary p-2" style="background: #004a89;">
    <div class="container-fluid">
        <!-- Left Section: Tabs for Phòng bàn and Thực đơn -->
        <div class="navbar-nav d-flex align-items-center">

>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
        </div>

        <!-- Middle Section: Search Bar -->
        <form class="d-flex ms-auto me-3 align-items-center" style="flex-grow: 1;">
<<<<<<< HEAD
            <input class="form-control me-2" type="search" placeholder="Tìm món (F3)" aria-label="Tìm món" style="width: 100%; max-width: 300px;">
=======
            <input class="form-control me-2" type="search" placeholder="Tìm món (F3)" aria-label="Tìm món"
                style="width: 100%; max-width: 300px;">
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
        </form>

        <!-- Right Section: Icons -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <li class="nav-item">
                <button class="btn btn-link text-white">
                    <i class="fas fa-volume-mute"></i>
                </button>
            </li>
            <li class="nav-item">
<<<<<<< HEAD
                <!-- Notification Button -->
                <button class="btn btn-link text-white" id="notificationButton">
=======
                <button class="btn btn-link text-white">
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                    <i class="fas fa-bell"></i>
                </button>
            </li>
            <li class="nav-item">
                <button class="btn btn-link text-white">
                    <i class="fas fa-sync"></i>
                </button>
            </li>
            <li class="nav-item">
<<<<<<< HEAD
                <!-- Print Button -->
                <button class="btn btn-link text-white" id="printButton">
=======
                <button class="btn btn-link text-white">
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                    <i class="fas fa-print"></i>
                </button>
            </li>
            <li class="nav-item">
<<<<<<< HEAD
                <!-- Hamburger Menu -->
=======
                <!-- Hamburger icon -->
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
                <button class="btn btn-link text-white" id="hamburgerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="dropdown-content" style="display: none;">
                    <div class="user-info">
                        <img src="path/to/avatar.png" alt="User Avatar" style="width: 40px; height: 40px; border-radius: 50%;">
                        <p>Thu Ngân</p>
                        <span style="cursor: pointer;">X</span>
                    </div>
                    <div class="menu-options">
                        <div class="menu-row">
                            <button class="btn btn-primary"><i class="fas fa-cogs"></i> Quản lý</button>
                        </div>
                        <button class="btn"><i class="fas fa-chart-bar"></i> Báo cáo cuối ngày</button>
                        <button class="btn"><i class="fas fa-file-invoice"></i> Lập phiếu thu</button>
                        <button class="btn"><i class="fas fa-clipboard-list"></i> Chọn hóa đơn trả hàng</button>
                        <button class="btn"><i class="fas fa-list"></i> Xem danh sách đặt bàn</button>
                        <button class="btn"><i class="fas fa-cog"></i> Cài đặt chung</button>
                        <button class="btn"><i class="fas fa-tag"></i> Thiết lập giá</button>
                        <button class="btn"><i class="fas fa-box"></i> Món có sẵn trong đơn</button>
                        <button class="btn"><i class="fas fa-keyboard"></i> Phím tắt</button>
                        <button class="btn"><i class="fas fa-undo"></i> Chuyển về giao diện cũ</button>
                        <button class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<<<<<<< HEAD

<!-- Print Settings Dropdown Form -->
<div id="printDropdownForm" class="print-dropdown" style="display: none;">
    <div class="print-option">
        <label for="autoPrint">Tự động in hóa đơn</label>
        <label class="switch">
            <input type="checkbox" id="autoPrint" checked>
            <span class="slider round"></span>
        </label>
    </div>

    <div class="print-option">
        <label for="printTemplate">Chọn mẫu in hóa đơn</label>
        <input type="number" id="printTemplate" value="1" min="1">
    </div>

    <div class="print-actions">
        <button class="btn btn-primary" id="confirmButton">Xong</button>
        <button class="btn btn-secondary" id="cancelButton">Bỏ qua</button>
    </div>
</div>
 <style>
    /* Print Dropdown Form Styles */
.print-dropdown {
    position: absolute;
    right: 10px;
    top: 60px;
    width: 300px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    z-index: 1000;
}

/* Notification Dropdown Styles */
.notification-dropdown {
    position: absolute;
    right: 10px;
    top: 100px;
    width: 300px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    z-index: 1000;
    font-family: 'Roboto', sans-serif;
}

.notification-header {
    font-size: 16px;
    font-weight: bold;
    color: #007bff;
    margin-bottom: 10px;
}

.notification-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #666;
    text-align: center;
}

.notification-body p {
    margin-top: 10px;
    font-size: 14px;
}

.notification-icon {
    font-size: 50px;
    color: #cccccc;
    margin-bottom: 10px;
}

/* Switch Toggle */
.switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(20px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

/* Print Form Actions */
.print-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.print-option {
    margin-bottom: 10px;
}

#confirmButton,
#cancelButton {
    width: 48%;
}

/* Dropdown menu styles */
=======
<style>
    /* Dropdown menu styles */
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
#dropdownMenu {
    position: absolute;
    right: 10px;
    top: 60px;
    width: 300px;
    height: auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 15px;
    display: none;
<<<<<<< HEAD
=======
    /* Ẩn menu khi chưa nhấn */
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
}

/* User info styling */
.user-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

.user-info p {
    margin-left: 10px;
    font-size: 16px;
    font-weight: 500;
}

/* Avatar styling */
.user-info img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

/* Menu options styling */
.menu-options {
    margin-top: 10px;
}

<<<<<<< HEAD
=======
/* Remove hover effect */
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
.menu-row button {
    width: 48%;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 10px;
    font-size: 14px;
    background-color: #f8f9fa;
    border: none;
    text-align: left;
    transition: none;
}

/* Button styling */
.btn {
    display: block;
    padding: 12px 15px;
    margin-bottom: 12px;
    cursor: pointer;
<<<<<<< HEAD
    transition: none;
}

#dropdownMenu .btn:hover {
    background-color: #f8f9fa;
}

.dropdown-content .btn {
    background-color: #004a89;
    color: white;
=======
    transition: none; /* No hover transition */
}

/* Remove hover background change */
#dropdownMenu .btn:hover {
    background-color: #f8f9fa; /* Keep the background the same on hover */
}

/* Remove any transition or hover effects for icons */
#hamburgerMenu i {
    transition: none;
}

/* Fix hover and white text issues */
.dropdown-content .btn {
    background-color: #004a89; /* Default background */
    color: white; /* Text color */
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
    margin-bottom: 10px;
}

.dropdown-content .btn:hover {
<<<<<<< HEAD
    background-color: #004a89;
}

.dropdown-content .btn-primary:hover {
    background-color: #0056b3;
}

 </style>

 <script>
    document.addEventListener("DOMContentLoaded", function() {
    const printButton = document.getElementById("printButton");
    const printDropdownForm = document.getElementById("printDropdownForm");
    const hamburgerMenu = document.getElementById("hamburgerMenu");
    const dropdownMenu = document.getElementById("dropdownMenu");
    const bellButton = document.querySelector('.fa-bell');
    const notificationDropdown = document.createElement('div');

    // Thêm nội dung dropdown cho chuông thông báo
    notificationDropdown.classList.add('notification-dropdown');
    notificationDropdown.style.display = 'none'; // Bắt đầu ẩn
    notificationDropdown.innerHTML = `
        <h4 class="notification-header">Chưa thanh toán</h4>
        <div class="notification-body">
            <i class="fas fa-file-alt notification-icon"></i>
            <p>Không có đơn đặt hàng chờ thanh toán</p>
        </div>
    `;
    document.body.appendChild(notificationDropdown);

    // Điều khiển hiển thị dropdown của chuông thông báo
    bellButton.addEventListener("click", function(event) {
        event.stopPropagation();
        toggleDropdown(notificationDropdown);
        hideDropdown(printDropdownForm);
        hideDropdown(dropdownMenu);
    });

    // Toggle print form
    printButton.addEventListener("click", function(event) {
        event.stopPropagation();
        toggleDropdown(printDropdownForm);
        hideDropdown(dropdownMenu);
        hideDropdown(notificationDropdown);
    });

    // Toggle hamburger menu
    hamburgerMenu.addEventListener("click", function(event) {
        event.stopPropagation();
        toggleDropdown(dropdownMenu);
        hideDropdown(printDropdownForm);
        hideDropdown(notificationDropdown);
    });

    // Close all menus when clicking outside
    window.addEventListener("click", function() {
        hideDropdown(printDropdownForm);
        hideDropdown(dropdownMenu);
        hideDropdown(notificationDropdown);
    });

    // Add functionality to Confirm and Cancel buttons
    document.getElementById("confirmButton").addEventListener("click", function() {
        hideDropdown(printDropdownForm);
        alert('Hóa đơn đã được chọn!');
    });

    document.getElementById("cancelButton").addEventListener("click", function() {
        hideDropdown(printDropdownForm);
    });

    // Hàm chung để hiển thị/ẩn dropdown
    function toggleDropdown(element) {
        if (element.style.display === "none" || element.style.display === "") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }

    // Hàm để ẩn dropdown
    function hideDropdown(element) {
        element.style.display = "none";
    }

    // Ngăn chặn đóng khi nhấp vào bên trong dropdown
    printDropdownForm.addEventListener("click", function(event) {
        event.stopPropagation();
    });

    dropdownMenu.addEventListener("click", function(event) {
        event.stopPropagation();
    });

    notificationDropdown.addEventListener("click", function(event) {
        event.stopPropagation();
    });
});

 </script>
=======
    background-color: #004a89; /* Prevent hover color change */
}

.dropdown-content .btn-primary:hover {
    background-color: #0056b3; /* Optional: Add darker blue for hover if needed */
}

/* Fix for table name issue - white text */
.table-box .table-name {
    color: #333; /* Ensure table name is visible */
}

</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const hamburgerMenu = document.getElementById("hamburgerMenu");
    const dropdownMenu = document.getElementById("dropdownMenu");

    hamburgerMenu.addEventListener("click", function() {
        // Toggle menu display without effect
        if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
            dropdownMenu.style.display = "block";
        } else {
            dropdownMenu.style.display = "none";
        }
    });

    // Đóng menu khi nhấn vào nơi khác
    window.addEventListener("click", function(event) {
        if (!hamburgerMenu.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = "none";
        }
    });
});


</script>
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
