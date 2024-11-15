<!-- Tải jQuery trước -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS nếu sử dụng -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Các thư viện và tệp JavaScript khác -->
<script src="{{ asset('poss/assets/js/backend-bundle.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/flex-tree.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/tree.js') }}"></script>
<script src="{{ asset('poss/assets/js/table-treeview.js') }}"></script>
<script src="{{ asset('poss/assets/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('poss/assets/js/mapbox.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/core/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/list/main.js') }}"></script>
<script src="{{ asset('poss/assets/js/sweetalert.js') }}"></script>
<script src="{{ asset('poss/assets/js/vector-map-custom.js') }}"></script>
<script src="{{ asset('poss/assets/js/customizer.js') }}"></script>
<script src="{{ asset('poss/assets/js/chart-custom.js') }}"></script>
<script src="{{ asset('poss/assets/js/slider.js') }}"></script>
<script src="{{ asset('poss/assets/js/app.js') }}"></script>



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

<script>
    $(document).ready(function() {
        const tableViewButton = $('#table-view-button');
        const menuViewButton = $('#menu-view-button');
        const tableSection = $('#table-section');
        const menuSection = $('#menu-section');
        const loadingElement = $('#loading');
        const orderDetails = $('#order-details');
        const totalPriceElement = $('#totalAmount');

        let orderId = null;
        let currentOrder = {};
        let totalAmount = 0;

        function showLoading(isLoading) {
            loadingElement.css('display', isLoading ? 'block' : 'none');
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

        tableViewButton.click(function() {
            menuSection.fadeOut();
            tableSection.fadeIn();
            tableViewButton.addClass('active');
            menuViewButton.removeClass('active');
        });

        menuViewButton.click(function() {
            tableSection.fadeOut();
            menuSection.fadeIn();
            menuViewButton.addClass('active');
            tableViewButton.removeClass('active');
        });

        $('.filter-btn').click(function() {
            const status = $(this).data('status');
            $('.table-card').each(function() {
                $(this).toggle(status === 'all' || $(this).hasClass(status));
            });
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
