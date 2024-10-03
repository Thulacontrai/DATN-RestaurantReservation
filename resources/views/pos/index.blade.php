@extends('pos.layouts.master')

@section('title', 'POS Dashboard')

@section('content')

<!-- Main Content Section -->
<div class="main-container p-3">
    <!-- Table Grid Section -->
    <section class="content">
        <div class="tables-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px;">
            @foreach($tables as $table)
                @if($table->status == 'occupied')
                    <div class="table-box" style="background-color: #ffffff; border-radius: 15px; border: 1px solid #ccc; width: 150px; height: 150px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div style="padding: 10px;">
                            <div class="table-name" style="font-size: 16px; color: #333; font-weight: bold;">Bàn {{ $table->table_number }}</div>
                            <div class="table-info" style="display: flex; align-items: center; color: #666; font-size: 14px; margin-top: 5px;">
                                <span style="margin-right: 8px;">
                                    <i class="fas fa-utensils"></i> {{ $table->dishes ?? 'Chưa có món' }}
                                </span>
                                <span>
                                    <i class="fas fa-users"></i> {{ $table->guests }}
                                </span>
                            </div>
                        </div>
                        <div style="background-color: #007acc; color: white; padding: 5px; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="font-size: 12px;">{{ $table->time ?? 'Chưa có thời gian' }}</div>
                            <div style="font-size: 16px; font-weight: bold;">{{ number_format($table->total_price ?? 0, 0, ',', '.') }} VND</div>
                        </div>
                    </div>
                @else
                    <!-- Default empty table styling -->
                    <div class="table-box" style="background-color: #ffffff; border-radius: 15px; border: 1px solid #ccc; width: 150px; height: 120px; display: flex; align-items: center; justify-content: center; text-align: center;">
                        <a href="{{ route('Pmenu', ['table_number' => $table->table_number]) }}" style="text-decoration: none; color: inherit;">
                            <div class="table-name" style="font-size: 16px; color: #333; font-weight: bold;">
                                Bàn {{ $table->table_number }}
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- Order Section -->
    <aside class="order-section mt-3" style="background-color: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 350px;">
        <h3 style="font-weight: bold; margin-bottom: 15px; border-bottom: 2px solid #007acc; padding-bottom: 5px; color: #007acc;">Đơn Hàng</h3>

        <!-- Order List -->
        <ul class="order-list" style="list-style-type: none; padding: 0; max-height: 250px; overflow-y: auto;">
            @if(!empty($table->orders) && $table->orders->count() > 0)
                @foreach($table->orders as $order)
                    <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 10px; background-color: #f9f9f9; border-radius: 8px; transition: background-color 0.3s;">
                        <span style="font-weight: bold;">{{ $order->name }} x {{ $order->quantity }}</span>
                        <div style="display: flex; align-items: center;">
                            <input type="number" value="{{ $order->quantity }}" min="1" class="quantity-input" style="width: 60px; margin-right: 10px; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                            <span>{{ number_format($order->price * $order->quantity, 0, ',', '.') }} VND</span>
                            <button class="btn btn-danger btn-sm" style="margin-left: 10px;" onclick="confirmDelete('{{ $order->id }}')">Xóa</button>
                        </div>
                    </li>
                @endforeach
            @else
                <li style="text-align: center; color: #999;">Chưa có món trong đơn.</li>
            @endif
        </ul>

        <!-- Order Summary -->
        <div class="order-summary mt-3" style="font-size: 16px;">
            <div class="d-flex justify-content-between">
                <span>Tổng cộng:</span>
                <span id="total-price">{{ number_format($table->total_price ?? 0, 0, ',', '.') }} VND</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>Đặt cọc:</span>
                <span id="deposit-amount">{{ number_format($table->deposit ?? 0, 0, ',', '.') }} VND</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>Giảm giá:</span>
                <input type="number" id="discount" value="0" min="0" class="form-control form-control-sm" style="width: 120px;" onchange="updateTotal()">
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>Thuế (10%):</span>
                <span id="tax">{{ number_format(($table->total_price ?? 0) * 0.1, 0, ',', '.') }} VND</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>Phí dịch vụ (5%):</span>
                <span id="service-charge">{{ number_format(($table->total_price ?? 0) * 0.05, 0, ',', '.') }} VND</span>
            </div>
            <div class="d-flex justify-content-between mt-3 font-weight-bold">
                <span>Khách trả:</span>
                <input type="number" id="customer-paid" value="0" min="0" class="form-control form-control-sm" style="width: 120px;" onchange="calculateChange()">
            </div>
            <div class="d-flex justify-content-between mt-2 font-weight-bold">
                <span>Tiền thừa:</span>
                <span id="change-amount">0 VND</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="order-buttons d-flex align-items-center justify-content-between" style="margin-top: 20px;">
            <button class="btn btn-outline-danger" style="border-radius: 5px;" onclick="clearOrder()">Xóa Đơn</button>
            <button class="btn btn-outline-primary" style="border-radius: 5px;" onclick="saveOrder()">Lưu Đơn</button>
            <button class="btn btn-outline-success" style="padding: 10px 20px; border-radius: 5px;" onclick="payOrder()">Thanh Toán</button>
        </div>

        <!-- Complete Order Button -->
        <div class="complete-order mt-3 d-flex justify-content-between">
            <button class="btn btn-primary" style="width: 100%;" onclick="completeOrder()">Hoàn tất & Gửi hóa đơn</button>
        </div>
    </aside>
