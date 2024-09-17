@extends('admin.master')

@section('title', 'Chỉnh Sửa Thanh Toán')

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
                            <div class="card-title">Chỉnh Sửa Thanh Toán</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.payment.update', $payment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Mã Đặt Chỗ (Reservation ID)</label>
                                    <input type="text" name="reservation_id" class="form-control"
                                        value="{{ $payment->reservation_id }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mã Hóa Đơn (Bill ID)</label>
                                    <input type="text" name="bill_id" class="form-control"
                                        value="{{ $payment->bill_id }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số Tiền (Amount)</label>
                                    <input type="number" name="amount" class="form-control"
                                        value="{{ $payment->transaction_amount }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số Tiền Hoàn Lại (Refund Amount)</label>
                                    <input type="number" name="refund_amount" class="form-control"
                                        value="{{ $payment->refund_amount }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phương Thức Thanh Toán (Payment Method)</label>
                                    <select name="payment_method" class="form-select" required>
                                        <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>
                                            Tiền mặt</option>
                                        <option value="Credit Card"
                                            {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>Thẻ tín dụng
                                        </option>
                                        <option value="Online" {{ $payment->payment_method == 'Online' ? 'selected' : '' }}>
                                            Thanh toán trực tuyến</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trạng Thái Giao Dịch (Transaction Status)</label>
                                    <select name="transaction_status" class="form-select" required>
                                        <option value="pending"
                                            {{ $payment->transaction_status == 'pending' ? 'selected' : '' }}>Đang xử lý
                                        </option>
                                        <option value="completed"
                                            {{ $payment->transaction_status == 'completed' ? 'selected' : '' }}>Hoàn thành
                                        </option>
                                        <option value="failed"
                                            {{ $payment->transaction_status == 'failed' ? 'selected' : '' }}>Thất bại
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trạng Thái (Status)</label>
                                    <select name="status" class="form-select" required>
                                        <option value="Completed" {{ $payment->status == 'Completed' ? 'selected' : '' }}>
                                            Hoàn thành</option>
                                        <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Đang
                                            xử lý</option>
                                        <option value="Failed" {{ $payment->status == 'Failed' ? 'selected' : '' }}>Thất
                                            bại</option>
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Cập nhật thanh toán</button>
                                    <a href="{{route('admin.payment.index')}}"  class="btn btn-sm btn-secondary">Quay lại</a>
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
