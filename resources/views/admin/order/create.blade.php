@extends('admin.master')

@section('title', 'Thêm Đơn Hàng Mới')

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
                            <div class="card-title">Thêm Đơn Hàng Mới</div>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.order.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Mã Đặt Chỗ (Reservation ID)</label>
                                    <input type="number" name="reservation_id" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mã Nhân Viên (Staff ID)</label>
                                    <input type="number" name="staff_id" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mã Bàn (Table ID)</label>
                                    <input type="number" name="table_id" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tổng Tiền (Total Amount)</label>
                                    <input type="number" step="0.01" name="total_amount" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số Tiền Cuối Cùng (Final Amount)</label>
                                    <input type="number" step="0.01" name="final_amount" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trạng Thái (Status)</label>
                                    <select name="status" class="form-select">
                                        <option value="Completed">Hoàn thành</option>
                                        <option value="Pending">Đang xử lý</option>
                                        <option value="Cancelled">Đã hủy</option>
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Thêm Đơn Hàng</button>
                                </div>
                            </form>

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
