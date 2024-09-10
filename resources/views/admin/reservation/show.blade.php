@extends('admin.master')

@section('title', 'Chi Tiết Đặt Bàn')

@section('content')

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Chi Tiết Đặt Bàn</div>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Khách hàng</label>
                                <input type="text" class="form-control" id="customer_name" value="{{ $reservation->customer->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="reservation_time" class="form-label">Thời gian đặt</label>
                                <input type="text" class="form-control" id="reservation_time" value="{{ $reservation->reservation_time }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="guest_count" class="form-label">Số lượng khách</label>
                                <input type="text" class="form-control" id="guest_count" value="{{ $reservation->guest_count }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="deposit_amount" class="form-label">Số tiền đặt cọc</label>
                                <input type="text" class="form-control" id="deposit_amount" value="{{ number_format($reservation->deposit_amount, 0, ',', '.') }} VND" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="total_amount" class="form-label">Tổng tiền</label>
                                <input type="text" class="form-control" id="total_amount" value="{{ number_format($reservation->total_amount, 0, ',', '.') }} VND" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="remaining_amount" class="form-label">Số tiền còn lại</label>
                                <input type="text" class="form-control" id="remaining_amount" value="{{ number_format($reservation->remaining_amount, 0, ',', '.') }} VND" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <input type="text" class="form-control" id="status" value="{{ $reservation->status }}" readonly>
                            </div>

                            @if($reservation->status == 'Cancelled')
                                <div class="mb-3">
                                    <label for="cancelled_reason" class="form-label">Lý do hủy</label>
                                    <input type="text" class="form-control" id="cancelled_reason" value="{{ $reservation->cancelled_reason }}" readonly>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" rows="4" readonly>{{ $reservation->note }}</textarea>
                            </div>

                            <a href="{{ route('admin.reservation.index') }}" class="btn btn-secondary">Quay Lại</a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
    </div>
    <!-- Content wrapper scroll end -->

@endsection
