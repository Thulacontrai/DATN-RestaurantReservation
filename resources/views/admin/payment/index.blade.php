@extends('admin.master')

@section('title', 'Danh Sách Thanh Toán')

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
                            <div class="card-title">Danh sách Thanh toán</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.payment.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.payment.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-id" name="id"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo mã thanh toán">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Mã Thanh Toán</th>
                                            <th>Mã Đặt Bàn</th>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Số Tiền</th>
                                            <th>Số Tiền Hoàn Lại</th>
                                            <th>Trạng Thái Giao Dịch</th>
                                            <th>Phương Thức Thanh Toán</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->reservation_id }}</td>
                                                <td>{{ $payment->bill_id }}</td>
                                                <td>{{ number_format($payment->transaction_amount, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($payment->refund_amount, 0, ',', '.') }} VND</td>

                                                <td>
                                                    @if ($payment->transaction_status === 'completed')
                                                        Hoàn thành
                                                    @elseif ($payment->transaction_status === 'pending')
                                                        Đang xử lý
                                                    @elseif ($payment->transaction_status === 'failed')
                                                        Thất bại
                                                    @else
                                                        Không rõ
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($payment->payment_method === 'Cash')
                                                        Tiền mặt
                                                    @elseif ($payment->payment_method === 'Credit Card')
                                                        Thẻ tín dụng
                                                    @elseif ($payment->payment_method === 'Online')
                                                        Thanh toán trực tuyến
                                                    @else
                                                        Không rõ
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($payment->status === 'Completed')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @elseif ($payment->status === 'Pending')
                                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                                    @elseif ($payment->status === 'Failed')
                                                        <span class="badge bg-danger">Thất bại</span>
                                                    @else
                                                        <span class="badge bg-secondary">Không rõ</span>
                                                    @endif
                                                </td>


                                                <td style="text-align: center">

                                                    {{ \Carbon\Carbon::parse($payment->change_date . ' ' . $payment->change_time)->format('H:i:s') }}<br>
                                                    {{ \Carbon\Carbon::parse($payment->change_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.payment.show', $payment->id) }}"
                                                            class="viewRow" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Chi tiết">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.payment.edit', $payment->id) }}"
                                                            class="editRow" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>

                                                        <form action="{{ route('admin.payment.destroy', $payment->id) }} " style="margin-top: 15px;"
                                                            method="POST" style="display:inline-block; " data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="xoá">
                                                            @csrf
                                                            @method('DELETE') <a href="#">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="bi bi-trash text-danger"
                                                                        style="font-size: 1.2rem;"></i>
                                                                </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">Không có thanh toán nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $payments->links() }} --}}
                            </div>
                            <!-- Kết thúc Pagination -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- Content wrapper end -->

    </div>

    <div id="notification" class="notification d-none">
        <div class="notification-icon">
            <i class="bi"></i>
        </div>
        <div class="notification-content">
            <strong id="notification-title"></strong>
            <p id="notification-message"></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hàm hiển thị thông báo
            function showNotification(message, type = "success") {
                const notification = document.getElementById("notification");
                const notificationIcon = notification.querySelector(".notification-icon i");
                const notificationTitle = document.getElementById("notification-title");
                const notificationMessage = document.getElementById("notification-message");

                // Cập nhật nội dung thông báo
                notificationMessage.textContent = message;

                // Đặt kiểu thông báo
                if (type === "success") {
                    notification.style.background = "linear-gradient(90deg, #58ade8, #48d1cc)";
                    notification.style.color = "#ffffff";
                    notificationIcon.className = "bi bi-check-circle-fill icon-animate";
                    notificationTitle.textContent = "Thành công!";
                } else if (type === "error") {
                    notification.style.background = "linear-gradient(90deg, #f44336, #ff6347)";
                    notification.style.color = "#ffffff";
                    notificationIcon.className = "bi bi-x-circle-fill icon-animate";
                    notificationTitle.textContent = "Lỗi!";
                }

                // Hiển thị thông báo
                notification.classList.remove("d-none");
                notification.classList.add("show");

                // Ẩn thông báo sau 3 giây
                setTimeout(() => {
                    notification.classList.remove("show");
                    notification.classList.add("hide");

                    // Reset sau khi ẩn
                    setTimeout(() => {
                        notification.classList.add("d-none");
                        notification.classList.remove("hide");
                        notificationIcon.classList.remove("icon-animate");
                    }, 300);
                }, 3000);
            }

            // Hiển thị thông báo từ session
            @if (session('success'))
                showNotification("{{ session('success') }}", "success");
            @endif

            @if (session('error'))
                showNotification("{{ session('error') }}", "error");
            @endif
        });
    </script>

@endsection
<style>
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        max-width: 300px;
        background: #ffffff;
        color: #333;
        bpayment-radius: 8px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .notification.show {
        opacity: 1;
        pointer-events: all;
        transform: translateY(0);
    }

    .notification.hide {
        opacity: 0;
        pointer-events: none;
        transform: translateY(-10px);
    }

    .notification i {
        font-size: 20px;
        color: inherit;
    }
</style>
