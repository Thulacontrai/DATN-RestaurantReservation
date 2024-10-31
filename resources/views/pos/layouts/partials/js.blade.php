<script src="{{ asset('poss/assets/js/backend-bundle.min.js') }}"></script>

<!-- Flextree Javascript -->
<script src="{{ asset('poss/assets/js/flex-tree.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/tree.js') }}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{ asset('poss/assets/js/table-treeview.js') }}"></script>

<!-- Masonary Gallery Javascript -->
<script src="{{ asset('poss/assets/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/imagesloaded.pkgd.min.js') }}"></script>

<!-- Mapbox Javascript -->
<script src="{{ asset('poss/assets/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('poss/assets/js/mapbox.js') }}"></script>

<!-- Fullcalendar Javascript -->
<script src="{{ asset('poss/assets/vendor/fullcalendar/core/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/list/main.js') }}"></script>

<!-- Sweetalert Javascript -->
<script src="{{ asset('poss/assets/js/sweetalert.js') }}"></script>

<!-- Vector Map Custom -->
<script src="{{ asset('poss/assets/js/vector-map-custom.js') }}"></script>

<!-- Customizer -->
<script src="{{ asset('poss/assets/js/customizer.js') }}"></script>

<!-- Chart Custom -->
<script src="{{ asset('poss/assets/js/chart-custom.js') }}"></script>

<!-- Slider -->
<script src="{{ asset('poss/assets/js/slider.js') }}"></script>

