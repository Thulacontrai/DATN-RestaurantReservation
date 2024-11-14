import './bootstrap'
window.Echo.channel('kitchen')
    .listen('ProcessingDishes', (e) => {
        if (e.noti !== null) {
            let audio = new Audio('sounds/mixkit-doorbell-tone-2864.wav');
            audio.play();
            audio.play().catch(error => console.log("Lỗi phát âm thanh:", error));
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
        const DangCheBien = document.getElementById('DangCheBien');
        DangCheBien.innerHTML = e.items.map(item => {
            if (item.count_cancel == 0) {
                return `
                    <div class="order-card row" data-item-id="${item.id}" data-table-id="${item.order.tables['0'].id}">
                        <div class="col-md-6">
                            <strong>${item.dish.name}</strong>
                            <p>${item.formatted_created_at}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Số lượng</strong>
                                    <p>${item.quantity}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong>Bàn</strong>
                                    <p>${item.order.tables['0'].table_number}</p>
                                </div>
                                <div class="col-md-4 btn-group-custom">
                                    <button class="btn btn-danger cook-all" title="Chế biến toàn bộ"><i
                                                            class="fa-solid fa-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                if (item.quantity != 0) {
                    return `
                    <div class="order-card row" data-item-id="${item.id}" data-table-id="${item.order.tables['0'].id}">
                        <div class="col-md-6">
                            <strong>${item.dish.name}</strong>
                            <p>${item.formatted_created_at}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Số lượng</strong>
                                    <p>${item.quantity}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong>Bàn</strong>
                                    <p>${item.order.tables['0'].table_number}</p>
                                </div>
                                <div class="col-md-4 btn-group-custom">
                                    <button class="btn btn-danger cook-all" title="Chế biến toàn bộ"><i class="fa-solid fa-forward"></i></button>
                                </div>
                            </div>
                            <div class="row">
                            <p>Hủy <span class="text-danger">${item.count_cancel}</span> vào lúc ${item.formatted_updated_at}</p>
                            </div>
                        </div>
                    </div>
                `;
                } else {
                    return `
                    <div class="order-card row" data-item-id="${item.id}" data-table-id="${item.order.tables['0'].id}">
                        <div class="col-md-6">
                            <strong>${item.dish.name}</strong>
                            <p>${item.formatted_created_at}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Số lượng</strong>
                                    <p>${item.quantity}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong>Bàn</strong>
                                    <p>${item.order.tables['0'].table_number}</p>
                                </div>
                                <div class="col-md-4 btn-group-custom">
                                                        <button class="btn btn-secondary delete" title="Xóa"><i
                                                                class="fa-solid fa-trash"></i></button>
                                                    </div>
                            </div>
                            <div class="row">
                            <p>Hủy <span class="text-danger">${item.count_cancel}</span> vào lúc ${item.formatted_updated_at}</p>
                            </div>
                        </div>
                    </div>
                `;
                }
            }
        }).join('');
    });
window.Echo.channel('kitchenn')
    .listen('ProvideDishes', (e) => {
        const ChoCungUng = document.getElementById('ChoCungUng');
        ChoCungUng.innerHTML = e.items.map(item => {
            if (item.count_cancel == 0) {
                return `
                    <div class="order-card row" data-item-id="${item.id}" data-table-id="${item.order.tables['0'].id}">
                        <div class="col-md-6">
                            <strong>${item.dish.name}</strong>
                            <p>${item.formatted_updated_at}</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Số lượng</strong>
                                    <p>${item.quantity}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong>Bàn</strong>
                                    <p>${item.order.tables['0'].table_number}</p>
                                </div>
                                <div class="col-md-4 btn-group-custom">
                                    <button class="btn btn-success done-all" title="Cung ứng toàn bộ"><i class="fa-solid fa-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                if (item.quantity != 0) {
                    return `
                        <div class="order-card row" data-item-id="${item.id}" data-table-id="${item.order.tables['0'].id}">
                            <div class="col-md-6">
                                <strong>${item.dish.name}</strong>
                                <p>${item.formatted_updated_at}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Số lượng</strong>
                                        <p>${item.quantity}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Bàn</strong>
                                        <p>${item.order.tables['0'].table_number}</p>
                                    </div>
                                    <div class="col-md-4 btn-group-custom">
                                        <button class="btn btn-success done-all" title="Cung ứng toàn bộ"><i class="fa-solid fa-forward"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Hủy <span class="text-danger">${item.count_cancel}</span> vào lúc ${item.formatted_updated_at}</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    return `
                        <div class="order-card row" data-item-id="${item.id}" data-table-id="${item.order.tables['0'].id}">
                            <div class="col-md-6">
                                <strong>${item.dish.name}</strong>
                                <p>${item.formatted_updated_at}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Số lượng</strong>
                                        <p>${item.quantity}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Bàn</strong>
                                        <p>${item.order.tables['0'].table_number}</p>
                                    </div>
                                    <div class="col-md-4 btn-group-custom">
                                        <button class="btn btn-secondary delete" title="Xóa"><i
                                            class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Hủy <span class="text-danger">${item.count_cancel}</span> vào lúc ${item.formatted_updated_at}</p>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
        }).join('');
    });