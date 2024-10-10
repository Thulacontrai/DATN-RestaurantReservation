
<header class="navbar navbar-expand-lg navbar-dark bg-primary p-2" style="background: #004a89;">
    <div class="container-fluid">
        <!-- Left Section: Tabs for Phòng bàn and Thực đơn -->
        <div class="navbar-nav d-flex align-items-center">

        </div>

        <!-- Middle Section: Search Bar -->
        <form class="d-flex ms-auto me-3 align-items-center" style="flex-grow: 1;">
            <input class="form-control me-2" type="search" placeholder="Tìm món (F3)" aria-label="Tìm món"
                style="width: 100%; max-width: 300px;">
        </form>

        <!-- Right Section: Icons -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <li class="nav-item">
                <button class="btn btn-link text-white">
                    <i class="fas fa-volume-mute"></i>
                </button>
            </li>
            <li class="nav-item">
                <button class="btn btn-link text-white">
                    <i class="fas fa-bell"></i>
                </button>
            </li>
            <li class="nav-item">
                <button class="btn btn-link text-white">
                    <i class="fas fa-sync"></i>
                </button>
            </li>
            <li class="nav-item">
                <button class="btn btn-link text-white">
                    <i class="fas fa-print"></i>
                </button>
            </li>
            <li class="nav-item">
                <!-- Hamburger icon -->
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
<style>
    /* Dropdown menu styles */
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
    /* Ẩn menu khi chưa nhấn */
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

/* Remove hover effect */
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
    margin-bottom: 10px;
}

.dropdown-content .btn:hover {
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