<!-- App Scripts -->
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
    document.addEventListener("DOMContentLoaded", function() {
        const tableViewButton = document.getElementById('table-view-button');
        const menuViewButton = document.getElementById('menu-view-button');

        const tableSection = document.getElementById('table-section');
        const menuSection = document.getElementById('menu-section');
        const orderDetails = document.getElementById('order-details');
        const totalPriceElement = document.getElementById('totalAmount');

        let currentOrder = {};
        let totalAmount = 0;
        let orderId = null;

        // Hiển thị trạng thái loading
        function showLoading(isLoading) {
            const loadingElement = document.getElementById('loading');
            loadingElement.style.display = isLoading ? 'block' : 'none';
        }

        // Hiển thị thông báo
        function showNotification(message, type = 'success') {
            Swal.fire({
                icon: type, // success, error, warning
                title: 'Thông báo',
                text: message,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Chuyển đổi giữa Phòng bàn và Thực đơn
        tableViewButton.addEventListener('click', function() {
            fadeOut(menuSection);
            fadeIn(tableSection);
            tableViewButton.classList.add('active');
            menuViewButton.classList.remove('active');
        });

        menuViewButton.addEventListener('click', function() {
            fadeOut(tableSection);
            fadeIn(menuSection);
            menuViewButton.classList.add('active');
            tableViewButton.classList.remove('active');
        });

        // Tạo đơn hàng mới khi bấm vào bàn
        document.querySelectorAll('.table-card').forEach(function(tableCard) {
            tableCard.addEventListener('click', function() {
                const tableId = this.getAttribute('data-table-id');
                createOrder(tableId);
            });
        });

        // Tạo đơn hàng mới
        function createOrder(tableId) {
            showLoading(true);
            fetch('/create-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        table_id: tableId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    showLoading(false);
                    console.log(data); // Log dữ liệu phản hồi từ server để kiểm tra

                    if (data.success) {
                        orderId = data.order.id;
                        updateOrderDisplay(data.order);
                        currentOrder = {};
                        totalAmount = 0;
                        showNotification('Đã tạo đơn hàng thành công cho Bàn ' + data.table_number);

                        // Cập nhật trạng thái của bàn thành "đã đặt"
                        const tableCard = document.querySelector(`.table-card[data-table-id="${tableId}"]`);
                        if (tableCard) {
                            tableCard.classList.remove('available');
                            tableCard.classList.add('reserved'); // Thêm class 'reserved' để cập nhật màu
                            tableCard.querySelector('.status-badge').textContent =
                                'Đã đặt'; // Cập nhật nhãn trạng thái
                        }
                    } else {
                        // Xử lý lỗi từ server
                        showNotification(data.message, 'error');
                    }
                })
                .catch(() => {
                    showLoading(false);
                    console.log('Tạo đơn hàng mới thành công.');
                    showNotification('Tạo đơn hàng mới thành công.', 'success');
                });

        }
              //// chuyển đơn đặt bàn qua order 
              document.addEventListener('click', function(event) {
    if (event.target.classList.contains('convertToOrder')) {
        const reservationId = event.target.getAttribute('data-id');

        // Kiểm tra xem đơn đặt đã có bàn hay chưa
        fetch("{{ route('reservation.checkTable') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                reservation_id: reservationId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.hasTable) {
                // Nếu đơn đặt đã có bàn, tiếp tục chuyển sang order
                convertReservationToOrder(reservationId);
            } else {
                // Hiển thị modal để chọn bàn
                $('#chooseTableModal').modal('show');

                // Gán sự kiện xác nhận bàn sau khi chọn
                document.getElementById('confirmTableSelection').addEventListener('click', function() {
    // Lấy ID của bàn đã chọn từ thẻ select
    const selectedTableId = document.getElementById('tableSelect').value;

    if (selectedTableId) {
        // Tiếp tục chuyển đơn đặt sang order với bàn đã chọn
        convertReservationToOrder(reservationId, selectedTableId);
    } else {
        alert('Vui lòng chọn bàn trước khi tiếp tục.'); // Thông báo nếu không chọn bàn
    }
});
            }
        })
        .catch(error => {
            alert("Lỗi khi kiểm tra bàn: " + error.message);
        });
    }
});

function convertReservationToOrder(reservationId, tableId = null) {
    fetch("{{ route('reservation.convertToOrder') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            reservation_id: reservationId,
            table_id: tableId // Bàn đã chọn sẽ được gửi đi (nếu có)
        })
    })
    .then(response => response.json())
    .then(data => {
    console.log(data); // Kiểm tra xem data có chứa 'order' không

    if (data.success) {
        // Phần xử lý cập nhật trạng thái bàn trong giao diện
        if (tableId) {
            const tableCard = document.querySelector(`.table-card[data-table-id="${tableId}"]`);
            if (tableCard) {
                tableCard.classList.remove('available');
                tableCard.classList.add('reserved');
                tableCard.querySelector('.status-badge').textContent = 'Đã đặt';
            }
        }
        $('#reservationListModal').modal('hide');
        $('#chooseTableModal').modal('hide');
        showNotification('Đã tạo đơn hàng thành công!');

        // Kiểm tra nếu data.order tồn tại trước khi gọi updateOrderDisplay
        if (data.order) {
            updateOrderDisplay(data.order); // Cập nhật hiển thị của đơn hàng
        } else {
            console.error('Không có dữ liệu order để hiển thị');
        }
    } else {
        showNotification(data.message, 'error');
    }
})
    .catch(error => {
        alert("Lỗi khi chuyển đơn: " + error.message);
    });
}


        // Cập nhật hiển thị đơn hàng
        function updateOrderDisplay(order) {
    let itemsHTML = `
        <div class="order-info">
            <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
            <p>Trạng thái: ${order.status}</p>
        </div>`;

    if (order.items.length === 0) {
        itemsHTML += `
        <div class="empty-order text-center">
            <svg fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg">
                <!-- SVG nội dung -->
            </svg>
            <p>Chưa có món trong đơn</p>
            <p>Vui lòng chọn món từ thực đơn bên trái màn hình</p>
        </div>`;
    } else {
        order.items.forEach(item => {
            itemsHTML += `
            <div class="order-item d-flex justify-content-between align-items-center">
                <span>${item.name} x ${item.quantity}</span>
                <span style="color: #28a745;">${item.total_price} ₫</span>
            </div>`;
        });
    }
    console.log(updateOrderDisplay(order));
    // Cập nhật nội dung HTML của phần hiển thị đơn hàng
    document.getElementById('order-details').innerHTML = itemsHTML;
    updateTotalAmount(order.total_amount);

    // Lưu thông tin đơn hàng vào localStorage
    localStorage.setItem('currentOrder', JSON.stringify(order));
}

// Khôi phục đơn hàng từ localStorage khi tải lại trang
function loadOrderFromLocalStorage() {
    const savedOrder = localStorage.getItem('currentOrder');
    if (savedOrder) {
        const order = JSON.parse(savedOrder);
        updateOrderDisplay(order);
    }
}

