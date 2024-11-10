import './bootstrap';

window.Echo.channel('order')
    .listen('PosTableUpdated', (e) => {
        const layoutTable = document.getElementById('order-details');
        layoutTable.innerHTML = `
        <h3>Chi tiết đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> ${e.order.id}</p>
            <p><strong>Bàn:</strong> ${e.tableId.table_number}</p>
            <p><strong>Giờ vào:</strong> ${e.tableId.orders['0'].pivot.start_time.split(" ")[1]}</p>
            <p><strong>Trạng thái:</strong> ${e.order.status}</p>
            <h4>Danh sách món</h4>
        `;
        e.orderItems.order_items.forEach(item => {
            if (item.status == 'chờ xử lý') {
                layoutTable.innerHTML += `
    <li class="item-list" data-dish-id="${item.item_id}"><span class="text-dark">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
`;
            } else if (item.status == 'đang chế biến') {
                layoutTable.innerHTML += `
    <li class="item-list" data-dish-id="${item.item_id}"><span class="text-danger">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
`;
            } else if (item.status == 'chờ cung ứng') {
                layoutTable.innerHTML += `
    <li class="item-list" data-dish-id="${item.item_id}"><span class="text-primary">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
`;
            } else if (item.status == 'hoàn thành') {
                layoutTable.innerHTML += `
    <li class="item-list" data-dish-id="${item.item_id}"><span class="text-success">${item.dish.name}</span> - Số lượng: <button class="plus-item"  title="Tăng số lượng món">+</button>${item.quantity}<button class="minus-item" tittle="Giảm số lượng món">-</button> - Giá: ${item.total_price} VND <button class="delete-item" tittle="Hủy món">Hủy</button></li>
`;
            }
        });
        document.getElementById('totalAmount').innerHTML = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(e.order.total_amount);
    });
