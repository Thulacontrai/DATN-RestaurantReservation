@extends('admin.master')

@section('title', 'Thêm Thanh Toán Mới')

@section('content')

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Thêm Thanh Toán Mới</div>
                </div>
                <div class="card-body">
                    <!-- Form Thêm Payment -->
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Mã Đặt Chỗ (Reservation ID)</label>
                                    <input type="text" name="reservation_id" class="form-control" placeholder="Nhập mã đặt chỗ (nếu có)">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Mã Hóa Đơn (Bill ID)</label>
                                    <input type="text" name="bill_id" class="form-control"  placeholder="Nhập mã hóa đơn" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Số Tiền (Amount)</label>
                                    <input type="number" name="amount" class="form-control"  placeholder="Nhập số tiền thanh toán" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Phương Thức Thanh Toán (Payment Method)</label>
                                    <select name="payment_method" class="form-select" required>
                                        <option value="cash">Tiền mặt</option>
                                        <option value="credit_card" selected>Thẻ tín dụng</option>
                                        <option value="e-wallet">Ví điện tử</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Trạng Thái Thanh Toán (Status)</label>
                                    <select name="status" class="form-select" required>
                                        <option value="pending">Chờ xử lý</option>
                                        <option value="completed" selected>Hoàn thành</option>
                                        <option value="cancelled">Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Nút Lưu -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Lưu Thanh Toán</button>
                        </div>
                    </form>
                    <!-- Kết thúc Form Thêm Payment -->
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
</div>
<!-- Content wrapper end -->

</div>
<!-- Content wrapper scroll end -->
@endsection
