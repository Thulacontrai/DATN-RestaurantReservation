@extends('admin.master')

@section('title', 'Chỉnh Sửa Đơn Hàng')

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h4 class="card-title mb-3 text-white">Chỉnh Sửa Đơn Hàng</h4>
                            <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-light mb-3">Quay Lại</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="reservation_id" class="form-label">Mã Đặt Chỗ</label>
                                        <input type="number" class="form-control" id="reservation_id" name="reservation_id"
                                            value="{{ old('reservation_id', $order->reservation_id) }}" required
                                            placeholder="Nhập mã đặt chỗ" min="1">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="staff_id" class="form-label">Nhân Viên</label>
                                        <input type="number" class="form-control" id="staff_id" name="staff_id"
                                            value="{{ old('staff_id', $order->staff_id) }}" required
                                            placeholder="Nhập mã nhân viên" min="1">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="customer_id" class="form-label">Mã Khách Hàng</label>
                                        <input type="number" class="form-control" id="customer_id" name="customer_id"
                                            value="{{ old('customer_id', $order->customer_id) }}" required
                                            placeholder="Nhập mã khách hàng" min="1">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="total_amount" class="form-label">Tổng Tiền</label>
                                        <input type="number" class="form-control" id="total_amount" name="total_amount"
                                            value="{{ old('total_amount', $order->total_amount) }}" required
                                            placeholder="Nhập tổng tiền" min="1" max="99999999" step="0.01"
                                            oninput="validateAmount(this)">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="order_type" class="form-label">Loại Đơn Hàng</label>
                                        <select class="form-select" id="order_type" name="order_type" required>
                                            <option value="dine_in"
                                                {{ old('order_type', $order->order_type) === 'dine_in' ? 'selected' : '' }}>
                                                Dùng tại chỗ</option>
                                            <option value="take_away"
                                                {{ old('order_type', $order->order_type) === 'take_away' ? 'selected' : '' }}>
                                                Mang về</option>
                                            <option value="delivery"
                                                {{ old('order_type', $order->order_type) === 'delivery' ? 'selected' : '' }}>
                                                Giao hàng</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="completed"
                                                {{ old('status', $order->status) === 'completed' ? 'selected' : '' }}>Hoàn
                                                thành</option>
                                            <option value="pending"
                                                {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>Đang xử
                                                lý</option>
                                            <option value="cancelled"
                                                {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>Đã
                                                hủy</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="discount_amount" class="form-label">Số Tiền Giảm Giá</label>
                                        <input type="number" class="form-control" id="discount_amount"
                                            name="discount_amount"
                                            value="{{ old('discount_amount', $order->discount_amount) }}"
                                            placeholder="Nhập số tiền giảm giá" min="1" max="99999999" step="0.01"
                                            oninput="validateAmount(this)">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="final_amount" class="form-label">Số Tiền Cuối Cùng</label>
                                        <input type="number" class="form-control" id="final_amount" name="final_amount"
                                            value="{{ old('final_amount', $order->final_amount) }}" required
                                            placeholder="Nhập số tiền cuối cùng" min="1" max="99999999"
                                            step="0.01" oninput="validateAmount(this)">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Cập Nhật Đơn Hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content wrapper end -->

    </div>

@endsection

<script>
    // Hàm kiểm tra và thông báo lỗi nếu giá trị nhập vào không hợp lệ
    function validateAmount(input) {
        const value = input.value;
        if (value < 1 || value > 99999999) {
            alert("Số tiền phải nằm trong khoảng từ 1 đến 99999999!");
            input.setCustomValidity("Giá trị không hợp lệ!");
        } else {
            input.setCustomValidity(""); // Hủy bỏ thông báo lỗi nếu giá trị hợp lệ
        }
    }
</script>
