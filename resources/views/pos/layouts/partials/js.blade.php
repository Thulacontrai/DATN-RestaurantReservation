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

        $('.table-card').click(function() {
            const tableId = $(this).data('table-id');
            const tableStatus = $(this).data('status');
            showOrderDetails(tableId);
        });

        function updateTableStatus(tableId) {
            const tableCard = $(`.table-card[data-table-id="${tableId}"]`);
            tableCard.removeClass('available').addClass('reserved');
            tableCard.find('.status-badge').text('Đã đặt');
            const icon = tableCard.find('.material-icons');
            if (icon.length) {
                icon.removeClass('text-success text-warning text-danger')
                    .text('bookmark')
                    .addClass('text-warning');
            }
        }

        function showOrderDetails(tableId) {
            $.ajax({
                url: '/order-details/' + tableId,
                type: 'GET',
                success: function(order) {
                    
                },
                error: function() {
                    showNotification('Không thể lấy chi tiết đơn hàng.', 'error');
                }
            });
        }

        function updateTotalAmount(newAmount) {
            totalPriceElement.text(newAmount + " ₫");
        }

        $('.btn-add-dish').click(function() {
            const dishId = $(this).data('dish-id');
            const dishPrice = parseFloat($(this).data('dish-price'));
            const dishName = $(this).data('dish-name');


            if (!orderId) {
                showNotification('Vui lòng chọn bàn trước khi thêm món!', 'warning');
                return;
            }


            currentOrder[dishId] = (currentOrder[dishId] || {
                dishName,
                dishPrice,
                quantity: 0
            });
            currentOrder[dishId].quantity += 1;

            totalAmount = Object.values(currentOrder).reduce((total, item) => total + (item.dishPrice *
                item.quantity), 0);
            updateOrderItems();

            saveDishToOrder(orderId, dishId, currentOrder[dishId].quantity);
        });

        function saveDishToOrder(orderId, dishId, quantity) {
            $.ajax({
                url: '/add-dish-to-order',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    order_id: orderId,
                    dish_id: dishId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                }),
                success: function(data) {
                    if (data.success) {
                        showNotification(`Đã thêm ${data.orderItem.dishName} vào đơn hàng.`);
                    } else {
                        showNotification('Lỗi khi thêm món vào đơn hàng: ' + data.message, 'error');
                    }
                },
                error: function() {
                    showNotification('Có lỗi xảy ra khi thêm món.', 'error');
                }
            });
        }

        function updateOrderItems() {
            orderDetails.empty(); // Clear old content
            totalAmount = 0; // Reset total amount
            for (const itemId in currentOrder) {
                const item = currentOrder[itemId];
                const orderItemHTML = `
            <div class="order-item d-flex justify-content-between align-items-center">
                <span>${item.dishName} x
                    <input type="number" min="1" value="${item.quantity}" class="quantity-input" data-dish-id="${itemId}" style="width: 50px; text-align: center;" />
                </span>
                <span style="color: #28a745;">${item.dishPrice * item.quantity} ₫</span>

                <button class="bin-button" data-item-id="${itemId}">
                                    <!-- SVG của nút xóa -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 39 7" class="bin-top">
                                        <line stroke-width="4" stroke="white" y2="5" x2="39" y1="5"></line>
                                        <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357" y1="1.5" x1="12"></line>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 39" class="bin-bottom">
                                        <mask fill="white" id="path-1-inside-1_8_19">
                                            <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z">
                                            </path>
                                        </mask>
                                        <path mask="url(#path-1-inside-1_8_19)" fill="white" d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z">
                                        </path>
                                        <path stroke-width="4" stroke="white" d="M12 6L12 29"></path>
                                        <path stroke-width="4" stroke="white" d="M21 6V29"></path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 89 80" class="garbage">
                                        <path fill="white" d="M20.5 10.5L37.5 15.5L42.5 11.5L51.5 12.5L68.75 0L72 11.5L79.5 12.5H88.5L87 22L68.75 31.5L75.5066 25L86 26L87 35.5L77.5 48L70.5 49.5L80 50L77.5 71.5L63.5 58.5L53.5 68.5L65.5 70.5L45.5 73L35.5 79.5L28 67L16 63L12 51.5L0 48L16 25L22.5 17L20.5 10.5Z">
                                        </path>
                                    </svg>
                                </button>
            </div>`;
                orderDetails.append(orderItemHTML);
                totalAmount += item.dishPrice * item.quantity; // Cộng dồn tổng tiền
            }

            totalPriceElement.text(`Tổng tiền: ${totalAmount} ₫`);

            // Sự kiện xóa món
            $('.bin-button').off('click').on('click', function() {
                const dishId = $(this).data('item-id');
                delete currentOrder[dishId];
                updateOrderItems(); // Cập nhật lại danh sách món
            });

            // Sự kiện thay đổi số lượng
            $('.quantity-input').off('change').on('change', function() {
                const dishId = $(this).data('dish-id');
                const newQuantity = parseInt(this.value);
                if (currentOrder[dishId] && newQuantity > 0) {
                    currentOrder[dishId].quantity = newQuantity;
                    updateOrderItems(); // Cập nhật lại danh sách món
                }
            });
        }

    });
</script>
