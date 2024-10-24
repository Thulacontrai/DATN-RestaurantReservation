
  <!-- Dropdown Menu -->
  <div id="dropdownMenu" class="dropdown-content"
  style="display: none; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 15px; width: 250px;">
  <div class="user-info text-center" style="margin-bottom: 15px;">
      <img src="path/to/avatar.png" alt="User Avatar"
          style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #004a89;">
      <p style="font-weight: bold; color: #004a89; margin: 5px 0;">Thu Ngân</p>
      <span style="cursor: pointer; color: #dc3545;" onclick="hideDropdown()">X</span>
  </div>
  <div class="menu-options">
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-cogs"></i> Quản lý</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-chart-bar"></i> Báo cáo cuối ngày</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-file-invoice"></i> Lập phiếu thu</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-clipboard-list"></i> Hoá đơn</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-list"></i> Danh sách đặt bàn</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-cog"></i> Cài đặt chung</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-tag"></i> Thiết lập giá</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-box"></i> Món có sẵn trong đơn</button>
      <button class="btn btn-custom w-100 mb-2" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-keyboard"></i> Phím tắt</button>
      <button class="btn btn-danger w-100" style="background-color: #004a89; color: #fff;"><i
              class="fas fa-sign-out-alt"></i> Đăng xuất</button>
  </div>
</div>



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
                        <button class="btn" id="modalListReservation" data-toggle="modal" data-target="#reservationListModal"><i class="fas fa-list"></i> Xem danh sách đặt bàn</button>
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

    <!-- Modal Popup Danh Sách Đặt Bàn-->
    <div class="modal fade" id="reservationListModal" tabindex="-1" role="dialog" aria-labelledby="reservationListModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
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
                        <input type="text" id="fromDate" placeholder="Từ ngày" onfocus="(this.type='date')" onblur="if(!this.value){this.type='text'}">
                        <input type="text" id="toDate" placeholder="Đến ngày" onfocus="(this.type='date')" onblur="if(!this.value){this.type='text'}">
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
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dữ liệu bảng-->
                            <tr>
                                <td class="text-center" ><button type="button" class="transparent-button" data-toggle="modal" data-target="#orderDetailModal">PH41966</button></td>
                                <td class="text-center">3</td>
                                <td class="text-center">15:00</td>
                                <td class="text-center">Minh Anh</td>
                                <td class="text-center">0913938828</td>
                                <td class="text-center">14</td>
                                <td class="text-center">0913938828</td>
                            </tr>
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
    <div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                    <input type="text" class="form-control" id="customerName" value="Nguyễn Bá Thư">
                                </div>
                                <div class="input-group">
                                    <label for="orderCode">Mã đặt bàn</label>
                                    <input type="text" class="form-control" id="orderCode" value="DB0000004" readonly>
                                </div>
                                <div class="input-group">
                                    <label for="arrivalTime">Giờ đến</label>
                                    <input type="text" class="form-control" id="arrivalTime" value="14/10/2024 21:30">
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
                                    <input type="number" class="form-control" id="numGuests" value="1" min="1">
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
                            <button type="button" class="btnEdit btn btn-secondary" data-dismiss="modal">Bỏ qua</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</header>


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
</script>

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
    transition: none;
}

#dropdownMenu .btn:hover {
    background-color: #f8f9fa;
}

.dropdown-content .btn {
    background-color: #004a89;
    color: white;
    margin-bottom: 10px;
}

.dropdown-content .btn:hover {
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

    // Modal danh sách đặt bàn
    document.getElementById('modalListReservation').addEventListener('click', function() {
        $('#reservationListModal').modal('show');
    });

});

 </script>

