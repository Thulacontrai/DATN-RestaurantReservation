@extends('admin.master')

@section('title', 'Danh Mục Thực Đơn')

@section('content')
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Danh Mục Thực Đơn</div>

                            <!-- Nút Thêm Mới và Khôi Phục -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.category.create') }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-circle me-2"></i> Thêm Mới
                                </a>
                                <a href="{{ route('admin.category.trash') }}"
                                    class="btn btn-sm btn-secondary d-flex align-items-center">
                                    <i class="bi bi-trash3 me-2"></i> Khôi Phục
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Form Tìm Kiếm -->
                            <form method="GET" action="{{ route('admin.category.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <input type="text" id="search-name" name="name"
                                            class="form-control form-control-sm" placeholder="Tìm kiếm theo tên category"
                                            value="{{ request('name') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Bảng Danh Sách -->
                            <div class="table-responsive">
                                <table class="table v-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Tên Category</th>
                                            <th>Mô Tả</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>
                                                    <div class="actions d-flex gap-2">
                                                        <a href="{{ route('admin.category.edit', $category->id) }}"
                                                            class="btn btn-link p-0" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Sửa">
                                                            <i class="bi bi-pencil-square text-warning"
                                                                style="font-size: 1.2rem;"></i>
                                                        </a>
                                                        <a href="" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Xoá">
                                                        <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0" style="margin-top: 15px;">
                                                                <i class="bi bi-trash text-danger"
                                                                    style="font-size: 1.2rem;"></i>
                                                            </button>
                                                        </form></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Không có category nào được tìm thấy.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination justify-content-center mt-3">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông Báo -->
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
        /* Điều chỉnh vị trí theo ý */
        right: 20px;
        /* Đẩy sang góc phải */
        max-width: 300px;
        background: #ffffff;
        color: #333;
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        /* Sử dụng flex để hiển thị ngang hàng */
        align-items: center;
        /* Căn giữa theo trục dọc */
        gap: 10px;
        /* Khoảng cách giữa icon và nội dung */
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        pointer-events: none;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    /* Trạng thái */
    .notification.success {
        border-left: 4px solid #4caf50;
        background: #e8f5e9;
        color: #2e7d32;
    }

    .notification.error {
        border-left: 4px solid #f44336;
        background: #ffebee;
        color: #c62828;
    }

    /* Icon */
    .notification i {
        font-size: 20px;
        color: inherit;
        /* Lấy màu theo trạng thái */
    }

    /* Hiệu ứng hiển thị */
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

    /* Nội dung */
    .notification span {
        margin: 0;
        /* Xóa khoảng cách mặc định */
        font-size: 14px;
        /* Điều chỉnh kích thước chữ */
        line-height: 1.5;
        /* Tạo khoảng cách dễ đọc */
    }
</style>
