import './bootstrap';

window.Echo.channel('order-updates')
    .listen('MenuOrderUpdateItem', (data) => {
        updateOrderUI(data.item);
    });

function updateOrderUI(item) {
    const orderContainer = document.getElementById('order-container');
    const existingItem = orderContainer.querySelector(`.order-item[data-id="${item.id}"]`);

    if (item.deleted) {
        existingItem?.remove();
    } else if (existingItem) {
        existingItem.querySelector('.quantity').textContent = item.quantity;
    } else {
        const newItemHTML = `
            <div class="order-item" data-id="${item.id}" data-type="${item.type}">
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <p class="mb-0">${item.name}</p>
                    <small>${new Intl.NumberFormat().format(item.price)}đ</small>
                </div>
                <div class="item-controls">
                    <button class="btn btn-sm btn-outline-secondary decrease">-</button>
                    <span class="mx-2 quantity">${item.quantity}</span>
                    <button class="btn btn-sm btn-outline-secondary increase">+</button>
                    <button class="btn btn-sm btn-outline-danger remove">Xóa</button>
                </div>
            </div>`;
        orderContainer.insertAdjacentHTML('beforeend', newItemHTML);
    }
}
