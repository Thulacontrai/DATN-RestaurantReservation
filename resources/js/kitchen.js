import './bootstrap';

// Function to generate a row template for a dish
function generateRowTemplate(item, updatedAtKey, buttonClass, buttonTitle, buttonIcon) {
    const { id, combo, dish, formatted_updated_at, quantity, count_cancel, order } = item;
    const table = order.tables[0];
    const updatedAt = item[updatedAtKey];

    // Cancel info
    let cancelInfo = count_cancel > 0
        ? `Hủy <span class="text-danger">${count_cancel}</span> vào lúc ${formatted_updated_at}`
        : '';

    // Action button
    let actionButton = quantity > 0
        ? `<button class="btn ${buttonClass}" title="${buttonTitle}">
                <i class="${buttonIcon}"></i>
           </button>`
        : `<button class="btn btn-secondary delete" title="Xóa">
                <i class="fa-solid fa-trash"></i>
           </button>`;

    // Return a single table row
    return `
        <tr data-item-id="${id}" data-item-type="${item.item_type}" data-table-id="${table.id}">
            <td><strong>${item.item_type == 2 ? combo?.name : dish?.name}</strong></td>
            <td>${updatedAt}</td>
            <td>${quantity}</td>
            <td>${table.table_number}</td>
            <td class="btn-group-custom">${actionButton}</td>
        </tr>
        ${count_cancel > 0 ? `<tr><td colspan="5"><p>Hủy <span class="text-danger">${count_cancel}</span> vào lúc ${formatted_updated_at}</p></td></tr>` : ''}
    `;
}

// Common function to update the UI
function updateUI(containerId, items, updatedAtKey, buttonClass, buttonTitle, buttonIcon) {
    const container = document.getElementById(containerId);

    if (container) {
        // Create table structure
        container.innerHTML = `
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên món</th>
                        <th>Ngày cập nhật</th>
                        <th>Số lượng</th>
                        <th>Bàn</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    ${items.map(item =>
                        generateRowTemplate(
                            item,
                            updatedAtKey,
                            buttonClass,
                            buttonTitle,
                            buttonIcon
                        )
                    ).join('')}
                </tbody>
            </table>
        `;
    }
}

// Kitchen Processing Listener
window.Echo.channel('kitchen')
    .listen('ProcessingDishes', (e) => {
        if (e.noti) {
            let audio = new Audio('sounds/mixkit-doorbell-tone-2864.wav');
            audio.play();
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

        updateUI(
            'DangCheBien',
            e.items,
            'formatted_created_at',
            'btn-danger cook-all',
            'Chế biến toàn bộ',
            'fa-solid fa-forward'
        );
    });

// Kitchen Provide Listener
window.Echo.channel('kitchenn')
    .listen('ProvideDishes', (e) => {
        updateUI(
            'ChoCungUng',
            e.items,
            'formatted_updated_at',
            'btn-success done-all',
            'Cung ứng toàn bộ',
            'fa-solid fa-forward'
        );
    });
