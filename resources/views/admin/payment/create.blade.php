@extends('admin.master')

@section('title', 'Thêm Thanh Toán Mới')

@section('content')
<div class="content-wrapper-scroll">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thêm Thanh Toán Mới</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payment.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Mã Đặt Chỗ (Reservation ID)</label>
                                <input type="text" name="reservation_id" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mã Hóa Đơn (Bill ID)</label>
                                <input type="text" name="bill_id" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số Tiền (Amount)</label>
                                <input type="number" name="amount" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phương Thức Thanh Toán (Payment Method)</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash">Tiền mặt</option>
                                    <option value="credit_card">Thẻ tín dụng</option>
                                    <option value="e-wallet">Ví điện tử</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng Thái Thanh Toán (Status)</label>
                                <select name="status" class="form-select" required>
                                    <option value="pending">Chờ xử lý</option>
                                    <option value="completed">Hoàn thành</option>
                                    <option value="cancelled">Đã hủy</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Lưu Thanh Toán</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
