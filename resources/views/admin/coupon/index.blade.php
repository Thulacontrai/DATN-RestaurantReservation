@extends('admin.master')

@section('title', 'Danh Sách Phiếu Giảm Giá')

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
                            <div class="card-title">Danh sách phiếu giảm giá</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.coupon.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                                </a>
                                <a href="{{ route('admin.coupon.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Tìm kiếm coupons -->
                            <form method="GET" action="{{ route('admin.coupon.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-code" name="code"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo mã coupon"
                                            value="{{ request('code') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Bảng danh sách coupons -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã Coupon</th>
                                            <th>Mô Tả</th>
                                            <th>Số Lần Sử Dụng</th>
                                            <th>Loại Giảm Giá</th>
                                            <th>Số Tiền Giảm</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $coupon->id }}</td>
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->description }}</td>
                                                <td>{{ $coupon->max_uses }}</td>
                                                <td>{{ $coupon->discount_type }}</td>
                                                <td>{{ number_format($coupon->discount_amount, 0, ',', '.') }} VND</td>
                                                <td>
                                                    @if ($coupon->status == 'active')
                                                        <span class="badge shade-green">Hoạt Động</span>
                                                    @elseif ($coupon->status == 'inactive')
                                                        <span class="badge shade-yellow">Ngừng Hoạt Động</span>
                                                    @else
                                                        <span class="badge shade-red">Hết Hạn</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ route('admin.coupon.show', $coupon->id) }}"
                                                            class="viewRow" data-id="{{ $coupon->id }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Chi tiết">
                                                            <i class="bi bi-list text-green"></i>
                                                        </a>
                                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                            class="editRow" data-id="{{ $coupon->id }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a>
                                                        <a href="#" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Xoá">
                                                            <form action="{{ route('admin.coupon.destroy', $coupon->id) }}"
                                                                method="POST" style="display:inline-block;"
                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-link p-0"
                                                                    style="margin-top: 15px;">
                                                                    <i class="bi bi-trash text-danger"
                                                                        style="font-size: 1.2rem;"></i>
                                                                </button>

                                                            </form>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">Không có coupons nào được tìm thấy.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{-- {{ $coupon->links() }} --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

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
                border-radius: 8px;
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
