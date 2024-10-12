<script src="{{ asset('poss/assets/js/backend-bundle.min.js') }}"></script>

<<<<<<< HEAD
<!-- Flextree Javascript -->
<script src="{{ asset('poss/assets/js/flex-tree.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/tree.js') }}"></script>

<!-- Table Treeview JavaScript -->
=======
<!-- Flextree Javascript-->
<script src="{{ asset('poss/assets/js/flex-tree.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/tree.js') }}"></script>

<!-- Table Teeview JavaScript -->
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
<script src="{{ asset('poss/assets/js/table-treeview.js') }}"></script>

<!-- Masonary Gallery Javascript -->
<script src="{{ asset('poss/assets/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('poss/assets/js/imagesloaded.pkgd.min.js') }}"></script>

<!-- Mapbox Javascript -->
<script src="{{ asset('poss/assets/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('poss/assets/js/mapbox.js') }}"></script>

<<<<<<< HEAD
<!-- Fullcalendar Javascript -->
=======
<!-- Fullcalender Javascript -->
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
<script src="{{ asset('poss/assets/vendor/fullcalendar/core/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.js') }}"></script>
<script src="{{ asset('poss/assets/vendor/fullcalendar/list/main.js') }}"></script>

<<<<<<< HEAD
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
                .catch(error => {
                    showLoading(false);
                    console.error('Lỗi khi kết nối tới server: ', error);
                    showNotification('Đã xảy ra lỗi khi kết nối tới server.', 'error');
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
                <div class="empty-cart text-center">
                    <i class="fas fa-utensils fa-3x"></i>
                    <p>Chưa có món trong đơn</p>
                    <span>Vui lòng chọn món từ thực đơn</span>
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

            orderDetails.innerHTML = itemsHTML;
            updateTotalAmount(order.total_amount);
        }

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

                if (currentOrder[dishId]) {
                    currentOrder[dishId].quantity += 1;
                } else {
                    currentOrder[dishId] = {
                        dishName,
                        dishPrice,
                        quantity: 1
                    };
                }

                totalAmount = Object.values(currentOrder).reduce((total, item) => total + (item
                    .dishPrice * item.quantity), 0);
                updateOrderItems();

                // Lưu món ăn vào cơ sở dữ liệu
                saveDishToOrder(orderId, dishId, currentOrder[dishId].quantity);
            });
        });

        // Lưu món ăn vào cơ sở dữ liệu
        function saveDishToOrder(orderId, dishId, quantity) {
            showLoading(true);
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
                    } else {
                        showNotification('Lỗi khi thêm món vào đơn hàng: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showLoading(false);
                    console.error('Lỗi khi kết nối tới server: ', error);
                    showNotification('Đã xảy ra lỗi khi kết nối tới server.', 'error');
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
                        <button class="btn btn-danger btn-delete" data-dish-id="${itemId}">Xóa</button>
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
=======

<script src="{{ asset('poss/assets/js/sweetalert.js') }}"></script>


<script src="{{ asset('poss/assets/js/vector-map-custom.js') }}"></script>

<script src="{{ asset('poss/assets/js/customizer.js') }}"></script>


<script src="{{ asset('poss/assets/js/chart-custom.js') }}"></script>


<script src="{{ asset('poss/assets/js/slider.js') }}"></script>


<script src="{{ asset('poss/assets/js/app.js') }}"></script>
>>>>>>> 0762daeda6a591d3e459ca383c5d5eb38b0a19c6
