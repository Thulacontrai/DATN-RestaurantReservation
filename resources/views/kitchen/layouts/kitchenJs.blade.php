<script>
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-key',
    cluster: 'mt1',
    forceTLS: true
});

window.Echo.channel('kitchen')
    .listen('KitchenUpdated', (e) => {
        // Cập nhật HTML của danh sách sản phẩm
        const container = document.querySelector('.container-fluid');
        container.innerHTML = e.items.map(item => `
            <div class="order-card row">
                <div class="col-md-6">
                    <strong>${item.dish.name}</strong>
                    <p>${new Date(item.updated_at).toLocaleDateString()}</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Số lượng</strong>
                            <p>${item.quantity}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Bàn</strong>
                            <p>${item.order.table.table_number}</p>
                        </div>
                        <div class="col-md-4 btn-group-custom">
                            <button class="btn btn-outline-danger" title="Chế biến xong 1">&gt;</button>
                            <button class="btn btn-danger" title="Chế biến toàn bộ">&gt;&gt;</button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    });

</script>
