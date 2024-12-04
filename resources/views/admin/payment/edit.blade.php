@extends('admin.master')

@section('title', 'Chỉnh Sửa Thanh Toán')

@section('content')
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Kiểm tra lỗi từ session
            @if ($errors->any())
                Swal.fire({
                    position: "top-end", // Góc trên bên phải
                    icon: "error",
                    toast: true, // Hiển thị nhỏ gọn
                    title: "{{ $errors->first() }}", // Lấy thông báo lỗi đầu tiên
                    showConfirmButton: false, // Không hiển thị nút xác nhận
                    timerProgressBar: true, // Hiển thị thanh tiến trình
                    timer: 3500 // Tự động đóng sau 3.5 giây
                });
            @endif

            // Kiểm tra thông báo lỗi từ session
            @if (session('error'))
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    toast: true,
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3500
                });
            @endif

            // Kiểm tra thông báo thành công từ session
            @if (session('success'))
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    toast: true,
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3500
                });
            @endif
        });
    </script>
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title text-primary">Chỉnh Sửa Thanh Toán</div>
                        </div>
                        <div class="card-body">
                            <form id="payment-form" action="{{ route('admin.payment.update', $payment->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Thông tin thanh toán -->
                                <div class="mb-3">
                                    <label class="form-label ">Mã Đặt Bàn (Reservation ID)</label>
                                    <input type="text" name="reservation_id" class="form-control text-primary"
                                        value="{{ $payment->reservation_id }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mã Hóa Đơn (Bill ID)</label>
                                    <input type="text" name="bill_id" class="form-control text-primary"
                                        value="{{ $payment->bill_id }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số Tiền (Amount)</label>
                                    <input type="number" name="amount" class="form-control text-primary"
                                        value="{{ $payment->transaction_amount }}" readonly>
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

                                <!-- Trạng thái giao dịch -->
                                <div class="mb-3">
                                    <label class="form-label">Trạng Thái Giao Dịch (Transaction Status)</label>
                                    <select name="transaction_status" id="transaction-status" class="form-select" required>
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

                                <!-- Trạng thái -->
                                <div class="mb-3">
                                    <label class="form-label">Trạng Thái (Status)</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="Completed" {{ $payment->status == 'Completed' ? 'selected' : '' }}>
                                            Hoàn thành</option>
                                        <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Đang
                                            xử lý</option>
                                        <option value="Failed" {{ $payment->status == 'Failed' ? 'selected' : '' }}>Thất
                                            bại</option>
                                    </select>
                                    <!-- Cảnh báo -->
                                    <span id="warning-message" class="text-danger d-none">
                                        Trạng thái không hợp lệ. Vui lòng chọn lại.
                                    </span>
                                </div>

                                <!-- Nút hành động -->
                                <div class="mt-3">
                                    <button type="submit" id="submit-btn" class="btn btn-primary">Cập nhật thanh
                                        toán</button>
                                    <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusField = document.getElementById("status");
            const transactionStatusField = document.getElementById("transaction-status");
            const submitButton = document.getElementById("submit-btn");
            const warningMessage = document.getElementById("warning-message");

            // Trạng thái ban đầu
            const initialStatus = "{{ $payment->status }}";
            const initialTransactionStatus = "{{ $payment->transaction_status }}";

            // Kiểm tra và xử lý trạng thái khi thay đổi
            function checkStatus() {
                const selectedStatus = statusField.value;
                const selectedTransactionStatus = transactionStatusField.value;

                // Kiểm tra điều kiện hợp lệ
                if (selectedTransactionStatus === "completed" && selectedStatus !== "Completed") {
                    warningMessage.classList.remove("d-none");
                    submitButton.disabled = true; // Disable nút cập nhật
                } else if (selectedTransactionStatus === "failed" && selectedStatus !== "Failed") {
                    warningMessage.classList.remove("d-none");
                    submitButton.disabled = true; // Disable nút cập nhật
                } else {
                    warningMessage.classList.add("d-none");
                    submitButton.disabled = false; // Kích hoạt lại nút cập nhật
                }
            }

            // Xử lý khi thay đổi trạng thái
            statusField.addEventListener("change", checkStatus);
            transactionStatusField.addEventListener("change", checkStatus);

            // Khởi động kiểm tra trạng thái ngay khi trang load
            checkStatus();
        });
    </script>

@endsection
