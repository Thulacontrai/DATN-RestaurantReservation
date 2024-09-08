@extends('admin.master')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h4 class="card-title mb-3 text-white">Chi Tiết Đơn Hàng </h4>
                            <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-light mb-3">Quay Lại</a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Thông Tin Đơn Hàng</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Mã Đơn Hàng:</strong> {{ $order->id }}</li>
                                        <li class="list-group-item"><strong>Mã Đặt Chỗ:</strong> {{ $order->reservation_id }}</li>
                                        <li class="list-group-item"><strong>Nhân Viên:</strong> {{ $order->staff->name ?? 'Không rõ' }}</li>
                                        <li class="list-group-item"><strong>Bàn:</strong> {{ $order->table_id ?? 'Không rõ' }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-primary">Chi Tiết Thanh Toán</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Tổng Tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</li>
                                        <li class="list-group-item"><strong>Số Tiền Cuối Cùng:</strong> {{ number_format($order->final_amount, 0, ',', '.') }} VND</li>
                                        <li class="list-group-item">
                                            <strong>Trạng Thái:</strong>
                                            @if ($order->status === 'Completed')
                                                <span class="badge bg-success">Hoàn thành</span>
                                            @elseif ($order->status === 'Pending')
                                                <span class="badge bg-warning text-dark">Đang xử lý</span>
                                            @elseif ($order->status === 'Cancelled')
                                                <span class="badge bg-danger">Đã hủy</span>
                                            @else
                                                <span class="badge bg-secondary">Không rõ</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary">Thời Gian</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Ngày Tạo:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</li>
                                        <li class="list-group-item"><strong>Ngày Cập Nhật:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}</li>
                                    </ul>
                                </div>
                            </div>

                            <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-warning mt-3">Chỉnh Sửa Đơn Hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content wrapper end -->

    </div>

@endsection
