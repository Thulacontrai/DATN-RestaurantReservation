@extends('admin.master')

@section('title', 'Chỉnh Sửa Đặt Bàn')

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
                            <div class="card-title">Chỉnh Sửa Đặt Bàn</div>
                        </div>
                        <div class="card-body">
                            <!-- Display validation errors -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.reservation.update', $reservation->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Khách hàng</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        value="{{ $reservation->customer->name ?? '' }}" required readonly>
                                </div>


                                <div class="mb-3">
                                    <label for="reservation_time" class="form-label">Thời gian đặt</label>
                                    <input type="datetime-local" class="form-control" id="reservation_time"
                                        name="reservation_time"
                                        value="{{ date('Y-m-d\TH:i', strtotime($reservation->reservation_time)) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="guest_count" class="form-label">Số lượng khách</label>
                                    <input type="number" class="form-control" id="guest_count" name="guest_count"
                                        value="{{ $reservation->guest_count }}" required>
                                </div>

                                <div class="mb-3" id="deposit_section">
                                    <label for="deposit_amount" class="form-label">Số tiền đặt cọc</label>
                                    <input type="number" class="form-control" id="deposit_amount" name="deposit_amount"
                                        value="{{ $reservation->deposit_amount }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Confirmed"
                                            {{ $reservation->status == 'Confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="Pending" {{ $reservation->status == 'Pending' ? 'selected' : '' }}>
                                            Chờ xử lý</option>
                                        <option value="Cancelled"
                                            {{ $reservation->status == 'Cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="cancelled_reason" class="form-label">Lý do hủy (nếu có)</label>
                                    <input type="text" class="form-control" id="cancelled_reason" name="cancelled_reason"
                                        value="{{ $reservation->cancelled_reason }}">
                                </div>

                                <div class="mb-3">
                                    <label for="note" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="note" name="note">{{ $reservation->note }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Cập Nhật Đặt Bàn</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
    </div>
    <!-- Content wrapper scroll end -->

    <script>
        // Calculate deposit based on number of guests
        document.addEventListener('DOMContentLoaded', function () {
            const guestCountInput = document.getElementById('guest_count');
            const depositInput = document.getElementById('deposit_amount');
            const depositPerPerson = 100000; // 100.000 VND per person

            function calculateDeposit() {
                const guestCount = parseInt(guestCountInput.value);
                if (guestCount >= 6) {
                    depositInput.value = guestCount * depositPerPerson;
                } else {
                    depositInput.value = 0;
                }
            }

            guestCountInput.addEventListener('input', calculateDeposit);

            // Call the function on page load to calculate deposit based on initial value
            calculateDeposit();
        });
    </script>

@endsection
