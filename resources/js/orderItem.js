import './bootstrap';
import '../css/orderItem.css';

window.Echo.channel('order')
    .listen('PosTableUpdated', (e) => {
        const layoutTable = document.getElementById('order-details');
        const notification = document.getElementById('notification-button');
        const checkoutBtn = document.getElementById('payment-button');
        if (e.checkoutBtn == false) {
            checkoutBtn.disabled = true;
        } else {
            checkoutBtn.disabled = false;
        };
        if (e.notiBtn == false) {
            notification.disabled = true;
        } else {
            notification.disabled = false;
        };
        if (selectedTableId == e.tableId.id) {
            layoutTable.innerHTML = `
            <div style='display: flex; flex-direction: column'>
                <div style='display: flex; justify-content: center'>
                    <h3>Chi tiết đơn hàng</h3>
                </div>

                <div class="row">
                    <div class="col">
                        <p><strong>Bàn:</strong> ${e.tableId.table_number}</p>
                    </div>
                    <div class="col">
                        <p><strong>Mã đơn hàng:</strong> ${e.order.id}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p><strong>Khách Hàng:</strong> ${e.tableId.orders['0'].pivot.start_time.split(" ")[1]}</p>
                    </div>
                    <div class="col">
                        <p><strong>Giờ vào:</strong> ${e.tableId.orders['0'].pivot.start_time.split(" ")[1]}</p>
                    </div>
                </div>
            </div>

            <h4>Danh sách món</h4>
        `;
            e.orderItems.order_items.forEach(item => {
                if (item.status == 'chờ xử lý') {
                    layoutTable.innerHTML += `
                    <div class="item-list" data-dish-id="${item.item_id}" data-dish-order="${item.order_id}" data-dish-status="${item.status}">
                        <div class="item-name">
                            <span class="text-dark" title="${item.status}">${item.dish.name}</span>  
                        </div>
                        <div class="item-action">
                            <div class="item-quantity">
                                <span class="text-dark" >Số Lượng:</span>  
                                <div class="quantity-control">
                                    <button class="quantity-btn minus-item" title="Giảm số lượng món">-</button>
                                    <span class="quantity">${item.quantity}</span>
                                    <button class="quantity-btn plus-item" title="Tăng số lượng món">+</button>
                                </div>
                            </div>
                            <div class="item-price">
                                Giá: ${item.total_price} VND
                            </div>
                            <div class="item-cancel">
                                <button class="delete-item" title="Hủy món">Hủy</button>
                            </div>
                        </div>
                        
                    </div>

                `;
                } else if (item.status == 'đang xử lý') {
                    layoutTable.innerHTML += `
                    <div class="item-list" data-dish-id="${item.item_id}" data-dish-order="${item.order_id}" data-dish-status="${item.status}">
                        <div class="item-name">
                            <span class="text-danger" title="${item.status}">${item.dish.name}</span>  
                        </div>
                        <div class="item-action">
                            <div class="item-quantity">
                                <span class="text-dark">Số Lượng:</span>  
                                <div class="quantity-control">
                                    <button class="quantity-btn minus-item" title="Giảm số lượng món">-</button>
                                    <span class="quantity">${item.quantity}</span>
                                    <button class="quantity-btn plus-item" title="Tăng số lượng món">+</button>
                                </div>
                            </div>
                            <div class="item-price">
                                Giá: ${item.total_price} VND
                            </div>
                            <div class="item-cancel">
                                <button class="delete-item" title="Hủy món">Hủy</button>
                            </div>
                        </div>
                        
                    </div>
                `;
                } else if (item.status == 'hoàn thành') {
                    layoutTable.innerHTML += `
                    <div class="item-list" data-dish-id="${item.item_id}" data-dish-order="${item.order_id}" data-dish-status="${item.status}">
                        <div class="item-name">
                            <span class="text-success" title="${item.status}">${item.dish.name}</span>  
                        </div>
                        <div class="item-action">
                            <div class="item-quantity">
                                <span class="text-dark">Số Lượng:</span>  
                                <div class="quantity-control">
                                    <button class="quantity-btn minus-item" title="Giảm số lượng món">-</button>
                                    <span class="quantity">${item.quantity}</span>
                                    <button class="quantity-btn plus-item" title="Tăng số lượng món">+</button>
                                </div>
                            </div>
                            <div class="item-price">
                                Giá: ${item.total_price} VND
                            </div>
                            <div class="item-cancel">
                                <button class="delete-item" title="Hủy món">Hủy</button>
                            </div>
                        </div>
                        
                    </div>
                `;
                }
            });

            document.getElementById('totalAmount').innerHTML = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(e.order.total_amount);
        }
    });
