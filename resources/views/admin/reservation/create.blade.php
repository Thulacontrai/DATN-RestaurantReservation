{{-- @extends('admin.master')

@section('title', 'Thêm Mới Đặt Bàn')

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
                            <div class="card-title">Thêm Mới Đặt Bàn</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.reservation.store') }}" method="POST">
                                @csrf

                                <!-- Chọn khách hàng -->
                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">Khách hàng</label>
                                    <select class="form-control" id="customer_id" name="customer_id" required>
                                        <option value="" disabled selected>Chọn khách hàng</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Chọn mã giảm giá -->
                                <div class="mb-3">
                                    <label for="coupon_id" class="form-label">Mã Giảm Giá (Không bắt buộc)</label>
                                    <select class="form-control" id="coupon_id" name="coupon_id">
                                        <option value="">Không có mã</option>
                                        @foreach ($coupons as $coupon)
                                            <option value="{{ $coupon->id }}">{{ $coupon->code }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Thời gian đặt bàn -->
                                <div class="mb-3">
                                    <label for="reservation_time" class="form-label">Thời gian đặt</label>
                                    <input type="datetime-local" class="form-control" id="reservation_time"
                                        name="reservation_time" value="{{ old('reservation_time') }}" required>
                                </div>

                                <!-- Số lượng khách -->
                                <div class="mb-3">
                                    <label for="guest_count" class="form-label">Số lượng khách</label>
                                    <input type="number" class="form-control" id="guest_count" name="guest_count"
                                        value="{{ old('guest_count') }}" min="1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deposit_amount" class="form-label">Số tiền đặt cọc</label>
                                   <input type="number" class="form-control" name="deposit_amount" id="deposit_amount"
                                    value="{{ old('deposit_amount') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="remaining_amount" class="form-label">Số tiền còn lại</label>
                                    <input type="number" class="form-control" name="remaining_amount" id="remaining_amount"
                                    value="{{ old('remaining_amount') }}">
                                </div>


                                <!-- Tổng tiền -->
                                <div class="mb-3">
                                    <label for="total_amount" class="form-label">Tổng tiền</label>
                                    <input type="number" class="form-control" id="total_amount" name="total_amount"
                                        value="{{ old('total_amount') }}" min="0" required>
                                </div>

                                <!-- Trạng thái đặt bàn -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>

                                <!-- Ghi chú -->
                                <div class="mb-3">
                                    <label for="note" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="note" name="note">{{ old('note') }}</textarea>
                                </div>

                                <!-- Nút tạo đặt bàn -->
                                <button type="submit" class="btn btn-primary">Tạo Đặt Bàn</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
    </div>
    <!-- Content wrapper scroll end -->

@endsection --}}