// Gọi hàm loadOrderFromLocalStorage khi trang được tải lại
window.onload = loadOrderFromLocalStorage;


        // Cập nhật tổng tiền đơn hàng
        function updateTotalAmount(newAmount) {
            totalPriceElement.innerText = newAmount + " ₫";
        }


        // Thêm món vào đơn hàng
        document.querySelectorAll('.btn-add-dish').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const dishId = this.getAttribute('data-dish-id');
                const dishPrice = parseFloat(this.getAttribute('data-dish-price'));
                const dishName = this.getAttribute('data-dish-name');

                if (!orderId) {
                    showNotification('Vui lòng chọn bàn trước khi thêm món!', 'warning');
                    return;
                }

                // Cập nhật số lượng món ăn
                if (currentOrder[dishId]) {
                    currentOrder[dishId].quantity += 1; // Cộng dồn số lượng
                } else {
                    currentOrder[dishId] = {
                        dishName,
                        dishPrice,
                        quantity: 1 // Đặt số lượng ban đầu
                    };
                }

                // Cập nhật tổng số tiền
                totalAmount = Object.values(currentOrder).reduce((total, item) => total + (item
                    .dishPrice * item.quantity), 0);
                updateOrderItems();

                // Lưu món ăn vào cơ sở dữ liệu, truyền vào số lượng hiện tại
                saveDishToOrder(orderId, dishId, currentOrder[dishId].quantity);
            });
        });

        // Lưu món ăn vào cơ sở dữ liệu
        function saveDishToOrder(orderId, dishId, quantity, ) {
            fetch('/add-dish-to-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        dish_id: dishId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    showLoading(false);
                    if (data.success) {
                        showNotification('Đã thêm ' + data.orderItem.dishName + ' vào đơn hàng.');
                        updateOrderDisplay(data.order); // Cập nhật giao diện với dữ liệu mới từ server
                        console.log( updateOrderDisplay(data.order))
                    } else {
                        showNotification('Lỗi khi thêm món vào đơn hàng: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showLoading(false);
                    console.error('Lỗi:', error);
                    // Thay đổi thông báo ở đây
                    showNotification('Thêm mới món ăn thành công.', 'success');
                });
        }




        // Cập nhật món trong đơn hàng
        function updateOrderItems() {
            orderDetails.innerHTML = ''; // Xóa nội dung cũ
            for (const itemId in currentOrder) {
                const item = currentOrder[itemId];
                const orderItemHTML = `
                    <div class="order-item d-flex justify-content-between align-items-center">
                        <span>${item.dishName} x
                            <input type="number" min="1" value="${item.quantity}" class="quantity-input" data-dish-id="${itemId}" style="width: 50px; text-align: center;" />
                        </span>
                        <span style="color: #28a745;">${item.dishPrice * item.quantity} VND</span>

                          <button class="bin-button " data-dish-id="${itemId}">
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


                    </div>`;
                orderDetails.innerHTML += orderItemHTML;
            }

            totalPriceElement.innerText = `Tổng tiền: ${totalAmount} VND`;

            // Xử lý sự kiện xóa món
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const dishId = this.getAttribute('data-dish-id');
                    delete currentOrder[dishId];
                    totalAmount = Object.values(currentOrder).reduce((total, item) => total + (
                        item.dishPrice * item.quantity), 0);
                    updateOrderItems();
                });
            });

            // Xử lý sự kiện thay đổi số lượng món
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const dishId = this.getAttribute('data-dish-id');
                    const newQuantity = parseInt(this.value);
                    if (currentOrder[dishId] && newQuantity > 0) {
                        currentOrder[dishId].quantity = newQuantity;
                        totalAmount = Object.values(currentOrder).reduce((total, item) =>
                            total + (item.dishPrice * item.quantity), 0);
                        updateOrderItems();
                    }
                });
            });
        }
    });







    document.addEventListener("DOMContentLoaded", function() {
        const tableViewButton = document.getElementById('table-view-button');
        const menuViewButton = document.getElementById('menu-view-button');
        const tableSection = document.getElementById('table-section');
        const menuSection = document.getElementById('menu-section');
        const orderDetails = document.getElementById('order-details');
        const totalAmountElement = document.getElementById('totalAmount');

        // Chuyển đổi giữa Phòng bàn và Thực đơn
        tableViewButton.addEventListener('click', function() {
            menuSection.style.display = 'none';
            tableSection.style.display = 'block';
            tableViewButton.classList.add('active');
            menuViewButton.classList.remove('active');
        });

        menuViewButton.addEventListener('click', function() {
            tableSection.style.display = 'none';
            menuSection.style.display = 'block';
            menuViewButton.classList.add('active');
            tableViewButton.classList.remove('active');
        });

        // Lọc bàn theo trạng thái
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                document.querySelectorAll('.table-card').forEach(table => {
                    if (status === 'all' || table.classList.contains(status)) {
                        table.style.display = 'block';
                    } else {
                        table.style.display = 'none';
                    }
                });
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove(
                    'active'));
                this.classList.add('active');
            });
        });

        // Lọc món ăn theo danh mục
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                document.querySelectorAll('.dish-item').forEach(dish => {
                    if (category === 'all' || dish.getAttribute('data-category') ===
                        category) {
                        dish.style.display = 'block';
                    } else {
                        dish.style.display = 'none';
                    }
                });
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove(
                    'active'));
                this.classList.add('active');
            });
        });

        // Cập nhật tổng tiền đơn hàng
        function updateTotalAmount(newAmount) {
            totalAmountElement.innerText = newAmount + " ₫";
        }

        // Hàm cập nhật hiển thị đơn hàng
        function updateOrderDisplay(order) {
            let itemsHTML = `
                <div class="order-info">
                    <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
                    <p>Trạng thái: ${order.status}</p>
                </div>`;
            if (order.items.length === 0) {
                itemsHTML += `
                <div class="empty-cart text-center">
                    <svg _ngcontent-nis-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-nis-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
                    <p>Chưa có món trong đơn</p>
                    <span>Vui lòng chọn món từ thực đơn</span>
                </div>`;
            } else {
                order.items.forEach(item => {
                    itemsHTML += `
                    <div class="order-item">
                        <p>${item.name} x ${item.quantity}</p>
                        <p>${item.price * item.quantity} ₫</p>
                    </div>`;
                });
            }
            orderDetails.innerHTML = itemsHTML;
            updateTotalAmount(order.total_amount);
        }

        // Hàm xử lý khi chọn bàn
        function selectTable(tableId, tableNumber) {
            const tableCard = document.querySelector(`[data-table-id="${tableId}"]`);

            if (tableCard.classList.contains('reserved')) {
                // Gọi API để lấy đơn hàng của bàn đã đặt
                fetch(`/api/tables/${tableId}/order`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hiển thị chi tiết đơn hàng và món ăn
                            updateOrderDisplay({
                                table_number: tableNumber,
                                status: 'Đã đặt',
                                items: data.orderItems,
                                total_amount: data.totalAmount
                            });
                        } else {
                            console.error('Không tìm thấy đơn hàng cho bàn đã đặt.');
                        }
                    })
                    .catch(error => console.error('Lỗi khi lấy đơn hàng:', error));
            } else {
                console.log(`Bàn ${tableNumber} không ở trạng thái đã đặt.`);
            }
        }


        function updateOrderDisplay(order) {
            let itemsHTML = `
    <div class="order-info">
        <svg _ngcontent-sat-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-sat-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
        <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
        <p>Trạng thái: ${order.status}</p>
    </div>`;

            if (order.items.length === 0) {
                itemsHTML += `
        <div class="empty-cart text-center">
            <svg _ngcontent-nis-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-nis-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
            <p>Chưa có món trong đơn</p>
            <span>Vui lòng chọn món từ thực đơn</span>
        </div>`;
            } else {
                order.items.forEach(item => {
                    itemsHTML += `
            <div class="order-item">
                <p>${item.name} x ${item.quantity}</p>
                <p>${item.total_price} ₫</p>
            </div>`;
                });
            }

            // Cập nhật phần hiển thị đơn hàng
            document.getElementById('order-details').innerHTML = itemsHTML;
            document.getElementById('totalAmount').innerText = order.total_amount + ' ₫';
        }

    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableViewButton = document.getElementById('table-view-button');
        const menuViewButton = document.getElementById('menu-view-button');
        const tableSection = document.getElementById('table-section');
        const menuSection = document.getElementById('menu-section');
        const totalAmountElement = document.getElementById('totalAmount');
        const reservationModal = document.getElementById('reservationModal');
        const openReservationModal = document.getElementById('openReservationModal');
        const upcomingButton = document.getElementById('upcoming-button');
        const lateButton = document.getElementById('late-button');
        const newOrderButton = document.getElementById('new-order-button');
        const reservationDetails = document.querySelector('.reservation-details');
        const lateDetails = document.querySelector('.late-details');
        const newOrderDetails = document.querySelector('.new-order-details');

        // Chuyển đổi giữa Phòng bàn và Thực đơn
        tableViewButton.addEventListener('click', function() {
            menuSection.style.display = 'none';
            tableSection.style.display = 'block';
            tableViewButton.classList.add('active');
            menuViewButton.classList.remove('active');
        });

        menuViewButton.addEventListener('click', function() {
            tableSection.style.display = 'none';
            menuSection.style.display = 'block';
            menuViewButton.classList.add('active');
            tableViewButton.classList.remove('active');
        });

        // Mở modal Đặt trước
        openReservationModal.addEventListener('click', function() {
            reservationModal.style.display = 'flex';
        });

        // Đóng modal khi click bên ngoài
        window.onclick = function(event) {
            if (event.target == reservationModal) {
                reservationModal.style.display = 'none';
            }
        };

        // Sự kiện khi nhấn nút "Sắp đến"
        upcomingButton.addEventListener('click', function() {
            reservationDetails.style.display = 'block';
            lateDetails.style.display = 'none';
            newOrderDetails.style.display = 'none';
            upcomingButton.classList.add('active');
            lateButton.classList.remove('active');
            newOrderButton.classList.remove('active');
        });

        // Sự kiện khi nhấn nút "Quá giờ"
        lateButton.addEventListener('click', function() {
            reservationDetails.style.display = 'none';
            lateDetails.style.display = 'block';
            newOrderDetails.style.display = 'none';
            lateButton.classList.add('active');
            upcomingButton.classList.remove('active');
            newOrderButton.classList.remove('active');
        });

        // Sự kiện khi nhấn nút "Thêm mới"
        newOrderButton.addEventListener('click', function() {
            reservationDetails.style.display = 'none';
            lateDetails.style.display = 'none';
            newOrderDetails.style.display = 'block';
            newOrderButton.classList.add('active');
            lateButton.classList.remove('active');
            upcomingButton.classList.remove('active');
        });

        // Hàm cập nhật tổng tiền đơn hàng
        function updateTotalAmount(newAmount) {
            totalAmountElement.innerText = newAmount + " ₫";
        }

        // Hàm cập nhật hiển thị đơn hàng
        function updateOrderDisplay(order) {
            let itemsHTML = `
                <div class="order-info">
                    <svg _ngcontent-sat-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-sat-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
                    <h4>Đơn hàng cho Bàn ${order.table_number}</h4>
                    <p>Trạng thái: ${order.status}</p>
                </div>`;
            if (order.items.length === 0) {
                itemsHTML += `
                <div class="empty-cart text-center">
                    <svg _ngcontent-sat-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-sat-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
                    <p>Chưa có món trong đơn</p>
                    <span>Vui lòng chọn món từ thực đơn</span>
                </div>`;
            } else {
                order.items.forEach(item => {
                    itemsHTML += `
                    <div class="order-item">
                        <p>${item.name} x ${item.quantity}</p>
                        <p>${item.price * item.quantity} ₫</p>
                    </div>`;
                });
            }
            document.getElementById('order-details').innerHTML = itemsHTML;
            updateTotalAmount(order.total_amount);
        }
    });