window.Echo.channel('orders')
    .listen('PosTableUpdatedWithNoti', (e) => {
        const layoutTable = document.getElementById('order-details');
        const notification = document.getElementById('notification-button');
        if (e.noti !== null) {
            Swal.fire({
                icon: 'info',
                title: 'Thông báo',
                text: e.noti,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
        if (e.notiBtn == false) {
            notification.disabled = true;
        } else {
            notification.disabled = false;
        };
        if (selectedTableId == e.tableId.id) {
            layoutTable.innerHTML = `
        <h3>Chi tiết đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> ${e.order.id}</p>
            <p><strong>Bàn:</strong> ${e.tableId.table_number}</p>
            <p><strong>Giờ vào:</strong> ${e.tableId.orders['0'].pivot.start_time.split(" ")[1]}</p>
            <h4>Danh sách món</h4>
        `;
            e.orderItems.order_items.forEach(item => {
                if (item.status == 'chờ xử lý') {
                    layoutTable.innerHTML += `
                    <div class="item-list" data-dish-id="${item.item_id}" data-dish-order="${item.order_id}" data-dish-status="${item.status}">
                        <div class="item-name">
                            <span class="text-dark" title="${item.status}">${item.dish.name}</span>  
                        </div>
                        <div class="item-action">
                            <div class="item-quantity">
                                <span class="text-dark" >Số Lượng:</span>  
                                <div class="quantity-control">
                                    <button class="quantity-btn minus-item" title="Giảm số lượng món">-</button>
                                    <span class="quantity">${item.quantity}</span>
                                    <button class="quantity-btn plus-item" title="Tăng số lượng món">+</button>
                                </div>
                            </div>
                            <div class="item-price">
                                Giá: ${item.total_price} VND
                            </div>
                            <div class="item-cancel">
                                <button class="delete-item" title="Hủy món">Hủy</button>
                            </div>
                        </div>
                        
                    </div>

                `;
                } else if (item.status == 'đang xử lý') {
                    layoutTable.innerHTML += `
                    <div class="item-list" data-dish-id="${item.item_id}" data-dish-order="${item.order_id}" data-dish-status="${item.status}">
                        <div class="item-name">
                            <span class="text-danger" title="${item.status}">${item.dish.name}</span>  
                        </div>
                        <div class="item-action">
                            <div class="item-quantity">
                                <span class="text-dark">Số Lượng:</span>  
                                <div class="quantity-control">
                                    <button class="quantity-btn minus-item" title="Giảm số lượng món">-</button>
                                    <span class="quantity">${item.quantity}</span>
                                    <button class="quantity-btn plus-item" title="Tăng số lượng món">+</button>
                                </div>
                            </div>
                            <div class="item-price">
                                Giá: ${item.total_price} VND
                            </div>
                            <div class="item-cancel">
                                <button class="delete-item" title="Hủy món">Hủy</button>
                            </div>
                        </div>
                        
                    </div>
                `;
                } else if (item.status == 'hoàn thành') {
                    layoutTable.innerHTML += `
                    <div class="item-list" data-dish-id="${item.item_id}" data-dish-order="${item.order_id}" data-dish-status="${item.status}">
                        <div class="item-name">
                            <span class="text-success" title="${item.status}">${item.dish.name}</span>  
                        </div>
                        <div class="item-action">
                            <div class="item-quantity">
                                <span class="text-dark">Số Lượng:</span>  
                                <div class="quantity-control">
                                    <button class="quantity-btn minus-item" title="Giảm số lượng món">-</button>
                                    <span class="quantity">${item.quantity}</span>
                                    <button class="quantity-btn plus-item" title="Tăng số lượng món">+</button>
                                </div>
                            </div>
                            <div class="item-price">
                                Giá: ${item.total_price} VND
                            </div>
                            <div class="item-cancel">
                                <button class="delete-item" title="Hủy món">Hủy</button>
                            </div>
                        </div>
                        
                    </div>
                `;
                }
            });

            document.getElementById('totalAmount').innerHTML = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(e.order.total_amount);
        }
    });
