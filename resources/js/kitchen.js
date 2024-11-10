import './bootstrap'

window.Echo.channel('kitchen')
    .listen('KitchenUpdated', (e) => {
        const DangCheBien = document.getElementById('DangCheBien');
        DangCheBien.innerHTML = e.items.map(item => {
            if (item.status === "đang chế biến") {
                return `
                    <div class="order-card row" data-item-id="${item.id}">
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
                                    <button class="btn btn-danger cook-all" title="Chế biến toàn bộ">&gt;&gt;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }).join('');
        const ChoCungUng = document.getElementById('ChoCungUng');
        ChoCungUng.innerHTML = e.items.map(item => {
            if (item.status === "chờ cung ứng") {
                return `
                    <div class="order-card row" data-item-id="${item.id}">
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
                                    <button class="btn btn-success done-all" title="Cung ứng toàn bộ">&gt;&gt;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }).join('');
    });