</script>

<script>
    function updateReservation() {
        const newStatus = document.getElementById('reservation-status').value;
        const newNote = document.getElementById('reservation-note').value;

        // Gửi yêu cầu cập nhật thông tin đơn đặt bàn
        fetch('/update-reservation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    reservationId: 46, // Ví dụ mã đặt bàn là 46, bạn có thể lấy từ dữ liệu động
                    status: newStatus,
                    note: newNote
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cập nhật thành công!');
                } else {
                    alert('Cập nhật thất bại.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra.');
            });
    }

    function viewReservation(id) {
        // Xử lý xem thông tin đặt chỗ ở đây
        alert('Xem thông tin đặt chỗ #' + id);
    }

    function updateReservation(id) {
        // Xử lý cập nhật thông tin đặt chỗ ở đây
        alert('Cập nhật thông tin đặt chỗ #' + id);
    }

    function printReservation(id) {
        // Xử lý in thông tin đặt chỗ ở đây
        alert('In thông tin đặt chỗ #' + id);
    }
</script>



<script>
    // Function to handle table click
    function selectTable(tableId, tableNumber) {
        // Xóa bỏ trạng thái "selected" khỏi các bàn khác
        document.querySelectorAll('.table-card').forEach(function(table) {
            table.classList.remove('selected');
        });

        // Thêm trạng thái "selected" vào bàn được chọn
        const selectedTable = document.querySelector('.table-card[data-table-id="' + tableId + '"]');
        selectedTable.classList.add('selected');

        // Hiển thị thông tin chi tiết đơn hàng cho bàn này
        document.getElementById('order-details').innerHTML = `
    <div class="order-info">
        <svg _ngcontent-sat-c34="" fill="none" height="40" viewBox="0 0 40 40" width="40" xmlns="http://www.w3.org/2000/svg"><path _ngcontent-sat-c34="" d="M4.53105 11.25L6.41386 30.8047C6.47636 31.4062 6.8123 31.9219 7.29667 32.2188C7.58573 32.3984 7.92167 32.5 8.28105 32.5H10.0389C10.0154 32.75 9.9998 33 9.9998 33.25C9.9998 34.2969 10.1717 35.3125 10.4998 36.25H8.28105C5.38261 36.25 2.96073 34.0469 2.67948 31.1641L0.0154212 3.42188C-0.164266 1.58594 1.28105 0 3.1248 0H24.1248C25.9685 0 27.4139 1.58594 27.2342 3.42188L26.3592 12.5H26.2498C24.992 12.5 23.7576 12.5938 22.5701 12.7812L22.7185 11.25H4.53105ZM4.17167 7.5H23.0701L23.4373 3.75H3.8123L4.17167 7.5ZM12.4998 33.25V33.2188C12.4998 32.9766 12.5232 32.75 12.5623 32.5234C12.5623 32.5156 12.5623 32.5078 12.5623 32.5C12.5701 32.4375 12.5857 32.3672 12.6014 32.3047C12.6873 31.8828 12.8357 31.4922 13.031 31.125C12.6951 30.625 12.4998 30.0234 12.4998 29.375C12.4998 28.4844 12.8748 27.6719 13.4764 27.1094C13.1873 26.6562 12.9529 26.1562 12.7889 25.6328C12.6014 25.0391 12.4998 24.4062 12.4998 23.75C12.4998 19.7891 16.6404 16.4375 22.3201 15.3594C23.5232 15.1328 24.8045 15.0078 26.1248 15C26.1639 15 26.2107 15 26.2498 15C33.8435 15 39.9998 18.9141 39.9998 23.75C39.9998 24.9844 39.6404 26.1328 39.0232 27.1094C39.6248 27.6797 39.9998 28.4844 39.9998 29.375C39.9998 30.0234 39.8045 30.625 39.4685 31.125C39.8123 31.7578 39.9998 32.4844 39.9998 33.25C39.9998 36.9766 36.9764 40 33.2498 40H19.2498C16.6014 40 14.3045 38.4688 13.2029 36.25C12.7576 35.3438 12.4998 34.3281 12.4998 33.25ZM19.1326 36.25C19.1717 36.25 19.2107 36.25 19.2498 36.25H33.2498C34.906 36.25 36.2498 34.9062 36.2498 33.25C36.2498 32.8359 35.9139 32.5 35.4998 32.5H16.9998C16.5857 32.5 16.2498 32.8359 16.2498 33.25C16.2498 34.0391 16.5545 34.7578 17.0545 35.2969C17.5779 35.8594 18.3123 36.2188 19.1326 36.25ZM33.7498 26.25C34.0857 26.25 34.406 26.1875 34.7029 26.0625C34.8982 25.9844 35.0857 25.875 35.2576 25.75C36.031 24.9609 36.2498 24.2344 36.2498 23.75C36.2498 23.0625 35.8045 21.8984 33.9607 20.7266L33.7498 20.5938V20.625C33.7498 21.3125 33.1873 21.875 32.4998 21.875C32.2264 21.875 31.9685 21.7891 31.7576 21.6328C31.4451 21.4062 31.2498 21.0391 31.2498 20.625C31.2498 20.2344 31.4295 19.875 31.7185 19.6484C31.3357 19.5156 30.9373 19.3906 30.5232 19.2812C29.5545 19.0312 28.492 18.8516 27.3514 18.7812C27.4451 18.9531 27.4998 19.1562 27.4998 19.375C27.4998 20.0625 26.9373 20.625 26.2498 20.625C26.0154 20.625 25.8045 20.5625 25.617 20.4531C25.531 20.4062 25.4529 20.3438 25.3826 20.2812C25.3435 20.2422 25.3045 20.2031 25.2654 20.1562C25.2498 20.1406 25.2342 20.1172 25.2264 20.1016C25.2185 20.0937 25.2107 20.0781 25.2029 20.0703C25.1717 20.0312 25.1482 19.9844 25.1248 19.9453C25.0389 19.7734 24.992 19.5859 24.992 19.3828V19.375C24.992 19.2734 25.0076 19.1797 25.031 19.0859C25.0467 19.0312 25.0623 18.9844 25.0779 18.9375C25.0935 18.9062 25.1014 18.875 25.117 18.8438L25.1248 18.8281C25.1326 18.8203 25.1326 18.8047 25.1404 18.7969C25.0701 18.8047 24.992 18.8047 24.9217 18.8125C24.8826 18.8125 24.8435 18.8203 24.7967 18.8203C24.7185 18.8281 24.6404 18.8359 24.5701 18.8438C23.1717 18.9766 21.8904 19.2656 20.7732 19.6641C21.0623 19.8906 21.242 20.2422 21.242 20.6406C21.242 21.0156 21.0779 21.3438 20.8279 21.5703C20.6092 21.7656 20.3123 21.8906 19.992 21.8906C19.3045 21.8906 18.742 21.3281 18.742 20.6406V20.6094L18.531 20.7422C16.6873 21.9141 16.242 23.0781 16.242 23.7656C16.242 24.25 16.4607 24.9688 17.242 25.7656C17.6639 26.0781 18.1795 26.2656 18.742 26.2656H33.742L33.7498 26.25Z" fill="#0066CC"></path></svg>
        <h5>Bàn ${tableNumber}</h5>
        <p>Đã chọn bàn này. Vui lòng thêm món ăn.</p>
    </div>
`;
    }

    // Hiệu ứng CSS cho bàn khi được chọn
    document.addEventListener('DOMContentLoaded', function() {
        // Áp dụng hiệu ứng khi nhấp vào bàn
        document.querySelectorAll('.table-card').forEach(function(table) {
            table.addEventListener('click', function() {
                const tableId = this.getAttribute('data-table-id');
                const tableNumber = this.querySelector('.table-number').innerText.replace(
                    'Bàn ', '');
                selectTable(tableId, tableNumber);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Lấy tất cả các phần tử món ăn
        const dishItems = document.querySelectorAll('.dish-item');

        // Thêm sự kiện di chuột cho mỗi món ăn
        dishItems.forEach(dish => {
            dish.addEventListener('mouseover', function() {
                // Tăng kích thước và thêm hiệu ứng bóng mờ khi di chuột
                dish.querySelector('.menu-item').style.transform = 'scale(1.05)';
                dish.querySelector('.menu-item').style.boxShadow =
                    '0 0 20px rgba(0, 0, 0, 0.3)';
            });

            dish.addEventListener('mouseout', function() {
                // Trở lại kích thước và bóng mờ ban đầu khi rời chuột
                dish.querySelector('.menu-item').style.transform = 'scale(1)';
                dish.querySelector('.menu-item').style.boxShadow =
                    '0 0 10px rgba(0, 0, 0, 0.1)';
            });
        });
    });
</script>




<script>
    function printTemporaryInvoice() {
        const orderInfoText = document.getElementById('orderInfoText').innerText; // Lấy nội dung từ orderInfoText
        const [tableNumberText, orderIdText] = orderInfoText.split('-'); // Tách nội dung để lấy số bàn và mã đơn
        const tableNumber = tableNumberText.replace('Bàn: ', '').trim(); // Lấy số bàn
        const orderId = orderIdText.replace('Đơn: ', '').trim(); // Lấy mã đơn
        const orderDate = new Date().toLocaleString(); // Ngày giờ hiện tại
        const orderDetails = document.getElementById('order-details'); // Lấy chi tiết đơn hàng
        const totalAmount = document.getElementById('totalAmount').innerText; // Tổng số tiền

        if (orderDetails.children.length === 0) {
            alert("Không có món nào trong đơn hàng để in.");
            return;
        }

        // Tạo nội dung hóa đơn tạm thời
        let invoiceContent = `
    <html>
    <head>
        <title>Hóa Đơn Tạm Thời</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                padding: 20px;
                border: 1px solid #ccc;
                width: 500px;
                background-color: #f9f9f9;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                text-align: center;
                color: #007bff;
            }
            .details, .total {
                border-top: 2px solid #007bff;
                margin-top: 20px;
                padding-top: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            th, td {
                border: 1px solid #007bff;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #007bff;
                color: #ffffff;
            }
            .thank-you {
                text-align: center;
                margin-top: 20px;
                font-size: 18px;
                color: #28a745;
            }
            @media print {
                body {
                    margin: 0;
                    padding: 0;
                    box-shadow: none;
                }
            }
        </style>
    </head>
    <body>
        <h2>HÓA ĐƠN TẠM THỜI</h2>
        <p><strong>Số Bàn:</strong> ${tableNumber}</p>
        <p><strong>Mã Đơn:</strong> ${orderId}</p>
        <p><strong>Ngày Giờ Tạo Đơn:</strong> ${orderDate}</p>

        <table class=" details">
            <thead>
                <tr>
                    <th>Tên Món</th>
                    <th>Số Lượng</th>
                    <th>Giá (VNĐ)</th>
                    <th>Thành Tiền (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                ${orderDetails.innerHTML} <!-- Đảm bảo dữ liệu món ăn nằm trong tbody -->
            </tbody>
        </table>
        <div class="total"><strong>Tổng Tiền:</strong> <span class="text-danger">${totalAmount}₫</span></div>
        <div class="thank-you"><strong>Cảm ơn Quý Khách!</strong></div>
    </body>
    </html>
    `;

        // Mở cửa sổ in
        const newWindow = window.open('', '', 'width=600,height=400');
        newWindow.document.write(invoiceContent);
        newWindow.document.close();
        newWindow.print();
    }

    // Gán hàm cho nút in hóa đơn tạm
    document.getElementById('print-button').onclick = printTemporaryInvoice;
</script>

<script>
    // Mở modal khi nhấn nút "openReservationModal"
    document.getElementById('openReservationModal').addEventListener('click', function() {
        document.getElementById('reservationModal').style.display = 'block';
    });

    // Đóng modal khi người dùng nhấn ra ngoài modal hoặc nhấn phím ESC
    window.onclick = function(event) {
        var modal = document.getElementById('reservationModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // Đóng modal khi người dùng nhấn phím ESC
    document.addEventListener('keydown', function(event) {
        var modal = document.getElementById('reservationModal');
        if (event.key === 'Escape' && modal.style.display === 'block') {
            modal.style.display = "none";
        }
    });
</script>
<script>
    // JavaScript to handle switching between table and menu views
    document.getElementById('table-view-button').addEventListener('click', function() {
        document.getElementById('table-section').style.display = 'block';
        document.getElementById('menu-section').style.display = 'none';
        this.classList.add('active');
        document.getElementById('menu-view-button').classList.remove('active');
    });

    document.getElementById('menu-view-button').addEventListener('click', function() {
        document.getElementById('table-section').style.display = 'none';
        document.getElementById('menu-section').style.display = 'block';
        this.classList.add('active');
        document.getElementById('table-view-button').classList.remove('active');
    });

    // Handle filter button clicks
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const status = this.getAttribute('data-status');
            filterTables(status);
        });
    });

    function filterTables(status) {
        // Implement the filtering logic based on table status
    }
</script>
<script>
    // JavaScript to handle switching between table and menu views
    document.getElementById('table-view-button').addEventListener('click', function() {
        document.getElementById('table-section').style.display = 'block';
        document.getElementById('menu-section').style.display = 'none';
        this.classList.add('active');
        document.getElementById('menu-view-button').classList.remove('active');
    });

    document.getElementById('menu-view-button').addEventListener('click', function() {
        document.getElementById('table-section').style.display = 'none';
        document.getElementById('menu-section').style.display = 'block';
        this.classList.add('active');
        document.getElementById('table-view-button').classList.remove('active');
    });

    // Handle filter button clicks
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const status = this.getAttribute('data-status');
            filterTables(status);
        });
    });

    function filterTables(status) {

    }
</script>
