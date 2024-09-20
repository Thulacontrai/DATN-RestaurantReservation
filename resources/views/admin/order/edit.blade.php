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
                                            value="{{ old('reservation_id', $order->reservation_id) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="staff_id" class="form-label">Nhân Viên</label>
                                        <input type="number" class="form-control" id="staff_id" name="staff_id"
                                            value="{{ old('staff_id', $order->staff_id) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="table_id" class="form-label">Bàn</label>
                                        <input type="number" class="form-control" id="table_id" name="table_id"
                                            value="{{ old('table_id', $order->table_id) }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="total_amount" class="form-label">Tổng Tiền</label>
                                        <input type="number" step="0.01" class="form-control" id="total_amount"
                                            name="total_amount" value="{{ old('total_amount', $order->total_amount) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="final_amount" class="form-label">Số Tiền Cuối Cùng</label>
                                        <input type="number" step="0.01" class="form-control" id="final_amount"
                                            name="final_amount" value="{{ old('final_amount', $order->final_amount) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="Completed"
                                                {{ $order->status === 'Completed' ? 'selected' : '' }}>Hoàn thành</option>
                                            <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>
                                                Đang xử lý</option>
                                            <option value="Cancelled"
                                                {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                        </select>
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