</div>

<!-- Bottom Action Section -->
<div class="bottom-actions d-flex justify-content-between p-2" style="background-color: #f4f4f4; border-top: 1px solid #ddd;">
    <button class="takeaway-btn btn d-flex align-items-center" style="background-color: white; border: 1px solid #ddd; padding: 10px 15px; border-radius: 5px;">
        Takeaway orders <span class="badge" style="background-color: red; color: white; padding: 3px 7px; border-radius: 12px; margin-left: 5px;">0</span>
    </button>

    <div class="table-actions d-flex align-items-center">
        <label for="table-select" style="margin-right: 10px;">Tất cả bàn</label>
        <select id="table-select" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="all">Tất cả bàn</option>
            @foreach($tables as $table)
                <option value="{{ $table->table_number }}">{{ $table->table_number }} ({{ $table->status }})</option>
            @endforeach
        </select>
        <button class="add-table-btn btn" style="background: none; border: none; margin-left: 10px;">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div id="confirm-delete-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa món này khỏi đơn hàng không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" onclick="deleteOrder()">Xóa</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateTotal() {
        let total = {{ $table->total_price ?? 0 }};
        let discount = parseInt(document.getElementById('discount').value) || 0;
        let tax = total * 0.1;
        let serviceCharge = total * 0.05;

        let finalTotal = total - discount + tax + serviceCharge;
        document.getElementById('total-price').innerText = new Intl.NumberFormat('vi-VN').format(finalTotal) + ' VND';
    }

    function calculateChange() {
        let total = {{ $table->total_price ?? 0 }};
        let customerPaid = parseInt(document.getElementById('customer-paid').value) || 0;
        let discount = parseInt(document.getElementById('discount').value) || 0;
        let tax = total * 0.1;
        let serviceCharge = total * 0.05;

        let finalTotal = total - discount + tax + serviceCharge;
        let change = customerPaid - finalTotal;

        document.getElementById('change-amount').innerText = new Intl.NumberFormat('vi-VN').format(change > 0 ? change : 0) + ' VND';
    }

    function confirmDelete(orderId) {
        $('#confirm-delete-modal').modal('show');
    }

    function deleteOrder() {
        $('#confirm-delete-modal').modal('hide');
        alert('Món đã được xóa khỏi đơn hàng.');
    }

    function clearOrder() {
        if (confirm('Bạn có chắc chắn muốn xóa toàn bộ đơn hàng?')) {
            alert('Đơn hàng đã được xóa.');
        }
    }

    function saveOrder() {
        alert('Đơn hàng đã được lưu.');
    }

    function payOrder() {
        alert('Tiến hành thanh toán.');
    }

    function completeOrder() {
        alert('Hoàn tất đơn hàng và gửi hóa đơn.');
    }
</script>

@endsection
