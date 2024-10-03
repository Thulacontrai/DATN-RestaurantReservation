<!-- Enhanced and Modernized Header Section -->
<header class="header d-flex justify-content-between align-items-center p-3"
    style="background: linear-gradient(90deg, #007acc, #00c6ff); box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
    <div class="logo-section d-flex align-items-center">
        <button class="menu-button btn" id="hamburgerMenu" style="background: none; border: none; color: white;">
            <i class="fas fa-bars fa-lg animated-icon"></i>
        </button>
        <h1 class="logo ml-2" style="font-size: 24px; color: white; font-weight: bold;">POS</h1>
    </div>

    <!-- Search and Quick Access Features for Cashiers -->
    <div class="main-actions d-flex align-items-center">
        <div class="action-buttons d-flex align-items-center">
            <button class="qr-button btn" style="background: none; border: none; color: white; margin-left: 10px;">
                <i class="fas fa-qrcode fa-lg animated-icon"></i>
            </button>
            <a href="/Pmenu/1">
                <button class="table-button btn" style="background: none; border: none; color: white;">
                    <i class="fas fa-utensils fa-lg animated-icon"></i>
                </button>
            </a>
            <button class="discount-button btn" id="applyDiscount"
                style="background: none; border: none; color: white;">
                <i class="fas fa-percentage fa-lg animated-icon"></i> Giảm giá
            </button>
        </div>
    </div>

    <!-- Cart and Customer Management -->
    <div class="cart-section d-flex align-items-center">
        <input type="text" placeholder="Tìm khách hàng" class="customer-search-bar p-1"
            style="border-radius: 10px; padding: 8px; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1); margin-right: 10px; border: none;">
        <button class="add-customer-button btn" style="background: none; border: none; color: white;">
            <i class="fas fa-user-plus fa-lg animated-icon"></i>
        </button>
    </div>

</header>

<!-- Dropdown menu for hamburger -->
<div id="menuDropdown" class="dropdown-menu"
    style="display: none; position: absolute; top: 70px; left: 0; background-color: white; width: 250px; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; z-index: 1000; opacity: 0; transform: translateY(-20px); transition: all 0.4s ease;">
    <ul class="list-unstyled">
        <li><a href="{{ route('pos.index') }}" class="dropdown-item"><i class="fas fa-home"></i> Dịch vụ</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-file-alt"></i> Đơn hàng tạm</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-shopping-cart"></i> Đơn hàng</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-money-bill-wave"></i> Giao dịch</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-chart-line"></i> Báo cáo</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-cogs"></i> Cài đặt</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-user-cog"></i> Quản lý nhân viên</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-cash-register"></i> Phiếu thu/chi</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-user"></i> Tài khoản của tôi</a></li>
        <li><a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<!-- JavaScript for handling dropdown menu behavior -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle the dropdown menu with smooth animation
        document.getElementById('hamburgerMenu').addEventListener('click', function() {
            var dropdown = document.getElementById('menuDropdown');
            if (dropdown.style.opacity === '0' || dropdown.style.display === 'none') {
                dropdown.style.display = 'block';
                setTimeout(function() {
                    dropdown.style.opacity = '1';
                    dropdown.style.transform = 'translateY(0)';
                }, 10); // Delay for smooth transition
            } else {
                dropdown.style.opacity = '0';
                dropdown.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    dropdown.style.display = 'none';
                }, 400); // Match the transition duration
            }
        });

        // Close the dropdown if clicking outside of it
        document.addEventListener('click', function(event) {
            var target = event.target;
            var dropdown = document.getElementById('menuDropdown');
            if (!target.closest('#menuDropdown') && !target.closest('#hamburgerMenu')) {
                dropdown.style.opacity = '0';
                dropdown.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    dropdown.style.display = 'none';
                }, 400); // Match the transition duration
            }
        });

        // Quick Checkout Button Interactivity with a cool animation
        document.getElementById('quickCheckout').addEventListener('click', function() {
            alert('Thanh toán nhanh đã được chọn.');
            // Trigger quick checkout logic here
        });

        // Apply Discount Button Logic
        document.getElementById('applyDiscount').addEventListener('click', function() {
            var discount = prompt('Nhập phần trăm giảm giá:');
            if (discount) {
                alert('Đã áp dụng giảm giá: ' + discount + '%');
                // Apply discount logic here
            }
        });

        // Logout Button Action with confirmation dialog
        document.getElementById('cashierLogout').addEventListener('click', function() {
            if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                window.location.href = '/logout'; // Redirect to logout page
            }
        });
    });
</script>
