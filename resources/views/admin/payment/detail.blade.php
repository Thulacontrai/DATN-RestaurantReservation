@extends('admin.master')

@section('title', 'Chi Tiết Thanh Toán')

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
                            <div class="card-title">Chi Tiết Thanh Toán</div>
                            <a href="{{ route('admin.payment.index') }}" class="btn btn-sm btn-secondary">
                                Quay lại
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Mã Thanh Toán (Payment ID)</label>
                                        <input type="text" class="form-control" value="{{ $payment->id }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Mã Đặt Chỗ (Reservation ID)</label>
                                        <input type="text" class="form-control" value="{{ $payment->reservation_id }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Mã Hóa Đơn (Bill ID)</label>
                                        <input type="text" class="form-control" value="{{ $payment->bill_id }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Số Tiền (Amount)</label>
                                        <input type="number" class="form-control" value="{{ $payment->transaction_amount }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Số Tiền Hoàn Lại (Refund Amount)</label>
                                        <input type="number" class="form-control" value="{{ $payment->refund_amount }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Phương Thức Thanh Toán (Payment Method)</label>
                                        <input type="text" class="form-control" value="{{ $payment->payment_method }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Trạng Thái Giao Dịch (Transaction Status)</label>
                                        <input type="text" class="form-control" value="{{ $payment->transaction_status }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Trạng Thái (Status)</label>
                                        <input type="text" class="form-control" value="{{ $payment->status }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Ngày Tạo (Created At)</label>
                                        <input type="text" class="form-control" value="{{ $payment->created_at->format('Y-m-d H:i') }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Ngày Cập Nhật (Updated At)</label>
                                        <input type="text" class="form-control" value="{{ $payment->updated_at->format('Y-m-d H:i') }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.payment.edit', $payment->id) }}" class="btn btn-primary">
                                    Chỉnh Sửa
                                </a>
                            </div>
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
